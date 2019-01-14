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

    public function test_FullHouse()
    {
        $this->suitShouldBe('H9,D9,C9,C4,D4', 'FullHouse', [9]);
    }

    public function test_ThreeOfAKind()
    {
        $this->suitShouldBe('D5,H5,C5,C3,S9', 'ThreeOfAKind', [5]);
    }

    public function test_TwoPairs()
    {
        $this->suitShouldBe('D5,S5,S8,C8,H7', 'TwoPairs', [8, 5, 7]);
    }

    public function test_OnePairs()
    {
        $this->suitShouldBe('D3,S6,S6,C8,H7', 'OnePair', [6, 8, 7, 3]);
    }

    public function test_HighCard()
    {
        $this->suitShouldBe('D3,S6,S10,C8,H7', 'HighCard', [10, 8, 7, 6, 3]);
    }

    private function suitShouldBe($cards, $cardType, $keyCards)
    {
        $suit = new Suit($cards);
        $this->assertEquals($cardType, $suit->getCardType());
        $this->assertEquals($keyCards, $suit->getKeyCards());
    }
}
