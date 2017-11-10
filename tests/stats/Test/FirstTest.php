<?php

namespace stats\Test;

class FirstTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider additionProvider
     */
    public function testMain($a, $b, $expected)
    {
        $this->assertEquals($expected, $a + $b);
    }

    public function additionProvider()
    {
        return [
            [1, 0, 1],
            [0, 1, 1],
            [0, 0, 0]
        ];
    }
}