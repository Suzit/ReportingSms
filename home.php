<?php
error_reporting(0);
include 'header.php';
?>
<div id="content">
    <table style="width:100%">
        <tr>
            <th>
                <select name="Organization" id="org">
                    <option selected value="all"  >Select Organization</option>
                    <option value="T2M">T2M</option>
                    <option value="VasPro">VAS PRO</option>
                    <option value="ZIPIT">ZIP IT</option>

                </select>
            </th>
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
            <td> &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" id="btn" name="btn" onclick="view_report();" value="Submit"></input></td>
        </tr>



    </table>
    <br>
    <!-- </form> -->
    <?php
    echo '<iframe name="iframe1" width="900" height="550" src="homedb.php" frameborder="1" scrolling="yes" > </iframe>';
    ?>
</div>
<script type="text/javascript">



    function view_report()
    {
        //alert('JJJJJJJJJJJJJJJJjj');
        //var singledate = document.getElementById("datepicker").value;
        // var singledate2 = document.getElementById("datepicker2").value;
        var operators = document.getElementById("operators").value;
        var service_type = document.getElementById("service_type").value;
        var org = document.getElementById("org").value;
        loc = "homedb.php?operators=" + operators + "&service_type=" + service_type + "&org=" + org;

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