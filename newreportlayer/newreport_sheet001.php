rshi<?php session_start(); $flockget = $_SESSION['flock']; 
include "../config.php";
$query = "select * from layer_entry_procedure where client='$client'";
$result = mysql_query($query,$conn); 
while($row1 = mysql_fetch_assoc($result))
{
$entryproc = $row1['procedure'];
}
$startfemale = 0;
$startmale = 0;
$startflag = 1;
$weekflag = 1;
$breedi = $_SESSION['breedi'] ;
$query1 = "SELECT * FROM breeder_flock WHERE flockcode like '$flockget' group by startdate";
$result1 = mysql_query($query1,$conn); 
$tcount = mysql_num_rows($result1);

if($tcount > 1)
{
  $query1 = "SELECT * FROM breeder_flock WHERE flockcode like '$flockget' order by startdate asc limit 1";
  $result1 = mysql_query($query1,$conn); 
  while($row11 = mysql_fetch_assoc($result1))  
  {
      $startdate = $row11['startdate'];
      $startage = $row11['age'];
      $startfemale = $row11['femaleopening'];
      $startmale = $row11['maleopening'];
  }
}
else
{
  $query1 = "SELECT * FROM breeder_flock WHERE flockcode like '$flockget'";
  $result1 = mysql_query($query1,$conn); 
  while($row11 = mysql_fetch_assoc($result1))  
  {
      $startdate = $row11['startdate'];
      $startage = $row11['age'];
      $startfemale = $startfemale + $row11['femaleopening'];
      $startmale = $startmale + $row11['maleopening'];
  }
}



$query1 = "SELECT min(date1) as 'date1' FROM breeder_production WHERE flock like '$flockget'";
$result1 = mysql_query($query1,$conn); 
while($row11 = mysql_fetch_assoc($result1))
{
  $prodate = $row11['date1'];
}

if($prodate)
{
$prodate = $prodate;
}
else
{
$prodate = "2020-01-01";
}
//echo $prodate;
  $diffdate11 = strtotime($prodate) - strtotime($startdate);
  $diffdate11 = $diffdate11/(24*60*60);   
  $newage11 = $startage + $diffdate11;
  $nrSeconds = $newage11 * 24 * 60 * 60;
  $nrDaysPassed = floor($nrSeconds / 86400) % 7;  
  $untildate = strtotime($prodate) - ($nrDaysPassed * 60 * 24 * 24);
  $untildate = date("Y-m-d",$untildate);
?>
<?php
include "../config.php";

