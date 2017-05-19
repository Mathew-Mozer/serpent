/**
 * Created by zhydi on 1/1/2017.
 */

var obj = {};
var tp = [];
var maxCards = 48;
function runAdd(e) {
    if (e.keyCode == 13) {
        addToArray();
        return false;
    }
}
function txtPwField(e) {
    if (e.keyCode == 13) {
        launchView(txtpw.value);
        return false;
    }
}
function addToSession(){
    var sd = document.getElementById('txtsd');
    var st = document.getElementById('txtst');
    var ed = document.getElementById('txted');
    var et = document.getElementById('txtet');
}
function addToArray() {
    var qty = document.getElementById('txtqty');
    var mul = document.getElementById('txtmul');
    //alert(qty.value + " - " + mul.value);
    for (var i = 0, j = qty.value; i < j; i++) {
        if (mul.value > 0)
            arr.push(mul.value);
        //alert('added:' + mul.value);
    }
    mul.value = '0';
    qty.value = '0';
    mul.focus();
    mul.select();
    countMultipliers();

}
function removeVal(val) {
    for (var i = arr.length - 1; i >= 0; i--) {

        if (arr[i] == val) {
            arr.splice(i, 1);
            //alert(arr[i] + " = " + val);
        } else {
            //alert(arr[i] + " != " + val);
        }
    }
    countMultipliers();
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
function addToList(qty, mul) {
    m1 = document.getElementById('itmTemplate');
    //alert(obj[tp[i]] + " - " + tp[i]);
    //alert(mul + " - " + qty);

    var cln = m1.cloneNode(true);
    cln.style.visibility = 'visible';
    cln.innerHTML = cln.innerHTML.replace("$qty$", qty).replace("$mul$", mul).replace("$muls$", mul);
    cln.id = "itm" + mul;
    m2.insertBefore(cln, document.getElementById('ttlcnt'));
    var tmp = maxCards - arr.length;
    if (tmp >= 0) {
        document.getElementById('tpcount').innerHTML = tmp + " left."
    } else {
        document.getElementById('tpcount').innerHTML = "Remove " + Math.abs(tmp);
    }
    //document.getElementById('tpcount').innerHTML = arr.length + "/"+maxCards;

}
function checkInp(x) {
    //var x = document.forms["myForm"]["age"].value;
    //var regex = /^[0-9]+$/;
    if (x.value < 0) {
        x.value = 0;
        return false;
    }
}
function deleteCurrent() {
    for (var i = 0, j = tp.length; i < j; i++) {
        if(document.getElementById('itm' + tp[i])!=null){
            document.getElementById('itm' + tp[i]).remove();
        }
    }
    countMultipliers();
}
function countMultipliers() {
    document.getElementById('HiddenField1').value = arr;
    document.getElementById('tpcount').innerHTML = 0;
    deleteCurrent();
    tp = [];
    obj = {};
    // var muls = document.getElementById('hidmul');
    // var cnt = muls.value.split(',')
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

        addToList(obj[tp[i]], tp[i]);
    }

    console.log(obj);
}
$(function () {
    $('#SetWinner').click(function () {
        $('#SetWinner').hide();
        $('#spinner').show();
        $('#SetWinner').hide();
    });
});

