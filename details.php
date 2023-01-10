<?php 
include "db.php";
include "header.php"
?><?php




if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    
    $result = mysqli_query($conn, "SELECT pradeep.*, pradeepdetail.*
    FROM pradeep  
    LEFT JOIN pradeepdetail ON pradeep.id = pradeepdetail.pradeep_id WHERE pradeep.user_id = $id
    ORDER BY pradeepdetail.id;");
    $row = mysqli_fetch_assoc($result);
  }
  else{
    header("Location: login.php");
  }
  ?><?php
    if (isset($_POST['submit'])) {
  
      $city = $_POST['city'];
  
      $state = $_POST['state'];
  
      $pincode = $_POST['pincode'];
      
      $address = $_POST['address'];

     $sql = "INSERT INTO `pradeepdetail` (`city`, `state`, `pincode`, `address`) VALUES ('$city','$state','$pincode','$address')";
  
  
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
  

  <div class="row">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col:">Image</th>
      <th scope="col:">city</th>
      <th scope="col:">state</th>
      <th scope="col:">pincode</th>
      <th scope="col:">address</th>
     
    </tr>
  </thead>
  <tbody>
  <?php
// echo strtotime('2022-07-01');
if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

?>
    <tr>
      <th scope="row"><?php echo $row['id']; ?></th>
      <td><?php echo $row['firstname']; ?></td>
      <td><?php echo $row['lastname']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><img src="<?php echo $row['image']; ?>"> </td>
      <td><?php echo $row['city']; ?></td>
      <td><?php echo $row['state']; ?></td>
      <td><?php echo $row['pincode']; ?></td>
      <td><?php echo $row['address']; ?></td>
      
     
      <td><a href="add.php" class="btn btn-success">Add</a>
      <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
      <a href="delete.php?id=<?php echo $row['id']; ?>" type="button" class="btn btn-danger">Delete</a></td>
      
    </tr>
    
    <?php       }

}

?> 
  </tbody>
</table>
</div>




  <h2>Add Table</h2>
  
  <form action="" method="POST">
  
    <fieldset>
  
      <legend>Personal information:</legend>
  
      city name:<br>
  
      <input type="text" name="city">
  
      <br>
  
      state name:<br>
  
      <input type="text" name="state">
  
      <br>
  
      pin code:<br>
  
      <input type="text" name="pincode">
  
      <br>
  
      address<br>
      <input type="text" name="address">
      <br><br>
      <input type="submit" name="submit" value="submit">
  
    </fieldset>
  
  </form>
  



<?php include "footer.php"?>