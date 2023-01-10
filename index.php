<?php 
include "db.php";
include "header.php";
if(!empty($_SESSION["id"])){ 
    $id = $_SESSION["id"];
    $limit = 5;  // Number of entries to show in a page.
    // Look for a GET variable page if not found default is 1.     
    if (isset($_GET["page"])) { 
      $pn  = $_GET["page"]; 
    } 
    else { 
      $pn=1; 
    };   
    $start_from = ($pn-1) * $limit;  
    $result = mysqli_query($conn, "SELECT * FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
    if(isset($_GET['search']) && !empty($_GET['search'])) {   
      $filter = $_GET['search'];
      $sql = "SELECT * FROM pradeep WHERE user_id = ".$id ." AND CONCAT(firstname,lastname,email) LIKE '%$filter%' order by reg_date desc LIMIT $start_from, $limit";
    }
    else{
      $sql = "SELECT * FROM pradeep WHERE user_id = ".$id ." order by reg_date desc LIMIT $start_from, $limit";
    }
    $result = $conn->query($sql);
  }
  else{
    // header("Location: login.php");
  }
 
?>

  <div class="row">
  <form class="form-inline" method="get">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search" > 
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col:">Image</th>
        
    </tr>
  </thead>
  <tbody>
  
  <?php

// echo strtotime('2022-07-01');
if (!empty($result) && $result->num_rows > 0)
{
    while ($row = $result->fetch_assoc()) {
      ?>
    <tr>
      <th scope="row"><?php echo $row['id']; ?></th>
      <td><?php echo $row['firstname']; ?></td>
      <td><?php echo $row['lastname']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><img src="<?php echo $row['image']; ?>"> </td>
     
      <td><a href="add.php" class="btn btn-success">Add</a>
      <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
      <a href="delete.php?id=<?php echo $row['id']; ?>" type="button" class="btn btn-danger">Delete</a></td>
      
    </tr>
    
    <?php       
    }
 
}

?> 
  </tbody>
</table>

<ul class="pagination">
      <?php  
      if(!empty($_SESSION["id"])){ 
        $id = $_SESSION["id"];
        $sql = "SELECT COUNT(*) FROM pradeep WHERE user_id = $id";  
        $rs_result = mysqli_query($conn,$sql);  
        $row = mysqli_fetch_row($rs_result);  
        $total_records = $row[0];  
          
        // Number of pages required.
        $total_pages = ceil($total_records / $limit);  
        $pagLink = "";                        
        for ($i=1; $i<=$total_pages; $i++) {
          if ($i==$pn) {
              $pagLink .= "<li class='active'><a href='index.php?page="
                                                .$i."'>".$i."</a></li>";
          }            
          else  {
              $pagLink .= "<li><a href='index.php?page=".$i."'>
                                                ".$i."</a></li>";  
          }
        };  
        echo $pagLink;  
      }
      ?>
      </ul>
</div>

<?php include "footer.php"?>