<?php error_reporting(0); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <title>SMS Report Panel</title>
        <meta content="" name="keywords" />
        <meta content="" name="description" />
        <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald" />
        <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> 
        <script type="text/javascript" src="js/JavaScript.js"></script> 
        <link media="all" type="text/css" rel="stylesheet" href="style.css" />

    </head>

    <body>
        <div id="wrapper">
            <div id="header">
                <div class="logo">
                    <img height="90px" src="images/logo.jpg">
                </div>
                <div class="htext">
                    <h1>SMS Reporting Panel</h1>
                </div>
                <div class="clearfix"></div>
            </div>

            <div id="menu">
                <ul>
                    <!--  <li class=""><a href="index.php">Home</a> </li> -->
                    <li>
                        <a href="home.php">HOME</a>
                    </li>
                    <li>
                        <div class="dropdown">
                            <button class="dropbtn">TECH2MORO</button>
                            <div class="dropdown-content">
                                <a href="t2m_sms_report.php">SMS Report</a>
                                <a href="t2m_wap_report.php">WAP Report</a>
                                <a href="t2m_sms_daily.php">SMS Daily</a>
                                <a href="t2m_wap_daily.php">WAP Daily</a>
                                <a href="t2m_sms_monthly.php">SMS Monthly</a>
                                <a href="t2m_wap_monthly.php">WAP Monthly</a>
                                <a href="t2m_sms_yearly.php">SMS Yearly</a>
                                <a href="t2m_wap_yearly.php">WAP Yearly</a>
                            </div>
                        </div>

                    </li>
                    <li>
                        <div class="dropdown">
                            <button class="dropbtn">VASPRO</button>
                            <div class="dropdown-content">
                                <a href="vas_sms.php">SMS Report</a>
                                <a href="vas_wap.php">WAP Report</a>
                                <a href="vas_sms_daily.php">SMS Daily</a>
                                <a href="vas_wap_daily.php">WAP Daily</a>
                                <a href="vas_sms_monthly.php">SMS Monthly</a>
                                <a href="vas_wap_monthly.php">WAP Monthly</a>
                                <a href="vas_sms_yearly.php">SMS Yearly</a>
                                <a href="vas_wap_yearly.php">WAP Yearly</a>
                            </div>
                        </div>

                    </li>
                    <li>
                        <div class="dropdown">
                            <button class="dropbtn">ZIPIT</button>
                            <div class="dropdown-content">
                                <a href="zip_sms.php">SMS Report</a>
                                <a href="zip_wap.php">WAP Report</a>
                                <a href="zip_sms_daily.php">SMS Daily</a>
                                <a href="zip_wap_daily.php">WAP Daily</a>
                                <a href="zip_sms_monthly.php">SMS Monthly</a>
                                <a href="zip_wap_monthly.php">WAP Monthly</a>
                                <a href="zip_sms_yearly.php">SMS Yearly </a>
                                <a href="zip_wap_yearly.php">WAP Yearly</a>
                            </div>
                        </div>
                    </li>
                    <li class=""><a href="logout.php">LOGOUT</a> </li>
                </ul>
                <div class="clearfix"></div>
            </div>
