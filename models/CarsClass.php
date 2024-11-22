<?php

include_once 'C:\xampp\htdocs\SWE Project\SWE_Phase1\app\config\db_config.php';

class Cars{
    public $id;

    public $name;

    public $type;

    public $engine;

    public $power;

    public $fuelEconomy;

    public $torque;

    function __construct($id,$name,$type,$engine,$power,$fuelEconomy,$torque){

        $this->id=$id;
        $this->name=$name;
        $this->type=$type;
        $this->engine=$engine;
        $this->power=$power;
        $this->fuelEconomy=$fuelEconomy;
        $this->torque=$torque;
    }

    function getAllCars(){

        global $conn;
        $sql="SELECT * from cars";
        $result=mysqli_query($conn,$sql);
        $cars=[];

        if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                $car= new Cars($row["name"],$row["type"],$row["engine"],$row["power"],$row["fuelEconomy"],$row["torque"]);
                $car->id=$row["ID"];
                array_push($cars,$car);
            }
        }
        return $cars;
    }

    function getCarByName($carName){
        global $conn;
        $sql="SELECT *from cars Where name='$carName";
        $result=mysqli_query($conn,$sql);

        $car=null;
        if(mysqli_num_rows($result)>0){
            $row=mysqli_fetch_assoc($result);
            $car= new Cars($row["name"],$row["type"],$row["engine"],$row["power"],$row["fuelEconomy"],$row["torque"]);
            $car->id=$row["ID"];
        }
    }

    function addCar($car){
        global $conn;
        $sql="INSERT into cars(name,type,engine,power,fuelEconomy,torque)
         values ('$car->name','$car->type','$car->engine','$car->power','$car->fuelEconomy','$car->torque')";

         $result=mysqli_query($conn,$sql);
         return $result;
    }

    function deleteCar($carID){
        global $conn;
        $sql = "DELETE from cars WHERE ID = '$CarID'";
        $result = mysqli_query($conn, $sql);
        return $result;
    }
}

?>