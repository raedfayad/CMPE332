<?php
/***************************************************************************/
/* print_head(...) */
/***************************************************************************/
function print_head($page_title) {?>
	<head>
		<title>ARIH - <?= $page_title ?> </title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<!-- Scripts -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/skel.min.js"></script>
		<script src="assets/js/util.js"></script>
		<script src="assets/js/main.js"></script>
	</head>
	<?php
}

/***************************************************************************/
/* print_header(...) */
/***************************************************************************/
function print_header($index = false) {
	include("./inc/header.php"); 
	if ($index == true) { ?>
		<!-- Banner -->
			<section id="banner">
				<h2>Animal Rescue Information Hub<br/></h2>
				<p>Adopt one today!</p>
				<ul class="actions">
					<li><a href="adopt.php" class="button special big">Get Started</a></li>
				</ul>
			</section>
	<?php
	}
	else {
		echo '</head>';
	}
}

?>

