<?php include "config.php";
$id = $_GET['id'];
if($id == "")
 $saed = 0;
else
 $saed = 1;
$query = "SELECT * FROM oc_tandc WHERE id = '$id' AND client = '$client'";
$result = mysql_query($query,$conn) or die(mysql_error());
$rows = mysql_fetch_assoc($result);
$tandc = $rows['tandc'];
?>
<section class="grid_8">
  <div class="block-border">
   <form class="block-content form" style="height:600px" id="complex_form" method="post" onsubmit="return checkform(this)" action="oc_savetandc.php" >
	  <h1 id="title1">Terms &amp; Conditions</h1>
		<div class="block-controls"><ul class="controls-tabs js-tabs"></ul></div>
              <center>

(Fields marked <font style="color:red;font-weight:bold;padding-top:10px"><sup>*</sup></font> are mandatory)

<br><br>
<input type="hidden" id="oldid" name="oldid" value="<?php echo $id; ?>" />
<input type="hidden" id="saed" name="saed" value="<?php echo $saed; ?>" />
<table id="tab2" align="center">
<tr>
 <td align="right"><strong>Condition<font style="color:red;font-weight:bold;padding-top:10px"><sup>*</sup></font>&nbsp;&nbsp;&nbsp;</strong></td>
 <td width="10px"></td>
 <td align="left"><input type="text" id="tandc" name="tandc" size="100" value="<?php echo $tandc; ?>" onkeyup="validate(this.value)" /></td>
</tr>
<tr height="10px"></tr>
</table>
<br><br>
<input type="submit" value="<?php if($saed == 0) echo "Save"; else echo "Update"; ?>" />&nbsp;&nbsp;<input type="button" value="Cancel" onClick="document.location='dashboardsub.php?page=oc_tandc'" />
</form>
<script type="text/javascript">
function validate(a)
{
 var expr=/^[A-Za-z0-9%@$()/\. ]*$/;
 if(! a.match(expr))
 {
  alert("This Characters is not allowed");
  document.getElementById("tandc").value = a.substr(0,(a.length-1));
  document.getElementById("tandc").focus();
 }
}
function checkform()
{
 if(form.name.tandc == "")
 {
  alert("Enter Condition");
  form.name.tandc.focus();
  return false;
 }
 return true;
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
