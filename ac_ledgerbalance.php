<?php include "jquery.php";
      include "getemployee.php";
      include "config.php"; 
	  $q1 = "SELECT max(fdate) as fdate from ac_definefy ";
$result = mysql_query($q1,$conn);
while($row1 = mysql_fetch_assoc($result))
 {
 $fromdate = $row1['fdate'];
 $fromdate = date("d.m.Y",strtotime($fromdate));
 }
?>

<center>
<br />
<h1>COA Ledger</h1> 
<br /><br /><br />
<form target="_new" onsubmit="return checkform()">
<table align="center">

<tr>
 <td align="right" ><strong>Cost Center</strong>&nbsp;&nbsp;&nbsp;</td><td align="left">
  <select id="warehouse" name="warehouse">
  <option value="">All</option>
  <?php
  $query = "select distinct(sector) from tbl_sector";
  $result = mysql_query($query,$conn) or dir(mysql_error());
  while($rows = mysql_fetch_assoc($result))
  {
  ?>
  <option value="<?php echo $rows['sector']; ?>"><?php echo $rows['sector']; ?></option>
  <?php
  }
  ?>
  </select>
 </td>
</tr>
<tr height="10px"></tr> 

<tr>
<td align="right"><strong>COA</strong>&nbsp;&nbsp;&nbsp;</td>
<td align="left">
<select onchange="document.getElementById('desc').value=this.value;" id="code" name="code">
<option value="">Select</option>
<?php
if($_SESSION['client'] == 'FEEDATIVES')
{
	if($_SESSION['sectorr'] == "all")
	{
	 $q = "select code,controltype,description from ac_coa order by code ";
	}
	else
	{
	 $sectortype =  $_SESSION['sectorr'];
	 $q = "select code,controltype,description from ac_coa WHERE controltype <> 'Cash' order by code ";
	 	$query = "select code,controltype,description from ac_coa WHERE code IN (SELECT coacode FROM ac_bankmasters WHERE code IN (SELECT code FROM ac_bankcashcodes WHERE sector = '$sectortype' ORDER BY code ASC))";
	  	$result = mysql_query($query,$conn) or die(mysql_error());
		while($rows = mysql_fetch_assoc($result))
		{
		?>
	<option title="<?php echo $rows['description']; ?>" value="<?php echo $rows['code'];?>@<?php echo $qr['description']; ?>"><?php echo $rows['code']; ?></option>
		<?php
		}
	}
}
else
 	 $q = "select code,controltype,description from ac_coa order by code ";
 
		$qrs = mysql_query($q,$conn) or die(mysql_error());
		while($qr = mysql_fetch_assoc($qrs))
		{
?>
<option title="<?php echo $qr['description']; ?>" value="<?php echo $qr['code']; ?>@<?php echo $qr['description']; ?>"><?php echo $qr['code']; ?></option>
<?php } ?>
</select>
</td>
</tr>
<tr height="10px"></tr>
<tr>
<td align="right"><strong>Description</strong>&nbsp;&nbsp;&nbsp;</td>
<td align="left">
<select onchange="document.getElementById('code').value=this.value;" id="desc" name="desc">
<option value="">Select</option>
<?php
if($_SESSION['client'] == 'FEEDATIVES')
{
	if($_SESSION['sectorr'] == "all")
	{
	 $q = "select code,controltype,description from ac_coa order by code ";
	}
	else
	{
	 $sectortype =  $_SESSION['sectorr'];
	 $q = "select code,controltype,description from ac_coa WHERE controltype <> 'Cash' order by description ";
	 	$query = "select code,controltype,description from ac_coa WHERE code IN (SELECT coacode FROM ac_bankmasters WHERE code IN (SELECT code FROM ac_bankcashcodes WHERE sector = '$sectortype' ORDER BY code ASC))";
	  	$result = mysql_query($query,$conn) or die(mysql_error());
		while($rows = mysql_fetch_assoc($result))
		{
		?>
	<option title="<?php echo $rows['description']; ?>" value="<?php echo $rows['code']; ?>@<?php echo $qr['description']; ?>"><?php echo $rows['code']; ?></option>
		<?php
		}
	}
}
else
 	 $q = "select code,controltype,description from ac_coa order by description ";
 
		$qrs = mysql_query($q,$conn) or die(mysql_error());
		while($qr = mysql_fetch_assoc($qrs))
		{

?>
<option title="<?php echo $qr['code']; ?>"  value="<?php echo $qr['code']; ?>@<?php echo $qr['description']; ?>"><?php echo $qr['description']; ?></option>
<?php } ?>
</select>


