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


        //How expensive should the hash be? The more expensive, the harder it is to break
        //and the more time it takes the server to perform
        $options = ['cost' => 11];

        //Hash password using bcrypt
        $hashed_password = password_hash($userPassword, PASSWORD_BCRYPT, $options);

        $sql = "INSERT INTO account (account_name, account_password) VALUES(:userName, :userPassword);
                INSERT INTO account_permissions (account_id, tag_id, permissions, excess_id) VALUES(LAST_INSERT_ID(), 1, 'RU', :propertyID);";

        $result = $this->conn->prepare($sql);

        $result->bindValue(':userName', $this->formatInput($userName), PDO::PARAM_STR);
        $result->bindValue(':userPassword', $hashed_password, PDO::PARAM_STR);
        $result->bindValue(':propertyID', $propertyID, PDO::PARAM_INT);

        $result->execute();
        return $result;
    }
    private function formatInput ($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    public function getUsers($propertyId) {
        $sql = "SELECT * FROM `account`,account_permissions WHERE account.account_id=account_permissions.account_id and account_permissions.permissions LIKE '%%' and account_permissions.tag_id='1'and account_permissions.excess_id=:id;";
        $result = $this->conn->prepare($sql);
        $result->bindValue(':id', $propertyId, PDO::PARAM_STR);
        $result->execute();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}

?>