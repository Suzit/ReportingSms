function view_report()
{
 var singledate = document.getElementById("datepicker").value;
 
 loc="db_file.php?&tdate="+singledate;
 
 target="iframe1";
 land_iframe(loc,target);
}

function land_iframe(ref, target) 
{ //alert(ref + " :::: " + target);
 lowtarget=target.toLowerCase();
 if (lowtarget=="_self") {window.location=ref;}
 else 
 {
  if (lowtarget=="_top") {top.location=ref;}
  else 
  {
   if (lowtarget=="_blank") {window.open(ref);}
   else 
   {
    if (lowtarget=="_parent") {parent.location=ref;}
    else {parent.frames[target].location=ref;};
   }
  }
 }
}