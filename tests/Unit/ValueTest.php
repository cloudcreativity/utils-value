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

namespace CloudCreativity\Utils\Value\Tests\Unit;

use CloudCreativity\Utils\Value\Tests\IntegerValue;
use CloudCreativity\Utils\Value\Tests\StringValue;
use CloudCreativity\Utils\Value\ValueException;
use CloudCreativity\Utils\Value\ValueInterface;
use PHPUnit\Framework\TestCase;

class ValueTest extends TestCase
{

    public function testConstruct(): void
    {
        $value = new StringValue('abc');

        $this->assertSame('abc', (string) $value);
    }

    public function testFluentConstructor(): void
    {
        $this->assertTrue(StringValue::create('abc')->is('abc'));
    }

    public function testToString(): void
    {
        $this->assertSame('abc', (string) StringValue::create('abc')->toString());
    }

    public function testCastsSelf(): void
    {
        $expected = new StringValue('abc');
        $this->assertSame($expected, StringValue::cast($expected));
        $this->assertSame($expected, StringValue::nullable($expected));
    }

    public function testCastsScalar(): void
    {
        $expected = new StringValue('abc');
        $this->assertEquals($expected, StringValue::cast('abc'));
        $this->assertEquals($expected, StringValue::nullable('abc'));
    }

    public function testCastsValueObject(): void
    {
        $mock = $this->createMock(ValueInterface::class);
        $mock->expects($this->exactly(2))->method('get')->willReturn('abc');

        $this->assertEquals(new StringValue('abc'), StringValue::cast($mock));
        $this->assertEquals(new StringValue('abc'), StringValue::nullable($mock));
    }

    public function testNullableWithNull(): void
    {
        $this->assertNull(StringValue::nullable(null));
    }

    public function testConstructInvalid(): void
    {
        $this->expectException(ValueException::class);
        new StringValue('ab');
    }

    public function testIsNotStrict(): void
    {
        $value = new StringValue('123');

        $this->assertTrue($value->is(123));
    }

    public function testIsAny(): void
    {
        $value = new StringValue('abc');

        $this->assertTrue($value->is('def', 'ab', 'abc'));
        $this->assertFalse($value->is('def', 'ab'));
    }

    public function testIsAnyNotStrict(): void
    {
        $value = new StringValue('123');

        $this->assertTrue($value->is('abc', 123));
    }

    public function testIsNoArguments(): void
    {
        $this->expectException(\BadMethodCallException::class);
        StringValue::create('123')->is();
    }

    public function testEmpty(): void
    {
        $value = new IntegerValue(0);

        $this->assertTrue($value->isEmpty());
        $this->assertFalse($value->isNotEmpty());
    }

    public function testNotEmpty(): void
    {
        $value = new IntegerValue(1);

        $this->assertTrue($value->isNotEmpty());
        $this->assertFalse($value->isEmpty());
    }
}
