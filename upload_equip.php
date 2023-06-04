<?php
require("header.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name=$_FILES["picture"]["name"];
    $tmp_name=$_FILES["picture"]["tmp_name"];

    if(move_uploaded_file($tmp_name,"images/equip/$name")){
        exit(json_encode(["status"=>"upload success"]));
    }else{
        exit(json_encode(["status"=>"upload error"]));
    }
}




?>