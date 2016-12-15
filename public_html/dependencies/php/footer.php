<?php
/*
* This page controls the footer and closing material for the website
*/
?>

<script src="dependencies/js/optionsmodal.js"></script>
<script src="dependencies/js/addpromotionmodal.js"></script>
<script src="dependencies/js/createproperty.js"></script>
<script src="dependencies/js/displayview.js"></script>
<script src="dependencies/js/promotionmodal.js"></script>
<script src="dependencies/js/editdisplay.js"></script>
<script src="dependencies/js/promotion.js"></script>
<script src="dependencies/js/addusermodal.js"></script>
<script>

    $(document).ready(function() {

        checkDowntime();

        $('.displays').hide();

        $('#unassigned-displays').hide();
        $('.displays').hide();
        $('#unassigned-displays').hide();

        //Load tooltips
        $('[data-toggle="tooltip"]').tooltip();

        //Show option bar
        $(".tile-body").hover(showOptionsBar, hideOptionsBar);

        //toggle lock icon
        $(document).on({

            mouseenter: function(){

                if($(this).find("i").hasClass("locked")) {
                    $(this).find("i").toggleClass("fa-lock fa-unlock");

                }else {
                    $(this).find(".unlocked").toggleClass("hidden fa-lock");
                }

        }, mouseleave: function() {

                if ($(this).find("i").hasClass("locked")) {
                    $(this).find("i").toggleClass("fa-unlock fa-lock");

                } else{
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

        $(document).on("click", ".toggleMonitorStatusBtn", function(){
            var currentObject = $(this);
            var displayId = $(this).data("display-id");
            var monitorState =  parseInt($(this).data("monitor-state"))+1;
            toggleMonitorStatusBtnClick(currentObject,displayId,monitorState)
        });

        $(document).on("click", ".promotionLockBtn", function(){
            var lockstatus = Boolean($(this).data("promo-lockstatus"));
            var promoId = $(this).data("promo-id");
            var displayId = $(this).data("display-id");
            var propertyName = $(this).data("property-name");
            var propertyId = $(this).data("property-id");
            promoLockButtonClick(lockstatus,promoId,displayId,propertyName,propertyId);
        });

        /**
         * Register add promotion tile click
         */
        $(".add-promotion-btn").unbind('click').click(function () {
            $('input[name=propertyId]').val(this.id);
            $('#promotion_type_select').load("views/addpromotionoptionview.php", {propertyId: this.id});
            addPromotionModal.dialog('open');
        });

        //Open add/remove user panel
         $("#userBtn").click(function () {
         createUserModal.dialog('open');
         });

        /**
         * Opens the property modal
         */
        $("#create-property-btn").click(function () {
            createPropertyModal.dialog('open');
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
        $(document).on("click", ".edit-display-btn", function(){
            var propertyId = $(this).data("property-id");
            var displayId= $(this).data("display-id");
            var propertyName = $(this).data("property-name");

            showEditDisplayModal(propertyId,displayId,propertyName);
        });


        function showEditDisplayModal(propertyid,displayid,propertyname){
            $("#editDisplayModal").load("modals/displaymodalform.php", {propertyId: propertyid, displayId: displayid,propertyName: propertyname});
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
       function checkDowntime(){

            $.ajax({
                type: "GET",
                url: "controllers/boxstatuscheck.php",
                dataType: "json",
                cache: false,
                success: function (response){

                    $.each(response, function(index, value) {

                    if(parseInt(value['display_monitor']) == 1) {
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


    /**
     * Switch the display to alert mode
     * @param displayID
     */
    function setDisplayDownAlert(displayID){

        clearBoxState(displayID);
        $("#display-box-id-" + displayID).addClass("display-background-down");
        addAlarmText(displayID);
    }

        /**
         * Switch the display to recovering
         * @param displayID
         */
        function setDisplayRecoveringAlert(displayID){
            clearBoxState(displayID);
            $("#display-box-id-" + displayID).addClass("display-background-recovering");
            addAlarmText(displayID);
        }

        /**
         * Switch the display to stable
         * @param displayID
         */
        function setDisplayNormal(displayID){
            clearBoxState(displayID);
            $("#display-box-id-" + displayID).addClass("display-background-normal");
            $("#display-box-id-" + displayID).find("#display-name").addClass("display-font");
            $("#display-box-id-" + displayID).find("#display-location").addClass("display-font");
        }

        /**
         * Clear all formatting
         * @param displayID
         */
        function clearBoxState(displayID){
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
        function addAlarmText(displayID){
            $("#display-box-id-" + displayID).find("#display-name").addClass("display-font-alarm");
            $("#display-box-id-" + displayID).find("#display-location").addClass("display-font-alarm");
        }

        $('#settings').on('dialogclose', function(event) { $('#settings').empty(); });


        $('#addPromotion').on('dialogclose', function(event) {
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
    })
</script>
</html>
