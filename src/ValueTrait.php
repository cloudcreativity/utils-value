<?php

/**
 * Copyright 2016 Cloud Creativity Limited
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
     * @param mixed $value
     * @return bool
     */
    public function is($value)
    {
        if ($value instanceof ValueInterface) {
            $value = $value->get();
        }

        return $this->useStrict() ? $this->get() === $value : $this->get() == $value;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize()
    {
        return $this->get();
    }

    /**
     * Should strict comparison be used for comparing values?
     *
     * @return bool
     */
    protected function useStrict()
    {
        return true;
    }

}
