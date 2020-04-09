<?php include_once('./inc/functions.php');
require_once "config.php";
$donator_name = "";

if(!empty($_POST["locations"])){
	$org_name = trim($_POST["locations"]);
	$stmt =  $pdo->prepare('SELECT YEAR(donation_date),SUM(amount) FROM donations WHERE org_name =:org_name GROUP BY YEAR(donation_date)');
	$stmt->bindValue(':org_name', $org_name);
	$stmt->execute();
	$donationList = $stmt->fetchAll();
	$count = count($donationList);
	
	$stmt2 =  $pdo->prepare('SELECT SUM(amount) as total FROM donations WHERE org_name =:org_name');
    $stmt2->bindValue(':org_name', $org_name);
	$stmt2->execute();
    $amount=$stmt2->fetch()[0];
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
								   
				<p class=" bh below_header" > Select a location to see the amount donated per year: </p>
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
				<div class="row">
					<input type="submit" value="Submit">
				</div>
				</form>
					  
						<?php
						
						if(!empty($_POST["locations"])){
							if ($count > 0) {
							?>
							<div class="form-group">
							<h1>Results for <?php echo $org_name ?>:</h1> 
							</div>						  
							<table>
								<thead>
									<th> Year </th>
									<th> Total Amount Donated </th>
								</thead>
								<tbody>
							<?php
							foreach($donationList as $donation) { ?>
									<tr>
									<td> <?php echo $donation[0] ?></td>
									<td>$ <?php echo $donation[1] ?> </td>
									</tr>   
							<?php
							}
							?>
							</tbody>
							<tfoot>
								<tr>
								<th> Overall Total </th>
								<th> $ <?php echo $amount?> </th>
							</table>
							<?php
							}
							else {
								echo "<p> No donations have been made to $org_name. <a href='donate.php'> Be the first to donate here!</a> </p>"; 
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
