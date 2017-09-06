
<?php
error_reporting(E_ALL ^ E_DEPRECATED);
if (!isset($_GET['dtFrom'])) {
    $from = "0000-00-00 00:00";
} else {
    $from = $_GET['dtFrom'];
}
if (!isset($_GET['dtTo'])) {
    $to = "3000-01-01 00:00";
} else {
    $to = $_GET['dtTo'];
}
if (!isset($_GET['minHours'])) {
    $min = "7";
} else {
    $min = $_GET['minHours'];
}
if (!isset($_GET['maxHours'])) {
    $max = "20";
} else {
    $max = $_GET['maxHours'];
}
?>
<?php


//require '../dependencies/php/HelperFunctions.php'; 

$dbname = 'chimera_mat';
$username = 'cmatrun';
$password ='Vkcd5*80';
$conn = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT *,SUM(reghrs + others) as hoursWorked, max(area) as last, SUM(CASE 
             WHEN shift='RD' THEN 1
             ELSE 0
           END) AS noshift FROM records 
 WHERE timein>=date(?) and timein < DATE_ADD((?), INTERVAL 1 DAY)
                             GROUP by empN order by name asc";

$statement = $conn->prepare($sql);
$statement->execute(array($from, $to . " 00:00:00"));
$main = "";
$lessHours = "";
$moreHours = "";
$admin= "";
$bmg1= "";
$bmg2= "";
$psa= "";
$psb= "";
$psbl= "";
$psc= "";
$assy= "";
$optecha="";
$optechb="";
$optechc="";
$posttest="";
$tde="";
$test="";
$ee="";
$spc="";
$process="";
$rellab="";
$qa="";
$newhire="";

$madmin= "";
$mbmg1= "";
$mbmg2= "";
$mpsa= "";
$mpsb= "";
$mpsbl= "";
$mpsc= "";
$massy= "";
$moptecha="";
$moptechb="";
$moptechc="";
$mposttest="";
$mtde="";
$mtest="";
$mee="";
$mspc="";
$mprocess="";
$mrellab="";
$mqa="";
$mnewhire="";


foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {

	$main = $main . "<tr><td>[" .$result['empN'].'] '.$result['name'] . "</td>" . "<td>" . $result['last'] . "</td>" . "<td>" . $result['hoursWorked'] . "</td><td>" . checkForViolation($result['hoursWorked']) . "</td>"."<td>". $result['noshift'] . "</td></tr>";


    if (violationType($result['hoursWorked']) == 1) {

        $lessHours = $lessHours . "<tr><td>" . $result['name'] . "</td>" . "<td>" . $result['last'] . "</td>" . "<td>" . $result['hoursWorked'] . "</td><td>" . checkForViolation($result['hoursWorked']) . "</td></tr>";

        if (checkForAdmin($result['area']) == 1){
        $admin = $admin . "<tr><td>" . checkForAdmin($result['area']) . "</td></tr>";
        }
        if (checkForBMG1($result['area']) == 1){
        $bmg1 = $bmg1 . "<tr><td>" . checkForBMG1($result['area']) . "</td></tr>";
        }
        if (checkForBMG2($result['area']) == 1){
        $bmg2 = $bmg2 . "<tr><td>" . checkForBMG2($result['area']) . "</td></tr>";
        }
        if (checkForPsa($result['area']) == 1){
        $psa = $psa . "<tr><td>" . checkForPsa($result['area']) . "</td></tr>";
        }
         if (checkForPsb($result['area']) == 1){
        $psb = $psb . "<tr><td>" . checkForPsb($result['area']) . "</td></tr>";
        }
         if (checkForPsbl($result['area']) == 1){
        $psbl = $psbl . "<tr><td>" . checkForPsbl($result['area']) . "</td></tr>";
        }
         if (checkForPsc($result['area']) == 1){
        $psc = $psc . "<tr><td>" . checkForPsc($result['area']) . "</td></tr>";
        }
         if (checkForAssy($result['area']) == 1){
        $assy = $assy . "<tr><td>" . checkForAssy($result['area']) . "</td></tr>";
        }
         if (checkForOptechc($result['area']) == 1){
        $optechc = $optechc . "<tr><td>" . checkForOptechc($result['area']) . "</td></tr>";
        }
         if (checkForPostTest($result['area']) == 1){
        $posttest = $posttest . "<tr><td>" . checkForPostTest($result['area']) . "</td></tr>";
        }
         if (checkForTde($result['area']) == 1){
        $tde = $tde . "<tr><td>" . checkForTde($result['area']) . "</td></tr>";
        }
         if (checkForOptecha($result['area']) == 1){
        $optecha = $optecha . "<tr><td>" . checkForOptecha($result['area']) . "</td></tr>";
        }
         if (checkForOptechb($result['area']) == 1){
        $optechb = $optechb . "<tr><td>" . checkForOptechb($result['area']) . "</td></tr>";
        }
         if (checkForTest($result['area']) == 1){
        $test = $test . "<tr><td>" . checkForTest($result['area']) . "</td></tr>";
        }
         if (checkForEe($result['area']) == 1){
        $ee = $ee . "<tr><td>" . checkForEe($result['area']) . "</td></tr>";
        }
         if (checkForSpc($result['area']) == 1){
        $spc = $spc . "<tr><td>" . checkForSpc($result['area']) . "</td></tr>";
        }
        if (checkForProcess($result['area']) == 1){
        $process = $process . "<tr><td>" . checkForProcess($result['area']) . "</td></tr>";
        }
        if (checkForRellab($result['area']) == 1){
        $rellab = $rellab . "<tr><td>" . checkForRellab($result['area']) . "</td></tr>";
        }
        if (checkForQa($result['area']) == 1){
        $qa = $qa . "<tr><td>" . checkForQa($result['area']) . "</td></tr>";
        }
          if (checkForNewhire($result['area']) == 1){
        $newhire = $newhire . "<tr><td>" . checkForNewhire($result['area']) . "</td></tr>";
        }
                      
    } elseif (violationType($result['hoursWorked']) == 2) {
        $moreHours = $moreHours . "<tr><td>" . $result['name'] . "</td>" . "<td>" . $result['last'] . "</td>" . "<td>" . $result['hoursWorked'] . "</td><td>" . checkForViolation($result['hoursWorked']) . "</td></tr>";
         if (checkForAdmin($result['area']) == 1){
        $madmin = $madmin . "<tr><td>" . checkForAdmin($result['area']) . "</td></tr>";
        }
        if (checkForBMG1($result['area']) == 1){
        $mbmg1 = $mbmg1 . "<tr><td>" . checkForBMG1($result['area']) . "</td></tr>";
        }
        if (checkForBMG2($result['area']) == 1){
        $mbmg2 = $mbmg2 . "<tr><td>" . checkForBMG2($result['area']) . "</td></tr>";
        }
        if (checkForPsa($result['area']) == 1){
        $mpsa = $mpsa . "<tr><td>" . checkForPsa($result['area']) . "</td></tr>";
        }
         if (checkForPsb($result['area']) == 1){
        $mpsb = $mpsb . "<tr><td>" . checkForPsb($result['area']) . "</td></tr>";
        }
         if (checkForPsbl($result['area']) == 1){
        $mpsbl = $mpsbl . "<tr><td>" . checkForPsbl($result['area']) . "</td></tr>";
        }
         if (checkForPsc($result['area']) == 1){
        $mpsc = $mpsc . "<tr><td>" . checkForPsc($result['area']) . "</td></tr>";
        }
         if (checkForAssy($result['area']) == 1){
        $massy = $massy . "<tr><td>" . checkForAssy($result['area']) . "</td></tr>";
        }
         if (checkForOptechc($result['area']) == 1){
        $moptechc = $moptechc . "<tr><td>" . checkForOptechc($result['area']) . "</td></tr>";
        }
         if (checkForPostTest($result['area']) == 1){
        $mposttest = $mposttest . "<tr><td>" . checkForPostTest($result['area']) . "</td></tr>";
        }
         if (checkForTde($result['area']) == 1){
        $mtde = $mtde . "<tr><td>" . checkForTde($result['area']) . "</td></tr>";
        }
         if (checkForOptecha($result['area']) == 1){
        $moptecha = $moptecha . "<tr><td>" . checkForOptecha($result['area']) . "</td></tr>";
        }
         if (checkForOptechb($result['area']) == 1){
        $moptechb = $moptechb . "<tr><td>" . checkForOptechb($result['area']) . "</td></tr>";
        }
         if (checkForTest($result['area']) == 1){
        $mtest = $mtest . "<tr><td>" . checkForTest($result['area']) . "</td></tr>";
        }
         if (checkForEe($result['area']) == 1){
        $mee = $mee . "<tr><td>" . checkForEe($result['area']) . "</td></tr>";
        }
         if (checkForSpc($result['area']) == 1){
        $mspc = $mspc . "<tr><td>" . checkForSpc($result['area']) . "</td></tr>";
        }
        if (checkForProcess($result['area']) == 1){
        $mprocess = $mprocess . "<tr><td>" . checkForProcess($result['area']) . "</td></tr>";
        }
        if (checkForRellab($result['area']) == 1){
        $mrellab = $mrellab . "<tr><td>" . checkForRellab($result['area']) . "</td></tr>";
        }
        if (checkForQa($result['area']) == 1){
        $mqa = $mqa . "<tr><td>" . checkForQa($result['area']) . "</td></tr>";
        }
          if (checkForNewhire($result['area']) == 1){
        $mnewhire = $mnewhire . "<tr><td>" . checkForNewhire($result['area']) . "</td></tr>";
        }
    }
    

};
     
  $all = substr_count($main, "<tr>");
  $less = substr_count($lessHours, "<tr>");
  $more = substr_count($moreHours, "<tr>");
  $countadmin = substr_count($admin, "<tr>");
  $countBMG1 = substr_count($bmg1, "<tr>");
  $countBMG2 = substr_count($bmg2, "<tr>");
  $countpsa = substr_count($psa, "<tr>");
  $countpsb = substr_count($psb, "<tr>");
  $countpsbl = substr_count($psbl, "<tr>");
  $countpsc = substr_count($psc, "<tr>");
  $countassy = substr_count($assy, "<tr>"); 
  $countoptecha = substr_count($optecha, "<tr>"); 
  $countoptechb = substr_count($optechb, "<tr>");  
  $countoptechc = substr_count($optechc, "<tr>"); 
  $countposttest = substr_count($posttest, "<tr>");
  $counttde = substr_count($tde, "<tr>");
  $counttest = substr_count($test, "<tr>");
  $countee = substr_count($ee, "<tr>");  
  $countspc = substr_count($spc, "<tr>"); 
  $countprocess = substr_count($process, "<tr>");
  $countrel = substr_count($rellab, "<tr>");  
  $countqa = substr_count($qa, "<tr>"); 
  $countnewhire = substr_count($newhire, "<tr>");

  $mcountadmin = substr_count($madmin, "<tr>");
  $mcountBMG1 = substr_count($mbmg1, "<tr>");
  $mcountBMG2 = substr_count($mbmg2, "<tr>");
  $mcountpsa = substr_count($mpsa, "<tr>");
  $mcountpsb = substr_count($mpsb, "<tr>");
  $mcountpsbl = substr_count($mpsbl, "<tr>");
  $mcountpsc = substr_count($mpsc, "<tr>");
  $mcountassy = substr_count($massy, "<tr>"); 
  $mcountoptecha = substr_count($moptecha, "<tr>"); 
  $mcountoptechb = substr_count($moptechb, "<tr>");  
  $mcountoptechc = substr_count($moptechc, "<tr>"); 
  $mcountposttest = substr_count($mposttest, "<tr>");
  $mcounttde = substr_count($mtde, "<tr>");
  $mcounttest = substr_count($mtest, "<tr>");
  $mcountee = substr_count($mee, "<tr>");  
  $mcountspc = substr_count($mspc, "<tr>"); 
  $mcountprocess = substr_count($mprocess, "<tr>");
  $mcountrel = substr_count($mrellab, "<tr>");  
  $mcountqa = substr_count($mqa, "<tr>"); 
  $mcountnewhire = substr_count($mnewhire, "<tr>");

