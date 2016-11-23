<?php
/*
*
*Author: Alex Onorati, Chris Barbour
*
*This makes the physical database connection.
*
*/

class DbCon
{
  private $servername = 'localhost';
  private $dbname = 'casino_chimera';
  private $updateUser = 'casino_update';
  private $updatePw ='}TwyDfSQm93F';
  private $readUser = 'casino_read';
  private $readPw = 'icDEpbatf57l';
  private $createUser = 'casino_insert';
  private $createPw = 'b@iHw53J-K+r';
  private $deleteUser ='casino_delete';
  private $deletePw = 'PtdTO#NW-o*c ';

  protected function createConnection($username, $password){
    try {
      $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $username, $password);
      // set the PDO error mode to ErrorException
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      $conn = 'Connection failed!';
    }
    return $conn;
  }

  public function read_database(){
    return $this->createConnection($this->readUser,$this->readPw);
  }

  public function insert_database(){
    return $this->createConnection($this->createUser,$this->createPw);
  }

  public function update_database(){
    return $this->createConnection($this->updateUser,$this->updatePw);
  }

  public function delete_database(){
    return $this->createConnection($this->deleteUser, $this->deletePw);
  }
}
?>
