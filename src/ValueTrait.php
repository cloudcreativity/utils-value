<?php
/*
 * Copyright 2022 Cloud Creativity Limited
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
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
    protected mixed $value;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * Fluent to string method.
     *
     * @return string
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
     *
     * @param mixed ...$values
     * @return bool
     */
    public function is(...$values): bool
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

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->value);
    }

    /**
     * @return bool
     */
    public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
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
     *
     * @param mixed $value
     * @return bool
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
     *
     * @return bool
     */
    protected function useStrict(): bool
    {
        return true;
    }
}
