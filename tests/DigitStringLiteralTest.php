<?php

namespace alcamo\rdf_literal;

use alcamo\exception\SyntaxError;
use PHPUnit\Framework\TestCase;

class DigitStringLiteralTest extends TestCase
{
    public function testException1(): void
    {
        $this->expectException(SyntaxError::class);

        $this->expectExceptionMessage('"12345x6789" contains non-digits');

        new DigitStringLiteral('12345x6789');
    }

    public function testException2(): void
    {
        $this->expectException(SyntaxError::class);

        $this->expectExceptionMessage('"-12" contains non-digits');

        new DigitStringLiteral(-12);
    }
}
