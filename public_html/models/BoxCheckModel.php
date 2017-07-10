<?php

/**
 * This checks assigned boxes to see if they are down
 */
class BoxCheckModel
{

    private $conn;

    /**
     * BoxCheckModel constructor.
     * @param PDO $conn
     */
    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }
public function geturi(){
    return $_SERVER['REQUEST_URI'];
}
    public function checkAPI($mac)
    {
        $c = curl_init('http://stackoverflow.com/questions/ask');
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $html = curl_exec($c);

        if (curl_error($c))
            die(curl_error($c));
// Get the status code
        $status = curl_getinfo($c, CURLINFO_HTTP_CODE);
        curl_close($c);
        return $status;
    }

    /**
     * Return difference of current datetime to last check-in
     */
    public function checkDownTime()
    {

        $sql = "SELECT display_id, (TO_SECONDS(NOW()) - TO_SECONDS(display_lastcheckin)) AS last_checkin, (TO_SECONDS(NOW()) - TO_SECONDS(display_uptimestart)) AS uptime, display_monitor_threshold_red, display_monitor_threshold_yellow, display_monitor
              FROM display";

        $result = $this->conn->prepare($sql);

        $result->execute();

        $dateResult = $result->fetchAll(PDO::FETCH_ASSOC);

        return $dateResult;

    }

}

?>