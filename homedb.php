<?php
error_reporting(0);
include 'db.php';



$extra_sql = "";
if (isset($_REQUEST['operators']) && $_REQUEST['operators'] != "" ) {
    $extra_sql = " and OPERATOR='" . $_REQUEST['operators'] . "'";
}



//$extra_sql2 = "";
if (isset($_REQUEST['service_type']) && $_REQUEST['service_type'] != "") {
    $extra_sql2 = " and SERVICE_TYPE='" . $_REQUEST['service_type'] . "'";
}


 $sql_query  = "SELECT * FROM REPORTS_SMS WHERE trunc(RDATE) = TO_DATE(SYSDATE,'DD-MM-YY')" . $extra_sql . $extra_sql2 ;
// echo $sql_query;
 $res = helper_exec_select_query($conn, $sql_query);
if ($res) {
    echo "<table style='font-size:13px;' align='center' width='100%'><tr align='center' bgcolor='#999999'>
		<td><b> SERVICE_NAME </b></td>
		<td><b> SERVICE_TYPE </b></td>
                <td><b> OPERATOR </b></td>
                <td><b> SHORTCODE </b></td>
		<td><b> NEW_SUBS </b></td>
                <td><b> TOTAL_SUBS </b></td>
                <td><b> TOTAL_Churn </b></td>
                <td><b> TOTAL_Base </b></td>
                <td><b> Date </b></td>
                <td><b> Keyword </b></td>
               
	</tr>";
    $i = 0;
    while ($res['SERVICE_NAME'][$i]) {
        if ($i % 2 == 0)
            echo "<tr align='center' valign='middle'>";
        else
            echo "<tr align='center' valign='middle' bgcolor='#CCCCCC'>";
        $j = $i + 1;
        echo "<td>" . $res['SERVICE_NAME'][$i] . "</td>
			<td>" . $res['SERVICE_TYPE'][$i] . "</td>
                        <td>" . $res['OPERATOR'][$i] . "</td>
                        <td>" . $res['SHORTCODE'][$i] . "</td>
			<td>" . $res['NEW_SUBS'][$i] . "</td>
                        <td>" . $res['TOTAL_SUBS'][$i] . "</td>
                        <td>" . $res['TOTAL_CHURN'][$i] . "</td>
                        <td>" . $res['TOTAL_BASE'][$i] . "</td>
                        <td>" . $res['RDATE'][$i] . "</td>
                        <td>" . $res['KEYWORD'][$i] . "</td>
                       
                       
		</tr>";
        $i++;
        
    }

    echo '</table>';
}
else {
        ?>
        <div style="width:100%; text-align:center">
            <br/><br/><br/> - NO RECORD FOUND -
        </div>
    <?php
}
?>
<?php
helper_logout($conn);
?>