<?php

foreach(/*database row stuff */){
echo	'<!--Promotion Title-->
		<div class="tile-body" id="$row['compositekey']">
			<img class="tile-icon" src="dependencies/images/$row['vaultdweller.jpg']">
			<div class="tile-menu-bar">';
	
			foreach(/*database row stuff */){
				echo '<div class="tile-menu-item">
					<span class="glyphicon $row['glyphicon-cog'] glyphicon-menu black" aria-hidden="true"></span>
				</div>
			
				<div class="tile-menu-item">
					<span class="glyphicon $row['glyphicon-pause'] glyphicon-menu black" aria-hidden="true"></span>
				</div>
				
				<div class="tile-menu-item">
					<span class="glyphicon $row['glyphicon-user'] glyphicon-menu black" aria-hidden="true"></span>
				</div>';
			}
			echo '</div>
		</div>
			
<!--End Promotion Tile-->';
}
?>