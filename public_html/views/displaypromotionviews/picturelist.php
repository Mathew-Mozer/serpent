<br>
<?php
/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 1/16/2017
 * Time: 2:56 AM
 */
require_once("../../dependencies/php/HelperFunctions.php");
require_once(getServerPath() . "dbcon.php");
$dbcon = NEW DbCon();
require "../../models/promotionmodels/PicViewerModel.php";
$PicViewerModel = new PicViewerModel($dbcon->read_Database());
$PicViewerPictures = $PicViewerModel->getAllPictures($_POST['promoid']);
$target_dir = "/clientpictures/uploads/".$_POST['promoid']."/";

if (count($PicViewerPictures) > 0) {
    foreach ($PicViewerPictures as $PicViewerPicture) {
        if (file_exists($_SERVER["DOCUMENT_ROOT"].$target_dir.$PicViewerPicture['picview_pictures_filename'])) {
        ?>
        <div class="FloatLeft">
            <table>
                <tr>
                    <td><img style="height: 143px; width: 250px "
                             src="../../clientpictures/uploads/<?php echo($_POST['promoid']) ?>/<?php echo($PicViewerPicture['picview_pictures_filename']) ?>">
                    </td>
                </tr>
                <tr>

                    <td>Duration: <input class="picviewduration" data-picid="<?php echo($PicViewerPicture['picview_pictures_id']) ?>" style="width: 40px;" type="number" value="<?php echo($PicViewerPicture['picview_pictures_duration']) ?>"> Seconds &nbsp; <span class='btn btn-link glyphicon glyphicon-trash delete-picture-slideshow' data-picname="<?php  echo($PicViewerPicture['picview_pictures_filename'])?>" data-picid="<?php echo($PicViewerPicture['picview_pictures_id']) ?>" name='remove-picture'></span></td>
                </tr>
            </table>
        </div>
        <?php
        } else {
            $PicViewerModel->RemovePicture($PicViewerPicture['picview_pictures_id']);
        }
    }
}


?>