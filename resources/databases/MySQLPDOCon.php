<?php

/**
 * Description of PDOConnection
 *
 * @author gibson
 */
class MySQLPDOCon {

    //put your code here

    public $dbh;

    function __construct() {
        try {

            /*$db_username = "root";
            $db_password = "";
            $dsn = 'mysql:dbname=dataserv;host=localhost;port=3306';
            */

            $db_username = "root";
            $db_password = "";
            $dsn = 'mysql:dbname=sbcrm;host=localhost;port=3306';

            $this->dbh = new PDO($dsn, $db_username, $db_password, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_FOUND_ROWS => true,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function select($sql) {
        $sql_stmt = $this->dbh->prepare($sql);
        $sql_stmt->execute();
        $result = $sql_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function insert($sql) {
        $sql_stmt = $this->dbh->prepare($sql);
        try {
            $result = $sql_stmt->execute();
        } catch (PDOException $e) {
            trigger_error('Error occured while trying to insert into the DB:' . $e->getMessage(), E_USER_ERROR);
        }
        if ($result) {
            return $sql_stmt->rowCount();
        }
    }

     function singlerow($sql) {
        try{
            $q = $this->dbh->query($sql);
            $result = $q->fetchColumn();
        }
        catch (PDOException $e) {
            trigger_error('Error occured while trying to insert into the DB:' . $e->getMessage(), E_USER_ERROR);
        }
        return $result;
    }

    public function updateMultiple($sql)
    {
        try {
            $sql_stmt = $this->dbh->prepare($sql);
            $stmt = $sql_stmt->execute();
            $count = $sql_stmt->rowCount();
            // echo "Count of Updates --> ". $sql_stmt->rowCount() ."\n";
            //return $stmt->rowCount();
        } catch(PDOException $e) {
            trigger_error('Error occured while trying to Update Records into the DB:' . $e->getMessage(), E_USER_ERROR);
        }
        return $count;
    }

    function __destruct() {
        $this->dbh = NULL;
    }

}
