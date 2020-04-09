<?php 
include_once('inc/functions.php');
include_once('inc/forms.php');
include "config.php";

$orgid = $_POST['organization'];
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


 ?>

<!DOCTYPE HTML>

<html lang="en">
<?php print_head("Animals Available") ?>

	<body>
		<?php print_header(); ?>


		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">

					<header class="major">
						<h2>Animals Available at <?php echo $loc ?></h2>
					</header>

					
							 
					<?php
					if ($count > 0) { ?>
						<p class="below_header">Please select the animal that you would like to adopt: </p>
				

						<table>
							<thead>
								<tr>
									<th>Selection</th>
									<th>Animal ID</th>
									<th>Animal Type</th>
									<th>Arrival Date at SPCA location</th>
						<?php
						if($orgid == 1) {
							?>
							</tr>
							</thead>
							<tbody> 
							<form method="post" action="family_info.php">	
							<?php
							foreach($animalsList as $animal){ ?>
								<tr>
									<td>
										<div class="AnimalRadio">
											<input type="radio" id=<?php echo $animal['id'] ?> name="animal_id" value=<?php echo $animal['id'] ?>>
											<label> </label>
										</div>
									</td>
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
							<form method="post" action="family_info.php">	
							<?php
						foreach($animalsList as $animal){ ?>
											<tr>
												<td>
													<div class="AnimalRadio">
														<input type="radio" id=<?php echo $animal['id'] ?> name="animal_id" value=<?php echo $animal['id'] ?>>
														<label></label>
													</div>
												</td>
											<td><?php echo $animal['id'] ?></td>
											<td><?php echo $animal['animal_type'] ?></td>
											<td><?php echo $animal['arrival_date'] ?></td>
											<td><?php echo $animal['departure_date'] ?></td>
											</tr>
										<?php }										
						}
					?>
					</tbody>
					</table>
					<input type="hidden" name="organization" id="organization" value=<?php echo $orgid ?>/>
					<input type="submit" value="Submit"/>

					</form>
					<?php
					}
					else { ?>
					
					<p class="below_header">Sorry there are no animals available at this location. <a href='adopt.php'> Try another location here. </a> </p>
						
					<?php 
					} 
					?>
				</div>
			</section>

		<?php include("./inc/footer.php"); ?>

	</body>
</html>