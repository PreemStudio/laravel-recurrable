<?php

declare(strict_types=1);

namespace PreemStudio\Recurrable\Concerns;

use PreemStudio\Recurrable\Builder;

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
            'end_date'   => $this->end_at,
            'timezone'   => $this->timezone,
            'frequency'  => $this->frequency,
            'interval'   => $this->interval,
            'count'      => $this->count,
        ];
    }
}
