<?php
require_once "includes.php";
define("PAGE_ROOT", dirname(__FILE__));

require_once PAGE_ROOT . "/pages.php";
require_once PAGE_ROOT . "/errors.php";

global $routes;
session_start(); 
register_shutdown_function('page_shutdown_site');
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="/assets/style/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/style/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.8.2.min.js"></script>
    </head>
    <body>
        <div class="clearfix">
            <div id="page_header" class="container-fluid">
                <div class="clearfix text-center">
                    <a name="header_top" href="/"><img src="/assets/style/images/enscalo-full-scale.png" alt="Enscalo Logo" title="Enscalo Logo" height="140" width="auto" /></a>
                </div>
            </div>
        </div>
        <div class="clearfix" id="page_full">
            <div id="page_body">
                <div class="container">
                    <p>An error has occurred in delivering the page</p>
                    <button type="button" class="btn btn-danger" onclick="navigate_to_section(this, 'home', true); return false;">Go to home page</button>
                </div>
            </div>

            <div id="page_footer">
                <div class="container">
                    <?php require_once "templates/footer.tpl.php"; ?>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="/assets/style/script.js"></script>
    </body>
</html>