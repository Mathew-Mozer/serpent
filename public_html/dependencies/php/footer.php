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

        //Load tooltips
        $('[data-toggle="tooltip"]').tooltip();

        //Show option bar
        $(".tile-body").hover(function () {
            $(this).children(".tile-menu-bar").removeClass("hidden");
        }, function () {
            $(this).children(".tile-menu-bar").addClass("hidden");

        });
        //highlight option under mouse
        $(".tile-menu-item").hover(function () {
            $(this).addClass("tile-menu-item-hover");
        }, function () {
            $(this).removeClass("tile-menu-item-hover");

        });

        /**
         * This is for click listeners
         */
        $("#createCasinoBtn").click(function () {
            createCasinoModal.dialog('open');
        });

        $(".settingsBtn").unbind('click').click(function () {
            var ids = $(this).attr('id').split('-');
            <?php echo "var id=" . $_SESSION['userId'] . ";"; ?>
            var perm = canDelete(ids[0], id);
            getSettings(ids[1], perm);
        });

        $(".add-promotion-btn").unbind('click').click(function () {
            $('input[name=casinoId]').val(this.id);
            addPromotionModal.dialog('open');
        });

        //Open add/remove user panel
        $(".userBtn").unbind('click').click(function () {
            editUsersModal.dialog('open');
        });

        $("#create-casino-btn").click(function () {
            createCasinoModal.dialog('open');
        });

        $("#logoutBtn").click(function () {
            logoutUser();
        });

        $('#boxViewBtn').click(function () {
            getBoxById(1);
        });
        /**
         * End Click Listeners
         */

    });

</script>
</html>
