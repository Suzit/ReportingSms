<?php
error_reporting(0);
include ('db.php');
include('header.php');

$current_date = isset($_GET['date']) ? $_GET['date'] : date('Y-m');

$next_date = date('Y-m', strtotime($current_date . ' +1 month'));
// echo $next_date;
$prev_date = date('Y-m', strtotime($current_date . ' -1 month'));

$r_date = date("m-Y", strtotime($current_date));
//echo $r_date;
//$sql_query = "SELECT * FROM REPORTS_SMS2 WHERE trunc(RDATE)= TO_DATE('{$r_date}','MM-YYYY') ";
$sql_query = "SELECT OPERATOR,trunc(RDATE),SUM(NEW_SUBS) as Total_Sub,SUM(NEW_CHURN) as Total_Churn,SUM(MO) as Mob,SUM(MT) as MsgTermination,SUM(TOTAL_SUBS) as TotalSubs FROM REPORTS_SMS WHERE TO_CHAR(RDATE,'MM-YYYY')='$r_date' GROUP BY OPERATOR,trunc(RDATE) ORDER BY trunc(RDATE)";
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
echo '<br><br>';
if ($res) {
    echo "<table style='font-size:13px;' border='1' align='center' width='100%'><tr align='center' bgcolor='#999999'>
		<td><b> Date </b></td>
                <td><b> Operator </b></td>
		<td><b> New Subs </b></td>
                <td width='100'><b> Total Subs </b></td>
                <td width='100'><b> New Churn </b></td>
                <td width='100'><b> MO </b></td>
                <td width='100'><b> MT </b></td>
                
               
	</tr>";
    $i = 0;
    while ($res['OPERATOR'][$i]) {
        if ($i % 2 == 0)
            echo "<tr align='center' valign='middle'>";
        else
            echo "<tr align='center' valign='middle' bgcolor='#CCCCCC'>";
        $j = $i + 1;
        echo "<td>" . $res['TRUNC(RDATE)'][$i] . "</td>
                        <td>" . $res['OPERATOR'][$i] . "</td>
                        <td>" . $res['TOTAL_SUB'][$i] . "</td>
                        <td>" . $res['TOTALSUBS'][$i] . "</td>
                        <td>" . $res['TOTAL_CHURN'][$i] . "</td>
                        <td>" . $res['MOB'][$i] . "</td>
                        <td>" . $res['MSGTERMINATION'][$i] . "</td>
                       
                       
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
    $query2 = "SELECT  trunc(RDATE),SUM(MO) as Mob,SUM(MT) as MsgTermination,SUM(NEW_SUBS) as Total_Sub,SUM(NEW_CHURN) as Total_Churn,SUM(TOTAL_SUBS) as TotalSubs FROM REPORTS_SMS WHERE TO_CHAR(RDATE,'MM-YYYY')='$r_date' GROUP BY trunc(RDATE) ORDER BY trunc(RDATE)";

    $res = helper_exec_select_query($conn, $query2);
    /*
      echo '<pre>';
      print_r($res);
      echo '</pre>';
      /* */
    if ($res) {

        //if ($res) {
        echo "<br/><br/>
              <table style='font-size:13px;' border='1' align='center' width='100%'><tr align='center' bgcolor='#999999'>
	      <td><b> Date </b></td>
	      <td><b> New Subs </b></td>
              <td width='100'><b> New Churn </b></td>    
              <td width='100'><b>Total Subs</b></td>
              <td width='100'><b>MO</b></td>
              <td width='100'><b>MT</b></td>         
                </tr>";

        $i = 0;
        while ($res['TRUNC(RDATE)'][$i]) {
            if ($i % 2 == 0)
                echo "<tr align='center' valign='middle'>";
            else
                echo "<tr align='center' valign='middle' bgcolor='#CCCCCC'>";
            $j = $i + 1;
            echo "<td>" . $res['TRUNC(RDATE)'][$i] . "</td>
			<td >" . $res['TOTAL_SUB'][$i] . "</td>
                        <td >" . $res['TOTAL_CHURN'][$i] . "</td>
                        <td >" . $res['TOTALSUBS'][$i] . "</td>
                        <td >" . $res['MOB'][$i] . "</td>
                        <td >" . $res['MSGTERMINATION'][$i] . "</td>    
		</tr>";
            $i++;
        }

        echo '</table>';
    }
    ?>
    <br><br/>

    <?php
    $sql_query3 = "SELECT SERVICE_NAME,SUM(NEW_SUBS) as Total_Sub,SUM(NEW_CHURN) as Total_Churn,SUM(MO) as Mob,SUM(MT) as MsgTermination FROM REPORTS_SMS WHERE TO_CHAR(RDATE,'MM-YYYY')='$r_date' GROUP BY SERVICE_NAME ORDER BY SERVICE_NAME";
    $res        = helper_exec_select_query($conn, $sql_query3);
    /*
      echo '<pre>';
      print_r($res);
      echo '</pre>';
      /* */
    if (!empty($res)) {

        //if ($res) {
        echo "<br/><br/>
                <table style='font-size:13px;' border='1' align='center' width='100%'><tr align='center' bgcolor='#999999'>
		<td><b> Service <br> Name </b></td>
		<td><b> New Subs </b></td>
                <td width='100'><b> New Churn </b></td>    
                <td width='100'><b> MO </b></td>
                <td width='100'><b> MT </b></td>        
                </tr>";

        $i = 0;
        while ($res['SERVICE_NAME'][$i]) {
            if ($i % 2 == 0)
                echo "<tr align='center' valign='middle'>";
            else
                echo "<tr align='center' valign='middle' bgcolor='#CCCCCC'>";
            $j = $i + 1;
            echo "<td>" . $res['SERVICE_NAME'][$i] . "</td>
			<td >" . $res['TOTAL_SUB'][$i] . "</td>
                        <td >" . $res['TOTAL_CHURN'][$i] . "</td>
                        <td >" .$res['MOB'][$i] ."</td>
                        <td >" .$res['MSGTERMINATION'][$i] ."</td>    
		</tr>";
            $i++;
        }

        echo '</table>';
    }
    ?>
    <br><br>
    <?php
    $sql_query = "SELECT OPERATOR,SUM(NEW_SUBS) as Total_Sub,SUM(NEW_CHURN) as Total_Churn,SUM(MO) as Mob,SUM(MT) as MsgTermination FROM REPORTS_SMS WHERE TO_CHAR(RDATE,'MM-YYYY')='$r_date' GROUP BY OPERATOR ORDER BY OPERATOR";
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
                <td width='100'><b> New Churn </b></td>    
                <td width='100'><b> MO </b></td>
                <td width='100'><b> MT </b></td>         
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
                        <td >" .$res['MOB'][$i] . "</td>
                        <td >" .$res['MSGTERMINATION'][$i] . "</td>
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

