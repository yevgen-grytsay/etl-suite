# Extract/Transform/Load Suite

[![Build Status](https://travis-ci.org/yevgen-grytsay/etl-suite.svg?branch=master)](https://travis-ci.org/yevgen-grytsay/etl-suite)

Contains various ETL tools.

The library does not provide the tools for creating and running jobs.
For more information refer the `Tools` section.

This is a very early version. Lacks of comments, documentation, tests and usage examples.

## Tools
* Buffer: holds and flushes objects.
* Filter: decides whether an object should be filtered.
* Iterator: iterates over input data portions (e.g. lines of file, elements of an array etc.)
* Lookup: performs lookup (e.g. in database, filesystem etc.) based on input data.
* Merge: merges two arrays into one in various ways.
* Transformer: transforms input data in various ways (e.g. changes the names of keys, unsets or adds some elements etc.)
* Value Mapper: maps values to some other values.

## Installation

### Via Composer
```
composer require yevgen-grytsay/etl-suite
```

## Examples

A few examples can be found in `examples` directory.

Generally an example consists of a main script file `main.php` and some auxiliary classes and files.


Also each example has his own `README.md` file
with brief explanation.
