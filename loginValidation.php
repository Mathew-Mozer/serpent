<?php
/**
 * LoginValidation class that
 */
require_once("/home/casino/dbcon.php");


class LoginValidation
{
    private $responseMessaging;
    private $s_userName;
    private $s_password;

    public function __construct($username,$password) {
        $this->responseMessaging = array('valid' => 'yes', 'errorMessage' => array());
        $this->s_userName = $username;
        $this->s_password = $password;
        $this->dbcon = new DbCon();
    }

    public function validateLogin (){
        if($this->testFotEmptyCredentials() === true){
            $this->s_userName = $this->formatInput($this->s_userName);
            $this->s_password = $this->formatInput($this->s_password);
            $this->validateCredentials();
        }
        return $this->responseMessaging;
    }
    /**
     * Tests login credentials for empty input
     *
     * @return string
     */
    private function testFotEmptyCredentials() {
        if (empty($this->s_userName)) {
            array_push($this->responseMessaging ['errorMessage'], 'Username is required');
            $this->responseMessaging['valid'] = 'no';
        }if (empty($this->s_password)) {
            array_push($this->responseMessaging ['errorMessage'], 'Password is required');
            $this->responseMessaging['valid'] = 'no';
        }
        if ($this->responseMessaging['valid'] === 'yes') {
            return true;
        }
        return false;
    }

    /**
     * Uses built in php functions to
     * strip characters from form data
     *
     * @param $data
     * @return string
     */
    private function formatInput ($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    private function validateCredentials(){
        $conn = $this->dbcon->read_database();
        $statement = $conn->prepare("SELECT id from account WHERE name = '$this->s_userName'");

        $statement->execute();
        $row = $statement->fetch();
        if(empty($row)){
            array_push($this->responseMessaging['errorMessage'], 'Invalid username or password');
        }
    }

    /**
     * @return array
     */
    public function getResponseMessaging() {
        return $this->responseMessaging;
    }
}
?>