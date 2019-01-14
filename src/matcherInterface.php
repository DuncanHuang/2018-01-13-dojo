<?php
/**
 * Created by PhpStorm.
 * User: duncan
 * Date: 2019-01-14
 * Time: 11:39
 */

namespace App;

interface matcherInterface
{
    public function isMatch($cards);

    public function getCardType();

    public function getKeyCards();
}
