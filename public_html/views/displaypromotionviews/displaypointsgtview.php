<div id="add-promotion">
  <div>&nbsp;1<input type="text" id="txtName1" name="pgt_player_name1"></input><input id="txtPoints1" type="number" name="pgt_current_points1"></input></div>
  <div>&nbsp;2<input type="text" id="txtName2" name="pgt_player_name2"></input><input id="txtPoints2" type="number" name="pgt_current_points2"></input></div>
  <div>&nbsp;3<input type="text" id="txtName3" name="pgt_player_name3"></input><input id="txtPoints3" type="number" name="pgt_current_points3"></input></div>
  <div>&nbsp;4<input type="text" id="txtName4" name="pgt_player_name4"></input><input id="txtPoints4" type="number" name="pgt_current_points4"></input></div>
  <div>&nbsp;5<input type="text" id="txtName5" name="pgt_player_name5"></input><input id="txtPoints5" type="number" name="pgt_current_points5"></input></div>
  <div>&nbsp;6<input type="text" id="txtName6" name="pgt_player_name6"></input><input id="txtPoints6" type="number" name="pgt_current_points6"></input></div>
  <div>&nbsp;7<input type="text" id="txtName7" name="pgt_player_name7"></input><input id="txtPoints7" type="number" name="pgt_current_points7"></input></div>
  <div>&nbsp;8<input type="text" id="txtName8" name="pgt_player_name8"></input><input id="txtPoints8" type="number" name="pgt_current_points8"></input></div>
  <div>&nbsp;9<input type="text" id="txtName9" name="pgt_player_name9"></input><input id="txtPoints9" type="number" name="pgt_current_points9"></input></div>
  <div>10<input type="text" id="txtName10" name="pgt_player_name10"></input><input id="txtPoints10" type="number" name="pgt_current_points10"></input></div>
  <div>11<input type="text" id="txtName11" name="pgt_player_name11"></input><input id="txtPoints11" type="number" name="pgt_current_points11"></input></div>
  <div>12<input type="text" id="txtName12" name="pgt_player_name12"></input><input id="txtPoints12" type="number" name="pgt_current_points12"></input></div>
  <div>13<input type="text" id="txtName13" name="pgt_player_name13"></input><input id="txtPoints13" type="number" name="pgt_current_points13"></input></div>
  <div>14<input type="text" id="txtName14" name="pgt_player_name14"></input><input id="txtPoints14" type="number" name="pgt_current_points14"></input></div>
  <div>15<input type="text" id="txtName15" name="pgt_player_name15"></input><input id="txtPoints15" type="number" name="pgt_current_points15"></input></div>
  <div>16<input type="text" id="txtName16" name="pgt_player_name16"></input><input id="txtPoints16" type="number" name="pgt_current_points16"></input></div>
  <div>17<input type="text" id="txtName17" name="pgt_player_name17"></input><input id="txtPoints17" type="number" name="pgt_current_points17"></input></div>
  <div>18<input type="text" id="txtName18" name="pgt_player_name18"></input><input id="txtPoints18" type="number" name="pgt_current_points18"></input></div>
  <div>19<input type="text" id="txtName19" name="pgt_player_name19"></input><input id="txtPoints19" type="number" name="pgt_current_points19"></input></div>
  <div>20<input type="text" id="txtName20" name="pgt_player_name20"></input><input id="txtPoints20" type="number" name="pgt_current_points20"></input></div>
  <div><textarea id="TextBox1" onchange="myHandler()" onkeypress="this.onchange();" oninput="this.onchange();" onchange="myHandler();" onpaste="this.onchange();"></textarea></div>

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
