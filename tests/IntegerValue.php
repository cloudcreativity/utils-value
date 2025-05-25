<?php

/*
 * Copyright 2025 Cloud Creativity Limited
 *
 * Use of this source code is governed by an MIT-style
 * license that can be found in the LICENSE file or at
 * https://opensource.org/licenses/MIT.
 */

declare(strict_types=1);

namespace CloudCreativity\Utils\Value\Tests;

use CloudCreativity\Utils\Value\AbstractValue;

/**
 * @extends AbstractValue<int>
 */
final readonly class IntegerValue extends AbstractValue
{
    protected function accept(mixed $value): bool
    {
        return is_int($value);
    }
}
