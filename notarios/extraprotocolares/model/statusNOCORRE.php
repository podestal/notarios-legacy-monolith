<?php

include('../../conexion.php');

$idviaje  = $_POST["idviaje"];

//guarda el cronologico.
$busnumkardex = "SELECT permi_viaje.swt_est FROM permi_viaje WHERE permi_viaje.id_viaje = '$idviaje' ";

$numkarbus = mysql_query($busnumkardex,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numkarbus);
$newnumkar  = $rownum[0];

if(!empty($newnumkar))
{
	echo "<div class='ui-state-error' style='font-family: Calibri; font-style: italic; font-size: 15px; '><center>NO CORRE</center></div>";	
}
else { echo ""; }


?>