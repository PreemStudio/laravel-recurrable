<?php

declare(strict_types=1);

namespace Tests\Unit\Concerns;

use Tests\TestCase;

/**
 * @covers \PreemStudio\Recurrable\Concerns\Recurrable
 */
final class RecurrableTest extends TestCase
{
    /** @test */
    public function recurring_instantiates_builder()
    {
        $recurring = new RecurrableExample;

        $builder = $recurring->recurr();

        $this->assertTrue($builder instanceof \PreemStudio\Recurrable\Builder);
    }

    /** @test */
    public function recurring_model_instantiates_builder()
    {
        $recurring = new RecurrableModelExample;

        $builder = $recurring->recurr();

        $this->assertTrue($builder instanceof \PreemStudio\Recurrable\Builder);
    }
}

final class RecurrableExample
{
    use \PreemStudio\Recurrable\Concerns\Recurrable;

    private $start_at = '';

    private $end_at = '';

    private $timezone = '';

    private $frequency = '';

    private $interval = 0;

    private $count = null;
}

final class RecurrableModelExample extends \Illuminate\Database\Eloquent\Model
{
    use \PreemStudio\Recurrable\Concerns\Recurrable;

    private $start_at = '';

    private $end_at = '';

    private $timezone = '';

    private $frequency = '';

    private $interval = 0;

    private $count = null;
}
