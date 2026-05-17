<?php

namespace alcamo\rdf_literal;

use alcamo\time\Duration;
use PHPUnit\Framework\TestCase;

class DurationLiteralTest extends TestCase
{
    public function testConstruct(): void
    {
        $data = new Duration('P40Y');

        $literal1 = new DurationLiteral($data);

        $this->assertNotSame($data, $literal1->getValue());

        $this->assertEquals($data, $literal1->getValue());

        $literal2 = clone $literal1;

        $this->assertNotSame($literal1->getValue(), $literal2->getValue());

        $this->assertEquals($data, $literal2->getValue());
    }
}
