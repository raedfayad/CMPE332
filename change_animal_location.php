<?php 
include_once('./inc/functions.php');
require_once "config.php";
$shelters = $pdo->query("SELECT shelter_name FROM shelter");
$animals = $pdo->query("select id from animal where shelter_branch is NULL and family_name is NULL order by id");								
 ?>

<html lang="en">
<?php print_head("Employee Terminal: Change Animal Location") ?>
<head>

</head>
	<body>
		<?php print_header(); ?>

		<header class="major special">
			<h2>Change Animal Location</h2>
		</header> 
		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">

							
					<form method="post" action="./change_animal_location_submitted.php">
						<h1>Select an animal ID:</h1>
						<select name="animal_id" required>
							<option value="">IDs</>
								<?php
								foreach($animals as $animal){ ?>							
									<option><?php echo $animal['id'] ?></option>
								<?php } ?>
						</select>
						
						<h1>Select a shelter that you would like to move the animal to:</h1>
						<select id="shelters" name="destination" required>
						<?php
							while ($rows = $shelters->fetch()){
								$shelter_name=$rows['shelter_name'];
								echo "<option value='$shelter_name'>$shelter_name</option>";
							}
						?>
						</select>
						
						<h1> Was this animal rescued? </h1>
						<select name="rescued" id='rescued' required>
							<option value = ""> </option>
							<option value= "Yes">Yes</option>
							<option value= "No">No</option>
						</select>
						
						<h1> If rescued, please select the rescue organization used and driver: </h1>
						<select name="rescue_names" id="rescue_names">
							<option value="">Rescue Organizations</option>
								<?php
								$orgs = $pdo->query("select rescuer_name from rescuer");
								foreach($orgs as $org){ ?>							
									<option value="<?php echo $org[0] ?>" > <?php echo $org['rescuer_name'] ?></option>
								<?php } ?>
						</select>
						<select name="driver" id="driver">
							<option value="">Driver Name</option>
								
						</select>
						
				
					<input type="submit" value="Submit">
					</form>
                        
			</section>
			<script type="text/javascript">
			$(document).ready(doubledropdown('#rescue_names','#driver',3));
			</script>


    <?php include("./inc/footer.php"); ?>

    </body>
</html>
