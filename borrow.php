<?php
require("header.php");
require("connect.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $data=json_decode(file_get_contents("php://input"));
    $userid= $data[0]->userid;
    $borrow_date=date('Y-m-d H:i:s');
        // exit(json_encode(['borrow_date' => $borrow_date]));
    //insert to tbBorrow
    // exit(json_encode("test "));
    $sql="INSERT INTO tbborrow (userid,borrow_date) VALUES('$userid','$borrow_date')";
    // exit(json_encode("test "));
    $result=$mysqli->query($sql);
    if(!$result)
        exit(json_encode(["status"=>"insert to tbBorrow error"]));
    //อ่านค่า saleid จากตาราง tbsale
    $sql=$mysqli->query("SELECT MAX(borrowid) AS ID FROM tbborrow WHERE userid='$userid'");
    $row=$sql->fetch_array();
    $borrowid=$row["ID"];

    //insert to tbBorrow_detail
    for($i=0;$i<sizeof($data);$i++){
        $equipid=$data[$i]->equipid;
        $quantity=$data[$i]->quantity;
        $result=$mysqli->query("INSERT INTO tbborrowdetail (borrowid, equipid, quantity) VALUES('$borrowid', '$equipid', '$quantity')");
    }
    if($result){
        exit(json_encode(['status' => 'insert success']));
    }else{
        exit(json_encode(['status' => 'insert error']));
       
    }
}
?>