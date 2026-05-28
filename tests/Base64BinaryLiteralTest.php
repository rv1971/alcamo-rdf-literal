<?php

namespace alcamo\rdf_literal;

use alcamo\binary_data\ImmutableBinaryString;
use PHPUnit\Framework\TestCase;

class Base64BinaryLiteralTest extends TestCase
{
    public function testConstruct(): void
    {
        $data = new ImmutableBinaryString('Foo');

        $literal1 = new Base64BinaryLiteral($data);

        $this->assertNotSame($data, $literal1->getValue());

        $this->assertEquals($data, $literal1->getValue());

        $literal2 = clone $literal1;

        $this->assertNotSame($literal1->getValue(), $literal2->getValue());

        $this->assertEquals($data, $literal2->getValue());
    }
}
