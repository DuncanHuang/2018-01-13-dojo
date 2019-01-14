<?php
/**
 * Created by PhpStorm.
 * User: duncan
 * Date: 2019-01-13
 * Time: 21:54
 */

namespace Tests;

use App\Suit;
use PHPUnit\Framework\TestCase;

class SuitTest extends TestCase
{
    protected function setUp()
    {
    }

    public function test_Flush()
    {
        $suit = new Suit('H5,H3,H8,H2,H4');
        $this->assertEquals('Flush', $suit->getCardType());
        $this->assertEquals([8, 5, 4, 3, 2], $suit->getCardPoint());
    }

    public function test_StraightFlush()
    {
        $suit = new Suit('H3,H4,H5,H6,H7');
        $this->assertEquals('StraightFlush', $suit->getCardType());
        $this->assertEquals([7, 6, 5, 4, 3], $suit->getCardPoint());
    }

    public function test_Straight()
    {
        $suit = new Suit('H3,H4,D5,S6,H7');
        $this->assertEquals('Straight', $suit->getCardType());
        $this->assertEquals([7, 6, 5, 4, 3], $suit->getCardPoint());
    }

}
