<?php
/*
* This page controls the footer and closing material for the website
*/
?>

<script src="dependencies/js/optionsmodal.js?t=<?php echo microtime() ?>"></script>
<script src="dependencies/js/addpromotionmodal.js?t=<?php echo microtime() ?>"></script>
<script src="dependencies/js/createproperty.js?t=<?php echo microtime() ?>"></script>
<script src="dependencies/js/displayview.js?t=<?php echo microtime() ?>"></script>
<script src="dependencies/js/promotionmodal.js?t=<?php echo microtime() ?>"></script>
<script src="dependencies/js/editdisplay.js?t=<?php echo microtime() ?>"></script>
<script src="dependencies/js/promotion.js?t=<?php echo microtime() ?>"></script>
<script src="dependencies/js/addusermodal.js?t=<?php echo microtime() ?>"></script>
<script src="dependencies/js/editusermodal.js?t=<?php echo microtime() ?>"></script>
<script src="dependencies/js/editusers.js?t=<?php echo microtime() ?>"></script>
<script src="dependencies/js/viewdocuments.js?t=<?php echo microtime() ?>"></script>
<script src="dependencies/js/viewAccount.js?t=<?php echo microtime() ?>"></script>
<script src="dependencies/js/promotion/multipliermadness.js?t=<?php echo microtime() ?>"></script>
<script src="dependencies/js/promotion/monstercarlo.js?t=<?php echo microtime() ?>"></script>
<script src="dependencies/js/promotion/sessionmanager.js?t=<?php echo microtime() ?>"></script>
<script src="dependencies/js/promotion/timetracker.js?t=<?php echo microtime() ?>"></script>
<script src="dependencies/js/promotion/prizeevent.js?t=<?php echo microtime() ?>"></script>
<script src="dependencies/js/skinmanager.js?t=<?php echo microtime() ?>"></script>
<script src="dependencies/js/changepromostatus.js?t=<?php echo microtime() ?>"></script>
<script src="dependencies/js/uploadpicture.js?t=<?php echo microtime() ?>"></script>
<script src="dependencies/js/promotion/pointsgt.js?t=<?php echo microtime() ?>"></script>
<script src="dependencies/js/promotion/formhelperfunctions.js?t=<?php echo microtime() ?>"></script>
<script src="dependencies/js/JqueryTemplates/jquery.loadTemplate-1.4.4.js"></script>
<script>

    $(document).ready(function () {

        $(document).bind("ajaxSend", function () {
            loadThinkingDonut();
        }).bind("ajaxComplete", function () {
            unloadThinkingDonut();
        });
        var isMobile = false; //initiate as false

// device detection

        detectMobile();
        function detectMobile() {
            if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
                || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0, 4))) isMobile = true;
        }
        checkDowntime();


        $('.displays').hide();

        $('#unassigned-displays').hide();
        $('.displays').hide();
        $('#unassigned-displays').hide();

        //Load tooltips
        $('[data-toggle="tooltip"]').tooltip();

        //Show option bar

        if(isMobile){
            $(".tile-menu-bar").show();
        }
        $(".tile-body").hover(showOptionsBar, hideOptionsBar);
        $(".tile-status-btn").hover(showStatusBar, hideStatusBar);



        //toggle lock icon
        $(document).on({

            mouseenter: function () {

                if ($(this).find("i").hasClass("locked")) {
                    $(this).find("i").toggleClass("fa-lock fa-unlock");

                } else {
                    $(this).find(".unlocked").toggleClass("hidden fa-lock");
                }

            }, mouseleave: function () {

                if ($(this).find("i").hasClass("locked")) {
                    $(this).find("i").toggleClass("fa-unlock fa-lock");

                } else {
                    $(this).find(".unlocked").toggleClass("fa-lock hidden");
                }
            }
        }, ".promotionLockBtn");

        // $(this).children("i").removeClass("hidden");


        //   $(this).children("i").addClass("hidden");


        //highlight option under mouse
        $(".tile-menu-item").hover(highlightCurrentOption, dehighlightCurrentOption);

        //Register tile click
        $(".tile-body").unbind('click').click(tileBodyClick);

        /**
         * This is for click listeners
         */
        $(".settingsBtn").unbind('click').click(settingsButtonClick);
