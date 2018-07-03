<?php

/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 11/2/2016
 * Time: 10:43 PM
 */

include 'moduleIncludes.php';
date_default_timezone_set('America/Los_Angeles');

class Scene
{
    //Unique Identifier for the record of the scene
    public $promoID;
    //Duration can either be loops or seconds
    public $sceneDuration;
    //Determines what kind of data will be stored in $sceneData
    public $sceneType;
    // When the scene was last updated;
    public $lastUpdated;
    //Will determine which unity scene will be displayed
    public $sceneID;
    //Will hold data relevant to the specific promotion
    public $promotionStatus;
    public $EffectID;
    public $kickForCashData;
    public $pointsGTData;
    public $highHandData;
    public $timeTargetData;
    public $timeTargetXData;
    public $monsterCarloData;
    public $PictureViewerData;
    public $DisplayListData;
    public $sceneSkin;


    //Database Global Variables
    private $conn;

    function __construct($promoID, $promo_type_id, $pSceneDuration, $pSkinId, $psceneID, $lastupdated, $pEffectID, $propertyId, $animation)
    {
        $dbcon = new DbCon();
        $this->conn = $dbcon->read_database();
        //Set Scene Variables
        $this->promoID = $promoID;
        $this->sceneDuration = $pSceneDuration;
        $this->sceneType = $promo_type_id;
        $this->sceneID = $psceneID;
        $this->EffectID = $pEffectID;
        if ($promoID != 0) {
            if (strlen($this->lastUpdated) > 5)
                $this->lastUpdated = $this->convertTime($lastupdated);
        }
        $this->animation = (bool)$animation;
        $this->skinDataID = $pSkinId;
        $this->sceneSkin = new Skin($psceneID, $pSkinId, $propertyId);


        //Query data for the scene and put relevant data in $sceneData
        switch ($promo_type_id) {
            //High Hand
            case 1:
                //$this->loadHighHandData();
                $this->highHandData = $this->loadHighHandData($promoID, true);
                break;
            //PointsGT
            case 4:
                $this->loadPointsGTData($promoID);
                break;
            //Picture Viewer
            case 5:
                $this->PictureViewerData = $this->loadPictureData($promoID);
                break;

            case 8:
                $this->loadPrizeEventData($promoID);
                break;
            //Jackpot Display
            case 10:
                break;
            case 11:
                $this->loadKickForCashData($promoID);
                break;
            case 9:
                $this->monsterCarloData = $this->loadMonsterCarloData($promoID);
                break;
            case 13:
                $this->MatchMadnessData = $this->loadMultiplierMadnessData($promoID);
                break;
            case 14:

                $this->timeTargetData = $this->loadTimeTargetData($promoID);
                break;
            case 15:
                $this->loadTimeTargetXData($promoID);
            case 17:
                $this->DisplayListData= $this->loadDisplayListData($promoID);
                break;
        }
    }

    function loadHighHandData($pSceneID, $loadMonsterCarlo)
    {
        $sql = 'SELECT * from high_hand where promotion_id=? order by high_hand.id desc limit 1';
        $statement = $this->conn->prepare($sql);
        //echo ("sceneid".$pSceneID);
        $statement->execute(array($pSceneID));
        $hhdata = new HighHand();
        $mmdata = new MonsterCarlo();
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {

            $hhdata->active = 1;
            $hhdata->id = $result['id'];
            $hhdata->session = $result['promotion_id'];
            $hhdata->payouts = $result['payout_value'];
            $hhdata->TitleMsg = $result['title_message'];
            $hhdata->sessionTimer = $result['session_timer'];
            $hhdata->isOdd = $result['high_hand_isodd'];
            $hhdata->preface = $result['high_hand_preface'];
            $hhdata->attachMC = $result['high_hand_attachmc'];
            $hhdata->secondstohorn = $result['horn_timer'];
            $hhdata->HandListType = $result['multiple_hands'];
            $hhdata->HHtype = $result['promotion_id'];
            $hhdata->paytype = $result['high_hand_paytype'];
            $hhdata->handcount = $result['high_hand_handcount'];

            $hhdata->LockToTime = $result['high_hand_locktotime'];
            $hhdata->loadHighHands($hhdata->session, $hhdata->handcount);
            if ($loadMonsterCarlo) {
                $tmpMonsterCarloID = $mmdata->findMonsterCarlo($hhdata->session);
                if ($tmpMonsterCarloID != 0) {
                    //echo($tmpMonsterCarloID);
                    $this->monsterCarloData = $this->loadMonsterCarloData($tmpMonsterCarloID);
                    $hhdata->paytype = 2;
                    $payouts = explode(",", $this->monsterCarloData->payout);
                    $hhdata->payouts = $payouts[count($this->monsterCarloData->cardList)];
                }
            }
        }

        return $hhdata;
    }

