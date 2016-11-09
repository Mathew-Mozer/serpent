
<div class="display-outer" id="unassigned-boxes">
    <h3> Unassigned Displays </h3>
    <?php
        //uses default casino id which is 0
        $unassigned = new CasinoBoxes($dbcon->read_database(), 0);
        $unassignedBoxes = $unassigned->getBoxes();
        foreach ($unassignedBoxes as $box) {
    ?>
        <div class="unassigned-display-body promotion-preview-box box-settings">
            <p class="unassigned-display-box-text"><?php echo $box->getMacAddress(); ?></p>
            <span id="<?php echo $box->getId(); ?>"
                  class="glyphicon glyphicon-exclamation-sign tool-glyphicon white box-options" aria-hidden="true"></span>
        </div>
        <?php } ?>
</div>
