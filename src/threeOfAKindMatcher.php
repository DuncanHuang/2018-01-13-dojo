<?php
/**
 * Created by PhpStorm.
 * User: duncan
 * Date: 2019-01-14
 * Time: 13:47
 */

namespace App;

class threeOfAKindMatcher extends matcherAbstract
{
    public function isMatch()
    {
        if (count($this->numberGroup) == 3 && max($this->numberGroup) == 3) {
            $this->cardType  = 'ThreeOfAKind';
            $this->cardPoint = [array_flip($this->numberGroup)[3]];

            return true;
        }

        return false;
    }
}
