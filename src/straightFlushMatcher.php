<?php
/**
 * Created by PhpStorm.
 * User: duncan
 * Date: 2019-01-14
 * Time: 11:38
 */

namespace App;

class straightFlushMatcher implements matcherInterface
{
    private $cardType;
    private $cardPoint;
    private $cards;

    public function isMatch($cards)
    {
        $this->cards = $cards;
        if ($this->isStraight() == true && $this->isFlush() == true) {
            $this->cardType  = 'StraightFlush';
            $this->cardPoint = array_column($this->cards, '1');

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

    private function isFlush()
    {
        $typeCount = array_count_values(array_column($this->cards, '0'));
        if (count($typeCount) == 1) {
            return true;
        }

        return false;
    }

    private function isStraight()
    {
        $numberCount = array_count_values(array_column($this->cards, '1'));

        if (count($numberCount) == 5 && $this->cards[0][1] - $this->cards[4][1] == 4) {
            return true;
        }

        return false;
    }
}
