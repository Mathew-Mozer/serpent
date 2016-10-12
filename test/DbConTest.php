<?php

require ('../dbcon.php');

class DbConTest extends \PHPUnit_Framework_TestCase
{
    private $controller;

    public function __construct(){
        $this->controller = new DbCon();
    }

    public function testFailedReadConnection(){
        $connection = $this->controller->read_database();
        $this->assertEquals('Connection failed!',$connection);
    }

    public function testFailedUpdateConnection(){
        $connection = $this->controller->update_database();
        $this->assertEquals('Connection failed!',$connection);
    }

    public function testFailedCreateConnection(){
        $connection = $this->controller->create_database();
        $this->assertEquals('Connection failed!',$connection);
    }

}
