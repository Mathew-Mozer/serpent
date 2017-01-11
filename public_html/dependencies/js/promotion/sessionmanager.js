$(document).on("click", ".PromotionDetailsBtn", function(){
    $('.PromotionDetailsBtn').hide();
    $('.PromotionSessionBtn').show();
    $('#session-manager').hide();
    $('#add-promotion').show();
});/**
 * Created by Mathew on 1/10/2017.
 */
$(document).on("click", ".PromotionSessionBtn", function(){
    $('.PromotionDetailsBtn').show();
    $('.PromotionSessionBtn').hide();
    $('#session-manager').show();
    $('#add-promotion').hide();
    loadSessionContent();


});/**
 * Created by Mathew on 1/10/2017.
 */
$(document).on("click", ".add-session-btn", function(){
    promoId=$('#promoId').val();
    sDay=$('#sday').val();
    sTime=$('#stime').val();
    eDay=$('#eday').val();
    eTime=$('#etime').val();

    $.ajax({
        url: 'controllers/promotioncontroller.php',
        type: 'post',
        data: {
            action: 'addSessionTime',
            promoId: promoId,
            sDay: sDay,
            sTime: sTime,
            eDay: eDay,
            eTime: eTime
        },
        cache: false,
        success: function (response) {
           //console.log(response)
            loadSessionContent();
        },
        error: function(xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }

    });

});
$(document).on("click", ".delete-session-btn", function(){
    console.log('clicked');
    sessionId=$(this).data('session-id');
    $.ajax({
        url: 'controllers/promotioncontroller.php',
        type: 'post',
        data: {
            action: 'removeSession',
            sessionId:sessionId
        },
        cache: false,
        success: function (response) {
            loadSessionContent();
        },
        error: function(xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }

    });

});
function loadSessionContent() {
    console.log('Load Session');
    $('#session-content').load("views/sessioncontent.php", {promoId: $('#promoId').val()});
}