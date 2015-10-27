<?php require_once('includes/connection.php'); ?>
<?php require_once('includes/session.php'); ?>
<?php confirm_logged_in(); //confirm whether the user logged in ?>
<?php 
      
	  
	   //ADD New Contact List
	   if(isset($_POST['add_contact'])){//
		  $names = ucfirst(mysql_real_escape_string($_POST['names']));
		  $phone = mysql_real_escape_string($_POST['phone']);
		  $email = mysql_real_escape_string($_POST['email']);
		  
		  
		 $query = "INSERT INTO contactlist ( names, phone, email) VALUES ( '{$names}', '{$phone}' , '{$email}')";
		 $result = mysql_query($query, $connection);
		 header("Location: index.php?submitted=true");
		 }//
		 
		 
		      //UPDATE / EDIT
			   elseif(isset($_POST['edit_btn'])){
				   $id = $_POST['id']; 
				   $names = ucfirst(mysql_real_escape_string($_POST['names']));
		           $phone = mysql_real_escape_string($_POST['phone']); 
				   $email = mysql_real_escape_string($_POST['email']);
				   
				   $query = "UPDATE contactlist SET names = '$names', phone = '$phone', email = '$email' WHERE id = $id";				   
				   $result = mysql_query($query, $connection);
				  
				   header("Location: index.php");
				   
				   }
		 
		  
			 
			  //DELETE
	     	  elseif(isset($_GET['deleteid'])){
			  $id = mysql_real_escape_string($_GET['deleteid']);
			  
			       $query = "DELETE FROM contactlist WHERE id = $id";				   
				   $result = mysql_query($query, $connection);
				  
				   header("Location: index.php");
			   }
			  

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Contact List</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/sticky-footer.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body style="background-color: #046704;">

<div class="container" style="background-color:#fff;">
  <h1 align="center" style="border-bottom: 4px double #fff; background-color: #222; color: #fff;">Contact List</h1>

  <ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="index.php">Contact List</a></li>
    <li><a href="settings.php">Settings</a></li>
    <li><a href="logout.php">Logout</a></li>       
  </ul> 
  
  
<hr style="border: 4px double #ccc;" />
 
  <?php  if(isset($_GET['submitted'])) { //added contact successfully ?>
  
  <div class="alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Added A new contact.
  </div>
  <?php } ?>
<div class="col-md-6">
 <h2>Add New</h2>
                <form action="index.php" method="post" >
                <input type="text" class="form-control add-contact" placeholder="Names." name="names" required><br>
                <input type="text" class="form-control add-contact" placeholder="Phone No." name="phone" required><br>
                <input type="email" class="form-control add-contact" placeholder="Email." name="email" required><br>
                <button type="submit" class="btn btn-primary" name="add_contact">Add New Contact</button>
                </form>
                    
                    <hr>
             <h2>Update Contact List</h2>
                    <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Names</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th style="text-align:center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                    <?php 
					$query = "SELECT * FROM contactlist	ORDER BY names";
			        $result = mysql_query($query, $connection) or die("Database query failed: " . mysql_error());
					$count = 1; 
			        while ($row = mysql_fetch_array($result)) {
					
					 ?>
                      <form action="index.php" method="post">
                      <input type="hidden" name="id" value="<?php echo $row['id']; ?>"  />
                      <tr>
                        <td><?php echo $count; ?></td>
                        <td><input type="text" style="width: 110px;" value= "<?php echo $row['names']; ?>" name="names" /> </td>
                        <td><input type="text" style="width: 110px;" value= "<?php echo $row['phone']; ?>" name="phone" /> </td>
                        <td><input type="text" style="width: 170px;" value= "<?php echo $row['email']; ?>" name="email" /> </td>
                        <td style="text-align:center;" >
                       
                       <button type="submit" data-toggle="tooltip" data-placement="top" title="Edit" name="edit_btn" class="btn btn-info btn-xs"> <span class="glyphicon glyphicon-edit"></span> </button>
                       
                       <a href="index.php?deleteid=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-danger btn-xs" onclick="return confirm('Delete this?')"> <span class="glyphicon glyphicon-trash"></span> </a></td>
                      </tr>
                      </form> 
                      <?php  
					  $count++; 
					  } ?>
                    </tbody>
                  </table>
             
</div>

<div class="col-md-6">
 <h2>Contact List</h2>
 <hr>
                    <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Names</th>
                        <th>Phone</th> 
                        <th>Email</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php 
					$query = "SELECT * FROM contactlist	ORDER BY names";
			        $result = mysql_query($query, $connection) or die("Database query failed: " . mysql_error());
					$count = 1; 
			        while ($row = mysql_fetch_array($result)) {
					
					 ?>
                      
                      <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $row['names']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                     </tr>
                     
                       <?php  
					  $count++; 
					  } ?>
                      
                    </tbody>
                  </table>
</div>

<hr style="border: 4px double #ccc; clear:both;    margin: 40px 0px;" /> 

</div>
  
 
  
<footer class="footer">
      <div class="container">
        <p class="text-muted" style="margin-top: 15px;font-size: 20px;color: #03437B;">Contact List Application</p>
      </div>
 </footer> 
 
 
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>

</body>
</html>