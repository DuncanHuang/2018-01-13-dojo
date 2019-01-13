<?php
/**
 * Created by PhpStorm.
 * User: duncan
 * Date: 2019-01-13
 * Time: 21:53
 */

namespace App;

use function Couchbase\defaultDecoder;
use function foo\func;

class Suit
{
    private $cards;
    private $cardType;
    private $cardPoint;
    private $typeList = [
        'straightFlush',
        'flush',
    ];

    /**
     * Suit constructor.
     * @param $cards
     */
    public function __construct($cards)
    {
        $this->cards = explode(',', $cards);
        $this->cards = array_map(function ($card) {
            return $card = [
                substr($card, 0, 1),
                substr($card, 1)
            ];
        }, $this->cards);

        usort($this->cards, function ($a, $b) {
            if ($a[1] == $b[1]) {
                return 0;
            }

            return ($a[1] < $b[1]) ? 1 : -1;
        });

        foreach ($this->typeList as $type) {
            if ($this->{$type}() == true) {
                break;
            }
        }
    }

    private function isFlush()
    {
        $typeCount = array_count_values(array_column($this->cards, '0'));
        if (count($typeCount) == 1) {
            return true;
        }

        return false;
    }

    public function getCardType()
    {
        return $this->cardType;
    }

    public function getCardPoint()
    {
        return $this->cardPoint;
    }

    private function isStraight()
    {
        $numberCount = array_count_values(array_column($this->cards, '1'));

        if (count($numberCount) == 5 && $this->cards[0][1] - $this->cards[4][1] == 4) {
            return true;
        }

        return false;
    }

    private function straightFlush()
    {
        if ($this->isStraight() == true && $this->isFlush() == true) {
            $this->cardType  = 'StraightFlush';
            $this->cardPoint = [$this->cards[0][1]];
            return true;
        }

        return false;
    }

    private function flush()
    {
        if ($this->isFlush() == true) {
            $this->cardType  = 'Flush';
            $this->cardPoint = array_column($this->cards, '1');
            return true;
        }

        return false;
    }
}
