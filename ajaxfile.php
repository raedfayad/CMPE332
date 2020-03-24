<?php 

include "config.php";

$request = 0;

if(isset($_POST['request'])){
	$request = $_POST['request'];
}

// Fetch state list by countryid
if($request == 1){
	$orgid = $_POST['org_id'];

	$stmt = $conn->prepare("SELECT * FROM organization WHERE org_type=:org_type ");
	$stmt->bindValue(':org_type', (int)$orgid, PDO::PARAM_INT);

	$stmt->execute();
	$locationsList = $stmt->fetchAll();

	$response = array();
	foreach($locationsList as $location){
		$response[] = array(
				
				"name" => $location['org_name']
			);
	}

	echo json_encode($response);
	exit;
}
?>
