<?php 
 session_start(); 
 $flockget = $_SESSION['flock']; 
 $breedi = $_SESSION['breedi'] ;
 $var = 0;
 foreach($_SESSION['fbweight'] as $k=>$v) 
 { 
   $arrage[$var] = $k;
  // $maxage = $k;
   $var = $var+1;
 } 
  sort($arrage);
 $ll = count($arrage);
 $maxage = $arrage[$ll-1]; 
?>

<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=us-ascii">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 12">
<link id=Main-File rel=Main-File href=newreport.php>
<link rel=File-List href="newreport_filelist.xml">
<!--[if !mso]>
<style>
v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
x\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style>
<![endif]-->
<link rel=Stylesheet href="newreport_stylesheet.css">
<style>
<!--table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
@page
	{margin:1.0in .75in 1.0in .75in;
	mso-header-margin:.5in;
	mso-footer-margin:.5in;}
-->
</style>
<![if !supportTabStrip]><script language="JavaScript">
<!--
function fnUpdateTabs()
 {
  if (parent.window.g_iIEVer>=4) {
   if (parent.document.readyState=="complete"
    && parent.frames['frTabs'].document.readyState=="complete")
   parent.fnSetActiveSheet(10);
  else
   window.setTimeout("fnUpdateTabs();",150);
 }
}

if (window.name!="frSheet")
 window.location.replace("newreport.php");
else
 fnUpdateTabs();
//-->
</script>
<!--<![endif]>-->
<link href="flot/layout.css" rel="stylesheet" type="text/css"></link>
<!--[if IE]><script language="javascript" type="text/javascript" src="flot/excanvas.min.js"></script><![endif]-->
<script language="javascript" type="text/javascript" src="flot/jquery.js"></script>
<script language="javascript" type="text/javascript" src="flot/jquery.flot.js"></script>
<script language="javascript" type="text/javascript" src="flot/jquery.flot.dashes.js"></script>
</head>

<body link=blue vlink=purple>

<center>
  <table><tr><td style="font-size:13px"><b>Body Weight Graph For Flock <?php session_start(); echo $_SESSION['flock']; ?></b></td></tr></table>
</center>

<table border=0 cellpadding=0 cellspacing=0 width=1390 style='border-collapse:
 collapse;table-layout:fixed;width:1043pt'>
 <col width=46 style='mso-width-source:userset;mso-width-alt:1682;width:35pt'>
 <col class=xl677 width=32 style='mso-width-source:userset;mso-width-alt:1170;
 width:24pt'>
 <col class=xl674 width=32 style='mso-width-source:userset;mso-width-alt:1170;
 width:24pt'>
 <col width=64 span=20 style='width:48pt'>
 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 width=46 style='height:17.25pt;width:35pt'><h5>Female</h5></td>
  <td width=32 style='width:24pt'></td>
  <td width=32 style='width:24pt'></td>
  <td width=64 style='width:48pt'></td>
  <td colspan=11 class=xl793 width=704 style='width:528pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=64 style='width:48pt'></td>
 </tr>

 <tr height=17 style='height:12.75pt'>
  <td height=17 style='height:12.75pt'>Age</td>
  <td class=xl675>Act</td>
  <td class=xl672>Std</td>
  <td colspan=20 rowspan=37 height=629 width=1280>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td width=10 height=12></td>
   </tr>
   <tr>
    <td></td>
    <td><div id="placeholder" style="width:800px;height:800px"></div></td>
    <td width=26></td>
   </tr>
   <tr>
    <td height=1></td>
   </tr>
  </table>
  </span>
  <!--<![endif]> [if !mso & vml]><span style='width:960.0pt;height:471.75pt'></span><![endif]--></td>
 </tr>
<?php
include "../config.php";
if($breedi != "")
{
$query = "SELECT * FROM breeder_standards where breed = '$breedi' and client = '$client' ORDER BY age ASC ";
}
else
{
$query = "SELECT * FROM breeder_standards where client = '$client' ORDER BY age ASC ";
}

$result = mysql_query($query,$conn); 
while($row1 = mysql_fetch_assoc($result))
{ 
 if(in_array($row1['age'],$arrage)) {
?>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl671 style='height:12.75pt'><?php echo $age = $row1['age']; ?></td>
  <td class=xl676 align=right style="color:#00FF00"><?php if($_SESSION['fbweight'][$age] <= 0) { echo $oldfb1; } else { echo $oldfb1 = $_SESSION['fbweight'][$age]; } ?>,</td>
  <td class=xl673 align=right style="color:#006600"><?php echo $row1['fweight']; ?></td>
 </tr>
<?php } } ?>

<tr height="20px"><td></td></tr>

<tr height="17px"><td><h5>Male</h5></td></tr>

<?php
include "../config.php";
if($breedi != "")
{
$query = "SELECT * FROM breeder_standards where breed = '$breedi' and client = '$client' ORDER BY age ASC ";
}
else
{
$query = "SELECT * FROM breeder_standards where client = '$client' ORDER BY age ASC ";
}
//$query = "SELECT * FROM breeder_standards where client = '$client' ORDER BY age ASC ";
$result = mysql_query($query,$conn); 
while($row1 = mysql_fetch_assoc($result))
{ 
 if(in_array($row1['age'],$arrage)) {
?>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl671 style='height:12.75pt'><?php echo $age = $row1['age']; ?></td>
  <td class=xl676 align=right style="color:#FF9999"><?php if($_SESSION['mbweight'][$age] <= 0) { echo $oldmb1; } else { echo $oldmb1 = $_SESSION['mbweight'][$age]; } ?>,</td>
  <td class=xl673 align=right style="color:#CC0000"><?php echo $row1['mweight']; ?></td>
 </tr>
<?php } } ?>