    function loadMultiplierMadnessData($pSceneID)
    {
        // public MmCardList cardList;
        $sql = 'SELECT * from multi_madness where multi_madness_promoid=? order by multi_madness_id desc limit 1';
        $statement = $this->conn->prepare($sql);
        //echo ("sceneid".$pSceneID);
        $statement->execute(array($pSceneID));
        $mmdata = new MatchMadness();
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {
            $mmdata->active = 1;
            $mmdata->id = $result['multi_madness_id'];
            $mmdata->session = $result['multi_madness_promoid'];
            //$mmdata->buzzerTimer;
            $mmdata->timerActive = 0;
            $mmdata->loadMMCards($mmdata->session);
        }
        return $mmdata;
    }
    function loadDisplayListData($pSceneID)
    {
        $pictureData = new PictureViewer();
        $sql = 'SELECT * from listdisplay where listdisplay_promoid=? order by listdisplay_id desc limit 1';
        $statement = $this->conn->prepare($sql);
        //echo ("sceneid".$pSceneID);
        $statement->execute(array($pSceneID));
        $dldata = new DisplayList();
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {
            $dldata->id = $result['listdisplay_promoid'];
            $dldata->text1 = $result['listdisplay_text1'];
            $dldata->text1Title = $result['listdisplay_text1title'];
            $dldata->ListData = $dldata->loadDataList($result['listdisplay_promoid']);
            $this->PictureViewerData = $this->loadPictureData($result['listdisplay_slideshowid']);

        }
        return $dldata;
    }
    function loadMonsterCarloData($pSceneID)
    {
        $sql = 'SELECT * from monster_carlo_settings where monster_carlo_settings_promotion_id=? order by monster_carlo_settings_id desc limit 1';
        $statement = $this->conn->prepare($sql);
        //echo ("sceneid".$pSceneID);
        $statement->execute(array($pSceneID));
        $mmdata = new MonsterCarlo();
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {
            $mmdata->active = 1;
            $mmdata->id = $result['monster_carlo_settings_id'];
            $mmdata->session = $result['monster_carlo_settings_promotion_id'];
            $mmdata->hhid = $result['monster_carlo_settings_hhid'];

            $mmdata->payout = $result['monster_carlo_settings_payouts'];
            if ($mmdata->hhid != 0) {
                $this->highHandData = $this->loadHighHandData($mmdata->hhid, false);
                $this->highHandData->payouts = $mmdata->payout;
                $this->highHandData->paytype = 2;
            }
            $mmdata->loadMonsterCarloCards($mmdata->hhid);
        }

        return $mmdata;
    }

    function loadPictureData($pSceneID)
    {

        $newData = new PictureViewer();
        $sql = 'SELECT * from picview_settings where picview_settings_promoid=? order by picview_settings_id desc limit 1';
        $statement = $this->conn->prepare($sql);
        $statement->execute(array($pSceneID));
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {
            $newData = new PictureViewer();
            $newData->ID = $result['picview_settings_id'];
            $newData->session = $result['picview_settings_promoid'];
            $newData->type = $result['picview_settings_type'];
            $newData->loadPictureData($newData->session);
        }
        return $newData;
    }

    function loadPrizeEventData($pSceneID)
    {
        $sql = 'SELECT * from prize_event where prize_event_promo_id=? order by prize_event_id desc limit 1';
        $statement = $this->conn->prepare($sql);
        //echo ("sceneid".$pSceneID);
        $statement->execute(array($pSceneID));
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {
            $this->PrizeEventData = new PrizeEvent();
            $this->PrizeEventData->ID = $result['prize_event_id'];
            $this->PrizeEventData->session = $result['prize_event_promo_id'];
            $this->PrizeEventData->Title = $result['prize_event_title'];
            $this->PrizeEventData->JackPotAmount = $result['prize_event_odoamount'];
            $this->PrizeEventData->IncrementNumber = $result['prize_event_incrementnumber'];
            $this->PrizeEventData->isOddHr = $result['prize_event_isoddhr'];
            $this->PrizeEventData->RandomPrize = $result['prize_event_randomprize'];
            $this->PrizeEventData->TimerType = $result['prize_event_timertype'];
            $this->PrizeEventData->clockRemainingVisible = $result['prize_event_clockvisible'];
            $this->PrizeEventData->NextTimeVisible = $result['prize_event_nexttimevisible'];
            $this->PrizeEventData->secondsToHorn = $result['prize_event_secondtohorn'];
            $this->PrizeEventData->loadPrizeWinners($this->PrizeEventData->session);
            if ($result['prize_event_useprizes']) {
                $this->PrizeEventData->JackPotAmount = $this->PrizeEventData->TotalPrizeAmount;
            }
        }
    }

