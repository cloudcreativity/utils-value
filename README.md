# cloudcreativity/utils-value

A small library to handle:
  - Scalar values that have meaning.
  - Array values that have fixed/expected content.

## Scalar Values

It's common to handle scalar values that have particular meaning to your
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

This is where we'd use the `CloudCreativity\Utils\Value\AbstractScalarValue`
class from this package. For example:

``` php
use CloudCreativity\Utils\Value\AbstractScalarValue;

class DanceRole extends AbstractScalarValue
{

  public static function isValid($value)
  {
    return in_array($value, ['lead', 'follow'], true);
  }

  public function isLead()
  {
    return $this->is('lead');
  }

  public function isFollow()
  {
    return $this->is('follow');
  }
}
```

> Note we can add helper methods to the scalar value that can then be used
anywhere in the application.

The original setter shown above would then become:

``` php
public function setRole(DanceRole $role)
{
  // no need to check it as we know it's valid.
}
```

## Array Values

This package also contains an interface for defining objects that represent
arrays that have fixed or expected content. The interface is:
`CloudCreativity\Utils\Value\ArrayValueInterface`

We tend to use this on objects that have getters and setters for individual
values, but which can be constructed by taking an array (either from input
such as JSON or configuration arrays) and passing it into the object.
