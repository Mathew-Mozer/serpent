<?php
require "../../models/PromotionModel.php";
require_once("../../dependencies/php/HelperFunctions.php");
require_once(getServerPath() . "dbcon.php");

//Create database connection object
$dbcon = NEW DbCon();

//Create models
$promotion = new PromotionModel($dbcon->read_database());

$properties = $promotion->getAssignableProperties();
if (isset($_POST["promotion_id"])) {

}
$ThumbBackURL = "dependencies/images/MenuObjects/Backgrounds/";
?>
<script>
    $(function () {
        $("#accordion").accordion();
    });
</script>
<style>
    .draggable {
        width: 90px;
        height: 80px;
        padding: 5px;
        float: left;
        margin: 0 10px 10px 0;
        font-size: .9em;
        cursor: pointer;
    }

    .ui-widget-header p, .ui-widget-content p {
        margin: 0;
    }

    #snaptarget {
        height: 140px;
    }

    .drag_elm {
        width: 80px;
        height: 80px;
        background: aqua;
        border: 1px solid red;
    }

    .draggable {
        padding: 0px;
        margin-bottom: 0px;
        width: 135px;
    }

    .Menu-Object {
        background-color: transparent;
        font-size: 30px;
        font-family: Arial;
        margin: 0;
        padding: 0;
        color: black;
        cursor: default;
        position: absolute;
        display: inline-block;
        white-space: nowrap;
        font-weight: normal;
    }

    .Menu-Object:hover {
        cursor: pointer;
    }

    .menu-tile {
        border-radius: 5px;
        background: #73AD21;
        padding: 5px;
        width: 135px;
        height: 50px;
        font-size: 30px;

    }

    .Picture-Slideshow {
        text-align: center;
        border: 1px solid black;
        outline: 1px solid white;
        width: 288px;
        height: 162px;
        background-color: whitesmoke;
    }

    .hide-window {
        position: absolute;
        top: -9999px;
        left: -9999px;
    }

    .selected-Item {
        border: 1px solid red;
        z-index: 9000;
    }

    .Menu-Object span.glyphicon-move {
        font-size: xx-large;
        color: black;
        background-color: lightgrey;
        display: none;
        left: 50%;
        top: -15px;
        position: absolute;
     }
    .RotateNW {
        -webkit-transform: rotate(45deg);
        -moz-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -o-transform: rotate(45deg);
    }

    .RotateSW {
        -webkit-transform: rotate(-45deg);
        -moz-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        -o-transform: rotate(-45deg);
    }

    .RotateNE {
        -webkit-transform: rotate(-225deg);
        -moz-transform: rotate(-225deg);
        -ms-transform: rotate(-225deg);
        -o-transform: rotate(-225deg);
    }

    .RotateSE {
        -webkit-transform: rotate(225deg);
        -moz-transform: rotate(225deg);
        -ms-transform: rotate(225deg);
        -o-transform: rotate(225deg);
    }

    .move-ObjButton {
        font-size: xx-large;
    }
</style>

