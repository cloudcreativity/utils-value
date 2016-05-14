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

use PHPUnit_Framework_TestCase;

class AbstractScalarValueTest extends PHPUnit_Framework_TestCase
{

    public function testConstruct()
    {
        $value = new TestValue(99);

        $this->assertSame(99, $value->get());
        $this->assertSame('99', (string) $value);
        $this->assertSame(99, $value->jsonSerialize());
    }

    public function testSet()
    {
        $value = new TestValue(99);

        $this->assertSame($value, $value->set(999));
        $this->assertSame(999, $value->get());
    }

    public function testSetInvalid()
    {
        $this->setExpectedException(InvalidValueException::class);
        new TestValue('foo');
    }

    public function testIs()
    {
        $value = new TestValue(99);

        $this->assertTrue($value->is(99));
        $this->assertFalse($value->is(99.0));
    }
}
