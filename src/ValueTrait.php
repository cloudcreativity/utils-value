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
use LogicException;

/**
 * @template TValue
 */
trait ValueTrait
{
    /**
     * @var TValue
     */
    public readonly mixed $value;

    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * Fluent to string method.
     */
    public function toString(): string
    {
        if (is_scalar($this->value)) {
            return (string) $this->value;
        }

        throw new LogicException('Cannot convert value to string - override the toString method.');
    }

    /**
     * @return TValue
     */
    public function get(): mixed
    {
        return $this->value;
    }

    /**
     * Is the value any of the provided values?
     */
    public function is(mixed ...$values): bool
    {
        if (count($values) === 0) {
            throw new BadMethodCallException('Values must be provided.');
        }

        foreach ($values as $value) {
            if ($this->matches($value)) {
                return true;
            }
        }

        return false;
    }

    public function isEmpty(): bool
    {
        return empty($this->value);
    }

    public function isNotEmpty(): bool
    {
        return ! $this->isEmpty();
    }

    /**
     * @return TValue
     */
    public function jsonSerialize(): mixed
    {
        return $this->get();
    }

    /**
     * Does the value match the provided value?
     */
    protected function matches(mixed $value): bool
    {
        if ($value instanceof ValueInterface) {
            $value = $value->get();
        }

        if ($this->useStrict()) {
            return $this->get() === $value;
        }

        return $this->get() == $value;
    }

    /**
     * Should strict comparison be used for comparing values?
     */
    protected function useStrict(): bool
    {
        return true;
    }
}
