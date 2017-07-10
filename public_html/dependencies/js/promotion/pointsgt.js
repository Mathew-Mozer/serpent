/**
 * Delete
 * @param casinoId
 * @param promotionId
 */
var playerarray = [];
var loadTemplate = function (name, points, id) {
    if (id == 0) {
        playerid = playerarray.length;
    } else {
        playerid = id;
    }
    cnt = playerarray.length + 1;
    playerarray.push({
        pgt_player_name: name,
        pgt_player_id: playerid,
        pgt_current_points: points,
        nameid: "pgt_player_name" + cnt,
        playerid: "pgt_player_id" + cnt,
        pointsid: "pgt_current_points" + cnt,
        npid: "np" + playerarray.length,
        playertally: playerarray.length
    });

    $("#playerCount").val(playerarray.length);

    //alert('name:' + name);
    $("#playerlist").loadTemplate($('#playerTemplate'), playerarray);

};
var currentBox;
var addToPoints = true;
$(document).ready(function () {
    $(document).on("click", ".pointbox", function () {
        currentBox = this;
        $("#pulltab-button-layout").toggle(true);
        $(".pointbox").parent().toggleClass("pgt-active-player",false);
        $(this).parent().toggleClass("pgt-active-player");
    });

    $(document).on("click", ".pull-tab-button-cancel", function () {
        currentBox = "" +
            "";
        $("#pulltab-button-layout").toggle(false);
        ptButtonClear();
    });
    $(document).on("click", ".pull-tab-button-clear", function () {
        ptButtonClear();
    });
    $(document).on("click", ".pull-tab-button-quick-add", function () {
        $('#newpoints').text($(this).text());
        ptButtonAddPoints();
    });
    $(document).on("click", ".pull-tab-button-calc-add", function () {
        ptButtonAddCalcPoints(this);
    });
    $(document).on("click", ".pull-tab-button-commit", function () {
        ptButtonAddPoints();

    });
    var ptButtonAddPoints = function () {
        if(addToPoints){
            $(currentBox).val(parseInt($(currentBox).val())+parseInt($('#newpoints').text()));

           // $(currentBox).text(parseInt($(currentBox).text())+parseInt($('#newpoints').text()));
        }else{
            $(currentBox).val($(currentBox).val()-parseInt($('#newpoints').text()));
            if(parseInt($(currentBox).text())<0){
                $(currentBox).val("0");
            }
        }
        currentBox = "" +
            "";
        $("#pulltab-button-layout").toggle(false);
        $(".pointbox").parent().toggleClass("pgt-active-player",false);
        ptButtonClear();
        updatePromotion($("#promotion-view-modal").data('promo-id'),$("#promotion-view-modal").data('promo-type-id'),1);
    }
    $(document).on("click", ".btn-new-player", function () {
        loadTemplate($("#pgt_player_newname").val(),0,null)
        updatePromotion($("#promotion-view-modal").data('promo-id'),$("#promotion-view-modal").data('promo-type-id'),1);
    });

    var ptButtonClear = function () {
        $('#newpoints').text("0");
        addToPoints=true
        $('#pgtoperator').text("+")
    };
    var ptButtonAddCalcPoints = function (obj) {
        //console.log("add:" + $(obj).text());
        if($('#newpoints').text()=="0"){
            $('#newpoints').text($(obj).text());
        }else{
            $('#newpoints').text($('#newpoints').text()+$(obj).text());
        }

    }
    $(document).on("click", ".pull-tab-button-minus", function () {

        addToPoints=!addToPoints;
        if(addToPoints){
            $('#pgtoperator').text("+")
            console.log('Operator changed to: +');
        }else{
            $('#pgtoperator').text("-")
            console.log('Operator changed to: -');
        }
    });


});
var gupdatePromotion = function (promotionId) {

    $.ajax({
        url: 'controllers/promotioncontrollers/pointsgtcontroller.php',
        type: 'post',
        data: {
            action: 'update',
            promotionId: promotionId
        },
        cache: false,
        beforeSend: function () {
            $(".loader").removeClass("hidden");
        },
        success: function (response) {

        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        },
        complete: function () {
            $(".loader").addClass("hidden");
        }
    });
};
