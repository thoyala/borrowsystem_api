<?php

require("header.php");
require("connect.php");

if($_SERVER["REQUEST_METHOD"]=="GET"){ // ดู ค้นหา
    $sql="SELECT * FROM tbequip";
    $result=$mysqli->query($sql);
    if($result->num_rows>0){
        while($row=$result->fetch_assoc())
            $data[]=$row;
    }
    exit(json_encode($data));
}

if($_SERVER["REQUEST_METHOD"]=="POST"){ // เพิ่ม 
    //อ่านค่าที่ส่งมา
    $data=json_decode(file_get_contents("php://input"));
    $name=$data->name;
    $detail=$data->detail;
    $qty=$data->qty; 
    $picture=$data->picture;
    //เขียน sql  เพื่อ insert ข้อมูล
    $sql="INSERT INTO tbequip (name,detail,qty,picture)
        VALUES('$name','$detail','$qty','$picture') ";
    $result=$mysqli->query($sql);
    if($result)
        exit(json_encode(["status"=>"insert success"]));
    else
        exit(json_encode(["status"=>"insert error"]));
}

?>