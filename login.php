<?php

include "db.php"; 

if (isset($_POST['submit'])) {

    
  $user_name = $_POST['username'];

  $password = $_POST['password'];


  $sql="SELECT * FROM `user` WHERE `username`='$user_name' AND `password`='$password'";

  $res=mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($res);
  if(mysqli_num_rows($res) > 0){
    if($password == $row['password']){
      $_SESSION["login"] = true;
      $_SESSION["id"] = $row["id"];
      header("Location: index.php");
    }
    else{
      echo
      "<script> alert('Wrong Password'); </script>";
    }
  }
  else{
    echo
    "<script> alert('User Not Registered'); </script>";
  }

}
?>

<?php include "header.php"?>



<h2>Login Form</h2>

<form action="" method="POST">

  <fieldset>

    <legend>Personal information:</legend>

    
    Usename name:<br>

<input type="text" name="username">

<br>

    Password:<br>
    <input type="password" name="password" value="" >

    <input type="submit" name="submit" value="submit">

  </fieldset>

</form>

<a href="registration.php">Registration</a>
<?php include "footer.php"?>