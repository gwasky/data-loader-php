<?php

/**
 * Created by PhpStorm.
 * User: 2308157
 * Date: 1/14/2020
 * Time: 2:46 PM
 */
// $root_path = 'D:/xampp/htdocs/dataloader/';
$root_path = '/opt/lampp/htdocs/dataloader/';
require_once($root_path . 'resources/databases/MySQLPDOCon.php');
require_once($root_path . 'utils.php');

class SetResolutionTime
{
    var $dbh;
    var $rowsUpdated;
    var $util;

    /**
     * SetResolutionTime constructor.
     * @param $dbh
     */
    public function SetResolutionTime()
    {
        $report = "TIME RESOLUTION UPDATE";
        $util = new utils();
        $this->dbh = new MySQLPDOCon();
        $this->rowsUpdated =$this-> updateResolutionTime();
        $util->op_log($this->date, $report, $logdetail = $this->rowsUpdated .' Rows Updated');
    }

    public function updateResolutionTime(){

        $query = "UPDATE cases_cstm b INNER JOIN cases a
                        ON a.id = b.id_c
                        SET b.time_to_resolution_c = TIMESTAMPDIFF(SECOND,a.date_entered,b.closure_date_c)
                        WHERE a.status = 'Closed_Closed' AND b.time_to_resolution_c IS NULL AND b.closure_date_c IS NOT NULL";
        return $this->dbh->updateMultiple($query);
    }


}