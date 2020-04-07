<?php 
include_once('inc/functions.php');
include_once('inc/forms.php');
include "config.php";
$total_rescued = "";
if (!empty($_POST['rescue_year'])) {
		$year = $_POST['rescue_year'];
		$stmt = $pdo->prepare("SELECT count(id) as rescuedAnimals FROM animal WHERE driver_name is not null and YEAR(departure_date)=:year");
		$stmt->bindValue(':year', (int)$year, PDO::PARAM_INT);
		$stmt->execute();
		$total_rescued = $stmt->fetch()[0];	
}
if (!empty($_POST['organization'])) {
	$orgid = get_string_form_data('organization', $_POST);
}
if (!empty($_POST['locations'])) {
	$loc = get_string_form_data('locations', $_POST);
}

 ?>

<!DOCTYPE HTML>

<html lang="en">
<?php print_head("Organizations") ?>

	<body>
		<?php print_header(); ?>


		<!-- Main -->
			<section id="main" class="wrapper">
				

					<header class="major special">
						<h2>Organizations</h2>
						
					</header>

					<!-- <a href="#" class="image fit"><img src="images/pic01.jpg" alt="" /></a> -->
					
					<section>
					
					<?php 
					if($orgid == 1 or $orgid == 3) { ?>
						<p>Information about animals located at <?php echo $loc ?></p>
						<table>
							<thead>
								<tr>
									<th>Animal ID</th>
									<th>Animal Type</th>
									<th>Arrival Date at SPCA location</th>
							 
						<?php
						if($orgid == 1) {
						
							$stmt = $pdo->prepare("SELECT id, animal_type, arrival_date FROM animal WHERE family_name is NULL and shelter_branch is NULL and spca_branch=:spca_branch");
							$stmt->bindValue(':spca_branch', $loc);
							$stmt->execute();
							$animalsList = $stmt->fetchAll();

							?>
							</tr>
							</thead>
							<tbody> 
							<?php
							foreach($animalsList as $animal){ ?>
								<tr>
								<td><?php echo $animal['id'] ?></td>
								<td><?php echo $animal['animal_type'] ?></td>
								<td><?php echo $animal['animal_type'] ?></td>
								<td><?php echo $animal['arrival_date'] ?></td>
								</tr>
							<?php 
							} 
						}
					
						elseif($orgid == 3) {
							
							$stmt = $conn->prepare("SELECT * WHERE family_name is NULL and shelter_branch=:shelter_branch");
							$stmt->bindValue(':shelter_branch', $loc);
							$stmt->execute();
							$animalsList = $stmt->fetchAll();
							
							?>
							<th>Departure Date from SPCA location</th>
							</tr>
							</thead>
							<tbody> 
							<?php
							
							foreach($animalsList as $animal){ ?>
												<tr>
												<td><?php echo $animal['id'] ?></td>
												<td><?php echo $animal['animal_type'] ?></td>
												<td><?php echo $animal['arrival_date'] ?></td>
												<td><?php echo $animal['departure_date_date'] ?></td>
												</tr>
											<?php
											} 
						} ?>
					</tbody>	
					</table>
					<?php
					}		
					
					
					?>
					</section>
					
			</section>

		<?php require("./inc/footer.php"); ?>

	</body>
</html>