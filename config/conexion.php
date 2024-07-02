<?php

$hostname = "localhost";
$username = "root";
$pass = "";
$database = "owl_control";

$conexion = mysqli_connect($hostname,$username,$pass,$database);

if(!$conexion){
    echo "hoal";
}
