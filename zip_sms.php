<?php
error_reporting(0);
include 'db.php';
include 'header.php';
$query_sel = "select * from REPORTS_SMS_ZIP";
$res       = helper_exec_select_query($conn, $query_sel);
helper_logout($conn);
?>


<div id="content">
    <table style="width:100%">
        <tr>

            <th>
                <select name="operators" id="operators">
                    <option selected value=""  >Select Operator</option>
                    <option value="GP">GP</option>

                    <option value="Robi">Robi</option>
                    <option value="BLink">BLink</option>
                    <option value="T.Talk">TTalk</option>
                    <option value="Airtel">Airtel</option>

                </select>

            </th>
            <th><select name="service_type" id="service_type">
                    <option value="" >Select Service Type</option>
                    <option value="SMS">SMS</option>
                    <option value="WAP">WAP</option>
                </select></th>

            <th>
                <select name="services" id="services">
                    <option  value=""  name="servicename">Select Service Name</option>
                    <?php
                    if ($res)
                        $i         = 0;
                    while ($res['SERVICE_NAME'][$i]) {
                        $serviceName = $res['SERVICE_NAME'][$i];
                        ?>
                        <option value="<?php echo $serviceName; ?>"><?php echo $serviceName; ?></option>
                        <?php
                        $i++;
                    }
                    ?>
                </select>
            </th>
        </tr>

        <tr>
            <td>

                &nbsp;&nbsp;&nbsp;&nbsp;    <input type="radio" name="radAnswer" value="date" checked>Single Date<br>
                &nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="radAnswer" value="date2">Date Range

            </td>
            <td> Date From: <input type="text" id="datepicker" name="datepicker"></input>&nbsp;&nbsp;&nbsp;&nbsp;

                To: <input type="text" id="datepicker2" name="datepicker2"></input> </td>
            <td> &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" id="btn" name="btn" onclick="view_report();" value="Submit"></input></td>
        </tr>


    </table>
    <!-- </form> -->
    <?php
    echo '<iframe name="iframe1" width="900" height="550" src="zipsmsdb.php" frameborder="1" scrolling="yes" > </iframe>';
    ?>
</div>
<script type="text/javascript">

    $(function() {
        /*
         $(document).ready(function() {
         alert('KKKKKKKKKKKKKKKK');
         });
         */
        $("#datepicker").datepicker();

    });
    $(function() {
        $("#datepicker2").datepicker();
    });



    function view_report()
    {
        //alert('JJJJJJJJJJJJJJJJjj');
        var singledate = document.getElementById("datepicker").value;
        var singledate2 = document.getElementById("datepicker2").value;
        var operators = document.getElementById("operators").value;
        var service_type = document.getElementById("service_type").value;
        var services = document.getElementById("services").value;
        loc = "zipsmsdb.php?sdate=" + singledate + "&fdate=" + singledate2 + "&operators=" + operators + "&service_type=" + service_type + "&services=" + services;

        target = "iframe1";
        land_iframe(loc, target);
    }

    function land_iframe(ref, target)
    {  // alert('JJJJJJJJJJJJJJJJjj');
        //alert(ref + " :::: " + target);
        lowtarget = target.toLowerCase();


        if (lowtarget == "_self") {
            window.location = ref;
        }

        else
        {
            if (lowtarget == "_top")
            {
                top.location = ref;
            }
            else
            {
                if (lowtarget == "_blank")
                {
                    window.open(ref);
                }
                else
                {
                    if (lowtarget == "_parent")
                    {
                        parent.location = ref;
                    }
                    else {
                        parent.frames[target].location = ref;
                    }

                }
            }
        }
    }
</script>
</body>
</html> 