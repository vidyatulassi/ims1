<?php

$trnum=$_GET['trnum'];


$q3="delete from distribution_stocklevel where trnum='$trnum' ";

$q3=mysql_query($q3) or die(mysql_error());


echo "<script type='text/javascript'>";

echo "document.location='dashboardsub.php?page=distribution_distributionminimumstock';";

echo "</script>";





?>