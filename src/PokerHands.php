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
    private $suitLookup = [
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
    private $numberLookup = [
        2  => '2',
        3  => '3',
        4  => '4',
        5  => '5',
        6  => '6',
        7  => '7',
        8  => '8',
        9  => '9',
        10 => '10',
        11 => 'J',
        12 => 'Q',
        13 => 'K',
        14 => 'A',
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
        $firstSuitPoint = $firstSuit->getCardPoint();

        $secondSuit      = new Suit($secondCards);
        $secondSuitType  = $secondSuit->getCardType();
        $secondSuitPoint = $secondSuit->getCardPoint();

        if ($this->suitLookup[$firstSuitType] == $this->suitLookup[$secondSuitType]) {
            foreach ($firstSuitPoint as $key => $value) {
                if ($firstSuitPoint[$key] > $secondSuitPoint[$key]) {
                    return $this->firstPlayerName . ' Win, ' . $firstSuitType . ', and key card is ' . $this->numberLookup[$firstSuitPoint[$key]];
                } else if ($firstSuitPoint[$key] < $secondSuitPoint[$key]) {
                    return $this->secondPlayerName . ' Win, ' . $firstSuitType . ', and key card is ' . $this->numberLookup[$secondSuitPoint[$key]];
                }
            }

            return 'Draw, ' . $firstSuitType;
        }

        if ($this->suitLookup[$firstSuitType] > $this->suitLookup[$secondSuitType]) {
            return $this->firstPlayerName . ' Win, ' . $firstSuitType . ' > ' . $secondSuitType;
        }
    }
}
