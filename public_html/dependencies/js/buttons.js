$(document).ready(function(){

    /**
     * This is for click listeners
     */
    $("#createCasinoBtn").click( function (){
        createCasinoModal.dialog('open');
    });


    $(".add-promotion-btn").unbind('click').click(function(){
        $('input[name=casinoId]').val(this.id);
        addPromotionModal.dialog('open');
    });

    //Open add/remove user panel
    $(".userBtn").unbind('click').click(function () {
        editUsersModal.dialog('open');
    });

    $("#create-casino-btn").click(function(){
        createCasinoModal.dialog('open');
    });

    //Toggle between promotion and display view
    $(".toggle-display-btn").click(function() {
        $(this).addClass("hidden");
        if($(this).attr("id") === "toggle-display"){
            $("#toggle-promotion").removeClass("hidden");
        }else{
            $("#toggle-display").removeClass("hidden");
        }
    });

    });