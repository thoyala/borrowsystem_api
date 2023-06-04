<?php
// กำหนด Header สำหรับ Cors Policy

// header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, PATCH");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
// header("Access-Control-Max-Age: 1800");

?>