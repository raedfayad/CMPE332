<?php include_once('./inc/functions.php');
include_once('inc/forms.php');
include "config.php";
 ?>
<!DOCTYPE HTML>
<!--
	Spatial by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html lang="en">
<?php print_head("Adoption") ?>

	<body>
		<?php print_header(); ?>
		<header class="major special">
			<h2>Rescue Statistics</h2>
			
		</header>
		<!-- Main -->
		<section id="main" class="wrapper">
				<div class="container">
					<h2> The following table shows how many animals were rescued by all </h2>
						
					<table>
					<thead>
					<tr>
						<th> Year Rescued </th>
						<th> Total number of Animals Rescued </th>
					</tr>
					</thead>
					<tbody>
					
				<?php

					$years_r = $pdo->query("select DISTINCT YEAR(departure_date) as year from animal where YEAR(departure_date) > 0");

					foreach($years_r as $year_r) {
						echo "<tr>";
						$year = $year_r[0];
						echo "<td> $year </td>";
						
						$stmt = $pdo->prepare("SELECT count(id) as rescuedAnimals FROM animal WHERE driver_name is not null and YEAR(departure_date)=:year");
						$stmt->bindValue(':year', (int)$year, PDO::PARAM_INT);
						$stmt->execute();
						$total_rescued = $stmt->fetch()[0];	
						echo "<td> $total_rescued </td>";
					}		
				
				?>
					</tbody>
					</table>
													
				</div>
			</section>

		<?php include("./inc/footer.php"); ?>

	</body>
</html>