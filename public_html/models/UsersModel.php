<?php
//require_once ('/home/property/dbcon.php');

/**
 * Class UsersModal
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