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
    $(document).ready(function(){

        $('.displays').hide();
        $('#unassigned-displays').hide();

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

    $(".tile-body").unbind('click').click(function(){
      promotionViewModal.dialog('open');
      $("#promotion-view-modal").data('promo-id', $(this).data("promo-id"));
      $("#promotion-view-modal").load("views/displaypromotionviews/"+$(this).data("promo-type")+"view.php");

    });

		/**
		* This is for click listeners
		*/


        $(".settingsBtn").unbind('click').click(function(e){
            e.stopPropagation();
           var ids = $(this).attr('id').split('-');
           <?php echo "var id=".$_SESSION['userId'].";"; ?>
           var perm = canDelete(ids[0],id);
           getSettings(ids[1],ids[2], perm);
         });


       $(".add-promotion-btn").unbind('click').click(function(){
          $('input[name=casinoId]').val(this.id);
           $('#promotion_type_select').load("views/addpromotionoptionview.php", {casinoId: this.id});
           addPromotionModal.dialog('open');
       });

/*        //Open add/remove user panel
        $(".userBtn").unbind('click').click(function () {
            editUsersModal.dialog('open');
        });*/

        $("#create-casino-btn").click(function(){
            createCasinoModal.dialog('open');
        });
        //Toggle between promotion and display view
        $(".toggle-display-btn").click(function() {
            $(this).addClass("hidden");
            if($(this).attr("id") === "toggle-display"){
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

        $(".display-options").click(function() {
            getDisplayById(this.id);
        });

        $("#logoutBtn").click(function () {
            logoutUser();
        });

        /**
         * End Click Listeners
		*/

			//Open display modal
	$(".edit-display-btn").unbind('click').click(function () {
    var casinoId = $(this).data("casino-id");
    var displayId = $(this).data("display-id");
    $("#editDisplayModal").load("modals/displaymodalform.php", {casinoId : casinoId, displayId : displayId});
		editDisplayModal.dialog('open');
	});


        /*
         These are the modal windows that can be opened. Note that these need
         to be moved to their own file. Most likely they should just be aggregated
         as they are 90% similar.
         */

    });
</script>
</html>
