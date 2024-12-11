<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Recurrable;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Recurr\RecurrenceCollection;
use Recurr\Rule;
use Recurr\Transformer\ArrayTransformer;
use Recurr\Transformer\ArrayTransformerConfig;

final class Builder
{
    private readonly Config $config;

    public function __construct(
        private $recurring,
    ) {
        $this->config = $this->buildConfig();
    }

    public function first()
    {
        if ($this->schedule()->isEmpty()) {
            return false;
        }

        return Carbon::instance($this->schedule()->first()->getStart());
    }

    public function last()
    {
        if ($this->schedule()->isEmpty()) {
            return false;
        }

        return Carbon::instance($this->schedule()->last()->getStart());
    }

    public function next()
    {
        if ($this->schedule()->isEmpty()) {
            return false;
        }

        if (!$next = $this->schedule()->next()) {
            return false;
        }

        return Carbon::instance($next->getStart());
    }

    public function current()
    {
        if ($this->schedule()->isEmpty()) {
            return false;
        }

        return Carbon::instance($this->schedule()->current()->getStart());
    }

    public function schedule(): RecurrenceCollection
    {
        $arrayTransformerConfig = new ArrayTransformerConfig();
        $arrayTransformerConfig->enableLastDayOfMonthFix();

        $arrayTransformer = new ArrayTransformer();
        $arrayTransformer->setConfig($arrayTransformerConfig);

        return $arrayTransformer->transform($this->rule());
    }

    public function rule(): Rule
    {
        $config = $this->getConfig();

        $rule = (new Rule())
            ->setStartDate(new \DateTimeImmutable($config['start_date'], new \DateTimeZone($config['timezone'])))
            ->setTimezone($config['timezone'])
            ->setFreq($this->getFrequencyType())
            ->setInterval($config['interval']);

        if (!empty($config['count'])) {
            $rule = $rule->setCount($config['count']);
        }

        if (!empty($config['end_date'])) {
            return $rule->setEndDate(new \DateTimeImmutable($config['end_date'], new \DateTimeZone($config['timezone'])));
        }

        return $rule;
    }

    public function getFrequencyType(): string
    {
        $frequency = $this->getFromConfig('frequency');

        if (!\in_array($frequency, $this->config->getFrequencies(), true)) {
            throw new \InvalidArgumentException($frequency.' is not a valid frequency');
        }

        return $frequency;
    }

    public function getConfig(): array
    {
        return $this->config->toArray();
    }

    private function getFromConfig(string $key)
    {
        return $this->config->{'get'.Str::studly($key)}();
    }

    private function buildConfig(): Config
    {
        $config = $this->recurring->getRecurrableConfig();

        return new Config(
            $config['start_date'],
            $config['end_date'],
            $config['timezone'],
            $config['frequency'],
            $config['interval'],
            $config['count'],
        );
    }
}
