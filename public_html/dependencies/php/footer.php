<?php
/*
* Footer
* Author: Stephen King
* Version 2016.10.5.3
*
* This page controls the footer and closing material for the website
*/
?>
<script>

    $(document).ready(function () {

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


        /**
         * This is for click listeners
         */


        $(".tile-body").unbind('click').click(tileBodyClick);

        $(".settingsBtn").unbind('click').click(settingsButtonClick);


        $(".add-promotion-btn").unbind('click').click(function () {
            $('input[name=propertyId]').val(this.id);
            $('#promotion_type_select').load("views/addpromotionoptionview.php", {propertyId: this.id});
            addPromotionModal.dialog('open');
        });

        $("#create-property-btn").click(function () {
            createPropertyModal.dialog('open');
        });

        //Toggle between promotion and display view
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

        $(".display-options").click(function () {
            getDisplayById(this.id);
        });

        $("#logoutBtn").click(function () {
            logoutUser();
        });

        //Open display modal
        $(".edit-display-btn").unbind('click').click(function () {
            var propertyId = $(this).data("property-id");
            var displayId = $(this).data("display-id");
            $("#editDisplayModal").load("modals/displaymodalform.php", {propertyId: propertyId, displayId: displayId});
            editDisplayModal.dialog('open');
        });

        $("#options-btn").click(function () {
            alert('toolbar options');
        });

        /**
         * End Click Listeners
         */
    });
</script>

</html>
