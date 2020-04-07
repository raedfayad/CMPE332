<?php include_once('./inc/functions.php');
	  include_once('./inc/forms.php');

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


		<!-- Main -->
	<section id="main" class="wrapper">
		<div class="container">

			<header class="major special">
				<h2>Adopt a Pet</h2>
				<p> Choose where you would like to adopt your pet from: </p>
			</header>

			<!-- <a href="#" class="image fit"><img src="images/pic01.jpg" alt="" /></a> -->

			<form id="adopt-form" method="post" action="./animal_info.php">

				<div class="column-container">

					<section class="novel" id="organizations">
						<h2 class="title">Organization</h2>
						<div class="drop">
						<div class="select-wrapper">

						<select name='organization' id='sel_organization' required >
		          	<option value='' >Organizations</option>
					<option value='1'>SPCA </option>
					<option value='3'>Shelter </option>
		        	</select>
						</div>
						</div>
					</section>

					<section class="novel" id="locations">
						<h2 class="title">Shelters</h2>
						<div class="drop">
						<div class="select-wrapper">
							<select name="locations" id="sel_location" required>
								<option value=""> Locations </option>

							</select>
							</div>
							</div>
						</section>

				</div> <!-- .column-container -->
				<div class="row">
					<input type="submit" value="Submit"/>
				</div>
			</form>
	</section>

	<?php include("./inc/footer.php"); ?>
	
	<!-- Script -->
	<script type="text/javascript">
	$(document).ready(doubledropdown('#sel_organization','#sel_location',1));
	</script>

</body>
</html>
