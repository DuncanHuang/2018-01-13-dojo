<?php
/**
 * Created by PhpStorm.
 * User: duncan
 * Date: 2019-01-14
 * Time: 13:47
 */

namespace App;

class fullHouseMatcher extends matcherAbstract
{
    public function isMatch()
    {
        if (count($this->numberGroup) == 2 && max($this->numberGroup) == 3 && min($this->numberGroup) == 2) {
            $this->cardType  = 'FullHouse';
            $this->cardPoint = [array_flip($this->numberGroup)[3]];

            return true;
        }

        return false;
    }
}
