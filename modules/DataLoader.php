<?php

/*
  @author - Gibson
 */

//$root_path = 'D:/xampp/htdocs/dataloader/';
$root_path = '/opt/lampp/htdocs/dataloader/';

require_once($root_path . 'resources/databases/MySQLPDOCon.php');
require_once($root_path . 'utils.php');

error_reporting(E_PARSE | E_COMPILE_ERROR | E_ERROR);

//$report = "METRIC MIGRATION";

class DataLoader
{
    var $data = '';
    var $accountNo = '';
    var $email = '';
    var $phone = '';
    var $type = '';
    var $accountName = '';
    var $dateJoined = '';
    var $userId = '';
    var $city= '';
    var $dbh;
    var $total = 0;
    var $counter = 0;

    function DataLoader($date)
    {
        $report = "SAFEBODA DATA MIGRATION";
        $this->op_log($this->date, $report, $logdetail = 'STARTING');
        $report = "LOADING DATA";
        $this->report_log =  $this->report;
        $this->dbh = new MySQLPDOCon();
        $this->loadcsv();
        $this->total = sizeof($this->data);
        print_r($this->data);
        exit();
        foreach($this->data as $value){
            $this->populateVars($value);
            $this->logToAccounts();
            ++$this->counter;
        }
        //print_r($this->data);
        $this->op_log($this->date, $report, $logdetail = 'MIGRATION COMPLETED SUCCESSFULLY... THANKS');
    }


    function op_log($opdate = '', $op = '', $detail = '', $echo = TRUE)
    {
        $util = new utils();
        $logdate = date('Y-m-d H:i:s');
        if ($echo)
            echo $logdate . " : " . $op . " " . ($opdate != '' ? "[" . $opdate . "]" : "") . " :[" . $util->mem_usage() . "]:" . $detail . " ...\n";
    }

    function loadcsv (){
        $this->data = array_map('str_getcsv', file('F:\personal\IS\SafeBoda\dumps\riders2.csv'));
        //$this->data = array_map('str_getcsv', file('/opt/dumps/customer_details_new.csv'));
    }

    function logToAccounts(){
        $util = new utils();
        $id = $util->uuid();
        $dated = date('Y-m-d H:i:s');
        $deleted = 0;
        $created_by = 1;
        $query = "INSERT INTO accounts (id,name,deleted,date_entered,date_modified,created_by,billing_address_city,phone_office,modified_user_id,account_type) "
            . "VALUES ('" . $id . "','" . $this->accountNo . "','" . $deleted . "','" . $dated . "','" . $dated . "','" . $created_by .
            "','" . $this->city . "','" . $this->phone . "','" . $created_by . "','" . $this->type . "') ";
//        echo($query);
//        exit;

        $result = $this->dbh->insert($query);
        if ($result > 0) {
            $this->op_log($this->date, $this->phone, $logdetail = $this->accountName . ' LEG-1 COMPLETED WITH No. ' . $this->accountNo . '   ['.$this->counter .'/'. $this->total .']');
            $query = "INSERT INTO accounts_cstm (id_c,date_joined_c,account_name_c,userid_c) "
                . "VALUES ('" . $id . "','" . $this->dateJoined . "','" . $this->accountName . "','" . $this->userId . "') ";
            $result2 = $this->dbh->insert($query);
            if ($result2 > 0) {
                $this->op_log($this->date, $this->phone, $logdetail = $this->accountName . ' LEG-2 COMPLETED WITH No. ' . $this->accountNo . '   ['.$this->counter .'/'. $this->total .']');
            }
        }
    }

    function populateVars($arrData){
            //print_r($value[0]). PHP_EOL;
            if (array_key_exists(0, $arrData)) {
               $this->accountNo = $arrData[0];
            }
            if (array_key_exists(1, $arrData)) {
                $this->email = $arrData[1];
            }
            if (array_key_exists(2, $arrData)) {
                $this->phone = $arrData[2];
            }
            if (array_key_exists(3, $arrData)) {
                $this->type = $arrData[3];
            }
            if (array_key_exists(4, $arrData)) {
                $this->accountName = $arrData[4];
            }
            if (array_key_exists(5, $arrData)) {
                $this->dateJoined = $arrData[5];
            }
            if (array_key_exists(6, $arrData)) {
                $this->userId = $arrData[6];
            }
            if (array_key_exists(7, $arrData)) {
                $this->city = $arrData[7];
            }
    }
}

?>
