 <?php 
include "jquery.php"; 
include "config.php";
include "getemployee.php";
$date1 = date("d.m.Y"); 
$strdot1 = explode('.',$date1); 
$ignore = $strdot1[0]; 
$m = $strdot1[1];
$y = substr($strdot1[2],2,4);
$query1 = "SELECT MAX(cobiincr) as cobiincr FROM oc_cobi where m = '$m' AND y = '$y' ORDER BY date DESC";
$result1 = mysql_query($query1,$conn); $cobiincr = 0; 
while($row1 = mysql_fetch_assoc($result1)) 
$cobiincr = $row1['cobiincr']; 
$cobiincr = $cobiincr + 1;
if ($cobiincr < 10) 
$cobi = 'COBI-'.$m.$y.'-000'.$cobiincr; 
else if($cobiincr < 100 && $cobiincr >= 10) 
$cobi = 'COBI-'.$m.$y.'-00'.$cobiincr; 
else $cobi = 'COBI-'.$m.$y.'-0'.$cobiincr;
?>

<section class="grid_8">
  <div class="block-border">
  	 <form class="block-content form" id="complex_form" method="post" action="oc_savedirectsales_a.php" onsubmit="return checkcoa();"> 
		<input type="hidden" name="cobiincr" id="cobiincr" value="<?php echo $cobiincr; ?>"/>
		<input type="hidden" name="m" id="m" value="<?php echo $m; ?>"/>
		<input type="hidden" name="y" id="y" value="<?php echo $y; ?>"/>
		
		<input type="hidden" name="discountamount" id="discountamount" value="0"/>
		<input type="hidden" name="finaldiscount" id="finaldiscount" value="0"/>
	 
	  <h1>Direct Sales</h1>
	 <center> (Fields marked <font style="color:red;font-weight:bold;padding-top:10px"><sup>*</sup></font> are mandatory)</center>
		<br /><br />
            <table align="center">
              
             <?php if($_SESSION['db'] == "albustan" || $_SESSION['db'] == "albustanlayer") {?>
			 <tr align="center">
                <td colspan="16" align="center"><strong>Customer</strong><font style="color:red;font-weight:bold;padding-top:10px"><sup>*</sup></font>&nbsp;
					<select onchange="getcterm(this.value);  document.getElementById('partycode').value=this.value;" id="party" name="party" style="width:150px">
					<option>-Select-</option>
					<?php
							$q = "select distinct(name),cterm,code from contactdetails where type = 'party' OR type = 'vendor and party' order by name";
							$qrs = mysql_query($q,$conn) or die(mysql_error());
							while($qr = mysql_fetch_assoc($qrs))
							{
					?>
					<option value="<?php echo $qr['name'].'@'.$qr['cterm'].'@'.$qr['code'];?>" title="<?php echo $qr['name']; ?>"><?php echo $qr['name']; ?></option>
					<?php   }   ?>
					</select>
				<strong>Customer Code</strong><font style="color:red;font-weight:bold;padding-top:10px"><sup>*</sup></font>
					<select onchange="getcterm(this.value); document.getElementById('party').value=this.value;" id="partycode" name="partycode" style="width:150px">
					<option>-Select-</option>
					<?php
							$q = "select distinct(name),cterm,code from contactdetails where type = 'party' OR type = 'vendor and party' order by code";
							$qrs = mysql_query($q,$conn) or die(mysql_error());
							while($qr = mysql_fetch_assoc($qrs))
							{
					?>
					<option value="<?php echo $qr['name'].'@'.$qr['cterm'].'@'.$qr['code'];?>" title="<?php echo $qr['name']; ?>"><?php echo $qr['code']; ?></option>
					<?php   }   ?>
					</select>
				</td>
				 </tr>
				 <tr height="20px"></tr>
				 
<?php } ?>
<tr>
                <td><strong>Date</strong></td>
                <td>&nbsp;<input class="datepicker" type="text" size="9" id="date" name="date" value="<?php echo date("d.m.Y"); ?>" onchange="getsobi();"></td>
                <td width="5px"></td>
<?php if($_SESSION['db'] == "albustan" || $_SESSION['db'] == "albustanlayer") {} else  { ?>
                <td><strong>Customer</strong><font style="color:red;font-weight:bold;padding-top:10px"><sup>*</sup></font></td>
                <td>&nbsp;
					<select onchange="getcterm(this.value)" id="party" name="party" style="width:150px">
					<option>-Select-</option>
					<?php
							$q = "select distinct(name),cterm from contactdetails where type = 'party' OR type = 'vendor and party' order by name";
							$qrs = mysql_query($q,$conn) or die(mysql_error());
							while($qr = mysql_fetch_assoc($qrs))
							{
					?>
					<option value="<?php echo $qr['name'].'@'.$qr['cterm'];?>" title="<?php echo $qr['name']; ?>"><?php echo $qr['name']; ?></option>
					<?php   }   ?>
					</select>
				</td>
				 <td width="5px"></td>
<?php } ?>
                <td title = "Invoice"><strong>Inv.</strong></td>
                <td width="15px"></td>
                <td><input type="text" size="15" style="background:none;border:none;" id="invoice" name="invoice" value="<?php echo $cobi; ?>" readonly /></td>
				<td width="5px"></td>
				<td title = "Book Invoice"><strong>B&nbsp;Inv.</strong></td>
				<td width="5px"></td>
                <td>
					<input type="text" size="5" id="bookinvoice" name="bookinvoice" value=""></td>
             
			    <td width="5px"></td>
				 <td><strong>&nbsp;Warehouse<font style="color:red;font-weight:bold;padding-top:10px"><sup>*</sup></font>&nbsp;</strong></td>
				<td>
				
				<select id="aaa" name="aaa" style="width:120px">
<option value="">-Select-</option>
<?php
if($_SESSION['sectorall'] == "all" || ($_SESSION['sectorall'] == "" && $_SESSION['sectorlist'] == ""))
{
 $q1 = "SELECT distinct(sector) FROM tbl_sector order by sector";
 }
 else
 {
  $sectorlist = $_SESSION['sectorlist'];
 $q1 = "SELECT distinct(sector) FROM tbl_sector where sector In ($sectorlist) order by sector";
 }
 $r1 = mysql_query($q1,$conn);
 $n1 = mysql_num_rows($r1);
 while($row1 = mysql_fetch_assoc($r1))
 {
?>
<option value="<?php echo $row1['sector']; ?>"><?php echo $row1['sector']; ?></option>
<?php } ?>
</select>

</td>
				<td width="5px"></td>
                <td title = "Credit Term"><strong>&nbsp;C&nbsp;Term</strong></td>
				<td width="5px"></td>
                <td>
					<select id="cterm" name="cterm">
					<option value="0">-Select-</option>
					<?php
					$query = "SELECT value,code FROM ims_creditterm ORDER BY value";
					$result = mysql_query($query,$conn) or die(mysql_error());
					while($rows = mysql_fetch_assoc($result))
					{
					 ?>
					 <option value="<?php echo $rows['value']; ?>"><?php echo $rows['code']; ?></option>
					 <?php
					}
					?>
					</select>
					</td>
				
              </tr>
            </table>
<br /><br />			

<center>
 <table border="0" id="table-po">
     <tr>
<th><strong>Category</strong><font style="color:red;font-weight:bold;padding-top:10px"><sup>*</sup></font></th><td width="10px">&nbsp;</td>
<th><strong>Code</strong><font style="color:red;font-weight:bold;padding-top:10px"><sup>*</sup></font></th><td width="10px">&nbsp;</td>
<th><strong>Description</strong><font style="color:red;font-weight:bold;padding-top:10px"><sup>*</sup></font></th><td width="10px">&nbsp;</td>
<th><strong>Units</strong></th><td width="10px">&nbsp;</td>
<th><strong>Qty</strong><font style="color:red;font-weight:bold;padding-top:10px"><sup>*</sup></font></th><td width="10px">&nbsp;</td>
<?php if($_SESSION['db']=="feedatives" || $_SESSION['db']=="albustan" || $_SESSION['db']=="albustanlayer" ){?>
<th><strong>Free Qty</strong><font style="color:red;font-weight:bold;padding-top:10px"><sup>*</sup></font></th><td width="10px">&nbsp;</td>
<?php }?>
<th><strong>Price<br />/Unit</strong><font style="color:red;font-weight:bold;padding-top:10px"><sup>*</sup></font></th><td width="10px">&nbsp;</td>
<?php if($_SESSION['db']=='alkhumasiyabrd') { ?>
<th><strong>Bag</strong></th><td width="10px">&nbsp;</td>
<?php } ?>
<th><strong>Weight</strong></th><td width="10px">&nbsp;</td>
<?php if(($_SESSION['db'] == "golden") or ($_SESSION['db'] == "johnson")) { ?><th><strong>Unit</strong><td width="10px">&nbsp;</td><?php } ?>
<th><strong>Flock</strong></th><td width="10px">&nbsp;</td>
<?php if($_SESSION['db'] =='alkhumasiyabrd') { ?>
<th title="Received Date"><strong>R.Date</strong></th><td width="10px">&nbsp;</td> <?php } ?>
<?php if($_SESSION['db'] == "sumukh" || $_SESSION['db'] == "jeeval" || $_SESSION['db'] == "jeevalen") { ?>
<th><strong>Free Chicks</strong></th><td width="10px">&nbsp;</td><?php } ?>

     </tr>

     <tr style="height:20px"></tr>

     <tr>
 
       <td style="text-align:left;">
