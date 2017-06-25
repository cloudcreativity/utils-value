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

class AbstractValueTest extends TestCase
{

    public function testConstruct()
    {
        $value = new TestValue('abc');

        $this->assertSame('abc', (string) $value);
    }

    public function testFluentConstructor()
    {
        $this->assertTrue(TestValue::create('abc')->is('abc'));
    }

    public function testCastsSelf()
    {
        $expected = new TestValue('abc');
        $this->assertSame($expected, TestValue::cast($expected));
    }

    public function testCastsScalar()
    {
        $expected = new TestValue('abc');
        $this->assertEquals($expected, TestValue::cast('abc'));
    }

    public function testCastsValueObject()
    {
        $mock = $this->createMock(ValueInterface::class);
        $mock->expects($this->once())->method('get')->willReturn('abc');
        $this->assertEquals(new TestValue('abc'), TestValue::cast($mock));
    }

    public function testConstructInvalid()
    {
        $this->expectException(ValueException::class);
        new TestValue('ab');
    }

    public function testIsNotStrict()
    {
        $value = new TestValue('123');

        $this->assertTrue($value->is(123));
    }
}
