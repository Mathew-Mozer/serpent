/**
 * Created by zhydi on 1/1/2017.
 */

var obj = {};
var tp = [];
var maxCards = 48;
mmArray = [];
$(document).on("click", "#addToMMArray", function () {
        addToMMArray();
});
$(document).on("click", "#removeFromMMArray", function () {
    removeMMVal($(this).data('val'));
});
$(document).on("click", "#startMMSession", function () {
    if(confirm('Are you sure you want to start this session?')) {
        startMatchMadnessSession($('#add-promotion').data('promo-id'),$('#multi_madness_values').val());
        console.log('sent to start')
    }else{
        console.log('didn\'t start')
    }
});
function addToSession(){
    var sd = document.getElementById('txtsd');
    var st = document.getElementById('txtst');
    var ed = document.getElementById('txted');
    var et = document.getElementById('txtet');
}
function addToMMArray() {
    var qty = document.getElementById('txtqty');
    var mul = document.getElementById('txtmul');
    //alert(qty.value + " - " + mul.value);
    for (var i = 0, j = qty.value; i < j; i++) {
        if (mul.value.length > 0){
            arr.push(mul.value);
        }

        //alert('added:' + mul.value);
    }
    mul.value = '';
    qty.value = '1';
    mul.focus();
    mul.select();
    countMMMultipliers();

}
function removeMMVal(val) {
    for (var i = arr.length - 1; i >= 0; i--) {

        if (arr[i] == val) {
            arr.splice(i, 1);
            //alert(arr[i] + " = " + val);
        } else {
            //alert(arr[i] + " != " + val);
        }
    }
    countMMMultipliers();
}
function countCurrentMultipliers(cnt) {
    var tmp = "";
    tp = [];
    obj = {};
    var cdArray = cnt.split(',')
    for (var i = 0, j = cdArray.length; i < j; i++) {
        if (obj[cdArray[i]]) {
            obj[cdArray[i]]++;
        }
        else {
            obj[cdArray[i]] = 1;
            tp.push(cdArray[i]);
        }
    }
    for (var i = 0, j = tp.length; i < j; i++) {
        tmp += obj[tp[i]] + " - x" + tp[i] + "</br>";
    }
    tmp += "Total:" + cdArray.length + "</br>";
    if (cnt.indexOf(',') == -1 && cnt.length == 0) {
        tmp = "None Left";
    }
    return tmp;
}
function addToMMList(qty, val) {
    mmArray.push({
        Qty: qty,
        Value: val
    });
    ;
}
mmcnt=0;
var loadMulitplierMadnessTemplate = function () {
    mmcnt = mmArray.length + 1;
    $("#playerlist").loadTemplate($('#playerTemplate'), mmArray,{ append: false});
    console.log(mmArray);
};
function checkInp(x) {
    //var x = document.forms["myForm"]["age"].value;
    //var regex = /^[0-9]+$/;
    if (x.value < 0) {
        x.value = 0;
        return false;
    }
}
function countMMMultipliers() {
    document.getElementById('multi_madness_values').value = arr;
    document.getElementById('mmtpcount').innerHTML = "Count:" + arr.length;
    tp = [];
    obj = {};
    mmArray=[];
    for (var i = 0, j = arr.length; i < j; i++) {
        if (obj[arr[i]]) {
            obj[arr[i]]++;
        }
        else {
            obj[arr[i]] = 1;
            tp.push(arr[i]);
        }
    }

    for (var i = 0, j = tp.length; i < j; i++) {
        addToMMList(obj[tp[i]], tp[i]);
    }
    loadMulitplierMadnessTemplate();
    console.log(obj);
}
$(function () {
    $('#SetWinner').click(function () {
        $('#SetWinner').hide();
        $('#spinner').show();
        $('#SetWinner').hide();
    });
});
var hideStartButton = function () {

    if($('#multi_madness_started').val().length > 0){
        //$('#startMMSession').toggle(false);
        $('.mmclose').toggle(false);
        $('#addMMValues').toggle(false);
        $('#startSessionMessage').toggle(true);
        $('#ui-button #ui-corner-all #ui-widget').toggle(false);
//        console.log('found' + $('#multi_madness_started').val().indexOf("0000-00-00"));
    }else{
        $('#ui-button #ui-corner-all #ui-widget').toggle(true);
        $('#startSessionMessage').toggle(false);
    }
}

var startMatchMadnessSession = function (promotionId,mmvals) {
console.log("vals:" + mmvals);
    $.ajax({
        url: 'controllers/promotioncontrollers/matchmadnesscontroller.php',
        type: 'post',
        data: {
            action: 'startMM',
            promotionId: promotionId,
            mmvals:mmvals
        },
        cache: false,
        beforeSend: function(){
            $(".loader").removeClass("hidden");
        },
        success: function (response) {
            $(".ui-dialog-titlebar-close").trigger('click');
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        },
        complete: function(){
            $(".loader").addClass("hidden");
        },
        complete: function(){
            $(".loader").addClass("hidden");
        }
    });
};
