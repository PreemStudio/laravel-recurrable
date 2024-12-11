<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit;

use Carbon\Carbon;

final class RecurrableClass
{
    use \BaseCodeOy\Recurrable\Concerns\Recurrable;

    private string $start_at;

    private string $end_at;

    private string $timezone;

    private string $frequency;

    private int $interval;

    private int $count;

    public function __construct(array $attributes = [])
    {
        $this->start_at = $attributes['start_at'] ?? Carbon::now()->format('Y-m-d H:i:s');
        $this->end_at = $attributes['end_at'] ?? Carbon::now()->format('Y-m-d H:i:s');
        $this->timezone = $attributes['timezone'] ?? Carbon::now()->format('e');
        $this->frequency = $attributes['frequency'] ?? 'DAILY';
        $this->interval = $attributes['interval'] ?? 1;
        $this->count = $attributes['count'] ?? null;
    }
}
