<?php

namespace alcamo\rdf_literal;

use PHPUnit\Framework\TestCase;

class DateTimeLiteralTest extends TestCase
{
    public function testConstruct(): void
    {
        $data1 = new \DateTimeImmutable('2026-05-17T09:57-06:00');

        $literal1 = new DateTimeLiteral($data1);

        $this->assertSame($data1, $literal1->getValue());

        $data2 = new \DateTime('2026-05-17T10:10-06:00');

        $literal2 = new DateTimeLiteral($data2);

        $this->assertInstanceOf(
            \DateTimeImmutable::class,
            $literal2->getValue()
        );

        $this->assertEquals($data2, $literal2->getValue());

        $data3 = '2026-05-17T10:12-06:00';

        $literal3 = new DateTimeLiteral($data3);

        $this->assertInstanceOf(
            \DateTimeImmutable::class,
            $literal3->getValue()
        );

        $this->assertEquals(
            new \DateTimeImmutable($data3),
            $literal3->getValue()
        );
    }

    public function testBasics(): void
    {
        $literal = new DateTimeLiteral('2026-02-16T19:56+01:00');

        $this->assertSame(
            '2026',
            $literal->format('Y')
        );
    }
}
