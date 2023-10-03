# binarytool
Some tools for working with binary values.

## numbers.php

Usage:

`./numbers.php <integers>` - shows different representations of a number as 8, 16, 32 and 64bit integer. Note that LE Number shows a number as misinterpreted by using the wrong byte order.

The intention of this tool is to make it easier writing tests for binary protocols/file format, as especially the BE/LE Decimal values allow to easily define an expected result using chr() byte by byte.
