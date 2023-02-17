<?php

declare(strict_types=1);

namespace Tests\Unit\Concerns;

use Tests\TestCase;

/**
 * @covers \PreemStudio\Recurring\Concerns\Recurring
 */
class RecurringTest extends TestCase
{
    /** @test */
    public function recurring_instantiates_builder()
    {
        $recurring = new RecurringExample;

        $builder = $recurring->recurr();

        $this->assertTrue($builder instanceof \PreemStudio\Recurring\Builder);
    }

    /** @test */
    public function recurring_model_instantiates_builder()
    {
        $recurring = new RecurringModelExample;

        $builder = $recurring->recurr();

        $this->assertTrue($builder instanceof \PreemStudio\Recurring\Builder);
    }
}

class RecurringExample
{
    use \PreemStudio\Recurring\Concerns\Recurring;

    private $start_at = '';

    private $end_at = '';

    private $timezone = '';

    private $frequency = '';

    private $interval = 0;

    private $count = null;
}

class RecurringModelExample extends \Illuminate\Database\Eloquent\Model
{
    use \PreemStudio\Recurring\Concerns\Recurring;

    private $start_at = '';

    private $end_at = '';

    private $timezone = '';

    private $frequency = '';

    private $interval = 0;

    private $count = null;
}