<script id="source" language="javascript" type="text/javascript">

$(function () {

var act = [
<?php
if($breedi != "")
{
$query = "SELECT * FROM breeder_standards where breed = '$breedi' and client = '$client' and age <= '$maxage' ORDER BY age ASC ";
}
else
{
$query = "SELECT * FROM breeder_standards where client = '$client' and age <= '$maxage' ORDER BY age ASC ";
}

$result = mysql_query($query,$conn); 
while($row1 = mysql_fetch_assoc($result))
{ 
 if(in_array($row1['age'],$arrage)) {
?>

[<?php echo $age = $row1['age']; ?>,<?php if($_SESSION['fbweight'][$age] <= 0) { echo $oldfb; } else { echo $oldfb = $_SESSION['fbweight'][$age]; } ?>],
<?php } } ?>
[<?php echo $age; ?>,<?php if($_SESSION['fbweight'][$age] <= 0) { echo $oldfb; } else { echo $oldfb = $_SESSION['fbweight'][$age]; } ?>]];


var std = [
<?php
if($breedi != "")
{
$query = "SELECT * FROM breeder_standards where breed = '$breedi' and client = '$client' and age <= '$maxage' ORDER BY age ASC ";
}
else
{
$query = "SELECT * FROM breeder_standards where client = '$client' and age <= '$maxage' ORDER BY age ASC ";
}
//$query = "SELECT * FROM breeder_standards where client = '$client' and age <= '$maxage' ORDER BY age ASC ";
$result = mysql_query($query,$conn); 
while($row1 = mysql_fetch_assoc($result))
{ 
 //if(in_array($row1['age'],$arrage)) {
?>

[<?php echo $age = $row1['age']; ?>,<?php echo $row1['fweight']; ?>],
<?php //}
        } ?>
[<?php echo $age; ?>,<?php echo $row1['fweight']; ?>]];


var act1 = [
<?php
if($breedi != "")
{
$query = "SELECT * FROM breeder_standards where breed = '$breedi' and client = '$client' and age <= '$maxage' ORDER BY age ASC ";
}
else
{
$query = "SELECT * FROM breeder_standards where client = '$client' and age <= '$maxage' ORDER BY age ASC ";
}
$result = mysql_query($query,$conn); 
while($row1 = mysql_fetch_assoc($result))
{ 
 if(in_array($row1['age'],$arrage)) {
?>

[<?php echo $age = $row1['age']; ?>,<?php if($_SESSION['mbweight'][$age] <= 0) { echo $oldmb; } else { echo $oldmb = $_SESSION['mbweight'][$age]; } ?>],
<?php } } ?>
[<?php echo $age; ?>,<?php if($_SESSION['mbweight'][$age] <= 0) { echo $oldmb; } else { echo $oldmb = $_SESSION['mbweight'][$age]; } ?>]];


var std1 = [
<?php
if($breedi != "")
{
$query = "SELECT * FROM breeder_standards where breed = '$breedi' and client = '$client' and age <= '$maxage' ORDER BY age ASC ";
}
else
{
$query = "SELECT * FROM breeder_standards where client = '$client' and age <= '$maxage' ORDER BY age ASC ";
}
$result = mysql_query($query,$conn); 
while($row1 = mysql_fetch_assoc($result))
{ 
 //if(in_array($row1['age'],$arrage)) {
?>

[<?php echo $age = $row1['age']; ?>,<?php echo $row1['mweight']; ?>],
<?php //}
        } ?>
[<?php echo $age; ?>,<?php echo $row1['mweight']; ?>]];


<!-- , dashes: { show: true }, hoverable: true  -->

            var plot =   $.plot($("#placeholder"),
           [ { data: act, Label: 'Female Actual', color:'#00FF00',yaxis: 1 },
             { data: std, Label: 'Female Standard', color:'#006600', yaxis: 1 },
             { data: act1, Label: 'Male Actual', color:'#FF9999',yaxis: 2 },
             { data: std1, Label: 'Male Standard', color:'#CC0000',yaxis: 2 }],
           { 
            lines: { show: true },
            points: { show: true },
             grid: { hoverable: true, clickable: true },
             xaxis: { min: 0,tickSize: 2,max:<?php echo $maxage; ?>,label: "test"},
             yaxis: { min: 0, tickSize: 200, max:5400 },
             legend: { margin: [660,280] } 
    });
 
    function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css( {
            position: 'absolute',
            display: 'none',
            top: y + 5,
            left: x + 5,
            border: '1px solid #fdd',
            padding: '2px',
            'background-color': '#fee',
            opacity: 0.80
        }).appendTo("body").fadeIn(200);
    }

    var previousPoint = null;
    $("#placeholder").bind("plothover", function (event, pos, item) {
        $("#x").text(pos.x.toFixed(2));
        $("#y").text(pos.y.toFixed(2));

        if (1) {
            if (item) {
                if (previousPoint != item.datapoint) {
                    previousPoint = item.datapoint;
                    
                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(0),
                        y = item.datapoint[1].toFixed(2);
                    
                    showTooltip(item.pageX, item.pageY,
                                item.series.Label +" for " + x + " Weeks " + " is " + y);
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;            
            }
        }
    });

    $("#placeholder").bind("plotclick", function (event, pos, item) {
        if (item) {
            $("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
            plot.highlight(item.series, item.datapoint);
        }
    });
});



</script>

 <tr height=0 style='display:none'>
  <td class=xl671>61</td>
  <td class=xl676 align=right>57.6</td>
  <td class=xl673 align=right>58.0</td>
  <td colspan=20 style='mso-ignore:colspan'></td>
 </tr>
</table>

</body>

</html>


