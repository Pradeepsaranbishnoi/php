
<?php 

include "db.php";

  if (isset($_POST['submit'])) {

    $first_name = $_POST['firstname'];

    $last_name = $_POST['lastname'];

    $email = $_POST['email'];
    
    $user_name = $_POST['username'];

    $password = $_POST['password'];

    $cdate = date('Y-m-d H:i:s');


    $sql1="SELECT * FROM `user` WHERE `username`='$user_name' AND `email`='$email'";

    $res=mysqli_query($conn,$sql1);

      if (mysqli_num_rows($res) > 0) {
        
        $row = mysqli_fetch_assoc($res);
        if($email==$row['email'])
        {
            	echo "email already exists";
        }
		if($username==$row['username'])
		{
			echo "username  already exists";
		}

		}
else{
	
  $sql = "INSERT INTO `user` (`firstname`, `last_name`, `email`, `username`, `password`, `created_date`) VALUES ('$first_name', '$last_name', '$email', '$user_name', '$password', ' $cdate')";
  $result = $conn->query($sql);    

    if ($result == TRUE) {

      echo "Your Account is created successfully.";
      header("Location: index.php");
    }else{

      echo "Error:". $sql . "<br>". $conn->error;

    } }

    $conn->close(); 

  }

?>
<?php include "header.php"?>


<h2>Registraion Form</h2>

<form action="" method="POST">

  <fieldset>

    <legend>Personal information:</legend>

    First name:<br>

    <input type="text" name="firstname">

    <br>

    Last name:<br>

    <input type="text" name="lastname">

    <br>
    Usename name:<br>

<input type="text" name="username">

<br>
    Email:<br>

    <input type="email" name="email">

    <br>

    Password:<br>
    <input type="password" name="password" value="" />

    <input type="submit" name="submit" value="submit">

  </fieldset>

</form>
<a href="login.php">Login</a>
<?php include "footer.php"?>