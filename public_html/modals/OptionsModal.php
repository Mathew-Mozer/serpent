<?php
/**
 * File the contains the OptionsModal Class
 *
 * Author Chris Barbour
 */

//for local test runs
//require ('../../dbcon.php');

/**
 * Class OptionsModal that handles the data base queries to show on the settings modal window.
 *
 * Model for options modal window
 *
 * @param $promotionID
 * @param $conn
 */
class OptionsModal{

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
        $this->conn = $dbcon->read_database();
    }

    /**
     * Queries the database table promotion and returns all fields if an id match is found.
     *
     * Returns setting for specific promotion
     *
     * @return array
     */
    public function getPromotionSettings() {
        $sql = "SELECT * FROM promotion WHERE id = " . $this->promotionID;
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
     * @param $settings
     * @return array
     */
    public function updatePromotionSettings($settings) {

        $sql = "UPDATE promotion SET settings = " . $settings . "WHERE id= " . $this->promotionID;
        $statement = $this->conn->prepare($sql);
        $statement->execute();

        return $this->getPromotionSettings();
    }
}

?>
