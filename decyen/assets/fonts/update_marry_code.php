<?php 
include('config.php');
$db=$conn;

 $id=$_POST['id'];
 $name=$_POST['name'];
 $age=$_POST['age'];
 $gender=$_POST['gender'];
 $rel=$_POST['relation'];
  
$modifydate=date("d/m/y");
$modifyby="student";


 $col ="UPDATE  `marriage_history` SET  `marryname`='$name',`marryage`='$age', `marrygender`='$gender',`marryrel`='$rel', `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `id`='$id'";
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