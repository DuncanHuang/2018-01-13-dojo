<?php
/**
 * Created by PhpStorm.
 * User: duncan
 * Date: 2019-01-13
 * Time: 21:53
 */

namespace App;

class Suit
{
    private $cards;
    private $cardType;
    private $keyCards;

    /**
     * Suit constructor.
     * @param $cards
     */
    public function __construct($cards)
    {
        $this->judge($cards);
    }

    /**
     * @param $cards
     */
    private function judge($cards)
    {
        $this->parseCards($cards);

        foreach ($this->cardTypeMatcher() as $matcher) {
            if ($matcher->isMatch($this->cards) == true) {
                $this->cardType = $matcher->getCardType();
                $this->keyCards = $matcher->getKeyCards();
                break;
            }
        }
    }

    public function getCardType()
    {
        return $this->cardType;
    }

    public function getKeyCards()
    {
        return $this->keyCards;
    }

    /**
     * @param $cards
     */
    private function parseCards($cards)
    {
        $cards = explode(',', $cards);
        $cards = array_map(function ($card) {
            return $card = [
                substr($card, 0, 1),
                substr($card, 1),
            ];
        }, $cards);

        usort($cards, function ($a, $b) {
            if ($a[1] == $b[1]) {
                return 0;
            }

            return ($a[1] < $b[1]) ? 1 : -1;
        });

        $this->cards = $cards;
    }

    private function cardTypeMatcher()
    {
        return [
            new straightFlushMatcher(),
            new flushMatcher(),
            new straightMatcher(),
        ];
    }
}
