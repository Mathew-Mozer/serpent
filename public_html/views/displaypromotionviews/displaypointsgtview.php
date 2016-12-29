<?php
/**
 * This is the update pointsGT form
 */
?>

<label for="add-promotion">Edit Player Points</label>
<div id="add-promotion">
  <?php
    for($i = 1; $i<=20; $i++) { ?>
      <div class="playerForms">&nbsp;<?php echo $i;?> &nbsp; <input type="hidden" id="txtID<?php echo $i;?>" name="pgt_player_id<?php echo $i;?>"><input type="text" id="txtName<?php echo $i;?>" name="pgt_player_name<?php echo $i;?>"><input id="txtPoints<?php echo $i;?>" type="number" min="0" name="pgt_current_points<?php echo $i;?>"></div>
      <?php } ?>


<br>
  <hr>
   <div class="center">
      <h4>Copy and Paste Report</h4>
     <textarea id="TextBox1" cols="25" placeholder="Copy and Paste Report" onchange="myHandler()" onkeypress="this.onchange();" oninput="this.onchange();" onchange="myHandler();" onpaste="this.onchange();"></textarea>
   </div>

</div>
<script src="dependencies/js/promotion/formhelperfunctions.js"></script>
<script>
function myHandler() {
         var pastebox = document.getElementById('TextBox1');

         newstr = pastebox.value;
         //alert("a" + newstr);
         //pastebox.value = pastebox.value.replace(',', '');
         if (pastebox.value.indexOf('Last Time\n') != -1) {
             var tmp = pastebox.value.split('Last Time\n');
             if (tmp[1] == undefined) {
                 alert("Last Time");
             } else {
                 pastebox.value = tmp[1];
                 newstr = tmp[1];
             }
         }
         if (pastebox.value.indexOf('Customer\n') != -1) {
             var tmp = pastebox.value.split('Customer \n');
             alert(tmp[1]);
             if (tmp[1] == undefined) {
                 alert("Customer");
             } else {
                 pastebox.value = tmp[1];
                 newstr = tmp[1];
             }
         }
         if (pastebox.value.indexOf('ID\n') != -1) {
             var tmp = pastebox.value.split('ID\n');

             if (tmp[1] == undefined) {
                 alert("ID");
             } else {
                 pastebox.value = tmp[1];
                 newstr = tmp[1];
             }
         }

         if (pastebox == undefined) {
             var pastebox = document.getElementById('TextBox1');
         }
         if (pastebox != null)

             var eachLine = pastebox.value.split("\n");
         var cnt = 1;
         for (var l = 0, len = eachLine.length; l < len; l++) {
             if (cnt < 21) {
                 var dnewstr = eachLine[l].split(String.fromCharCode(9));
                 if (dnewstr.length > 3) {
                     if (dnewstr[2] != !isNaN && dnewstr[0] != !isNaN) {
                         //alert(dnewstr[1]);
                         document.getElementById('txtName' + (cnt)).value = dnewstr[1];
                         document.getElementById('txtPoints' + (cnt)).value = dnewstr[2].replace(',', '');
                         cnt++;
                     } else {
                         //alert(dnewstr[0]);
                     }
                 }
                 //    alert(dnewstr[1] + " has " + dnewstr[2] + " points");
                 //alert(eachLine[l]);
             }
         }


     }

getModalData($("#promotion-view-modal").data('promo-id'),4);
</script>