$r = 0;
/*$query = "SELECT * FROM ims_itemcodes where cat = 'Eggs' and client = '$client' and (iusage='Produced or Sale' OR iusage='Produced or Rejected' OR iusage='Produced or Sale or Rejected') ORDER BY code ASC ";
$result = mysql_query($query,$conn); 
while($row1 = mysql_fetch_assoc($result))
{ 
  $rejections[$r] = $row1['code'];
  $rejectionsdesc[$r] = $row1['description'];
  $r = $r + 1;
}*/

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
   parent.fnSetActiveSheet(0);
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
<![endif]>
</head>
<?php
//$query = "SELECT min(date2) as 'date2' FROM breeder_consumption WHERE flock like '' GROUP BY date2 ORDER BY date2 ASC";
$query = "SELECT min(date2) as 'date2' FROM breeder_consumption WHERE flock like '$flockget'";
$result = mysql_query($query,$conn); 
while($row1 = mysql_fetch_assoc($result))
{
 //if($row1['date2'] >= $untildate) { $norecords = 0; } else { $norecords = 1; }
 if($row1['date2'] >= $prodate) { $norecords = 0; } else { $norecords = 1; }
}
if(!$norecords)
{
 include "norecords.htm"; 
}
else
{

$querymin = "SELECT min(date2) as 'date2' FROM breeder_consumption WHERE flock like '$flockget' ";
$resultmin = mysql_query($querymin,$conn); 
while($row1min = mysql_fetch_assoc($resultmin))
{
$mincmpdate = $row1min['date2'];
}
 $femalet = 0;$malet=0;
 $query1t = "SELECT cat,quantity FROM `ims_stocktransfer` WHERE cat Like 'Birds' AND client = '$client' AND towarehouse like '' AND date<='$mincmpdate'";
  $result1t = mysql_query($query1t,$conn); 
  while($row11t = mysql_fetch_assoc($result1t))  
  {
	  $femalet = $femalet + $row11t['quantity'];
  }
   if($femalet > 0)
  {
  $startfemale = $startfemale +$femalet;
  }
 ?>

<body link=blue vlink=purple class=xl68>

<center>
  <table><tr><td style="font-size:13px"><b>Brooder/Grower Report For Flock <?php session_start(); echo $_SESSION['flock']; ?></b></td></tr></table>
</center>

<table border=0 cellpadding=0 cellspacing=0 width=1113 style='border-collapse:
 collapse;table-layout:fixed;width:839pt'>
 <col class=xl68 width=44 style='mso-width-source:userset;mso-width-alt:1609;
 width:33pt'>
 <col class=xl68 width=29 style='mso-width-source:userset;mso-width-alt:1060;
 width:22pt'>
 <col class=xl68 width=50 style='mso-width-source:userset;mso-width-alt:1572;
 width:42pt'>
 <!--<col class=xl68 width=35 style='mso-width-source:userset;mso-width-alt:1280;
 width:26pt'>-->
 <col class=xl68 width=40 span=3 style='mso-width-source:userset;mso-width-alt:
 1060;width:35pt'>
 <col class=xl68 width=46 style='mso-width-source:userset;mso-width-alt:950;
 width:40pt'>
 <!--<col class=xl68 width=31 style='mso-width-source:userset;mso-width-alt:1133;
 width:23pt'>-->
 <col class=xl68 width=50 style='mso-width-source:userset;mso-width-alt:950;
 width:45pt'>
 <col class=xl68 width=46 style='mso-width-source:userset;mso-width-alt:1682;
 width:35pt'>
 <col class=xl68 width=50 style='mso-width-source:userset;mso-width-alt:1828;
 width:38pt'>
 <col class=xl68 width=46 style='mso-width-source:userset;mso-width-alt:
 1682;width:35pt'>
  <col class=xl68 width=176 style='mso-width-source:userset;mso-width-alt:1645;
 width:174pt'>
 <col class=xl68 width=176 style='mso-width-source:userset;mso-width-alt:1645;
 width:174pt'>
 <col class=xl68 width=171 style='mso-width-source:userset;mso-width-alt:1536;
 width:172pt'>
 <col class=xl68 width=36 span=2 style='mso-width-source:userset;mso-width-alt:
 1316;width:27pt'>
 <col class=xl68 width=171 style='mso-width-source:userset;mso-width-alt:1499;
 width:171pt'>
 <col class=xl68 width=33 span=2 style='mso-width-source:userset;mso-width-alt:
 1206;width:25pt'>
 <col class=xl68 width=171 style='mso-width-source:userset;mso-width-alt:6253;
 width:128pt'>
 <col class=xl68 width=103 style='mso-width-source:userset;mso-width-alt:3766;
 width:77pt'>
 <col class=xl127 width=64 style='mso-width-source:userset;mso-width-alt:2340;
 width:48pt'>
 <col class=xl68 width=0 span=232 style='display:none'>
 <tr class=xl68 height=19 style='mso-height-source:userset;height:14.25pt'>
  <td colspan=13 height=19 class=xl704 width=946 style='height:14.25pt;
  width:714pt'><a name="Print_Area">&nbsp;</a></td>
  <td class=xl686 width=103 style='border-left:none;width:77pt'>&nbsp;</td>
  <td class=xl127 width=64 style='border-left:none;width:48pt'>&nbsp;</td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
  <td class=xl68 width=0></td>
 </tr>
 <tr class=xl68 height=19 style='mso-height-source:userset;height:14.25pt'>
  <td colspan=13 height=19 class=xl705 style='height:14.25pt'>Daily
  Reports<span style='mso-spacerun:yes'>&nbsp;</span></td>
  <td class=xl686 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl127 style='border-left:none'>&nbsp;</td>
  <td colspan=232 class=xl68 style='mso-ignore:colspan'></td>
 </tr>
 <tr class=xl68 height=19 style='mso-height-source:userset;height:14.25pt'>
  <td height=19 class=xl70 style='height:14.25pt'>&nbsp;</td>
  <td colspan=2 class=xl69>Birds&nbsp;&nbsp;  =</td>
  <td colspan=1 class=xl69> <?php echo $startfemale; ?></td>
  <?php /*?><td colspan=2 class=xl69>M= <?php echo $startmale; ?></td><?php */?>
  <td colspan=17 class=xl69 style='mso-ignore:colspan'>&nbsp;</td>
  <td class=xl102></td>
  <td class=xl127>&nbsp;</td>
  <td colspan=232 class=xl68 style='mso-ignore:colspan'></td>
 </tr>
 <tr class=xl68 height=2 style='mso-height-source:userset;height:1.5pt'>
  <td height=2 class=xl71 colspan=2 style='height:1.5pt;mso-ignore:colspan'>Hen
  Housed</td>
  <td class=xl69>&nbsp;</td>
  <td class=xl70>F</td>
  <td colspan=2 class=xl70>5500</td>
  <td colspan=16 class=xl69 style='mso-ignore:colspan'>&nbsp;</td>
  <td class=xl102></td>
  <td class=xl127>&nbsp;</td>
  <td colspan=232 class=xl68 style='mso-ignore:colspan'></td>
 </tr>
 <tr class=xl68 height=0 style='display:none;mso-height-source:userset;
  mso-height-alt:270'>
  <td height=0 colspan=3 class=xl70 style='mso-ignore:colspan'>&nbsp;</td>
  <td class=xl70>M</td>
  <td colspan=2 class=xl706>726</td>
  <td colspan=16 class=xl69 style='mso-ignore:colspan'>&nbsp;</td>
  <td class=xl102></td>
  <td class=xl127>&nbsp;</td>
  <td colspan=232 class=xl68 style='mso-ignore:colspan'></td>
 </tr>
 <tr class=xl68 height=0 style='display:none;mso-height-source:userset;
  mso-height-alt:225'>
  <td height=0 colspan=2 class=xl72 style='mso-ignore:colspan'>&nbsp;</td>
  <td colspan=3 class=xl73 style='mso-ignore:colspan'>&nbsp;</td>
  <td colspan=17 class=xl72 style='mso-ignore:colspan'>&nbsp;</td>
  <td class=xl102></td>
  <td class=xl127>&nbsp;</td>
  <td colspan=232 class=xl68 style='mso-ignore:colspan'></td>
 </tr>
 <tr height=34 style='mso-height-source:userset;height:25.5pt'>
  <td rowspan=3 height=81 class=xl74 width=44 style='height:60.75pt;width:33pt'>DATE</td>
  <td rowspan=3 class=xl481 width=29 style='width:22pt'>AGE</td>
  <td rowspan=3  class=xl74 width=78 style='border-left:none;width:58pt'>OPENING
  STOCK</td>
  <td  rowspan=3 class=xl74 width=58 style='border-left:none;width:44pt'>MORT</td>
  <td rowspan=3 class=xl74 width=55 style='border-left:none;width:42pt'>CULL
  BIRD</td>
<!--  <td rowspan=3 class=xl74 width=57 style='border-left:none;width:43pt'>SEXING
  ERROR</td>-->
  <td rowspan=3 class=xl707 width=46 style='border-bottom:.5pt solid black;
  width:35pt'>TOTAL FEED (KGS)</td>
  <td colspan=2 class=xl74 width=187 style='border-left:none;width:142pt'>FEED
  CONSUMPTION</td>
  <td colspan=3 class=xl715 style='border-left:none'>BODY WEIGHT</td>
  <td rowspan=3 class=xl707 width=171 style='border-bottom:.5pt solid black;
  width:128pt'>Medication</td>
  <td rowspan=3 class=xl709 width=103 style='border-bottom:.5pt solid black;
  width:77pt'>vaccine</td>
  <td class=xl685 width=64 style='width:48pt'>&nbsp;</td>
  <td colspan=7 class=xl75 style='mso-ignore:colspan'></td>
  <td colspan=225 class=xl68 style='mso-ignore:colspan'></td>
 </tr>
 <tr height=15 style='mso-height-source:userset;height:11.25pt'>
 <!-- <td rowspan=2 height=47 class=xl74 width=43 style='height:35.25pt;border-top:
  none;width:32pt'>F</td>-->
  <!--<td rowspan=2 class=xl74 width=35 style='border-top:none;width:26pt'>M</td>-->
 <!-- <td rowspan=2 class=xl74 width=29 style='border-top:none;width:22pt'>F</td>-->
<!--  <td rowspan=2 class=xl74 width=29 style='border-top:none;width:22pt'>M</td>-->
  <!--<td rowspan=2 class=xl74 width=29 style='border-top:none;width:22pt'>F</td>
  <td rowspan=2 class=xl74 width=26 style='border-top:none;width:20pt'>M</td>-->
  <!--<td rowspan=2 class=xl74 width=31 style='border-top:none;width:23pt'>F</td>
  <td rowspan=2 class=xl74 width=26 style='border-top:none;width:20pt'>M</td>-->
  <td rowspan=2 class=xl74 width=50 style='border-top:none;width:38pt'>FEED (KGS)<span style='mso-spacerun:yes'>&nbsp;&nbsp;</span></td>
  <td rowspan=2 class=xl74 width=46 style='border-top:none;width:35pt'>FEED PER
  BIRD</td>
 <!-- <td rowspan=2 class=xl74 width=46 style='border-top:none;width:35pt'>MALE
  FEED (KGS)<span style='mso-spacerun:yes'>&nbsp;&nbsp;</span></td>
  <td rowspan=2 class=xl74 width=45 style='border-top:none;width:34pt'>FEED PER
  BIRD</td>-->
  <!--<td colspan=3 class=xl712 width=114 style='border-right:.5pt solid black;
  border-left:none;width:86pt'>F</td>-->
  <td colspan=3 class=xl712 width=107 style='border-right:.5pt solid black;
  border-left:none;width:81pt'></td>
  <td class=xl685 width=64 style='width:48pt'>&nbsp;</td>
  <td colspan=7 class=xl75 style='mso-ignore:colspan'></td>
  <td colspan=225 class=xl68 style='mso-ignore:colspan'></td>
 </tr>
 <tr height=32 style='mso-height-source:userset;height:24.0pt'>
  <td height=32 class=xl481 width=42 style='height:24.0pt;border-top:none;
  border-left:none;width:32pt'>STD</td>
  <td class=xl485 width=36 style='border-top:none;border-left:none;width:27pt'>ACT<span
  style='mso-spacerun:yes'>&nbsp;</span></td>
  <td class=xl76 width=36 style='border-left:none;width:27pt'><span
  style='mso-spacerun:yes'>&nbsp;</span>+ / -</td>
<!--  <td class=xl481 width=41 style='border-top:none;border-left:none;width:31pt'>STD</td>
  <td class=xl485 width=33 style='border-top:none;border-left:none;width:25pt'>ACT<span
  style='mso-spacerun:yes'>&nbsp;</span></td>
  <td class=xl76 width=33 style='border-left:none;width:25pt'><span
  style='mso-spacerun:yes'>&nbsp;</span>+ / -</td>-->
  <td class=xl127>&nbsp;</td>
  <td colspan=232 class=xl68 style='mso-ignore:colspan'></td>
 </tr>




































<?php
include "../config.php";

$e = 1;
$eggtype[0] = "dummy";
$query = "SELECT * FROM ims_itemcodes WHERE cat like '%Eggs'";
$result = mysql_query($query,$conn); 
while($row1 = mysql_fetch_assoc($result))
{ 
  $eggtype[$e] = $row1['code'];
  $e = $e + 1;
}

$h = 1;
$hatcheggtype[0] = "dummy";
/*$query = "SELECT * FROM ims_itemcodes WHERE cat = 'Hatch Eggs'";
$result = mysql_query($query,$conn); 
while($row1 = mysql_fetch_assoc($result))
{ 
  $hatcheggtype[$h] = $row1['code'];
  $h = $h + 1;
}*/

$ff= 1;
$ffeedtype[0] = "dummy";
$query = "SELECT * FROM ims_itemcodes WHERE cat = 'Feed'";
$result = mysql_query($query,$conn); 
while($row1 = mysql_fetch_assoc($result))
{ 
  $ffeedtype[$ff] = $row1['code'];
  $ff = $ff + 1;
}

$mf= 1;
$mfeedtype[0] = "dummy";
/*$query = "SELECT * FROM ims_itemcodes WHERE cat = 'Male Feed'";
$result = mysql_query($query,$conn); 
while($row1 = mysql_fetch_assoc($result))
{ 
  $mfeedtype[$mf] = $row1['code'];
  $mf = $mf + 1;
}
*/
$medlist = "'dummy'";
$query = "SELECT * FROM ims_itemcodes WHERE cat = 'Medicines'";
$result = mysql_query($query,$conn); 
while($row1 = mysql_fetch_assoc($result))
{ 
  $medlist = $medlist . ",'" . $row1['code'] . "'";
  $medname[$row1['code']] = $row1['description'];
}

$vaclist = "'dummy'";
$query = "SELECT * FROM ims_itemcodes WHERE cat = 'Vaccines'";
$result = mysql_query($query,$conn); 
while($row1 = mysql_fetch_assoc($result))
{ 
  $vaclist = $vaclist . ",'" . $row1['code'] . "'";
  $vacname[$row1['code']] = $row1['description'];
}


$tfmort = 0;$tmmort = 0;

$tftrin = 0; $tftrout = 0;
$weektrfin = 0;$weektrfout = 0;
$cummtrfin = 0;$cummtrfout = 0;

   
$tfcull = 0;$tmcull = 0;
$teggs = 0;
$thatcheggs = 0;
$weekeggs = 0;
$weekhatcheggs = 0;
$cummeggs = 0;
$cummhatcheggs = 0;
$female = $startfemale;
$male = $startmale;
$weekfmort = 0;$weekmmort = 0;
$weekfcull = 0;$weekmcull = 0;
$weekfsexing = 0;$weekmsexing = 0;
$cummfmort = 0;$cummmmort = 0;
$cummfcull = 0;$cummmcull = 0;
$weekfemale = $startfemale;
$weekmale = $startmale;
$weekeggwt = 0;
$weekmfeed = 0;
$weekffeed = 0;
$weekmfeedg = 0;
$weekffeedg = 0;
$cummeggwt = 0;
$cummmfeed = 0;
$cummffeed = 0;
$cummmfeedg = 0;
$cummffeedg = 0;
 $query = "SELECT * FROM breeder_consumption WHERE flock like '$flockget' GROUP BY date2 ORDER BY date2 ASC";
$result = mysql_query($query,$conn); 
while($row1 = mysql_fetch_assoc($result))
{
   $allftrin = 0;
   $allftrout = 0;
   
   $allfmort = 0;
   $allmmort = 0;
   $allfcull = 0;
   $allmcull = 0;
   $allfsexing = 0;
   $allmsexing = 0; 
   $queryff = "SELECT * FROM breeder_consumption WHERE flock like '$flockget' and date2 = '$row1[date2]' GROUP BY date2,flock ORDER BY date2 ASC";
   $resultff = mysql_query($queryff,$conn); 
   while($rowff = mysql_fetch_assoc($resultff))
   {
     $allfmort = $allfmort + $rowff['fmort'];
     $allmmort = $allmmort + $rowff['mmort'];
     $allfcull = $allfcull + $rowff['fcull'];
     $allmcull = $allmcull + $rowff['mcull'];
     $allfsexing = $allfsexing + $rowff['fsexing'];
     $allmsexing = $allmsexing + $rowff['msexing'];
   }
   
   $query1t = "SELECT cat,sum(quantity) as quantity  FROM `ims_stocktransfer` WHERE cat ='Birds' AND  towarehouse like '$flockget' and fromwarehouse not like '$flockget' AND date = '$row1[date2]' ";
    $result1t = mysql_query($query1t,$conn); 
  	while($row11t = mysql_fetch_assoc($result1t))  
  	{
	  $allftrin = $allftrin + $row11t['quantity'];
	}
	 $query1t2 = "SELECT cat,sum(quantity) as quantity FROM `ims_stocktransfer` WHERE cat ='Birds' AND client = '$client' AND towarehouse not like '$flockget' and fromwarehouse like '$flockget' AND date = '$row1[date2]'";
  	$result1t2 = mysql_query($query1t2,$conn); 
  	while($row11t2= mysql_fetch_assoc($result1t2))  
  	{
     
	  $allftrout = $allftrout + $row11t2['quantity'];
	 
  }

   $alleggwt = 0;
   $allfweight = 0;
   $allfweightb = 0;
   $allfweightc = 0;
   $allfweightd = 0;

   $allmweight = 0;
   $allmweightb = 0;
   $allmweightc = 0;
   $allmweightd = 0;

   $queryff = "SELECT max(eggwt) as 'eggwt',max(fweight) as 'fweight',max(mweight) as 'mweight',max(fweightb) as 'fweightb',max(mweightb) as 'mweightb',max(fweightc) as 'fweightc',max(mweightc) as 'mweightc',max(fweightd) as 'fweighdt',max(mweightd) as 'mweightd' FROM breeder_consumption WHERE flock like '$flockget' and date2 = '$row1[date2]' GROUP BY date2,flock ORDER BY date2 ASC";
   $resultff = mysql_query($queryff,$conn); 
   while($rowff = mysql_fetch_assoc($resultff))
   {
     $alleggwt = $rowff['eggwt'];
     $allfweight = $rowff['fweight'];
     $allfweightb = $rowff['fweightb'];
     $allfweightc = $rowff['fweightc'];
     $allfweightd = $rowff['fweightd'];

     $allmweight = $rowff['mweight'];
     $allmweightb = $rowff['mweightb'];
     $allmweightc = $rowff['mweightc'];
     $allmweightd = $rowff['mweightd'];
   }
//echo $prodate;
 if($row1['date2'] < $prodate) 
 {
  $medconsumed = ""; 
  $queryw = "SELECT * FROM breeder_consumption WHERE flock like '$flockget' and date2 = '$row1[date2]' and itemcode in ($medlist)";
  $resultw = mysql_query($queryw,$conn); 
  while($row1w = mysql_fetch_assoc($resultw))
  {
     $medconsumed = $medconsumed . "," . $medname[$row1w['itemcode']];
  }
  
  $vacconsumed = ""; 
  $queryw = "SELECT * FROM breeder_consumption WHERE flock like '$flockget' and date2 = '$row1[date2]' and itemcode in ($vaclist)";
  $resultw = mysql_query($queryw,$conn); 
  while($row1w = mysql_fetch_assoc($resultw))
  {
     $vacconsumed = $vacconsumed . "," . $vacname[$row1w['itemcode']];
  }

  $tdayeggs = 0;
  $tdayhatcheggs = 0;
  $mdayfeed = 0;
  $fdayfeed = 0;
  $query1 = "SELECT * FROM breeder_production WHERE flock like '$flockget' and date1 = '$row1[date2]' ORDER BY date1 ASC";
  $result1 = mysql_query($query1,$conn); 
  while($row11 = mysql_fetch_assoc($result1))
  {
     if(array_search($row11['itemcode'],$eggtype))
     {
        $tdayeggs = $tdayeggs + $row11['quantity'];        
        for($i = 0;$i < sizeof($rejections); $i++)
        {
            if($row11['itemcode'] == $rejections[$i])
              $rejectionsqty[$i] = $row11['quantity'];
        }
        if(array_search($row11['itemcode'],$hatcheggtype))
        {
           $tdayhatcheggs = $tdayhatcheggs + $row11['quantity'];        
        }
     }
  }
  $teggs = $teggs + $tdayeggs;
  $weekeggs = $weekeggs + $tdayeggs;
  $thatcheggs = $thatcheggs + $tdayhatcheggs;
  $weekhatcheggs = $weekhatcheggs + $tdayhatcheggs;


  $query1 = "SELECT * FROM breeder_consumption WHERE flock like '$flockget' and date2 = '$row1[date2]' ORDER BY date2 ASC";
  $result1 = mysql_query($query1,$conn); 
  while($row11 = mysql_fetch_assoc($result1))
  {
     if(array_search($row11['itemcode'],$ffeedtype))
     {
           $fdayfeed = $fdayfeed + $row11['quantity'];
     }
     if(array_search($row11['itemcode'],$mfeedtype))
     {
           $mdayfeed = $mdayfeed + $row11['quantity'];
     }
  }

	if($entryproc == "Weekly")
{
$newage = $row1['age'];
$nrSeconds = $newage * 24 * 60 * 60;
  $nrDaysPassed = floor($nrSeconds / 86400) % 7;  
  $nrWeeksPassed = floor($nrSeconds / 604800); 
  if($nrDaysPassed) { $nrDaysPassed = $nrDaysPassed; $nrWeeksPassed = $nrWeeksPassed; } else { $nrDaysPassed = 7; $nrWeeksPassed = $nrWeeksPassed - 1; }
  if($nrDaysPassed == 7)
  {
  $weekflag = 0;
  }
}
else
{
  $diffdate = strtotime($row1['date2']) - strtotime($startdate);
  $diffdate = $diffdate/(24*60*60);   
  $newage = $startage + $diffdate;
  $nrSeconds = $newage * 24 * 60 * 60;
  $nrDaysPassed = floor($nrSeconds / 86400) % 7;  
  $nrWeeksPassed = floor($nrSeconds / 604800); 
  if($nrDaysPassed) { $nrDaysPassed = $nrDaysPassed; $nrWeeksPassed = $nrWeeksPassed; } else { $nrDaysPassed = 7; $nrWeeksPassed = $nrWeeksPassed - 1; }
  }
  $tfmort = $tfmort + $allfmort;
  $tmmort = $tmmort + $allmmort;
  $tfcull = $tfcull + $allfcull;
  $tmcull = $tmcull + $allmcull;
  
  $tftrin = $tftrin + $allftrin;
  $tftrout = $tftrout + $allftrout;

?>
 <tr height=15 style='height:11.25pt;display:none'>
  <td height=15 class=xl470 align=right style='height:11.25pt'><?php echo date('j/n/Y',strtotime($row1['date2'])); ?></td>
  <td class=xl339 align=right><?php echo $nrWeeksPassed.".".$nrDaysPassed; ?></td>
  <td class=xl339 align=right><?php echo $newage; ?></td>
  <td class=xl340 style='border-left:none'><span class="xl340" style="border-left:none"><?php echo $female; ?></span></td>
 <?php /*?> <td class=xl341 style='border-left:none'><?php echo $male; ?></td><?php */?>
  <td class=xl342 style='border-top:none'><?php echo $allfmort; $weekfmort = $weekfmort + $allfmort; ?></td>
 <?php 
   $weektrfin = $weektrfin + $allftrin;
  $weektrfout =$weektrfout + $allftrout;
  ?>
  <?php /*?><td class=xl343 style='border-left:none'><?php echo $allmmort; $weekmmort = $weekmmort + $allmmort; ?></td><?php */?>
  <td class=xl302 style='border-top:none;border-left:none'><?php echo $tfmort; ?></td>
  <?php /*?><td class=xl302 style='border-top:none;border-left:none'><?php echo $tmmort; ?></td><?php */?>
  <td class=xl344 style='border-top:none;border-left:none'><?php echo number_format(round(($tfmort/$female)*100,2),2); ?></td>
 <?php /*?> <td class=xl345 style='border-left:none'><?php echo number_format(round(($tmmort/$male)*100,2),2); ?></td><?php */?>
  <td class=xl342 style='border-top:none'><?php echo $allfcull; $weekfcull = $weekfcull + $allfcull; $weekfsexing = $weekfsexing + $allfsexing; ?></td>
<?php /*?>  <td class=xl343 style='border-left:none'><?php echo $allmcull; $weekmcull = $weekmcull + $allmcull; $weekmsexing = $weekmsexing + $allmsexing; ?></td><?php */?>
  <td class=xl302 style='border-left:none'><?php echo $tfcull; ?></td>
 <?php /*?> <td class=xl300 style='border-top:none'><?php echo $tmcull; ?></td><?php */?>
  <td class=xl344 style='border-top:none;border-left:none'><?php echo number_format(round(($tfcull/$female)*100,2),2); ?></td>
  <?php /*?><td class=xl345 style='border-left:none'><?php echo number_format(round(($tmcull/$female)*100,2),2); ?></td><?php */?>
  <td class=xl342 style='border-top:none'>0</td>
 <!-- <td class=xl346 style='border-left:none'>0</td>-->
  <td class=xl347 style='border-top:none'><?php echo $tdayeggs; ?></td>
  <td class=xl344 style='border-top:none;border-left:none'><?php echo $tdayeggsper = number_format(round(($tdayeggs/$female)*100,2),2); $tdayeggsperw = $tdayeggsperw + $tdayeggsper; ?></td>
  <td class=xl302 style='border-top:none;border-left:none'><?php echo $teggs; ?></td>
  <td class=xl348 style='border-top:none;border-left:none'><?php echo number_format(round(($teggs/$female),2),2); ?></td>
  <td class=xl300 style='border-top:none'><?php echo $tdayeggs - $tdaypreveggs; ?></td>
  <td class=xl345 style='border-left:none'><span class="xl345" style="border-left:none"><?php echo round($tdayeggsper - $tdaypreveggsper,2); ?></span></td>
  <td class=xl347 style='border-top:none'><?php echo $tdayhatcheggs; ?></td>
  <td class=xl349 style='border-top:none;border-left:none'><?php echo $tdayhatcheggsper = number_format(round(($tdayhatcheggs/$tdayeggs)*100,3),3); ?></td>
  <td class=xl302 style='border-left:none'><?php echo $tdayhatcheggs - $tdayprevhatcheggs; ?></td>
  <td class=xl350 style='border-left:none'><?php echo $thatcheggs; ?></td>
  <td class=xl351 style='border-top:none'><?php echo number_format(round(($thatcheggs/$female),2),2); ?></td>
  <td class=xl352 style='border-left:none'><?php echo number_format($alleggwt,1); $weekeggwt = $weekeggwt + $alleggwt; ?></td>
<?php
  for($i = 0; $i < sizeof($rejections); $i++)
  {
?>
 <td class=xl353 style='border-left:none'><?php echo $rejectionsqty[$i]; ?></td>
<?php 
  $rejqty[$i] = $rejqty[$i] + $rejectionsqty[$i];
  $rej[$i] = $rej[$i] + round(($rejectionsqty[$i] / $tdayeggs) * 100,2);
  if($i == (sizeof($rejections)-1)) { 
?>
  <td class=xl345 style=''><?php echo number_format(round(($rejectionsqty[$i] / $tdayeggs) * 100,2),2); ?></td>
<?php } else { ?>
  <td class=xl354 style='border-top:none'><?php echo number_format(round(($rejectionsqty[$i] / $tdayeggs) * 100,2),2); ?></td>
<?php } } ?> 




  <td class=xl355 style='border-left:none'><?php echo $tdayeggs - $tdayhatcheggs; ?></td>
  <td class=xl356 style='border-top:none'><?php echo number_format($fdayfeed,2); $weekffeed = $weekffeed + $fdayfeed; ?></td>
 <?php /*?> <td class=xl357 style='border-top:none;border-left:none'><?php echo number_format($mdayfeed,2); $weekmfeed = $weekmfeed + $mdayfeed; ?></td><?php */?>
  <td class=xl358><?php echo number_format(round(($fdayfeed/$female)*1000,3),3); $weekffeedg = $weekffeedg + round(($fdayfeed/$female)*1000,3); ?></td>
  <?php /*?><td class=xl359 style='border-top:none;border-left:none'><?php echo number_format(round(($mdayfeed/$male)*1000,3),3); $weekmfeedg = $weekmfeedg + round(($mdayfeed/$male)*1000,3); ?></td><?php */?>
  <td class=xl354><?php echo $tdayfeed = number_format($fdayfeed,2); ?></td>
  <td class=xl345 style='border-left:none'><?php echo number_format(round($tdayfeed/$tdayeggs,2),2); ?></td>
  <td class=xl342><?php echo $fweight = $allfweight; ?></td>
  <td class=xl346 style='border-left:none'><?php echo $mweight = $allmweight; ?></td>
  <td class=xl361 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl361 style='border-top:none;border-left:none'>&nbsp;</td>
 </tr>










<?php 
      $fwx = 0; 
      if($allfweight) { $fwx = $fwx + 1; } 
      if($allfweightb) { $fwx = $fwx + 1; }
      if($allfweightc) { $fwx = $fwx + 1; }
      if($allfweightd) { $fwx = $fwx + 1; }

      $mwx = 0; 
      if($allmweight) { $mwx = $mwx + 1; } 
      if($allmweightb) { $mwx = $mwx + 1; }
      if($allmweightc) { $mwx = $mwx + 1; }
      if($allmweightd) { $mwx = $mwx + 1; }

      $tempax = $nrWeeksPassed + 1;

	 $query34 = "SELECT * FROM breeder_pstandards where client = '$client' and age = '$tempax' and  breed = '$breedi' ORDER BY age ASC ";
	      $result34 = mysql_query($query34,$conn); 
      while($row134 = mysql_fetch_assoc($result34))
      { 
         $stdfw = $row134['bodyweight'];
         //$stdmw = $row134['mweight'];
      }

?>



 <tr height=15 style='height:11.25pt'>
  <td height=15 class=xl83 align=right style='height:11.25pt'><?php echo $a = date("j-M",strtotime($row1['date2']));  if(!$weekflag) { $_SESSION['jdate'][$nrWeeksPassed + 1] = $a; } ?></td>
  <td class=xl84 align=right><?php echo $nrWeeksPassed . "." . $nrDaysPassed; ?></td>
  <td class=xl68 align=right><?php echo $female;  if($weekflag) { $_SESSION['jfemale'][$nrWeeksPassed + 1] = $female; }  ?></td>
<?php /*?>  <td class=xl68 align=right><?php echo $male; if($weekflag) { $_SESSION['jmale'][$nrWeeksPassed + 1] = $male; $weekflag = 0; }  ?></td><?php */?>
  <td class=xl112 align=right><?php echo $allfmort; ?></td>
 <?php /*?> <td class=xl112 align=right><?php echo $allmmort; ?></td><?php */?>
  <td class=xl112 align=right><?php echo $allfcull; ?></td>
  <?php /*?><td class=xl112 align=right><?php echo $allmcull; ?></td><?php */?>
  <?php /*?>  <td class=xl68 align=right><?php echo $allfsexing; ?></td>
<td class=xl68 align=right><?php echo $allmsexing; ?></td><?php */?>
  <td class=xl85 align=right><?php echo number_format($fdayfeed + $mdayfeed,2); ?></td>
  <td class=xl483 align=right><?php echo number_format($fdayfeed,2); ?></td>
  <td class=xl85 align=right><?php echo number_format(round(($fdayfeed/$female)*1000,3),3); ?></td>
<?php /*?>  <td class=xl483 align=right><?php echo number_format($mdayfeed,2); ?></td><?php */?>
  <?php /*?><td class=xl85 align=right><?php echo number_format(round(($mdayfeed/$male)*1000,3),3); ?></td><?php */?>
  <td class=xl92><?php echo $stdfw; ?></td>
  <td class=xl92><?php echo $tx1 = round(($allfweight + $allfweightb + $allfweightc + $allfweightd)/$fwx); ?></td>
  <td class=xl92><?php echo $tx1 - $stdfw; ?></td>
<?php /*?>  <td class=xl92><?php echo $stdmw; ?></td>
  <td class=xl92><?php echo $tx2 = round(($allmweight + $allmweightb + $allmweightc + $allmweightd)/$mwx); ?></td>
  <td class=xl92><?php echo $tx2 - $stdmw; ?></td><?php */?>
  <td class=xl68><?php echo substr($medconsumed,1); ?></td>
  <td class=xl101><?php echo substr($vacconsumed,1); ?></td>
  <td class=xl699>&nbsp;</td>
  <td colspan=232 class=xl68 style='mso-ignore:colspan'></td>
 </tr>




<?php 
 //$female = $startfemale - ($tfmort + $tfcull);
// $male = $startmale - ($tmmort + $tmcull);
 $female = $startfemale - ($tfmort + $tfcull) + $tftrin - $tftrout;
// $male = $startmale - ($tmmort + $tmcull) + $tmtrin - $tmtrout;
 
 $tdaypreveggs = $tdayeggs;
 $tdaypreveggsper = number_format(round(($tdayeggs/$female)*100,2),2);
 $tdayprevhatcheggs = $tdayhatcheggs;

 if($nrDaysPassed == 7)
 {
   $weekflag = 1;
     $cummtrfin = $cummtrfin + $weektrfin;$cummtrfout = $cummtrfout +  $weektrfout;
   $cummfmort = $cummfmort + $weekfmort;$cummmmort = $cummmmort + $weekmmort;
   $cummfcull = $cummfcull + $weekfcull;$cummmcull = $cummmcull + $weekmcull;
   $cummfsexing = $cummfsexing + $weekfsexing;$cummmsexing = $cummmsexing + $weekmsexing;
   $cummeggs = $cummeggs + $weekeggs; $cummhatcheggs = $cummhatcheggs + $weekhatcheggs;
   $cummeggwt = $cummeggwt + $weekeggwt;
   $cummffeed = $cummffeed + $weekffeed;
   $cummmfeed = $cummmfeed + $weekmfeed;
   for($i = 0; $i < sizeof($rejections); $i++)
   {
      $cummrej[$i] = $cummrej[$i] + $rejqty[$i];
   }
   if($startflag)
   {
      $_SESSION['jstartage'] = $nrWeeksPassed + 1;
      $startflag = 0;
   }
?>
 <tr height=16 style='height:12.0pt;display:none'>
  <td height=16 class=xl473 style='height:12.0pt'>Week</td>
  <td class=xl392><?php echo $tempage = $nrWeeksPassed + 1; ?></td>
  <td class=xl393 style='border-top:none;border-left:none'>&nbsp;</td>
  <!--<td colspan=1 class=xl268 style='mso-ignore:colspan'>&nbsp;</td>-->
  <td class=xl268><?php echo $weekfmort; ?></td>
  <?php /*?><td class=xl268><?php echo $weekmmort; ?></td><?php */?>
  <td  class=xl268 style='mso-ignore:colspan'>&nbsp;</td>
  <td class=xl268><?php echo number_format(round(($weekfmort/$weekfemale)*100,3),3); ?></td>
  <?php /*?><td class=xl268><?php echo number_format(round(($weekmmort/$weekmale)*100,3),3); ?></td><?php */?>
  <td class=xl268><?php echo $weekfcull; ?></td>
<?php /*?>  <td class=xl268><?php echo $weekmcull; ?></td><?php */?>
  <td colspan=2 class=xl268 style='mso-ignore:colspan'>&nbsp;</td>
  <td class=xl269><?php echo number_format(round(($weekfcull/$weekfemale)*100,3),3); ?></td>
  <?php /*?><td class=xl269><?php echo number_format(round(($weekmcull/$weekmale)*100,3),3); ?></td><?php */?>
  <td class=xl268>0</td>
  <td class=xl268>0</td>
  <td class=xl268><?php echo $weekeggs; ?></td>
  <td class=xl269><?php echo $tempcomp1 = round((($weekeggs/7)/$weekfemale)*100,2); ?></td>
  <td class=xl268>&nbsp;</td>
  <td class=xl269><?php echo round($weekeggs/$startfemale,2); ?></td>
  <td colspan=2 class=xl268 style='mso-ignore:colspan'>&nbsp;</td>
<?php /*?>  <td class=xl268><?php echo $weekhatcheggs; ?></td>
  <td class=xl269><?php echo round(($weekhatcheggs/$weekeggs)*100,2); ?></td><?php */?>
  <td colspan=2 class=xl268 style='mso-ignore:colspan'>&nbsp;</td>
  <td class=xl269><?php echo round($weekeggs/$startfemale,2); ?></td>
  <td class=xl268><?php echo $tempcomp5 = round($weekeggwt/7,2); ?></td>
  <?php for($i = 0; $i < sizeof($rejections); $i++)
  {
  ?>
  <td class=xl268><?php echo $rejqty[$i]; ?></td>
  <td class=xl269><?php echo round(($rejqty[$i]/$weekeggs)*100,2); ?></td>
  <?php } ?>

  <td class=xl268>&nbsp;</td>
  <td class=xl269><?php echo $weekffeed; ?></td>
 <?php /*?> <td class=xl269><?php echo $weekmfeed; ?></td><?php */?>
  <td class=xl269><?php echo $temp3 = round($weekffeedg/7,2); $cummffeedg = $cummffeedg + $temp3; ?></td>
 <?php /*?> <td class=xl269><?php echo $temp4 = round($weekmfeedg/7,2); $cummmfeedg = $cummmfeedg + $temp4; ?></td><?php */?>
  <td class=xl269><?php echo $t1 = $weekffeed; ?></td>
  <td class=xl394><?php echo number_format(round($t1/$weekeggs,2),2); ?></td>
  <td class=xl268><?php echo $tempcomp6 = $fweight; $_SESSION['fbweight'][$tempage] = $fweight; ?></td>
  <?php /*?><td class=xl268><?php echo $tempcomp7 = $mweight; $_SESSION['mbweight'][$tempage] = $mweight; ?></td><?php */?>
  <td class=xl268 style='mso-ignore:colspan'></td>
  <td class=xl268 style='mso-ignore:colspan;border-right: 1pt solid black'></td>
 </tr>
 <tr height=15 style='height:11.25pt;display:none'>
  <td height=15 class=xl474 style='height:11.25pt'>Cum</td>
  <td class=xl270>&nbsp;</td>
  <td class=xl271>&nbsp;</td>
<?php /*?>  <td colspan=1 class=xl272 style='mso-ignore:colspan'>&nbsp;</td><?php */?>
  <td class=xl272><?php echo $cummfmort; ?></td>
  <?php /*?><td class=xl272><?php echo $cummmmort; ?></td><?php */?>
  <td  class=xl272 style='mso-ignore:colspan'>&nbsp;</td>
  <td class=xl272><?php echo $tempcomp = number_format(round(($cummfmort/$startfemale)*100,3),3); ?></td>
  <td class=xl272><?php echo number_format(round(($cummmmort/$startmale)*100,3),3); ?></td>
  <td class=xl272><?php echo $cummfcull; ?></td>
  <td class=xl272><?php echo $cummmcull; ?></td>
  <td colspan=2 class=xl272 style='mso-ignore:colspan'>&nbsp;</td>
  <td class=xl272><?php echo number_format(round(($cummfcull/$startfemale)*100,3),3); ?></td>
  <td class=xl272><?php echo number_format(round(($cummmcull/$startmale)*100,3),3); ?></td>
  <td class=xl272>0</td>
  <td class=xl272>0</td>
  <td class=xl272><?php echo $cummeggs; ?></td>
  <td colspan=2 class=xl272 style='mso-ignore:colspan'>&nbsp;</td>
  <td class=xl273><?php echo $tempcomp2 = round($cummeggs/$startfemale,2); ?></td>
  <td colspan=2 class=xl272 style='mso-ignore:colspan'>&nbsp;</td>
  <td class=xl272><?php echo $cummhatcheggs; ?></td>
  <td class=xl273><?php echo $tempcomp3 = round(($cummhatcheggs/$cummeggs)*100,2); ?></td>
  <td colspan=2 class=xl272 style='mso-ignore:colspan'>&nbsp;</td>
  <td class=xl273><?php echo $tempcomp4 = round($cummhatcheggs/$startfemale,2); ?></td>
  <td class=xl272>&nbsp;</td>
  <?php for($i = 0; $i < sizeof($rejections); $i++)
  {
  ?>
  <td class=xl272><?php echo $cummrej[$i]; ?></td>
  <td class=xl273><?php echo round(($cummrej[$i]/$cummeggs)*100,2); ?></td>
  <?php } ?>
  <td class=xl272>&nbsp;</td>
  <td class=xl273><?php echo $cummffeed; ?></td>
  <td class=xl273><?php echo $cummmfeed; ?></td>
  <td class=xl273><?php echo $cummffeedg; ?></td>
  <td class=xl273><?php echo $cummmfeedg; ?></td>
  <td class=xl273><?php echo  $cummffeed + $cummmfeed; ?></td>
  <td class=xl273>&nbsp;</td>
  <td colspan=2 class=xl272 style='mso-ignore:colspan'>&nbsp;</td>
  <td class=xl272 style='mso-ignore:colspan'></td>
  <td class=xl272 style='mso-ignore:colspan;border-right: 1pt solid black'></td>
 </tr>
<?php

	$query34 = "SELECT * FROM breeder_pstandards where client = '$client' and age = '$tempage' and  breed = '$breedi' ORDER BY age ASC ";
$result34 = mysql_query($query34,$conn); 
while($row134 = mysql_fetch_assoc($result34))
{ 
   $stdmort = $row134['stdmortality'];
  $hdper = $row134['henday'];
  $stdeggbird = $row134['hecum'];
  //$stdheggbird = $row134['cumhhe'];
  //$stdheggper = $row134['heggper'];
  $stdeggwt = $row134['eggweight'];
}

	$query34 = "SELECT * FROM breeder_pstandards where client = '$client' and age = '$tempage' and  breed = '$breedi' ORDER BY age ASC ";
$result34 = mysql_query($query34,$conn); 
while($row134 = mysql_fetch_assoc($result34))
{ 
  $stdfw = $row134['bodyweight'];
  //$stdmw = $row134['mweight'];
}
?>
 <tr height=15 style='height:11.25pt;display:none'>
  <td height=15 class=xl475 style='height:11.25pt'>Std</td>
  <td class=xl274>&nbsp;</td>
  <td class=xl275>&nbsp;</td>
  <td colspan=3 class=xl276 style='mso-ignore:colspan'>&nbsp;</td>
  <td class=xl276><?php echo $stdmort; ?></td>
  <td colspan=10 class=xl276 style='mso-ignore:colspan'>&nbsp;</td>
  <td class=xl276><?php echo $hdper; ?></td>
  <td class=xl276>&nbsp;</td>
  <td class=xl277><?php echo $stdeggbird; ?></td>
  <td colspan=3 class=xl276 style='mso-ignore:colspan'>&nbsp;</td>
  <td class=xl276><?php echo $stdheggper; ?></td>
  <td colspan=2 class=xl276 style='mso-ignore:colspan'>&nbsp;</td>
  <td class=xl277><?php echo $stdheggbird; ?></td>
  <td class=xl276><?php echo $stdeggwt; ?></td>
  <td colspan=<?php echo $r * 2; ?> class=xl276 style='mso-ignore:colspan'>&nbsp;</td>
  <td class=xl276>&nbsp;</td>
  <td colspan=4 class=xl276 style='mso-ignore:colspan'>&nbsp;</td>
  <td colspan=2 class=xl277 style='mso-ignore:colspan'>&nbsp;</td>
  <td class=xl276><?php echo $stdfw; ?></td>
  <td class=xl276><?php echo $stdmw; ?></td>
  <td class=xl276 style='mso-ignore:colspan'></td>
  <td class=xl276 style='mso-ignore:colspan;border-right: 1pt solid black'></td>
 </tr>
 <tr height=16 style='height:12.0pt;display:none'>
  <td height=16 class=xl476 style='height:12.0pt'>Diff</td>
  <td class=xl278>&nbsp;</td>
  <td class=xl399>&nbsp;</td>
  <td colspan=3 class=xl400 style='mso-ignore:colspan'>&nbsp;</td>
  <td class=xl400><?php echo round($tempcomp - $stdmort,2); ?></td>
  <td colspan=10 class=xl400 style='mso-ignore:colspan'>&nbsp;</td>
  <td class=xl401><?php echo round($tempcomp1 - $hdper,2); ?></td>
  <td class=xl400>&nbsp;</td>
  <td class=xl401><?php echo round($tempcomp2 - $stdeggbird,2); ?></td>
  <td colspan=3 class=xl400 style='mso-ignore:colspan'>&nbsp;</td>
  <td class=xl401><?php echo round($tempcomp3 - $stdheggper,2); ?></td>
  <td colspan=2 class=xl400 style='mso-ignore:colspan'>&nbsp;</td>
  <td class=xl401><?php echo round($tempcomp4 - $stdheggbird,2); ?></td>
  <td class=xl400><?php echo round($tempcomp5 - $stdeggwt,2); ?></td>
  <td colspan=<?php echo $r * 2; ?> class=xl400 style='mso-ignore:colspan'>&nbsp;</td>
  <td class=xl400>&nbsp;</td>
  <td colspan=4 class=xl400 style='mso-ignore:colspan'>&nbsp;</td>
  <td colspan=2 class=xl401 style='mso-ignore:colspan'>&nbsp;</td>
  <td class=xl400><?php echo round($tempcomp6 - $stdfw,2); ?></td>
  <td class=xl400><?php echo round($tempcomp7 - $stdmw,2); ?></td>
  <td class=xl400>&nbsp;</td>
  <td class=xl400 style="border-right: 1pt solid black">&nbsp;</td>
 </tr>






 <tr height=15 style='height:11.25pt'>
  <td height=15 class=xl89 colspan=3 style='height:11.25pt;mso-ignore:colspan'><?php echo $tempage; $_SESSION['jage'] = $tempage; ?>
  Wk. Total</td>
  <!--<td class=xl82></td>-->
  <td class=xl82 align=right><?php echo $weekfmort; $_SESSION['jfmort'][$tempage] = $weekfmort; $_SESSION['fmort'][$tempage] = $weekfmort;?></td>
  <?php /*?><td class=xl82 align=right><?php echo $weekmmort; $_SESSION['jmmort'][$tempage] = $weekmmort; $_SESSION['mmort'][$tempage] = $weekmmort;  ?></td><?php */?>
  <td class=xl82 align=right><?php echo $weekfcull; $_SESSION['jfcull'][$tempage] = $weekfcull; ?></td>
<?php /*?>  <td class=xl82 align=right><?php echo $weekmcull; $_SESSION['jmcull'][$tempage] = $weekmcull; ?></td><?php */?>
  <?php /*?><td class=xl82 align=right><?php echo $weekfsexing;  $_SESSION['jfsexing'][$tempage] = $weekfsexing; ?></td>
  <td class=xl82 align=right><?php echo $weekmsexing;  $_SESSION['jmsexing'][$tempage] = $weekmsexing; ?></td><?php */?>
  <td class=xl82 align=right><?php echo $weekffeed; ?></td>
  <td class=xl91 align=right><?php echo $weekffeed; $_SESSION['jffeed'][$tempage] = $weekffeed; ?></td>
  <td class=xl91 align=right><?php echo $a = round($weekffeedg/7,2); $_SESSION['jffeedpb'][$tempage] = $a; ?></td>
<?php /*?>  <td class=xl82 align=right><?php echo $weekmfeed; $_SESSION['jmfeed'][$tempage] = $weekmfeed; ?></td><?php */?>
 <?php /*?> <td class=xl91 align=right><?php echo $a = round($weekmfeedg/7,2); $_SESSION['jmfeedpb'][$tempage] = $a; ?></td><?php */?>
  <td class=xl101 align=middle><?php echo $stdfw; ?></td>
  <td class=xl111 align=middle><?php echo $tx1; $_SESSION['jfbweight'][$tempage] = $tx1; ?></td>
  <td class=xl82 align=middle><?php echo $tx1 - $stdfw; ?></td>
<?php /*?>  <td class=xl101 align=middle><?php echo $stdmw; $_SESSION['jmbweight'][$tempage] = $tx2; ?></td>
  <td class=xl111 align=middle><?php echo $tx2; ?></td>
  <td class=xl82 align=middle><?php echo $tx2 - $stdmw; ?></td><?php */?>
  <td class=xl68></td>
  <td class=xl101></td>
  <td class=xl699>&nbsp;</td>
  <td colspan=232 class=xl68 style='mso-ignore:colspan'></td>
 </tr>
 <tr height=15 style='height:11.25pt'>
  <td height=15 class=xl89 colspan=2 style='height:11.25pt;mso-ignore:colspan'>Current
  Wk</td>
  <td colspan=1 class=xl82 style='mso-ignore:colspan'></td>
  <td class=xl110 align=right><?php echo number_format(round(($weekfmort/$weekfemale)*100,2),2); ?></td>
 <?php /*?> <td class=xl110 align=right><?php echo number_format(round(($weekmmort/$weekmale)*100,2),2); ?></td><?php */?>
  <td class=xl110 align=right><?php echo number_format(round(($weekfcull/$weekfemale)*100,2),2); ?></td>
<?php /*?>  <td class=xl110 align=right><?php echo number_format(round(($weekmcll/$weekmale)*100,2),2); ?></td><?php */?>
 <?php /*?> <td class=xl110 align=right><?php echo number_format(round(($weekfsexing/$weekfemale)*100,2),2); ?></td>
  <td class=xl110 align=right><?php echo number_format(round(($weekmsexing/$weekmale)*100,2),2); ?></td><?php */?>
  <td class=xl82 align=right><?php echo $weekffeed ; ?></td>
  <td class=xl91 align=right><?php echo $weekffeed; ?></td>
  <td class=xl91 align=right><?php echo round($weekffeedg/7,2); ?></td>
 <?php /*?> <td class=xl91 align=right><?php echo $weekmfeed; ?></td>
  <td class=xl91 align=right><?php echo round($weekmfeedg/7,2); ?></td><?php */?>
  <td class=xl112></td>
  <td class=xl68></td>
  <!--<td colspan=2 class=xl112 style='mso-ignore:colspan'></td> -->
  <td class=xl68></td>
  <td class=xl112></td>
  <td class=xl101 style="border-right: 1pt solid black">&nbsp;</td>
 <!-- <td class=xl68></td>
  <td class=xl101></td>
 <td class=xl699>&nbsp;</td>
  <td colspan=232 class=xl68 style='mso-ignore:colspan'></td>-->
 </tr>
 <tr height=15 style='height:11.25pt'>
  <td height=15 class=xl113 colspan=2 style='height:11.25pt;mso-ignore:colspan'>Cumulative</td>
  <td class=xl78>&nbsp;</td>
  
  <td class=xl78 align=right><?php echo $cummfmort; ?></td>
<?php /*?>  <td class=xl78 align=right><?php echo $cummmmort; ?></td><?php */?>
  <td class=xl78 align=right><?php echo $cummfcull; ?></td>
<?php /*?>  <td class=xl78 align=right><?php echo $cummmcull; ?></td><?php */?>
 <?php /*?>  <td class=xl78 align=right><?php echo $cummfsexing; ?></td>
 <td class=xl78 align=right><?php echo $cummmsexing; ?></td><?php */?>
  <td class=xl114 align=right><?php echo $cummffeed ; ?></td>
  <td class=xl115 align=right><?php echo $cummffeed; ?></td>
  <td class=xl115 align=right></td>
<?php /*?>  <td class=xl115 align=right><?php echo $cummmfeed; ?></td><?php */?>
  <td class=xl115 align=right></td>
   <td class=xl117>&nbsp;</td>
  <td class=xl124>&nbsp;</td>
   <td class=xl118>&nbsp;</td>
  <td class=xl101></td>
  <td class=xl699>&nbsp;</td>
 <!-- <td class=xl124>&nbsp;</td>
  <td class=xl117>&nbsp;</td>
  <td class=xl118>&nbsp;</td>
 <td class=xl101></td>
  <td class=xl699>&nbsp;</td>-->
  <td colspan=232 class=xl68 style='mso-ignore:colspan'></td>
 </tr>
 <tr height=15 style='height:11.25pt'>
  <td height=15 class=xl119 colspan=3 style='height:11.25pt;mso-ignore:colspan'>Cum.
  Mort. %</td>
  
  <td class=xl96 align=right><?php echo number_format(round(($cummfmort/$startfemale)*100,2),2); ?></td>
  <?php /*?><td class=xl94 align=right><?php echo number_format(round(($cummmmort/$startmale)*100,2),2); ?></td><?php */?>
  <td class=xl96 align=right><?php echo number_format(round(($cummfcull/$startfemale)*100,2),2); ?></td>
  <?php /*?><td class=xl96 align=right><?php echo number_format(round(($cummmcull/$startmale)*100,2),2); ?></td><?php */?>
  <?php /*?> <td class=xl95 align=right><?php echo number_format(round(($cummfsexing/$startfemale)*100,2),2); ?></td>
 <td class=xl95 align=right><?php echo number_format(round(($cummmsexing/$startmale)*100,2),2); ?></td><?php */?>
  <td class=xl95>&nbsp;</td>
  <td class=xl95>&nbsp;</td>
  <td class=xl97>&nbsp;</td>
  <td class=xl95>&nbsp;</td>
  <td class=xl94>&nbsp;</td>
 
  <td class=xl99>&nbsp;</td>
  <td class=xl120>&nbsp;</td>
  <td class=xl101></td>
   <td class=xl699>&nbsp;</td>
  <td colspan=232 class=xl68 style='mso-ignore:colspan'></td>
  <!--<td class=xl99>&nbsp;</td>
  <td class=xl100>&nbsp;</td>
  <td class=xl99>&nbsp;</td>
  <td class=xl120>&nbsp;</td>
  <td class=xl101></td>
  <td class=xl699>&nbsp;</td>-->
  <td colspan=232 class=xl68 style='mso-ignore:colspan'></td>
 </tr>


<?php
   $weektrfin =0;  $weektrfout =0;
   $weekfmort = 0;$weekmmort = 0;
   $weekfcull = 0;$weekmcull = 0;
   $weekeggs = 0; $weekhatcheggs = 0;
   $weekfemale = $female;
   $weekmale = $male;
   $weekeggwt = 0;
   $weekffeed = 0;
   $weekmfeed = 0;
   $weekffeedg = 0;
   $weekmfeedg = 0;
   for($i = 0; $i < sizeof($rejections); $i++)
   {
      $rej[$i] = 0;
      $rejqty[$i] = 0;
   }
 }
 }
} 
?>
</table>

</body>
<?php } ?>

</html>

