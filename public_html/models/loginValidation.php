<?php
/**
 * File that contains LoginValidation Class
 *
 * Author Chris Barbour
 */
session_start();
require_once("../dependencies/php/FactoryFunctions.php");
require_once(getServerPath()."dbcon.php");

//For local test runs
//include('../dbcon.php');

/**
 * LoginValidation class that verifies a users login and password
 *
 * Login validation for login form
 *
 * @param $responseMessaging
 * @param $s_username
 * @param $s_password
 */
class LoginValidation
{
    private $responseMessaging;
    private $s_userName;
    private $s_password;

    /**
     * LoginValidation constructor.
     * @param $username
     * @param $password
     */
    public function __construct($username, $password) {
        $this->responseMessaging = array('valid' => 'yes', 'errorMessage' => array());
        $this->s_userName = $username;
        $this->s_password = $password;
        $this->dbcon = new DbCon();
    }

    /**
     * Driver function for the class,
     * checks the credentials for empty inputs,
     * strips extraneous spaces and removes special characters,
     * and then queries the database
     *
     * Validates that the username and password are valid.
     *
     * @return array
     */
    public function validateLogin (){
        if($this->testFotEmptyCredentials() === false){
            $this->s_userName = $this->formatInput($this->s_userName);
            $this->s_password = $this->formatInput($this->s_password);
            $this->validateCredentials();
        }
        return $this->responseMessaging;
    }
    /**
     * Tests login credentials for empty input
     *
     * Empty input check
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
            return false;
        }
        return true;
    }

    /**
     * Uses built in php functions to
     * strip characters from form data
     *
     * Input formatting
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

    /**
     * Queries the database to verify that the user name is a user and that the password matches the stored value.
     *
     * Queries database for matching credentials
     *
     */
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
     * Getter for the response messaging field
     *
     * Returns the response messaging field
     *
     * @return array
     */
    public function getResponseMessaging() {
        return $this->responseMessaging;
    }
}
?>
