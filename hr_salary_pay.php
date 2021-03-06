<?php include "jquery.php" ?>

<script type="text/javascript">

		$(document).ready(function()

		{

			$('.sortable').each(function(i)

			{

				var table = $(this),

					oTable = table.dataTable({

					aoColumns: [



							

							{ sType: 'eu_date',asSorting: [ "desc" ] },

							{ },

							{ },

							{ },

							{ },

							{ },

							{ }

						],





						sDom: '<"block-controls"<"controls-buttons"p>>rti<"block-footer clearfix"lf>',

						



						fnDrawCallback: function()

						{

							this.parent().applyTemplateSetup();

						},

						fnInitComplete: function()

						{

							this.parent().applyTemplateSetup();

						}

					});

				

				table.find('thead .sort-up').click(function(event)

				{

					event.preventDefault();

					

					var column = $(this).closest('th'),

						columnIndex = column.parent().children().index(column.get(0));

					

					oTable.fnSort([[columnIndex, 'asc']]);

					

					return false;

				});

				table.find('thead .sort-down').click(function(event)

				{

					event.preventDefault();

					

					var column = $(this).closest('th'),

						columnIndex = column.parent().children().index(column.get(0));

					

					oTable.fnSort([[columnIndex, 'desc']]);

					

					return false;

				});

			});

			

		});

		

	</script>



	<div id="control-bar" class="grey-bg clearfix"><div class="container_12">


		<div class="float-right"> 

					<button type="button" onClick="document.location='dashboardsub.php?page=hr_addsal_pay'"><img src="images/icons/fugue/tick-circle.png" width="16" height="16"> Add</button>

</div>

			

	</div></div>





<section class="grid_12">

<div class="block-border">

<form class="block-content form" id="table_form" method="post" action="">

<h1>Salary Payment</h1>
<?php 
 $month = $_GET['month'];
 $datep = date("d-m-Y");
$monthcnt = "";
$yearcnt = "";
$year = $_GET['year'];
if($year == "")
{

$arr = explode('-',$datep);
 $year = $arr[2];
}
if($month == "")
{
  $arr = explode('-',$datep);
 $monthcnt = $arr[1];
}
else if($month == "January")
{
$monthcnt = "01";
}
else if ($month == "February")
{
$monthcnt = "02";
}
else if($month == "March")
{
$monthcnt = "03";
}
else if($month == "April")
{
$monthcnt = "04";
}
else if($month == "May")
{
$monthcnt = "05";
}
else if($month == "June")
{
$monthcnt = "06";
}
else if($month == "July")
{
$monthcnt = "07";
}
else if($month == "August")
{
 $monthcnt = "08";
}
else if($month == "September")
{
$monthcnt = "09";
}
else if($month == "October")
{
$monthcnt = "10";
}
else if($month == "November")
{
$monthcnt = "11";
}
else if($month == "December")
{
$monthcnt = "12";
}
 $fromdate = $year."-".$monthcnt."-01";
 $todate = $year."-".$monthcnt."-31";
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Month:
<select name="month" id="month" onChange="reloadpage();" >
<option value="">--Select--</option>
<option  value="January"<?php if($monthcnt == 1){ ?> selected="selected"<?php } ?>>January</option>
<option  value="February"<?php if($monthcnt == 2){ ?> selected="selected"<?php } ?>>February</option>
<option  value="March"<?php if($monthcnt == 3){ ?> selected="selected"<?php } ?>>March</option>
<option  value="April"<?php if($monthcnt == 4){ ?> selected="selected"<?php } ?>>April</option>
<option  value="May"<?php if($monthcnt == 5){ ?> selected="selected"<?php } ?>>May</option>
<option  value="June"<?php if($monthcnt == 6){ ?> selected="selected"<?php } ?>>June</option>
<option  value="July"<?php if($monthcnt == 7){ ?> selected="selected"<?php } ?>>July</option>
<option  value="August"<?php if($monthcnt == 8){ ?> selected="selected"<?php } ?>>August</option>
<option  value="September"<?php if($monthcnt == 9){ ?> selected="selected"<?php } ?>>September</option>
<option  value="October"<?php if($monthcnt == 10){ ?> selected="selected"<?php } ?>>October</option>
<option  value="November"<?php if($monthcnt == 11){ ?> selected="selected"<?php } ?>>November</option>
<option  value="December"<?php if($monthcnt == 12){ ?> selected="selected"<?php } ?>>December</option>
</select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Year:
<select name="year" id="year" onChange="reloadpage();" >
<option value="">--Select--</option>
<?php 
for($i=$fyear;$i<=$tyear;$i++)
{
echo $i;
?>
<option value="<?php echo $i; ?>" <?php if($i == $year) { ?> selected="selected" <?php } ?>><?php echo $i; ?></option>
<?php } ?>
</select>
			

<table class="table sortable no-margin" cellspacing="0" style="size:50%" width="100%">

<thead>

<tr>

<th style="text-align:left">Paid Date</th>

<th style="text-align:left"><span class="column-sort">

									<a href="javascript:void(0)" title="Sort up" class="sort-up"></a>

									<a href="javascript:void(0)" title="Sort down" class="sort-down"></a>

								</span>Emp.Name</th> 
