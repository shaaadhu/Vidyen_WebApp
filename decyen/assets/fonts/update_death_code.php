<?php 
include('config.php');
$db=$conn;

 $id=$_POST['id'];
 $date=$_POST['date'];
 $name=$_POST['name'];
 $age=$_POST['age'];
 $gender=$_POST['gender'];
 $cause=$_POST['cause'];
  
$modifydate=date("d/m/y");
$modifyby="student";


 $col ="UPDATE  `death_history` SET `ddate`='$date', `dname`='$name',`dage`='$age', `dgender`='$gender',`dcause`='$cause', `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `id`='$id'";
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