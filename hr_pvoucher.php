<?php include "jquery.php"; ?>

<script type="text/javascript">

		

		$(document).ready(function()

		{



			$('.favorites li').bind('contextMenu', function(event, list)

			{

				var li = $(this);

				

				if (li.prev().length > 0)

				{

					list.push({ text: 'Move up', link:'#', icon:'up' });

				}

				if (li.next().length > 0)

				{

					list.push({ text: 'Move down', link:'#', icon:'down' });

				}

				list.push(false);	// Separator

				list.push({ text: 'Delete', link:'#', icon:'delete' });

				list.push({ text: 'Edit', link:'#', icon:'edit' });

			});

			

			$('.favorites li:first').bind('contextMenu', function(event, list)

			{

				list.push(false);	// Separator

				list.push({ text: 'Settings', icon:'terminal', link:'#', subs:[

					{ text: 'General settings', link: '#', icon: 'blog' },

					{ text: 'System settings', link: '#', icon: 'server' },

					{ text: 'Website settings', link: '#', icon: 'network' }

				] });

			});

			

			

			$.fn.dataTableExt.oStdClasses.sWrapper = 'no-margin last-child';

			$.fn.dataTableExt.oStdClasses.sInfo = 'message no-margin';

			$.fn.dataTableExt.oStdClasses.sLength = 'float-left';

			$.fn.dataTableExt.oStdClasses.sFilter = 'float-right';

			$.fn.dataTableExt.oStdClasses.sPaging = 'sub-hover paging_';

			$.fn.dataTableExt.oStdClasses.sPagePrevEnabled = 'control-prev';

			$.fn.dataTableExt.oStdClasses.sPagePrevDisabled = 'control-prev disabled';

			$.fn.dataTableExt.oStdClasses.sPageNextEnabled = 'control-next';

			$.fn.dataTableExt.oStdClasses.sPageNextDisabled = 'control-next disabled';

			$.fn.dataTableExt.oStdClasses.sPageFirst = 'control-first';

			$.fn.dataTableExt.oStdClasses.sPagePrevious = 'control-prev';

			$.fn.dataTableExt.oStdClasses.sPageNext = 'control-next';

			$.fn.dataTableExt.oStdClasses.sPageLast = 'control-last';

			

			$('.sortable').each(function(i)

			{

				var table = $(this),

					oTable = table.dataTable({





						



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

			



			$('.datepicker').datepick({

				alignment: 'bottom',

				showOtherMonths: true,

				selectOtherMonths: true,

				renderer: {

					picker: '<div class="datepick block-border clearfix form"><div class="mini-calendar clearfix">' +

							'{months}</div></div>',

					monthRow: '{months}', 

					month: '<div class="calendar-controls">' +

								'{monthHeader:M yyyy}' +

							'</div>' +

							'<table cellspacing="0">' +

								'<thead>{weekHeader}</thead>' +

								'<tbody>{weeks}</tbody></table>', 

					weekHeader: '<tr>{days}</tr>', 

					dayHeader: '<th>{day}</th>', 

					week: '<tr>{days}</tr>', 

					day: '<td>{day}</td>', 

					monthSelector: '.month', 

					daySelector: 'td', 

					rtlClass: 'rtl', 

					multiClass: 'multi', 

					defaultClass: 'default', 

					selectedClass: 'selected', 

					highlightedClass: 'highlight', 

					todayClass: 'today', 

					otherMonthClass: 'other-month', 

					weekendClass: 'week-end', 

					commandClass: 'calendar', 

					commandLinkClass: 'button',

					disabledClass: 'unavailable'

				}

			});

		});

		

		function openModal()

		{

			$.modal({

				content: '<p>Sample Report</p>',

				title: 'Purchases Report',

				maxWidth: 500,

				buttons: {

					'Print': function(win) { openModal(); },

					'Close': function(win) { win.closeModal(); }

				}

			});

		}

	

	</script>





	<div id="control-bar" class="grey-bg clearfix"><div class="container_12">

	<!--<div class="float-left">

			<button type="button" target="_new" onClick="window.open('production/paymentvouchersmry.php');">Open report</button>

		</div>-->

		

		<div class="float-right"> 

			<button type="button" onClick="document.location='dashboardsub.php?page=hr_addpvoucher'"><img src="images/icons/fugue/tick-circle.png" width="16" height="16"> Add</button>

			

			





		</div>

			

	</div></div>

	

	<article class="container_12">

		



		

		

		<div class="clear"></div>

		



		<div class="clear"></div>

		



		

		<section class="grid_12">

			<div class="block-border"><form class="block-content form" id="table_form" method="post" action="">

				<h1>Employee Payment Voucher</h1>

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

$monthcnt = 1;

}

else if ($month == "February")

{

$monthcnt = 2;

}

else if($month == "March")

{

$monthcnt = 3;

}

else if($month == "April")

{

$monthcnt = 4;

}

else if($month == "May")

{

$monthcnt = 5;

}

else if($month == "June")

{

$monthcnt = 6;

}

else if($month == "July")

{

$monthcnt = 7;

}

else if($month == "August")

{

$monthcnt = 8;

}

else if($month == "September")

{

$monthcnt = 9;

}

else if($month == "October")

{

$monthcnt = 10;

}

else if($month == "November")

{

$monthcnt = 11;

}

else if($month == "December")

{

$monthcnt = 12;

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

<th style="text-align:left"><span class="column-sort">

		<a href="javascript:void(0)" title="Sort up" class="sort-up"></a>

		<a href="javascript:void(0)" title="Sort down" class="sort-down"></a>

		</span>Date

</th> 

<th style="text-align:left"><span class="column-sort">

		<a href="javascript:void(0)" title="Sort up" class="sort-up"></a>

		<a href="javascript:void(0)" title="Sort down" class="sort-down"></a>

		</span>Tr No.

</th>

<th style="text-align:left"><span class="column-sort">

		<a href="javascript:void(0)" title="Sort up" class="sort-up"></a>

		<a href="javascript:void(0)" title="Sort down" class="sort-down"></a>

		</span>Cash/Bank

</th>

<!--<th style="text-align:left">Control type</th>-->

<th style="text-align:left"><span class="column-sort">

		<a href="javascript:void(0)" title="Sort up" class="sort-up"></a>

		<a href="javascript:void(0)" title="Sort down" class="sort-down"></a>

		</span>COA Code

</th>

<th style="text-align:left"><span class="column-sort">

		<a href="javascript:void(0)" title="Sort up" class="sort-up"></a>

		<a href="javascript:void(0)" title="Sort down" class="sort-down"></a>

		</span>Amount

</th>

<th>Actions</th>

</tr>

</thead>

<tbody>

	  <?php

           include "config.php"; 



	    if($_SESSION['sectorall'] == "all" || ($_SESSION['sectorall'] == "" && $_SESSION['sectorlist'] == ""))

		{

	   $query = "SELECT * FROM ac_gl where voucher = 'EPV' and vstatus <> 'R' and date >= '$fromdate' and date <= '$todate' group by transactioncode ORDER BY transactioncode  desc ";

	   }

	   else

	   {

	   $sectorlist = $_SESSION['sectorlist'];

	     $query = "SELECT * FROM ac_gl where voucher = 'EPV' and vstatus <> 'R' and date >= '$fromdate' and date <= '$todate'  AND code IN (SELECT coacode FROM ac_bankmasters WHERE code IN (SELECT code FROM ac_bankcashcodes WHERE sector in ($sectorlist) ORDER BY code ASC)) group by transactioncode ORDER BY transactioncode  desc ";

	   }

	

		  

           $result = mysql_query($query,$conn); 

           while($row1 = mysql_fetch_assoc($result))

           {
			  $user=$row1['username'];
              $flag = $row1['vstatus'];

           ?>

            <tr>

			<td><?php echo date("d.m.Y",strtotime($row1['date'])); ?></td>

             <td><?php echo $row1['transactioncode']; ?></td>

             <td><?php echo $row1['bccodeno']; ?></td>

             <td><?php echo $row1['code']; ?></td>

             <td><?php echo $row1['crtotal']; ?></td>

			 <td>

<?php if($_SESSION['valid_user']==$user || ($_SESSION['superadmin']=="1") ||($_SESSION['admin']=="1") ){?> 
<a href="dashboardsub.php?page=hr_editpvoucher&id=<?php echo $row1['transactioncode']; ?>"><img src="images/icons/fugue/pencil.png" style="border:0px" title="Edit"/></a>&nbsp;

<a onClick="if(confirm('Are you sure,want to delete')) document.location ='hr_deletepvoucher.php?id=<?php echo $row1['transactioncode']; ?>'"><img src="images/icons/fugue/cross-circle.png"  style="border:0px" title="Delete" /></a>&nbsp;&nbsp;
<?php  } else { ?>

<img src="images/icons/fugue/lock.png" width="16px" style="border:0px" title="Locked" />
<?php  }?>


<a href="em_paymentvoucherprint.php?id=<?php echo $row1['transactioncode']; ?>" target="_new"><img src="images/icons/fugue/report.png" style="border:0px" title="print" /></a>&nbsp;&nbsp; 
	  </td>

		   </tr>

           <?php 

           }

           ?>   

                                   

</tbody>

</table>

</form>

</div></section><br />

<center>





&nbsp;&nbsp; 

      </center>



<script type="text/javascript">

function reloadpage()

{

var month = document.getElementById('month').value;

var year = document.getElementById('year').value;

document.location = "dashboardsub.php?page=hr_pvoucher&month=" + month + "&year=" + year;

}

</script>

