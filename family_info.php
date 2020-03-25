<?php 
include_once('inc/functions.php');
include_once('inc/forms.php');
include "config.php";
$id = get_string_form_data('animal_id', $_REQUEST);
$orgid = $_POST['organization'];
 ?>

<!DOCTYPE HTML>

<html lang="en">
<?php print_head("Family Information") ?>

	<body>
		<?php print_header(); ?>


		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">

					<header class="major special">
						<h2>Family Contact Information</h2>
					</header>
					
					<form action="adoption_complete.php" method="post">
					<div class="form-group">
						<label for="name">Your Last Name</label>
						<input type="text" id="L_NAME" name="l_name" placeholder="Smith" pattern=[A-Z\sa-z]{3,20} required>
					</div>
					<div class="form-group">
						<label for="name">Your Phone Number</label>
						<input type="text" id="PHONE_NUM" name="phone_num" placeholder="1234567890" pattern=[0-9]{10} required>
					</div>
					<div class="form-group">
						<label for="name">Street No.</label>
						<input type="text" id="street_num" name="street_num" placeholder="123" pattern=[0-9]{1,5} >
					</div>
					<div class="form-group">
						<label for="name">Street Name</label>
						<input type="text" id="street_name" name="street_name" placeholder="Main St." pattern=[A-Z\sa-z]{3,30} >
					</div>
					<div class="form-group">
						<label for="name">City</label>
						<input type="text" id="city" name="city" placeholder="Kingston" pattern=[A-Z\sa-z]{3,20} >
					</div>
					<div class="form-group">
						<label for="name">Province</label>
						<input type="text" id="prov" name="prov" placeholder="ON" pattern=[A-Z\sa-z]{2} >
					</div> <br>
					
			
					<section class="major special">
						<?php 
				
						if($orgid == 1) {
							$stmt = $pdo->prepare("SELECT adoption_fee FROM `animal` join `spca` WHERE id=:id and spca_branch=org_name");
							$stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
							$stmt->execute();
							$fee = $stmt->fetch()[0]; 
						}
						if($orgid == 3) {
							$stmt = $pdo->prepare("SELECT adoption_fee FROM `animal` join `shelter` WHERE id=:id and shelter_name=shelter_branch");
							$stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
							$stmt->execute();
							$fee = $stmt->fetch()[0]; 
						}
						echo "<br><h3>Please note that you are required to pay an adoption fee of: $ $fee </h3>"
						
						?>
					</section>
														
					<input type="hidden" name="id" id="id" value=<?php echo $id ?>/>	
					
					<input type="submit" value="Adopt!"/>
					

					</form>
					
			</section>
		
			
		
		<?php
		
			
		include("./inc/footer.php"); ?>

	</body>
</html>