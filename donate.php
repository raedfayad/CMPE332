<?php 
include_once('./inc/functions.php'); 
include "config.php";

$orgs = $pdo->query("SELECT org_name FROM organization order by org_type");
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
					<p> Donate Today or take a look at our donation records </p>
				</header>
					
				   
				<p> Fill out the form accordingly to donate! </p>
				<form id = "donate-form" method="post" action="donated.php">
					<label> Organization donating to:</label>
					<select name="org_donate" id="org_donate" required>
						<option value="">Organizations</option>
					<?php	
					foreach($orgs as $org){ ?>							
						<option><?php echo $org[0] ?></option> 
							
					<?php } ?>
					</select>
					<label>(Full) Name:</label>
                    <input type="text" name="donor_name" id="donor_name" required>
					<label>Amount (Dollars):</label>
                    <input type="text" name="amount" id="amount" required>
						
						<input type="submit" value="Submit"/>
						</form>
					 
			</div>
		</section>
    </body>
</html>
