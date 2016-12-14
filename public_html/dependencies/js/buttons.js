/**
 * Delete THIS
 */
$(document).ready(function(){

    /**
     * This is for click listeners
     */
    $("#createPropertyBtn").click( function (){
        createPropertyModal.dialog('open');
    });

    /**
     *
     */
    $(".add-promotion-btn").unbind('click').click(function(){
        $('input[name=propertyId]').val(this.id);
        addPromotionModal.dialog('open');
    });

    //Open add/remove user panel
    $("#userBtn").click(function () {
        alert("I'm trying");
        createUserModal.dialog('open');
    });

    $("#create-property-btn").click(function(){
        createPropertyModal.dialog('open');
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
