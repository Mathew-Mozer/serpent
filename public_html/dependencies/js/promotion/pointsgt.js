/**
 * Delete
 * @param casinoId
 * @param promotionId
 */

var updatePromotion = function(promotionId){

    $.ajax({
        url: 'controllers/promotioncontrollers/pointsgtcontroller.php',
        type: 'post',
        data: {
            action: 'update',
            promotionId: promotionId
        },
        cache: false,
        beforeSend: function(){
            $(".loader").removeClass("hidden");
        },
        success: function(response) {

        },
        error: function(xhr, desc, err) {
            console.log(xhr + "\n" + err);
        },
        complete: function(){
            $(".loader").addClass("hidden");
        }
    });
};