<select style="Width:100px" name="cat[]" id="cat@-1" onchange="getcode(this.id);">
     <option>-Select-</option>
     <?php 
	     $query = "SELECT distinct(type) FROM ims_itemtypes where type not in ( 'Broiler Birds') ORDER BY type ASC";
           $result = mysql_query($query,$conn);
           while($row = mysql_fetch_assoc($result))
           {
     ?>
             <option value="<?php echo $row['type'];?>"><?php echo $row['type']; ?></option>
     <?php } ?>
</select>
       </td>
       <td width="10px"></td>

       <td style="text-align:left;">
			<select style="Width:75px" name="code[]" id="code@-1" onchange="selectdesc(this.id);">
     		<option>-Select-</option>
     <?php 
	     $query = "SELECT distinct(code) FROM ims_itemcodes ORDER BY code ASC";
           $result = mysql_query($query,$conn);
           while($row = mysql_fetch_assoc($result))
           {
     ?>
             <!--<option value="<?php #echo $row['code'];?>"><?php #echo $row['code']; ?></option>-->
     <?php } ?>
</select>
       </td>
<td width="10px">&nbsp;</td><td>
<select style="Width:170px" name="description[]" id="description@-1" onchange="selectcode(this.id);">
     		<option>-Select-</option>
</select>
</td>
<td width="10px">&nbsp;</td><td>
<input type="text" size="8" id="units@-1" name="units[]" value="" readonly/>
</td>
<td width="10px">&nbsp;</td><td>
<input type="text" size="7" style="text-align:right;" id="qtys@-1" name="qtys[]" value="" onkeyup="calnet('');" onblur="calnet('');" />
</td>
<?php if($_SESSION['db']=="feedatives" || $_SESSION['db']=="albustan" || $_SESSION['db']=="albustanlayer" ){?>
<td width="10px">&nbsp;</td><td>
<input type="text" size="7" style="text-align:right;" id="fqty@-1" name="fqty[]" value="" />
</td><?php }?>
<td width="10px">&nbsp;</td><td>
<input type="text" size="6" id="price@-1" style="text-align:right;" name="price[]" value="" onfocus="makeForm();" onkeyup="calnet('');" onblur="calnet('');"/>
</td>
<?php if($_SESSION['db']=='alkhumasiyabrd') { ?>
<td width="10px">&nbsp;</td><td>
<select type="text" id="bagtype@-1" style="text-align:right; width:80px; display:none" name="bagtype[]" >
<option value="">-Select-</option>
<?php 
	       $query1 = "SELECT code,description FROM ims_itemcodes WHERE type = 'Packing Material' ORDER BY code ASC";
           $result1 = mysql_query($query1,$conn);
           while($row1 = mysql_fetch_assoc($result1))
           {
     ?>
	 <option title="<?php echo $row1[description];  ?>" value="<?php echo $row1[code];  ?>" ><?php echo $row1[code]; ?></option>
	 <?php } ?>
</select>
</td>
<?php } ?>
<td width="10px">&nbsp;</td><td>
<input type="text" size="6" id="weight@-1" style="text-align:right; display:none" name="weight[]" value="" onkeyup="calnet('');" onblur="calnet('');"/>
</td>
<td width="10px">&nbsp;</td>
<?php if(($_SESSION['db'] == "golden") or ($_SESSION['db'] == "johnson")) { ?>
<td>
<select id="unit@-1" name="unit[]" style="display:none">
<option value="">-Select Unit-</option>
<option value="All">All</option>

</select>
</td>
<td width="10px">&nbsp;</td>
<?php } ?>
<td>
<select id="flock@-1" <?php if($_SESSION['db'] =='alkhumasiyabrd') { ?> onchange="getrdate(this.id,this.value)" <?php } ?> name="flock[]" style="display:none">
<option value="">-Select Flock-</option>
<option value="All">All</option>

</select>
</td>
<td width="10px">&nbsp;</td>
<?php if($_SESSION['db'] =='alkhumasiyabrd') { ?>
<td>
<select id="rdate@-1" name="rdate[]" onchange="getrdateArray(this.id,this.value)" style="display:none">
<option value="">-Select-</option>
</select>
</td>
<td width="10px">&nbsp;</td>
<?php } ?>

<?php if($_SESSION['db'] == "sumukh" || $_SESSION['db'] == "jeeval" || $_SESSION['db'] == "jeevalen") { ?>
<td>
<input type="text" size="6" id="free@-1" style="text-align:right;" name="free[]" value=""/> 
</td>
<?php } ?>

    </tr>
   </table>
   <br /> 
 </center>

<br />			
<center>
<table border="1">
   <tr style="height:20px"></tr>
   <tr>
      <td align="right"><strong>Basic&nbsp;Amount</strong>&nbsp;&nbsp;&nbsp;</td>
      <td align="left"><input type="text" size="12" id="basic" name="basic" value="0" style="text-align:right" readonly /></td>
      <td align="right"><strong>Discount &nbsp;&nbsp;&nbsp;</strong></td>
          <td align="left"> <input type="radio" id="disper" name="discount" checked="true" onclick="calnet('dcreate')" /><strong>%</strong>&nbsp;<input type="radio" id="disper1" name="discount" onclick="calnet('dcreate')" /> <strong>Amt</strong>
      <input type="text" size="6" id="disamount" name="disamount" value="0" style="text-align:right" onkeyup="calnet('dcreate')" /></td>
      <td align="right"><strong>&nbsp;Broker&nbsp;Name</strong>&nbsp;&nbsp;</td>
      <td align="left"><select style="Width:120px" name="broker" id="broker"><option value="">-Select-</option>
           <?php $query = "SELECT distinct(name) FROM contactdetails where type = 'broker' ORDER BY name ASC"; $result = mysql_query($query,$conn);
                 while($row = mysql_fetch_assoc($result)){ ?>
           <option value="<?php echo $row['name'];?>" > <?php echo $row['name']; ?></option>
                <?php } ?></select></td>
      <td align="right" ><strong>Vehicle No.&nbsp;&nbsp;&nbsp;</strong></td>
      <td align="left"><input type="text" size="15" name="vno" /></td>
 </tr>
  <tr style="height:20px"></tr>
  <tr>
   <td align="right"><strong>Total&nbsp;Price</strong>&nbsp;&nbsp;</td>
   <td align="left"><input type="text" size="12" name="totalprice" id="totalprice" style="text-align:right" value="0" readonly/></td>
 <?php if($_SESSION['db'] == "feedatives"){?>  <td align="right"><strong>Discount &nbsp;&nbsp;&nbsp;</strong></td>
   <td><input type="radio" id="disper2" name="discount2" checked="true" onclick="calnet('dcreate')" /><strong>%</strong>&nbsp;<input type="radio" id="disper21" name="discount2" onclick="calnet('dcreate')" /> <strong>Amt</strong>
      <input type="text" size="6" id="disamount2" name="disamount2" value="0" style="text-align:right" onkeyup="calnet('dcreate')" /><?php } if($_SESSION['db'] != "feedatives"){?><td></td><td></td><?php } ?>
	 </td><td></td><td></td>
   <td align="right"><strong>Driver&nbsp;Name &nbsp;&nbsp;</strong></td>
    <?php if($_SESSION['country'] == 'INDIA') { ?>
   <td align="left"><input type="text" size="15" name="driver" /></td><?php } else {?>
   <td align="left">
   <select name="driver" id="driver" style="width:120px">
<option value="">-Select-</option>
<?php
           include "config.php"; 
           $query = "SELECT * FROM hr_employee where designation='Driver' AND client = '$client' ORDER BY name ASC ";
           $result = mysql_query($query,$conn); 
           while($row1 = mysql_fetch_assoc($result))
           {
?>
<option value="<?php echo $row1['name']; ?>"><?php echo $row1['name']; ?></option>
<?php } ?>
</select>		
   </td>
   <?php } ?>

  </tr>
  <tr style="height:20px"></tr>
  <tr style="height:20px"></tr>
   <tr>
       <td align="right"><strong>Freight</strong>&nbsp;&nbsp;&nbsp;</td>
       <td align="left"><select name="freighttype" id="freighttype" onchange="calnet('dcreate')"><option>-Select-</option> <option value="Included">Included</option><option value="Excluded">Excluded</option></select></td>

       <td align="right"><strong>Freight Amount</strong>&nbsp;&nbsp;&nbsp;</td>
       <td align="left"><input type="text" size="8" name="cfamount" id="cfamount" onkeyup="calnet('dcreate')" value="0" style="text-align:right"/>
	   &nbsp;&nbsp;
	   <select id="coa" name="coa" style="width:80px">
	   <option value="">-Select-</option>
	   <?php 
	   		$q = "select distinct(code),description from ac_coa where (controltype = '' or controltype is NULL) and type = 'Expense' and schedule = 'INDIRECT EXPENSES' and code not like 'CG%' and code not like  'PV%' and code not like  'PR%' and code not like 'WP%' order by code";
			$qrs = mysql_query($q,$conn) or die(mysql_error());
			while($qr = mysql_fetch_assoc($qrs))
			{
	   ?>
	   <option title="<?php echo $qr['description']; ?>" value="<?php echo $qr['code']; ?>"><?php echo $qr['code']; ?></option>
	   <?php } ?>
	   </select>
	   </td>
       <td align="right"><strong>Via</strong>&nbsp;&nbsp;&nbsp;</td>
       <td align="left"><select style="Width:80px" name="cvia" id="cvia" onchange="loadcodes(this.value);"><option value="">-Select-</option><option value="Cash">Cash</option><option value="Cheque">Cheque</option><option value="Others">Others</option></select></td>
	  <td align="right" id="cashbankcodetd1" style="display:none"><strong><span id="codespan">Code</span></strong>&nbsp;&nbsp;&nbsp;</td>
        <td align="left" id="cashbankcodetd2" style="display:none">
		<select name="cashbankcode" id="cashbankcode" style="width:125px">
		<option value="">-Select-</option>
		</select>
		</td>

