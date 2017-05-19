
var obj = {};
var tp = [];
var maxCards = 52;

function addToMCArray() {
    var qty = document.getElementById('txtmcqty');
    var payout = document.getElementById('txtpayout');
    for (var i = 0, j = qty.value; i < j; i++) {
        if (payout.value > 0)
            arr.push(payout.value);
        //alert('added:' + mul.value);
    }
    payout.value = '0';
    payout.focus();
    payout.select();
    countMonsterCarlo();

}

function countMonsterCarlo() {
    document.getElementById('monster_carlo_settings_payouts').value = arr;
    document.getElementById('mccardcount').innerHTML ="Count:" + arr.length;
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

    for (var i = 0, j = arr.length; i < j; i++) {
        addToList(i+1, arr[i]);
    }
}
function runmcAdd(e) {
    if (e.keyCode == 13) {
        addToMCArray();
        return false;
    }
}
function deleteCurrent() {
   // for (var i = 0, j = arr.length; i < j; i++) {
   //     console.log("tried removing itm"+i);
   //     if(document.getElementById('itm' + i+1)!=null){
   //         document.getElementById('itm' + i+1).remove();
    //        console.log("removing itm"+i);
    //    }else{
    //    }
//
  //  }

    $('.newRow').remove();
}
function addToList(qty, mul) {
    m1 = document.getElementById('mcitmTemplate');
    //alert(obj[tp[i]] + " - " + tp[i]);
    //alert(mul + " - " + qty);

    var cln = m1.cloneNode(true);
    cln.style.visibility = 'visible';
    cln.innerHTML = cln.innerHTML.replace("$cardnumber$", qty).replace("$mul$", mul).replace("$cardnumbers$", qty);
    cln.id = "itm" + qty;
    cln.classList.add('newRow');
    m2.insertBefore(cln, document.getElementById('ttlcnt'));
    var tmp = maxCards - arr.length;
    if (tmp >= 0) {
        document.getElementById('mccardcount').innerHTML = tmp + " left."
        $("#next-page").show();
        document.getElementById('mccardcount').style.color = "black";
    } else {
        document.getElementById('mccardcount').innerHTML = "Remove " + Math.abs(tmp);
        document.getElementById('mccardcount').style.color = "red";
        $("#next-page").hide();
    }
    //document.getElementById('tpcount').innerHTML = arr.length + "/"+maxCards;

}
function removeVal(val) {
    console.log(val-1);
                arr.splice(val-1, 1);
    countMonsterCarlo();
}