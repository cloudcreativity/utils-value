# Change Log
All notable changes to this project will be documented in this file. This project adheres to
[Semantic Versioning](http://semver.org/) and [this changelog format](http://keepachangelog.com/).

## Unreleased

### Added
- The following static methods have been added to both abstract classes:
  - `create` which is a fluent constructor.
  - `cast` which ensures the provided value is an instance of `static`.

## [1.0.0] - 2017-01-30

### Changed
- Minimum PHP version is now `5.6.0`.
- `ValueException` now extends `InvalidArgumentException`.

## [0.2.0] - 2016-10-12

### Changed
- Now only supports scalar value objects, array value interfaces have been removed.
- Scalar values are now non-mutable by default, with mutability denoted by a specific interface.

## [0.1.0] - 2016-05-14
Initial release.

### Added
- Interfaces:
  - `CloudCreativity\Utils\Value\ValueInterface`
  - `CloudCreativity\Utils\Value\ScalarValueInterface`
  - `CloudCreativity\Utils\Value\ArrayValueInterface`
- Classes:
  - `CloudCreativity\Utils\Value\AbstractScalarValue`
