<?php
if (!isset($_SESSION)) {
    session_start();
}
require "../models/SkinModel.php";
require_once("../dependencies/php/HelperFunctions.php");
require_once(getServerPath() . "dbcon.php");
$dbcon = NEW DbCon();
$skinModel = new SkinModel($dbcon->read_database());
if (isset($_SESSION['userId']) && isset($_POST['skinTagId'])) {
$skinTag = $skinModel->getSkinTagById($_POST['skinTagId']);
$skinData = $skinModel->getSkinDataById($_POST['skinTagId'], $_POST['skinId']);
$skinColors = $skinModel->getUsedSkinColors($_POST['skinId']);
$colorlist = '"'.implode('","', $skinColors).'"';
?>
<div data-tag-id="<?php echo($skinTag['skin_tag_id']) ?>">
    <br>
    <input type="hidden" id="skin-data-id" value="<?php echo($skinData['skin_tag_data_id']) ?>">
    <div style="clear: both; margin 0 auto;position: absolute;left: 0px; ">
        <?php

        foreach ($skinColors as $color) {
            ?>
            <div
                style="border-style: solid;border-width: thin;border-color: gray;padding: 10px 10px 10px 10px; float: right; width:80px;background-color:<?php echo($color) ?> "><?php echo($color) ?></div>

            <?php
        }
        ?>
    </div><br><br><br>
    <table style="margin-right: auto;margin-left: auto; border-style: solid;border-width: thin;">
        <?php if ($skinTag) {

            ?>
            <?php if ($skinTag['skin_tag_name']) { ?>

                <tr>
                    <td colspan="2" style="text-align: center"><label><?php echo($skinTag['skin_tag_name']) ?></label>
                    </td>
                </tr>
            <?php } ?>
            <?php if (!$skinTag['skin_tag_x']) { ?>

                <tr>
                    <td><label>X Coord</label></td>
                    <td><input id="skin-data-xcoor" type="text" value="<?php echo($skinData['skin_tag_data_x']) ?>"></td>
                </tr>
            <?php } ?>
            <?php if (!$skinTag['skin_tag_y']) { ?>

                <tr>
                    <td><label>Y Coord</label></td>
                    <td><input id="skin-data-ycoor" type="text" value="<?php echo($skinData['skin_tag_data_y']) ?>"></td>
                </tr>
            <?php } ?>
            <?php if (!$skinTag['skin_tag_forecolor']) { ?>

                <tr>
                    <td><label>Foreground Color</label></td>
                    <td><input id="skin-data-forecolor" type="text" class="spectrumcl"
                               value="<?php echo($skinData['skin_tag_data_forecolor']) ?>"></td>
                </tr>
            <?php } ?>
            <?php if (!$skinTag['skin_tag_backcolor']) { ?>

                <tr>
                    <td><label>Background Color</label></td>
                    <td><input id="skin-data-backcolor" type="text" class="spectrumcl"
                               value="<?php echo($skinData['skin_tag_data_backcolor']) ?>"></td>
                </tr>
            <?php } ?>
            <?php if (!$skinTag['skin_tag_textcolor']) { ?>

                <tr>
                    <td><label>Text Color</label></td>
                    <td><input id="skin-data-textcolor" type="text" class="spectrumcl" value="<?php echo($skinData['skin_tag_data_textcolor']) ?>"></td>
                </tr>
            <?php } ?>
            <?php if (!$skinTag['skin_tag_width']) { ?>

                <tr>
                    <td><label>Width</label></td>
                    <td><input id="skin-data-width" type="text" value="<?php echo($skinData['skin_tag_data_width']) ?>"></td>
                </tr>
            <?php } ?>
            <?php if (!$skinTag['skin_tag_height']) { ?>

                <tr>
                    <td><label>Height</label></td>
                    <td><input id="skin-data-height" type="text" value="<?php echo($skinData['skin_tag_data_height']) ?>"></td>
                </tr>
            <?php } ?>
            <?php if (!$skinTag['skin_tag_backsprite']) { ?>

                <tr>
                    <td><label>Background Sprite</label></td>
                    <td><input id="skin-data-backsprite" type="text" value="<?php echo($skinData['skin_tag_data_backsprite']) ?>"></td>
                </tr>
            <?php } ?>
            <?php if (!$skinTag['skin_tag_foresprite']) { ?>

                <tr>
                    <td><label>Foreground Sprite</label></td>
                    <td><input id="skin-data-backsprite" type="text" value="<?php echo($skinData['skin_tag_data_foresprite']) ?>"></td>
                </tr>
            <?php } ?>
            <?php if (!$skinTag['skin_tag_bordercolor']) { ?>

                <tr>
                    <td><label>Border Color</label></td>
                    <td><input id="skin-data-bordercolor" type="text" class="spectrumcl"
                               value="<?php echo($skinData['skin_tag_data_bordercolor']) ?>"></td>
                </tr>
            <?php } ?>
            <tr>
                <td></td>
                <td style="text-align: right">
                    <label id="errorlabel">Select a skin to activate save button</label>

                    <button type="button" data-tag-id="<?php echo($skinTag['skin_tag_id'])?>" id="save-skin-btn" hidden>Save</button>
                </td>
            </tr>
        <?php }
        }
        ?>
    </table>
    <script>

        checkSaveButton();
        //spectrum

        $(".spectrumcl").spectrum({
            showInput: true,
            allowEmpty:true,
            clickoutFiresChange: true,
            showInitial: true,
            showPalette: true,
            preferredFormat: "hex",
            appendTo:"#createProperty",
            palette: [
                [<?php echo($colorlist)?>]
            ]

        });
    </script>
