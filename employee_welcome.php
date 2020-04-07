<?php 
include_once('./inc/functions.php');
require_once "config.php";

?>

<html lang="en">
<?php print_head("Employee Terminal") ?>
<head>

</head>
	<body>
		<?php print_header(); ?>

		<header class="major special">
			<h2>Change Animal Location</h2>
        </header> 
		<!-- Main -->
			<section id="main" class="wrapper">
				<form id = "employeeform" name="employeeform" method = "post" >
					<h2 class="title">Select an option:</h2>
					<div class="drop">
					<div class="select-wrapper">
						
					<select name='sel_employee' id='sel_employee' required >
						<option value=''> </option>
						<option value='1'>Lookup Driver Information</option>
						<option value='2'>Change Animal Location</option>
						
						</select>
					</div>
					</div>
					<input type="submit" value="Submit"/>
				</form>	
			</section>
			




    <?php include("./inc/footer.php"); ?>

    </body>
</html>