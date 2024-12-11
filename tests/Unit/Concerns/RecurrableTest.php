<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Concerns;

use Tests\TestCase;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\CoversClass(\BaseCodeOy\Recurrable\Concerns\Recurrable::class)]
final class RecurrableTest extends TestCase
{
    public function test_recurring_instantiates_builder(): void
    {
        $recurrableExample = new RecurrableExample();

        $builder = $recurrableExample->recurr();

        $this->assertInstanceOf(\BaseCodeOy\Recurrable\Builder::class, $builder);
    }

    public function test_recurring_model_instantiates_builder(): void
    {
        $recurrableModelExample = new RecurrableModelExample();

        $builder = $recurrableModelExample->recurr();

        $this->assertInstanceOf(\BaseCodeOy\Recurrable\Builder::class, $builder);
    }
}
