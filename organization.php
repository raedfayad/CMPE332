<?php include_once('./inc/functions.php');
 ?>

<!DOCTYPE HTML>
<!--
	Spatial by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html lang="en">
<?php print_head("Organizations") ?>

	<body>
		<?php print_header(); ?>


		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">

					<header class="major special">
						<h2>Organizations</h2>
						<p>Lorem ipsum dolor sit amet nullam id egestas urna aliquam</p>
					</header>

					<!-- <a href="#" class="image fit"><img src="images/pic01.jpg" alt="" /></a> -->
					<p>Vis accumsan feugiat adipiscing nisl amet adipiscing accumsan blandit accumsan sapien blandit ac amet faucibus aliquet placerat commodo. Interdum ante aliquet commodo accumsan vis phasellus adipiscing. Ornare a in lacinia. Vestibulum accumsan ac metus massa tempor. Accumsan in lacinia ornare massa amet. Ac interdum ac non praesent. Cubilia lacinia interdum massa faucibus blandit nullam. Accumsan phasellus nunc integer. Accumsan euismod nunc adipiscing lacinia erat ut sit. Arcu amet. Id massa aliquet arcu accumsan lorem amet accumsan.</p>
					
					<div class="column-container">
				
						<section class="novel" id="SPCA">
							<h2 class="title">SPCA</h2>
							<div class="drop">
							<div class="select-wrapper">
								<select name="SPCA_locations" id="SPCA_locations">
									<option value="">- SPCA locations -</option>
										<?php

										$dbh = new PDO('mysql:host=localhost;dbname=animal_rescue', "root", ""); 
										$row = $dbh->query("select org_name from SPCA");

										foreach($row as $row){ ?>							
											<option><?php echo $row['org_name'] ?></option>
										<?php } ?>
										</select>
							</div>
							</div>
						</section>
						
						<section class="novel" id="rescue">
							<h2 class="title">Rescue Organizations</h2>
							<div class="drop">
							<div class="select-wrapper">
								<select name="rescue_locations" id="rescue_locations">
									<option value="">- Rescue locations -</option>
										<?php

										$dbh = new PDO('mysql:host=localhost;dbname=animal_rescue', "root", ""); 
										$row = $dbh->query("select rescuer_name from rescuer");

										foreach($row as $row){ ?>							
											<option><?php echo $row['rescuer_name'] ?></option>
										<?php } ?>
										</select>
							</div>
							</div>
						</section>
						
						<section class="novel" id="shelters">
							<h2 class="title">Shelters</h2>
							<div class="drop">
							<div class="select-wrapper">
								<select name="shelter_locations" id="shelter_locations">
									<option value="">- Shelter locations -</option>
										<?php

										$dbh = new PDO('mysql:host=localhost;dbname=animal_rescue', "root", ""); 
										$row = $dbh->query("select shelter_name from shelter");

										foreach($row as $row){ ?>							
											<option><?php echo $row['shelter_name'] ?></option>
										<?php } ?>
										</select>
								</div>
								</div>
							</section>

					</div> <!-- .column-container -->
			</section>

		<?php include("./inc/footer.php"); ?>

	</body>
</html>