<?php 
include_once('inc/functions.php');
include_once('inc/forms.php');
include "config.php";
$orgid = $_POST['organization'];
$loc = get_string_form_data('locations', $_REQUEST);
 ?>

<!DOCTYPE HTML>
<!--
	Spatial by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html lang="en">
<?php print_head("Organizations") ?>

	<body>
		<?php print_header(); ?>


		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">

					<header class="major special">
						<h2>Organizations</h2>
						<p><?= $loc ?></p>
					</header>

					<!-- <a href="#" class="image fit"><img src="images/pic01.jpg" alt="" /></a> -->
					<p>Information about animals located at <?php echo $loc ?></p>
					<section>
					<table>
						<thead>
							<tr>
								<th>Animal ID</th>
								<th>Animal Type</th>
							</tr>
						</thead>
						<tbody>
							
					<?php
					if($orgid == 1) {
						
						$stmt = $conn->prepare("SELECT id, animal_type FROM animal WHERE family_name is NULL and spca_branch=:spca_branch");
						$stmt->bindValue(':spca_branch', (int)$loc, PDO::PARAM_INT);
						$stmt->execute();
						$animalsList = $stmt->fetchAll();

						
						foreach($animalsList as $animal){ ?>
											<tr>
											<td><?php echo $animal['id'] ?></td>
											<td><?php echo $animal['animal_type'] ?></td>
											</tr>
										<?php } 
					}
					if($orgid == 3) {
						
						$stmt = $conn->prepare("SELECT id, animal_type FROM animal WHERE family_name is NULL and shelter_branch=:shelter_branch");
						$stmt->bindValue(':shelter_branch', (int)$loc, PDO::PARAM_INT);
						$stmt->execute();
						$animalsList = $stmt->fetchAll();

						
						foreach($animalsList as $animal){ ?>
											<tr>
											<td><?php echo $animal['id'] ?></td>
											<td><?php echo $animal['animal_type'] ?></td>
											</tr>
										<?php } 
					}
					
					?>
					</table>
			</section>

		<?php include("./inc/footer.php"); ?>

	</body>
</html>