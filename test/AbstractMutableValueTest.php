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

use PHPUnit\Framework\TestCase;

class AbstractMutableValueTest extends TestCase
{

    public function testConstruct()
    {
        $value = new TestMutableValue(99);

        $this->assertSame(99, $value->get());
        $this->assertSame('99', (string) $value);
        $this->assertSame(99, $value->jsonSerialize());
    }

    public function testFluentConstructor()
    {
        $this->assertSame(99, TestMutableValue::create(99)->get());
    }

    public function testCastsSelf()
    {
        $expected = new TestMutableValue(99);
        $this->assertSame($expected, TestMutableValue::cast($expected));
    }

    public function testCastsScalar()
    {
        $expected = new TestMutableValue(99);
        $this->assertEquals($expected, TestMutableValue::cast(99));
    }

    public function testCastsValueObject()
    {
        $value = $this->createMock(ValueInterface::class);
        $value->expects($this->once())->method('get')->willReturn(99);
        $this->assertEquals(new TestMutableValue(99), TestMutableValue::cast($value));
    }

    public function testSet()
    {
        $value = new TestMutableValue(99);

        $this->assertSame($value, $value->set(999));
        $this->assertSame(999, $value->get());

        $value->set(new TestMutableValue(123));
        $this->assertSame(123, $value->get());
    }

    public function testSetInvalid()
    {
        $this->expectException(ValueException::class);
        new TestMutableValue('foo');
    }

    public function testIs()
    {
        $value = new TestMutableValue(99);

        $this->assertTrue($value->is(99));
        $this->assertFalse($value->is(99.0));
        $this->assertTrue($value->is(new TestMutableValue(99)));
    }
}