</td>
</tr>
<tr height="10px"></tr>
</table>
<table align="center">
<tr>
<td align="right"><strong>From&nbsp;&nbsp;&nbsp;</strong></td>
<td width="10px"></td>
<td align="left"><input type="text" size="15" id="date2" class="datepicker" name="date2" value="<?php echo  $fromdate; ?>" onChange="datecomp();"></td>
<td width="10px"></td>
<td><strong align="right">To&nbsp;&nbsp;&nbsp;</strong></td>
<td width="10px"></td>
<td align="left"><input type="text" size="15" id="date3" class="datepicker" name="date3" value="<?php echo date("d.m.Y"); ?>" onChange="datecomp();" ></td>
</tr>
</table>
<br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" id="report" value="Report" onclick="openreport();" />
</form>
</center>




<script type="text/javascript">

function openreport()
{
var fromdate = document.getElementById('date2').value;
var todate = document.getElementById('date3').value;
var code = document.getElementById('code').value;
var desc = code.split('@')
var warehouse = document.getElementById('warehouse').value;
window.open('production/dummy.php?fromdate=' + fromdate + '&todate=' + todate + '&code=' + desc[0] + '&desc=' + desc[1]+ '&warehouse=' + warehouse);
}


function datecomp()
{
<?php echo "
dd = document.getElementById('date2').value;
temp =  dd.split('.');
temp = temp[1] + '/' + temp[0] + '/' + temp[2];
temp1 = new Date(temp);

dd1 = document.getElementById('date3').value;
temp3 =  dd1.split('.');
temp3 = temp3[1] + '/' + temp3[0] + '/' + temp3[2];
temp4 = new Date(temp3);

if(temp1 >temp4)
{
 alert('To date must be greater than or equal to From date');
 document.getElementById('report').disabled = true;
}
else
{
 document.getElementById('report').disabled = false;
 reloadpurord();
}
 ";
?>
}
function description()
{

	<?php
		/*$q = "select * from ac_coa";
		$qrs = mysql_query($q) or die(mysql_error());
		while($qr = mysql_fetch_assoc($qrs))
		{
		echo "if(document.getElementById('code').value == '$qr[code]') { ";
		$q1 = "select code,description from ac_coa where code = '$qr[code]'";
	//	$q1rs = mysql_query($q1) or die(mysql_error());
		if($q1r = mysql_fetch_assoc($q1rs))
		{
	?>
	    document.getElementById('desc').value = "<?php echo $q1r['description']; ?>";
		
		<?php 
		}
		echo " } "; 
		}*/
		?>
		
}

function reloadpur()
{
 date2 = document.getElementById('date2').value;
 date2 = temp =  date2.split('.');
 var fdate =(date1[2] + '-' + date2[1] + '-' + date2[0]).toString();
 
 date3 = document.getElementById('date3').value;
 date3 = temp =  date3.split('.');
 var tdate =(date3[2] + '-' + date3[1] + '-' + date3[0]).toString();
}
function checkform()
{
if(document.getElementById("warehouse").value=="-Select-" || document.getElementById("warehouse").value=="")
{
alert("Please Select The Cost Center");
return false;
}
return true;
}
</script>
<script type="text/javascript">
function script1() {
window.open('GLHelp/help_coaledger.php','BIMS','width=500,height=600,toolbar=no,menubar=yes,scrollbars=no,resizable=no');
}
</script>


	<footer>
		<div class="float-left">
			<a href="#" class="button" onClick="script1()">Help</a>
			<a href="javascript:void(0)" class="button">About</a>
		</div>


		
		<div class="float-right">
			<a href="#top" class="button"><img src="images/icons/fugue/navigation-090.png" width="16" height="16"> Page top</a>
		</div>
		
	</footer>

<!--[if lt IE 8]></div><![endif]-->
<!--[if lt IE 9]></div><![endif]-->
</body>
</html>
	