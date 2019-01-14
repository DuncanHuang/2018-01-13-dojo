<?php
/**
 * Created by PhpStorm.
 * User: duncan
 * Date: 2019-01-14
 * Time: 11:39
 */

namespace App;

abstract class matcherAbstract implements matcherInterface
{
    protected $cardType;
    protected $cardPoint;
    protected $cards;
    protected $numberGroup;
    protected $typeGroup;

    /**
     * matcherAbstract constructor.
     * @param $cards
     */
    public function __construct($cards)
    {
        $this->cards       = $cards;
        $this->numberGroup = array_count_values(array_column($this->cards, '1'));
        $this->typeGroup   = array_count_values(array_column($this->cards, '0'));
    }

    public function getCardType()
    {
        return $this->cardType;
    }

    public function getKeyCards()
    {
        return $this->cardPoint;
    }

    protected function isStraight()
    {
        if (count($this->numberGroup) == 5 && $this->cards[0][1] - $this->cards[4][1] == 4) {
            return true;
        }

        return false;
    }

    protected function isFlush()
    {
        if (count($this->typeGroup) == 1) {
            return true;
        }

        return false;
    }
}
