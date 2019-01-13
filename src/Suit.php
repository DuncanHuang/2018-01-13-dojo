<?php
/**
 * Created by PhpStorm.
 * User: duncan
 * Date: 2019-01-13
 * Time: 21:53
 */

namespace App;

class Suit
{
    private $cards;
    private $cardType;
    private $cardPoint;
    private $typeList = [
        'straightFlush',
        'fourOfAKind',
        'fullHouse',
        'flush',
        'straight',
        'threeOfAKind',
        'twoPairs',
        'onePair',
        'highCard',
    ];
    private $typeGroup;
    private $numberGroup;
    private $lookup = [
        '2'  => 2,
        '3'  => 3,
        '4'  => 4,
        '5'  => 5,
        '6'  => 6,
        '7'  => 7,
        '8'  => 8,
        '9'  => 9,
        '10' => 10,
        'J'  => 11,
        'Q'  => 12,
        'K'  => 13,
        'A'  => 14,
    ];

    /**
     * Suit constructor.
     * @param $cards
     */
    public function __construct($cards)
    {
        $this->cards = explode(',', $cards);
        $this->cards = array_map(function ($card) {
            return $card = [
                substr($card, 0, 1),
                (string)$this->lookup[substr($card, 1)],
            ];
        }, $this->cards);

        usort($this->cards, function ($a, $b) {
            if ($a[1] == $b[1]) {
                return 0;
            }

            return ($a[1] < $b[1]) ? 1 : -1;
        });

        $this->typeGroup   = array_count_values(array_column($this->cards, '0'));
        $this->numberGroup = array_count_values(array_column($this->cards, '1'));

        foreach ($this->typeList as $type) {
            if ($this->{$type}() == true) {
                break;
            }
        }
    }

    private function isFlush()
    {
        if (count($this->typeGroup) == 1) {
            return true;
        }

        return false;
    }

    public function getCardType()
    {
        return $this->cardType;
    }

    public function getCardPoint()
    {
        return $this->cardPoint;
    }

    private function isStraight()
    {
        if (count($this->numberGroup) == 5) {
            if ($this->cards[0][1] - $this->cards[4][1] == 4) {
                return true;
            }

            if (
                array_sum(array_column(array_slice($this->cards, 1), '1')) == 14
                && $this->cards[0][1] == 14
            ) {
                return true;
            }
        }

        return false;
    }

    private function straightFlush()
    {
        if ($this->isStraight() == true && $this->isFlush() == true) {
            $this->cardType  = 'StraightFlush';
            $this->cardPoint = [$this->cards[0][1]];

            return true;
        }

        return false;
    }

    private function flush()
    {
        if ($this->isFlush() == true) {
            $this->cardType  = 'Flush';
            $this->cardPoint = array_column($this->cards, '1');

            return true;
        }

        return false;
    }

    private function straight()
    {
        if ($this->isStraight() == true) {
            $this->cardType  = 'Straight';
            $this->cardPoint = [$this->cards[0][1]];

            return true;
        }

        return false;
    }

    private function fourOfAKind()
    {
        if (count($this->typeGroup) == 4 && count($this->numberGroup) == 2 && max($this->numberGroup) == 4) {
            $this->cardType  = 'FourOfAKind';
            $this->cardPoint = [array_flip($this->numberGroup)[4]];

            return true;
        }

        return false;
    }

    private function fullHouse()
    {
        if (count($this->numberGroup) == 2 && max($this->numberGroup) == 3 && min($this->numberGroup) == 2) {
            $this->cardType  = 'FullHouse';
            $this->cardPoint = [array_flip($this->numberGroup)[3]];

            return true;
        }

        return false;
    }

    private function threeOfAKind()
    {
        if (count($this->numberGroup) == 3 && max($this->numberGroup) == 3) {
            $this->cardType  = 'ThreeOfAKind';
            $this->cardPoint = [array_flip($this->numberGroup)[3]];

            return true;
        }

        return false;
    }

    private function twoPairs()
    {
        if (count($this->numberGroup) == 3 && max($this->numberGroup) == 2 && min($this->numberGroup) == 1) {
            $this->cardType  = 'TwoPairs';
            $this->cardPoint = array_merge(
                array_keys($this->numberGroup, max($this->numberGroup)),
                array_keys($this->numberGroup, min($this->numberGroup))
            );

            return true;
        }

        return false;
    }

    private function onePair()
    {
        if (count($this->numberGroup) == 4 && max($this->numberGroup) == 2) {
            $this->cardType  = 'OnePair';
            $this->cardPoint = array_merge(
                array_keys($this->numberGroup, max($this->numberGroup)),
                array_keys($this->numberGroup, min($this->numberGroup))
            );

            return true;
        }

        return false;
    }

    private function highCard()
    {
        if (count($this->numberGroup) == 5) {
            $this->cardType  = 'HighCard';
            $this->cardPoint = array_keys($this->numberGroup, min($this->numberGroup));

            return true;
        }

        return false;
    }
}
