<?php

  include_once("/home/casino/dbcon.php");
  include_once( $_SERVER['DOCUMENT_ROOT']."/modals/PromotionModal.php");
  $promotion = new PromotionModal(read_database());
  foreach($promotion->getAllPromotions() as $row){
    print_r($row);
    echo '<br/>';
  }
 ?>
