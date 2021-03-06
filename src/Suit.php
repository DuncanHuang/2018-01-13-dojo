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
    private $lookup = [
        '2'  => 2,
        '3'  => 3,
        '4'  => 4,
        '5'  => 5,
        '6'  => 6,
        '7'  => 7,
        '8'  => 8,
        '9'  => 9,
        '10' => 10,
        'J'  => 11,
        'Q'  => 12,
        'K'  => 13,
        'A'  => 14,
    ];

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
            if ($matcher->isMatch() == true) {
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
                (string)$this->lookup[substr($card, 1)],
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
            new straightFlushMatcher($this->cards),
            new fourOfAKindMatcher($this->cards),
            new fullHouseMatcher($this->cards),
            new flushMatcher($this->cards),
            new straightMatcher($this->cards),
            new threeOfAKindMatcher($this->cards),
            new twoPairsMatcher($this->cards),
            new onePairMatcher($this->cards),
            new highCardMatcher($this->cards),
        ];
    }
}
