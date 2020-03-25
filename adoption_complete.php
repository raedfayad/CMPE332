<?php 
include_once('inc/functions.php');
include_once('inc/forms.php');
include "config.php";
$loc = get_string_form_data('animal_id', $_REQUEST);
 ?>

<!DOCTYPE HTML>

<html lang="en">
<?php print_head("Adoption Complete") ?>

	<body>
		<?php print_header(); ?>


		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">

					<header class="major special">
						<h2>Congratulations! You have adopted a pet!</h2>
						<p><?= $loc ?></p>
					</header>
					<a href="#" class="image fit"><img src="images/dog_cat_1.jpg" alt="" /></a>
			
			</section>

		<?php include("./inc/footer.php"); ?>

	</body>
</html>