<?php require_once('includes/connection.php'); ?>
<?php require_once('includes/session.php'); ?>
<?php 
           //form login submitted
		   if(isset($_POST['login_btn'])){
			 
			  //form variables
			  $username = trim(mysql_real_escape_string($_POST['username']));
			  $password = md5($_POST['pwd']);
			  
			  $query = "SELECT * FROM users WHERE username = '$username' and password='$password'";
			  $result = mysql_query($query, $connection) or die("Database query failed: " . mysql_error());
			  
			  $row = mysql_fetch_array($result);
			  
			   if ($row > 0 ){ //User Found
				   $_SESSION['username'] =  true;
				   
				   header("Location: index.php");
				    }
					else{ //User Not Found
						
						$error_login = true; 
						}
		   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Contact List</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body    style ="background-color: #046704;">
<div class="container" >
  
          
        

          <div class="col-md-6" style="padding: 10px;margin-top: 20px;background-color: #fff;border: 1px solid #ccc;" >
          <h2>Login Form</h2>
          
		  
		  <?php if(isset($error_login)) {  ?>
          <div class="alert alert-danger">
          <strong>Access Denied!</strong> Wrong Username OR Password
          </div>
          <?php } ?>
          
          
             <form role="form" action="login.php" method="post" >
              <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" required>
              </div>
              <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" name="pwd" required>
              </div>
            
            
              <button type="submit" name="login_btn" class="btn btn-primary">Submit</button>
            </form>
            </div>


</div>
</body>
</html>