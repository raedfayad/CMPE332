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

		
		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">
					
					<header class="major">
						<h2>Change Animal Location</h2>
					</header> 
							
					<form method="post" action="./change_animal_location_submitted.php">
						
						<div class="form-group">
							<label for="animal_id"> Select an animal ID:</label>
							<div class="select-wrapper">
							<select name="animal_id" required>
								<option value="">IDs</>
									<?php
									foreach($animals as $animal){ ?>							
										<option><?php echo $animal['id'] ?></option>
									<?php } ?>
							</select>
							</div>
						</div>
						
						<div class="form-group">
							<label for="destination">Select a shelter that you would like to move the animal to:</label>
							<div class="select-wrapper">
							<select id="shelters" name="destination" required>
							<?php
								while ($rows = $shelters->fetch()){
									$shelter_name=$rows['shelter_name'];
									echo "<option value='$shelter_name'>$shelter_name</option>";
								}
							?>
							</select>
							</div>
						</div>
						
						<div class="form-group">
							<label for="rescued">Was this animal rescued?</label>
							<div class="select-wrapper">
							<select name="rescued" id='rescued' required>
								<option value = ""> </option>
								<option value= "Yes">Yes</option>
								<option value= "No">No</option>
							</select>
							</div>
						</div>
						
						<div class="form-group">
							<label for="rescue_names">If rescued, please select the rescue organization used and driver:</label>
							<div class="select-wrapper">
							<select name="rescue_names" id="rescue_names">
								<option value="">Rescue Organizations</option>
									
							</select>
							</div>
						</div>
						
						<div class="form-group">
							<div class="select-wrapper">
							<select name="driver" id="driver">
								<option value="">Driver Name</option>		
							</select>
							</div>
						</div>
						
						<div class="sub">
							<input type="submit" value="Submit">
						</div>
					</form>
                        
			</section>
			<script type="text/javascript">
			$(document).ready(doubledropdown('#rescued','#rescue_names',3));
			$(document).ready(doubledropdown('#rescue_names','#driver',4));
			</script>


    <?php include("./inc/footer.php"); ?>

    </body>
</html>
