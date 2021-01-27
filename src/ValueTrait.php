<?php
/*
 * Copyright 2021 Cloud Creativity Limited
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

namespace CloudCreativity\Utils\Value;

use BadMethodCallException;

/**
 * Class ValueTrait
 *
 * @package CloudCreativity\Utils\Value
 */
trait ValueTrait
{

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @return string
     */
    public function __toString()
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
        return (string) $this->value;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->value;
    }

    /**
     * Is the value any of the provided values?
     *
     * @param array ...$values
     * @return bool
     */
    public function is(...$values): bool
    {
        if (empty($values)) {
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
     * @return mixed
     */
    public function jsonSerialize()
    {
        return $this->get();
    }

    /**
     * Does the value match the provided value?
     *
     * @param mixed $value
     * @return bool
     */
    protected function matches($value): bool
    {
        if ($value instanceof ValueInterface) {
            $value = $value->get();
        }

        return $this->useStrict() ? $this->get() === $value : $this->get() == $value;
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
