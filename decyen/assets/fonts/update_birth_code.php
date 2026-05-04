<?php 
include('config.php');
$db=$conn;

 $id=$_POST['id'];
 $date=$_POST['date'];
 $name=$_POST['name'];
 $gender=$_POST['gender'];
  
$modifydate=date("d/m/y");
$modifyby="student";


 $col ="UPDATE  `birth_history` SET `cbdate`='$date', `cbname`='$name', `cbgender`='$gender', `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `id`='$id'";
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