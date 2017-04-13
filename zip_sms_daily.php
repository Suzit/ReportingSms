<?php
include ('db.php');
include('header.php');


$current_date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

$next_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
// echo $next_date;
$prev_date = date('Y-m-d', strtotime($current_date . ' -1 day'));
//list($d, $m, $y) = explode('-', date("m-d-Y", strtotime($current_date)));
$r_date    = date("m-d-Y", strtotime($current_date));
//echo $r_date;
$daily_query="SELECT SERVICE_NAME,SERVICE_TYPE,OPERATOR,SHORTCODE,NEW_SUBS,TOTAL_SUBS,NEW_CHURN,TOTAL_CHURN,TOTAL_BASE,RDATE,KEYWORD,MO,MT FROM REPORTS_SMS_ZIP WHERE trunc(RDATE)=TO_DATE('{$r_date}','MM-DD-YYYY') ORDER BY trunc(RDATE)";
$result = helper_exec_select_query($conn, $daily_query);
$sql_query = "SELECT SERVICE_NAME,SUM(NEW_SUBS) as NSubscriber,SUM(NEW_CHURN) as NChurn,SUM(TOTAL_SUBS) as SumSubscriber,SUM(MO) as Mob,SUM(MT) as MsgTermination FROM REPORTS_SMS_ZIP WHERE trunc(RDATE)=TO_DATE('{$r_date}','MM-DD-YYYY') GROUP BY SERVICE_NAME ORDER BY  SERVICE_NAME";
//echo '....>'.$sql_query;
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
		<td><b> Service Name </b></td>
                <td><b> Service Type </b></td>
                <td><b> Operator </b></td>
                <td width='100'><b> Shortcode </b></td>
		<td width='100'><b> New Subs </b></td>
                <td width='100'><b> Total Subs</b></td>
                <td width='100'><b> New Churn </b></td> 
                <td width='100'><b> Total Churn </b></td> 
                <td width='100'><b> Total Base </b></td> 
                <td width='100'><b>Date</b></td>
                <td width='100'><b>Keyword</b></td>
                <td width='100'><b>MO</b></td>
                <td width='100'><b>MT</b></td>
                </tr>";

        $i = 0;
        while ($result['SERVICE_NAME'][$i]) {
            if ($i % 2 == 0)
                echo "<tr align='center' valign='middle'>";
            else
                echo "<tr align='center' valign='middle' bgcolor='#CCCCCC'>";
            $j = $i + 1;
            echo "<td>" . $result['SERVICE_NAME'][$i] . "</td>
			<td >" . $result['SERVICE_TYPE'][$i] . "</td>
                        <td >" . $result['OPERATOR'][$i] . "</td>
                        <td >" . $result['SHORTCODE'][$i] . "</td>
                        <td >" . $result['NEW_SUBS'][$i] . "</td> 
                        <td >" . $result['TOTAL_SUBS'][$i] . "</td> 
                        <td >" . $result['NEW_CHURN'][$i] . "</td> 
                        <td >" . $result['TOTAL_CHURN'][$i] . "</td> 
                        <td >" . $result['TOTAL_BASE'][$i] . "</td> 
                        <td >" . $result['RDATE'][$i] . "</td> 
                        <td >" . $result['KEYWORD'][$i] . "</td>
                        <td >" . $result['MO'][$i] . "</td>
                        <td >" . $result['MT'][$i] . "</td>    
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
		<td width='100'><b> New Subs </b></td>
                <td width='100'><b> New Churn </b></td>    
                <td width='100'><b> Total Subs</b></td>
                <td width='100'><b>MO</b></td>
                <td width='100'><b>MT</b></td>
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
                        <td >" . $res['NCHURN'][$i] . "</td>
                        <td >" . $res['SUMSUBSCRIBER'][$i] . "</td>
                        <td >" . $res['MOB'][$i] . "</td> 
                        <td >" . $res['MSGTERMINATION'][$i] . "</td>    
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
    $sql_query = "SELECT OPERATOR,SUM(NEW_SUBS) as Total_Sub,SUM(NEW_CHURN) as Total_Churn,SUM(TOTAL_SUBS) as SumSubscriber,SUM(MO) as Mob,SUM(MT) as MsgTermination FROM REPORTS_SMS_ZIP WHERE trunc(RDATE)=TO_DATE('{$r_date}','MM-DD-YYYY') GROUP BY OPERATOR ORDER BY OPERATOR";
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
		<td width='100'><b> New Subs </b></td>
                <td width='100'><b> New Churn </b></td>    
                <td width='100'><b>Total Subs</b></td>
                <td width='100'><b>MO</b></td>
                <td width='100'><b>MT</b></td>        
                </tr>";

        $i = 0;
        while ($res['OPERATOR'][$i]) {
            if ($i % 2 == 0)
                echo "<tr align='center' valign='middle'>";
            else
                echo "<tr align='center' valign='middle' bgcolor='#CCCCCC'>";
            $j = $i + 1;
            echo "<td>" . $res['OPERATOR'][$i] . "</td>
			<td >" . $res['TOTAL_SUB'][$i] . "</td>
                        <td >" . $res['TOTAL_CHURN'][$i] . "</td>
                        <td >" . $res['SUMSUBSCRIBER'][$i] ."</td>
                        <td >" . $res['MOB'][$i] . "</td> 
                        <td >" . $res['MSGTERMINATION'][$i] . "</td>      
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

