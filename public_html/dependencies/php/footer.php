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
$('.displays').hide();
console.log("hide unassigned-displays");
$('#unassigned-displays').hide();
    $(document).ready(function(){
        console.log("hide displays");

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
           getSettings(ids[1], perm);
         });


       $(".add-promotion-btn").unbind('click').click(function(){
          $('input[name=propertyId]').val(this.id);
           $('#promotion_type_select').load("views/addpromotionoptionview.php", {propertyId: this.id});
           addPromotionModal.dialog('open');
       });

/*        //Open add/remove user panel
        $(".userBtn").unbind('click').click(function () {
            editUsersModal.dialog('open');
        });*/

        $("#create-property-btn").click(function(){
            createPropertyModal.dialog('open');
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
    var propertyId = $(this).data("property-id");
    var displayId = $(this).data("display-id");
    //console.log(propertyId + displayId);
    $("#editDisplayModal").load("modals/displaymodalform.php", {propertyId : propertyId, displayId : displayId});
		editDisplayModal.dialog('open');
	});

		var editDisplayModal = $("#editDisplayModal").dialog({
           autoOpen: false,
            height: 400,
            width: 350,
            modal: true,
            buttons: {
                Close: function(){
                    editDisplayModal.dialog('close');
                },

                Save: function(){
                  var propertyId = $("#property-id-form").data("property-id");
                  var displayId = $("#display-id-form").data("display-id");
                  var displayName = $('input[name=displayName]').val();
                  var displayLocation = $('input[name=displayLocation]').val();
                  var promotions = document.getElementsByClassName('promotions-in-display');

                  var promotionsFormatted = [];
                   $.each(promotions, function(index, value){

                      promotionsFormatted.push({promoId : value.value, displayId : value.dataset.displayId, checked : value.checked});
                    });

                      //console.log(promotionsFormatted);
                  $.ajax({

                      url: 'controllers/displaycontroller.php',
                      type: 'post',
                      data: {
                          action: 'update',
                          propertyId: propertyId,
                          displayId: displayId,
                          displayName: displayName,
                          displayLocation: displayLocation,
                          promotions: promotionsFormatted
                      },
                      cache: false,
                      success: function(response) {


                        location.reload();
                          editDisplayModal.dialog('close');
                      },
                      error: function(xhr, desc, err) {
                          console.log(xhr + "\n" + err);
                      }
                  });
                }
            }
        });

        /*
         These are the modal windows that can be opened. Note that these need
         to be moved to their own file. Most likely they should just be aggregated
         as they are 90% similar.
         */

    });
</script>
</html>
