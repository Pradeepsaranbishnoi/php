<?php 

include "db.php"; 

if (isset($_GET['id'])) {

    $user_id = $_GET['id'];

    $sql2 = "SELECT * FROM `Pradeep` WHERE `id`='$user_id'";

     $result = $conn->query($sql2); 
     
    if ($result->num_rows > 0) {        
         $row = $result->fetch_array();
     
       if(!empty($row['image'])){
         unlink($row['image']);
        
       }
    }
    
    $sql = "DELETE FROM `Pradeep` WHERE `id`='$user_id'";

     $result = $conn->query($sql);

     
    if ($result == TRUE) {

        echo "Record deleted successfully.";
        header("Location: index.php");

    }else{

        echo "Error:" . $sql . "<br>" . $conn->error;

    }

} 

?>

