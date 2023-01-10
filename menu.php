<?php

if(!empty($_SESSION["id"])){ 
  $id = $_SESSION["id"];
  $result = mysqli_query($conn, "SELECT * FROM user WHERE id = $id");
  $row = mysqli_fetch_assoc($result);
}
  ?>
<header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="col-12 col-md-10">
      <ul class="navbar-nav ">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="details.php">Details</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
</div>
<div class="col-6 col-md-2">
<ul class="navbar-nav">
      <li class="nav-item dropdown my-2 my-lg-0">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?php echo isset($row['firstname'])?$row['firstname']:'Guest'; ?>
          </a>
          <ul class="dropdown-menu ">
          <li><a class="dropdown-item" href="add.php" <?php echo isset($_SESSION['id']) ? '' : 'style="display:none;"' ?>>Add</a></li>
            <li><a class="dropdown-item" href="login.php" <?php echo isset($_SESSION['id']) ? 'style="display:none;"' : '' ?>>Login</a></li>
            <li><a class="dropdown-item" href="registration.php" <?php echo isset($_SESSION['id']) ? 'style="display:none;"' : '' ?>>Register</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php" <?php echo isset($_SESSION['id']) ? '' : 'style="display:none;"' ?>>Logout</a></li>
          </ul>
        </li>
</ul>
</div>
    </div>
  </div>
</nav>
</header>