    function loadTimeTargetData($pSceneID)
    {
        //If there is no data being shown its becuase there is no session.
        $tdata = new TimeTarget();
        $sql = 'SELECT * FROM `time_target_sessions`,time_target where time_target_archive=\'0\' and time_target_promoid=? and time_target_session_promoid=time_target_promoid ORDER BY time_target_session_id desc,time_target_id desc limit 1 ';
        $statement = $this->conn->prepare($sql);
        $statement->execute(array($pSceneID));
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {
            //$tdata->id = $result['time_target_session_id'];
            $tdata->id = $result['time_target_id'];
            $tdata->seed = $result['time_target_seed'];
            $tdata->startTime = $result['time_target_start'];
            $tdata->endTime = $result['time_target_end'];
            $tdata->min = $result['time_target_increment_min'];
            $tdata->add = $result['time_target_add'];
            $tdata->title = $result['time_target_title'];
            $tdata->contentTitle = $result['time_target_contenttitle'];
            $tdata->content = $result['time_target_content'];
            $tdata->cards = $result['time_target_cards'];
            $tdata->MaxPayout = $result['time_target_maxpayout'];
            $tdata->progressive = $result['time_target_progressive'];
            $tdata->defhour = $result['time_target_def_hour'];
            $tdata->defmin = $result['time_target_def_minute'];
            $tdata->valoption = $result['time_target_valoption'];
            $tdata->otherPromoID = $result['time_target_multpromoid'];
            $tdata->useMult = $result['time_target_usemult'];
            $tdata->multiplier = $result['time_target_multiplier'];

            $date1 = new DateTime($result['time_target_lastcardchange']);
            $date3 = new DateTime(date('Y-m-d H:i:s'));
            if ($result['time_target_usemult'] == 1&&$result['time_target_usemult']!=0&&$tdata->multiplier!=0 ) {
                $subtt = new TimeTarget();
                $subtt = $this->loadTimeTargetData($tdata->otherPromoID);
                $tdata->seed = $subtt->seed * $tdata->multiplier;
                $tdata->add = $subtt->add * $tdata->multiplier;
                $tdata->startTime = $subtt->startTime;
                $tdata->endTime = $subtt->endTime;
                $tdata->min = $subtt->min;
            }
            if ($result['time_target_randomcard'] == 1) {
                if ($this->dateDifference($date3, $date1) > 0) {
                    $tdata->updateCard();
                } else {
                    //echo($this->dateDifference($date3, $date1)."-".$date3->format('Y-m-d H:i:s')."*".$date1->format('Y-m-d H:i:s')."*");
                };
            }


        }
        return $tdata;
    }

    function loadTimeTargetXData($pSceneID)
    {

        //$sql = "Select * from promotion,promo_property where promotion.promotion_id=promo_property.promo_property_promo_id AND promo_property.promo_property_property_id = (select promo_property_property_id from promo_property where promo_property_promo_id=?) and promotion_type_id='14' and promotion_status='1' and promotion.promotion_visible='1' limit 4";
        $sql = "select * from promotion p where p.promotion_parent =?";
        //echo("sql:".$sql);
        $statement = $this->conn->prepare($sql);
        $statement->execute(array($pSceneID));
        $this->timeTargetXData = new TimeTargetX();
        $parentTdata = new TimeTarget();
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {
            //echo("found");
            $tdata = $this->loadTimeTargetData($result['promotion_id']);
            if(count($this->timeTargetXData->TimeTargetData)==0){
                $parentTdata = clone $tdata;
            }

            if($tdata->cards=="PC"){
                $card = $parentTdata->cards;
            }else{
                $card = $tdata->cards;
            }
            switch ($tdata->valoption){
                case 0:
                    $tdata->cards=$card;
                    break;
                case 1:
                    $tdata->cards=substr($card, -1) ;
                    break;
                case 2:
                    $tdata->cards=substr($card, 0,-1) ;
                    //echo("tcard:".$card);
                    break;
            }
            array_push($this->timeTargetXData->TimeTargetData,$tdata);
        }
    }

