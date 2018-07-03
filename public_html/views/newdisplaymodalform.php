<?php
session_start();
require "../dependencies/php/HelperFunctions.php";
require getServerPath() . "dbcon.php";
require "../models/PromotionModel.php";
require_once "../models/PropertyDisplays.php";
require "../models/PermissionModel.php";
$dbcon = new DBCon();
?>

<ul id="errorMessage" hidden></ul>
<?php
$displayOptions = new PromotionModel($dbcon->read_Database());
$displayProperties = new PropertyDisplays($dbcon->read_Database(), $_POST['propertyId']);
$display = $displayProperties->getDisplayWithId($_POST['displayId']);
$skins = $displayProperties->getSkinTypes($_POST['propertyId']);

$assignedPromotions = $displayOptions->getPromotionsByDisplayId($_POST['displayId']);
$unassignedPromotions = $displayOptions->getUnassignedPromotions($_POST['displayId'], $_SESSION['userId']);
$permission = new PermissionModel($dbcon->update_database(), $_SESSION['userId']);
$property['property_id'] = $_POST['propertyId'];
$property['property_name'] = $_POST['propertyName'];
?>
<style>
    table.promo-item {
        background-color: whitesmoke;
        padding-top: 5px;
        padding-bottom: 5px;
        border: solid darkgrey;
    }

    .promo-title {
        background-color: rgba(0, 102, 0, 0.8);
        color: white;
        font-weight: bold;
        width: 65%;
    }

    .center {
        text-align: center;
    }

    .sortable {
        list-style-type: none;
        margin: 0;
        padding: 0;
        width: 60%;
    }

    #sortable li {
        margin: 0 3px 3px 3px;
        padding: 0.4em;
        padding-left: 1.5em;
        font-size: 1.4em;
        height: 18px;
    }

    #sortable li span {
        position: absolute;
        margin-left: -1.3em;
    }
</style>
<div id="display-id-form" data-display-id="<?php echo $_POST['displayId']; ?>" data-linkcode="<?php echo($_POST["linkcode"]) ?>"></div>
<div id="property-id-form" data-property-id="<?php echo $_POST['propertyId']; ?>"></div>
<div id="property-name-form" data-property-name="<?php echo $_POST['propertyName']; ?>"></div>

<div id="display-info" data-property-id="<?php echo($_POST['propertyId']) ?>"
     data-display-id="<?php echo($_POST['displayId']) ?>">

</div>
<div id="display-admin-options-modal" class="display-modal-view" hidden>

</div>

<div id="display-promotions-modal-view" class="display-modal-view"></div>

<div style="width: 100%;text-align: center;">
    <span id="sidenav-display-name"
          style="width: 100%;text-align: center; font-size: x-large; font-weight: bold; color: #1ab7ea"><?php echo $display->getName(); ?> </span><br>
    <span id="sidenav-display-location" style="width: 100%; text-align: center; color: #1ab7ea" for="display-name-field"><?php echo $display->getDisplayLocation() ?></span>
    <span  style="width: 100%; text-align: center; color: #1ab7ea" id="display-info-field-edit" class="glyphicon glyphicon-edit "></span>
    <?php if ($_SESSION['isGod']) { ?>


        <span style="color: #1ab7ea" data-tab="display-admin-options-modal"
              class="btn btn-link glyphicon glyphicon-cog display-modal-view-switch"
              data-promo-id="<?php echo($assignedPromotion['promo_id']) ?>"></span>
    <?php } ?>
</div>

<div id="EditDisplayNameForm" style="margin-left: auto;margin-right: auto; margin-bottom: 20px; width: 75%; text-align: center; border-style: groove; border-color: #0d6aad; display: none;">
    <form class="form-horizontal" method="post">
        <div class="form-group">
            <label style="width: 100%; text-align: center; color: #1ab7ea" for="display-name-field">Display Name</label>
            <input type="text" style="width: 175px;margin-left: auto;margin-right: auto; text-align: center" id="display-name-field" class="display-info-field form-control" name="displayName" value='<?php echo $display->getName() ?>'>
        </div>
        <div class="form-group">
            <label style="width: 100%; text-align: center; color: #1ab7ea" for="display-location-field">Display
                Location</label>
            <input type="text" style="width: 175px; margin-left: auto;margin-right: auto; text-align: center" id="display-location-field" class="display-info-field  form-control" name="displayLocation"
                   value='<?php echo $display->getDisplayLocation() ?>'>
        </div>
        <button type="button" class="btn btn-success" style="margin-bottom: 10px" id="update-display-btn">Save</button>
        <button type="button" class="btn btn-danger" style="margin-bottom: 10px" id="cancel-update-display-btn">Cancel</button>
        <input type="hidden" id="property-id" value="<?php echo $_POST['propertyId']; ?>">
        <input type="hidden" id="display-id" value="<?php echo $_POST['displayId']; ?>">
        <input type="hidden" id="property-name" value="<?php echo $_POST['propertyName']; ?>">
        <input type="hidden" id="default-skin" value="0">
        <input type="hidden" id="default-scene-duration" value="1">
    </form>
