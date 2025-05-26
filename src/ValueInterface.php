<?php

/*
 * Copyright 2025 Cloud Creativity Limited
 *
 * Use of this source code is governed by an MIT-style
 * license that can be found in the LICENSE file or at
 * https://opensource.org/licenses/MIT.
 */

declare(strict_types=1);

namespace CloudCreativity\Utils\Value;

use BadMethodCallException;
use JsonSerializable;
use Stringable;

/**
 * @template TValue of mixed
 */
interface ValueInterface extends JsonSerializable, Stringable
{
    /**
     * Fluent string method.
     *
     * @return string
     */
    public function toString(): string;

    /**
     * @return TValue
     */
    public function get(): mixed;

    /**
     * Is the value any of the provided values?
     *
     * @param mixed ...$values
     * @return bool
     * @throws BadMethodCallException if invoked without any values.
     */
    public function is(mixed ...$values): bool;

}
