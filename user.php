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
    


        
            if(isset($_POST['submit'])){

                $sql="UPDATE user_info SET ";
                if($thisUser['password']==$_POST['pass']){
                    $sql="UPDATE user_info SET ";
        
                    if(isset($_POST['uemail'])){
                        $uemail=$_POST['uemail'];
                        if($uemail!=$thisUser['email']){
                            $sql.="email='$uemail',";
                        }
                    }
                    if(isset($_POST['uname'])){
                        $uemail=$_POST['uname'];
                        if($uemail!=$thisUser['name']){
                            $sql.="name='$uemail',";
                        }
                    }
                    if(isset($_FILES['uavtr']))
                    {
                        $tmpname=$_FILES['uavtr'] ['tmp_name'];
                        $uavtr=$_FILES['uavtr']['name'];
                        $size=$_FILES['uavtr']['size'];
                        if($size<3000000)
                        {
                           
                            $format= explode('.' , $uavtr);
                            // echo (count($format));
                            if(count($format)==1){
                                $actualname= strtolower($format[0]);


                            }
                            else{

                                $actualname= strtolower($format[0]);
                                $actualformat= strtolower($format[1]);
                                $location= 'Upload/'.$actualname.'.'.$actualformat;
                           
                                $sql.="avatar='$location',";
                                move_uploaded_file($tmpname, $location);
                            }
                           
                              
                           
                            // $allowedformats= ['jpg', 'png', 'jpeg', 'gif'];
                       
                        }
                        else{
                            $m= 'Image size should be less than 3MB';
                        }

                    }

            $sql= substr($sql, 0,-1);
            $sql.="WHERE id='$id'";
            $conn->query($sql); 
            // echo($sql);
            $m='User Information is successfully Updated!';   
                }
                else{
                    $m='Credential mismatch!';
                }  
            }
     
    


     
     

    
     //$date=date('Y-m-d', strtotime('-7 days'));
     $sql="SELECT * FROM user_info ";
     $res=$conn->query($sql);


     $sql="SELECT COUNT(*) as product FROM products";
     $total_products= mysqli_fetch_assoc ($conn->query($sql));


     $sql="SELECT SUM(bought) as total_buy FROM products";
     $total_buy=mysqli_fetch_assoc($conn->query($sql));
     // echo $total_products['product'];


     $sql="SELECT SUM(sold) as total_sell FROM products";
     $total_sell=mysqli_fetch_assoc( $conn->query($sql));

    
