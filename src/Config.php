<?php

declare(strict_types=1);

namespace PreemStudio\Recurrable;

use Illuminate\Contracts\Support\Arrayable;
use Recurr\Frequency;

final class Config implements Arrayable
{
    private string $startDate;

    private string $endDate;

    private string $timezone;

    private string $frequency;

    private int $interval;

    private ?int $count;

    private $frequencies = [
        Frequency::YEARLY   => 'YEARLY',
        Frequency::MONTHLY  => 'MONTHLY',
        Frequency::WEEKLY   => 'WEEKLY',
        Frequency::DAILY    => 'DAILY',
        Frequency::HOURLY   => 'HOURLY',
        Frequency::MINUTELY => 'MINUTELY',
        Frequency::SECONDLY => 'SECONDLY',
    ];

    public function __construct(string $startDate, string $endDate, string $timezone, string $frequency, int $interval, ?int $count = null)
    {
        $this->startDate = $startDate;
        $this->endDate   = $endDate;
        $this->timezone  = $timezone;
        $this->frequency = $frequency;
        $this->interval  = $interval;
        $this->count     = $count;
    }

    public function getStartDate(): string
    {
        return $this->startDate;
    }

    public function setStartDate($value): self
    {
        $this->startDate = $value;

        return $this;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function setEndDate($value): self
    {
        $this->endDate = $value;

        return $this;
    }

    public function getTimezone(): string
    {
        return $this->timezone;
    }

    public function setTimezone($value): self
    {
        $this->timezone = $value;

        return $this;
    }

    public function getFrequency(): string
    {
        return $this->frequency;
    }

    public function setFrequency($value): self
    {
        $this->frequency = $value;

        return $this;
    }

    public function getInterval(): int
    {
        return $this->interval;
    }

    public function setInterval($value): self
    {
        $this->interval = $value;

        return $this;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount($value): self
    {
        $this->count = $value;

        return $this;
    }

    public function getFrequencies(): array
    {
        return $this->frequencies;
    }

    public function toArray(): array
    {
        return [
            'start_date' => $this->startDate,
            'end_date'   => $this->endDate,
            'timezone'   => $this->timezone,
            'frequency'  => $this->frequency,
            'interval'   => $this->interval,
            'count'      => $this->count,
        ];
    }
}
