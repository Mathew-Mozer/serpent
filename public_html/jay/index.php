<?php
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
/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 7/11/2017
 * Time: 5:32 AM
 */

$dbname = 'chimera_mat';
$username = 'cmatrun';
$password ='Vkcd5*80';
$conn = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT *,SUM(reghrs + others) as hoursWorked FROM records 
 WHERE timein between DATE(?) 
                            AND DATE_ADD(?, INTERVAL 1 DAY) GROUP by empN order by name asc";
$statement = $conn->prepare($sql);
$statement->execute(array($from, $to . " 00:00:00"));
$main = "";
$lessHours = "";
$moreHours = "";
foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {
    $main = $main . "<tr><td>" . $result['name'] . "</td>" . "<td>" . $result['area'] . "</td>" . "<td>" . $result['shift'] . "</td><td>" . $result['hoursWorked'] . "</td><td>" . checkForViolation($result['hoursWorked']) . "</td></tr>";
    if (violationType($result['hoursWorked']) == 1) {
        $lessHours = $lessHours . "<tr><td>" . $result['name'] . "</td>" . "<td>" . $result['area'] . "</td>" . "<td>" . $result['shift'] . "</td><td>" . $result['hoursWorked'] . "</td></tr>";
    } elseif (violationType($result['hoursWorked']) == 2) {
        $moreHours = $moreHours . "<tr><td>" . $result['name'] . "</td>" . "<td>" . $result['area'] . "</td>" . "<td>" . $result['shift'] . "</td><td>" . $result['hoursWorked'] . "</td></tr>";
    }
};


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

</head>
<body>
<form>
    <table>
        <tr>
            <td>From:<input name="dtFrom" type="datetime" value="<?php echo($from) ?>"></td>
            <td>to:<input name="dtTo" type="datetime" value="<?php echo($to) ?>"></td>
        </tr>
        <tr>
            <td>From:<input name="minHours" type="number" value="<?php echo($min) ?>"></td>
            <td>to:<input name="maxHours" type="datetime" value="<?php echo($max) ?>"></td>
        </tr>
        <tr>
            <td>
                <button type="submit">Filter</button>
            </td>
        </tr>
    </table>
</form>
<table>
    <tr>
        <td>
            <table style="border-style: solid">
                <tr><td colspan="4">All Employees</td></tr>
                <tr>
                    <td>Name</td>
                    <td>Area</td>
                    <td>Shift</td>
                    <td>hours</td>
                    <td>Violation</td>
                </tr>
                <?php echo($main) ?>
            </table>
        </td>
        <td style="vertical-align: top">
            <table style="border-style: solid">
                <tr><td colspan="4" style="text-align: center">Exceeded Hours</td></tr>
                <tr>
                    <td>Name</td>
                    <td>Area</td>
                    <td>Shift</td>
                    <td>hours</td>
                </tr>
                <?php echo($moreHours) ?>
            </table>
        </td>
        <td style="vertical-align: top"><table style="border-style: solid">
                <tr><td colspan="4"  style="text-align: center">Not Enough Hours</td></tr>
                <tr>
                    <td>Name</td>
                    <td>Area</td>
                    <td>Shift</td>
                    <td>hours</td>
                </tr>
                <?php echo($lessHours) ?>
            </table></td>
    </tr>
</table>
</body>
<script>

</script>
</html>