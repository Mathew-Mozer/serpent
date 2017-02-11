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
    public $sceneSkin;


    //Database Global Variables
    private $conn;


    function __construct($promoID, $promo_type_id, $pSceneDuration, $pSkinId, $psceneID, $lastupdated, $pEffectID, $propertyId,$animation)
    {
        //Set Scene Variables
        $this->promoID = $promoID;
        $this->sceneDuration = $pSceneDuration;
        $this->sceneType = $promo_type_id;
        $this->sceneID = $psceneID;
        $this->EffectID = $pEffectID;
        $this->lastUpdated = $lastupdated;
        $this->animation = (bool)$animation;
        $this->sceneSkin = new Skin($psceneID, $pSkinId, $propertyId);

        //Query data for the scene and put relevant data in $sceneData
        switch ($promo_type_id) {
            //High Hand
            case 1:
                //$this->loadHighHandData();
                $this->loadHighHandData($promoID);
                break;
            //PointsGT
            case 4:
                $this->loadPointsGTData($promoID);
                break;
            //Monster Carlo
            case 9:
                break;
            //Jackpot Display
            case 10:
                break;
            case 11:
                $this->loadKickForCashData($promoID);
                break;
            case 14:
                $this->loadTimeTargetData($promoID);
                break;
        }
    }

    function loadHighHandData($pSceneID)
    {
        global $conn;

        $dbcon = new DbCon();
        $conn = $dbcon->read_database();
        $sql = 'SELECT * from high_hand where promotion_id=? order by high_hand.id desc limit 1';
        $statement = $conn->prepare($sql);
        //echo ("sceneid".$pSceneID);
        $statement->execute(array($pSceneID));
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {
            $this->highHandData = new HighHand();
            $this->highHandData->active = 1;
            $this->highHandData->id = $result['id'];
            $this->highHandData->session = $result['promotion_id'];
            $this->highHandData->payouts = $result['payout_value'];
            $this->highHandData->TitleMsg = $result['title_message'];
            $this->highHandData->sessionTimer = $result['session_timer'];
            $this->highHandData->isOdd = $result['high_hand_isodd'];
            $this->highHandData->preface = $result['high_hand_preface'];
            $this->highHandData->attachMC = $result['high_hand_attachmc'];
            $this->highHandData->secondstohorn = $result['horn_timer'];
            $this->highHandData->HandListType = $result['multiple_hands'];
            $this->highHandData->HHtype = $result['promotion_id'];
            $this->highHandData->paytype = $result['high_hand_paytype'];
            $this->highHandData->handcount = $result['high_hand_handcount'];
            $this->highHandData->loadHighHands($this->highHandData->session, $this->highHandData->handcount);
        }
    }

    function loadTimeTargetData($pSceneID)
    {
        global $conn;

        $dbcon = new DbCon();
        $conn = $dbcon->read_database();
        $sql = 'SELECT * FROM `time_target_sessions`,time_target where time_target_archive=\'0\' and time_target_promoid=? and time_target_session_promoid=time_target_promoid ORDER BY time_target_session_id desc,time_target_id desc limit 1 ';
        $statement = $conn->prepare($sql);
        //echo ("sceneid".$pSceneID);

        $statement->execute(array($pSceneID));
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {
            $this->timeTargetData = new TimeTarget();
            $this->timeTargetData->id = $result['time_target_session_id'];
            $this->timeTargetData->seed = $result['time_target_seed'];
            $this->timeTargetData->startTime = $result['time_target_start'];
            $this->timeTargetData->endTime = $result['time_target_end'];
            $this->timeTargetData->min = $result['time_target_increment_min'];
            $this->timeTargetData->add = $result['time_target_add'];
            $this->timeTargetData->title = $result['time_target_title'];
            $this->timeTargetData->contentTitle = $result['time_target_contenttitle'];
            $this->timeTargetData->content = $result['time_target_content'];
            $this->timeTargetData->cards = $result['time_target_cards'];
        }
    }

    function loadPointsGTData($pSceneID)
    {
        global $conn;

        $dbcon = new DbCon();
        $conn = $dbcon->read_database();
        $sql = 'SELECT * FROM `points_gt` where pgt_promotion_id=? ORDER by points_gt.pgt_id DESC limit 1';
        $statement = $conn->prepare($sql);
        $statement->execute(array($pSceneID));

        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {
            $this->pointsGTData = new PointsGT();
            $date1 = new DateTime($result['pgt_race_begin']);
            $date2 = new DateTime($result['pgt_race_end']);
            $date3 = new DateTime(date('Y-m-d H:i:s'));

                if($date3>$date2){
                  $this->pointsGTData->finished=True;
                }else{
                    $this->pointsGTData->finished=False;
                }



            $this->pointsGTData->DayOfSession = $this->dateDifference($date3, $date1, '%d') + 1;
            $this->pointsGTData->DaysInSession = $this->dateDifference($date2, $date1, '%d') + 1;

            $this->pointsGTData->lastUpdated = $result['pgt_timestamp'];
            $this->pointsGTData->title = $result['pgt_title'];
            $this->pointsGTData->Value1 = $result['pgt_subtitle'];
            $this->pointsGTData->Value2 = $result['pgt_left_content'];
            $this->pointsGTData->Value2Title = $result['pgt_left_title'];
            $this->pointsGTData->Value3 = $result['pgt_right_content'];
            $this->pointsGTData->Value3Title = $result['pgt_right_title'];
            $this->pointsGTData->SpriteAtlas = $result['pgt_atlas'];
            $this->pointsGTData->PayoutList = $result['pgt_payout'];

            if ($result['pgt_enable_instant_winners']) {
                $this->pointsGTData->InstantWinners = $this->getPointsGTInstantWinners($pSceneID);
            }

            //$sPlayerName, $sPoints, $sCarID,$saccountid

        }
        $sql = 'SELECT * FROM points_gt_players where points_gt_players.pgt_id=? limit 20';
        $statement = $conn->prepare($sql);
        $statement->execute(array($pSceneID));
        $tmpPlayerList = array();
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {
            $tmpPlayer = new PointsGTPlayer($result['pgt_player_name'], $result['pgt_current_points'], $result['pgt_car_icon'], $result['pgt_account_id']);
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
        global $conn;

        $dbcon = new DbCon();
        $conn = $dbcon->read_database();
        $sql = 'SELECT * FROM points_gt_instant_winner where pgt_id=? limit 3';
        $statement = $conn->prepare($sql);
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
        global $conn;

        $dbcon = new DbCon();
        $conn = $dbcon->read_database();
        $sql = 'SELECT * from kick_for_cash where kfc_promotion_id=? order by kfc_id DESC limit 1';
        $statement = $conn->prepare($sql);
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
}