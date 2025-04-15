<?php

include('../../conexion.php');

$id_poder  = $_POST["id_poder"];

//guarda el cronologico.
$busnumkardex = "SELECT ingreso_poderes.swt_est FROM ingreso_poderes WHERE ingreso_poderes.id_poder = '$id_poder' ";

$numkarbus = mysql_query($busnumkardex,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numkarbus);
$newnumkar  = $rownum[0];

if(!empty($newnumkar))
{
	echo "<div class='ui-state-error' style='font-family: Calibri; font-style: italic; font-size: 15px; '><center>NO CORRE</center></div>";	
}
else { echo ""; }


?>