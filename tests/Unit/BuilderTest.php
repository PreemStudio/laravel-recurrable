<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\CoversClass(\BaseCodeOy\Recurrable\Builder::class)]
final class BuilderTest extends TestCase
{
    public function test_next_returns_carbon_instance(): void
    {
        $recurrableClass = new RecurrableClass(['count' => 2]);

        $builder = $recurrableClass->recurr();

        $this->assertInstanceOf(Carbon::class, $builder->next());
    }

    public function test_next_returns_false_if_no_more_recurrances(): void
    {
        $recurrableClass = new RecurrableClass(['count' => 1]);

        $builder = $recurrableClass->recurr();

        $this->assertFalse($builder->next());
    }
}

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