</tr>
<tr style="height:20px"></tr>
<tr>
<td></td><td></td><td></td><td></td>
	  <td align="right" id="chequetd1" style="visibility:hidden"><strong>Cheque</strong>&nbsp;&nbsp;&nbsp;</td>
        <td align="left" id="chequetd2" style="visibility:hidden">
		<input type="text" name="cheque" id="cheque" size="15">
		</td>

       <td align="right" id="datedtd1" style="display:none"><strong>Dated</strong>&nbsp;&nbsp;&nbsp;</td>
       <td align="left" id="datedtd2" style="display:none"><input type="text" size="15" id="cdate" class="datepicker" name="cdate" value="<?php echo date("d.m.Y"); ?>" /></td>


</tr>
  <tr style="height:20px"></tr>
<tr>
	  <td align="right"><strong>&nbsp;Grand&nbsp;Total</strong>&nbsp;&nbsp;</td>
        <td align="left"><input type="text" size="12" name="tpayment" id="tpayment" value="0" readonly style="text-align:right"/></td>
</tr>
</table>	

<br />
<table>
<td style="vertical-align:middle;"><strong>Narration&nbsp;&nbsp;&nbsp;</strong></td>
<td>
<textarea id="remarks" cols="40"  rows="3" name="remarks"></textarea>
</td>
<td style="color:red;font-weight:bold;padding-top:10px">&nbsp;*Max 225 Characters</td>
</table>
<br />

   <br />
   <input type="submit" value="Save" id="save" name="save" style="margin-top:10px;" />
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <input name="button" type="button" onclick="document.location='dashboardsub.php?page=oc_directsales_a';" value="Cancel" />
</center>


						
</form>
</div>
</section>
<div class="clear">
</div>
<br />

<script type="text/javascript">

function getsobi()
{

  var date1 = document.getElementById('date').value;
  var strdot1 = date1.split('.');
  var ignore = strdot1[0];
  var m = strdot1[1];
  var y = strdot1[2].substr(2,4);
     var mon = new Array();
     var yea = new Array();
     var cobiincr = new Array();
    var cobi = "";
	var code = "<?php echo $code; ?>";
  <?php 
   
   $query1 = "SELECT MAX(cobiincr) as cobiincr,m,y FROM oc_cobi GROUP BY m,y ORDER BY date DESC";
   $result1 = mysql_query($query1) or die(mysql_error());
   $k = 0; 
   while($row1 = mysql_fetch_assoc($result1))
   {
?>
     mon[<?php echo $k; ?>] = <?php echo $row1['m']; ?>;
     yea[<?php echo $k; ?>] = <?php echo $row1['y']; ?>;
     cobiincr[<?php echo $k; ?>] = <?php if($row1['cobiincr'] < 0) { echo 0; } else { echo $row1['cobiincr']; } ?>;

<?php $k++; } ?>
for(var l = 0; l <= <?php echo $k; ?>;l++)
{

 if((yea[l] == y) && (mon[l] == m))
  { 
   if(cobiincr[l] < 10)
     cobi = 'COBI'+'-'+m+y+'-000'+parseInt(cobiincr[l]+1);
   else if(cobiincr[l] < 100 && cobiincr[l] >= 10)
     cobi = 'COBI'+'-'+m+y+'-00'+parseInt(cobiincr[l]+1);
   else
     cobi = 'COBI'+'-'+m+y+'-0'+parseInt(cobiincr[l]+1);
     document.getElementById('cobiincr').value = parseInt(cobiincr[l] + 1);
  break;
  }
 else
  {
   cobi = 'COBI' + '-' + m + y + '-000' + parseInt(1);
   document.getElementById('cobiincr').value = 1;
  }
}
document.getElementById('invoice').value = cobi;
document.getElementById('m').value = m;
document.getElementById('y').value = y;
}

function loadcodes(via)
{
removeAllOptions(document.getElementById('cashbankcode'));
var code = document.getElementById('cashbankcode');
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("-Select-");
theOption1.value = "";
theOption1.appendChild(theText1);
code.appendChild(theOption1);
document.getElementById('codespan').innerHTML = "Code";
document.getElementById('cashbankcodetd1').style.display = "none";
document.getElementById('cashbankcodetd2').style.display = "none";
document.getElementById('datedtd1').style.display = "none";
document.getElementById('datedtd2').style.display = "none";
document.getElementById('chequetd1').style.visibility = "hidden";
document.getElementById('chequetd2').style.visibility = "hidden";

if(via == "Cash")
{
document.getElementById('codespan').innerHTML = "Cash Code ";
document.getElementById('cashbankcodetd1').style.display = "";
document.getElementById('cashbankcodetd2').style.display = "";
document.getElementById('datedtd1').style.display = "";
document.getElementById('datedtd2').style.display = "";

	<?php 
		$q = "select distinct(code),name from ac_bankmasters where mode = 'Cash' order by code";
		$qrs = mysql_query($q) or die(mysql_error());
		while($qr = mysql_fetch_assoc($qrs))
		{
	?>
		theOption1=document.createElement("OPTION");
		theText1=document.createTextNode("<?php echo $qr['code']; ?>");
		theOption1.value = "<?php echo $qr['code']; ?>";
		theOption1.title = "<?php echo $qr['name']; ?>";
		theOption1.appendChild(theText1);
		code.appendChild(theOption1);
	<?php } ?>
}
else if(via == "Cheque"  || via == "Others")
{
document.getElementById('codespan').innerHTML = "Bank A/C No. ";
document.getElementById('cashbankcodetd1').style.display = "";
document.getElementById('cashbankcodetd2').style.display = "";
document.getElementById('datedtd1').style.display = "";
document.getElementById('datedtd2').style.display = "";
document.getElementById('chequetd1').style.visibility = "visible";
document.getElementById('chequetd2').style.visibility = "visible";


	<?php 
		$q = "select distinct(acno),name from ac_bankmasters where mode = 'Bank' order by acno";
		$qrs = mysql_query($q) or die(mysql_error());
		while($qr = mysql_fetch_assoc($qrs))
		{
	?>
		theOption1=document.createElement("OPTION");
		theText1=document.createTextNode("<?php echo $qr['acno']; ?>");
		theOption1.value = "<?php echo $qr['acno']; ?>";
		theOption1.title = "<?php echo $qr['name']; ?>";
		theOption1.appendChild(theText1);
		code.appendChild(theOption1);
	<?php } ?>
}
}

