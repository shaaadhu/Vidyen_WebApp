<?php include('config.php');

$db=$conn;
	

	if (!isset($_POST['id'])) {
		echo"Unsuccess: not getting id ";
		
	}
	else{

		$id=$_POST['id'];
		$role=$_POST['role'];
		$description=$_POST['role_description'];

		$modifydate=date("d/m/y");
		$modifyby="admin";

		$querycon="UPDATE `role` SET `role`='$role',`description`='$description',`modified_on`='$modifydate',`modified_by`='$modifyby' WHERE `id`='$id' ";
		if(mysqli_query($db,$querycon)){
			echo"Successfully Updated";
			//header('location:view_department.php');

		}else
		{
			echo"unable to update";
		}
	}

?>