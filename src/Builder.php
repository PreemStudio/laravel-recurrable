<?php

declare(strict_types=1);

namespace BombenProdukt\Recurrable;

use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Support\Str;
use Recurr\RecurrenceCollection;
use Recurr\Rule;
use Recurr\Transformer\ArrayTransformer;
use Recurr\Transformer\ArrayTransformerConfig;

final class Builder
{
    private $recurring;

    private Config $config;

    public function __construct($recurring)
    {
        $this->recurring = $recurring;
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
        $transformerConfig = new ArrayTransformerConfig();
        $transformerConfig->enableLastDayOfMonthFix();

        $transformer = new ArrayTransformer();
        $transformer->setConfig($transformerConfig);

        return $transformer->transform($this->rule());
    }

    public function rule(): Rule
    {
        $config = $this->getConfig();

        $rule = (new Rule())
            ->setStartDate(new \DateTimeImmutable($config['start_date'], new DateTimeZone($config['timezone'])))
            ->setTimezone($config['timezone'])
            ->setFreq($this->getFrequencyType())
            ->setInterval($config['interval']);

        if (!empty($config['count'])) {
            $rule = $rule->setCount($config['count']);
        }

        if (!empty($config['end_date'])) {
            $rule = $rule->setEndDate(new \DateTimeImmutable($config['end_date'], new DateTimeZone($config['timezone'])));
        }

        return $rule;
    }

    public function getFrequencyType(): string
    {
        $frequency = $this->getFromConfig('frequency');

        if (!\in_array($frequency, $this->config->getFrequencies(), true)) {
            throw new \InvalidArgumentException("{$frequency} is not a valid frequency");
        }

        return $frequency;
    }

    public function getConfig(): array
    {
        return $this->config->toArray();
    }

    private function getFromConfig($key)
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
