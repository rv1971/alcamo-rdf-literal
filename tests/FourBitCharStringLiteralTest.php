<?php

namespace alcamo\rdf_literal;

use alcamo\exception\SyntaxError;
use PHPUnit\Framework\TestCase;

class FourBitCharStringLiteralTest extends TestCase
{
    public function testException(): void
    {
        $this->expectException(SyntaxError::class);

        $this->expectExceptionMessage(
            '"123<@>" contains non-four-bit characters'
        );

        new FourBitCharStringLiteral('123<@>');
    }
}
