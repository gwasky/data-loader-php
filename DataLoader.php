<?php
set_time_limit(0);
ini_set('memory_limit', '9216M');
//$root_path = 'D:/xampp/htdocs/dataloader/';
$root_path = '/opt/lampp/htdocs/dataloader/';

require_once($root_path . 'modules/DataLoader.php');
require_once($root_path . 'utils.php');

error_reporting(E_PARSE | E_ERROR | SQLSRV_ERR_ERRORS | SQLSRV_ERR_WARNINGS);
$execution = new DataLoader(date('Y-m-d', strtotime()));
unset($execution);


?>