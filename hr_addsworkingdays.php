<?php include "jquery.php"; include "getemployee.php"; session_start(); ?>
<section class="grid_8">
  <div class="block-border">
     <form class="block-content form" style="height:600px" id="complex_form" method="post" action="hr_saveworkingdays.php" >
	  <h1 id="title1">Working Days</h1>
	  
		<div class="block-controls"><ul class="controls-tabs js-tabs"></ul></div>
              <center>(Fields marked <font style="color:red;font-weight:bold;padding-top:10px"><sup>*</sup></font> are mandatory)<br /><br>
			  
			  <strong>Date</strong>
<input type="text" name="date1" id="date1" class="datepicker" value="<?php echo date("d.m.o"); ?>"  size="12"  /> 
<br/>
<br/>
<table id="paraID" >
<tr>

<th style="width:200px; text-align:left"><strong>Month&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Year&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Days<font style="color:red;font-weight:bold;padding-top:10px"><sup>*</sup></font>  </strong></th>
</tr>
</table>

<table id="inputs">
<tr>

<td>
<select id="month0" onChange="checkdouble(this.id,'-1');" name="month[]" style="width:100px">
<option value="Select"> Select </option>
<option value="01">JAN</option>
<option value="02">FEB</option>
<option value="03">MAR</option>
<option value="04">APR</option>
<option value="05">MAY</option>
<option value="06">JUN</option>
<option value="07">JUL</option>
<option value="08">AUG</option>
<option value="09">SEP</option>
<option value="10">OCT</option>
<option value="11">NOV</option>
<option value="12">DEC</option>
</select>
</td>

<td width="10px"></td>
<td>
<select id="year0" onChange="checkdouble('-1',this.id);" name="year[]" style="width:100px">
<option value="Select"> Select </option>
<?php $date = date(Y); for($a = $date;$a<($date+5);$a++) { ?>
<option value="<?php echo $a; ?>"><?php echo $a; ?></option>
<?php } ?>
</select>
</td>
<td width="10px"></td>

<td >
<input type="text" name="nodays[]" id="nodays0" value="0" size="4" onfocus="makeform();" />&nbsp;
</td>
<td width="10px"></td>

</tr>
</table><br/>
<br/>
<input type="submit" value="Save" id="Save"/>&nbsp;<input type="button" value="Cancel" onClick="document.location='dashboardsub.php?page=hr_workingdays';">
</center>
</form>
 </div>
</section>

		

<br />