var index = -1;
function getdesc(code)
{
	var code1 = document.getElementById(code).value;
	temp = code.split("@");
	var index1 = temp[1];
	

	<?php 
			$q = "select distinct(code) from ims_itemcodes";
			$qrs = mysql_query($q) or die(mysql_error());
			while($qr = mysql_fetch_assoc($qrs))
			{
			echo "if(code1 == '$qr[code]') {";
			$q1 = "select distinct(description),sunits from ims_itemcodes where code = '$qr[code]' order by description";
			$q1rs = mysql_query($q1) or die(mysql_error());
			if($q1r = mysql_fetch_assoc($q1rs))
			{
	?>
	  
				document.getElementById('description@' + index1).value = "<?php echo $q1r['description'];?>";
				
				
				 <?php if($_SESSION['db'] == "alkhumasiyabrd") {  ?>
				  cat=document.getElementById('cat@' + index1).value;
				  if(cat=='Female Feed'||cat=='Male Feed')
				      document.getElementById('units@' + index1).value='Bags';
				  else
				      document.getElementById('units@' + index1).value = "<?php echo $q1r['sunits'];?>"; 
			     <?php } else { ?>	document.getElementById('units@' + index1).value = "<?php echo $q1r['sunits'];?>"; 
				 <?php } ?>
	<?php
			}
			echo "}";
			}
	?>
	//alert(index);
/* restrict the user to select same itemcode more than once
	for(var i = -1; i <= index; i++)
		for(var j = -1; j <= index; j++)
			if( i != j )
				if(document.getElementById('code@' + i).value == document.getElementById('code@' + j).value)
				{
				alert("Please select distinct codes");
				document.getElementById('description@' + j).value = "";
				document.getElementById('units@' + j).value = "";
				return;
				}
*/
}
var index = -1;
function selectdesc(codeid)
{
var temp = codeid.split("@");
var tempindex = temp[1];
var item2=document.getElementById("cat@" + tempindex).value;
var item1 = document.getElementById(codeid).value;
 //alert(t);
removeAllOptions(document.getElementById("description@" + tempindex));
myselect1 = document.getElementById("description@" + tempindex);
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("-Select-");
theOption1.value = "";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
myselect1.name = "description[]";
myselect1.style.width = "170px";
<?php 
	     $query1 = "SELECT code,description,cat FROM ims_itemcodes where iusage LIKE '%Sale%' ORDER BY code ";
           $result1 = mysql_query($query1,$conn);
           while($row1 = mysql_fetch_assoc($result1))
           {
		   ?>
     	 <?php echo "if(item2 == '$row1[cat]') {"; ?>
		   theOption1=document.createElement("OPTION");
theText1=document.createTextNode("<?php echo $row1['description']; ?>");
theOption1.value = "<?php echo $row1['description']; ?>";
theOption1.title = "<?php echo $row1['code']; ?>";


<?php echo "if(item1 == '$row1[code]') {"; ?>			
theOption1.selected = true;
var units = document.getElementById("units@" + tempindex);
<?php
			$q1 = "select distinct(description),sunits from ims_itemcodes where description = '$row1[description]' order by 
			description";
			$q1rs = mysql_query($q1) or die(mysql_error());
			if($q1r = mysql_fetch_assoc($q1rs))
			{
	?>
	
	
	             <?php if($_SESSION['db'] == "alkhumasiyabrd") {  ?>
				  cat=document.getElementById('cat@' + tempindex).value;
				  if(cat=='Female Feed'||cat=='Male Feed')
				      document.getElementById('units@' + tempindex).value='Bags';
				  else
				      document.getElementById('units@' + tempindex).value = "<?php echo $q1r['sunits'];?>"; 
			     <?php } else { ?>	document.getElementById('units@' + tempindex).value = "<?php echo $q1r['sunits'];?>"; 
				 <?php } ?>

<?php
			}
			
	?>

<?php echo "}"; ?>
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);

<?php echo "}"; ?>

<?php }  ?>
}


function getcterm(value)
{
value=value.split('@'); 
if(value[1]!='')
document.getElementById('cterm').value=value[1];
else
document.getElementById('cterm').value=0;
}
function selectcode(codeid)
{

var temp = codeid.split("@");
var tempindex = temp[1];
var item2 = document.getElementById("cat@" + tempindex).value;
var item1 = document.getElementById(codeid).value;
removeAllOptions(document.getElementById("code@" + tempindex));
myselect1 = document.getElementById("code@" + tempindex);
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("-Select-");
theOption1.value = "";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
myselect1.name = "code[]";
myselect1.style.width = "75px";
<?php 
	     $query1 = "SELECT code,description,cat,sunits FROM ims_itemcodes where iusage LIKE '%Sale%' ORDER BY code ";
           $result1 = mysql_query($query1,$conn);
           while($row1 = mysql_fetch_assoc($result1))
           {
		   ?>
		   <?php echo "if(item2 == '$row1[cat]') {"; ?>
		   theOption1=document.createElement("OPTION");
theText1=document.createTextNode("<?php echo $row1['code']; ?>");
theOption1.value = "<?php echo $row1['code']; ?>";
theOption1.title = "<?php echo $row1['description']; ?>";


     	<?php echo "if(item1 == '$row1[description]') {"; ?>
			
theOption1.selected = true;
var units = document.getElementById("units@" + tempindex);
<?php

			
			$q1 = "select distinct(description),sunits from ims_itemcodes where description = '$row1[description]' order by description";
			$q1rs = mysql_query($q1) or die(mysql_error());
			if($q1r = mysql_fetch_assoc($q1rs))
			{
	?>
                  <?php if($_SESSION['db'] == "alkhumasiyabrd") {  ?>
				  cat=document.getElementById('cat@' + tempindex).value;
				  if(cat=='Female Feed'||cat=='Male Feed')
				      document.getElementById('units@' + tempindex).value='Bags';
				  else
				      document.getElementById('units@' + tempindex).value = "<?php echo $q1r['sunits'];?>";
			     <?php } else { ?>	document.getElementById('units@' + tempindex).value = "<?php echo $q1r['sunits'];?>"; 
				 <?php } ?>

<?php
			}
			
	?>
<?php echo "}"; ?>
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
<?php echo "}"; ?>


<?php }  ?>
}



function getcode(cat)
{
	var cat1 = document.getElementById(cat).value;
	temp = cat.split("@");
	var index1 = temp[1];
	var i,j;
	//document.getElementById('bagtype@' + index1).style.display = "none";
	document.getElementById('flock@' + index1).style.display = "none";
	document.getElementById('weight@' + index1).style.display = "none";
	
	<?php
if($_SESSION['db'] == 'alkhumasiyabrd')
{
?>
	document.getElementById('bagtype@' + index1).style.display = "none";
	
	if(cat1=='Female Feed' || cat1=='Male Feed') 
	   document.getElementById('bagtype@' + index1).style.display = "block";
	
<?php }
if($_SESSION['client'] == 'KEHINDE')
{
?>
if(cat1 == 'Turkey Female Birds' || cat1 == 'Turkey Male Birds'|| cat1 == 'Turkey Female Feed'|| cat1 == 'Turkey Male Feed'|| cat1 == 'Turkey Hatch Eggs'|| cat1 == 'Turkey Eggs')
{
document.getElementById('flock@' + index1).style.display = "block";
document.getElementById('weight@' + index1).style.display = "none";
removeAllOptions(document.getElementById('flock@' + index1));
myselect1 = document.getElementById('flock@' + index1);
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("-Select-");
theOption1.value = "";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
myselect1.name = "flock[]";

myselect1.id = "flock@" + index;
myselect1.style.width = "120px";
<?php
$query1 = "SELECT distinct(flockcode)  FROM turkey_flock WHERE client = '$client' and cullflag='0' ORDER BY flockcode ASC";
$result1 = mysql_query($query1,$conn) or die(mysql_error());
while($rows1 = mysql_fetch_assoc($result1))
{
?>
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("<?php echo $rows1['flockcode']; ?>");
theOption1.value = "<?php echo $rows1['flockcode']; ?>";
theOption1.title = "<?php echo $rows1['flockcode']; ?>";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);

<?php
}
?>
}
<?php	
}?>
<?php
if($_SESSION['client'] == 'KEHINDE')
{
?>
if((cat1 == 'Fattener') || (cat1 == 'Sow') || (cat1 == 'Boar'))
{
document.getElementById('flock@' + index1).style.display = "block";
document.getElementById('weight@' + index1).style.display = "block";
removeAllOptions(document.getElementById('flock@' + index1));
myselect1 = document.getElementById('flock@' + index1);
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("-Select-");
theOption1.value = "";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
myselect1.name = "flock[]";

myselect1.id = "flock@" + index;
myselect1.style.width = "90px";
<?php
$query1 = "SELECT distinct(herdcode)  FROM pig_herd WHERE client = '$client' and cullflag='0' ORDER BY herdcode ASC";
$result1 = mysql_query($query1,$conn) or die(mysql_error());
while($rows1 = mysql_fetch_assoc($result1))
{
?>
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("<?php echo $rows1['herdcode']; ?>");
theOption1.value = "<?php echo $rows1['herdcode']; ?>";
theOption1.title = "<?php echo $rows1['herdcode']; ?>";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);

<?php
}
?>
}
<?php 	
}?>
	if((cat1 == "Broiler Birds") || (cat1 == "Broiler Chicks"))
	{
if (cat1 == "Broiler Birds")
document.getElementById('weight@' + index1).style.display = "";
	document.getElementById('flock@' + index1).style.display = "";
	removeAllOptions(document.getElementById('flock@' + index1));
	myselect1 = document.getElementById('flock@' + index1);
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("-Select Farm-");
theOption1.value = "";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);


