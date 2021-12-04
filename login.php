<?php
   
     include'auth/connection.php';
     $conn=connect();
     session_start();
     $_SESSION['user']='';
     $_SESSION['userid']='';
     
     $m="";
     if(isset($_POST['submit']))
     {
       
         $uName= $_POST['uname'];
          $pass= $_POST['pass'];
        //   echo $uName;
        //   echo $pass;

        
         
            $sql="SELECT * FROM user_info WHERE u_name='$uName' and password='$pass'";
             $res=$conn->query($sql);
            if((int)mysqli_num_rows($res)>0)
            {
                
                $user=mysqli_fetch_assoc($res);
                $id= $user['id'];
                $sq= "UPDATE users_info SET last_login_time=current_timestamp() WHERE id='$id'";
                $conn->query($sql);
                $_SESSION['user']=$user['name'];
                $_SESSION['userid']=$user['id']; 
                 header('Location:dashbord.php');
                // echo $_SESSION['userid'];
             }     
        else{
            $m='Credentials mismatch!';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="logo"> 



    </div>
    <form action="login.php" method="POST" enctype="multipart/form-data">
        <div class="box bg-img">
            <div class="content">
                <h2>Log <span>In</span></h2>
                <div class="forms">
                <p style="color:red; padding=20px"> 
                <?php if($m!='') echo $m; ?>
                </p>    
                    <div class="User-input">
                        <input type="text" name="uname" class="login-input" placeholder="username" id="name">
                        <i class="fas fa-user"></i>

                    </div>
                    <div class="pass-input">
                        <input type="password" name="pass" class="login-input" placeholder="Password" id="my-pass">
                        <span class="eye" onclick="myFucntion()">
                        <i id="hide-1" class="fas fa-eye-slash"></i>
                        <i id="hide-2" class="fas fa-eye"></i>


                        </span>

                    </div>

                </div>
                <button class="login-btn" name="submit" type="submit" >Sign IN</button>
                <p class="new-account" >Not a user? <a href="resgister.php">Sign up now!</a></p>
                <br>
                <p class="f-pass"><a href="#">Forgot password?</a></p>
            </div>

        </div>


    </form>
    
</body>
</html>