///
///
        $(".promotionStatusBtn").unbind('click').click(promoStatusButtonClick);
        $(".promotionDeleteBtn").unbind('click').click(promotionDeleteBtnClick);
        $(document).on("ajaxStop", function (e) {
        });
        $(document).on("click", ".toggleMonitorStatusBtn", function () {
            var currentObject = $(this);
            var displayId = $(this).data("display-id");
            var monitorState = parseInt($(this).data("monitor-state")) + 1;
            toggleMonitorStatusBtnClick(currentObject, displayId, monitorState)
        });

        $(document).on("click", ".promotionLockBtn", function () {
            var lockstatus = Boolean($(this).data("promo-lockstatus"));
            var promoId = $(this).data("promo-id");
            var displayId = $(this).data("display-id");
            var propertyName = $(this).data("property-name");
            var propertyId = $(this).data("property-id");
            promoLockButtonClick(lockstatus, promoId, displayId, propertyName, propertyId);
        });

        /**
         * Register add promotion tile click
         */
        $(".add-promotion-btn").unbind('click').click(function () {
            $('input[name=propertyId]').val(this.id);
            $("#select-skin-container").hide();
            $("#select-scene-style").hide();
            $('#promotion_type_select').data("point-storage",$(this).data("point-storage"));
            $('#promotion_type_select').load("views/addpromotionoptionview.php", {propertyId: this.id});
            addPromotionModal.dialog('open');
        });

        //Open add/remove user panel
        $("#userBtn").click(function () {
            $('#editUsersModal').load("views/editusersview.php", {propertyId: this.id});
            editUserModal.dialog('open');
        });
        $('div#editUsersModal').on('dialogclose', function (event) {
            $('#editUsersModal').empty();
        });
        /**
         * Opens the property modal
         */
        $("#create-property-btn").click(function () {
            createPropertyModal.dialog('open');
        });
        $("#view-account-btn").click(function () {
            $('#createProperty').load("views/accountview.php", {propertyId: this.id});
            viewAccountModal.dialog('open');
        });
        $("#skin-manager-btn").click(function () {
            $('#createProperty').load("views/SkinManager.php", {propertyId: this.id});
            viewAccountModal.dialog('open');
        });

        $("#view-documents-btn").click(function () {
            $('#createProperty').load("views/documentsview.php", {propertyId: this.id});
            viewDocumentsModal.dialog('open');
        });

        /**
         * Toggles display and promotion view
         */
        $(".toggle-display-btn").click(function () {
            $(this).addClass("hidden");
            if ($(this).attr("id") === "toggle-display") {
                //code to switch to display view
                $("#toggle-promotion").removeClass("hidden");
                $('.promotion-view').hide();
                $('#unassigned-displays').show();
                $('.displays').show();
            } else {
                //code to switch to promotion view
                $("#toggle-display").removeClass("hidden");
                $('.displays').hide();
                $('#unassigned-displays').hide();
                $('.promotion-view').show();
            }
        });

        /**
         * Opens the display modal
         */
        $(".display-options").click(function () {
            getDisplayById(this.id);
        });

        /**
         * Logeth Outeth
         */
        $("#logoutBtn").click(function () {
            logoutUser();
        });

        /**
         * End Click Listeners
         */

        /**
         * Open the edit display modal
         */
        $(document).on("click", ".edit-display-btn", function () {
            var propertyId = $(this).data("property-id");
            var displayId = $(this).data("display-id");
            var propertyName = $(this).data("property-name");

            showEditDisplayModal(propertyId, displayId, propertyName);
        });


        function showEditDisplayModal(propertyid, displayid, propertyname) {
            $("#editDisplayModal").load("modals/displaymodalform.php", {
                propertyId: propertyid,
                displayId: displayid,
                propertyName: propertyname
            });
            editDisplayModal.dialog('open');
        }

        /**
         * Open the options modal
         */
        $("#options-btn").click(function () {
            alert('toolbar options');
        });

        /**
         * Check for box problems every 5 seconds
         */
        window.setInterval(function () {
            checkDowntime();
        }, 5000);


        /**
         * Check to see if a box is down or recovered
         */
        function checkDowntime() {

            $.ajax({
                type: "GET",
                url: "controllers/boxstatuscheck.php",
                global: false,
                dataType: "json",
                data: {TypeOfStatus:"box"},
                cache: false,
                success: function (response) {
                    $.each(response, function (index, value) {

                        if (parseInt(value['display_monitor']) == 1) {
                            if (parseInt(value["last_checkin"]) >= parseInt(value["display_monitor_threshold_red"])) {
                                //console.log("Box is down!");
                                setDisplayDownAlert(value["display_id"]);

                            } else if (parseInt(value["uptime"]) <= parseInt(value["display_monitor_threshold_yellow"]) && parseInt(value["last_checkin"]) < parseInt(value["display_monitor_threshold_red"])) {
                                //console.log("Box is recovering!");
                                setDisplayRecoveringAlert(value["display_id"]);

                            } else if (parseInt(value["last_checkin"]) < parseInt(value["display_monitor_threshold_yellow"]) && parseInt(value["last_checkin"]) < parseInt(value["display_monitor_threshold_red"])) {
                                // console.log("box is stable");
                                setDisplayNormal(value["display_id"])
                            }
                        }

                    });

                }
            });

        }
        function checkAPI() {

            $.ajax({
                type: "GET",
                url: "controllers/boxstatuscheck.php",
                global: false,
                dataType: "json",
                data: {TypeOfStatus:"API"},
                cache: false,
                success: function (response) {

                }
            });

        }

        /**
         * Switch the display to alert mode
         * @param displayID
         */
        function setDisplayDownAlert(displayID) {

            clearBoxState(displayID);
            $("#display-box-id-" + displayID).addClass("display-background-down");
            addAlarmText(displayID);
        }

        /**
         * Switch the display to recovering
         * @param displayID
         */
        function setDisplayRecoveringAlert(displayID) {
            clearBoxState(displayID);
            $("#display-box-id-" + displayID).addClass("display-background-recovering");
            addAlarmText(displayID);
        }

        /**
         * Switch the display to stable
         * @param displayID
         */
        function setDisplayNormal(displayID) {
            clearBoxState(displayID);
            $("#display-box-id-" + displayID).addClass("display-background-normal");
            $("#display-box-id-" + displayID).find("#display-name").addClass("display-font");
            $("#display-box-id-" + displayID).find("#display-location").addClass("display-font");
        }

        /**
         * Clear all formatting
         * @param displayID
         */
        function clearBoxState(displayID) {
            $("#display-box-id-" + displayID).removeClass("display-background-normal");
            $("#display-box-id-" + displayID).removeClass("display-background-recovering");
            $("#display-box-id-" + displayID).removeClass("display-background-down");
            $("#display-box-id-" + displayID).find("#display-name").removeAttr("display-font");
            $("#display-box-id-" + displayID).find("#display-location").removeAttr("display-font-alarm");

        }

        /**
         * Change text to alarm
         * @param displayID
         */
        function addAlarmText(displayID) {
            $("#display-box-id-" + displayID).find("#display-name").addClass("display-font-alarm");
            $("#display-box-id-" + displayID).find("#display-location").addClass("display-font-alarm");
        }

        $('#settings').on('dialogclose', function (event) {
            $('#settings').empty();
        });


        $('#addPromotion').on('dialogclose', function (event) {
            $('#promotion-details').removeData();
            $('#addPromotion').children().hide();
            $('#promotion-details').hide();
            $('#use-template').hide();
            $('#template-form').hide();
            $('#create-template').hide();
            $('#add-promotion-buttons').empty();
            $('#promotion-select').show();
            $('#add-promotion-form').show();
        });

        function loadThinkingDonut() {
            $(".loader").removeClass("hidden");
        }

        function unloadThinkingDonut() {
            $(".loader").addClass("hidden");
        }

        unloadThinkingDonut();
    })
</script>
</html>