myselect1.name = "flock[]";


myselect1.id = "flock@" + index;
myselect1.style.width = "120px";

<?php 
	     //$query1 = "SELECT distinct(farm) as 'farm' FROM broiler_farm ORDER BY farm ASC";
		 
		 $query1 = "SELECT * FROM tbl_sector WHERE type1 = 'Hatchery' AND client = '$client'";
           $result1 = mysql_query($query1,$conn);
		   $n1 = mysql_num_rows( $result1);
		   if(($n1 == 0) OR ($n1 == ""))
 			{
			$query1 = "SELECT * FROM tbl_sector WHERE type1 = 'Warehouse' AND client = '$client'";
           $result1 = mysql_query($query1,$conn);
		   }
           while($row1 = mysql_fetch_assoc($result1))
           {
     ?>
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("<?php echo $row1['sector']; ?>");
theOption1.value = "<?php echo $row1['sector']; ?>";
theOption1.title = "<?php echo $row1['sector']; ?>";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
<?php }  ?>
}

if((cat1 == "Female Birds") || (cat1 == "Male Birds"))
	{
	document.getElementById('flock@' + index1).style.display = "";
document.getElementById('weight@' + index1).style.display = "";
	removeAllOptions(document.getElementById('flock@' + index1));
	myselect1 = document.getElementById('flock@' + index1);
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("-Select Flock-");
theOption1.value = "";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
myselect1.name = "flock[]";


myselect1.id = "flock@" + index;
myselect1.style.width = "120px";

<?php 
	     $query1 = "SELECT distinct(flockcode)  FROM breeder_flock WHERE client = '$client' and cullflag='0' ORDER BY flockcode ASC";
           $result1 = mysql_query($query1,$conn);
           while($row1 = mysql_fetch_assoc($result1))
           {
     ?>
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("<?php echo $row1['flockcode']; ?>");
theOption1.value = "<?php echo $row1['flockcode']; ?>";
theOption1.title = "<?php echo $row1['flockcode']; ?>";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
<?php }  ?>
}
	

if((cat1 == "Hatch Eggs") || (cat1 == "Eggs") <?php if($_SESSION['db']=="chowdarypf"){?> || (cat1== "Birds")<?php } ?>)
	{
	<?php if(($_SESSION['db'] == "golden") or ($_SESSION['db'] == "johnson")) { ?>
	document.getElementById('unit@' + index1).style.display = "";
	removeAllOptions(document.getElementById('unit@' + index1));
	myselect1 = document.getElementById('unit@' + index1);
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("-Select-");
theOption1.value = "";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);


myselect1.name = "unit[]";


myselect1.id = "unit@" + index;
myselect1.style.width = "120px";
myselect1.onchange = function () { getflock(this.id); };

<?php 
 $query1 = "SELECT distinct(unitcode)  FROM breeder_unit ORDER BY unitdescription ASC";
           $result1 = mysql_query($query1,$conn);
           while($row1 = mysql_fetch_assoc($result1))
/*	     $query1 = "SELECT distinct(shedcode)  FROM breeder_shed ORDER BY shedcode ASC";
           $result1 = mysql_query($query1,$conn);
           while($row1 = mysql_fetch_assoc($result1))*/
           {
     ?>
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("<?php echo $row1['unitcode']; ?>");
theOption1.value = "<?php echo $row1['unitcode']; ?>";
theOption1.title = "<?php echo $row1['unitcode']; ?>";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
<?php }   ?>
document.getElementById('flock@' + index1).style.display = "";
	removeAllOptions(document.getElementById('flock@' + index1));
	
<?php } else { ?>
	document.getElementById('flock@' + index1).style.display = "";
	<?php if($_SESSION[db]=='alkhumasiyabrd') { ?>document.getElementById('rdate@' + index1).style.display = ""; <?php } ?>
	removeAllOptions(document.getElementById('flock@' + index1));
	myselect1 = document.getElementById('flock@' + index1);
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("-Select-");
theOption1.value = "";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);

<?php if($_SESSION[db]!='alkhumasiyabrd') { ?>
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("All");
theOption1.value = "All";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);

<?php } ?>
myselect1.name = "flock[]";


myselect1.id = "flock@" + index;
myselect1.style.width = "120px";

<?php 
 if($_SESSION[db]=='alkhumasiyabrd')
  $query1 = "SELECT distinct(flkmain) as flockcode  FROM breeder_flock WHERE client = '$client' and cullflag='0' ORDER BY flkmain ASC";
 else
 $query1 = "SELECT distinct(flockcode)  FROM breeder_flock WHERE client = '$client' and cullflag='0' ORDER BY flockcode ASC";
           $result1 = mysql_query($query1,$conn);
           while($row1 = mysql_fetch_assoc($result1))
/*	     $query1 = "SELECT distinct(shedcode)  FROM breeder_shed ORDER BY shedcode ASC";
           $result1 = mysql_query($query1,$conn);
           while($row1 = mysql_fetch_assoc($result1))*/
           {
     ?>
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("<?php echo $row1['flockcode']; ?>");
theOption1.value = "<?php echo $row1['flockcode']; ?>";
theOption1.title = "<?php echo $row1['flockcode']; ?>";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
<?php }   ?>
<?php } ?>
}

<?php if($_SESSION['db'] == 'mlcf')
{?>
if(cat1 == "Layer Birds")
{
document.getElementById('flock@' + index1).style.display = "";
removeAllOptions(document.getElementById('flock@' + index1));
myselect1 = document.getElementById('flock@' + index1);
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("-Select-");
theOption1.value = "";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
myselect1.name = "flock[]";
myselect1.id = "flock@" + index;
myselect1.style.width = "120px";
<?php 
$query1 = "SELECT distinct(flockcode)  FROM layer_flock WHERE client = '$client' and cullflag='0' ORDER BY flockcode ASC";
           $result1 = mysql_query($query1,$conn);
           while($row1 = mysql_fetch_assoc($result1))
           {
     ?>
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("<?php echo $row1['flockcode']; ?>");
theOption1.value = "<?php echo $row1['flockcode']; ?>";
theOption1.title = "<?php echo $row1['flockcode']; ?>";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);

<?php }   ?>
}
<?php } ?>


