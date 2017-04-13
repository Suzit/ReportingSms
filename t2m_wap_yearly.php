<?php
error_reporting(0);
include 'db.php';
include 'header.php';

$current_date = isset($_GET['date']) ? $_GET['date'] : date('Y');

$next_date = $current_date + 1;
// echo $next_date;
$prev_date = $current_date - 1;
//echo $prev_date;
$r_date    = date('Y', strtotime($current_date));
//echo $r_date;
$r_date1   = date("m-Y", strtotime($current_date));
//echo $r_date;
?>

<div id="content">


    <div style='text-align:left'>
        <a  href="?date=<?= $prev_date; ?>">Previous</a>
    </div>
    <div style='text-align:right'>
        <a href="?date=<?= $next_date; ?>">Next</a>
    </div>
    <?php
    echo "<div style='text-align:center'><h3> " . $current_date . "</h3></div>";
    ?>
    
    <br><br>
    <?php
    $sql_query = "SELECT OPERATOR,TO_CHAR(RDATE,'MM-YYYY') as months,SUM(NEW_SUBS) as NSubscriber,SUM(FREE_DOWNS) as FDowns,SUM(CHARGED_DOWNS) as ChargedDowns,SUM(TOTAL_DOWNS) as TotalDowns,SUM(SUBS_CHARGED) as SubsCharged,SUM(SUBS_REV) as SubsRev,SUM(TOTAL_REV) as TotalRev,SUM(WAP_PUSHED) as WapPushed FROM REPORTS_WAP WHERE TO_CHAR(RDATE,'YYYY')='$current_date' GROUP BY TO_CHAR(RDATE,'MM-YYYY'),OPERATOR ORDER BY OPERATOR";
    $res       = helper_exec_select_query($conn, $sql_query);
    /*
      echo '<pre>';
      print_r($res);
      echo '</pre>';
      /* */
    if (!empty($res)) {

        //if ($res) {
       echo "<br/><br/>
                  <table style='font-size:13px;' border='1' align='center' width='100%'><tr align='center' bgcolor='#999999'>
		<td ><b> Operator </b></td>
                <td width='80'><b> Month </b></td>
		<td width='80'><b> New Subs </b></td>
                <td width='80'><b> Free Downloads </b></td>    
                <td width='80'><b> Charged Downloads</b></td>
                <td width='80'><b>Total Downloads</b></td>
                <td width='80'><b>Subs Charged</b></td>
                <td width='80'><b>Subs Revenue</b></td>
                <td width='80'><b>Total Revenue</b></td>
                <td width='80'><b>WAP Push </b></td>
                </tr>";

        $i = 0;
        while ($res['OPERATOR'][$i]) {
            if ($i % 2 == 0)
                echo "<tr align='center' valign='middle'>";
            else
                echo "<tr align='center' valign='middle' bgcolor='#CCCCCC'>";
            $j = $i + 1;
            echo "<td>" . $res['OPERATOR'][$i] . "</td>
                        <td>" . $res['MONTHS'][$i] . "</td>
			<td >" . $res['NSUBSCRIBER'][$i] . "</td>
                        <td >" . $res['FDOWNS'][$i] . "</td>
                        <td >" . $res['CHARGEDDOWNS'][$i] . "</td>
                        <td >" . $res['TOTALDOWNS'][$i] . "</td> 
                        <td >" . $res['SUBSCHARGED'][$i] . "</td>
                        <td >" . $res['SUBSREV'][$i] . "</td> 
                        <td >" . $res['TOTALREV'][$i] . "</td> 
                        <td >" . $res['WAPPUSHED'][$i] . "</td> 
                            
		</tr>";
            $i++;
        }

        echo '</table>';
    }else {
        ?>
        <div style="width:100%; text-align:center">
            <br/><br/><br/> - NO RECORD FOUND -
        </div>
        <?php
    }
    ?>
    <br><br>
    <?php
    $sql_query = "SELECT TO_CHAR(RDATE,'MM-YYYY') as months,SUM(NEW_SUBS) as NSubscriber,SUM(FREE_DOWNS) as FDowns,SUM(CHARGED_DOWNS) as ChargedDowns,SUM(TOTAL_DOWNS) as TotalDowns,SUM(SUBS_CHARGED) as SubsCharged,SUM(SUBS_REV) as SubsRev,SUM(TOTAL_REV) as TotalRev,SUM(WAP_PUSHED) as WapPushed FROM REPORTS_WAP WHERE TO_CHAR(RDATE,'YYYY')='$current_date' GROUP BY TO_CHAR(RDATE,'MM-YYYY') ORDER BY TO_CHAR(RDATE,'MM-YYYY')";
    $res       = helper_exec_select_query($conn, $sql_query);
    /*
      echo '<pre>';
      print_r($res);
      echo '</pre>';
      /* */
    if (!empty($res)) {

        //if ($res) {
       echo "<br/><br/>
                  <table style='font-size:13px;' border='1' align='center' width='100%'><tr align='center' bgcolor='#999999'>
		
                <td><b> Month </b></td>
		<td width='80'><b> New Subs </b></td>
                <td width='80'><b> Free Downloads </b></td>    
                <td width='80'><b> Charged Downloads</b></td>
                <td width='80'><b>Total Downloads</b></td>
                <td width='80'><b>Subs Charged</b></td>
                <td width='80'><b>Subs Revenue</b></td>
                <td width='80'><b>Total Revenue</b></td>
                <td width='80'><b>WAP Push </b></td>
                </tr>";

        $i = 0;
        while ($res['MONTHS'][$i]) {
            if ($i % 2 == 0)
                echo "<tr align='center' valign='middle'>";
            else
                echo "<tr align='center' valign='middle' bgcolor='#CCCCCC'>";
            $j = $i + 1;
            echo "<td>" . $res['MONTHS'][$i] . "</td>
			<td >" . $res['NSUBSCRIBER'][$i] . "</td>
                        <td >" . $res['FDOWNS'][$i] . "</td>
                        <td >" . $res['CHARGEDDOWNS'][$i] . "</td>
                        <td >" . $res['TOTALDOWNS'][$i] . "</td> 
                        <td >" . $res['SUBSCHARGED'][$i] . "</td>
                        <td >" . $res['SUBSREV'][$i] . "</td> 
                        <td >" . $res['TOTALREV'][$i] . "</td> 
                        <td >" . $res['WAPPUSHED'][$i] . "</td> 
                            
		</tr>";
            $i++;
        }

        echo '</table>';
    }else {
        ?>
        <div style="width:100%; text-align:center">
            <br/><br/><br/> - NO RECORD FOUND -
        </div>
        <?php
    }
    ?>


    <br><br>

    <?php
    $sql_query = "SELECT SERVICE_NAME,SUM(NEW_SUBS) as NSubscriber,SUM(FREE_DOWNS) as FDowns,SUM(CHARGED_DOWNS) as ChargedDowns,SUM(TOTAL_DOWNS) as TotalDowns,SUM(SUBS_CHARGED) as SubsCharged,SUM(SUBS_REV) as SubsRev,SUM(TOTAL_REV) as TotalRev,SUM(WAP_PUSHED) as WapPushed FROM REPORTS_WAP WHERE TO_CHAR(RDATE,'YYYY')='$current_date' GROUP BY SERVICE_NAME ORDER BY SERVICE_NAME";
    //echo '....>'.$daily_query;
    $res       = helper_exec_select_query($conn, $sql_query);
    if (!empty($res)) {

        //if ($res) {
        echo "<br/><br/>
                  <table style='font-size:13px;'  border='1' align='center' width='100%'><tr align='center' bgcolor='#999999'>
		<td><b> Service Name </b></td>
		<td width='80'><b> New Subs </b></td>
                <td width='80'><b> Free Downloads </b></td>    
                <td width='80'><b> Charged Downloads</b></td>
                <td width='80'><b>Total Downloads</b></td>
                <td width='80'><b>Subs Charged</b></td>
                <td width='80'><b>Subs Revenue</b></td>
                <td width='80'><b>Total Revenue</b></td>
                <td width='80'><b>WAP Push </b></td>
                </tr>";

        $i = 0;
        while ($res['SERVICE_NAME'][$i]) {
            if ($i % 2 == 0)
                echo "<tr align='center' valign='middle'>";
            else
                echo "<tr align='center' valign='middle' bgcolor='#CCCCCC'>";
            $j = $i + 1;
            echo "<td>" . $res['SERVICE_NAME'][$i] . "</td>
			<td >" . $res['NSUBSCRIBER'][$i] . "</td>
                        <td >" . $res['FDOWNS'][$i] . "</td>
                        <td >" . $res['CHARGEDDOWNS'][$i] . "</td>
                        <td >" . $res['TOTALDOWNS'][$i] . "</td> 
                        <td >" . $res['SUBSCHARGED'][$i] . "</td>
                        <td >" . $res['SUBSREV'][$i] . "</td> 
                        <td >" . $res['TOTALREV'][$i] . "</td> 
                        <td >" . $res['WAPPUSHED'][$i] . "</td> 
                            
		</tr>";
            $i++;
        }

        echo '</table>';
    }else {
        ?>
        <div style="width:100%; text-align:center">
            <br/><br/><br/> - NO RECORD FOUND -
        </div>
        <?php
    }
    ?>
    <br><br>
    <?php
    $sql_query = "SELECT OPERATOR,SUM(NEW_SUBS) as NSubscriber,SUM(FREE_DOWNS) as FDowns,SUM(CHARGED_DOWNS) as ChargedDowns,SUM(TOTAL_DOWNS) as TotalDowns,SUM(SUBS_CHARGED) as SubsCharged,SUM(SUBS_REV) as SubsRev,SUM(TOTAL_REV) as TotalRev,SUM(WAP_PUSHED) as WapPushed FROM REPORTS_WAP WHERE TO_CHAR(RDATE,'YYYY')='$current_date' GROUP BY OPERATOR ORDER BY OPERATOR";
    $res       = helper_exec_select_query($conn, $sql_query);
    /*
      echo '<pre>';
      print_r($res);
      echo '</pre>';
      /* */
    if (!empty($res)) {

        //if ($res) {
       echo "<br/><br/>
                  <table style='font-size:13px;' border='1' align='center' width='100%'><tr align='center' bgcolor='#999999'>
		<td><b> Operator </b></td>
		<td width='80'><b> New Subs </b></td>
                <td width='80'><b> Free Downloads </b></td>    
                <td width='80'><b> Charged Downloads</b></td>
                <td width='80'><b>Total Downloads</b></td>
                <td width='80'><b>Subs Charged</b></td>
                <td width='80'><b>Subs Revenue</b></td>
                <td width='80'><b>Total Revenue</b></td>
                <td width='80'><b>WAP Push </b></td>
                </tr>";

        $i = 0;
        while ($res['OPERATOR'][$i]) {
            if ($i % 2 == 0)
                echo "<tr align='center' valign='middle'>";
            else
                echo "<tr align='center' valign='middle' bgcolor='#CCCCCC'>";
            $j = $i + 1;
            echo "<td>" . $res['OPERATOR'][$i] . "</td>
			<td >" . $res['NSUBSCRIBER'][$i] . "</td>
                        <td >" . $res['FDOWNS'][$i] . "</td>
                        <td >" . $res['CHARGEDDOWNS'][$i] . "</td>
                        <td >" . $res['TOTALDOWNS'][$i] . "</td> 
                        <td >" . $res['SUBSCHARGED'][$i] . "</td>
                        <td >" . $res['SUBSREV'][$i] . "</td> 
                        <td >" . $res['TOTALREV'][$i] . "</td> 
                        <td >" . $res['WAPPUSHED'][$i] . "</td> 
                            
		</tr>";
            $i++;
        }

        echo '</table>';
    }
    helper_logout($conn);
    ?>
</div>

</div>

</body>
</html>

