<?php

namespace alcamo\rdf_literal;

use alcamo\exception\SyntaxError;
use PHPUnit\Framework\TestCase;

class BooleanLiteralTest extends TestCase
{
    /**
     * @dataProvider constructProvider
     */
    public function testConstruct($value, $expectedValue): void
    {
        $literal = new BooleanLiteral($value);

        $this->assertSame($expectedValue, $literal->getValue());
    }

    public function constructProvider(): array
    {
        return [
            [ false, false ],
            [ true, true ],
            [ 0, false ],
            [ 1, true ],
            [ '0', false ],
            [ '1', true ],
            [ 'false', false ],
            [ 'true', true ]
        ];
    }

    public function testException(): void
    {
        $this->expectException(SyntaxError::class);

        $this->expectExceptionMessage(
            '"TRUE" is not a valid boolean'
        );

        new BooleanLiteral('TRUE');
    }
}
