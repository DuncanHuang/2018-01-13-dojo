<?php
/**
 * Created by PhpStorm.
 * User: duncan
 * Date: 2019-01-14
 * Time: 14:33
 */

namespace App;

class PokerHands
{
    private $lookup = [
        'StraightFlush' => 9,
        'FourOfAKind'   => 8,
        'FullHouse'     => 7,
        'Flush'         => 6,
        'Straight'      => 5,
        'ThreeOfAKind'  => 4,
        'TwoPairs'      => 3,
        'OnePair'       => 2,
        'HighCard'      => 1,
    ];

    public function getResult($firstCards, $secondCards)
    {
        $firstSuit      = new Suit($firstCards);
        $firstSuitType  = $firstSuit->getCardType();
        $firstSuitPoint = $firstSuit->getKeyCards();

        $secondSuit      = new Suit($secondCards);
        $secondSuitType  = $secondSuit->getCardType();
        $secondSuitPoint = $secondSuit->getKeyCards();

        if ($this->lookup[$firstSuitType] == $this->lookup[$secondSuitType]) {
            return 'Draw, ' . $firstSuitType;
        }
    }
}
