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
        $firstSuitPoint = $firstSuit->getKeyCards();

        $secondSuit      = new Suit($secondCards);
        $secondSuitType  = $secondSuit->getCardType();
        $secondSuitPoint = $secondSuit->getKeyCards();

        if ($this->suitFirstGreaterSecond($firstSuitType, $secondSuitType)) {
            return $this->firstPlayerSuitWin($firstSuitType, $secondSuitType);
        }

        if ($this->suitFirstLessSecond($firstSuitType, $secondSuitType)) {
            return $this->secondPlayerSuitWin($secondSuitType, $firstSuitType);
        }

        foreach ($firstSuitPoint as $key => $value) {
            if ($this->keyCardFirseGreaterSecond($firstSuitPoint, $key, $secondSuitPoint)) {
                return $this->firstPlayerKeyCardWin($firstSuitType, $firstSuitPoint, $key);
            } else if ($this->keyCardFirstLessSecond($firstSuitPoint, $key, $secondSuitPoint)) {
                return $this->secondPlayerKeyCardWin($firstSuitType, $secondSuitPoint, $key);
            }
        }

        return $this->draw($firstSuitType);
    }

    /**
     * @param $firstSuitType
     * @return string
     */
    private function draw($firstSuitType)
    {
        return 'Draw, ' . $firstSuitType;
    }

    /**
     * @param $firstSuitType
     * @param $firstSuitPoint
     * @param $key
     * @return string
     */
    private function firstPlayerKeyCardWin($firstSuitType, $firstSuitPoint, $key)
    {
        return $this->firstPlayerName . ' Win, ' . $firstSuitType . ', and key card is ' . $this->numberLookup[$firstSuitPoint[$key]];
    }

    /**
     * @param $firstSuitType
     * @param $secondSuitPoint
     * @param $key
     * @return string
     */
    private function secondPlayerKeyCardWin($firstSuitType, $secondSuitPoint, $key)
    {
        return $this->secondPlayerName . ' Win, ' . $firstSuitType . ', and key card is ' . $this->numberLookup[$secondSuitPoint[$key]];
    }

    /**
     * @param $firstSuitType
     * @param $secondSuitType
     * @return string
     */
    private function firstPlayerSuitWin($firstSuitType, $secondSuitType)
    {
        return $this->firstPlayerName . ' Win, ' . $firstSuitType . ' > ' . $secondSuitType;
    }

    /**
     * @param $secondSuitType
     * @param $firstSuitType
     * @return string
     */
    private function secondPlayerSuitWin($secondSuitType, $firstSuitType)
    {
        return $this->secondPlayerName . ' Win, ' . $secondSuitType . ' > ' . $firstSuitType;
    }

    /**
     * @param $firstSuitType
     * @param $secondSuitType
     * @return bool
     */
    private function suitFirstGreaterSecond($firstSuitType, $secondSuitType)
    {
        return $this->suitLookup[$firstSuitType] > $this->suitLookup[$secondSuitType];
    }

    /**
     * @param $firstSuitType
     * @param $secondSuitType
     * @return bool
     */
    private function suitFirstLessSecond($firstSuitType, $secondSuitType)
    {
        return $this->suitLookup[$firstSuitType] < $this->suitLookup[$secondSuitType];
    }

    /**
     * @param $firstSuitPoint
     * @param $key
     * @param $secondSuitPoint
     * @return bool
     */
    private function keyCardFirseGreaterSecond($firstSuitPoint, $key, $secondSuitPoint)
    {
        return $firstSuitPoint[$key] > $secondSuitPoint[$key];
    }

    /**
     * @param $firstSuitPoint
     * @param $key
     * @param $secondSuitPoint
     * @return bool
     */
    private function keyCardFirstLessSecond($firstSuitPoint, $key, $secondSuitPoint)
    {
        return $firstSuitPoint[$key] < $secondSuitPoint[$key];
    }
}
