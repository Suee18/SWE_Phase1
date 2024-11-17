
<?php

include_once "../../config/db_config.php"; 

$user_id = mysqli_real_escape_string($conn, htmlspecialchars($_POST["user_id"]));

$username = mysqli_real_escape_string($conn, htmlspecialchars($_POST["username"]));
$agee = mysqli_real_escape_string($conn, htmlspecialchars($_POST["age"]));
$password = mysqli_real_escape_string($conn, htmlspecialchars($_POST["password"]));
$type = mysqli_real_escape_string($conn, htmlspecialchars($_POST["user_type"]));
$email = mysqli_real_escape_string($conn, htmlspecialchars($_POST["email"]));
$gender = mysqli_real_escape_string($conn, htmlspecialchars($_POST["gender"]));


	$sql="update  users set username='$username', gender='$gender', email='$email', password='$password', birthdate='$agee' ,type='$type'
	WHERE id='$user_id'";

	$result=mysqli_query($conn,$sql);


?>