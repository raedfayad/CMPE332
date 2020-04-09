<?php 
include_once('inc/functions.php');
include_once('inc/forms.php');
include "config.php";
$total_rescued = "";
$not_rescue = 0;

if (!empty($_POST['organization'])) {
	$orgid = get_string_form_data('organization', $_POST);
	$loc = get_string_form_data('locations', $_POST);
	if($orgid == 1) {			
		$stmt = $pdo->prepare("SELECT id, animal_type, arrival_date FROM animal WHERE family_name is NULL and shelter_branch is NULL and spca_branch=:spca_branch order by animal_type");
		$stmt->bindValue(':spca_branch', $loc);
		$stmt->execute();
		$animalsList = $stmt->fetchAll();
	}
	elseif($orgid == 3) {			
		$stmt = $pdo->prepare("SELECT * FROM animal WHERE family_name is NULL and shelter_branch=:shelter_branch order by animal_type");
		$stmt->bindValue(':shelter_branch', $loc);
		$stmt->execute();
		$animalsList = $stmt->fetchAll();
	}	
	$count = count($animalsList);
}



 ?>

<!DOCTYPE HTML>

<html lang="en">
<?php print_head("Organizations") ?>

	<body>
		<?php print_header(); ?>


		<!-- Main -->
		<section id="main" class="wrapper">
			<div class="container">	

					<header class="major">
						<h2>Organizations</h2>	
					</header>

					
					<?php 
					if($count > 0 ) { ?>
						<p class= "below_header">Information about animals located at <?php echo $loc ?></p>
						<table class="output">
							<thead>
								<tr>
									<th>Animal ID</th>
									<th>Animal Type</th>
									<th>Arrival Date at SPCA location</th>
							 
						<?php
						if($orgid == 1) { ?>
						
							</tr>
							</thead>
							<tbody> 
							<?php
							foreach($animalsList as $animal){ ?>
								<tr>
								<td><?php echo $animal['id'] ?></td>
								<td><?php echo $animal['animal_type'] ?></td>
								<td><?php echo $animal['arrival_date'] ?></td>
								</tr>
							<?php 
							} 
						}
					
						elseif($orgid == 3) {
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
												<td><?php echo $animal['departure_date'] ?></td>
												</tr>
											<?php
											} 
						} ?>
					</tbody>	
					</table>
					<?php
					}
					else { ?>
					
					<p class="below_header">There are no animals available at <?php echo $loc ?>. </p>
					<?php 
					}	
					?>
					
			</div>		
		</section>

		<?php require("./inc/footer.php"); ?>

	</body>
</html>