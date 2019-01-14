<?php
/**
 * Created by PhpStorm.
 * User: duncan
 * Date: 2019-01-14
 * Time: 11:38
 */

namespace App;

class flushMatcher implements matcherInterface
{
    private $cardType;
    private $cardPoint;
    private $cards;

    public function isMatch($cards)
    {
        $this->cards = $cards;
        if ($this->isFlush() == true) {
            $this->cardType  = 'Flush';
            $this->cardPoint = array_column($this->cards, '1');

            return true;
        }

        return false;
    }

    public function getCardType()
    {
        return $this->cardType;
    }

    public function getKeyCards()
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
}
