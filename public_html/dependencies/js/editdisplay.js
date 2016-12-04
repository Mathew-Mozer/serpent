/**
 * This file controls the edit display modal
 */

/**
 * Create the edit display modal
 * @type {any}
 */
var editDisplayModal = $("#editDisplayModal").dialog({
    autoOpen: false,
    height: 450,
    width: 500,
    modal: true,
    buttons: {
        Close: function(){
            editDisplayModal.dialog('close');
        },

        Save: function(){
            var propertyId = $("#property-id-form").data("propertyId");
            var displayId = $("#display-id-form").data("displayId");
            var displayName = $('input[name=displayName]').val();
            var displayLocation = $('input[name=displayLocation]').val();
            var promotions = document.getElementsByClassName('promotions-in-display');

            var promotionsFormatted = [];
            $.each(promotions, function(index, value){
                var promotionId = value.value;
                var sceneDuration = $('#scene-duration-'+promotionId).val();

                promotionsFormatted.push({promotionId : value.value, displayId : value.dataset.displayId,
                    checked : value.checked, sceneDuration: sceneDuration});
            });

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
                    //location.reload();
                    editDisplayModal.dialog('close');
                },
                error: function(xhr, desc, err) {
                    console.log(xhr + "\n" + err);
                }
            });
        }
    }
});