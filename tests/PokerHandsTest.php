<?php
/**
 * Created by PhpStorm.
 * User: duncan
 * Date: 2019-01-14
 * Time: 00:23
 */

namespace Tests;

use App\PokerHands;
use PHPUnit\Framework\TestCase;

class PokerHandsTest extends TestCase
{
    protected function setUp()
    {
    }

    public function test_Draw_StraightFlush()
    {
        $pokerHands = new PokerHands();
        $actual = $pokerHands->getResult('S5,S6,S7,S8,S9', 'C5,C6,C7,C8,C9');
        $this->assertEquals('Draw, StraightFlush', $actual);
    }
}
