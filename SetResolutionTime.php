<?php
/**
 * Created by PhpStorm.
 * User: 2308157
 * Date: 1/14/2020
 * Time: 7:42 PM
 */

set_time_limit(0);
ini_set('memory_limit', '9216M');
//$root_path = 'D:/xampp/htdocs/dataloader/';
$root_path = '/opt/lampp/htdocs/dataloader/';

require_once($root_path . 'modules/SetResolutionTime.php');
require_once($root_path . 'utils.php');

error_reporting(E_PARSE | E_ERROR);
$execution = new SetResolutionTime(date('Y-m-d', strtotime()));
unset($execution);


?>