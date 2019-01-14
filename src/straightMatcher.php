<?php
/**
 * Created by PhpStorm.
 * User: duncan
 * Date: 2019-01-14
 * Time: 11:38
 */

namespace App;

class straightMatcher extends matcherAbstract
{
    public function isMatch()
    {
        if ($this->isStraight() == true) {
            $this->cardType  = 'Straight';
            $this->cardPoint = array_column($this->cards, '1');

            return true;
        }

        return false;
    }
}
