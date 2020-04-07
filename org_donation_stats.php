<?php include_once('./inc/functions.php');
require_once "config.php";
$donator_name = "";

if(!empty($_POST["locations"])){
	$org_name = trim($_POST["locations"]);
	$stmt =  $pdo->prepare('SELECT SUM(amount) FROM donations WHERE YEAR(donation_date)=2018 and org_name =:org_name');
	$stmt->bindValue(':org_name', $org_name);
	$stmt->execute();
	$amount = $stmt->fetch()[0];
}
 ?>

<!DOCTYPE HTML>

<html lang="en">
<?php print_head("Donations: Organization Statistics") ?>

	<body>
		<?php print_header(); ?>


		<!-- Main -->
			<section id="main" class="wrapper">
			<div class="container">
				<header class="major">
					<h2>Organization Statistics</h2>	
				</header>
								   

				<form method="post">
				<div class="column-container">
				
					<section class="novel" id="organizations">
						<h3 class= "title">Organization Type</h3>
						<div class="drop select-wrapper">
												
						<select name='organization' id='sel_organization' required>
							<option value='0' >Organizations</option>
							<option value='1'>SPCA </option>
							<option value='2'>Rescue Organizations </option>
							<option value='3'>Shelter </option>
						</select>
						</div>
						
					</section>
					
					<section class="novel" id="locations" required>
						<h3 class="title">Locations</h3>
						<div class="drop select-wrapper">
						<select name="locations" id="sel_location">
								<option value="0"> Locations </option>
									
							</select>
						</div>
						
					</section>

				</div> <!-- .column-container -->
				<div class="sub">
					<input type="submit" value="Submit">
				</div>
				</form>
					  
						<?php
						echo "</select>";
						if(!empty($_POST["locations"])){
							if ($amount > 0) {
								echo "<br><p>In 2018, $org_name has received a total of: $$amount dollars</p>";
							}
							else {
								echo "<p> No donations have been made to $org_name. Be the first to donate here! </p>"; 
							}
						}
						?>
						
				</div>
				
		</section>
		
		
		<!-- Script -->
		<script type="text/javascript">
		$(document).ready(doubledropdown('#sel_organization','#sel_location',2));
		</script>	
		
    <?php include("./inc/footer.php"); ?>
	
    </body>
</html>