    function loadPointsGTData($pSceneID)
    {

        $sql = 'SELECT * FROM `points_gt` where pgt_promotion_id=? ORDER by points_gt.pgt_id DESC limit 1';
        $statement = $this->conn->prepare($sql);
        $statement->execute(array($pSceneID));

        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {
            $this->pointsGTData = new PointsGT();
            $date1 = new DateTime($result['pgt_race_begin']);
            $date2 = new DateTime($result['pgt_race_end']);
            $date3 = new DateTime(date('Y-m-d H:i:s'));

            if ($date3 > $date2) {
                $this->pointsGTData->finished = True;
            } else {
                $this->pointsGTData->finished = False;
            }
            if ($date1 > $date3) {
                $dt = 0;
            } else {
                $dt = $this->dateDifference($date3, $date1, '%d') + 1;
            }

            $this->pointsGTData->DaysInSession = $this->dateDifference($date2, $date1, '%d') + 1;
            if ($dt > $this->dateDifference($date2, $date1, '%d') + 1) {
                $dt = $this->dateDifference($date2, $date1, '%d') + 1;
                $fin = true;
                //echo("is");
            } else {
                //echo("is not");
                $fin = false;
            }
            //echo("dt:".$dt." - dd ".());
            $this->pointsGTData->DayOfSession = $dt;
            $this->pointsGTData->finished = false;
            $this->pointsGTData->lastUpdated = $result['pgt_timestamp'];
            $this->pointsGTData->title = $result['pgt_title'];
            $this->pointsGTData->Value1 = $result['pgt_subtitle'];
            $this->pointsGTData->Value2 = $result['pgt_left_content'];
            $this->pointsGTData->Value2Title = $result['pgt_left_title'];
            $this->pointsGTData->Value3 = $result['pgt_right_content'];
            $this->pointsGTData->Value3Title = $result['pgt_right_title'];
            $this->pointsGTData->SpriteAtlas = $result['pgt_atlas'];
            $this->pointsGTData->PayoutList = $result['pgt_payout'];
            $this->pointsGTData->StartDate = $result['pgt_race_begin'];
            $this->pointsGTData->datestart = $date3;
            $this->pointsGTData->dateend = $date2;
            $this->pointsGTData->datenow = $date3;
            if ($result['pgt_enable_instant_winners']) {
                $this->pointsGTData->InstantWinners = $this->getPointsGTInstantWinners($pSceneID);
            }

            //$sPlayerName, $sPoints, $sCarID,$saccountid

        }
        $sql = 'SELECT * FROM points_gt_players where points_gt_players.pgt_id=? ORDER by pgt_current_points DESC,points_gt_player_timestamp DESC limit 20';
        $statement = $this->conn->prepare($sql);
        $statement->execute(array($pSceneID));
        $tmpPlayerList = array();
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {
            $tmpPlayer = new PointsGTPlayer(trim($result['pgt_player_name']), $result['pgt_current_points'], $result['pgt_car_icon'], $result['pgt_account_id']);
            array_push($tmpPlayerList, $tmpPlayer);
        }
        if (!empty($tmpPlayerList))
            $this->pointsGTData->playerListJson = $tmpPlayerList;
    }

    function dateDifference($date_1, $date_2, $differenceFormat = '%d')
    {
        $interval = date_diff($date_1, $date_2);
        return $interval->format($differenceFormat);

    }

    function getPointsGTInstantWinners($pSceneID)
    {

        $sql = 'SELECT * FROM points_gt_instant_winner where pgt_id=? ORDER BY
               pgt_points DESC limit 3';
        $statement = $this->conn->prepare($sql);
        $statement->execute(array($pSceneID));
        $tmpInstantWinnerList = array();
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {
            if ($result['pgt_enable_instant_winner'] == '1') {
                $tmpInstantWinner = new PgtInstantWinner($result['pgt_points'], $result['pgt_prize_amount'], $result['pgt_color']);
                array_push($tmpInstantWinnerList, $tmpInstantWinner);
            }

        }
        return $tmpInstantWinnerList;
    }

    function loadKickForCashData($pSceneID)
    {

        $sql = 'SELECT * from kick_for_cash where kfc_promotion_id=? order by kfc_id DESC limit 1';
        $statement = $this->conn->prepare($sql);
        $statement->execute(array($pSceneID));
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {
            $this->kickForCashData = new KickForCash();
            $this->kickForCashData->fieldPosition = $result['kfc_failedattempts'];
            $this->kickForCashData->jackpotAmount = $result['kfc_cash_prize'];
            $this->kickForCashData->peAtSign = $result['kfc_vs'];;
            $this->kickForCashData->peLabel = $result['kfc_gamelabel'];;
            $this->kickForCashData->peTeam1 = $result['kfc_team1'];;
            $this->kickForCashData->peTeam2 = $result['kfc_team2'];;
            $this->kickForCashData->playerName = $result['kfc_name'];;
            $this->kickForCashData->selectedBall = $result['kfc_chosen_number'];;
            $this->kickForCashData->winningBall = $result['kfc_target_number'];
        }


    }

    function convertTime($time)
    {
        $dt = new DateTime($time, new DateTimeZone('UTC'));

// change the timezone of the object without changing it's time
        $dt->setTimezone(new DateTimeZone('America/Los_Angeles'));

// format the datetime
        return $dt->format('Y-m-d h:ia T');

    }
}