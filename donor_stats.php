<?php include_once('./inc/functions.php');
require_once "config.php";
$donator_name = "";

$donors = $pdo->query("SELECT distinct donator_name from donations");

if(!empty($_POST["donator_name"])){
    $donator_name = trim($_POST["donator_name"]);
    $stmt =  $pdo->prepare('SELECT org_name, sum(amount) from donations WHERE donator_name=:donator_name group by org_name');
	$stmt->bindValue(':donator_name', $donator_name);
    $stmt->execute();
	$donationList= $stmt->fetchAll();

	
	$stmt2 =  $pdo->prepare('SELECT SUM(amount) as total FROM donations WHERE donator_name =:donator_name');
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
				
				<p class="bh below_header" > Select a name to see what organizations they have donated to:</p>
				
				<form method="post">
				 	
					<div class= "select-wrapper">
					<select name="donator_name" id="donator_name" required>
							<option value="">Donor Name</option>
						<?php	
							foreach($donors as $donor){ ?>							
								<option><?php echo $donor[0] ?></option> 
								
								<?php } ?>
							</select>
					</div>
					
					<div class="sub">
						<input type="submit" value="Submit"/>
					</div>
				</form>
				<br>
					
				<?php
				if(!empty($_POST["donator_name"])){ ?>
					<div class= "form-group">
					<h1>Results for <?php echo $donator_name ?>:</h1> 
					</div>						  
					<table>
						<thead>
							<th> Organization </th>
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
				?>		
						
			</div>	
		</section>
		
		<?php include("./inc/footer.php"); ?>
		
	</body>
</html>