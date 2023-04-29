<?php

class DatabaseConfig {
    //Declaring the class attributes
    public $servername;
    public $username;
    public $password;
    public $databasename;

    //Class function
    public function __construct() {
        //This function assigns values to the four variables of any instance of the DatabaseConfig class created so as to connect to the appropriaate database
        $this->servername = "localhost"; //Default values of the database servername and username when using XAMPP
        $this->username = "root";
        $this->password = "";
        $this->databasename = "my_fundi_app"; //Name of the database as created in the XAMPP phpmyadmin database
    }
}

?>