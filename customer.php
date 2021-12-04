<?php 

    session_start();
    $user=$_SESSION["user"];
      $userid=$_SESSION["userid"];
     include ('navigation.php');
    
     $m='';
     $conn=connect();

     $id= $_SESSION['userid'];
     $sql="SELECT * FROM user_info WHERE id='$id'";

     $thisUser= mysqli_fetch_assoc($conn->query($sql));
   





?>