<th style="text-align:left"><span class="column-sort">

									<a href="javascript:void(0)" title="Sort up" class="sort-up"></a>

									<a href="javascript:void(0)" title="Sort down" class="sort-down"></a>

								</span>Sector</th> 

<th style="text-align:left"><span class="column-sort">

									<a href="javascript:void(0)" title="Sort up" class="sort-up"></a>

									<a href="javascript:void(0)" title="Sort down" class="sort-down"></a>

								</span>Salary</th> 

<th style="text-align:left"><span class="column-sort">

									<a href="javascript:void(0)" title="Sort up" class="sort-up"></a>

									<a href="javascript:void(0)" title="Sort down" class="sort-down"></a>

								</span>Deduction</th> 

<th style="text-align:left"><span class="column-sort">

									<a href="javascript:void(0)" title="Sort up" class="sort-up"></a>

									<a href="javascript:void(0)" title="Sort down" class="sort-down"></a>

								</span>Allowances</th> 

<th style="text-align:left"><span class="column-sort">

									<a href="javascript:void(0)" title="Sort up" class="sort-up"></a>

									<a href="javascript:void(0)" title="Sort down" class="sort-down"></a>

								</span>Actual Salary Paid</th> 								

<th>Actions</th>

</tr>

</thead>

<tbody>

	  <?php
           include "config.php"; 
           $query = "SELECT * FROM hr_salary_payment where month1='$monthcnt' and year1='$year'  ORDER BY date";
           $result = mysql_query($query,$conn); 
           while($row1 = mysql_fetch_assoc($result))
           {
		   $k =0;
		   		$eid = $name = $totalsal = $paid = $deduction =  "";
		        $q = "select * from hr_salary_payment where id = '$row1[id]' order by id";
		   		$qrs = mysql_query($q,$conn) or die(mysql_error());
		   		while($qr = mysql_fetch_array($qrs))
		   		{	
					$user=$qr['empname'];
					$eid= $qr['eid'] ;
		   			$name= $qr['name'] ;
					$pmode=$qr['paymode'];
		   			$totalsal= $qr['totalsal'] ;
		   			$paid= $qr['paid'];
					$deduction=$qr['advdeduction']+$qr['oded']+$qr['pf']+$qr['incometax']-$qr['pbaladd'];
					$q3="SELECT code FROM `hr_params` WHERE coa != '' order by code ";
					$r3=mysql_query($q3,$conn);
					while($row2=mysql_fetch_assoc($r3))
					{
		   			$deduction=$deduction+$qr[$row2['code']];
					}
					$allowances = $qr['allowances'];
					$ot = $qr['ot'];
					
	           
 

           ?>

            <tr>

		<td><?php echo $date=date("d.m.Y",strtotime($row1['date'])); ?></td>

             <td><?php echo $name; ?></td>
			 <td><?php
			 		$rsQuery=mysql_query("SELECT sector FROM hr_employee WHERE employeeid='$eid' LIMIT 1");
					$rsDataSector=mysql_fetch_assoc($rsQuery);
					echo $rsDataSector['sector']; 
			  
			  ?></td>
             <td><?php echo $totalsal; ?></td>

             <td><?php echo $deduction; ?></td>

			 <td><?php echo $allowances;?></td>


             <td><?php echo $paid; ?></td>

			 <td>


<?php if($_SESSION['valid_user']==$user || ($_SESSION['superadmin']=="1") ||($_SESSION['admin']=="1") ){?> 
			 <a href="hr_deletesal_pay.php?id=<?php echo $row1['id']; ?>&name=<?php echo $name;?>&date=<?php echo $row1['date'];?>&salid=<?php echo $row1['salparamid']; ?>&eid=<?php echo $row1['eid']; ?>&tid=<?php echo $row1['tid']; ?>">
			 

			<img src="images/icons/fugue/cross-circle.png" style="border:0px" title="Delete" /></a>&nbsp;&nbsp;		
			
			
			
			<?php  } else { ?>

<img src="images/icons/fugue/lock.png" width="16px" style="border:0px" title="Locked" />
<?php  }?>

			<a href="hr_salarypdf.php?id=<?php echo $row1['eid']; ?>&date=<?php echo $row1['date']; ?>" target="_new"><img src="images/icons/fugue/report.png" width="16px" style="border:0px" title="Print Salary Payment" /></a>
			
				
				 <?php if($pmode=="Cheque") { ?>
             <a href="<?php echo 'pp_chequeprintforemployee.php?date='.$date.'&vendor='.$name.'&amt='.$paid; ?>" target="_new" ><img src="images/icons/fugue/open.png" style="border:0px" title="<?php echo "Cheque Print";?>" />
			 </a>&nbsp;<?php } ?>
				
				 </td>

           </tr>

           <?php 
 }
           }

           ?>   

</tbody>

</table>

</form>

</div>

</section>


<script type="text/javascript">
function reloadpage()
{
var month = document.getElementById('month').value;
var year = document.getElementById('year').value;
document.location = "dashboardsub.php?page=hr_salary_pay&month=" + month + "&year=" + year;
}
</script>


<br />







