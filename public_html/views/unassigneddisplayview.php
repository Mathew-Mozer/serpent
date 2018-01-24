
<?php
/**
 * This defines all the displays that have not yet been defined.
 */
?>
<div class="display-outer" id="unassigned-displays">
    <h3> Unassigned Displays </h3>
    <?php
        //uses default property id which is 0
        $unassigned = new PropertyDisplays($dbcon->read_database(), 0);
        $unassignedDisplays = $unassigned->getDisplays();

    foreach ($unassignedDisplays as $display) {
    ?>
        <div class="unassigned-display-body promotion-preview-display display-settings">
            <p class="unassigned-display-display-text"><?php echo($display->getLinkCode()); ?></p>
            <span id="<?php echo $display->getId(); ?>"
                  class="glyphicon glyphicon-exclamation-sign tool-glyphicon white display-options" aria-hidden="true"></span>
        </div>
        <?php } ?>
</div>