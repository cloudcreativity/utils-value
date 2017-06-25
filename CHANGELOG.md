# Change Log
All notable changes to this project will be documented in this file. This project adheres to
[Semantic Versioning](http://semver.org/) and [this changelog format](http://keepachangelog.com/).

## [1.1.0] - 2017-07-25

### Added
- The following static methods have been added to both abstract classes:
  - `create` which is a fluent constructor.
  - `cast` which ensures the provided value is an instance of `static`.

## [1.0.0] - 2017-01-30

### Changed
- Minimum PHP version is now `5.6.0`.
- `ValueException` now extends `InvalidArgumentException`.

