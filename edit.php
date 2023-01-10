<?php 

include "db.php";

    if (isset($_POST['update'])) {

        $firstname = $_POST['firstname'];

        $user_id = $_POST['user_id'];

        $lastname = $_POST['lastname'];

        $email = $_POST['email'];

        $imageuplaod = $_FILES['choosefile'];

        $filename = $_FILES["choosefile"]["name"];
    
        $tempname = $_FILES["choosefile"]["tmp_name"];  
    
        $folder = "image/".$filename; 
        if (move_uploaded_file($tempname, $folder)) {
            $sql = "UPDATE `Pradeep` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email', `image`='$folder' WHERE `id`='$user_id'"; 
            
             $sql2 = "SELECT * FROM `Pradeep` WHERE `id`='$user_id'";

            $result = $conn->query($sql2); 

            if ($result->num_rows > 0) {        
                $row = $result->fetch_array();
            
              if(!empty($row['image'])){
                unlink($row['image']);
               
              }
             
                } 
    
        }
        else{
            $sql = "UPDATE `Pradeep` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email' WHERE `id`='$user_id'"; 
           
        }
        
        $result = $conn->query($sql); 

        if ($result == TRUE) {

            echo "Record updated successfully.";
            header("Location: index.php");
        }else{

            echo "Error:" . $sql . "<br>" . $conn->error;

        } 
    
 
    } 
   
    

if (isset($_GET['id'])) {

    $user_id = $_GET['id']; 

    $sql = "SELECT * FROM `Pradeep` WHERE `id`='$user_id'";

    $result = $conn->query($sql); 

    if ($result->num_rows > 0) {        

        while ($row = $result->fetch_assoc()) {

            $first_name = $row['firstname'];

            $lastname = $row['lastname'];

            $email = $row['email'];

            $uid = $row['id'];  

        } 

        include "header.php"
    ?>

        <h2>User Update Form</h2>

        <form action="" method="post" enctype="multipart/form-data">

          <fieldset>

            <legend>Personal information:</legend>

            First name:<br>

            <input type="text" name="firstname" value="<?php echo $first_name; ?>">

            <input type="hidden" name="user_id" value="<?php echo $uid; ?>">

            <br>

            Last name:<br>

            <input type="text" name="lastname" value="<?php echo $lastname; ?>">

            <br>

            Email:<br>

            <input type="email" name="email" value="<?php echo $email; ?>">

            <br>
            Image Upload:
    <input type="file" name="choosefile" value="" />
           

            <input type="submit" value="Update" name="update">

          </fieldset>

        </form> 

        </body>

        </html> 

    <?php

    } else{ 

        header('Location: index.php');

    } 

}

?> 
<?php include "footer.php"?>