<div id="add-promotion">
    <?php
    if (isset($_POST['promotion_id'])) {
        ?>
        <table class="table-bordered" style="table-layout: fixed">
            <tr>
                <td style="width: 75px; ">
                    <div style="width: 210px">
                        <div id="accordion">
                            <h3>Objects</h3>
                            <div>
                                <div id="MenuLabel" data-type="Label" class="draggable menu-tile"><p>Text Box</p></div>
                                <div id="MenuLabel" data-type="Label" class="draggable menu-tile">§</div>
                                <div data-type="PictureSlideshow" class="draggable menu-tile"
                                     style="font-size: medium; text-align: center">
                                    Picture Slideshow
                                </div>
                                <div>
                                    <img id="MenuIconGF" data-type="Icon" class="draggable"
                                         src="..\dependencies\images\MenuObjects\Icons\icon-glutenfree.png"
                                         style="width: 40px; height: 40px" hidden>
                                </div>
                            </div>
                            <h3>Backgrounds</h3>
                            <div>
                                <p>
                                <div style="overflow-y: scroll; overflow-x: hidden; height: 350px">
                                    <?php
                                    //C:\Users\Mathew\Documents\GitHub\serpent\public_html\dependencies\images\MenuObjects\Backgrounds\2d3c34fcd41c6770f3185af7076e8623.jpg
                                    $dir = getcwd() . "/../../dependencies/images/MenuObjects/Backgrounds";
                                    $allfiles = scandir($dir);
                                    $files = array_diff($allfiles, array('.', '..'));
                                    foreach ($files as $file) {
                                        if ($file != ".")
                                            ?>

                                            <img data-type="Background" class="use-background" data-filename="<?php echo($file) ?>"
                                        data-bg-size="960px 540px" data-bg-repeat="no-repeat"
                                        data-fullurl="<?php echo($file) ?>"
                                        src="<?php echo($ThumbBackURL) ?><?php echo($file) ?>"
                                        style="width: 150px; height: 100px">
                                        <?php
                                    }
                                    ?>

                                </div>

                                </p>
                            </div>
                            <h3>Tags</h3>
                            <div>
                                <p>
                                <div id="Tag-Holder">
                                </div>
                                </p>
                            </div>
                        </div>
                    </div>
                </td>
                <td style="width: 960px; height: 540px; border-style: solid;border: #32ebff">

                    <div id="content_area" class="ui-widget-header"
                         style="background-color: #0d6aad; width: 960px;height: 540px; margin-top: 0px; background-image: url("dependencies/images/MenuObjects/Backgrounds/bg1.jpg')">

                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <button type="button" id="save-fb-layout">Save Layout</button><Br>
                   <span>Select Multiple Elements  </span><br>
                    <input class="switch-wrapper swtchbtn" id="SelectMultiMenuObjects" type="checkbox" value="0">
                </td>
                <td colspan="2">
                    <table id="label_properties" class="properties-window hide-window">
                        <tr>
                            <td>Label Properties</td>
                            <td></td>
                            <td>Tags(Space Seperated)</td>
                            <td><input class="labeltag"></td>
                            <td rowspan="4">
                                <table>
                                    <tr>
                                        <td>
                                    <tr>
                                        <td><span data-direction="nw" class="glyphicon glyphicon-arrow-left move-ObjButton RotateNW"></span>
                                        </td>
                                        <td><span data-direction="n" class="glyphicon glyphicon-arrow-up move-ObjButton"></span></td>
                                        <td><span data-direction="ne" class="glyphicon glyphicon-arrow-left RotateNE move-ObjButton"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span data-direction="w" class="glyphicon glyphicon-arrow-left move-ObjButton"></span></td>
                                        <td></td>
                                        <td><span data-direction="e" class="glyphicon glyphicon-arrow-right move-ObjButton"></span></td>
                                    </tr>
                                    <tr>
                                        <td><span data-direction="sw" class="glyphicon glyphicon-arrow-left RotateSW move-ObjButton"></span>
                                        </td>
                                        <td><span data-direction="s" class="glyphicon glyphicon-arrow-down move-ObjButton"></span></td>
                                        <td><span data-direction="se" class="glyphicon glyphicon-arrow-left RotateSE move-ObjButton"></span>
                                        </td>
                                    </tr>
                                    </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>ID:</td>
                            <td></td>
                            <td>Left</td>
                            <td><input id="mbLeft"></td>
                        </tr>
                        <tr>
                            <td>Text</td>
                            <td><input id="labeltext"></td>
                            <td>Top</td>
                            <td><input id="mbTop"></td>
                        </tr>
                        <tr>
                            <td>Font Size</td>
                            <td><input type="number" id="labelfont" value="16"></td>
                            <td>Hint</td>
                            <td><input type="text" id="labelhint" placeholder="IE: Blackjack Jackpot" value=""></td>
                        </tr>
                        <tr>
                            <td>Font Color</td>
                            <td><input id="labelfontcolor" type="text" class="spectrumlbl" value=""></td>
                            <td>Editable By Staff</td>
                            <td><input type="checkbox" id="labelebs"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="button" id="delete-fb-object">Delete Object</button>
                                <button type="button" id="copy-fb-object" hidden>Copy Object</button>
                            </td>
                        </tr>
                    </table>
                    <table id="slideshow_properties" class="properties-window hide-window">
                        <tr>
                            <td>SlideShow Properties</td>
                        </tr>
                        <tr>
                            <td>ID:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Linked Picture Slideshow</td>
                            <td>
                                <select id="fb-slideshow">
                                    <option value="0">None</option>
                                    <?php
                                    foreach ($properties as $property) {
                                        foreach ($promotion->getAllPromotionsByProperty($property["property_id"], "5") as $promo) {
                                            ?>
                                            <option value="<?php echo($promo["promotion_id"]) ?>"><?php
                                                if (trim($promo["promotion_label"]) == "") {
                                                    $title = $promo["promotion_type_title"];
                                                } else {
                                                    $title = $promo["promotion_label"];
                                                }
                                                echo($promo["promotion_id"] . " - " . $title);
                                                ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                Height:<input type="number" value="" id="mbPictureSizeH" style="width: 60px">x
                                Width:<input id="mbPictureSizeW" type="number" style="width: 60px">
                                <br>
                                <button type="button" id="biggerPictureSlideshow">Bigger</button>
                                <button type="button" id="smallPictureSlideshow">Smaller</button>
                                <br>
                                <input type="checkbox" id="advandcedPictureSize">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="button" id="delete-fb-object">Delete Object</button>
                                <button type="button" id="copy-fb-object" hidden>Copy Object</button>
                            </td>
                        </tr>
                    </table>
                    <table id="icon_properties" class="properties-window  hide-window">
                        <tr>
                            <td>Icon Properties</td>
                        </tr>
                        <tr>
                            <td>ID:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Height</td>
                            <td><input type="number" id="iconheight"></td>
                        </tr>
                        <tr>
                            <td>Width</td>
                            <td><input type="number" id="iconwidth"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="button" id="delete-fb-object">Delete Object</button>
                                <button type="button" id="copy-fb-object" hidden>Copy Object</button>
                            </td>
                        </tr>
                    </table>
                </td>

            </tr>

        </table>


    <?php } else {
        echo("This promotion is configured entirely after setup");
    } ?>

    <!-- Make sure to set the scene ID correctly  -->
    <input type="hidden" id="scene-id" name="scene_id" value="16">
</div>

<script src="dependencies/js/promotion/formhelperfunctions.js?t=<?php echo microtime() ?>"></script>

<?php
if (isset($_POST['promotion_settings'])) {
    if ($_POST['promotion_settings']) {
        echo "<script>getModalData(" . $_POST['promotion_id'] . "," . $_POST['promotion_type'] . ");</script>";
        echo "<script>
        var loadedpromo=true;
        PromotionRef = firebase.database().ref('Promotions/' + promoid + \"/layout\");
</script>";
    }
}
?>
<?php
if (isset($_POST['promotion_id'])) {
    ?>
    <script>
        var multiSelectMenuObject=false;
        $('.swtchbtn').switchButton().change(function () {
            multiSelectMenuObject = $(this).prop("checked") ? 1 : 0;
        });
        $(document).on('click', '#biggerPictureSlideshow', function () {
            $("#mbPictureSizeW").val(+$("#mbPictureSizeW").val() + 10)
            //$("#mbPictureSizeH").trigger("change")
            $("#mbPictureSizeH").val(Math.round(+$("#mbPictureSizeW").val() * .5623));
            resizePictureFrame()
        });
        $(document).on('click', '#smallPictureSlideshow', function () {
            $("#mbPictureSizeW").val(+$("#mbPictureSizeW").val() - 10)
            //$("#mbPictureSizeH").trigger("change")
            $("#mbPictureSizeH").val(Math.round(+$("#mbPictureSizeW").val() * .5623));
            resizePictureFrame()
        });
        $("#mbPictureSizeW").bind("propertychange change keyup input paste", function (event) {
            console.log("Changing Height")
            resizePictureFrame()
        });
        $("#mbLeft").bind("propertychange change keyup input paste", function (event) {
            $(".selected-Item").css("left", $("#mbLeft").val() / 2)
        });
        $("#mbTop").bind("propertychange change keyup input paste", function (event) {
            $(".selected-Item").css("top", $("#mbTop").val() / 2)
        });
        function resizePictureFrame() {
            $(".selected-Item").css("width", $("#mbPictureSizeW").val() / 2)
            $(".selected-Item").css("height", $("#mbPictureSizeH").val() / 2)
        }
        var MenuElementCount = 0;
        var deletedupdates = {};
        LoadRestaurantMenu(<?php echo($_POST['promotion_id'])?>);
        $(".draggable").draggable({
            containment: "#content_area",
            helper: "clone",
            grid: [10, 10],
            start: function () {
            },
            stop: function () {
                //console.log('stopped')
            }
        });
        $("#content_area").droppable({
            drop: function (event, ui) {
                //this if condition is for avoiding multiple time drop and attachment of same item
                if (ui.draggable.hasClass("draggable")) {
                    var $item = $(ui.helper).clone(); //getting the cloned item
                    MenuElementCount++;
                    $(this).append($item);
                    makeDraggable($item);
                }
            }
        })
        function SpectrumIt($item) {
            $item.spectrum({
                showInput: true,
                allowEmpty: true,
                clickoutFiresChange: true,
                showInitial: true,
                showPalette: true,
                appendTo: "#promotion-view-modal",
                preferredFormat: "hex",
                change: function (color) {

                    $(".selected-Item").css("color", color.toHexString());
                }
            });
        }
        var FullBackURL = "dependencies/images/MenuObjects/Backgrounds/";

        $(document).on('click', '.use-background', function () {

            $("#content_area").css("background-image", "url('" + FullBackURL + $(this).data("fullurl") + "')");
            $("#content_area").css("background-repeat", $(this).data("bg-repeat"));
            $("#content_area").css("background-size", $(this).data("bg-size"));
            $("#content_area").attr('data-filename', $(this).data("filename"))
        });
        $('.labeltag').val($(".selected-Item").attr("data-tags"))
        $(".labeltag").bind("propertychange change keyup input paste", function (event) {
            $(".labeltag").val($(".labeltag").val().toUpperCase())
            $(".selected-Item").attr("data-tags", $(this).val())
            UpdateMenuTags();
        })
        updates = {};
    </script>
<?php } else {

} ?>
