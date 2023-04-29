<?php
require "DatabaseConfig.php"; //Importing the contents of this file, into this one

/**
 * Summary of Database
 */
class Database{
    //Declaring the class attributes
    public $connect;
    public $data;
    public $fundiID;
    private $sql;
    protected $servername;
    protected $username;
    protected $password;
    protected $databasename;
    
    //Class functions (methods)
    public function __construct() {
        $this->connect = null;
        $this->data = null;
        $this->sql = null;
        $dbc = new DatabaseConfig(); //Dynamically create an object of the DatabaseConfig class
        $this->servername = $dbc->servername;
        $this->username = $dbc->username;
        $this->password = $dbc->password;
        $this->databasename = $dbc->databasename;
    }
    function dbConnect() {
        //Function to connect to establish a connection to the database
        $this->connect = mysqli_connect($this->servername, $this->username, $this->password, $this->databasename);
        return $this->connect;
    }

    function prepareData($data) {
        return mysqli_real_escape_string($this->connect, stripslashes(htmlspecialchars($data)));
    }

    function logIn($table, $username, $password) {
        //This function checks the existence of a user and the correctness of the credentials entered, by comparing it to records in the 'users' table of the 'my_dawa_app' database
        $username = $this->prepareData($username);
        $password = $this->prepareData($password);
        $this->sql = "select * from " . $table . " where username = '" . $username . "'";
        $result = mysqli_query($this->connect, $this->sql);
        $row = mysqli_fetch_assoc($result);
        //Condition to search through all the rows as long as the table has one or more rows
        if (mysqli_num_rows($result) != 0) {
            $dbusername = $row['username']; //Temporarily stores the value of the username column in that row
            $dbpassword = $row['password']; //Temporarily stores the value of the password column in that row
            if ($dbusername == $username && password_verify($password, $dbpassword)) {
                $login = true; //Condition if the credentials entered on the 'inputEditText' field of the app match the record in the database
            } else $login = false; //If the strings do not match, deny login; login variable is set to false
        } else $login = false; //If there are no rows existing in the table, one cannot login

        return $login;
    }

    function signUp($table, $firstname, $surname, $email, $username, $password) {
        //This function gets the details of a newly registered user and adds them to the 'users' table of the 'my_dawa_app' database
        $firstname = $this->prepareData($firstname);
        $surname = $this->prepareData($surname);
        $username = $this->prepareData($username);
        $password = $this->prepareData($password);
        $email = $this->prepareData($email);
        $password = password_hash($password, PASSWORD_DEFAULT); //Encrypts the data; the hashed string is what is assigned to the password variable for storage in the database
        $this->sql =
            "INSERT INTO " . $table . " (firstname, surname, email, username, password) VALUES ('" . $firstname . "','" . $surname . "','" . $email . "','" . $username . "','" . $password . "')";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else {
            return false;
        }
    }


    function verifyProfile($table, $username) {
        //This function checks if the fundi username, input in the fundi fragmemnt, is valid/exists in the 'fundis' table
        $username = $this->prepareData($username);
    
        $this->sql = "SELECT * FROM " . $table . " WHERE username = '" . $username. "'"; //The sql query statement to be inserted in the 'mysqli_query' function as a parameter
        $result = mysqli_query($this->connect, $this->sql); //Querying from the database specified in the $connect class attribute
        $row = mysqli_fetch_assoc($result); //Fetching the row from the database and store it as an associative array
        //Condition to search through all the rows as long as the table has at least one row
        if (mysqli_num_rows($result) != 0) {
            $fundiID = $row['fundiID']; //Getting the fundiID associated to the username that hasbeen given
            $verify = true; //If the username exists, this variable will be set to true
        } else {
            //Conditions if no record in the fundis table with the given username exists
            $verify = false;
            $fundiID = null;
        }

        return array('verify' => $verify, 'fundiID' => $fundiID);
    }


    /**
     * Summary of queryProfile
     * @param mixed $table
     * @param mixed $fundiID
     * @return bool
     */
    function queryProfile($table, $fundiID) {
        //This function checks if the given fundiID exists in the fundiprofiles table; this is to check if the fundi has an existing profile
        $fundiID = $this->prepareData($fundiID);

        $this->sql = "SELECT * FROM " . $table . " WHERE fundiID = '" . $fundiID. "'"; //The sql query statement to be inserted in the 'mysqli_query' function as a parameter
        $result = mysqli_query($this->connect, $this->sql); //Querying from the database specified in the $connect class attribute
        $row = mysqli_fetch_assoc($result); //Fetching the row from the database and store it as an associative array
        //Condition to search through all the rows as long as the table has at least one row
        if (mysqli_num_rows($result) != 0) {
            $dbfundiID = $row['fundiID'];
            $query = ($fundiID == $dbfundiID) ? true : false;
        } else $query = false;

        return $query;
    }


    /**
     * Summary of createNewProfile
     * @param mixed $table
     * @param mixed $fundiID
     * @param mixed $name
     * @param mixed $gender
     * @param mixed $profession
     * @param mixed $county
     * @param mixed $experience
     * @param mixed $availability
     * @param mixed $package1
     * @param mixed $package1cost
     * @param mixed $package2
     * @param mixed $package2cost
     * @param mixed $package3
     * @param mixed $package3cost
     * @param mixed $package4
     * @param mixed $package4cost
     * @return bool
     */
    function createNewProfile($table, $fundiID, $name, $gender, $profession, $county, $experience, $availability, $package1, $package1cost, $package2, $package2cost, $package3, $package3cost, $package4, $package4cost) {
        $fundiID = $this->prepareData($fundiID);
        $name = $this->prepareData($name);
        $gender = $this->prepareData($gender);
        $profession = $this->prepareData($profession);
        $county = $this->prepareData($county);
        $experience = $this->prepareData($experience);
        $availability = $this->prepareData($availability);
        $package1 = $this->prepareData($package1);
        $package1cost = $this->prepareData($package1cost);
        $package2 = $this->prepareData($package2);
        $package2cost = $this->prepareData($package2cost);
        $package3 = $this->prepareData($package3);
        $package3cost = $this->prepareData($package3cost);
        $package4 = $this->prepareData($package4);
        $package4cost = $this->prepareData($package4cost);

        $this->sql =  "INSERT INTO " . $table . " (
            fundiID, 
            name, 
            gender, 
            profession, 
            county, 
            experience, 
            availability, 
            package_1, 
            package_1_cost, 
            package_2, 
            package_2_cost, 
            package_3, 
            package_3_cost, 
            package_4, 
            package_4_cost
            ) VALUES (
                '" . $fundiID . "',
                '" . $name . "',
                '" . $gender . "',
                '" . $profession . "',
                '" . $county . "',
                '" . $experience . "',
                '" . $availability . "',
                '" . $package1 . "',
                '" . $package1cost . "',
                '" . $package2 . "',
                '" . $package2cost . "',
                '" . $package3 . "',
                '" . $package3cost . "',
                '" . $package4 . "',
                '" . $package4cost . "'
                )";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else {
            return false;
        }
    }
}

?>