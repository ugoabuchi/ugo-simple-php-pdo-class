<?php
/* Create by Mathew Fortune *** ugoabuchi, for assistance contact me: mathewfortune54@gmail.com */
ini_set('display_errors', 1); //replace 1 with 0 to turn of error display
ini_set('log_errors', 1);
define("dbhost", "localhost");
define("dbuser", "root");
define("dbpassword", "");
define("dbtype", "mysql"); //change value to set a different database type

class ugophppdo {

    private $database_name = null;
    private $conn = null;

    function __construct($db_name) {

        $this->database_name = $db_name;
        try {
            $this->conn = new PDO(dbtype . ":host=" . dbhost . ";dbname=" . $this->database_name, dbuser, dbpassword);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {

            die("<div style='width: 80%; margin: auto; padding: 20px; text-align: center; font-size: 22px; color: #ff0000; background: #000000;'>We are sorry for this, please check back later. Error code : 01011</div>");
        }
    }
    
    function getconn()
    {
        return mysqli_connect(dbhost,dbuser,dbpassword,$this->database_name);
    }
    //Use this function only for INSERT, DELETE, UPDATE AND COPY FUNCTIONS
    function execute_no_return($dsql) {

        try {
            $smtp = $this->conn->prepare($dsql);
            $smtp->execute();
            return 1;
        } catch (PDOException $e) {
            //Sysntax error
            return 0;
        }
    }

    //Use this function only when you need to get the rows and columns of a SELECT FUNCTIOM
    function execute_return($dsql) {
                try
                {
                    $smtp = $this->conn->prepare($dsql);
                    $smtp->execute();
                    $dArray= $smtp->fetchAll(PDO::FETCH_ASSOC);
                    return $dArray;
                }catch (PDOException $e)
                {
                    //Syntax errot
                    return 0;
                }
                         
    }
    
    //Use this function only when you need to Validate that a SELECT operation exist, Make sure to use the COUNT(*) in your statement
    function execute_count_no_return($dsql)
    {
        try
                {
                    $smtp = $this->conn->prepare($dsql);
                    $smtp->execute();
                    $dArray= $smtp->fetchAll(PDO::FETCH_ASSOC);
                    if($dArray[0]['COUNT(*)'] > 0)
                        return 1;
                    else
                        return 0;
                }catch (PDOException $e)
                {
                    //Syantax error
                    return 0;
                }
    }
    
    //Use this function only when you need to get the number of row count in a SELECT operation
    function execute_count_return($dsql)
    {
       try
                {
                    $smtp = $this->conn->prepare($dsql);
                    $smtp->execute();
                    $dArray= $smtp->fetchAll(PDO::FETCH_ASSOC);
                    return (int)$dArray[0]['COUNT(*)'];
                }catch (PDOException $e)
                {
                    //Syntax errot
                    return 0;
                }
    }
    
    //Use this to check if a table exist
    function execute_count_table_no_return($tb_name)
    {
        try
                {
                    $smtp = $this->conn->prepare("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES WHERE table_schema = '$this->database_name' AND table_name ='$tb_name'" );
                    $smtp->execute();
                    $dArray= $smtp->fetchAll(PDO::FETCH_ASSOC);
                    if($dArray[0]['COUNT(*)'] > 0)
                        return 1;
                    else
                        return 0;
                }catch (PDOException $e)
                {
                    //Syntax errot
                    return 0;
                }
    }
	
	//use this to get all tables in your database
    function execute_tables_return()
    {
        try
                {
                    $smtp = $this->conn->prepare("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE table_schema = '$this->database_name'" );
                    $smtp->execute();
                    $dArray= $smtp->fetchAll(PDO::FETCH_ASSOC);
                    return $dArray;
                }catch (PDOException $e)
                {
                    //Syntax errot
                    return 0;
                }
    }

    function __destruct() {
        $this->conn = null;
    }

}


?>