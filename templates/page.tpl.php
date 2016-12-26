<!DOCTYPE html>
<html>
    <head>
        <link href="/assets/style/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/style/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.8.2.min.js"></script>
    </head>
    <body>
        <div class="clearfix" id="header_fixed">
            <div id="page_header" class="container-fluid">
                <?php require_once "header.tpl.php"; ?>
            </div>
        </div>
        <div class="clearfix" id="page_full">
            <div id="page_body">
                <?php echo $html_content; ?>
            </div>

            <div id="page_footer">
                <div class="container">
                    <?php require_once "footer.tpl.php"; ?>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="/assets/style/script.js"></script>
    </body>
</html>