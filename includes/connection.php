<?php
$username = "root";
$host = "localhost";
$password = "";
$db = "youtube";

$con = new mysqli($host,$username,$password,$db);

if($con){
    echo "Connected to db!!!";
}else{
    exit('Failed to connect msg!!!');
}


?>