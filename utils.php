<?php

class utils {

    function mem_usage($unit = 'M') {
        switch ($unit) {
            case 'K':
            case 'k':
                return $this->format_n(memory_get_usage(true) / (1024), 1) . " KB";
                break;
            case 'G':
            case 'g':
                return $this->format_n(memory_get_usage(true) / (1024 * 1024 * 1024), 1) . " GB";
                break;
            case 'M':
            case 'm':
            default:
                return $this->format_n(memory_get_usage(true) / (1024 * 1024), 1) . " MB";
        }
    }

    function format_n($input, $dec_places = 0) {
        if (is_numeric($input) or $input == '') {
            return number_format($input, $dec_places);
        } else {
            return $input;
        }
    }

    function RemoveSpecialCharacters($string) {
        //$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    function ReplaceComma($string) {
        $x = str_replace("'","", $string);
        return $x;
    }

    function uuid() {
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45); // "-"
        $uuid = substr($charid, 0, 8) . $hyphen
                . substr($charid, 8, 4) . $hyphen
                . substr($charid, 12, 4) . $hyphen
                . substr($charid, 16, 4) . $hyphen
                . substr($charid, 20, 12);

        return strtolower($uuid);
    }

    function op_log($opdate = '', $op = '', $detail = '', $echo = TRUE)
    {
        $logdate = date('Y-m-d H:i:s');
        if ($echo)
            echo $logdate . " : " . $op . " " . ($opdate != '' ? "[" . $opdate . "]" : "") . " | [" . $this->mem_usage() . "] | " . $detail . " ...\n";
    }

}
?>

