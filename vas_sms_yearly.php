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
    $sql_query = "SELECT OPERATOR,TO_CHAR(RDATE,'MM-YYYY') as months, SUM(NEW_SUBS) as Total_Sub, SUM(NEW_CHURN) as Total_Churn  FROM REPORTS_SMS_VASPRO WHERE TO_CHAR(RDATE,'YYYY')='$current_date' GROUP BY TO_CHAR(RDATE,'MM-YYYY'),OPERATOR ORDER BY OPERATOR";
    $res       = helper_exec_select_query($conn, $sql_query); //echo $sql_query ;
    /*
      echo '<pre>';
      print_r($res);
      echo '</pre>';
     */
    if (!empty($res)) {

        //if ($res) {
        echo "<br/><br/>
                    <table style='font-size:13px;' border='1'  align='center' width='100%'><tr align='center' bgcolor='#999999'>
		<td><b> Operator </b></td>
                <td width='100'><b> Date </b></td>
		<td width='100'><b> New Subs </b></td>
                <td width='100'><b> New Churn </b></td>    
               
                        
                </tr>";

        $i = 0;
        while ($res['OPERATOR'][$i]) {
            if ($i % 2 == 0)
                echo "<tr align='center' valign='middle'>";
            else
                echo "<tr align='center' valign='middle' bgcolor='#CCCCCC'>";
            $j = $i + 1;
            echo "<td>" . $res['OPERATOR'][$i] . "</td>
                        <td >" . $res['MONTHS'][$i] . "</td>
			<td >" . $res['TOTAL_SUB'][$i] . "</td>
                        <td >" . $res['TOTAL_CHURN'][$i] . "</td>
  
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
    $sql_query = "SELECT TO_CHAR(RDATE,'MM-YYYY') as months, SUM(NEW_SUBS) as Total_Sub, SUM(NEW_CHURN) as Total_Churn  FROM REPORTS_SMS_VASPRO WHERE TO_CHAR(RDATE,'YYYY')='$current_date' GROUP BY TO_CHAR(RDATE,'MM-YYYY') ORDER BY TO_CHAR(RDATE,'MM-YYYY')";
    $res       = helper_exec_select_query($conn, $sql_query); //echo $sql_query ;
    /*
      echo '<pre>';
      print_r($res);
      echo '</pre>';
     */
    if (!empty($res)) {

        //if ($res) {
        echo "<br/><br/>
                    <table style='font-size:13px;' border='1' align='center' width='100%'><tr align='center' bgcolor='#999999'>
		<td><b> Months </b></td>
		<td width='100'><b> New Subs </b></td>
                <td width='100'><b> New Churn </b></td>    
               
                        
                </tr>";

        $i = 0;
        while ($res['MONTHS'][$i]) {
            if ($i % 2 == 0)
                echo "<tr align='center' valign='middle'>";
            else
                echo "<tr align='center' valign='middle' bgcolor='#CCCCCC'>";
            $j = $i + 1;
            echo "<td>" . $res['MONTHS'][$i] . "</td>
			<td >" . $res['TOTAL_SUB'][$i] . "</td>
                        <td >" . $res['TOTAL_CHURN'][$i] . "</td>
  
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
$sql_query3 = "SELECT SERVICE_NAME,SUM(NEW_SUBS) as Total_Sub,SUM(NEW_CHURN) as Total_Churn FROM REPORTS_SMS_VASPRO WHERE TO_CHAR(RDATE,'YYYY')='$current_date' GROUP BY SERVICE_NAME ORDER BY SERVICE_NAME";
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
		<td><b> Service Name </b></td>
		<td width='100'><b> New Subs </b></td>
                <td width='100'><b> New Churn </b></td>    
               
                        
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
                        <td>" . $res['TOTAL_CHURN'][$i] . "</td>
  
		</tr>";
        $i++;
    }

    echo '</table>';
}
?>
    <br><br>
    <?php
    $sql_query = "SELECT OPERATOR,SUM(NEW_SUBS) as Total_Sub,SUM(NEW_CHURN) as Total_Churn FROM REPORTS_SMS_VASPRO WHERE TO_CHAR(RDATE,'YYYY')='$current_date' GROUP BY OPERATOR ORDER BY OPERATOR";
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