<?php
if($_SESSION['db'] == "albustan") {
	?>
	if(cat1 == "Quail Male Birds" || cat1 == "Quail Female Birds" || cat1 == "Quail Eggs" || cat1 == "Quail Hatch Eggs")
 { 
 document.getElementById('flock@' + index1).style.display = "";
removeAllOptions(document.getElementById('flock@' + index1));
myselect1 = document.getElementById('flock@' + index1);
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("-Select-");
theOption1.value = "";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
  <?php
  $query = "SELECT flockcode FROM quail_flock ORDER BY flockcode";
  $result = mysql_query($query,$conn) or die(mysql_error());
  while($rows = mysql_fetch_assoc($result))
  {
   ?>
	theOption1=document.createElement("OPTION");
	theText1=document.createTextNode("<?php echo $rows['flockcode']; ?>");
	theOption1.value = "<?php echo $rows['flockcode']; ?>";
	theOption1.appendChild(theText1);
	myselect1.appendChild(theOption1);   
  <?php
  }
  ?>
 }
 else if(cat1 == "Quail Chicks" || cat1 == "Fattener Birds")
 {
 document.getElementById('flock@' + index1).style.display = "";
removeAllOptions(document.getElementById('flock@' + index1));
myselect1 = document.getElementById('flock@' + index1);
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("-Select-");
theOption1.value = "";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
  <?php
  $query = "SELECT farm FROM quail_broiler_farm ORDER BY farm";
  $result = mysql_query($query,$conn) or die(mysql_error());
  while($rows = mysql_fetch_assoc($result))
  {
   ?>
	theOption1=document.createElement("OPTION");
	theText1=document.createTextNode("<?php echo $rows['farm']; ?>");
	theOption1.value = "<?php echo $rows['farm']; ?>";
	theOption1.appendChild(theText1);
	myselect1.appendChild(theOption1);   
  <?php
  }
  ?> 
 }	
	<?php
}
?>

	removeAllOptions(document.getElementById('code@' + index1));
			  var code = document.getElementById('code@' + index1);
              theOption1=document.createElement("OPTION");
              theText1=document.createTextNode("-Select-");
	        theOption1.value = "";
              theOption1.appendChild(theText1);
              code.appendChild(theOption1);
			  
			   
	removeAllOptions(document.getElementById('description@' + index1));  
			 var description = document.getElementById('description@' + index1); 
              // for description starts
 
              theOption1=document.createElement("OPTION");
              theText1=document.createTextNode("-Select-");
	        theOption1.value = "";
              theOption1.appendChild(theText1);
              description.appendChild(theOption1);
	
            // for description ends
			 
	

	<?php 
			$q = "select distinct(type) from ims_itemtypes";
			$qrs = mysql_query($q) or die(mysql_error());
			while($qr = mysql_fetch_assoc($qrs))
			{
			echo "if(cat1 == '$qr[type]') {";
			$q1 = "select distinct(code),description from ims_itemcodes where cat = '$qr[type]' and iusage LIKE '%Sale%' order by code";
			$q1rs = mysql_query($q1) or die(mysql_error());
			while($q1r = mysql_fetch_assoc($q1rs))
			{
	?>
              theOption1=document.createElement("OPTION");
              theText1=document.createTextNode("<?php echo $q1r['code'];?>");
              theOption1.appendChild(theText1);
	        theOption1.value = "<?php echo $q1r['code'];?>";
	        theOption1.title = "<?php echo $q1r['description'];?>";
              code.appendChild(theOption1);
			  
			   <?php } ?> 
			// for description starts
  <?php 
  $q1 = "select distinct(code),description from ims_itemcodes where cat = '$qr[type]' and iusage LIKE '%Sale%' order by description";
			$q1rs = mysql_query($q1) or die(mysql_error());
			while($q1r = mysql_fetch_assoc($q1rs))
			{
	?>
              theOption1=document.createElement("OPTION");
              theText1=document.createTextNode("<?php echo $q1r['description'];?>");
              theOption1.appendChild(theText1);
	        theOption1.value = "<?php echo $q1r['description']; ?>";
	        theOption1.title = "<?php echo $q1r['code'];?>";
              description.appendChild(theOption1);
 
           // for description ends 
	<?php
			}
			echo "}";
			}
	?>

}
function getflock(unt)
{
 var ware1 = document.getElementById(unt).value;
  var ware = unt;
  temp = ware.split("@");
	var index11 = temp[1];
  removeAllOptions(document.getElementById('flock@' + index11));
	myselect1 = document.getElementById('flock@' + index11);
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("-Select-");
theOption1.value = "";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);




myselect1.name = "flock[]";


myselect1.id = "flock@" + index11;
myselect1.style.width = "120px";
  <?php 
			$q = "select distinct(unitcode) from breeder_unit";
			$qrs = mysql_query($q) or die(mysql_error());
			while($qr = mysql_fetch_assoc($qrs))
			{
			echo "if(ware1 == '$qr[unitcode]') {";
			$q1 = "select distinct(flkmain) from breeder_flock where client = '$client' and cullflag='0' and unitcode = '$qr[unitcode]' order by flkmain ";
			$q1rs = mysql_query($q1) or die(mysql_error());
			while($q1r = mysql_fetch_assoc($q1rs))
			{
			
	?>
	
              theOption1=document.createElement("OPTION");
              theText1=document.createTextNode("<?php echo $q1r['flkmain'];?>");
              theOption1.appendChild(theText1);
	        theOption1.value = "<?php echo $q1r['flkmain'];?>";
	        theOption1.title = "<?php echo $q1r['flkmain'];?>";
              myselect1.appendChild(theOption1);
	<?php
			}
			echo "}";
			}
	?>
}
function removeAllOptions(selectbox)
{
	var i;
	for(i=selectbox.options.length-1;i>=0;i--)
	{
		selectbox.options.remove(i);
		selectbox.remove(i);
	}
}

function makeForm() 
{
if(index== -1)
{
makeForm1();
}
else 
{
var ind= index-1;
if(document.getElementById('price@'+ind).value != "")
{
makeForm1();
}
}
}

