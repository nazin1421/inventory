<?php
      session_start();
      $user=$_SESSION["user"];
      $userid=$_SESSION["userid"];
     include ('navigation.php');
      #include('auth/connection.php');
     $m='';
     $conn=connect();
     #$thisUser= mysqli_fetch_assoc($conn->query($sql));

     if(isset($_POST['submit'])){
        $pname= $_POST['pname'];
        $buy= $_POST['buy'];
        $img= $_FILES['pimage'];
        $iname=$img['name'];
        $tempname=$img['tmp_name'];
        $format=explode('.', $iname);
        $actualname= strtolower($format[0]);
        $actualformat= strtolower($format[1]);
        $allowedformats= ['jpg', 'png', 'jpeg', 'gif'];

        if(in_array($actualformat, $allowedformats)){
            $location= 'Upload/'.$actualname.'.'.$actualformat;
            $sql= "INSERT INTO products(name, bought, image, created_at) VALUES ('$pname', '$buy', '$location', current_timestamp())";
            if($conn->query($sql)===true){
                move_uploaded_file($tempname, $location);
                $m= "Product Inserted!";
            }
        }

    }
        



     
     

    
     //$date=date('Y-m-d', strtotime('-7 days'));
     $sql="SELECT * FROM products ";
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
    
     <title>Product</title>
     <link rel="stylesheet" href="css/product.css" text="text/css">
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
                            Add New Product</span>
                        </button>
                    <h2 ><?php echo $m;?></h2>
                    <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="example">
                        <div class="modal-dialog modal-dialog-scorllable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button style="background-color: #ffce00;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h2 class="modal-title" id="exampleModalScrollableTitle">Add New Product</h2>
                                </div>
                                <div class="modal-body">
                                  <form action="products.php" method="POST"  enctype="multipart/form-data">
                                    <div class="form-group pt-20">
                                        <div class="col-sm-4">
                                            <label for="name" class="pr-10">Product Name</label>

                                        </div>
                                        <div class="col-sm-8">
                                                    <input name="pname" type="text" class="login-input" placeholder="Product Name" id="name" required>
                                                </div>

                                                
                                        </div>
                                        <div class="form-group pt-20">
                                                <div class="col-sm-4">
                                                    <label for="buy" class="pr-10"> Buying Amount</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input name="buy" type="text" class="login-input" placeholder="Buying Amount" id="buy" required>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="pimage" class="pr-10"> Product Image</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input name="pimage" class="pl-20" type="file" id="pimage" required>
                                                </div>

                                    </div>
                                    <div class="form-group pt-20">
                                             
                                            </div>
                                            <div class="form-group" style="text-align: center;">
                                                <button type="submit" value="submit" name="submit" class="btn btn-success">Add</button>
                                            </div>
                                        </form>
                                </div>
                            </div>

                        </div>

                    </div>
                    </div>

                    <div class="table_container">
                        <h1 style="text-align: center;">Products Table</h1>
                        <div class="table-responsive">
                            <table class="table table-dark" id="table" data-toggle="table" data-search="true" data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead class="thead-light">
                                <tr>
                                    <th data-field="name" data-filter-control="select" data-sortable="true">Product Name</th>
                                    <th data-field="bought" data-filter-control="select" data-sortable="true"> Bought</th>
                                    <th data-field="sold" data-sortable="true">Sold</th>
                                    <th data-field="stock" data-sortable="true">Available in Stock</th>
                                    <th data-field="actions" data-sortable="true"> Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(mysqli_num_rows($res)>0){
                                            while($row= mysqli_fetch_assoc($res)){
                                                $stock= $row['bought']-$row['sold'];
                                                echo "<tr>";
                                                echo "<td>".$row['name']."</td>";

                                                echo "<td>".$row['bought']."</td>";

                                                echo "<td>".$row['sold']."</td>";

                                                echo "<td>".$stock."</td>";

                                                echo "<td><a href='viewproduct.php?id=".$row['id']."' class='btn btn-success btn-sm'>".
                                                "<span class='glyphicon glyphicon-eye-open'></span> </a>";

                                            echo "<a href='editproduct.php?id=".$row['id']."' class='btn btn-warning btn-sm'>".
                                            "<span class='glyphicon glyphicon-pencil'></span> </a>";



                                        if($thisUser['is_admin']==1)
                                        {
                                            echo "<a href='deleteproduct.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>" .
                                            "<span class='glyphicon glyphicon-trash'></span> </a></td>";
                                        }
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
                <div class="fakeimg" style="...">Image

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
 
 
 
 
 
