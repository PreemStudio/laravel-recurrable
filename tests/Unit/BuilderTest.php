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
