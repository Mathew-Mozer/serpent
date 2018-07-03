$(document).on("click", ".deleteListItem", function () {
    deleteListItem($(this).data('id'));
});
$(document).on("click", "#addToListDisplay", function () {
    addListItem($('#add-promotion').data('promo-id'));
});

var addListItem = function (tmp) {
    $.ajax({
        url: 'controllers/promotioncontrollers/displaylistcontroller.php',
        type: 'post',
        data: {
            action: 'addListItem',
            promotionId: tmp,
            name:$('#dldAddName').val(),
            data1:$('#dldAddData1').val()
        },
        cache: false,
        beforeSend: function(){

        },
        success: function (response) {
            console.log("Success!");
            $('#dldAddName').val("")
            $('#dldAddData1').val("")

            //$("#playerlist").loadTemplate($('#playerTemplate'), response,{ append: false});
            getListData();
        },
        error: function (xhr, desc, err) {
            console.log("error:" + desc)
        }
    });
}
var deleteListItem = function (tmp) {
    $.ajax({
        url: 'controllers/promotioncontrollers/displaylistcontroller.php',
        type: 'post',
        data: {
            action: 'deleteListItem',
            promotionId: $('#add-promotion').data('promo-id'),
            entryID:tmp
        },
        cache: false,
        beforeSend: function(){

        },
        success: function (response) {
            console.log("Success!");
            //$("#playerlist").loadTemplate($('#playerTemplate'), response,{ append: false});
            getListData();
        },
        error: function (xhr, desc, err) {
            console.log("error:" + desc)
        }
    });
}
var getListData = function (){
    //console.log("should load player list")
    $.ajax({
        url: 'controllers/promotioncontrollers/displaylistcontroller.php',
        type: 'post',
        global:false,
        data: {
            action: 'getDisplayList',
            promotionId: $('#add-promotion').data('promo-id')
        },
        cache: false,
        beforeSend: function(){

        },
        success: function (response) {
            //console.log(response);
            $("#playerlist").loadTemplate($('#playerTemplate'), response,{ append: false});
            $("#listdisplaydiv").animate({ scrollTop: $('#listdisplaydiv').prop("scrollHeight")}, 1000);
        },
        error: function (xhr, desc, err) {
            console.log("error:" + desc)
        }
    });
}