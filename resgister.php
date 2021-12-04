<?php
    include'auth/connection.php';
    $con=connect();


    $m="";
    if(isset($_POST['Submit']))
    {
        // echo "file submitted";
        $name= $_POST['name'];
         $uName= $_POST['uname'];
        $email= $_POST['email'] ;
        $Pass= $_POST['pass'];
        $rPass= $_POST['rPass'];

        if($Pass===$rPass){
           $sql="INSERT INTO user_info(name,u_name,email,password) VALUES ('$name','$uName','$email','$Pass')";
            if($con->query($sql)){
                header('Location:login.php');
            //    echo"hello";
            }
            else{
                $m='Connection not established';
            }
        }
        else{
            $m='Password dont match!';
        }
    }
        
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
    <title>Registration Form</title>
    
    
   
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/register.css">

</head>
<body>
   
    <div class="container">
    <form action="resgister.php" method="POST" enctype="multipart/form-data">
        <h1>
            Registration Form
        </h1>
        <hr>
        <div>
       <span> <?php if($m!='') echo $m; ?></span>
            <label > Your name is <span>*</span> </label>
            <input type="text" name="name" id="name" placeholder="Enter your name" required>
        </div>
        <div>
            <label > Your uname is <span>*</span> </label>
            <input type="text" name="uname" id="uname" placeholder="Enter your uname" required>
        </div>
        <div>
            <label > Your mail is </label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>
        </div>
        <div>
            <label > Your pass is <span>*</span></label>
            <input type="password" name="pass" id="pass" placeholder="Enter your password" required>
        </div>
        <div>
            <label > Repeat Password <span>*</span></label>
            <input type="password" name="rPass" id="r_pass" placeholder="Confirm  your  password" required>
        </div>
        <div style="text-align:center">
        <p><span>***</span>By Creating an account you are agreed to our team and privacy</p></div>
        <div style="text-align:center">
            <input type="submit" class="btn btn-success" name="Submit" value="Submit" >
        </div >
        <div style="text-align:center"> <p><span>***</span>Already an account?
                <a href="login.php">Sign in</a></p>
        </div>
</div>
    </form>
</body>
</html>