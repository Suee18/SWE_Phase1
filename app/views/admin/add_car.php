<?php
include_once "../../config/db_config.php"; 

        $name = mysqli_real_escape_string($conn, htmlspecialchars($_POST["name"]));
        $type = mysqli_real_escape_string($conn, htmlspecialchars($_POST["type"]));
        $engine = mysqli_real_escape_string($conn, htmlspecialchars($_POST["engine"]));
        $power = mysqli_real_escape_string($conn, htmlspecialchars($_POST["power"]));
        $fuelEconomy = mysqli_real_escape_string($conn, htmlspecialchars($_POST["fuelEconomy"]));
        $torque = mysqli_real_escape_string($conn, htmlspecialchars($_POST["torque"]));

        $sql = "insert into cars (name,type, engine, power, fuelEconomy, torque) VALUES ('$name', '$type', '$engine', '$power', '$fuelEconomy', '$torque')";
        $result = mysqli_query($conn, $sql);
      

?>