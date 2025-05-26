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

/**
 * @template TValue
 * @implements ValueInterface<TValue>
 */
abstract readonly class AbstractValue implements ValueInterface
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
    final public function __construct(mixed $value)
    {
        $value = $this->parse($value);

        if ($this->notAcceptable($value)) {
            throw new ValueException('Expecting a valid value.');
        }

        $this->value = $value;
    }

    /**
     * Allow the value to be parsed before it is accepted.
     *
     * @param mixed $value
     * @return mixed
     */
    protected function parse(mixed $value): mixed
    {
        return $value;
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
