<?php
  include('auth/connection.php');
  $user=$_SESSION["user"];
  $userid=$_SESSION["userid"];
  $conn=connect();
  $sql="SELECT * FROM user_info WHERE id='$userid'";

  $thisUser= mysqli_fetch_assoc($conn->query($sql));
 



  $sql= "UPDATE users_info SET last_login_time=current_timestamp() WHERE id=' $userid'";
  $conn->query($sql);
  $conn->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navigation.css">
    
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="dashbord.php">My Inventory</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="user.php">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="products.php">Products</a>
        </li>
        <?php 
          if($thisUser['is_admin']==1)
          {
            echo '<li >
            <a href="customer.php">Coustomers</a>
          </li>';
          }
        
        ?>
        
        <li style="float-right;">
          <a href="logout.php" style="padding-top:15px;">LogOut </a></li>
        <li class="nav-item">
          <a class="nav-link" href="#">Logged In As <b class="user"><?php echo $user;?></b>  </a>
        </li>

        
       
    </div>
  </div>
</nav>
       
</body>
</html>