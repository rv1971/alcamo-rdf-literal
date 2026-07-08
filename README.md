# Usage example

~~~
use alcamo\rdf_literal\LiteralFactory;

include $_composer_autoload_path ?? __DIR__ . '/../vendor/autoload.php';

$factory = new LiteralFactory();

$number = $factory->create(1970);

echo $number . PHP_EOL;

echo $number->getDatatypeUri() . PHP_EOL;

$year = $factory->create(1970, LiteralFactory::XSD_NS . 'gYear');

echo $year . PHP_EOL;

echo $year->getDatatypeUri() . PHP_EOL;

echo "Literals are "
    . ($year->equals($number) ? '' : 'not')
    . ' equal' . PHP_EOL;
~~~

This example is contained in this package as a file in the `bin`
directory. It will output

~~~
1970
http://www.w3.org/2001/XMLSchema#integer
1970
http://www.w3.org/2001/XMLSchema#gYear
Literals are not equal
~~~

# Overview

The classes that implement `LiteralInterface` represent the concept of
[RDF Literals](https://www.w3.org/TR/2014/REC-rdf11-concepts-20140225/#section-Graph-Literal), i.e. data elements that have a datataype and may have a
language tag.

Among others, this allows to:
* Create values of various types from strings, governed by an XSD
  datatype URI.
* Add a `__toString()` function to values which are not stringable by nature.
* Add a custom `__toString()` function which differs from the default
  representation of a value.
* Distinguish values that may be represented the same way in PHP but
  have different meanings.

See the doxygen documentation for details.

The literal classes in this package do not check whether the given
datatype is actually supported by the class, i.e. derived from the
class's default datatype. This is a deliberate design decision, on the
one hand to obtain lightweight literal classes, on the other hand to
avoid a bidirectional dependency between this package and
[alcamo/dom](github.com/rv1971/alcamo-dom).

The
[alcamo/rdf-literal-workbench](https://github.com/rv1971/alcamo-rdf-literal-workbench)
package is provided to create and validate literal objects based on
knowledge of an XML Schema.
