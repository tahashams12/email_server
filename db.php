<?php
$conn = null;
    $servername = "localhost";
    $username= "root";
    $password = "";
    $dbname = "email_server";
$conn = mysqli_connect($servername,$username,$password,$dbname);

if(!$conn){
    echo "Connection failed";
}
else{
    echo "Connected successfully";
}


?>