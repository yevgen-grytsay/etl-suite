# Extract/Transform/Load Suite

[![Build Status](https://travis-ci.org/yevgen-grytsay/etl-suite.svg?branch=master)](https://travis-ci.org/yevgen-grytsay/etl-suite)

Contains various ETL tools.

This is a very early version. Lacks of comments, documentation, tests and usage examples.


## Tools
* Buffer: holds and flushes objects.
* Filter: decides whether an object should be filtered.
* Iterator: iterates over input data portions (e.g. lines of file, elements of an array etc.)
* Lookup: performs lookup (e.g. in database, filesystem etc.) based on input data.
* Merge: merges two arrays into one in various ways.
* Transformer: transforms input data in various ways (e.g. changes the names of keys, unsets or adds some elements etc.)
* Value Mapper: maps values to some other values.

## Usage
TODO

## Installation

### Via Composer
```
composer require yevgen-grytsay/etl-suite
```