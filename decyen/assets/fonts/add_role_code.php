<?php include('config.php');

$db=$conn;
if($db){

        
        $role=$_POST['role'];
        $description=$_POST['role_description'];

        $createdby="admin";
        $date=date("d/m/y");

        $col="INSERT INTO `role`(`role`, `description`, `created_by`, `created_on`) VALUES ('$role','$description','$date','$createdby')";

        if (mysqli_query($db,$col)) {
            echo"Successfully inserted into database";
        }
        else{
            echo"Not able to insert into database";
        }

}else{
    echo"unsucces";
}

        

?>