?> 
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
     <title>User Page</title>
     <link rel="stylesheet" href="css/user.css">
 </head>
 <body>
 <div class="row" style="..." >
        <div class="leftcolumn">
            <div class="row">
                <section style="...">
                        <div class="col-sm-3 sex d-flex">
                            <div class="card card-green">
                                <h3>Total Products</h3>
                                <h2 style="..."><?php  echo $total_products['product'];    ?></h2>

                            </div>
                        </div>
                         <div class="col-sm-3">
                            <div class="card card-green">
                                <h3>Total Bought</h3>
                                <h2 style="..."><?php echo $total_buy['total_buy']; 'You haven\'t bought anything yet'; ?></h2>

                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card card-red">
                                <h3>Product sold</h3>
                                <h2 style="..."><?php echo $total_sell['total_sell'];'You haven\'t bought anything yet'; ?></h2>

                            </div>
                        </div>
                        <div class="col-sm-3" >
                            <div class="card card-blue" >
                                <h3>Available Stock </h3>
                                <h2 style="color: #282828; text-align: center;"><?php echo $total_buy?$total_buy['total_buy']-$total_sell['total_sell']: 'You haven\'t invested anything yet'; ?></h2>
                            </div>
                            </div>
                       
                        
                </section>

            </div>
            <div class="card">
                    <div class="text-center">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProduct">
                            Update Your Info</span>
                        </button>
                    <h2 ><?php echo $m;?></h2>
                    <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="example">
                        <div class="modal-dialog modal-dialog-scorllable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button style="background-color: #ffce00;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h2 class="modal-title" id="exampleModalScrollableTitle"><?php echo $thisUser['name'];?></h2>
                                </div>
                                <div class="modal-body">
                                  <form action="user.php" method="POST"  enctype="multipart/form-data">
                                    <div class="form-group pt-20">
                                        <div class="col-sm-4">
                                            <label for="uname" class="pr-10">User Name</label>

                                        </div>
                                        <div class="col-sm-8">
                                                    <input name="uname" type="text" class="login-input" placeholder="User Name" id="uname" value="<?php echo $thisUser['name'];?>" required>
                                                </div>
                                    </div>
                                <div class="form-group pt-20">
                                        <div class="col-sm-4">
                                            <label for="uemail" class="pr-10"> User Email</label>

                                        </div>
                                       
                                        <div class="col-sm-8">
                                                    <input name="uemail" type="email" class="login-input" placeholder="Email" id="uemail" value="<?php echo $thisUser['email'];?>" required>
                                                </div>
                                                
                                    </div>
                                        <div class="form-group pt-20">
                                                <div class="col-sm-4">
                                                    <label for="uavtr" class="pr-10"> User Avatar</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="pl-20">
                                                    <input name="uavtr" type="file" class="login-input" placeholder="User Avatar" id="uavtr" alt="Upload Image">
                                                </div>
                                            </div>
                                        </div>  
                                        
                                        <div class="form-group pl-20">
                                                <div class="col-sm-4">
                                                    <label for="pass" class="pr-10"> Password</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input name="pass" class="pl-20" type="password" id="pass" required>
                                                </div>
                                        </div>

                                        
                                               
                                  
                                            <div class="form-group" style="text-align: center;">
                                                <button type="submit" value="submit" name="submit" class="btn btn-success">Change</button>
                                            </div>
                                        </form>
                                </div>
                            </div>

                        </div>

                    </div>
                    </div>

                    <div class="table_container">
                        <h1 style="text-align: center;">Users Table</h1>
                        <div class="table-responsive">
                            <table class="table table-dark" id="table" data-toggle="table" data-search="true" data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead class="thead-light">
                                <tr>
                                    <th data-field="date" data-filter-control="select" data-sortable="true">User </th>
                                    <th data-field="examen" data-filter-control="select" data-sortable="true"> Email</th>

                                    <?php
                                       if($thisUser['is_admin']==1){
                                           echo ' <th data-field="note" data-sortable="true">Is Active</th>';
                                       } 
                                    
                                    
                                    ?>
                                   
                                    <th data-field="note" data-sortable="true">Last Login Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(mysqli_num_rows($res)>0){
                                            while($row= mysqli_fetch_assoc($res)){

                                           


                                                echo '<tr>';
                                                
                                                echo '<td>' .$row['name'].'</td>';
                                                echo '<td>' .$row['email'].'</td>';
                                                if($thisUser['is_admin']==1)
                                                {
                                                    if($row['is_active']=='1'){
                                                        $active="Active";
                                                    }
                                                    else{
                                                        $active="Inactive";
                                                    }
                                                echo '<td>' .$active.'</td>';
                                                }
                                                echo '<td>' .date("y-m-d h:i:sa", strtotime($row['last_login_time'])).'</td>';
                                                echo '</tr>';
                                                
                                            }
                                        }
                                    
                                       else{
                                           echo "No result found";
                                       }

                                        
                                     

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>    

                        
        <div class="rightcolumn">
            <div class="card">
                <h2>About Us</h2>
                <div class="height:100px;"> <img src="<?php echo $thisUser['avatar'] ?>" height="100px;" width="100px;" class="img-circle" alt="Upload Image"> <p><h4><?php    ?></h4>is working here since <h4>
                    <?php      ?></h4></p>

                </div>
                <p>Some text about this inventory software.</p>
            </div>
                <div class="card">
                    <h2>Owners Info</h2>
                    <p>Some Text..</p>
                </div>
        </div>
    </div>  

            <?php  include('footer.php');?>

</body>
</html>
 
 
 
 
 
