<?php

namespace alcamo\rdf_literal;

use PHPUnit\Framework\TestCase;

class FloatLiteralTest extends TestCase
{
    public function testNull(): void
    {
        $this->assertSame(0.0, (new FloatLiteral())->getValue());
    }
}
