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
        $this->suitShouldBe('H5,H3,H8,H2,H4', 'Flush', [8, 5, 4, 3, 2]);
    }

    public function test_StraightFlush()
    {
        $this->suitShouldBe('H3,H4,H5,H6,H7', 'StraightFlush', [7, 6, 5, 4, 3]);
    }

    public function test_Straight()
    {
        $this->suitShouldBe('H3,H4,D5,S6,H7', 'Straight', [7, 6, 5, 4, 3]);
    }

    public function test_FourOfAKind()
    {
        $this->suitShouldBe('H7,D7,S7,C7,S8', 'FourOfAKind', [7]);
    }

    private function suitShouldBe($cards, $cardType, $keyCards)
    {
        $suit = new Suit($cards);
        $this->assertEquals($cardType, $suit->getCardType());
        $this->assertEquals($keyCards, $suit->getKeyCards());
    }
}