<script type="text/javascript">
var index = 0;
function makeform()
{
  index = index + 1;
  var t1  = document.getElementById('inputs');
  var r1 = document.createElement('tr'); 

 
  myselect1 = document.createElement("select");
  myselect1.style.width = "100px";
  theOption1=document.createElement("OPTION");
  theText1=document.createTextNode('-Select-');
  theOption1.appendChild(theText1);
  myselect1.appendChild(theOption1);
  myselect1.name = "month[]";
  myselect1.id = "month" + index;
  myselect1.onchange = function() { checkdouble(this.id,'-1'); };
  theOption=document.createElement("OPTION");
  	theText=document.createTextNode("JAN");
	theOption.appendChild(theText);
	theOption.value = "01";
	myselect1.appendChild(theOption);
	
	theOption=document.createElement("OPTION");
	theText=document.createTextNode("FEB");
	theOption.appendChild(theText);
	theOption.value = "02";
	myselect1.appendChild(theOption);
	
	theOption=document.createElement("OPTION");
	theText=document.createTextNode("MAR");
	theOption.appendChild(theText);
	theOption.value = "03";
	myselect1.appendChild(theOption);
	
	theOption=document.createElement("OPTION");
	theText=document.createTextNode("APR");
	theOption.appendChild(theText);
	theOption.value = "04";
	myselect1.appendChild(theOption);
	
	theOption=document.createElement("OPTION");
	theText=document.createTextNode("MAY");
	theOption.appendChild(theText);
	theOption.value = "05";
	myselect1.appendChild(theOption);
	
	theOption=document.createElement("OPTION");
	theText=document.createTextNode("JUN");
	theOption.appendChild(theText);
	theOption.value = "06";
	myselect1.appendChild(theOption);
	
	theOption=document.createElement("OPTION");
	theText=document.createTextNode("JUL");
	theOption.appendChild(theText);
	theOption.value = "07";
	myselect1.appendChild(theOption);
	
	theOption=document.createElement("OPTION");
	theText=document.createTextNode("AUG");
	theOption.appendChild(theText);
	theOption.value = "08";
	myselect1.appendChild(theOption);
	
	theOption=document.createElement("OPTION");
	theText=document.createTextNode("SEP");
	theOption.appendChild(theText);
	theOption.value = "09";
	myselect1.appendChild(theOption);
	
	theOption=document.createElement("OPTION");
	theText=document.createTextNode("OCT");
	theOption.appendChild(theText);
	theOption.value = "10";
	myselect1.appendChild(theOption);
	
	
	theOption=document.createElement("OPTION");
	theText=document.createTextNode("NOV");
	theOption.appendChild(theText);
	theOption.value = "11";
	myselect1.appendChild(theOption);
	
	theOption=document.createElement("OPTION");
	theText=document.createTextNode("DEC");
	theOption.appendChild(theText);
	theOption.value = "12";
	myselect1.appendChild(theOption);
	
	

  var ba1 = document.createElement('td');
  ba1.appendChild(myselect1);
  var b1 = document.createElement('td');
  myspace2= document.createTextNode('\u00a0');
  b1.appendChild(myspace2);


  myselect1 = document.createElement("select");
  myselect1.style.width = "100px";
  theOption1=document.createElement("OPTION");
  theText1=document.createTextNode('-Select-');
  theOption1.appendChild(theText1);
  myselect1.appendChild(theOption1);
  myselect1.name = "year[]";
  myselect1.id = "year" + index;
  myselect1.onchange = function() { checkdouble('-1',this.id); };
  theOption=document.createElement("OPTION");
  
<?php $date = date(Y); for($a = $date;$a<($date+5);$a++) { ?>

theOption=document.createElement("OPTION");
		theText=document.createTextNode("<?php echo $a; ?>");
		theOption.appendChild(theText);
		theOption.value = "<?php echo $a; ?>";
		myselect1.appendChild(theOption);
<?php } ?>
 
	
  var ba2 = document.createElement('td');
  ba2.appendChild(myselect1);
  var b2 = document.createElement('td');
  myspace2= document.createTextNode('\u00a0');
  b2.appendChild(myspace2);
  
  
  mybox1=document.createElement("input");
  mybox1.size="4";
  mybox1.type="text";
  mybox1.name="nodays[]";
  mybox1.id="nodays" +  index;
  mybox1.onfocus = function() { makeform(); };
  var ba3 = document.createElement('td');
  ba3.appendChild(mybox1);

  var b3 = document.createElement('td');
  myspace2= document.createTextNode('\u00a0');
  b3.appendChild(myspace2);



 
      r1.appendChild(ba1);
      r1.appendChild(b1);
      r1.appendChild(ba2);
      r1.appendChild(b2);
      r1.appendChild(ba3);
      r1.appendChild(b3);
     
        t1.appendChild(r1);

}

function checkdouble(mid,yid)
{
if(yid == -1)
{
var d = mid.substr(5);
}
else
{
var d = yid.substr(4);
}
 for(var i = 0; i <= d; i++)
 {
 	for(var j = 0; j <= d; j++)
	{
		if(i!= j)
		{
			if(document.getElementById('month' + i).value  == document.getElementById('month' + j).value)
			{
			if(document.getElementById('year' + i).value  == document.getElementById('year' + j).value)
			{
				alert("Please select different comination");
				document.getElementById('month' + j).selectedIndex = 0;
				return;
			}
			}
		}
	}
 }

}
function removeAllOptions(selectbox)
{
	var i;
	for(i=selectbox.options.length-1;i>=0;i--)
	{
		//selectbox.options.remove(i);
		selectbox.remove(i);
	}
}



</script>
<div class="clear"></div>
<br />

<script type="text/javascript">
function script1() {
window.open('BroilerHelp/help_t_finalization.php','BIMS','width=500,height=600,toolbar=no,menubar=yes,scrollbars=yes,resizable=yes');
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