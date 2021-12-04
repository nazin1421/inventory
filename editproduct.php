<?php

session_start();
include ('navigation.php');
#include ('auth/connection.php');

$conn= connect();
$m=' ';
$id= $_SESSION['userid'];
$sql= "SELECT * FROM users_info WHERE id='$id'";
 #$thisUser= mysqli_fetch_assoc($conn->query($sql));

if(isset($_GET['id'])){
    $id= $_GET['id'];
    
    $sql= "SELECT * from products WHERE id=$id limit 1";
    $res= mysqli_fetch_assoc($conn->query($sql));
    $img= $res['image'];
}
elseif(isset($_POST['id'])){
    $id= $_POST['id'];
    $pname= $_POST['pname'];
    $buy=intval( $_POST['buy']);
    $sell=intval($_POST['sell']);
    if($buy>=$sell){
            if(isset($_POST['submit'])){
                $sql= "UPDATE products SET name= '$pName', bought= '$buy', sold= '$sell' WHERE id = '$id'";
                if($conn->query($sql)===true){
                    header('Location: products.php');
                } else{
                    $m= "Connection Failure!";
                    header("Location: editproduct.php?id=$id");
                }
            }
        } else{
            $m= "Buy quantity should be larger than Sell quantity!";
            header("Location: editProduct.php?id=$id");
        }
    }
   

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
    
    <title>Edit Page</title>
    <link rel="stylesheet" href="css/product.css" type="text/css">
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
                        <div class="card card-yellow" >
                            <h3>Products Bought </h3>
                            <h2 style="color: #282828; text-align: center;"><?php echo $total_buy?$total_buy['total_buy']: 'You haven\'t bought anything yet'; ?></h2>
                        </div>
                    </div>
                    <div class="col-sm-3 " >
                        <div class="card card-blue" >
                            <h3>Products Sold </h3>
                            <h2 style="color: #282828; text-align: center;"><?php echo $total_sell?$total_sell['total_sell']: 'You haven\'t sold anything yet'; ?></h2>
                        </div>
                    </div>
                    <div class="col-sm-3" >
                        <div class="card card-red" >
                            <h3>Available Stock </h3>
                           <h2 style="color: #282828; text-align: center;"><?php echo $total_sell?$total_sell['total_sell']: 'You haven\'t sold anything yet'; ?></h2>
                        </div>
                    </div>
                </section>
                </div>
            <div class="pt-20 pl-20">
                <div class="col-sm-12" style="background-color: #282828; ">
                    <div class="text-center">
                        <h2 > Product Details</h2>
                    </div>
                    <div class="row pt-20" >
                        <div class="col-sm-5 p-20" >
                            <img src="<?php echo $img; ?>" class="pull-right" height="300" width="300" style="border-radius: 10px;">
                        </div>

                        <div class="col-sm-7" >
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-right"><h2> Name:</h2></label>
                                </div>
                                <div class="col-sm-6">
                                    <h2 style="color: whitesmoke;"><?php echo ucwords($res['name']) ?></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-right"><h2> Buy Quantity:</h2></label>
                                </div>
                                <div class="col-sm-6">
                                    <h2 style="color: whitesmoke;"><?php echo $res['bought'] ?></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-right"><h2> Sell Quantity:</h2></label>
                                </div>
                                <div class="col-sm-6">
                                    <h2 style="color: whitesmoke;"><?php echo $res['sold'] ?></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-right"><h2> Created at:</h2></label>
                                </div>
                                <div class="col-sm-6">
                                    <h2 style="color: whitesmoke;"><?php echo date('F j, Y', strtotime(str_replace('-','/',$res['created_at']))) ?></h2>
                                </div>
                            </div>

                            <form method="POST" action="deleteproduct.php">
                            <input type="hidden" value="<?php echo $res['id']; ?>" name="id">
                            <div class="row">
                                <div class="text-center">
                                    <input class="btn btn-danger" type="submit" name="submit" value="Delete">
                                </div>
                            </div>
                        </form>
                        </div>
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

    <?php include('footer.php');?>
</body>
</html>