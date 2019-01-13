<?php
/**
 * Created by PhpStorm.
 * User: duncan
 * Date: 2019-01-14
 * Time: 00:23
 */

namespace App;

class PokerHands
{
    private $lookup = [
        'StraightFlush' => 1,
        'FourOfAKind'   => 2,
        'FullHouse'     => 3,
        'Flush'         => 4,
        'Straight'      => 5,
        'ThreeOfAKind'  => 6,
        'TwoPairs'      => 7,
        'OnePair'       => 8,
        'HighCard'      => 9,
    ];

    public function getResult($firstCards, $secondCards)
    {
        $firstSuit      = new Suit($firstCards);
        $firstSuitType  = $firstSuit->getCardType();
        $firstSuitPoint = $firstSuit->getCardPoint();

        $secondSuit      = new Suit($secondCards);
        $secondSuitType  = $secondSuit->getCardType();
        $secondSuitPoint = $secondSuit->getCardPoint();

        if ($this->lookup[$firstSuitType] == $this->lookup[$secondSuitType]) {
            return 'Draw, ' . $firstSuitType;
        }
    }
}
