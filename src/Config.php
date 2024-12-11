<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Recurrable;

use Illuminate\Contracts\Support\Arrayable;
use Recurr\Frequency;

final class Config implements Arrayable
{
    private array $frequencies = [
        Frequency::YEARLY => 'YEARLY',
        Frequency::MONTHLY => 'MONTHLY',
        Frequency::WEEKLY => 'WEEKLY',
        Frequency::DAILY => 'DAILY',
        Frequency::HOURLY => 'HOURLY',
        Frequency::MINUTELY => 'MINUTELY',
        Frequency::SECONDLY => 'SECONDLY',
    ];

    public function __construct(
        private string $startDate,
        private string $endDate,
        private string $timezone,
        private string $frequency,
        private int $interval,
        private ?int $count = null,
    ) {}

    public function getStartDate(): string
    {
        return $this->startDate;
    }

    public function setStartDate(string $value): self
    {
        $this->startDate = $value;

        return $this;
    }

    public function getEndDate(): string
    {
        return $this->endDate;
    }

    public function setEndDate(string $value): self
    {
        $this->endDate = $value;

        return $this;
    }

    public function getTimezone(): string
    {
        return $this->timezone;
    }

    public function setTimezone(string $value): self
    {
        $this->timezone = $value;

        return $this;
    }

    public function getFrequency(): string
    {
        return $this->frequency;
    }

    public function setFrequency(string $value): self
    {
        $this->frequency = $value;

        return $this;
    }

    public function getInterval(): int
    {
        return $this->interval;
    }

    public function setInterval(int $value): self
    {
        $this->interval = $value;

        return $this;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(?int $value): self
    {
        $this->count = $value;

        return $this;
    }

    public function getFrequencies(): array
    {
        return $this->frequencies;
    }

    #[\Override()]
    public function toArray(): array
    {
        return [
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'timezone' => $this->timezone,
            'frequency' => $this->frequency,
            'interval' => $this->interval,
            'count' => $this->count,
        ];
    }
}
