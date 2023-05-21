<?php
require('header.php');
require('connect.php');

//Query ดูข้อมูลด้วยคำสั่ง SELEC{T
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $username=$_GET["username"];
    $password=md5($_GET["password"]);
    $sql = "select * from tbuser where username='$username' and password = '$password'";
    $result = $mysqli->query($sql); //ประมวลผล
    if ($result->num_rows > 0){
        $data=$result->fetch_assoc();
        exit (json_encode($data + ["status"=>"user"]));
    }
    else{
        $sql = "select * from tbstaff where username='$username' and password = '$password'";
    $result = $mysqli->query($sql); //ประมวลผล
    if ($result->num_rows > 0){
        $data=$result->fetch_assoc();
        exit (json_encode($data + ["status"=>"staff"]));
    }
    else
        exit (json_encode(["status"=>"not found"]));
    
    }
    
    $result->free_result();
    $mysqli->close();
}

?>