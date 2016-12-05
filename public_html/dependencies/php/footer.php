<?php
/*
* This page controls the footer and closing material for the website
*/
?>
<script>

    $(document).ready(function(){

      $('.displays').hide();

      $('#unassigned-displays').hide();
        $('.displays').hide();
        $('#unassigned-displays').hide();

        //Load tooltips
        $('[data-toggle="tooltip"]').tooltip();

        //Show option bar
        $(".tile-body").hover(showOptionsBar,hideOptionsBar);

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
       $(".add-promotion-btn").unbind('click').click(function(){
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
        $("#create-property-btn").click(function(){
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
	$(".edit-display-btn").unbind('click').click(function () {
    var propertyId = $(this).data("property-id");
    var displayId = $(this).data("display-id");
    $("#editDisplayModal").load("modals/displaymodalform.php", {propertyId : propertyId, displayId : displayId});
		editDisplayModal.dialog('open');
	});

    /**
     * Open the options modal
     */
    $("#options-btn").click(function () {
        alert('toolbar options');
    });

    });
</script>
</html>
