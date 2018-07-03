
<?php
/**
 * This defines all the displays that have not yet been defined.
 *
 */
require_once "../models/PropertyDisplays.php";
require_once("../dependencies/php/HelperFunctions.php");
require_once(getServerPath() . "dbcon.php");
$dbcon = NEW DbCon();
date_default_timezone_set('America/Los_Angeles');
?>
<div class="display-outer" id="unassigned-displays">
    <h3> Unassigned Displays<span style="text-align: right; font-size: medium; padding-left: 10px" class="	glyphicon glyphicon-refresh refresh-unassigned-display"></span> </h3>
    <?php
        //uses default property id which is 0
        $unassigned = new PropertyDisplays($dbcon->read_database(), 0);
        $unassignedDisplays = $unassigned->getDisplays();
    foreach ($unassignedDisplays as $display) {
    ?>
        <div class="unassigned-display-body promotion-preview-display display-settings" data-display-id="<?php echo $display->getId(); ?>">
            <p class="unassigned-display-display-text"><?php echo($display->getLinkCode()); ?> <span style="width: 45%; text-align: right" data-display-id="<?php echo $display->getId(); ?>" class="glyphicon glyphicon-remove-circle remove-unassigned-display"></span></p>
            <p  class="unassigned-display-display-text" style="width: 100%; text-align: center">
                <?php
                $date1 = new DateTime($display->getAddedTimeStamp(),new DateTimeZone('UTC'));
                $date1->setTimezone(new DateTimeZone('America/Los_Angeles'));
                $date2 = new DateTime(date('Y-m-d H:i:s'));
                echo (dateDifference($date2,$date1,"%d:%h:%i:%s" ));
                ?>    </p>
            <span id="<?php echo $display->getId(); ?>"
                  class="glyphicon glyphicon-exclamation-sign tool-glyphicon white display-options" aria-hidden="true" ; style="top: -6px"></span>
        </div>
        <?php }
    function dateDifference($date_1, $date_2, $differenceFormat = '%d')
    {
        $interval = date_diff($date_1, $date_2);
        return $interval->format($differenceFormat);

    }

    ?>
</div>