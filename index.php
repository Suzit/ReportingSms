<?php
error_reporting(1);
require_once '../_lib/helper.inc';


$conn = helper_login('gp');
if ($conn) {
    echo "DB Connection OK";
    // helper_logout($conn);
}
else {
    // echo "DB Connection FAILED";
}
if ($_POST['login']) {
    $userId = $_POST[userid];
    $pass   = $_POST[pass];
    $query  = "SELECT USERID,PASS FROM LOGIN WHERE USERID='{$userId}' and PASS='{$pass}' ";
    //echo $query;
    $res    = helper_exec_select_query($conn, $query);

    if ($res) {
        // echo 'Test';

        header('Location: http://localhost/ReportingSms/home.php');
    }
    else {
        $msg = "Wrong User Id or Password";
    }
}
  
?>                                                            
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
            <title>SMS Report Panel</title>
            <meta content="" name="keywords">
                <meta content="" name="description">
                    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald">
                        <link media="all" type="text/css" rel="stylesheet" href="style.css">
                            <style>
                            </style>
                            <script>

                                function nameempty()
                                {
                                    var i = 0;
                                    if (document.form.user_id.value == '') {
                                        i++;
                                    }
                                    if (document.form.pass.value == '') {
                                        i++;
                                    }

                                    if (i > 0) {
                                        return false;
                                    }
                                }
                            </script>
                            </head>
                            <body >
                                <div id="wrapper">
                                    <div id="header">
                                        <div class="logo">
                                            <img height="90px" src="images/logo.jpg">
                                        </div>
                                        <div class="htext">
                                            <h1>SMS Report</h1>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div id="menu">
                                        <ul>
                                            <li class=""> </li>
                                            <li>

                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="content">
                                        <div class="box" align="center" style="padding:150px 0 150px 0;">
                                            <form id="form" onsubmit="return nameempty();" action="" enctype="multipart/form-data" method="post" name="form">
                                                <div align="center" style="margin:auto; width:650;">
                                                    <b>User ID:    </b>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;<input id="userid" type="text" size="15" name="userid">
                                                        <br>
                                                            <b>Password:</b>
                                                            <input id="pass" type="password" size="15" name="pass">
                                                                <br>
                                                                    <br>
                                                                        <input id="login" type="submit" style="cursor:pointer" name="login" value="Login">
                                                                            <?php echo'<div><p style="color:red;">' . $msg . '</p></div>' ?>
                                                                            </form>
                                                                            </div>
                                                                            </div>
                                                                            </div>
                                                                            <div id="footer">
                                                                                <p>
                                                                                    <img height="80px" src="images/16309.jpg">
                                                                                </p>
                                                                            </div>
                                                                            </body>
                                                                            </html>