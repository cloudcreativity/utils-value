[![Build Status](https://travis-ci.org/cloudcreativity/utils-value.svg?branch=master)](https://travis-ci.org/cloudcreativity/utils-value)

# cloudcreativity/utils-value

A small library to handle scalar values that have meaning.

## Values

It is common to handle scalar values that have particular meaning to your
application. For instance, if objects in your applications expect a string
that can only be one of several different string values - e.g. `lead`,
`follow` for describing dance roles - then any object that expects those values
would always have to check that the string received matches those two options.
For example:

``` php
public function setRole($value) {
  if (!in_array($value, ['lead', 'follow'])) {
    throw new \InvalidArgumentException('Expecting a valid dance role.');
  }

  // ...
}
```

This becomes highly repetitive - plus if you wanted to add `either` as a valid
value, you'd need to update it in every `in_array()` call across the
application.

This is where we'd use the `CloudCreativity\Utils\Value\AbstractValue`
class from this package. For example:

``` php
use CloudCreativity\Utils\Value\AbstractValue;

class DanceRole extends AbstractValue
{
  
  protected function accept($value): bool
  {
    return in_array($value, ['lead', 'follow'], true);
  }
}
```

The original setter shown above would then become:

``` php
public function setRole(DanceRole $role)
{
  // no need to check it as we know it is valid.
}
```

## Helper Methods

Quite often we find it is useful for the value object to have helper methods. By implementing
these on the value object, they become available to any part of your application that
receives an instance of the value.

For instance, or `DanceRole` object could look like this:

``` php
class DanceRole extends AbstractValue
{

  public function isLead(): bool
  {
    return $this->is('lead');
  }

  public function isFollow(): bool
  {
    return $this->is('follow');
  }

  // ... 
}
```

## Trait

If you do not want to extend the abstract class, the majority of methods are available via the `ValueTrait`.

## Interface

This package defines an interface, `ValueInterface`, to ensure consistency across value objects:

- `__toString()` : so that a scalar value can always be written to a string.
- `toString()` : so that a scalar value can fluently be cast to a string.
- `jsonSerialize()` : so that a scalar value can always be cast properly when being JSON encoded.
- `get()` : gets the underlying scalar value, e.g. would return a string if the value object holds a string.
- `is(...$values)` : compares provided values to the underlying scalar value, returning `true` if the value matches
any of them.

