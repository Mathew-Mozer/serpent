<?php

/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 1/20/2017
 * Time: 8:27 AM
 */
class PgtInstantWinner
{
    public $PrizeAmount=0;
    public $PointAmount=0;
    public $IconColor="";

    function __construct($sPoints, $sPrize, $sColor)
    {
        if($sPoints!="")
            $this->PointAmount=$sPoints;
        if($sPrize!="")
            $this->PrizeAmount = $sPrize;
        if($sColor!="")
            $this->IconColor = $sColor;
    }
}

