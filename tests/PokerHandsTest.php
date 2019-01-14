<?php
/**
 * Created by PhpStorm.
 * User: duncan
 * Date: 2019-01-14
 * Time: 14:33
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

    public function test_FirstWin_StraightFlush_FourOfAKind()
    {
        $pokerHands = new PokerHands('Duncan', 'Mars');
        $actual = $pokerHands->getResult('S5,S6,S7,S9,S8', 'C5,D5,H5,S5,S3');
        $this->assertEquals('Duncan Win, StraightFlush > FourOfAKind', $actual);
    }

}
