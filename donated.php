<?php 
include_once('./inc/functions.php'); 
include_once('inc/forms.php');
include "config.php";

$organization = get_string_form_data('org_donate',$_POST);
$name = get_string_form_data('donor_name',$_POST);
$amount = get_string_form_data('amount',$_POST);


$stmt =  $pdo->prepare('select * from donations where donator_name=:donator_name and donation_date=CURRENT_DATE and org_name =:org_name');
$stmt->bindParam(':donator_name', $name);
$stmt->bindParam(':org_name', $organization);
$stmt->execute();
$duplicates = $stmt->fetchAll();
$count = count($duplicates);
if ($count == 0) {
	$stmt =  $pdo->prepare('INSERT into donations values (:donator_name, :amount, CURRENT_DATE, :org_name)');
	$stmt->bindParam(':donator_name', $name);
	$stmt->bindParam(':org_name', $organization);
	$stmt->bindParam(':amount', $amount);
	$stmt->execute();
	$message = "Thank you for donating!";
	$img = "<a href='#' class='image fit'><img src='images/guinea-pig.jpg' alt='' /></a>";
	
}
else {
	$message = "Sorry, you've already donated to this organization today. Try again tomorrow, or donate to a different organization!";
	$img = "<a href='#' class='image fit'><img src='images/sad-animal.jpg' alt='' /></a>";
	
}
?>

<!DOCTYPE HTML>

<html lang="en">
<?php print_head("Donations") ?>

	<body>
		<?php print_header(); ?>
	<header class="major special">
		<h2> Donations </h2>
	</header>

	<!-- Main -->
		<section id="main" class="wrapper">
			<div class="container">
				  
				<p> <?php echo $message ?> </p>
				<?php echo $img ?> 
					 
			</div>
		</section>
    </body>
</html>