function makeForm1() 
{
index = index + 1 ;

///////////para element//////////
var etd = document.createElement('td');
etd.width = "10px";
theText1=document.createTextNode('\u00a0');
etd.appendChild(theText1);

var etd1 = document.createElement('td');
etd1.width = "10px";
theText1=document.createTextNode('\u00a0');
etd1.appendChild(theText1);

var etd2 = document.createElement('td');
etd2.width = "10px";
theText1=document.createTextNode('\u00a0');
etd2.appendChild(theText1);

var etd3 = document.createElement('td');
etd3.width = "10px";
theText1=document.createTextNode('\u00a0');
etd3.appendChild(theText1);

var etd4 = document.createElement('td');
etd4.width = "10px";
theText1=document.createTextNode('\u00a0');
etd4.appendChild(theText1);

var etd5 = document.createElement('td');
etd5.width = "10px";
theText1=document.createTextNode('\u00a0');
etd5.appendChild(theText1); 

var etd6 = document.createElement('td');
etd6.width = "10px";
theText1=document.createTextNode('\u00a0');
etd6.appendChild(theText1);

var etd7 = document.createElement('td');
etd7.width = "10px";
theText1=document.createTextNode('\u00a0');
etd7.appendChild(theText1);

var etd8 = document.createElement('td');
etd8.width = "10px";
theText1=document.createTextNode('\u00a0');
etd8.appendChild(theText1);

var etd9 = document.createElement('td');
etd9.width = "10px";
theText1=document.createTextNode('\u00a0');
etd9.appendChild(theText1);

var etd10 = document.createElement('td');
etd10.width = "10px";
theText1=document.createTextNode('\u00a0');
etd10.appendChild(theText1);

<?php if($_SESSION[db]=='alkhumasiyabrd') { ?>
var etd11 = document.createElement('td');
etd11.width = "10px";
theText1=document.createTextNode('\u00a0');
etd11.appendChild(theText1);
<?php } ?>

var t  = document.getElementById('table-po');

var r  = document.createElement('tr');
r.setAttribute ("align","center");

myselect1 = document.createElement("select");
myselect1.name = "cat[]";
myselect1.id = "cat@" + index;
myselect1.style.width = "100px";
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("-Select-");
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
myselect1.onchange = function () { getcode(this.id); };
<?php 
                       $query = "SELECT distinct(type) FROM ims_itemtypes where type not in ( 'Broiler Birds') ORDER BY type";
                       $result = mysql_query($query); 
                       while($row1 = mysql_fetch_assoc($result))
                       {
?>
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("<?php echo $row1['type']; ?>");
theOption1.appendChild(theText1);
theOption1.value = "<?php echo $row1['type']; ?>";
myselect1.appendChild(theOption1);
<?php } ?>
var type = document.createElement('td');
type.appendChild(myselect1);

myselect1 = document.createElement("select");
myselect1.name = "code[]";
myselect1.id = "code@" + index;
myselect1.style.width = "75px";
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("-Select-");
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
myselect1.onchange = function () { selectdesc(this.id); };
var code = document.createElement('td');
code.appendChild(myselect1);


// for description start

myselect1 = document.createElement("select");
myselect1.name = "description[]";
myselect1.id = "description@" + index;
myselect1.style.width = "170px";
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("-Select-");
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
myselect1.onchange = function () { selectcode(this.id); };

// for description end


var desc = document.createElement('td');
//desc.appendChild(mybox1);
desc.appendChild(myselect1);//for description


mybox1=document.createElement("input");
mybox1.size="8";
mybox1.type="text";
mybox1.name="units[]";
mybox1.id = "units@" + index;
mybox1.setAttribute("readonly");

var units = document.createElement('td');
units.appendChild(mybox1);


mybox1=document.createElement("input");
mybox1.size="7";
mybox1.type="text";
mybox1.id="qtys@" + index;
mybox1.style.textAlign = "right";
mybox1.name="qtys[]";
mybox1.onkeyup = function () { calnet(''); };
mybox1.onblur = function () { calnet(''); };
var qst = document.createElement('td');
qst.appendChild(mybox1);


mybox1=document.createElement("input");
mybox1.size="7";
mybox1.type="text";
mybox1.id="fqty@" + index;
mybox1.style.textAlign = "right";
mybox1.name="fqty[]";
//mybox1.onkeyup = function () { calnet(''); };
//mybox1.onblur = function () { calnet(''); };
var fqty = document.createElement('td');
fqty.appendChild(mybox1);

/*
mybox1=document.createElement("input");
mybox1.size="7";
mybox1.type="text";
mybox1.id="fqty@" + index;
mybox1.name="fqty[]";
mybox1.style.textAlign = "right";
//mybox1.onkeyup = function () { calnet(''); };
//mybox1.onblur = function () { calnet(''); };
var fqty = document.createElement('td');
fqty.appendChild(mybox1);*/

////////// Fourth TD ////////////


mybox1=document.createElement("input");
mybox1.size="3";
mybox1.type="text";
mybox1.name="bags[]";
mybox1.style.textAlign = "right";
mybox1.id = "bags@" + index;
var bags = document.createElement('td');
bags.appendChild(mybox1);

////////// Fifth TD /////////////



////////// Sixth TD ////////////


mybox1=document.createElement("input");
mybox1.size="6";
mybox1.type="text";
mybox1.id="price@" + index;
mybox1.name="price[]";
mybox1.style.textAlign = "right";
mybox1.onfocus = function () { makeForm(); };
mybox1.onkeyup = function () { calnet(''); };
mybox1.onblur = function () { calnet(''); };
var price = document.createElement('td');
price.appendChild(mybox1);

//
myselect1 = document.createElement("select");
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("-Select-");
theOption1.value = "";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
myselect1.name = "bagtype[]";
myselect1.style.display = "none";
myselect1.id = "bagtype@" + index;
myselect1.style.width = "80px";

<?php 
	     $query1 = "SELECT code,description FROM ims_itemcodes WHERE type = 'Packing Material' ORDER BY code ASC";
           $result1 = mysql_query($query1,$conn);
           while($row1 = mysql_fetch_assoc($result1))
           {
     ?>
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("<?php echo $row1['code']; ?>");
theOption1.value = "<?php echo $row1['code']; ?>";
theOption1.title = "<?php echo $row1['description']; ?>";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
<?php }  ?>

var bagtype = document.createElement('td');
bagtype.appendChild(myselect1);
//

mybox1=document.createElement("input");
mybox1.size="6";
mybox1.type="text";
mybox1.id="weight@" + index;
mybox1.name="weight[]";
mybox1.style.textAlign = "right";
mybox1.style.display = "none";
mybox1.onkeyup = function () { calnet(''); };
mybox1.onblur = function () { calnet(''); };
var weight = document.createElement('td');
weight.appendChild(mybox1);

////////// Seventh TD ////////////

myselect2 = document.createElement("select");
myselect2.id="vat@" + index;
myselect2.name = "vat[]";
myselect2.onchange = function () { calnet(''); };
myselect2.style.width = "60px";

theOption2=document.createElement("OPTION");
theText2=document.createTextNode("None");
theOption2.appendChild(theText2);
theOption2.value = 0;
myselect2.appendChild(theOption2);

<?php 
   $query = "SELECT distinct(code),codevalue FROM ims_taxcodes where type = 'Tax' ORDER BY code ASC";
   $result = mysql_query($query,$conn); 
   while($row1 = mysql_fetch_assoc($result))
   {
?>
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("<?php echo $row1['code']; ?>");
theOption1.appendChild(theText1);
theOption1.value = "<?php echo $row1['codevalue']; ?>";
myselect2.appendChild(theOption1);
<?php } ?>

var vat = document.createElement('td');
vat.appendChild(myselect2);

myselect2 = document.createElement("select");
myselect2.id="flock@" + index;
myselect2.name = "flock[]";
<?php if($_SESSION[db]=='alkhumasiyabrd') { ?>
myselect2.onchange=function() { getrdate(this.id,this.value);}
<?php } ?>
myselect2.style.display = "none";
theOption2=document.createElement("OPTION");
theText2=document.createTextNode("-Select Flock-");
theOption2.appendChild(theText2);
theOption2.value = 0;
myselect2.appendChild(theOption2);

var flock = document.createElement('td');
flock.appendChild(myselect2);

<?php if($_SESSION[db]=='alkhumasiyabrd') { ?>
myselect2 = document.createElement("select");
myselect2.id="rdate@" + index;
myselect2.name = "rdate[]";
myselect2.style.display = "none";
myselect2.onchange=function() { getrdateArray(this.id,this.value);}
theOption2=document.createElement("OPTION");
theText2=document.createTextNode("-Select-");
theOption2.appendChild(theText2);
theOption2.value = 0;
myselect2.appendChild(theOption2);

var rdate = document.createElement('td');
rdate.appendChild(myselect2);
<?php } ?>

myselect2 = document.createElement("select");
myselect2.id="unit@" + index;
myselect2.name = "unit[]";
myselect2.style.display = "none";
theOption2=document.createElement("OPTION");
theText2=document.createTextNode("-Select-");
theOption2.appendChild(theText2);
theOption2.value = 0;
myselect2.appendChild(theOption2);

var unitt = document.createElement('td');
unitt.appendChild(myselect2);

input = document.createElement("input");
input.type = "hidden";
input.id = "taxamount@" + index;
input.name = "taxamount[]";

///////////eighth td///

mybox1=document.createElement("input");
mybox1.size="6";
mybox1.type="text";
mybox1.name="free[]";
mybox1.style.textAlign = "right";
mybox1.id = "free@" + index;
var free = document.createElement('td');
free.appendChild(mybox1);
	   
      r.appendChild(type);
	  r.appendChild(etd8);
      r.appendChild(code);
	  r.appendChild(etd);
      r.appendChild(desc);
	  r.appendChild(etd1);
	  r.appendChild(units);
	  r.appendChild(etd2);
	  r.appendChild(qst);
	  r.appendChild(etd3);
 <?php if($_SESSION['db']=="feedatives" || $_SESSION['db']=="albustan" || $_SESSION['db']=="albustanlayer" ){?> 
	  r.appendChild(fqty);
	 r.appendChild(etd4);
	 <?php }?>
	  //r.appendChild(bags);
	  
	 // r.appendChild(etd6);
	  r.appendChild(price);
	  <?php if($_SESSION['db']=="alkhumasiyabrd"){?> 
	  r.appendChild(etd5);
	  r.appendChild(bagtype);
	  <?php } ?>
	  r.appendChild(etd7);
	  r.appendChild(weight);
	  r.appendChild(etd6);
	  <?php if(($_SESSION['db'] == "golden") or ($_SESSION['db'] == "johnson")) {  ?>
	  r.appendChild(unitt);
	   r.appendChild(etd10);
	   <?php } ?>
	  r.appendChild(flock); 
	  r.appendChild(etd9);
	  <?php if($_SESSION['db']=="alkhumasiyabrd"){?> 
	  r.appendChild(rdate);
	  r.appendChild(etd11);
	  <?php } ?>
	  <?php if($_SESSION['db'] == "sumukh" || $_SESSION['db'] == "jeeval" || $_SESSION['db'] == "jeevalen") { ?>
r.appendChild(free);
<?php } ?>
	  

	  //r.appendChild(etd4);
	  
	  //r.appendChild(vat);
	
	  r.appendChild(input);
      t.appendChild(r);
}

