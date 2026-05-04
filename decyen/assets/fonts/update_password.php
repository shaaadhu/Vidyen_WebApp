<?php 
include('config.php');
$db=$conn;
echo"successfully";
if($db){

echo $username=$_POST['username'];
echo $newpassword=md5($_POST['new_password']);
echo $usertype=$_POST['usertype'];

 echo $userid=$_POST['userid'];
  $modifyby=$usertype;
  $modifydate=date('y/m/d');


  $query="UPDATE `login` SET `password`='$newpassword',`modified_by`='$modifyby',`modified_on`='$modifydate',`status`='2' WHERE user_id='$userid'";
 if(mysqli_query($db,$query)){
 	header('location:login.php');
 }else
 {
 	echo"not updating";
 }
}else{
	echo"db is not connected";
}


?>