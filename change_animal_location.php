<?php include_once('./inc/functions.php');
 require_once "config.php";
$shelters = $pdo->query("SELECT shelter_name FROM shelter");

$animal_id = "";
$destination_shelter = "";
 ?>

<html lang="en">
<?php print_head("Employee Terminal") ?>
<head>
<script src="js/script.js" type="text/javascript"></script>
</head>
	<body>
		<?php print_header(); ?>


		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">

					<header class="major special">
						<h2>Change Animal Location</h2>
                    </header> 
							
					<form method="post">
						<h1>Select an animal ID:</h1>
						<select name="animal_id">
							<option value="">IDs</option>
								<?php
								$row = $pdo->query("select id from animal where shelter_branch is NULL and family_name is NULL");
								foreach($row as $row){ ?>							
									<option><?php echo $row['id'] ?></option>
								<?php } ?>
						</select>
						
						<h1>Select a location that you would like to move the animal to:</h1>
						<select id="shelters" name="destination" >
						<?php
							while ($rows = $shelters->fetch()){
								$shelter_name=$rows['shelter_name'];
								echo "<option value='$shelter_name'>$shelter_name</option>";
							}
						?>
						</select>
						
						<h1> Was this animal rescued? </h1>
						<select id='rescued'>
							<option value = ""> </option>
							<option value= "Yes">Yes</option>
							<option value= "No">No</option>
						</select>
						
						<h1> If rescued, please enter the driver name: </h1>
						<input type="text" name="driver" id="driver">
						
				
					<input type="submit" value="Submit">
					</form>
                        
			</section>




<?php

       if(!empty(($_POST["animal_id"]))){
           
          $animal_id = $_POST["animal_id"];
          $destination_shelter = $_POST["destination"];
           
           $stmt =  $pdo->prepare('UPDATE animal SET shelter_branch=?, departure_date=CURRENT_DATE WHERE id=?');
           $stmt->execute([$destination_shelter, $animal_id]);
           if ($stmt){
               echo "Successfully sent the following query to the database: UPDATE animal SET shelter_branch='$destination_shelter', departure_date=CURRENT_DATE WHERE id=$animal_id";
           }
           else{
               echo "Server Error: please ensure you have entered a valid animal id.";
           }
          
      }
        else{
            echo "Please enter an animal id.";
        }
     
?>

    <?php include("./inc/footer.php"); ?>

    </body>
</html>