function calnet(a)
{
 var tot = 0; 
 var tot1 = 0; 
 var tpayment = 0;
 document.getElementById('basic').value = 0;
 document.getElementById('totalprice').value = 0;
 
 for(k = -1;k < index;k++)
 {
  //var vat = document.getElementById("vat@" + k).value;
  var vat = 0;
  
if ((document.getElementById('cat@' + k).value == "Boar") ||(document.getElementById('cat@' + k).value == "Sow") ||(document.getElementById('cat@' + k).value == "Fattener") ||(document.getElementById('cat@' + k).value == "Broiler Birds") || (document.getElementById('cat@' + k).value == "Female Birds") || (document.getElementById('cat@' + k).value == "Male Birds"))
{
  if(document.getElementById("weight@" + k).value != "" || document.getElementById("price@" + k).value != "")
  tot = tot + (document.getElementById("weight@" + k).value * document.getElementById("price@" + k).value);
  if(vat != '0' && vat != "")
  tot = tot + ((document.getElementById("weight@" + k).value * document.getElementById("price@" + k).value)/(document.getElementById("vat@" + k).value));
}
else
{
  if(document.getElementById("qtys@" + k).value != "" || document.getElementById("price@" + k).value != "")
  tot = tot + (document.getElementById("qtys@" + k).value * document.getElementById("price@" + k).value);
  if(vat != '0' && vat != "")
  tot = tot + ((document.getElementById("qtys@" + k).value * document.getElementById("price@" + k).value)/(document.getElementById("vat@" + k).value));
}
  
  
 // document.getElementById('taxamount@' + k).value = ((document.getElementById("qtys@" + k).value * document.getElementById("price@" + k).value)/(document.getElementById("vat@" + k).value));
 }
 
 document.getElementById('basic').value = round_decimals(tot,3);
 
if(document.getElementById("disper").checked)
{
 var disamount = (parseFloat(document.getElementById("disamount").value) / 100) * tot;
}
else
{
 var disamount = parseFloat(document.getElementById("disamount").value);
}

document.getElementById('discountamount').value = disamount;

 tot1 = tot - disamount;
 
document.getElementById('totalprice').value = round_decimals(tot1,3);

if(document.getElementById("freighttype").value == "Included")
{
  var freight = parseFloat(document.getElementById("cfamount").value);
 <?php if($_SESSION['db'] == 'maharashtra') { ?>tot1 = tot1 - freight;
 <?php } else { ?>  tot1 = tot1; <?php } ?>
}
if(document.getElementById("freighttype").value == "Excluded")
{
  var freight = parseFloat(document.getElementById("cfamount").value);
  tot1 = tot1 + freight;
}

<?php if($_SESSION['db'] == "feedatives")
{
?>
if(document.getElementById("disper2").checked)
{
 var disamount = (parseFloat(document.getElementById("disamount2").value) / 100) * tot1;
 tot1=tot1-disamount;
}
else
{
 var disamount = parseFloat(document.getElementById("disamount2").value);
 tot1=tot1-disamount;
}
document.getElementById('finaldiscount').value= round_decimals(disamount,3);
<?php }?>


document.getElementById("tpayment").value = round_decimals(tot1,3);

}


function checkcoa()
{

if(document.getElementById('party').selectedIndex == 0)
{
 alert("Please select Customer");
 document.getElementById('party').focus();
 return false;
}
if(document.getElementById('aaa').selectedIndex == 0)
{
 alert("Please select Warehouse");
 document.getElementById('aaa').focus();
 return false;
}
<?php if($_SESSION['db'] == "skdnew")
        {?>
                
        
if(document.getElementById('bookinvoice').value=="")
        {
                alert("Enter Book Invoice  ");
				document.getElementById('bookinvoice').focus();
                return false;
        }
        
		<?php
		
		  $query1 = "select distinct(bookinvoice) from oc_cobi";
		 $res1 = mysql_query($query1,$conn) or die(mysql_error());
		 while($qhr1 = mysql_fetch_assoc($res1))
		 {
		 $bookinvoice = $qhr1['bookinvoice'];
		 ?>
		var a= document.getElementById('bookinvoice').value;
		
		 if(a=="<?php echo $bookinvoice;?>")
		 {
		 alert("BookInvoice already exists");
		 document.getElementById('bookinvoice').focus();
		 return false;
		 
		 }
		 <?php } }?>
//alert(index);
for(var i=-1;i<=index;i++)
{
//alert(i);
//alert(document.getElementById('flock@'+i).style.display);
//if(document.getElementById('code@'+i).selectedIndex != 0 && document.getElementById('flock@'+i).style.visibility != "hidden")
if(document.getElementById('flock@'+i).style.display != "none")
{
if(document.getElementById('code@'+i).selectedIndex != 0 && document.getElementById('flock@'+i).selectedIndex == 0)
{
alert("Please select Flock");
document.getElementById('flock@'+i).focus();
return false;
}
}
}


	if(document.getElementById('cfamount').value != "" && document.getElementById('cfamount').value != "0")
	{
	   
		if(document.getElementById('coa').selectedIndex == 0)
		{
			alert("Please select Chart of Account");
			document.getElementById('coa').focus();
			return false;
		}
		else if (document.getElementById('cvia').selectedIndex == 0)
		{
		   alert("Please select Mode");
			document.getElementById('cvia').focus();
			return false;
		}	
		else if (document.getElementById('cashbankcode').selectedIndex == 0)
		{
		   alert("Please select Payment Code");
			document.getElementById('cashbankcode').focus();
			return false;
		}	
	}
	else
	{
	return true;
	}
}

function round_decimals(original_number, decimals) {
    var result1 = original_number * Math.pow(10, decimals)
    var result2 = Math.round(result1)
    var result3 = result2 / Math.pow(10, decimals)
    return pad_with_zeros(result3, decimals)
}

function pad_with_zeros(rounded_value, decimal_places) {

   var value_string = rounded_value.toString()
    
   var decimal_location = value_string.indexOf(".")

   if (decimal_location == -1) {
        
      decimal_part_length = 0
        
      value_string += decimal_places > 0 ? "." : ""
    }
    else {
        decimal_part_length = value_string.length - decimal_location - 1
    }
    var pad_total = decimal_places - decimal_part_length
    if (pad_total > 0) {
        for (var counter = 1; counter <= pad_total; counter++) 
            value_string += "0"
        }
    return value_string
}

<?php if($_SESSION[db]=='alkhumasiyabrd') { ?>

function getrdate(id,flock)
{
var array1=id.split('@');
index_rdate=array1[1];
removeAllOptions(document.getElementById('rdate@'+index_rdate));
myselect1 = document.getElementById('rdate@'+index_rdate);
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("-Select-");
theOption1.appendChild(theText1);
theOption1.value = "";
myselect1.appendChild(theOption1);
<?php
$query="select distinct(flock) from ims_eggreceiving ";
$result=mysql_query($query);
while($array=mysql_fetch_assoc($result))
{
echo "if(flock=='$array[flock]') {   "; 
 $query="select date,age,sum(availableeggs) as availableeggs from ims_eggreceiving where flock='$array[flock]' and tocode in (select code from ims_itemcodes where cat='hatch eggs') and availableeggs >0 group by date order by date";
$result1=mysql_query($query);
while($array1=mysql_fetch_assoc($result1))
{
 
 echo "if(!rdateArray.inArray('".date('d.m.Y',strtotime($array1['date'])).",$array[flock]')) {";
 ?>
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("<?php echo date("d.m.Y",strtotime($array1['date'])); ?>");
theOption1.appendChild(theText1);
theOption1.value = "<?php echo date("d.m.Y",strtotime($array1['date'])).'@'.$array1['age'].'@'.$array1['availableeggs']; ?>";
theOption1.title = "<?php echo $array1['date'].','.$array1['availableeggs']; ?>";
myselect1.appendChild(theOption1);
<?php
echo '}';
}
echo '}';
}
?>
}

var rdateArray= new Array();
var rdateArrayIndex=-1;	
function getrdateArray(id,value)
{
var array1=id.split('@');
var array2=value.split('@');
index_rdate=array1[1];
	if(value!='') 
	{
     // document.getElementById('age@'+index).value=Math.floor(array2[1]/7) + '.'+(array2[1]%7);
	//  document.getElementById('avalilableeggs@'+index).value=array[2];
      if(!rdateArray.inArray(array2[0]))
          rdateArray[++rdateArrayIndex]=array2[0]+','+document.getElementById('flock@'+index_rdate).value; 
		 
   }
}
Array.prototype.inArray = function (value)  
 {   
  var i;  
  for (i=0; i < this.length; i++)   
    if (this[i] == value) return true;  
  return false;  
 }; 

Array.prototype.inArrayIndex = function (value) // this function will return the index+1
 {   
  var i;  
  for (i=0; i < this.length; i++)   
     if (this[i] == value)  return i+1;      
  return false;  
 };

<?php } ?>
</script>
</script>
<script type="text/javascript">
function script1() {
window.open('O2CHelp/help_t_adddirectsale.php','BIMS','width=500,height=600,toolbar=no,menubar=yes,scrollbars=yes,resizable=yes');
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

