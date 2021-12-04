<?php


function connect(){
    $dHost="localhost";
    $user="root";
    $pass="root";
    $dbname="inventory";
    $conn=new mysqli($dHost,$user,$pass,$dbname);

    return $conn;
}
    function closeConnect($con){
        $con->close();
    }



?>
