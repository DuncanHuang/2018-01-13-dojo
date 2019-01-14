<?php
/**
 * Created by PhpStorm.
 * User: duncan
 * Date: 2019-01-14
 * Time: 13:47
 */

namespace App;

class fourOfAKindMatcher extends matcherAbstract
{
    public function isMatch()
    {
        if (count($this->typeGroup) == 4 && count($this->numberGroup) == 2 && max($this->numberGroup) == 4) {
            $this->cardType  = 'FourOfAKind';
            $this->cardPoint = [array_flip($this->numberGroup)[4]];

            return true;
        }

        return false;
    }
}
