<?php
/**
 * Created by PhpStorm.
 * User: duncan
 * Date: 2019-01-14
 * Time: 13:47
 */

namespace App;

class highCardMatcher extends matcherAbstract
{
    public function isMatch()
    {
        if (count($this->numberGroup) == 5) {
            $this->cardType  = 'HighCard';
            $this->cardPoint = array_keys($this->numberGroup, min($this->numberGroup));

            return true;
        }

        return false;
    }
}
