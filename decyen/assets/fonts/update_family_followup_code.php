<?php 
include("config.php");
$db=$conn;

echo $id=$_POST['family_followup_id'];

$birth=$_POST['birth'];
$nofbirth=$_POST['nofbirth'];
$death=$_POST['death']; 
$nofdeath=$_POST['nofdeath']; 
$marriage=$_POST['marriage'];
$nofmarry=$_POST['nofmarry'];
$family_health_problem=$_POST['family_health_problem'];

$healthcare=$_POST['healthcare'];
$direct_cost=$_POST['direct_cost'];
$indirect_cost=$_POST['indirect_cost'];
$scheme=$_POST['scheme'];
$approached=$_POST['approached'];
$what_action_taken=$_POST['what_action_taken'];

$observation=$_POST['observation'];
$date_of_visit=$_POST['date_of_visit'];

$modifydate=date("d/m/y");
$modifyby="student";

echo $col ="UPDATE  `family_followup` SET `birth`='$birth', `nofbirth`='$nofbirth', `death`='$death', `nofdeath`='$nofdeath', `marriage`='$marriage', `nofmarry`='$nofmarry', `family_health_problem`='$family_health_problem', `healthcare`='$healthcare', `direct_cost`='$direct_cost', `indirect_cost`='$indirect_cost', `scheme`='$scheme', `what_action_taken`='$what_action_taken', `observation`='$observation', `date_of_visit`='$date_of_visit', `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `id`='$id'";
if(mysqli_query($db,$col))
{
	echo("successfully added in db");
}
else{
	echo("not able to add in database");
}


mysqli_close($db);

?>