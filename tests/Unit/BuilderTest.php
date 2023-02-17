<?php

declare(strict_types=1);

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;

/**
 * @covers \PreemStudio\Recurring\Builder
 */
class BuilderTest extends TestCase
{
    /** @test */
    public function next_returns_carbon_instance()
    {
        $recurring = new RecurringClass(['count' => 2]);

        $builder = $recurring->recurr();

        $this->assertTrue($builder->next() instanceof Carbon);
    }

    /** @test */
    public function next_returns_false_if_no_more_recurrances()
    {
        $recurring = new RecurringClass(['count' => 1]);

        $builder = $recurring->recurr();

        $this->assertFalse($builder->next());
    }
}

class RecurringClass
{
    use \PreemStudio\Recurring\Concerns\Recurring;

    private string $start_at;

    private string $end_at;

    private string $timezone;

    private string $frequency;

    private int $interval;

    private int $count;

    public function __construct(array $attributes = [])
    {
        $this->start_at  = $attributes['start_at'] ?? Carbon::now()->format('Y-m-d H:i:s');
        $this->end_at    = $attributes['end_at'] ?? Carbon::now()->format('Y-m-d H:i:s');
        $this->timezone  = $attributes['timezone'] ?? Carbon::now()->format('e');
        $this->frequency = $attributes['frequency'] ?? 'DAILY';
        $this->interval  = $attributes['interval'] ?? 1;
        $this->count     = $attributes['count'] ?? null;
    }
}
