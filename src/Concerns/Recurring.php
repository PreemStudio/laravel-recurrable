<?php

declare(strict_types=1);

namespace PreemStudio\Recurring\Concerns;

use PreemStudio\Recurring\Builder;

trait Recurring
{
    public function recurr(): Builder
    {
        return new Builder($this);
    }

    public function getRecurringConfig(): array
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
