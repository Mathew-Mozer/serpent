
<div class="display-outer" id="unassigned-boxes">
    <h3> Unassigned Displays </h3>
    <?php
        //uses default casino id which is 0
        $unassigned = new CasinoDisplays($dbcon->read_database(), 0);
        $unassignedDisplays = $unassigned->getDisplays();
        foreach ($unassignedDisplays as $box) {
    ?>
        <div class="unassigned-display-body promotion-preview-display display-settings">
            <p class="unassigned-display-box-text"><?php echo $box->getMacAddress(); ?></p>
            <span id="<?php echo $box->getId(); ?>"
                  class="glyphicon glyphicon-exclamation-sign tool-glyphicon white display-options" aria-hidden="true"></span>
        </div>
        <?php } ?>
</div>
