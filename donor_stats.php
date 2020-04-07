<?php include_once('./inc/functions.php');
require_once "config.php";
$donator_name = "";
if(!empty($_POST["donator_name"])){
    $donator_name = trim($_POST["donator_name"]);
    $stmt =  $pdo->prepare('SELECT DISTINCT org_name from donations WHERE donator_name=:donator_name');
	$stmt->bindValue(':donator_name', $donator_name);
    $stmt->execute();
	$donationList= $stmt->fetchAll();
	$count = count($donationList);
	
	$stmt2 =  $pdo->prepare('SELECT SUM(amount) FROM donations WHERE donator_name =:donator_name');
    $stmt2->bindValue(':donator_name', $donator_name);
	$stmt2->execute();
    $amount=$stmt2->fetch()[0];
}

 ?>

<!DOCTYPE HTML>

<html lang="en">
<?php print_head("Donations: Donor Statistics") ?>

	<body>
		<?php print_header(); ?>


		<!-- Main -->
		<section id="main" class="wrapper">
			<div class="container">
				<header class="major">
					<h2> Donor Statistics </h2>
				</header>
				

				<form method="post">
				  <label for="donator_name"> Enter Donor Name: (Try Bill Gates)</label>
					<input type="text" name="donator_name" value="" required />
					
					<div class="sub">
						<input type="submit" value="Submit"/>
					</div>
				</form>
				<br>
					
				<?php
				if(!empty($_POST["donator_name"])){ 
					if ($count > 0) { ?>
												  
						<table>
						<h1>Organizations <?php echo $donator_name ?> has donated to:</h1> <?php
						foreach($donationList as $donation) {
								echo "<tr>";
								echo "<td>".$donation['org_name']."</td>";
								echo "</tr>";   
						}
						?>
						</table>
						
						<h1>This person has donated a total of: <?php echo $amount?>Dollars</h1> <?php
					} 
					else {
						echo "No results found for '$donator_name'";	
					}
				}
				?>
						
						
						
			</div>	
		</section>
		
		<?php include("./inc/footer.php"); ?>
		
	</body>
</html>