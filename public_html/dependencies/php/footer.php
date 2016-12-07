<?php
/*
* This page controls the footer and closing material for the website
*/
?>
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

        //highlight option under mouse
        $(".tile-menu-item").hover(highlightCurrentOption, dehighlightCurrentOption);

        //Register tile click
        $(".tile-body").unbind('click').click(tileBodyClick);

        /**
         * This is for click listeners
         */
        $(".settingsBtn").unbind('click').click(settingsButtonClick);


        /**
         * Register add promotion tile click
         */
        $(".add-promotion-btn").unbind('click').click(function () {
            checkDowntime();
            $('input[name=propertyId]').val(this.id);
            $('#promotion_type_select').load("views/addpromotionoptionview.php", {propertyId: this.id});
            addPromotionModal.dialog('open');
        });

        /*        //Open add/remove user panel
         $(".userBtn").unbind('click').click(function () {
         editUsersModal.dialog('open');
         });*/

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

            checkDowntime();

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
        $(".edit-display-btn").unbind('click').click(function () {
            var propertyId = $(this).data("property-id");
            var displayId = $(this).data("display-id");
            $("#editDisplayModal").load("modals/displaymodalform.php", {propertyId: propertyId, displayId: displayId});
            editDisplayModal.dialog('open');
        });

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

                        //console.log("seconds:" + value["seconds"] + " Threshold: " + value["display_monitor_threshold_red"]);

                          if (value["seconds"] >= value["display_monitor_threshold_red"]) {

                              setDisplayDownAlert(value["display_id"]);
                          }else if(value["seconds"] >= value["display_monitor_threshold_yellow"] && value["seconds"] < value["display_monitor_threshold_red"]){
                              setDisplayRecoveringAlert(value["display_id"]);
                          }else if(value["seconds"] < value["display_monitor_threshold_yellow"] && value["seconds"] < value["display_monitor_threshold_red"]){
                              setDisplayNormal(value["display_id"])
                          }



                        });

                }
            });

       }



    function setDisplayDownAlert(displayID){

        clearBoxState(displayID);
        $("#display-box-id-" + displayID).addClass("display-background-down");
    }

    function setDisplayRecoveringAlert(displayID){
        clearBoxState(displayID);
        $("#display-box-id-" + displayID).addClass("display-background-recovering");
    }

    function setDisplayNormal(displayID){
        clearBoxState(displayID);
        $("#display-box-id-" + displayID).addClass("display-background-normal");
    }

    function clearBoxState(displayID){
        $("#display-box-id-" + displayID).removeClass("display-background-normal");
        $("#display-box-id-" + displayID).removeClass("display-background-recovering");
        $("#display-box-id-" + displayID).removeClass("display-background-down");
    }

    })
</script>
</html>
