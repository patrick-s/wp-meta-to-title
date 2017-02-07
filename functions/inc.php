<?php
// Debug Mode, using switch in case I want to go more advanced.
$debug_get = filter_input(INPUT_GET, "debugmode", FILTER_SANITIZE_NUMBER_INT);

$debugmode = false;
if((ISSET($debug_get) && !empty($debug_get)) || (ISSET($scriptdebug) && !empty($scriptdebug))){
    switch($debug_get){
        case 1:
            $debugmode = true;
            break;
        default:
            $debugmode = false;
            break;
    }
    
    switch($scriptdebug){
        case 1:
            $scriptmode = true;
            break;
        default:
            $scriptmode = false;
            break;
    }
    
    if($debugmode === true || $scriptmode === true){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }
}

// Grab required classes
require("class_db_con.php");
require("class_db_view.php");
require("class_general.php");

