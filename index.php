<?php include_once('./inc/functions.php');
 ?>
<!DOCTYPE HTML>

<html lang="en">
    <?php print_head("Animal Rescue Information Hub") ?>
	
    <body class="landing">
		<header id="header" class="alt">
				<img id="logo" src="images/adoption_logo.png"" alt="logo"/>
				<nav id="nav">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="organization.php">Organizations</a></li>
						<li><a href="adopt.php">Adopt</a></li>
                        <li><a href="donations.php">Donations</a></li>
                        <li><a href="employee_login.php">Employee Login</a></li>


                    </ul>
                </nav>
            </header>
			
			<!-- Banner -->
			<section id="banner">
				<h2>Animal Rescue Information Hub<br/></h2>
				<p>Adopt one today!</p>
				<ul class="actions">
					<li><a href="adopt.php" class="button special big">Get Started</a></li>
				</ul>
			</section>

			<main>
			<div class="container">
			<h2>Helping others is helping yourself - save one today!</h2>
			
			<p> The Animal Rescue Information Hub is an organization that helps animals find a home! On our
			website, adopt a pet, learn more about our donors or look into our associated organizations and branches. 
			</p>
			
			</div>
			</main>
			
				
		<?php include("./inc/footer.php"); ?>

	</body>
</html>
