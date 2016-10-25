<?php
session_start();
/**
*	This script builds the entire main page
*	This needs to be cleaned up and recommented
*	Several models are mislabeled as modals.
/*


  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  /**
  *	Require Hell
  */
  require "../models/PromotionModel.php";
  require "../models/PermissionModel.php";
  require_once("../dependencies/php/HelperFunctions.php");
  require_once(getServerPath()."dbcon.php");

  //Create database connection object
  $dbcon = NEW DbCon();
  
  //Create modal models of the modals
  $promotion = new PromotionModal($dbcon->read_database());
  $permission = new PermissionModal($dbcon->update_database(), $_POST['id']);

  //Another require
  require 'toolbarview.php';

  //Create Casino objects
  $casinoList = $promotion->getPromotionCasinos();
  $casinoCount = count($casinoList);
  $casinoRowIndex = 0;

  //List all the casinos that the current user has permissions to view
  foreach($casinoList as $casino){

	//If the permission checks out, print the promotion
	if($permission->canViewCasinoPromotions($casino['id'])) {

		  include('casinoview.php');
		  $casinoRowIndex++;

		  if($casinoRowIndex < $casinoCount){ ?>
			<hr>
			<?php }
		  }
	}
	
	//If they have no permissions to view a casino, let them know.
	if ($casinoRowIndex == 0){ ?>
	  <div>
		<h3>You have no access to any casinos.</h3>
	  </div>
	<?php }
	 include '../dependencies/php/footer.php';

?>
