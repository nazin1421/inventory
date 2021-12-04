<?php
     session_start();
     $user=$_SESSION["user"];
     $userid=$_SESSION["userid"];
    include ('navigation.php');
     #include('auth/connection.php');
    $conn=connect();
    $date=date('Y-m-d', strtotime('-7 days'));
    $sql="SELECT * FROM products WHERE updated_at>$date";
    $prod=$conn->query($sql);
    $sql="SELECT COUNT(*) as product FROM products";
    $total_products= mysqli_fetch_assoc ($conn->query($sql));
    $sql="SELECT SUM(bought) as total_bought FROM products";
    $total_bought=mysqli_fetch_assoc($conn->query($sql));
    // echo $total_products['product'];
    $sql="SELECT SUM(sold) as total_sold FROM products";
    $total_sold=mysqli_fetch_assoc( $conn->query($sql));
    $stock_avaiable=$total_bought['total_bought']-$total_sold['total_sold'];
?> 
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
     <title>Dashbord</title>
     <link rel="stylesheet" href="css/dashbord.css" text="text/css">
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
                         
                            <div class="card card-green">
                                <h3>Total Bought</h3>
                                <h2 style="..."><?php echo $total_bought['total_bought'];    ?></h2>

                            </div>
                            <div class="card card-green">
                                <h3>Product sold</h3>
                                <h2 style="..."><?php echo $total_sold['total_sold'];    ?></h2>

                            </div>
                            <div class="card card-green">
                                <h3>Avaiable stock</h3>
                                <h2 style="..."><?php echo $stock_avaiable?></h2>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            

                        </div>
                        <div class="col-sm-3">
                            
                        </div>
                </section>

            </div>
            <div class="card">
                <div class="table_container">
                    <h1 style="...">Product Table</h1>
                    <div class="table_responsive">
                        <table class="table table-dark" id="table" data-toggle="table" data-search="true" data-filter-control="true" data-click-to-select="true" data-toolbar="#toolbar">
                        <thead class="thead-light">
                            <tr>
                                <th data-field="data" data-filter-control="select" data-sortable="true" >Product Name</th>
                                <th data-field="examen" data-filter-control="select" data-sortable="true" >Bought</th>
                                <th data-field="note" data-sortable="true"> Sold</th>
                                <th data-field="note" data-sortable="true">Avaiable In Stock </td>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                                if(mysqli_num_rows($prod)>0){
                                    while($row=mysqli_fetch_assoc($prod)){
                                        $stock=$row['bought']- $row['sold'];
                                        echo "<tr>";
                                        echo "<td>" .$row['name'] . "</td>";
                                        echo "<td>" .$row['bought'] ."</td>";
                                        echo "<td>" .$row['sold'] ."</td>";
                                        echo "<td>" .$stock."</td>";

                                    }
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
 
 
 
 
 
 Welcome to the system!