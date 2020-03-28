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
<?php print_head("Organizations") ?>

<body>
	<?php print_header(); ?>


	<!-- Main -->
	<section id="main" class="wrapper">
		<div class="container">

			<header class="major special">
				<h2>Organizations</h2>
				<p>Choose a location to see the animals located there and their information:</p>
			</header>

			<!-- <a href="#" class="image fit"><img src="images/pic01.jpg" alt="" /></a> -->
	
			<form id="org-form" method="post" action="./org_info.php">
				
				<div class="column-container">
					
					<section class="novel" id="organizations">
						<h2 class="title">Organization Type</h2>
						<div class="drop">
						<div class="select-wrapper">
							
						<select name='organization' id='sel_organization' >
		          	<option value='0' >Organizations</option>
					<option value='1'>SPCA </option>
					<option value='2'>Rescue Organizations </option>
					<option value='3'>Shelter </option>
		        	</select>
						</div>
						</div>
					</section>
					<!--
					<section class="novel" id="rescue">
						<h2 class="title">Rescue Organizations</h2>
						<div class="drop">
						<div class="select-wrapper">
							<select name="rescue_locations" id="rescue_locations">
								<option value="">- Rescue locations -</option>
									

									$dbh = new PDO('mysql:host=localhost;dbname=animal_rescue', "root", ""); 
									$row = $dbh->query("select org_name from rescuer");

									foreach($row as $row){ ?>							
										<option>< echo $row['org_name'] </option>
									 } 
									</select>
						</div>
						</div>
					</section>
					-->
					<section class="novel" id="locations">
						<h2 class="title">Locations</h2>
						<div class="drop">
						<div class="select-wrapper">
							<select name="locations" id="sel_location">
								<option value="0"> Locations </option>
									
							</select>
							</div>
							</div>
						</section>

				</div> <!-- .column-container -->
				<div class="row separate">
					<input type="hidden" name="<?= CONTACT_FORM_SECRET ?>" id="<?= CONTACT_FORM_SECRET ?>" value="It's a secret!"/>
					<input type="submit" value="Submit"/>
				</div>	
			</form>
	</section>

	<?php include("./inc/footer.php"); ?>
	<!-- Script -->
	<script type="text/javascript">
	$(document).ready(function(){

		// Country
		$('#sel_organization').change(function(){

			var org_id = $(this).val();
			// Empty state and city dropdown
			$('#sel_location').find('option').not(':first').remove();

			// AJAX request
			$.ajax({
				url: 'ajaxfile.php',
				type: 'post',
				data: {request: 1, org_id: org_id},
				dataType: 'json',
				success: function(response){
					
					var len = response.length;

		            for( var i = 0; i<len; i++){
		               
		                var name = response[i]['name'];
		                    
		                $("#sel_location").append("<option value='"+name+"'>"+name+"</option>");

		            }
				}
			});
			
		});


		
	});
	</script>

</body>
</html>