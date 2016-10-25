<?php
/**
 * User: Christopher Barbour
 * Date: 10/5/16
 * Time: 12:25 PM
 */

require('../public_html/LoginValidationModel.php');

class LoginValidationTest extends \PHPUnit_Framework_TestCase
{

    public function testEmptyUserName(){
        $controller = new \LoginValidation(null,'test');
        $response = $controller->validateLogin();
        $this->assertEquals('no',$response['valid'],'Should not be a valid login atempt');
        $this->assertEquals('Username is required',$response['errorMessage'][0]);
    }

    public function testEmptyPassword(){
        $controller = new \LoginValidation('user',null);
        $response = $controller->validateLogin();
        $this->assertEquals('no',$response['valid'],'Should not be a valid login attempt');
        $this->assertEquals('Password is required',$response['errorMessage'][0]);
    }

    public function testInvalidUserName(){
        $controller = new \LoginValidation('userName','password');
        $response = $controller->validateLogin();
        $this->assertEquals('Invalid username or password',$response['errorMessage'[0]]);

    }

    public function testInvalidPassword(){
        $controller = new \LoginValidation('userName','');
        $response = $controller->validateLogin();
        $this->assertEquals('Invalid username or password',$response['errorMessage'[0]]);
    }


}
