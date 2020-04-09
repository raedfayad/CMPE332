<?php 
include_once('./inc/functions.php');
require_once "config.php";

$total_rescued = "";
if (!empty($_POST['rescue_org'])) {
		$rescue_org = $_POST['rescue_org'];
		$stmt = $pdo->prepare("SELECT * FROM driver WHERE rescuer_org=:rescuer_org");
		$stmt->bindValue(':rescuer_org', $rescue_org);
		$stmt->execute();
		$driverList = $stmt->fetchAll();	
}
?>

<html lang="en">
<?php print_head("Employee Terminal: Driver Information") ?>
<head>

</head>
	<body>
		<?php print_header(); ?>

		<!-- Main -->
		<section id="main" class="wrapper">
			<div class="container">
			
			<header class="major">
				<h2>Driver Information</h2>
			</header> 
				<p class=" bh below_header"> Select a rescue organization you would like to see driver information on: </p>
					<form id = "rescue-form" method="post">
					
						<select name="rescue_org" id="rescue_org" required>
							<option value="">Rescue Organizations</option>
						<?php	
						
							
							$rescues = $pdo->query("SELECT rescuer_name FROM rescuer");

							foreach($rescues as $rescue){ ?>							
								<option><?php echo $rescue[0] ?></option> 
								
								<?php } ?>
							</select>
							
							<div class="sub">
								<input type="submit" value="Submit"/>
							</div>
							</form>
							<?php 
							
					
					if (!empty($_POST['rescue_org']) )  {
					?>		
						<p>Information about drivers located at <?php echo $rescue_org ?>:</p>
						<table class="output">
							<thead>
								<tr>
									<th>Name</th>
									<th>Emergency Phone</th>
									<th>Drivers License</th>
									<th>License Plate</th>
								</tr>
							</thead>
							<tbody> 
						<?php

						foreach($driverList as $driver){ ?>
							<tr>
							<td><?php echo $driver['name'] ?></td>
							<td><?php echo $driver['emergency_phone'] ?></td>
							<td><?php echo $driver['drivers_license'] ?></td>
							<td><?php echo $driver['license_plate'] ?></td>
							</tr>
						
						<?php 
						} 
						
					} ?>
					</tbody>
					</table>
				</div>
			</section>
			




    <?php include("./inc/footer.php"); ?>

    </body>
</html>