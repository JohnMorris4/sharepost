<?php
/*
 * PDO Database Class
 * Connect to the Database
 * Create prepared stmts
 * Bind Values
 * Return Rows and Results
 */
class Database {
    private $d_host = DB_HOST;
    private $d_user = DB_USER;
    private $d_pass = DB_PASS;
    private $d_name = DB_NAME;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct(){
        //set dsn
        $dsn = 'mysql:host=' . $this->d_host . ';dbname=' . $this->d_name;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        //Create PDO instance
        try{
            $this->dbh = new PDO($dsn, $this->d_user, $this->d_pass, $options);
        } catch (PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    //Prepare statement with querry
    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }
    //Bind values 
    public function bind($param, $value, $type= null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    //Create the execute prepared statement
    public function execute(){
        return $this->stmt->execute();
    }
    //Get result Set
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
    public function rowCount(){
        return $this->stmt->rowCount();
    }
}