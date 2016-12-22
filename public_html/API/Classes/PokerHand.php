<?php

/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 11/28/2016
 * Time: 10:32 PM
 */
class PokerHand
{
    public $fname;
    public $handID;
    public $hand;
    public $timestamp;
    public $handRank=0;
    public $isWinner;

    function __construct($handid,$handname,$card1,$card2,$card3,$card4,$card5,$card6,$card7,$isWinner,$timestamp)
    {

        $this->hand = array($card1,$card2,$card3,$card4,$card5,$card6,$card7);
        $this->fname = $handname;
        $this->handID= $handid;
        $this->isWinner=$isWinner;
        $this->timestamp=$timestamp;
    }
}