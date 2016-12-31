<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once "includes.php";
define("PAGE_ROOT", dirname(__FILE__));

require_once PAGE_ROOT . "/pages.php";
require_once PAGE_ROOT . "/errors.php";

global $routes;
session_start();
get_page_context()->dispatch($routes);

register_shutdown_function('page_shutdown_site');