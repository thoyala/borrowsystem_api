<?php
require('header.php');
require('connect.php');

if($_SERVER["REQUEST_METHOD"]=="GET"){ // ดู ค้นหา

}
if($_SERVER["REQUEST_METHOD"]=="POST"){ // เพิ่ม 
    //อ่านค่าที่ส่งมา
    $data=json_decode(file_get_contents("php://input"));
    $name=$data->name;
    $address=$data->address;
    $telephone=$data->telephone; 
    $username=$data->username;
    $password=$data->password;
    //เขียน sql  เพื่อ insert ข้อมูล
    $sql="INSERT INTO tbuser (name,address,telephone,username,password)
        VALUES('$name','$address','$telephone','$username','$password') ";
    $result=$mysqli->query($sql);
    if($result)
        exit(json_encode(["status"=>"insert success"]));
    else
        exit(json_encode(["status"=>"insert error"]));
}
if($_SERVER["REQUEST_METHOD"]=="PUT"){ // แก้ไข 

}
if($_SERVER["REQUEST_METHOD"]=="DELETE"){ // ลบ 

}


?>