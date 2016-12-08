<?php
//require_once ('/home/property/dbcon.php');

/**
 * Class UsersModal
 *
 * This class creates a modal object that can be used to
 * add, remove and modify users. This includes access
 * permissions.
 */

class UsersModel{

    private $userID;
    private $userFirstName;
    private $userLastName;

    /**
     * UsersModal constructor.
     */
    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    /**
     * @param $userName
     * @param $userPassword
     * @param $propertyID
     */
    public function addUser($userName, $userPassword, $propertyID) {


        $sql = "INSERT INTO account (account_name, account_password) VALUES(:userName, :userPassword);
                INSERT INTO account_permissions (account_id, tag_id, permissions, excess_id) VALUES(LAST_INSERT_ID(), 2, 'RU', :propertyID);";

        $result = $this->conn->prepare($sql);

        $result->bindValue(':userName', $userName, PDO::PARAM_STR);
        $result->bindValue(':userPassword', $userPassword, PDO::PARAM_STR);
        $result->bindValue(':propertyID', $propertyID, PDO::PARAM_INT);

        $result->execute();
        return $result;
    }

}

?>