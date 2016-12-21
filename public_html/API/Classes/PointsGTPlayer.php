<?php

/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 11/23/2016
 * Time: 5:38 AM
 */
class PointsGTPlayer
{
    public $playerName="";
    public $Points=0;
    public $carid=0;
    public $accountid=0;

    function __construct($sPlayerName, $sPoints, $sCarID,$saccountid)
    {
        if($saccountid!="")
        $this->accountid=$saccountid;
        if($sPlayerName!="")
        $this->playerName = $sPlayerName;
        if($sPoints!="")
        $this->Points = $sPoints;
        if($sCarID!="")
        $this->carid = $sCarID;
    }
}