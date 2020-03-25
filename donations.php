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
                        
                        <h2>Lookup Donator Statistics</h2>
                       
                        <?php
                            // Include config file
                            require_once "config.php";
                            $donator_name = "";
                        ?>

                        <form method="post">
                          <h1>Enter Donor Name: (Try Bill Gates)</h1>
                            <input type="text" name="donator_name" value="">
                            <br>
                            <?php
                                if(!empty(trim($_POST["donator_name"]))){
                                    $donator_name = trim($_POST["donator_name"]);
                                    $stmt =  $pdo->prepare('SELECT DISTINCT org_name from donations WHERE donator_name=?');
                                     $stmt->execute([$donator_name]);
                                
                                    echo "<table>";
                                    echo "<h1>Organizations $donator_name has donated to:</h1>";
                                    while ($row = $stmt->fetch()) {
                                        echo "<tr>";
                                        echo "<td>".$row['org_name']."</td>";
                                        echo "</tr>";
                                    }
                                    echo "</table>";
                                    
                                    $stmt2 =  $pdo->prepare('SELECT SUM(amount) FROM donations WHERE donator_name =?');
                                    $stmt2->execute([$donator_name]);
                                    $amount=$stmt2->fetch()[0];
                                    echo "<h1>This person has donated a total of: 0$amount Dollars</h1>";
                                } else {
                                    echo "Please enter a donor's full name";
                                    echo "<br>";
                                }
                            ?>
                            <input type="submit" value="Submit">
                        </form>
                        <br>
                        <h2>Lookup Organization Statistics</h2>
                       
                        <?php
                            $organizations = $pdo->query("SELECT org_name FROM organization");
                            $org_name = "Lost Paws";
                        ?>

                        <form method="post">
                          <h1>Select an organization:</h1>
                            <select id="organization" name="org_name" >
                            <?php
                                while ($rows = $organizations->fetch()){
                                    $org_name=$rows['org_name'];
                                    echo "<option value='$org_name'>$org_name</option>";
                                }
                           
                                echo "</select>";
                                if(!empty(trim($_POST["org_name"]))){
                                    $org_name = trim($_POST["org_name"]);
                                    $stmt =  $pdo->prepare('SELECT SUM(amount) FROM donations WHERE YEAR(donation_date)=2018 and org_name =?');
                                    $stmt->execute([$org_name]);
                                    $amount = $stmt->fetch()[0];
                                    echo "<br><h1>In 2018, $org_name has recieved a total of: $$amount dollars</h1>";
                                    
                                }
                            ?>
                            <input type="submit" value="Submit">
                        </form>
                    </header>
			</section>
    </body>
</html>
