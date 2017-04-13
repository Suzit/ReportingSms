<?php
include ('db.php');
include('header.php');


$current_date = isset($_GET['date']) ? $_GET['date'] : date('Y-m');

$next_date = date('Y-m', strtotime($current_date . ' +1 month'));
// echo $next_date;
$prev_date = date('Y-m', strtotime($current_date . ' -1 month'));

$r_date = date("m-Y", strtotime($current_date));
//echo $r_date;
$daily_query="SELECT SERVICE_NAME,SERVICE_TYPE,OPERATOR,SHORTCODE,NEW_SUBS,TOTAL_SUBS,FREE_DOWNS,CHARGED_DOWNS,TOTAL_DOWNS,RDATE,SUBS_REV,SUBS_CHARGED,SUBS_REV,TOTAL_REV,WAP_PUSHED FROM REPORTS_WAP WHERE TO_CHAR(RDATE,'MM-YYYY')='$r_date' ORDER BY trunc(RDATE)";
$result = helper_exec_select_query($conn, $daily_query);
$sql_query = "SELECT SERVICE_NAME,SUM(NEW_SUBS) as NSubscriber,SUM(FREE_DOWNS) as FDowns,SUM(CHARGED_DOWNS) as ChargedDowns,SUM(TOTAL_DOWNS) as TotalDowns,SUM(SUBS_CHARGED) as SubsCharged,SUM(SUBS_REV) as SubsRev,SUM(TOTAL_REV) as TotalRev,SUM(WAP_PUSHED) as WapPushed FROM REPORTS_WAP WHERE TO_CHAR(RDATE,'MM-YYYY')='$r_date' GROUP BY SERVICE_NAME ORDER BY SERVICE_NAME";
//echo '....>'.$daily_query;
$res       = helper_exec_select_query($conn, $sql_query);
/*
  echo '<pre>';
  print_r($res);
  echo '</pre>';
 */
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
    if($result){
        echo "<br/><br/>
                  <table style='font-size:13px;' border='1' align='center' width='100%'><tr align='center' bgcolor='#999999'>
                <td width='80'><b>Date</b></td>		
                <td><b> Service Name </b></td>
                <td width='80'><b> Service Type </b></td>
                <td width='80'><b> Operator </b></td>
                <td width='80'><b> Short-Code </b></td>
		<td width='80'><b> New Subs </b></td>
                <td width='80'><b> Total Subs</b></td>
                <td width='80'><b> Free Downloads </b></td> 
                <td width='80'><b> Charged Downloads </b></td> 
                <td width='80'><b> Total Downloads </b></td> 
                <td width='80'><b>Subs Charged</b></td>
                <td width='80'><b>Subs Revenue</b></td>
                <td width='80'><b>Total Revenue</b></td>
                <td width='80'><b>Wap Pushed</b></td>
                
                </tr>";

        $i = 0;
        while ($result['SERVICE_NAME'][$i]) {
            if ($i % 2 == 0)
                echo "<tr align='center' valign='middle'>";
            else
                echo "<tr align='center' valign='middle' bgcolor='#CCCCCC'>";
            $j = $i + 1;
            echo "<td>"        . $result['RDATE'][$i] . "</td> 
                        <td>"  . $result['SERVICE_NAME'][$i] . "</td>
			<td >" . $result['SERVICE_TYPE'][$i] . "</td>
                        <td >" . $result['OPERATOR'][$i] . "</td>
                        <td >" . $result['SHORTCODE'][$i] . "</td>
                        <td >" . $result['NEW_SUBS'][$i] . "</td> 
                        <td >" . $result['TOTAL_SUBS'][$i] . "</td> 
                        <td >" . $result['FREE_DOWNS'][$i] . "</td> 
                        <td >" . $result['CHARGED_DOWNS'][$i] . "</td> 
                        <td >" . $result['TOTAL_DOWNS'][$i] . "</td> 
                        <td >" . $result['SUBS_CHARGED'][$i] . "</td> 
                        <td >" . $result['SUBS_REV'][$i] . "</td>
                        <td >" . $result['TOTAL_REV'][$i] . "</td>
                        <td >" . $result['WAP_PUSHED'][$i] . "</td> 
                        
		</tr>";
            $i++;
        }

        echo '</table>';
    }
    
    
    ?>

    <?php
    if (!empty($res)) {

        //if ($res) {
        echo "<br/><br/>
                  <table style='font-size:13px;' border='1' align='center' width='100%'><tr align='center' bgcolor='#999999'>
		<td><b> Service <br> Name </b></td>
		<td><b> New Subs </b></td>
                <td><b> Free Downloads </b></td>    
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
    <br><br/>
    <?php
    $sql_query = "SELECT OPERATOR,SUM(NEW_SUBS) as NSubscriber,SUM(FREE_DOWNS) as FDowns,SUM(CHARGED_DOWNS) as ChargedDowns,SUM(TOTAL_DOWNS) as TotalDowns,SUM(SUBS_CHARGED) as SubsCharged,SUM(SUBS_REV) as SubsRev,SUM(TOTAL_REV) as TotalRev,SUM(WAP_PUSHED) as WapPushed FROM REPORTS_WAP WHERE TO_CHAR(RDATE,'MM-YYYY')='$r_date' GROUP BY OPERATOR ORDER BY OPERATOR";
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
		<td><b> New Subs </b></td>
                <td><b> Free Downloads </b></td>    
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
    ?>
    <br><br/>
     <?php
    $sql_query = "SELECT trunc(RDATE),SUM(NEW_SUBS) as NSubscriber,SUM(FREE_DOWNS) as FDowns,SUM(CHARGED_DOWNS) as ChargedDowns,SUM(TOTAL_DOWNS) as TotalDowns,SUM(SUBS_CHARGED) as SubsCharged,SUM(SUBS_REV) as SubsRev,SUM(TOTAL_REV) as TotalRev,SUM(WAP_PUSHED) as WapPushed FROM REPORTS_WAP WHERE TO_CHAR(RDATE,'MM-YYYY')='$r_date' GROUP BY trunc(RDATE) ORDER BY trunc(RDATE)";
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
		<td><b> Date </b></td>
		<td><b> New Subs </b></td>
                <td><b> Free Downloads </b></td>    
                <td width='80'><b> Charged Downloads</b></td>
                <td width='80'><b>Total Downloads</b></td>
                <td width='80'><b>Subs Charged</b></td>
                <td width='80'><b>Subs Revenue</b></td>
                <td width='80'><b>Total Revenue</b></td>
                <td width='80'><b>WAP Push </b></td>
                </tr>";

        $i = 0;
        while ($res['TRUNC(RDATE)'][$i]) {
            if ($i % 2 == 0)
                echo "<tr align='center' valign='middle'>";
            else
                echo "<tr align='center' valign='middle' bgcolor='#CCCCCC'>";
            $j = $i + 1;
            echo "<td>" . $res['TRUNC(RDATE)'][$i] . "</td>
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

