# Upgrade Guide

This file provides notes on how to upgrade between versions.

## v1 to v2

### Mutable Value Objects

The mutable value object interface has been removed, along with the mutable value object trait and abstract 
class. If you want to keep your objects mutable, you will need to implement the interface/methods yourself.

### PHP 7 Return Types

The `ValueInterface`, `ValueTrait` and `AbstractValue` methods have all been updated to add PHP 7 return types.
You will need to update your classes to match these.

### `toString()`

The method `toString()` has been added to the `ValueInterface` to allow fluent conversion of a value object to
a string. This does not affect the abstract class and trait as they already had this method.

If you have any value objects where you have implemented the interface directly, you will need to add this method.

### `is()` and `isAny()`

The `ValueInterface::is()` method has been updated so that it now takes any number of values and will return
true if the value matches any of the provided values. We have updated the trait/abstract class accordingly,
but if you have overloaded this method, or implemented the interface directly, you will need to update your
classes.

The `ValueTrait::isAny()` method (also available on `AbstractValue`) has been removed in favour of using the
`is()` method.