function checkForQa($area)
{
     if ($area == "QA") {
        return (1);
    } else {
      return(2);
    }
}
function checkForNewhire($area)
{
     if ($area == "NEW HIRE") {
        return (1);
    } else {
      return(2);
    }
}
function checkForRellab($area)
{
     if ($area == "REL-LAB") {
        return (1);
    } else {
      return(2);
    }
}
function checkForProcess($area)
{
     if ($area == "PROCESS") {
        return (1);
    } else {
      return(2);
    }
}
function checkForSpc($area)
{
     if ($area == "SPC") {
        return (1);
    } else {
      return(2);
    }
}
function checkForEe($area)
{
     if ($area == "EE") {
        return (1);
    } else {
      return(2);
    }
}
function checkForBMG1($area)
{
     if ($area == "BMG 1") {
        return (1);
    } else {
      return(2);
    }
}
function checkForBMG2($area)
{
     if ($area == "BMG 2") {
        return (1);
    } else {
      return(2);
    }
}
function checkForPsa($area)
{
     if ($area == "PS-A") {
        return (1);
    } else {
      return(2);
    }
}
function checkForPsb($area)
{
     if ($area == "PS-B") {
        return (1);
    } else {
      return(2);
    }
}
function checkForPsbl($area)
{
     if ($area == "PS-BL") {
        return (1);
    } else {
      return(2);
    }
}
function checkForPsc($area)
{
     if ($area == "PS-C") {
        return (1);
    } else {
      return(2);
    }
}
function checkForAssy($area)
{
     if ($area == "ASSEMBLY") {
        return (1);
    } else {
      return(2);
    }
}
function checkForTde($area)
{
     if ($area == "TD&E") {
        return (1);
    } else {
      return(2);
    }
}
function checkForAdmin($area)
{
     if ($area == "ADMIN") {
        return (1);
    } else {
      return(2);
    }
}
function checkForTest($area)
{
     if ($area == "TEST") {
        return (1);
    } else {
      return(2);
    }
}
function checkForOptecha($area)
{
     if ($area == "OPTECH-A") {
        return (1);
    } else {
      return(2);
    }
}
function checkForOptechb($area)
{
     if ($area == "OPTECH-B") {
        return (1);
    } else {
      return(2);
    }
}
function checkForOptechc($area)
{
     if ($area == "OPTECH-C") {
        return (1);
    } else {
      return(2);
    }
}
function checkForPostTest($area)
{
     if ($area == "POSTTEST") {
        return (1);
    } else {
      return(2);
    }
}

