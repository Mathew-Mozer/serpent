<br>
<style>
    .imagecontainer{
        background-color: #cce6ff;
        margin-right: auto;
        margin-left: auto;
    }
    .imageOptions{
        background-color: #0066cc;
        margin-right: auto;
        margin-left: auto;
        color: whitesmoke;
        font-weight: bolder;
        text-align: center;
    }
    .btn-del-link{
        color: red;
    }
    .btn-link:hover{
        color: darkred;
    }
    .picviewer {
        border-style: inset;
        border-color: #0066cc;
        table-layout: fixed;
    }
    .verttext{
        transform: rotate(-90deg) translate(-100%, 0);
        transform-origin: 0 0;
        font-size: 40px;
        padding-right: 100px;
        font-family: Verdana;
        color: #99ceff;
    }

</style>
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
$PromoDetails = $PicViewerModel->get($_POST['promoid']);
$PicViewerPictures = $PicViewerModel->getAllPictures($_POST['promoid']);
$target_dir = "/clientpictures/uploads/".$_POST['promoid']."/";
if($PromoDetails["picview_settings_vertical"]){
    //echo("<div><b>Images are rotated for easier viewing but are indeed vertical.</b></div><br>");
}

if (count($PicViewerPictures) > 0) {
    foreach ($PicViewerPictures as $PicViewerPicture) {
        if (file_exists($_SERVER["DOCUMENT_ROOT"].$target_dir.$PicViewerPicture['picview_pictures_filename'])) {
        ?>
        <div class="FloatLeft">
            <table class="picviewer" >

                <tr style="height: <?php
                if($PromoDetails["picview_settings_vertical"]){echo("270"); $colsp=2;}else{echo('163');$colsp=1;}?>px" class="imagecontainer">
                    <?php if($PromoDetails["picview_settings_vertical"]){?>
                    <td width="10px"><p class="verttext">Vertical</p></td>
                    <?php }?>
                    <td class="test"><img class="PicListImage" style="height: 180px; width: 250px "
                             src="../../clientpictures/uploads/<?php echo($_POST['promoid']) ?>/<?php echo($PicViewerPicture['picview_pictures_filename']) ?>">
                        </td>
                </tr>
                <tr class="imageOptions">
                    <td colspan="<?php echo($colsp) ?>">Duration: <input class="picviewduration" data-picid="<?php echo($PicViewerPicture['picview_pictures_id']) ?>" style="width: 40px; color: black" type="number" value="<?php echo($PicViewerPicture['picview_pictures_duration']) ?>"> Seconds <br> Order: <input class="picvieworder" data-picid="<?php echo($PicViewerPicture['picview_pictures_id']) ?>" style="width: 40px; color: black" type="number" value="<?php echo($PicViewerPicture['picview_pictures_order']) ?>">&nbsp; <span class='btn btn-del-link btn-link glyphicon glyphicon-trash delete-picture-slideshow' data-picname="<?php  echo($PicViewerPicture['picview_pictures_filename'])?>" data-picid="<?php echo($PicViewerPicture['picview_pictures_id']) ?>" name='remove-picture'></span></td>
                </tr>
            </table>

        </div>


        <?php
        } else {
            $PicViewerModel->RemovePicture($PicViewerPicture['picview_pictures_id']);
        }
    }
}

if($PromoDetails["picview_settings_vertical"]){
?>
<script>
    $(".PicListImage").css({'white-space': 'nowrap'});
    $(".PicListImage").css({'transform': 'rotate(-90deg)'});
    $(".picviewer").css({'width': '250px'});
    $(".FloatLeft").css({'width': '250px'});
    $(".FloatLeft").css({'height': '350px'});
</script>

<?php } ?>
<script>
    $(".picviewduration").each(function () {
        if($(this).val()>0){
            $(this).closest('td').css({'background-color': '#0066cc'});
            console.log("called this");
        }else{
            //$(this).val('0');
            $(this).closest('td').css({'background-color': '#800000'});
            console.log("called that");
        }
    })


</script>
