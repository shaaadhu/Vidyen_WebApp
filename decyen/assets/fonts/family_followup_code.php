<?php 

include("config.php");
$db=$conn;

$date_created="";
echo $family_id=$_POST['family_id'];

$query="SELECT * FROM family WHERE id='$family_id'";
$sqlcon=mysqli_query($db,$query);
while($row=mysqli_fetch_assoc($sqlcon)){
	 $date_created=$row['follow_up_date'];
}

$birth=$_POST['birth'];
$nofbirth=$_POST['nofbirth'];
$death=$_POST['death']; 
$nofdeath=$_POST['nofdeath']; 
$marriage=$_POST['marriage'];
$nofmarry=$_POST['nofmarry'];
$family_health_problem=$_POST['family_health_problem'];
$utilization=$_POST['utilization'];
$healthcare=implode(',' ,$_POST['healthcare']);
$direct_cost=$_POST['direct_cost'];
$indirect_cost=$_POST['indirect_cost'];
$scheme=$_POST['scheme'];
$approached=$_POST['approached'];
$what_action_taken=$_POST['what_action_taken'];

$observation=$_POST['observation'];
$date_of_visit=$_POST['date_of_visit'];

echo $col ="INSERT INTO `family_followup`(`family_id`,`date_of_created`, `birth`, `nofbirth`, `death`, `nofdeath`, `marriage`, `nofmarry`, `family_health_problem`, `healthcare`, `direct_cost`, `indirect_cost`, `scheme`, `what_action_taken`, `observation`, `date_of_visit`) VALUES ('$family_id','$date_created','$birth','$nofbirth','$death','$nofdeath','$marriage','$nofmarry','$family_health_problem','$healthcare','$direct_cost','$indirect_cost','$scheme','$what_action_taken','$observation','$date_of_visit')";
if(mysqli_query($db,$col))
{
echo("successfully added in db");
}
else{
echo("not able to add in database");
}
$createdby='student';
$created_on=date('y/m/d');


if($birth=='yes'){
	$nofbirth=$_POST['nofbirth'];
	$cbdate=$_POST['cbdate'];
	$cbname=$_POST['cbname'];
	$cbgender=$_POST['cbgender'];
	for($i=0;$i<$nofbirth;$i++){
		echo  $cbdate_values=$cbdate[$i];
		echo  $cbname_values=$cbname[$i];
		echo  $cbgender_values=$cbgender[$i];
		 
		 $query="INSERT INTO `birth_history`( `family_id`, `cbdate`, `cbname`, `cbgender`, `created_by`, `created_on`) VALUES ('$family_id','$cbdate_values','$cbname_values','$cbgender_values','$createdby','$created_on')";
		 if (mysqli_query($db,$query)) {

		 	echo"Successfully inserted into birth history";
		 	// code...
		 }else{
		 	echo"not inserted into birth history db";
		 }

	}
} if($birth=='no'){
	// echo"no birth";
}
if($death=='yes'){
	 $ddate=$_POST['ddate'];
	 $dname=$_POST['dname'];
	 $dage=$_POST['dage'];
	 $dgender=$_POST['dgender'];
	 $dcause=$_POST['dcause'];
	echo  $nofdeath=$nofdeath;
	for($j=0;$j<$nofdeath;$j++){
		echo $ddate_value=$ddate[$j];
		echo $dname_values=$dname[$j];
		echo $dage_values=$dage[$j];
		echo $dgender_values=$dgender[$j];
		echo $dcause_values=$dcause[$j];
		echo $j;
		$query="INSERT INTO `death_history`(`family_id`, `ddate`, `dname`, `dage`, `dgender`, `dcause`, `created_by`, `created_on`) VALUES ('$family_id','$ddate_value','$dname_values','$dage_values','$dgender_values','$dcause_values','$createdby','$created_on')";
		if(mysqli_query($db,$query)){
			echo "successfully added into death history";
		}else
		{
			echo "Not able to insert into death history db";
		}
		}
	}
	if($marriage=='yes'){
		echo $maryyname=$_POST['marryname'];
		$marryage=$_POST['marryage'];
		$marrygender=$_POST['marrygender'];
		$marryrel=$_POST['marryrel'];
		for ($i=0; $i<$nofmarry ; $i++) { 
			echo $mrryname_values=$maryyname[$i];
			echo $marry_age=$marryage[$i];
			echo $marrygender_values=$marrygender[$i];
			echo $marry_relation_values=$marryrel[$i];
			$query="INSERT INTO `marriage_history`( `family_id`, `marryname`, `marryage`, `marrygender`, `marryrel`, `created_by`, `created_on`) VALUES ('$family_id','$mrryname_values','$marry_age','$marrygender_values','$marry_relation_values','$createdby','$created_on')";
			if (mysqli_query($db,$query)) {
				echo "successfully inserted into marraige history";
			}else{
				echo"not able to insert into marraige history db"; 
			}
		}
	}




mysqli_close($conn);


?>

