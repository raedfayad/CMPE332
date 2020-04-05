<?php 
include_once('inc/functions.php');
include_once('inc/forms.php');
include "config.php";
$total_rescued = "";
if (!empty($_POST['rescue_year'])) {
		$year = $_POST['rescue_year'];
		$stmt = $pdo->prepare("SELECT count(id) as rescuedAnimals from animal where driver_name is not null and YEAR(departure_date)=:year");
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
								</tr>
							</thead>
							<tbody> 
						<?php
						if($orgid == 1) {
						
							$stmt = $pdo->prepare("SELECT id, animal_type FROM animal WHERE family_name is NULL and shelter_branch is NULL and spca_branch=:spca_branch");
							$stmt->bindValue(':spca_branch', $loc);
							$stmt->execute();
							$animalsList = $stmt->fetchAll();

							
							foreach($animalsList as $animal){ ?>
								<tr>
								<td><?php echo $animal['id'] ?></td>
								<td><?php echo $animal['animal_type'] ?></td>
								</tr>
							<?php 
							} 
						}
					
						elseif($orgid == 3) {
							
							$stmt = $conn->prepare("SELECT id, animal_type FROM animal WHERE family_name is NULL and shelter_branch=:shelter_branch");
							$stmt->bindValue(':shelter_branch', $loc);
							$stmt->execute();
							$animalsList = $stmt->fetchAll();

							
							foreach($animalsList as $animal){ ?>
												<tr>
												<td><?php echo $animal['id'] ?></td>
												<td><?php echo $animal['animal_type'] ?></td>
												</tr>
											<?php
											} 
						} ?>
					</table>
					<?php
					}		
					else { ?>
					<p> Select a year you would like to see rescue information on: </p>
					<form id = "year-form" method="post">
					
						<select name="rescue_year" id="rescue_year">
							<option value="">Year Rescued</option>
						<?php	
						
							
							$row = $pdo->query("select DISTINCT YEAR(departure_date) as year from animal where YEAR(departure_date) > 0");

							foreach($row as $row){ ?>							
								<option><?php echo $row['year'] ?></option> 
								
								<?php } ?>
							</select>
							<input type="hidden" name="organization" id="organization" value=<?php echo $orgid ?>/>
							<input type="submit" value="Submit"/>
							</form>
							<?php 
					}		
					
					if (!empty($_POST['rescue_year']) )  {
					?>		
						<p><?php echo $total_rescued ?> were rescued in <?php echo $year ?></p>
						<?php
						}
					else {
						if ($orgid == 2 && $total_rescued != NULL) {
							echo "<p> no results found </p>";
						}
					}
					
					?>
					</section>
					
			</section>

		<?php require("./inc/footer.php"); ?>

	</body>
</html>