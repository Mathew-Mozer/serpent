<?php
/**
 * This checks assigned boxes to see if they are down
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
    }

    /**
     * Return difference of current datetime to last check-in
     */
    public function checkDownTime(){

        $sql="SELECT display_id, (TO_SECONDS(NOW()) - TO_SECONDS(display_lastcheckin)) AS last_checkin, (TO_SECONDS(NOW()) - TO_SECONDS(display_uptimestart)) AS uptime, display_monitor_threshold_red, display_monitor_threshold_yellow
              FROM display";

        $result = $this->conn->prepare($sql);

        $result->execute();

        $dateResult = $result->fetchAll(PDO::FETCH_ASSOC);

      //  foreach($dateResult as $row){

        //    if($row['seconds'] >= $row['display_monitor_threshold_red']){
                //echo "Box : " . $row['display_id'] . " is down! Last Check-in was " . $row['seconds'] . " seconds ago <br>";
                // "<script> setDisplayDownAlert(" . $row['display_id'] . ") </script>";

                return $dateResult;
        //    }
       // }


        
    }

}
?>