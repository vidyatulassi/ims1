
<?php 
include "jquery.php"; 
include "config.php";


?>


<center>
<br />
<h1>Water Micro Biology</h1>
(Fields marked <font style="color:red;font-weight:bold;padding-top:10px"><sup>*</sup></font> are mandatory)
<br/>
<br/><br />
<form method="post" action="savewatermicrobiology.php" onsubmit="return checkform(this);" >
<table align="center">
<tr>


 <td><strong>Sample Date</strong><font style="color:red;font-weight:bold;padding-top:10px"><sup>*</sup></font></td>
                <td>&nbsp;<input class="datepicker" type="text" size="15" id="sampledate" name="sampledate" value="<?php echo date("d.m.Y"); ?>"></td>
                <td width="40px"></td>




 <td><strong>Report Date</strong><font style="color:red;font-weight:bold;padding-top:10px"><sup>*</sup></font></td>
                <td>&nbsp;<input class="datepicker" type="text" size="15" id="reportdate" name="reportdate" value="<?php echo date("d.m.Y"); ?>" ></td>
				
				 <td width="40px"></td>




 <td><strong>Sample Number</strong><font style="color:red;font-weight:bold;padding-top:10px"><sup>*</sup></font></td>
                <td>&nbsp;<input type="text" size="12" id="samplenum" name="samplenum" ></td>
               
</tr>
</table>
<br/>
<br/>
<table border="0">

     <tr>



 <td><strong>Farm Type</strong><font style="color:red;font-weight:bold;padding-top:10px"><sup>*</sup></font></td>
<td style="text-align:left;">
      <select style="Width:120px" name="ftype" id="ftype" onchange="loadfnames(this.value);">
        <option value="">-Select-</option>
       <option value="Breeder">Breeder</option>
	<option value="Hatchery">Hatchery</option>
	<option value="Broiler">Broiler</option>
     </select>
       </td>



<td width="40px"></td>
 <td><strong>Farm Name</strong><font style="color:red;font-weight:bold;padding-top:10px"><sup>*</sup></font></td>

<td style="text-align:left;">
      <select style="Width:120px" name="fname" id="fname">
        <option value="">-Select-</option>
       
     </select>
       </td>


</tr>
</table>

<br/>
<br/>
<center>
 <table border="0" id="tab">
     <tr>
<th><strong>Sample</strong><font style="color:red;font-weight:bold;padding-top:10px"><sup>*</sup></font></th><td width="10px">&nbsp;</td>
<th><strong>Ecoil(MNP/100ml)</strong><font style="color:red;font-weight:bold;padding-top:10px"><sup>*</sup></font></th><td width="10px">&nbsp;</td>
<th><strong>PH</strong><font style="color:red;font-weight:bold;padding-top:10px"><sup>*</sup></font></th><td width="10px">&nbsp;</td>
<th><strong>Hardness</strong><font style="color:red;font-weight:bold;padding-top:10px"><sup>*</sup></font></th><td width="10px">&nbsp;</td>

     </tr>

     <tr style="height:20px"></tr>

     <tr>
 
       <td style="text-align:left;">
<select style="Width:120px" name="sample[]" id="sample@-1">
     <option value="">-Select-</option>
     <option value="Borewell Water">Borewell Water </option>
<option value="Openwell Water">Openwell Water</option>
<option value="MainTank Water">MainTank Water</option>
<option value="PipeLine Water">PipeLine Water</option>
<option value="Drinking Water">Drinking Water</option>
<option value="Other Water">Other Water</option>
</select>
       </td>
<td width="10px">&nbsp;</td><td>
<input type="text" size="20" id="ecoil@-1" name="ecoil[]" value="" />
</td>
<td width="10px">&nbsp;</td><td>
<input type="text" size="10" id="ph@-1" name="ph[]" value="" />
</td>
<td width="10px">&nbsp;</td><td>
<input type="text" size="10" id="hardness@-1" name="hardness[]" value="" onfocus="makeform();"/>
</td>

 </tr>
   </table>
   <br /> 
 </center>

<br />			

<table border="0"  align="center">
 <tr style="height:10px"></tr> 
<tr>
<td style="vertical-align:middle;"><strong>Remarks</strong>&nbsp;&nbsp;&nbsp;</td>
<td><textarea rows="3" cols="50" id="remarks" name="remarks"></textarea></td>
</tr>
</table>
<center>	


   <br />
   <input type="submit" value="Save" id="save" name="save" style="margin-top:10px;" />
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <input type="button" value="Cancel" onclick="document.location='dashboardsub.php?page=watermicrobiology';">
</center>


						
</form>


<script type="text/javascript">
var index = -1;

