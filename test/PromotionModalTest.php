<?php
/**
 * User: Alex Onorati
 * Date: 10/6/16
 */

include('../public_html/modals/PromotionModel.php');

class PromotionModalTest extends \PHPUnit_Framework_TestCase
{

    public function testGetAllPromotions(){
        $controller = new \PromotionModal(null);
        $response = $controller->getAllPromotions();
        assert($response === null,'Should not be null');
    }
}
