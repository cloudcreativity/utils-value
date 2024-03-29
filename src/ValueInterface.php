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

use JsonSerializable;

/**
 * Interface ValueInterface
 *
 * @package CloudCreativity\Utils\Value
 */
interface ValueInterface extends JsonSerializable
{

    /**
     * @return string
     */
    public function __toString();

    /**
     * Fluent string method.
     *
     * @return string
     */
    public function toString(): string;

    /**
     * @return mixed
     */
    public function get();

    /**
     * Is the value any of the provided values?
     *
     * @param mixed ...$values
     * @return bool
     * @throws \BadMethodCallException
     *      if invoked without any values.
     */
    public function is(...$values): bool;

}