function checkForViolation($hours)
{
    global $max, $min;
    if ($hours > $max) {
        return ("Exceeded Hours");
    } else if ($hours < $min) {
        return ("Not Enough");
    }
    return ("None");
}

function violationType($hours)
{
    global $max, $min;
    if ($hours > $max) {
        return (2);
    } else if ($hours < $min) {
        return (1);
    }
    return (0);
}

?>


<html xmlns="http://www.w3.org/1999/html">
<head>
<style>
    #mamamo {
    background-color: #d0d4db;
    }

    #bttn {
    position: relative;
    right: 140px;
    top:5px;
    width: 0px;
    }
    #bttn1 {
    position: relative;
    right: 50px;
    top:-40px;
        width: 0px;
    }
    #bttn2 {
    position: relative;
    left: 100px;
    top:-85px;
        width: 0px;
    }

</style>
</head>
<body>
<form>
<div id='mamamo'>
	<center><h1>WEEK 1</h1></center>
    <table>
        <tr>
            <td>From:<input name="dtFrom" type="date" value="<?php echo($from)?>"></td>
            <td>to:<input name="dtTo" type="date" value="<?php echo($to)?>"></td>
        </tr>
        <tr>
            <td>From:<input name="minHours" type="number" value="48"></td>
            <td>to:<input name="maxHours" type="datetime" value="60"></td>
        </tr>
        <tr>
            <td>
                <button id="filter" class="btn btn-info btn-xm" type="submit">Filter</button>
            </td>
        </tr>
      
    </table>
  </div>
</form>
  <hr size="10" noshade>
  <center>
<h1>Number of Employees</h1>

