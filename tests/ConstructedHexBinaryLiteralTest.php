<?php

namespace alcamo\rdf_literal;

use alcamo\exception\InvalidType;
use PHPUnit\Framework\TestCase;

class ConstructedHexBinaryLiteralTest extends TestCase
{
    /**
     * @dataProvider basicsProvider
     */
    public function testBasics($value, $expectedString): void
    {
        $literal = new ConstructedHexBinaryLiteral($value);

        $this->assertSame(count($value), count($literal));

        $this->assertSame($expectedString, (string)$literal);

        $literal->rewind();

        foreach ($value as $item) {
            $this->assertNotSame($item, $literal->current());

            $this->assertEquals($item, $literal->current());

            $literal->next();
        }
    }

    public function basicsProvider(): array
    {
        return [
            [ [], '', '' ],
            [
                [
                    new LangStringLiteral('ciao', 'it'),
                    new StringLiteral(''),
                    new IntegerLiteral(42),
                    new HexBinaryLiteral('abcd'),
                    new Base64BinaryLiteral('Zm9v')
                ],
                '6369616FFFFF3432FFABCDFF666F6F'
            ]
        ];
    }
}
