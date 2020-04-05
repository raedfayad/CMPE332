<?php include_once('./inc/functions.php');
 ?>
<!DOCTYPE HTML>

<html lang="en">
<?php print_head("Employee Login") ?>

	<body>
		<?php print_header(); ?>

		<!-- Main -->
			<?php
            // Initialize the session
            session_start();
             
             
            // Include config file
            require_once "config.php";
             
            // Define variables and initialize with empty values
            $username = $password = "";
            $username_err = $password_err = "";
             
            // Processing form data when form is submitted
            if($_SERVER["REQUEST_METHOD"] == "POST"){
             
                // Check if username is empty
                if(empty(($_POST["username"]))){
                    $username_err = "Please enter your full name in username field.";
                } else{
                    $username = trim($_POST["username"]);
                }
                
                // Check if password is empty
                if(empty(($_POST["password"]))){
                    $password_err = "Please enter your password.";
                } else{
                    $password = trim($_POST["password"]);
                }
                
                // Validate credentials
                if(empty($username_err) && empty($password_err)){
                    // Prepare a select statement
                    if($stmt = $pdo->prepare('SELECT employee_name FROM employee WHERE employee_name = ?')){
                        // Bind variables to the prepared statement as parameters
                       
                        
                        // Attempt to execute the prepared statement
                        if( $stmt->execute([$username])){
                            // Store result
                            
                            // Check if username exists, if yes then verify password
                            if( $stmt->fetch()){
                                // Bind result variables
                                // Password is correct, so start a new session
                                session_start();
                                
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;
                                
                                // Redirect user to welcome page
                                header("location: change_animal_location.php");
                            
                            } else{
                                // Display an error message if username doesn't exist
                                $username_err = "No account found with that username. Please enter your full name in username field.";
                            }
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }

                    }
                }
                
            }
            ?>
             

            
            <body>
                <div class="login_wrapper">
                    <h2>Login</h2>
<p>Please fill in your credentials to login. Try the following credentials; Username: Raed Fayad Password: hello</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                            <span class="help-block"><?php echo $username_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                            <span class="help-block"><?php echo $password_err; ?></span>
                        </div>
                        <h2></h2>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Login">
                        </div>
                    </form>
                </div>
				
				<?php include("./inc/footer.php"); ?>
            </body>
            </html>

		
		
	</body>
</html>
