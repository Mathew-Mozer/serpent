<?php
/**
 * File the contains the OptionsModal Class
 *
 * Author Chris Barbour
 */

//for local test runs
require_once("../dependencies/php/HelperFunctions.php");
require_once(getServerPath()."dbcon.php");

/**
 * Class OptionsModal that handles the data base queries to show on the settings modal window.
 *
 * Model for options modal window
 *
 * @param $promotionID
 * @param $conn
 */
class OptionsModel{

    const KICKFORCASHID = 11;

    private $promotionID;
    private $conn;

    /**
     * OptionsModal constructor.
     *
     * @param $promotion
     */
    public function __construct($promotion) {
        $this->promotionID = $promotion;

        $dbcon = new DbCon();
        $this->conn = $dbcon->update_database();

    }

    /**
     * Queries the database table promotion and returns all fields if an id match is found.
     *
     * Returns setting for specific promotion
     * @param $promotionType int
     * @return array
     */
    public function getPromotionSettings($promotionType) {
        $sql = $this->getSelectPromotionTypeSql($promotionType);
        $statement = $this->conn->prepare($sql);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Updates the database table promotion with results from the settings modal window.
     *
     * Updates database
     *
     * @param $promotionType
     * @param $cashPrize
     * @param $targetNumber
     *
     * @return boolean
     */
    public function updatePromotionSettings($promotionType,$cashPrize,$targetNumber) {
        $sql = $this->getUpdatePromotionTypeSql($promotionType,$cashPrize,$targetNumber);
        $statement = $this->conn->prepare($sql);
        $completed = $statement->execute();
        return $completed;
    }


    /**
     * Archives the promotion by turning the visable field to 'F' in the database and returns whether or not the
     * update was successful.
     *
     * Archives promotion
     *
     * @return bool
     */
    public function archivePromotion() {
        $sql = "UPDATE promotion SET visible = 'F' WHERE id = " . $this->promotionID;
        $statement = $this->conn->prepare($sql);
        return $statement->execute();
    }

    private function getSelectPromotionTypeSql ($promotionType) {
        $sql = '';
        if($promotionType == self::KICKFORCASHID) {
            $sql = 'SELECT cash_prize,target_number FROM kick_for_cash WHERE promotion_id = '. $this->promotionID;
        }
        return $sql;
    }

    private function getUpdatePromotionTypeSql ($promotionType, $cashPrize, $targetNumber) {
        $sql = '';
        if($promotionType == self::KICKFORCASHID) {
            $sql = 'UPDATE kick_for_cash SET cash_prize = '. $cashPrize .', target_number = '. $targetNumber.' WHERE promotion_id = ' . $this->promotionID;
        }
        echo $sql;
        return $sql;
    }
}

?>
