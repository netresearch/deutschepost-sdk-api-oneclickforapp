# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## Unreleased

### Added

- Support for PHP 8

### Changed

- Extracting individual voucher labels from a multi-label response
  now requires the `Zend_Pdf` library to be installed separately.
  It is no longer directly required due to conflicts with the
  ZF1 framework shipped with Magento 2 (`magento/zendframework1`).

### Removed

- Support for PHP 7.1

## 1.0.1

### Changed

- Order service may throw a detailed service exception with web service error message.

## 1.0.0

Initial release
