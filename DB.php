<?php
//This file will handle things like connecting to the database and inserting pizza orders to the database
class DB
{
    private $sqlConnection;
    function __construct(){
        $this ->dbConnector();
    }
    public function dbConnector(){
        $this->sqlConnection = mysqli_connect('localhost','root','rootPassword','assignment1');//ip, username, password, database.also assigns the database to the var sqlConnection
        if(mysqli_connect_error())// if php was able to connect to the sql server
            die("Can't seem to connect to the database: ". mysqli_connect_error());
    }
    public function sendData($fname,$lname,$number,$email,$topping1, $topping2, $topping3,$notes){
        $command = "INSERT INTO pizzaorders (fname, lname, phoneNum, email, toppingOne, toppingTwo, toppingThree, notes) VALUES('$fname','$lname','$number','$email','$topping1', '$topping2', '$topping3','$notes')";//saves the mySQL insert command to a variable
        $response = mysqli_query($this->sqlConnection, $command);//sends the command to the mySQL server
        if($response){//if the command goes through
            return true;
        }
    }

    public function sanitize($string){//This function adds a backslash(\) to characters in the string that might mess with sql syntax ex: " or ' so "it's" turns into "it\'s". It also prevents SQL injection attacks.
        $return = mysqli_real_escape_string($this->sqlConnection, $string);
        return $return;//
    }
}
$database = new DB(); // creates a new DB object
?>