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
    private $firstPlayerName;
    private $secondPlayerName;

    /**
     * PokerHands constructor.
     * @param $firstPlayerName
     * @param $secondPlayerName
     */
    public function __construct($firstPlayerName = null, $secondPlayerName = null)
    {
        $this->firstPlayerName  = $firstPlayerName;
        $this->secondPlayerName = $secondPlayerName;
    }

    public function getResult($firstCards, $secondCards)
    {
        $firstSuit      = new Suit($firstCards);
        $firstSuitType  = $firstSuit->getCardType();
        $firstSuitPoint = $firstSuit->getKeyCards();

        $secondSuit      = new Suit($secondCards);
        $secondSuitType  = $secondSuit->getCardType();
        $secondSuitPoint = $secondSuit->getKeyCards();

        if ($this->lookup[$firstSuitType] > $this->lookup[$secondSuitType]) {
            return $this->firstPlayerName . ' Win, ' . $firstSuitType . ' > ' . $secondSuitType;
        }

        if ($this->lookup[$firstSuitType] == $this->lookup[$secondSuitType]) {
            foreach ($firstSuitPoint as $key => $value) {
                if ($firstSuitPoint[$key] > $secondSuitPoint[$key]) {
                    return $this->firstPlayerName . ' Win, ' . $firstSuitType . ', and key card is ' . $firstSuitPoint[$key];
                }
            }

            return 'Draw, ' . $firstSuitType;
        }
    }
}
