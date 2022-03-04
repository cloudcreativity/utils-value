# Change Log

All notable changes to this project will be documented in this file. This project adheres to
[Semantic Versioning](http://semver.org/) and [this changelog format](http://keepachangelog.com/).

## [2.2.0] - 2022-03-04

### Added

- New static `AbstractValue::nullable()` method. This casts the provided value to the value object, unless it is `null`.

### Changed

- Package tests are now run using Github actions instead of Travis.

### Fixed

- Removed deprecation message on `jsonSerialize()` return type for PHP 8.1.
- Fixed the argument type in the docblock for `ValueTrait::is()` and `ValueInterface::is()`.

## [2.1.0] - 2021-01-27

### Added

- Package now supports PHP 8.

## [2.0.0] - 2018-06-11

This package now requires PHP 7.1 or above.

### Changed

- Added PHP 7 return types to interface, trait and abstract class methods.

### Removed

- No longer support PHP 5.6 and 7.0.
- Deprecated mutable value objects have been removed.
- Removed the `isAny` method in favour of `is`.

## [1.2.0] - 2017-08-24

## Added

- The following methods have been added to value objects:
  - `toString` for fluently casting the object to a string.
  - `isAny` to check if the value is one of any number of provided values.
  - `isEmpty` to check if the value is empty.
  - `isNotEmpty` to check if the value is not empty.

## Deprecated

- Mutable value objects are deprecated and will be removed in 2.0

## [1.1.0] - 2017-07-25

### Added

- The following static methods have been added to both abstract classes:
  - `create` which is a fluent constructor.
  - `cast` which ensures the provided value is an instance of `static`.

## [1.0.0] - 2017-01-30

### Changed

- Minimum PHP version is now `5.6.0`.
- `ValueException` now extends `InvalidArgumentException`.
