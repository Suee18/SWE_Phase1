<?php
$servername = "localhost";
$username = "root";
$password = "";
$DB = "users";

$conn = mysqli_connect('127.0.0.1', 'root', '', 'users', 3306);


if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}