<head>
  <title>ALL</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<div class="container">

  <!-- Trigger the modal with a button -->
  <div id=bttn>
  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">All</button>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">All</h4>
        </div>
        <div class="modal-body">
          <p>  <?php   echo nl2br("ALL EMPLOYESS: ".$all."\n"); ?></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<div class="container">

  <!-- Trigger the modal with a button -->
    <div id=bttn1>
  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal1">Exceeded</button>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Exceeded</h4>
        </div>
        <div class="modal-body">
          <p>  <?php echo nl2br("\n ALL: ".$more."\n ADMIN: ".$mcountadmin.
    "\n BMG 1: ".$mcountBMG1."\n BMG 2: ".$mcountBMG2."\n PS-A: ".$mcountpsa."\n PS-B: ".$mcountpsb."\n PS-BL: ".$mcountpsbl."\n PS-C: ".$mcountpsc."\n ASSEMBLY: ".$mcountassy."\n OPTECH-A: ".$mcountoptecha."\n OPTECH-B: ".$mcountoptechb."\n OPTECH-C: ".$mcountoptechc."\n POSTTEST: ".$mcountposttest."\n TD&E: ".$mcounttde."\n TEST: ".$mcounttest."\n EE: ".$mcountee."\n SPC: ".$mcountspc."\n PROCESS: ".$mcountprocess."\n REL-LAB: ".$mcountrel."\n QA: ".$mcountqa."\n NEW HIRE: ".$mcountnewhire. "\n");?></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="container">

  <!-- Trigger the modal with a button -->
    <div id=bttn2>
  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">Less</button>
</div>
  <!-- Modal -->
  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Less</h4>
        </div>
        <div class="modal-body">
          <p>  <?php   echo nl2br("\n ALL: ".$less."\n ADMIN: ".$countadmin.
    "\n BMG 1: ".$countBMG1."\n BMG 2: ".$countBMG2."\n PS-A: ".$countpsa."\n PS-B: ".$countpsb."\n PS-BL: ".$countpsbl."\n PS-C: ".$countpsc."\n ASSEMBLY: ".$countassy."\n OPTECH-A: ".$countoptecha."\n OPTECH-B: ".$countoptechb."\n OPTECH-C: ".$countoptechc."\n POSTTEST: ".$countposttest."\n TD&E: ".$counttde."\n TEST: ".$counttest."\n EE: ".$countee."\n SPC: ".$countspc."\n PROCESS: ".$countprocess."\n REL-LAB: ".$countrel."\n QA: ".$countqa."\n NEW HIRE: ".$countnewhire); ?></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
  <hr size="10" noshade>
   <center>
  <tr>
        <td style="vertical-align: left">			
        <table id="myTable" style="border-style: solid">       
			  <h3 colspan="4">All Employees</h3>
           <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Area..">
			    <tr>
			
                    <th> Name</th> 
                    <th>Area</th>
                    <th>hours</th>
                    <th>Violation</th>
                    <th>RD</th>
                </tr>
				
                <tr>
			
                    <td></td> 
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php echo($main) ?>
  </td>
	</tr>
  </table>
	<hr size="10" noshade>
  <tr>
        <td style="vertical-align: center">
        <table id="myTable1" style="border-style: solid">
         <h3 colspan="4">Exceeded Hours</h3>
		    <input type="text" id="myInput1" onkeyup="myFunction1()" placeholder="Search for Area..">	   
               <tr>
			
                    <th> Name</th> 
                    <th>Area</th>
                    <th>hours</th>
                    <th>Violation</th>
                </tr>
				
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php echo($moreHours) ?>
            </table>
        </td>
	</tr>
  </table>
  <hr size="10" noshade>
	<tr>
        <td style="vertical-align: left">      
        <table id="myTable2" style="border-style: solid">       
        <h3 colspan="4">Not Enough Hours</h3>
        <input type="text" id="myInput2" onkeyup="myFunction2()" placeholder="Search for Area..">
				</tr>
                 <tr>
                    <th> Name</th> 
                    <th>Area</th>
                    <th>hours</th>
                    <th>Violation</th>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php echo($lessHours) ?>
            </table>
		</td>
    </tr>
</table>
</body>
<hr size="10" noshade>
<script>
$(document).ready(function() {
    setTimeout(function() {
        $("a#<?php echo $custom_jq_settings['toggle']; ?>").trigger('click');
    },10);
});
</script>
<script>
 function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}   
</script>
<script>
 function myFunction1() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput1");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable1");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}   
</script>
<script>
 function myFunction2() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput2");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable2");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}   
</script>
</html>