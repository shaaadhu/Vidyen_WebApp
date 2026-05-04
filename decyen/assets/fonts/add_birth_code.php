<?php 
include('config.php');
$db=$conn;

 $id=$_POST['id'];
 $family_id=$_POST['family_id'];
 $date=$_POST['date'];
 $name=$_POST['name'];
 $gender=$_POST['gender'];
  
$modifydate=date("d/m/y");
$modifyby="student";


 $col ="INSERT INTO `birth_history`( `family_id`,`family_followup_code`, `cbdate`, `cbname`, `cbgender`, `created_by`, `created_on`) VALUES ('$family_id','$id','$date','$name','$gender','$modifyby','$modifydate')"; 
if(mysqli_query($db,$col))
{
    echo("successfully added in db");
}
else{
    echo("not able to add in database");
}


mysqli_close($db);

?>

?>