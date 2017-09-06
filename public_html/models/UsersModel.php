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
    var $options = ['cost' => 11];
    public function addUser($userName, $userPassword, $propertyID) {


        //How expensive should the hash be? The more expensive, the harder it is to break
        //and the more time it takes the server to perform


        //Hash password using bcrypt
        $hashed_password = password_hash($userPassword, PASSWORD_BCRYPT, $this->options);

        $sql = "INSERT INTO account (account_name, account_password) VALUES(:userName, :userPassword);
                INSERT INTO account_permissions (account_id, tag_id, permissions, excess_id) VALUES(LAST_INSERT_ID(), 1, 'RU', :propertyID);";

        $result = $this->conn->prepare($sql);

        $result->bindValue(':userName', strtolower($this->formatInput($userName)), PDO::PARAM_STR);
        $result->bindValue(':userPassword', $hashed_password, PDO::PARAM_STR);
        $result->bindValue(':propertyID', $propertyID, PDO::PARAM_INT);

        $result->execute();
        return $result;
    }
    public function updateUserPassword($userId,$userPassword){


        //Hash password using bcrypt
        $hashed_password = password_hash($userPassword, PASSWORD_BCRYPT, $this->options);
        $sql = "UPDATE account set account_password=:userPassword where account_id=:userId limit 1;";
        $result = $this->conn->prepare($sql);
        $result->bindValue(':userId', $userId, PDO::PARAM_STR);
        $result->bindValue(':userPassword', $hashed_password, PDO::PARAM_STR);
        if($result->execute()){
            return ("Password Updated Successfully");
        }else{
            return ("Password Update Failed");
        }

    }
    private function formatInput ($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    public function getUsers($propertyId,$userid) {
        if($_SESSION['isGod']){
            $sql = "SELECT * FROM `account`,account_permissions WHERE account.account_id=account_permissions.account_id and account.account_id !=:uid and account_permissions.excess_id=:id group by account.account_id;";
        }else{
            $sql = "SELECT * FROM `account`,account_permissions WHERE account.account_id=account_permissions.account_id and account.account_godmode=0 and account.account_id !=:uid and account_permissions.excess_id=:id group by account.account_id;";
        }

        $result = $this->conn->prepare($sql);
        $result->bindValue(':id', $propertyId, PDO::PARAM_STR);
        $result->bindValue(':uid', $userid, PDO::PARAM_STR);
        $result->execute();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}

?>