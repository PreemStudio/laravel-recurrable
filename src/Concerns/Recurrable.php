<?php

declare(strict_types=1);

namespace BaseCodeOy\Recurrable\Concerns;

use BaseCodeOy\Recurrable\Builder;

trait Recurrable
{
    public function recurr(): Builder
    {
        return new Builder($this);
    }

    public function getRecurrableConfig(): array
    {
        return [
            'start_date' => $this->start_at,
            'end_date' => $this->end_at,
            'timezone' => $this->timezone,
            'frequency' => $this->frequency,
            'interval' => $this->interval,
            'count' => $this->count,
        ];
    }
}
