<?php
/**
 *
 */

class BoxCheckModel {

    private $conn;

    /**
     * BoxCheckModel constructor.
     * @param PDO $conn
     */
    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
        date_default_timezone_set("America/Los_Angeles");
    }

    /**
     * Return difference of current datetime to last check-in
     * @param $datetime
     * @return false|string
     */
    public function checkDownTime(){

        $sql="SELECT display_lastcheckin FROM display";

        $result = $this->conn->prepare($sql);

        $result->execute();

        $dateResult = $result->fetch(PDO::FETCH_ASSOC);

        foreach($dateResult as $row){

            echo "<script>console.log(date('Y-m-d H:i:s') - " . $row['display_lastcheckin'] . ")</script>";
           // if(date("Y-m-d H:i:s") - $row['display_lastcheckin'] > 120){

           // }
        }
        return  - $datetime;
        
    }

}
