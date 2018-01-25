<?php

/**
 * Copyright 2017 Cloud Creativity Limited
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

/**
 * Class AbstractValue
 *
 * @package CloudCreativity\Utils\Value
 */
abstract class AbstractValue implements ValueInterface
{

    use ValueTrait;

    /**
     * Is the supplied scalar value acceptable for this value class?
     *
     * @param $value
     * @return bool
     */
    abstract protected function accept($value): bool;

    /**
     * Fluent constructor.
     *
     * @param $value
     * @return static
     */
    public static function create($value): ValueInterface
    {
        return new static($value);
    }

    /**
     * Cast the provided value.
     *
     * @param mixed $value
     * @return static
     */
    public static function cast($value): ValueInterface
    {
        if ($value instanceof static) {
            return $value;
        }

        if ($value instanceof ValueInterface) {
            $value = $value->get();
        }

        return new static($value);
    }

    /**
     * AbstractValue constructor.
     *
     * @param mixed $value
     * @throws ValueException
     */
    public function __construct($value)
    {
        if (!$this->accept($value)) {
            throw new ValueException('Expecting a valid value.');
        }

        $this->value = $value;
    }
}
