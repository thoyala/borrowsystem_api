<?php
require('header.php');
require('connect.php');

if($_SERVER["REQUEST_METHOD"]=="GET"){ // ดู ค้นหา
    $sql="SELECT * FROM tbuser";
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
    $address=$data->address;
    $telephone=$data->telephone; 
    $username=$data->username;
    $password=md5($data->password);
    $picture=$data->picture;
    //เขียน sql  เพื่อ insert ข้อมูล
    $sql="INSERT INTO tbuser (name,address,telephone,username,password,picture)
        VALUES('$name','$address','$telephone','$username','$password','$picture') ";
    $result=$mysqli->query($sql);
    if($result)
        exit(json_encode(["status"=>"insert success"]));
    else
        exit(json_encode(["status"=>"insert error"]));
}
if($_SERVER["REQUEST_METHOD"]=="PUT"){ // แก้ไข 
    $data=json_decode(file_get_contents("php://input"));
    $userid=$data->userid;
    $name=$data->name;
    $address=$data->address;
    $telephone=$data->telephone; 
    $username=$data->username;
    $password=($data->password);
    $newpassword=($data->newpassword);
    $picture=$data->picture;
    $newpicture = $data->newpicture;
    // exit(json_encode($name . ' ' . $address . ' ' . $telephone . ' ' .
    // $username . ' ' . $password . ' ' . $newpassword));
    if ($newpassword!='')
        $password=md5($newpassword);
    if($newpicture!='')
        $picture=$newpicture;
    $sql="UPDATE tbuser SET name='$name', address ='$address', 
        telephone='$telephone', password='$password',
        picture='$picture' WHERE userid='$userid'";
        $result=$mysqli->query($sql);
    if($result)
        exit(json_encode(["status"=>"update success"]));
    else
        exit(json_encode(["status"=>"update error"]));
}
if($_SERVER["REQUEST_METHOD"]=="DELETE"){ // ลบ 
    $userid=$_GET["userid"];
    $sql="DELETE FROM tbuser WHERE userid='$userid'";
    $result=$mysqli->query($sql);
    $mysqli->close();
    if($result)
        exit(json_encode(["status"=>"delete success"]));
    else
        exit(json_encode(["status"=>"error"]));
}

?>