</div>

<div>
    <button type="button" class="btn btn-success send-fccm-command" data-token-id="0" data-service-id="0" data-linkcode="<?php echo($_POST["linkcode"]) ?>" data-display-id="<?php echo $_POST['displayId']; ?>" data-command="Quit" data-package-name="test111">Close ChimeraTV</button>
    <button type="button" class="btn btn-success send-fccm-command" data-token-id="1" data-service-id="0" data-linkcode="<?php echo($_POST["linkcode"]) ?>" data-display-id="<?php echo $_POST['displayId']; ?>" data-command="LaunchApp" data-package-name="com.typhonpacific.ChimeraTV">Launch ChimeraTV</button>
</div>
<div style="color: whitesmoke; font-size: 20px; text-align: center">Assigned Promotions<br></div>
<div style="color: whitesmoke; text-align: center;width: 100%">To Add Promotion to display:<br>Drag it to this list using <span
        class="glyphicon glyphicon-move promo-title-handle hidden"></span> next to the title of the promotion.</div>
<table width="100%">
    <tbody style="background-color: grey" class="sortable">
    <tr>
    <?php if(count($assignedPromotions)==0){?>
        <td id="newitems" width="100%">Drag New Items here</td>
        <?php }?>
    </tr>
    <?php
    /**
     * Loops through and displays assigned promotions
     */
    $lockedpromoid = $display->getLockedPromoId();

    foreach ($assignedPromotions as $assignedPromotion) {
        if ($assignedPromotion['promotion_label'] == "") {
            $apromoname = $assignedPromotion['promotion_type_title'];
        } else {
            $apromoname = $assignedPromotion['promotion_label'];
        }
        $currentSkin = $displayProperties->getSkinById($assignedPromotion['skin_id']);
        if ($lockedpromoid == $assignedPromotion['promotion_id']) {
            $lockcontainerclass = "promotion-lock-overlay";
            $lockglyphclass = "<i class='font-awesome fa fa-lock lock-glyphicon locked'></i>";
            $lockstatus = "1";

        } else {
            $lockcontainerclass = "promotion-preview-body";
            $lockglyphclass = "<i class='font-awesome fa lock-glyphicon hidden unlocked'></i>";
            $lockstatus = "0";
        }
        ?>
        <tr class="promo-list-item" data-promo-property-id="<?php echo($assignedPromotion['promotion_property_id']) ?>"
            data-promoid="<?php echo($assignedPromotion['promo_id']) ?>">
            <td>
                <table class="promo-item"
                       style="width: 290px; table-layout: fixed; margin-left: auto; margin-right: auto; margin-top: 5px">
                    <tr>
                        <td colspan="6" class="center promo-title"><span
                                class="glyphicon glyphicon-move promo-title-handle hidden"></span>[<?php echo($assignedPromotion['promo_id']) ?>
                            ] <?php echo($apromoname) ?></td>
                        <td style=" text-align: right ">
                            <?php if ($permission->hasPermissionById('display', $property['property_id'], 'U') || $_SESSION['isGod']) { ?>
                                <span class="btn btn-link edit-promo-details glyphicon glyphicon-cog"
                                      data-promo-id="<?php echo($assignedPromotion['promo_id']) ?>"
                                      data-display-id="<?php echo $_POST['displayId']; ?>"
                                      data-skin-id="<?php echo $assignedPromotion['skin_id']; ?>"
                                      data-promo-duration="<?php echo $assignedPromotion['scene_duration']; ?>"
                                      data-promoproperty-id="<?php echo $assignedPromotion['promotion_property_id']; ?>"
                                >
                                </span>
                                <span class='btn btn-link glyphicon glyphicon-trash remove-from-display'
                                      data-promo-id="<?php echo($assignedPromotion['promo_id']) ?>"
                                      id='btn-rmv-<?php echo($assignedPromotion['promo_id']) ?>'
                                      name='remove-promotion'></span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-left: 5px">
                            <div
                                class="<?php echo $lockcontainerclass ?>  promolockbtn-<?php echo $assignedPromotion['promotion_id'] ?> promotionLockBtn"
                                data-property-id="<?php echo $property['property_id']; ?>"
                                data-property-name="<?php echo $property['property_name']; ?>"
                                data-promo-lockstatus="<?php echo $lockstatus; ?>"
                                data-promo-id="<?php echo $assignedPromotion['promotion_id'] ?>"
                                data-display-id="<?php echo $display->getId() ?>" data-toggle="tooltip"
                                title="<?php echo $apromoname . " " . $assignedPromotion['promotion_id'] ?>"
                                style="background-size: contain; background-image: url('dependencies/images/<?php echo $assignedPromotion['promotion_type_image']; ?>')">
                                <div hidden class="tile-promotion-title"
                                     style="float:left; display:none;clear: both;overflow: hidden; min-width: 50px;font-size: small;font-variant: small-caps;">
                                    <?php echo substr($promo['promotion_label'], 0, 9);
                                    if (strlen($promo['promotion_label']) > 10) {
                                        echo('..');
                                    }
                                    ?></div>
                                <div class="lock-glyphicon-container">
                                    <?php echo $lockglyphclass; ?>
                                </div>

                                <!-- <div class="promotion-artifact-preview">
                           <!-- <i class="font-awesome fa <?php //echo $artifact; ?>"></i>
                        </div>-->
                            </div>



                        </td>
                        <td colspan="5">
                            <table width="100%">
                                <tr>
                                    <td style="width: 33%" colspan="2" class="center"><span style="text-align: left"
                                                                                            class="glyphicon glyphicon-map-marker"></span>
                                    </td>
                                    <td style="width: 33%" colspan="" class="center"><span style="text-align: left"
                                                                                           class="glyphicon glyphicon-time"></span>
                                    </td>
                                    <td style="width: 33%" colspan="" class="center"><span
                                            class="glyphicon glyphicon-modal-window"></td>
                                </tr>
                                <tr>
                                    <td style="width: 33%" colspan="2" class="center"><?php echo $assignedPromotion['property_abbr'] ?></td>
                                    <td style="width: 33%" colspan="" class="center"><?php echo $assignedPromotion['scene_duration'] ?>&nbsp;<?php echo $assignedPromotion['promotion_type_scene_verbage']; ?></td>
                                    <td style="width: 33%" colspan="" class="center">

                                        <?php if($assignedPromotion['skin_id']==0){
                                            echo("Default Skin");
                                        }else{
                                            echo ($currentSkin["skin_name"]);
                                        }
                                             ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
        <?php
    } ?>

    </tbody>
</table>
</div>

<script>

    //console.log("curDisplay: " + JSON.stringify(Displays[]));
    console.log("Loading Display")
    Display = Displays["<?php echo($_POST["linkcode"]) ?>"]
    <?php if ($permission->hasPermissionById('display', $property['property_id'], 'U') || $_SESSION['isGod']) { ?>
    $('.moveTile').toggle(true);
    $(".promo-title-handle").toggleClass("hidden",false)
    $("#EditDisplayNameForm").toggle(true);
    sortOrder = [];
    $(function () {
        $(".sortable").sortable({
            handle: ".promo-title-handle",
            receive: function (event, ui) {
                console.log("id=" +$(ui.item).id + " skin" + $(ui.item).data('skin-id')+ " Time" + $(ui.item).data('default-time') + "   property-id:" + $(ui.item).data('property-id'))
                addPromotionToDisplay($(ui.item).data("promo-id"), $(ui.item).data('skin-id'), $(ui.item).data('default-time'),$(ui.item).data('property-id'));
            },

            deactivate: function (event, ui) {
                sortOrder = [];
                itm = $(ui.item).data("promoid");
                i = 0
                $(".promo-list-item").each(function () {
                    console.log($(this).data("promoid") + " is: " + i)
                    tmpItem = {
                        promoid: $(this).data("promo-property-id"),
                        order: i
                    }
                    sortOrder.push(tmpItem)
                    i++
                })
                console.log("Dropping: " + $(ui.item).data("promoid"))
                console.log(JSON.stringify(sortOrder))
                submitPromotionOrder(sortOrder)
            }
        });
        $(".sortable").disableSelection();
        //$(".promo-item td:contains(...)").parent().remove()
    });

    $(".dragToPromos").draggable({
        handle: "span[class*='moveTile']",
        connectToSortable: ".sortable",
        helper: "clone",
        revert: "invalid"
    });
    <?php } ?>
    function submitPromotionOrder(sortOrder) {

        $.ajax({
            url: 'controllers/displaycontroller.php',
            type: 'post',
            global: false,
            data: {
                action: 'updateDisplayOrder',
                promos: sortOrder
            },
            cache: false,
            success: function (msg) {
                //console.log(msg)
            },
            error: function (xhr, desc, err) {
                console.log(xhr + "\n" + err);
            }
        });
    }

    $(function() {
        $("#EditDisplayNameForm").hide();
    });
</script>
