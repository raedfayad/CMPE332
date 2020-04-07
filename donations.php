<?php include_once('./inc/functions.php'); ?>

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
                        
                       
						<form id = "myform" name="myform" method = "post" >
							
							<h2 class="title">Select an option:</h2>
							<div class="drop">
							<div class="select-wrapper">
								
							<select name='sel_donate' id='sel_donate' required >
								<option value=''> </option>
								<option value='1'>Lookup Donor Statistics</option>
								<option value='2'>Lookup Organization Statistics</option>
								<option value='3'>Donate to an Organization</option>
								</select>
							</div>
							</div>
							<input type="submit" value="Submit"/>
							
						</form>
						 
				</div>
			</section>
    </body>
</html>
