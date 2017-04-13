<?php

error_reporting(0);
include 'db.php';


$dateShow   = $_REQUEST['sdate'];
//echo $dateShow;
$final_date = str_replace('/', '-', $dateShow);

$extra_sql = "";
if (isset($_REQUEST['operators']) && $_REQUEST['operators'] != "") {
    $extra_sql = " and OPERATOR='" . $_REQUEST['operators'] . "'";
}


$extra_sql2 = "";
if (isset($_REQUEST['service_type']) && $_REQUEST['service_type'] != "") {
    $extra_sql2 = " and SERVICE_TYPE='" . $_REQUEST['service_type'] . "'";
}

$extra_sql3 = "";
if (isset($_REQUEST['services']) && $_REQUEST['services'] != "") {
    $extra_sql3 = " and SERVICE_NAME='" . $_REQUEST['services'] . "'";
}

//$extra_sql = "";
if (( $_REQUEST['fdate'] != '') && ($_REQUEST['sdate'] != '')) {
    $dateShow2 = $_REQUEST['fdate'];

    $nextday_int = strtotime('+1 day', strtotime($dateShow2));
    $nextday     = date("m-d-Y", $nextday_int);
    // $sql_query   = "SELECT * FROM REPORTS_SMS2 WHERE RDATE between to_date('{$final_date}', 'MM-DD-YYYY') and to_date('$nextday', 'MM-DD-YYYY')" . $extra_sql . $extra_sql2 . $extra_sql3;
    $sql_query   = "SELECT * FROM REPORTS_WAP WHERE RDATE between to_date('{$final_date}', 'MM-DD-YYYY') and to_date('$nextday', 'MM-DD-YYYY')" . $extra_sql . $extra_sql2 . $extra_sql3;
    //echo $sql_query;
}
else {
    if ($_REQUEST['sdate'] != '') {
        $dateShow   = $_REQUEST['sdate'];
        $final_date = str_replace('/', '-', $dateShow);
        // echo "----->>>> ".$final_date; die("IIIIIIIIIIIIIIIIII");
        //  $sql_query  = "SELECT * FROM REPORTS_SMS2 WHERE trunc(RDATE) = TO_DATE('{$final_date}','MM-DD-YYYY')" . $extra_sql . $extra_sql2 . $extra_sql3;
        $sql_query  = "SELECT * FROM REPORTS_WAP WHERE trunc(RDATE) = TO_DATE('{$final_date}','MM-DD-YYYY')" . $extra_sql . $extra_sql2 . $extra_sql3;
        // echo $sql_query;
    }
    else {
        $dateShow2  = $_REQUEST['fdate'];
        $final_date = str_replace('/', '-', $dateShow2);
        // $sql_query  = "SELECT * FROM REPORTS_SMS2 WHERE trunc(RDATE) = TO_DATE('{$final_date}','MM-DD-YYYY')" . $extra_sql . $extra_sql2 . $extra_sql3;
        $sql_query  = "SELECT * FROM REPORTS_WAP WHERE trunc(RDATE) = TO_DATE('{$final_date}','MM-DD-YYYY')" . $extra_sql . $extra_sql2 . $extra_sql3;
    }
}
/*
  echo "---->>>> " . $sql_query;
  echo '<pre>';
  print_r($_REQUEST);
  echo '</pre>';
 */
$res = helper_exec_select_query($conn, $sql_query);
if ($res) {
    echo "<br/><br/>
                  <table style='font-size:13px;' align='center' width='100%'><tr align='center' bgcolor='#999999'>
		<td><b> Service Name </b></td>
                <td><b> Service Type </b></td>
                <td><b> Operator </b></td>
                <td><b> Short-Code </b></td>
		<td><b> New Subs </b></td>
                <td><b> Total Subs</b></td>
                <td><b> Free Downloads </b></td> 
                <td><b> Charged Downloads </b></td> 
                <td><b> Total Downloads </b></td> 
                <td><b>Subs Charged</b></td>
                <td><b>Subs Revenue</b></td>
                <td><b>Total Revenue</b></td>
                <td><b>Wap Pushed</b></td>
                <td><b>Date</b></td>
                </tr>";

        $i = 0;
        while ($res['SERVICE_NAME'][$i]) {
            if ($i % 2 == 0)
                echo "<tr align='center' valign='middle'>";
            else
                echo "<tr align='center' valign='middle' bgcolor='#CCCCCC'>";
            $j = $i + 1;
            echo "<td>" . $res['SERVICE_NAME'][$i] . "</td>
			<td >" . $res['SERVICE_TYPE'][$i] . "</td>
                        <td >" . $res['OPERATOR'][$i] . "</td>
                        <td >" . $res['SHORTCODE'][$i] . "</td>
                        <td >" . $res['NEW_SUBS'][$i] . "</td> 
                        <td >" . $res['TOTAL_SUBS'][$i] . "</td> 
                        <td >" . $res['FREE_DOWNS'][$i] . "</td> 
                        <td >" . $res['CHARGED_DOWNS'][$i] . "</td> 
                        <td >" . $res['TOTAL_DOWNS'][$i] . "</td> 
                        <td >" . $res['SUBS_CHARGED'][$i] . "</td> 
                        <td >" . $res['SUBS_REV'][$i] . "</td>
                        <td >" . $res['TOTAL_REV'][$i] . "</td>
                        <td >" . $res['WAP_PUSHED'][$i] . "</td> 
                        <td >" . $res['RDATE'][$i] . "</td> 
		</tr>";
            $i++;
        }

    echo '</table>';
}
helper_logout($conn);
?>

  

  