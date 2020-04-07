<?php 
include_once('inc/functions.php');
include_once('inc/forms.php');
include "config.php";
$orgid = $_POST['organization'];
$loc = get_string_form_data('locations', $_POST);
 ?>

<!DOCTYPE HTML>

<html lang="en">
<?php print_head("Animals Available") ?>

	<body>
		<?php print_header(); ?>


		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">

					<header class="major special">
						<h2>Animals Available at <?php echo $loc ?></h2>
					</header>

					<!-- <a href="#" class="image fit"><img src="images/pic01.jpg" alt="" /></a> -->
					<p>Please select the animal that you would like to adopt from <?php echo $loc ?></p>
					<section>

					<table>
						<thead>
							<tr>
								<th>Selection</th>
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
												<td>
													<div class="AnimalRadio">
														<input type="radio" id=<?php echo $animal['id'] ?> name="animal_id" value=<?php echo $animal['id'] ?>>
														<label></label>
													</div>
												</td>
											<td><?php echo $animal['id'] ?></td>
											<td><?php echo $animal['animal_type'] ?></td>
											</tr>
										<?php }										
					}
					?>
					</tbody>
					</table>
					<input type="hidden" name="organization" id="organization" value=<?php echo $orgid ?>/><br>
					<input type="submit" value="Submit"/>

					</form>
			</section>

		<?php include("./inc/footer.php"); ?>

	</body>
</html>