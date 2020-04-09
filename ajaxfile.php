<?php 

include "config.php";

$request = 0;

if(isset($_POST['request'])){
	$request = $_POST['request'];
}

// Fetch state list by countryid
if($request == 1){
	$orgid = $_POST['post_id'];
	if($orgid == 1 or $orgid == 3) {
		$stmt = $pdo->prepare("SELECT * FROM organization WHERE org_type=:org_type ");
		$stmt->bindValue(':org_type', (int)$orgid, PDO::PARAM_INT);

		$stmt->execute();
		$locationsList = $stmt->fetchAll();

		$response = array();
		foreach($locationsList as $location){
			$response[] = array(
					
					"var_name" => $location['org_name']
				);
		}
	}

	echo json_encode($response);
	exit;
}

if($request == 2){
	$orgid = $_POST['post_id'];
	
	$stmt = $pdo->prepare("SELECT * FROM organization WHERE org_type=:org_type ");
	$stmt->bindValue(':org_type', (int)$orgid, PDO::PARAM_INT);

	$stmt->execute();
	$locationsList = $stmt->fetchAll();

	$response = array();
	foreach($locationsList as $location){
		$response[] = array(
					
			"var_name" => $location['org_name']
	);
	}
	
	echo json_encode($response);
	exit;
}

if($request == 3){
	$rescued = $_POST['post_id'];
	if ($rescued == 'Yes') {
		$orgs = $pdo->query("select rescuer_name from rescuer");

		$response = array();
		foreach($orgs as $org){
			$response[] = array(
						
				"var_name" => $org[0]
		);
		}
	
	echo json_encode($response);
	exit;
	}
}

if($request == 4){
	$rescue_name = $_POST['post_id'];
	
	$stmt = $pdo->prepare("SELECT * FROM driver WHERE rescuer_org=:rescuer_org ");
	$stmt->bindValue(':rescuer_org', $rescue_name);

	$stmt->execute();
	$locationsList = $stmt->fetchAll();

	$response = array();
	foreach($locationsList as $location){
		$response[] = array(
					
			"var_name" => $location['name']
	);
	}
	
	echo json_encode($response);
	exit;
}
?>
