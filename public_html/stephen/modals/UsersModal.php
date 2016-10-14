<?php
require_once ('/home/casino/dbcon.php');

/**
 * Class UsersModal
 * @author Stephen King
 * @Date 10/11/2016
 * @Version 1.0
 *
 * This class creates a modal object that can be used to
 * add, remove and modify users. This includes access
 * permissions.
 */

class UsersModal{

    private $userID;
    private $userFirstName;
    private $userLastName;

    /**
     * UsersModal constructor.
     */
    public function __construct() {
        $this->userFirstName = "Killian";
        $this->userFirstName = "Darkwater";
    }

    /**
     * @return mixed
     */
    public function getUsers() {
        return $this->userFirstName . " " . $this->userLastName;
    }

}

?>

