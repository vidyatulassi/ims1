<?php 
include "config.php";

$query = "delete from feedlabreport where id = '$_GET[id]'";
$result = mysql_query($query,$conn) or die(mysql_error());
echo "<script type='text/javascript'>";
echo "document.location = 'dashboardsub.php?page=feedlabreport';";
echo "</script>";
?>
