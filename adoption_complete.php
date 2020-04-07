<?php
include_once('inc/functions.php');
include_once('inc/forms.php');
include "config.php";
$last_name = get_string_form_data('l_name', $_POST);
$phone_num = get_string_form_data('phone_num', $_POST);
$street_num = get_string_form_data('street_num', $_POST);
$street_name = get_string_form_data('street_name', $_POST);
$city = get_string_form_data('city', $_POST);
$province = get_string_form_data('prov', $_POST);
$id = get_string_form_data('id', $_POST);

$stmt = $pdo->prepare("SELECT last_name, phone_num FROM `family` where last_name=:last_name and phone_num = :phone_num");
$stmt->bindParam(':last_name', $last_name);
$stmt->bindParam(':phone_num', $phone_num);
$stmt->execute();
$duplicates = $stmt->fetchAll();
$count = count($duplicates);
if ($count == 0){
	$stmt = $pdo->prepare("insert into family values (:last_name , :phone_num , :street_num , :street_name , :city , :province)");
	$stmt->bindParam(':last_name', $last_name);
	$stmt->bindParam(':phone_num', $phone_num);
	$stmt->bindParam(':street_num', $street_num);
	$stmt->bindParam(':street_name', $street_name);
	$stmt->bindParam(':city', $city);
	$stmt->bindParam(':province', $province);
	$stmt->execute();
}
else {
$stmt = $pdo->prepare('UPDATE animal SET family_name=:last_name, family_num=:phone_num WHERE id=:id');
$stmt->bindParam(':last_name', $last_name);
$stmt->bindParam(':phone_num', $phone_num);
$stmt->bindParam(':id', $id);
$stmt->execute();
}
?>


<!DOCTYPE HTML>

<html lang="en">
<?php print_head("Adoption Complete") ?>

	<body>
		<?php print_header(); ?>


		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">

					<header class="major special">
						<h2>Congratulations! You have adopted a pet!</h2>

					</header>
					<a href="#" class="image fit"><img src="images/dog_cat_1.jpg" alt="" /></a>
				</div>
			</section>

		<?php include("./inc/footer.php"); ?>

	</body>
</html>
