<?php
    require('lib/simpleCache.php');
    require('lib/forecast.php');

    try {
        $config = require('config.php');
    } catch(Exception $e) {
        exit('config.php file is missing or corrupt.');
    }

    $forecast = new ForecastIO($config['api_key'], $config['units'], $config['lang']);
    $condition = $forecast->getCurrentConditions($config['lat'], $config['lon']);
    $precipitation_type = $condition->getPrecipitationType();

    if ($precipitation_type && $precipitation_type == 'snow') {
        $class = "yes";
        $answer = "<h1>YES!</h1><p>COMMENCE PANIC!</p><img src='img/snowflail.gif'>";
    } else {
        $class = "no";
        $answer = "<h1>No.</h1>";
    }
?>
<html>
    <head>
        <title>Is it snowing in Portland, Oregon?</title>
        <link rel="stylesheet" type="text/css" href="css/styles.css" >
    </head>
    <body class="<?php  echo $class; ?>"> 
        <div id="answer">
            <?php echo $answer; ?>
        </div>
	
        <p id="credits">
            Made By: 
            <a href="http://maxisnow.com">MaxIsNow.com</a> 
            and 
            <a href="http://stacybias.net/">StacyBias.Net</a>
        </p>

        <div id="other-shit">
            <a title="Web Analytics" href="http://clicky.com/100703714">
                <img alt="Web Analytics" src="//static.getclicky.com/media/links/badge.gif" border="0" />
            </a>
            
            <script src="//static.getclicky.com/js" type="text/javascript"></script>
            <script type="text/javascript">try{ clicky.init(100703714); }catch(e){}</script>
            <noscript><p><img alt="Clicky" width="1" height="1" src="//in.getclicky.com/100703714ns.gif" /></p></noscript>
            <a href="http://forecast.io/" class="forecast-io">Powered by Forecast</a>
        </div>
    </body>
</html>
