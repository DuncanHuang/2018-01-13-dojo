<?php
/**
 * Created by PhpStorm.
 * User: duncan
 * Date: 2019-01-14
 * Time: 13:47
 */

namespace App;

class twoPairsMatcher extends matcherAbstract
{
    public function isMatch()
    {
        if (count($this->numberGroup) == 3 && max($this->numberGroup) == 2 && min($this->numberGroup) == 1) {
            $this->cardType = 'TwoPairs';
            $this->cardPoint = array_merge(
                array_keys($this->numberGroup, max($this->numberGroup)),
                array_keys($this->numberGroup, min($this->numberGroup))
            );

            return true;
        }

        return false;
    }
}
