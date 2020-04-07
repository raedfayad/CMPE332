<?php 
include_once('./inc/functions.php');
require_once "config.php";

$animal_id = $_POST["animal_id"];
$destination_shelter = $_POST["destination"];
$is_rescued = $_POST["rescued"];

$stmt1 = $pdo->query("SELECT adoption_fee FROM animal join spca WHERE id=$animal_id and spca_branch=org_name");
$fee = $stmt1->fetch()[0]; 

$stmt2 = $pdo->query("select animal_type from animal where id = $animal_id");
$a_type = $stmt2->fetch()[0];
$stmt3 = $pdo->query("select a_max FROM shelter_info where shelter_name= '$destination_shelter' and a_type = '$a_type'");
$a_max = $stmt3->fetch()[0];
$stmt4 = $pdo->query("SELECT count(id) from animal where shelter_branch='$destination_shelter'");
$count_id = $stmt4->fetch()[0];


if ($count_id+1 > $a_max) {
	$message = "Sorry this shelter is at max capacity for $a_type.s, please try moving it to a different shelter.";
}
else {
	$message = "Animal location updated! Please note the fee of $$fee. <a href='change_animal_location.php'>Change another animal location here.</a> </p> ";        	
	
	if ($is_rescued == "Yes") {
		$driver = $_POST["driver"];
		$stmt =  $pdo->prepare('UPDATE animal SET shelter_branch=:shelter_branch, driver_name=:driver_name, departure_date=CURRENT_DATE WHERE id=:id');
		$stmt->bindValue(':shelter_branch', $destination_shelter);
		$stmt->bindValue(':id', $animal_id, PDO::PARAM_INT);
		$stmt->bindValue(':driver_name',$driver);
	}
	else {
		$stmt =  $pdo->prepare('UPDATE animal SET shelter_branch=:shelter_branch, departure_date=CURRENT_DATE WHERE id=:id');
		$stmt->bindValue(':shelter_branch', $destination_shelter);
		$stmt->bindValue(':id', $animal_id, PDO::PARAM_INT);	
	}
	$stmt->execute();
}
 ?>

<html lang="en">
<?php print_head("Employee Terminal:Animal Location Submitted") ?>
<head>

</head>
	<body>
		<?php print_header(); ?>

		<header class="major special">
			<h2>Change Animal Location</h2>
        </header> 
		<!-- Main -->
			<section id="main" class="wrapper">
				<p><?php echo $message ?> </p>
			</section>
			




    <?php include("./inc/footer.php"); ?>

    </body>
</html>