<?php include_once('./inc/functions.php');
 ?>

<html lang="en">
<?php print_head("Employee Terminal") ?>

	<body>
		<?php print_header(); ?>


		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">

					<header class="major special">
						<h2>Change Animal Location</h2>
                       
                        <?php
                            // Include config file
                            require_once "config.php";
                            $shelters = $pdo->query("SELECT shelter_name FROM shelter");

                            $animal_id = "";
                            $destination_shelter = "";

                            
                        ?>

                        <form method="post">
                          <h1>Enter animal ID below:</h1>
                            <input type="text" name="animal_id" value="">
                            <br>
                            <h1>Select a location that you would like to move the animal to:</h1>
                            <select id="shelters" name="destination" >
                            <?php
                                while ($rows = $shelters->fetch()){
                                    $shelter_name=$rows['shelter_name'];
                                    echo "<option value='$shelter_name'>$shelter_name</option>";
                                }
                            ?>
                            </select>
                        <br>
                        <input type="submit" value="Submit">
                        </form>
                        </html>
					</header>

            
			</section>




<?php

       if(!empty(trim($_POST["animal_id"]))){
           
          $animal_id = trim($_POST["animal_id"]);
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
