
var editDisplayModal = $("#editDisplayModal").dialog({
    autoOpen: false,
    height: 410,
    width: 445,
    modal: true,
    buttons: {
        Close: function(){
            editDisplayModal.dialog('close');
        },

        Save: function(){
            var casinoId = $("#casino-id-form").data("casino-id");
            var displayId = $("#display-id-form").data("display-id");
            var displayName = $('input[name=displayName]').val();
            var displayLocation = $('input[name=displayLocation]').val();
            var promotions = document.getElementsByClassName('promotions-in-display');

            var promotionsFormatted = [];
            $.each(promotions, function(index, value){
                promotionId = value.value;
                var sceneDuration = $('#scene-duration-'+promotionId).val();
                promotionsFormatted.push({promoId : value.value, displayId : value.dataset.displayId,
                    checked : value.checked, sceneDuration: sceneDuration});
            });

            $.ajax({

                url: 'controllers/displaycontroller.php',
                type: 'post',
                data: {
                    action: 'update',
                    casinoId: casinoId,
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