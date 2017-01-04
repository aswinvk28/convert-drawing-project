<!DOCTYPE html>
<html>
    <head>
        <title>Enscalo</title>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <meta http-equiv="content-language" content="en-gb">
        <meta property="og:title" content="Enscalo | Recognise your floor plans" />
	<meta property="og:url" content="http://www.enscalo.co.uk/" />
	<meta property="og:site_name" content="Enscalo" />
	<meta property="og:description" content="A software tool for conceptualisation, sketching and importing into CAD" />
        <meta property="og:image" content="http://www.enscalo.co.uk/assets/style/images/enscalo-full-scale.png"/>
	<meta property="og:type" content="Computer Software"/>
        <meta name="description" content="Floor Plans drawn with ease of use. Enscalo is a drawing software that promotes conceptualisation of the desired requirements for a floor planner project. Enscalo helps in designing a plan and collaborate them with the project members.">
        <meta name="keywords" content="Floor Plan, Software, Conversion, Drawing, Design, Building, Pricing, Features, Residential Building, Commercial Project">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="image/x-icon" href="/assets/style/images/favicon.ico" rel="shortcut icon">
        <link href="/assets/style/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/style/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.8.2.min.js"></script>
        <link href="/video/player/mediaplayer.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="/video/player/mediaplayer.js"></script>
	<script type="text/javascript">
		_V_.options.flash.swf = "/video/player/mediaplayer.swf";
	</script>
    </head>
    <body>
        <?php require_once "analyticstracking.tpl.php"; ?>
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