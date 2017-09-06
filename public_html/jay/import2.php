 <?php
 $connect = mysqli_connect("localhost", "cmatrun", "Vkcd5*80", "chimera_mat");
if(isset($_POST["submit"]))
{
 if($_FILES['file']['name'])
 {
  $filename = explode(".", $_FILES['file']['name']);
  if($filename[1] == 'csv')
  {
   $handle = fopen($_FILES['file']['tmp_name'], "r");
   while($data = fgetcsv($handle))
   {
    $item1 = mysqli_real_escape_string($connect, $data[0]);
                $item2 = mysqli_real_escape_string($connect, $data[1]);
				 $item3 = mysqli_real_escape_string($connect, $data[2]);
				 $item4 = mysqli_real_escape_string($connect, $data[3]);
				 $item5 = mysqli_real_escape_string($connect, $data[4]);
				 $item6 = mysqli_real_escape_string($connect, $data[5]);
				 $item7 = mysqli_real_escape_string($connect,toMysqlDateTime($data[4],$data[6]));
				 $item8 = mysqli_real_escape_string($connect,toMysqlDateTime($data[4],$data[7]));
				 $item9 = mysqli_real_escape_string($connect, $data[8]);
				 $item10 = mysqli_real_escape_string($connect, $data[9]);
				 $item11 = mysqli_real_escape_string($connect, $data[10]);
				 $item12 = mysqli_real_escape_string($connect, $data[11]);

                $query = "INSERT into records(area, name, empN, bio, timein, timeout, remarks, shift, reghrs, others)
							values	('$item1','$item2','$item3','$item4','$item7','$item8','$item9','$item10','$item11','$item12')";
       if (!mysqli_query($connect,$query))
       {
           echo("Error description: " . mysqli_error($connect));
       }

   }
   fclose($handle);
   echo "<script>alert('Import done');</script>";
  }
 }
}
 function toMysqlDateTime($date, $time)
 {
     $newdate = explode("/", $date);
     $tmpdata = $newdate[2] . "-" . $newdate[1] . "-" . $newdate[0]." ".$time;
     return $tmpdata;
 }

?>  

<!DOCTYPE html>  
<html>  
 <head>  
  <title>DDAP Import CSV</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 </head>  
 <body>  
  <h3 align="center"></h3><br />
  <form method="post" enctype="multipart/form-data">
   <div align="center">  
    <label>Select CSV File:</label>
    <input type="file" name="file" />
    <br />
    <input type="submit" name="submit" value="Import" class="btn btn-info" />
   </div>
  </form>
 </body>  
</html>