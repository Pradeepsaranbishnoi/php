<?php 
include "db.php";
include "header.php";

if(!empty($_SESSION["id"])){
  $id = $_SESSION["id"];
  $result = mysqli_query($conn, "SELECT * FROM user WHERE id = $id");
  $row = mysqli_fetch_assoc($result);
}
else{
  header("Location: login.php");
}

  if (isset($_POST['submit'])) {

    $first_name = $_POST['firstname'];

    $last_name = $_POST['lastname'];

    $email = $_POST['email'];
    
    $imageuplaod = $_FILES['choosefile'];

    $filename = $_FILES["choosefile"]["name"];

    $tempname = $_FILES["choosefile"]["tmp_name"];  

    $folder = "image/".$filename;   

    if (move_uploaded_file($tempname, $folder)) {
        $sql = "INSERT INTO `Pradeep`(`firstname`, `lastname`, `email`, `image`, `user_id`) VALUES ('$first_name','$last_name','$email', '$folder','$id')";
        
    }
    else{
        $sql = "INSERT INTO `Pradeep`(`firstname`, `lastname`, `email`, `user_id`) VALUES ('$first_name','$last_name','$email','$id')";
}

    $result = $conn->query($sql);

    if ($result == TRUE) {

      echo "New record created successfully.";
      header("Location: index.php");
    }else{

      echo "Error:". $sql . "<br>". $conn->error;

    } 

    $conn->close(); 

  }

?>

<h2>Add Table</h2>

<form action="" method="POST" enctype="multipart/form-data">

  <fieldset>

    <legend>Personal information:</legend>

    First name:<br>

    <input type="text" name="firstname">

    <br>

    Last name:<br>

    <input type="text" name="lastname">

    <br>

    Email:<br>

    <input type="email" name="email">

    <br>

    Image Upload:<br>
    <input type="file" name="choosefile" value="" />
    <br><br>
    <input type="submit" name="submit" value="submit">

  </fieldset>

</form>

<?php include "footer.php";?>