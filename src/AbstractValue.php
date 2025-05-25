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

/**
 * @template TValue
 * @implements ValueInterface<TValue>
 */
abstract class AbstractValue implements ValueInterface
{
    /** @use ValueTrait<TValue> */
    use ValueTrait;

    /**
     * Is the supplied scalar value acceptable for this value class?
     *
     * @param mixed $value
     * @return bool
     */
    abstract protected function accept(mixed $value): bool;

    /**
     * Fluent constructor.
     *
     * @param mixed $value
     * @return static
     */
    public static function create(mixed $value): static
    {
        return static::from($value);
    }

    /**
     * Create a value.
     *
     * @param mixed $value
     * @return static
     */
    public static function from(mixed $value): static
    {
        return match (true) {
            $value instanceof static => $value,
            $value instanceof ValueInterface => new static($value->get()),
            default => new static($value),
        };
    }

    /**
     * Create a value if it is acceptable, otherwise return null.
     *
     * @param mixed $value
     * @return static|null
     */
    public static function tryFrom(mixed $value): ?static
    {
        if ($value === null) {
            return null;
        }

        try {
            return static::from($value);
        } catch (ValueException) {
            return null;
        }
    }

    /**
     * Backward compatibility method for casting values.
     *
     * @param mixed $value
     * @return static
     */
    public static function cast(mixed $value): static
    {
        return static::from($value);
    }

    /**
     * Cast the provided value if it is not null.
     *
     * @param mixed|null $value
     * @return static|null
     */
    public static function nullable(mixed $value): ?static
    {
        if ($value === null) {
            return null;
        }

        return static::from($value);
    }

    /**
     * AbstractValue constructor.
     *
     * @param mixed $value
     * @throws ValueException
     */
    public function __construct(mixed $value)
    {
        if ($this->notAcceptable($value)) {
            throw new ValueException('Expecting a valid value.');
        }

        $this->value = $value;
    }

    /**
     * Is the value not acceptable?
     *
     * @param mixed $value
     * @return bool
     */
    protected function notAcceptable(mixed $value): bool
    {
        return !$this->accept($value);
    }
}
