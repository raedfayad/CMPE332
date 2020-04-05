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
<?php print_head("Donations") ?>

	<body>
		<?php print_header(); ?>


		<!-- Main -->
			<section id="main" class="wrapper">
			<div class="container">
				<header class="major special">
					<h2> Donations </h2>
					
				</header>


				<h2>Lookup Organization Statistics</h2>
								   

				<form method="post">
				<div class="column-container">
				
					<section class="novel" id="organizations">
						<h3>Select an organization:</h3>
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
					
					<section class="novel" id="locations">
						<h3 class="title">Locations</h3>
						<div class="drop">
						<div class="select-wrapper">
							<select name="locations" id="sel_location">
								<option value="0"> Locations </option>
									
							</select>
						</div>
						</div>
					</section>

				</div> <!-- .column-container -->
				<input type="submit" value="Submit">
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
				data: {request: 2, org_id: org_id},
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
