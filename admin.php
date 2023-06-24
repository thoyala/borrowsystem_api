<?php
require('header.php');
require('connect.php');

if($_SERVER["REQUEST_METHOD"]=="GET"){ // ดู ค้นหา
    $sql = "SELECT * FROM tbstaff";
    $result = $mysqli -> query($sql);
    if($result -> num_rows>0){
        while($row=$result->fetch_assoc())
            $data[]=$row;
    }
    exit(json_encode($data));
}

if($_SERVER["REQUEST_METHOD"]=="POST"){ // เพิ่ม
    // อ่านค่าที่ส่งมา
    $data=json_decode(file_get_contents("php://input"));
    $name=$data->name;
    $username=$data->username;
    $password=md5($data->password);
    $picture=$data->picture;
    // เขียน sql เพื่อ insert ข้อมูล
    $sql="INSERT INTO tbstaff (name,username,password,picture) VALUE('$name','$username','$password','$picture'";
    $result=$mysqli->query($sql);
    if($result)
        exit(json_encode(["status"=>"insert success"]));
    else
        exit(json_encode(["status"=>"insert error"]));
}

if($_SERVER["REQUEST_METHOD"]=="PUT"){
    $data=json_decode(file_get_contents("php://input"));
    $userid=$data->userid;
    $name=$data->name;
    $username=$data->username;
    $password=$data->password;
    $newpassword=$data->newpassword;
    $picture=$data->picture;
    $newpicture=$data->newpicture;
    if($newpassword!='')
        $password=md5($newpassword);
    if($newpicture!='')
        $picture=$newpicture;
    $sql="UPDATE tbstaff SET name='$name',password='$password',picture='$picture' WHERE userid='$userid'";
        $result=$mysqli->query($sql);
    if($result)
        exit(json_encode(["status"=>"update success"]));
    else
        exit(json_encode(["status"=>"update; error"])); 
}

if($_SERVER["REQUEST_METHOD"]=="DELETE"){ // ลบ

}

?>