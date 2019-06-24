<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
    <html
    class="no-js"> <!--<![endif]-->

    <head>
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <title>BrowserInfo</title>
        <meta content="" name="description">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <link href="style.css" rel="stylesheet">
    </head>

    <body>
        <!--[if lt IE 7]>
                                                    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
                                                <![endif]-->

        <main>

            <div class="main-category browser">
                <span>Browser</span>
                <div id="browser">
                
                <?php
                function getBrowser() 
                { 
                    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
                    $bname = 'Unknown';
                    $platform = 'Unknown';
                    $version= "";

                    //First get the platform?
                    if (preg_match('/linux/i', $u_agent)) {
                        $platform = 'Linux';
                    }
                    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
                        $platform = 'Mac';
                    }
                    elseif (preg_match('/windows|win32/i', $u_agent)) {
                        $platform = 'Windows';
                    }

                    // Next get the name of the useragent yes seperately and for good reason
                    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
                    { 
                        $bname = 'Internet Explorer'; 
                        $ub = "MSIE"; 
                    } 
                    elseif(preg_match('/Firefox/i',$u_agent)) 
                    { 
                        $bname = 'Mozilla Firefox'; 
                        $ub = "Firefox"; 
                    } 
                    elseif(preg_match('/Chrome/i',$u_agent)) 
                    { 
                        $bname = 'Google Chrome'; 
                        $ub = "Chrome"; 
                    } 
                    elseif(preg_match('/Safari/i',$u_agent)) 
                    { 
                        $bname = 'Apple Safari'; 
                        $ub = "Safari"; 
                    } 
                    elseif(preg_match('/Opera/i',$u_agent)) 
                    { 
                        $bname = 'Opera'; 
                        $ub = "Opera"; 
                    } 
                    elseif(preg_match('/Netscape/i',$u_agent)) 
                    { 
                        $bname = 'Netscape'; 
                        $ub = "Netscape"; 
                    } 

                    // finally get the correct version number
                    $known = array('Version', $ub, 'other');
                    $pattern = '#(?<browser>' . join('|', $known) .
                    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
                    if (!preg_match_all($pattern, $u_agent, $matches)) {
                        // we have no matching number just continue
                    }

                    // see how many we have
                    $i = count($matches['browser']);
                    if ($i != 1) {
                        //we will have two since we are not using 'other' argument yet
                        //see if version is before or after the name
                        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                            $version= $matches['version'][0];
                        }
                        else {
                            $version= $matches['version'][1];
                        }
                    }
                    else {
                        $version= $matches['version'][0];
                    }

                    // check if we have a number
                    if ($version==null || $version=="") {$version="?";}

                    return array(
                        'userAgent' => $u_agent,
                        'name'      => $bname,
                        'version'   => $version,
                        'platform'  => $platform,
                        'pattern'    => $pattern
                    );
                } 

                // now try it
                $ua=getBrowser();
                $yourBrowser = $ua['name'] . "<br/> " . $ua['version'];
                $yourDevice = $ua['platform'] . "<br/>" . $ua['userAgent'];
                // . " on " .$ua['platform'] . " reports: <br >" . $ua['userAgent']
                print_r($yourBrowser);

                
            ?>

                </div>
                <!--<div id="browserVersion">75.0.3770.100</div>-->
            </div>
            <div class="main-category screen">
                <span>Screen</span>
                <div class="screen-info">
                    Width:
                    <div id="screenWidth">1440px</div>
                </div>
                <div class="screen-info">
                    Height:
                    <div id="screenHeight">800px</div>
                </div>
            </div>
            <div class="main-category device">
                <span>Device</span>
                <div id="device">
                    <?php print_r($yourDevice);?>
                </div>
                <div id="os">OS X</div>
            </div>
            <div class="main-category screen">
                <span>Viewport</span>
                <div class="screen-info">
                    Width:
                    <div id="viewportWidth">1440px</div>
                </div>
                <div class="screen-info">
                    Height:
                    <div id="viewportHeight">800px</div>
                </div>
            </div>
            <div class="main-category javascript">
                <span>JavaScript</span>
                <div id="isAllowed">Allowed</div>
            </div>

            <div class="main-category cookies">
                <span>Cookies</span>
                <div id="isAllowed">Allowed</div>
            </div>

        </main>

        <script src="app.js"></script>
    </body>

</html>
