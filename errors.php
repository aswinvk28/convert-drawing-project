<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

set_error_handler(function($errorno, $errorstr, $errorfile, $errorline, $errorcontext) {
    $error_file = realpath($GLOBALS['error_path']);
    $error_type = $error == E_USER_ERROR ? 'Error' : $errorno == E_USER_NOTICE ? 'Notice' : $errorno == E_USER_WARNING ? 'Warning' : 'Undefined';
    $error_message = "{$error_type}: in '{$errorfile}' at line {$errorline} \n
            {$errorstr}\n";
    if(!file_exists($error_file)) {
        throw Exception("Site error log file does not exist");
    }
    file_put_contents($error_file, $error_message, FILE_APPEND);
}, E_USER_ERROR | E_USER_NOTICE | E_USER_WARNING);