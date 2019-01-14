<?php
/**
 * Created by PhpStorm.
 * User: duncan
 * Date: 2019-01-14
 * Time: 11:38
 */

namespace App;

class straightFlushMatcher extends matcherAbstract
{
    public function isMatch()
    {
        if ($this->isStraight() == true && $this->isFlush() == true) {
            $this->cardType  = 'StraightFlush';
            $this->cardPoint = array_column($this->cards, '1');

            return true;
        }

        return false;
    }
}
