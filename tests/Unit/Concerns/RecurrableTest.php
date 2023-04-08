<?php

declare(strict_types=1);

namespace Tests\Unit\Concerns;

use Tests\TestCase;

/**
 * @internal
 *
 * @covers \PreemStudio\Recurrable\Concerns\Recurrable
 */
final class RecurrableTest extends TestCase
{
    public function test_recurring_instantiates_builder(): void
    {
        $recurring = new RecurrableExample();

        $builder = $recurring->recurr();

        self::assertInstanceOf(\PreemStudio\Recurrable\Builder::class, $builder);
    }

    public function test_recurring_model_instantiates_builder(): void
    {
        $recurring = new RecurrableModelExample();

        $builder = $recurring->recurr();

        self::assertInstanceOf(\PreemStudio\Recurrable\Builder::class, $builder);
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

    private $count;
}

final class RecurrableModelExample extends \Illuminate\Database\Eloquent\Model
{
    use \PreemStudio\Recurrable\Concerns\Recurrable;

    private $start_at = '';

    private $end_at = '';

    private $timezone = '';

    private $frequency = '';

    private $interval = 0;

    private $count;
}
