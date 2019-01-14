<?php
/**
 * Created by PhpStorm.
 * User: duncan
 * Date: 2019-01-14
 * Time: 13:47
 */

namespace App;

class onePairMatcher extends matcherAbstract
{
    public function isMatch()
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
}
