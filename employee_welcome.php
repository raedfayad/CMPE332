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

		
		<!-- Main -->
		<section id="main" class="wrapper">
			<div class="container">
			
				<header class="major">
				<h2>Employee Terminal</h2>
				</header> 
			
			
				<form id = "employeeform" name="employeeform" method = "post" >
					<h2 class="title">Select an option:</h2>
					<div class="drop select-wrapper">
						
						<select name='sel_employee' id='sel_employee' required >
							<option value=''> </option>
							<option value='1'>Lookup Driver Information</option>
							<option value='2'>Change Animal Location</option>
						</select>
					</div>
					
					<div class="sub">
						<input type="submit" value="Submit"/>
					</div>
				</form>	
			</div>
		</section>

    <?php include("./inc/footer.php"); ?>

    </body>
</html>