function loadfnames(a)
{

if(a== "Breeder")
{

var item1 = a;
removeAllOptions(document.getElementById('fname'));
myselect1 = document.getElementById("fname");
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("-Select-");
theOption1.value = "";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
myselect1.name = "fname";
myselect1.style.width = "170px";


<?php 
	    $query = "select distinct(shedcode),sheddescription from breeder_shed order by shedcode";

    $result = mysql_query($query) or die(mysql_error());
    while($qr = mysql_fetch_assoc($result))
    {

	echo "if(item1 == 'Breeder') {";
?>
	theOption1=document.createElement("OPTION");
theText1=document.createTextNode("<?php echo $qr['shedcode']; ?>");
theOption1.value = "<?php echo $qr['shedcode']; ?>";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);

<?php echo "}"; ?>

<?php }  ?>	 
}
if(a=="Hatchery")
{
var item2 = a;

removeAllOptions(document.getElementById('fname'));
myselect1 = document.getElementById("fname");
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("-Select-");
theOption1.value = "";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
myselect1.name = "fname";
myselect1.style.width = "170px";


<?php 
	    $query = "select distinct(type) from tbl_sector where type1='Hatchery'";
    $result = mysql_query($query) or die(mysql_error());
    while($qr = mysql_fetch_assoc($result))
    {

	echo "if(item2 == 'Hatchery') {";
?>
	theOption1=document.createElement("OPTION");
theText1=document.createTextNode("<?php echo $qr['type']; ?>");
theOption1.value = "<?php echo $qr['type']; ?>";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);

<?php echo "}"; ?>

<?php }  ?>	 

}
if(a=="Broiler")
{

var item3 = a;

removeAllOptions(document.getElementById('fname'));
myselect1 = document.getElementById("fname");
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("-Select-");
theOption1.value = "";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
myselect1.name = "fname";
myselect1.style.width = "170px";


<?php 
	    $query = "select distinct(farm) from broiler_farm";
    $result = mysql_query($query) or die(mysql_error());
    while($qr = mysql_fetch_assoc($result))
    {

	echo "if(item3 == 'Broiler') {";
?>
	theOption1=document.createElement("OPTION");
theText1=document.createTextNode("<?php echo $qr['farm']; ?>");
theOption1.value = "<?php echo $qr['farm']; ?>";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);

<?php echo "}"; ?>

<?php }  ?>	 


}

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

function makeform()
{
if((document.getElementById('sample@'+index).value != "") && (document.getElementById('sample@'+index).value != "-Select-"))
{



index = index + 1 ;

table=document.getElementById("tab");
tr = document.createElement('tr');
tr.align = "center";
var b1 = document.createElement('td');
myspace1= document.createTextNode('\u00a0');
b1.appendChild(myspace1);


td = document.createElement('td');
myselect1 = document.createElement("select");
myselect1.name = "sample[]";
myselect1.id = "sample@" + index;
myselect1.style.width = "120px";
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("-Select-");
theOption1.value = "";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("Borewell Water");
theOption1.value = "Borewell Water";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("Openwell Water");
theOption1.value = "Openwell Water";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("MainTank Water");
theOption1.value = "MainTank Water";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("PipeLine Water");
theOption1.value = "PipeLine Water";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("Drinking Water");
theOption1.value = "Drinking Water";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);
theOption1=document.createElement("OPTION");
theText1=document.createTextNode("Other Water");
theOption1.value = "Other Water";
theOption1.appendChild(theText1);
myselect1.appendChild(theOption1);



td.appendChild(myselect1);

tr.appendChild(td);
var b2 = document.createElement('td');
myspace2= document.createTextNode('\u00a0');
b2.appendChild(myspace2);
td = document.createElement('td');
mybox1=document.createElement("input");
mybox1.size="20";
mybox1.type="text";
mybox1.name="ecoil[]";
mybox1.value = "";
mybox1.id = "ecoil@" + index;
td.appendChild(mybox1);

tr.appendChild(b2);
tr.appendChild(td);
var b3 = document.createElement('td');
myspace3= document.createTextNode('\u00a0');
b3.appendChild(myspace3);


td = document.createElement('td');
mybox1=document.createElement("input");
mybox1.size="10";
mybox1.type="text";
mybox1.name="ph[]";
mybox1.id = "ph@" + index;

td.appendChild(mybox1);

tr.appendChild(b3);
tr.appendChild(td);


var b4 = document.createElement('td');
myspace4= document.createTextNode('\u00a0');
b4.appendChild(myspace4);



td = document.createElement('td');
mybox1=document.createElement("input");
mybox1.size="10";
mybox1.type="text";
mybox1.name="hardness[]";
mybox1.id = "hardness@" + index;
mybox1.onfocus = function () { makeform(); };
td.appendChild(mybox1);
tr.appendChild(b4);
tr.appendChild(td);


table.appendChild(tr);
}
}
function checkform(form)
{

	if(form.ftype.value == "")
	{
		alert("Please Enter Farm Type");
 form.ftype.focus();
return false;
}
else if(form.fname.value == "")
{
	alert("Please Enter Farm Name");
	form.fname.focus();
	return false;
}


for(var i=-1;i<=index;i++)
{

if(document.getElementById('sample@'+i).value != "" && document.getElementById('ecoil@'+i).value == "")
{

alert("Please Enter Ecoil ");
document.getElementById('ecoil@'+i).focus();
return false;
}
else if(document.getElementById('sample@'+i).value != "" && document.getElementById('ph@'+i).value == "")
{

alert("Please Enter PH");
document.getElementById('ph@'+i).focus();
return false;
}

else if(document.getElementById('sample@'+i).value != "" && document.getElementById('hardness@'+i).value == "")
{

alert("Please Enter Hardness ");
document.getElementById('hardness@'+i).focus();
return false;
}

}
return true;
}


</script>

<script type="text/javascript">
function script1() {
window.open('IMSHelp/help_t_watermicrobiology.php','BIMS',
'width=500,height=600,toolbar=no,menubar=yes,scrollbars=yes,resizable=yes');

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


</body>
</html>

