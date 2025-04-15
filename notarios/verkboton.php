<?php 
include("conexion.php");

$contrataa=intval($_POST['contrata']);
$consultacw=mysql_query("Select * from renta where idcontratante='$contrataa'", $conn) or die(mysql_error());
$rowccw = mysql_fetch_array($consultacw);

if (!empty($rowccw)){
	
	echo' <input name="pregu1" type="hidden" id="pregu1" size="5" value="'.$rowccw['pregu1'].'" />
                                          <input name="pregu2" type="hidden" id="pregu2" size="5" value="'.$rowccw['pregu2'].'" /> 
                                          <input name="pregu3" type="hidden" id="pregu3" size="5" value="'.$rowccw['pregu3'].'" /> ';
 ?>
<a href="#" onClick="grabar_renta_edit()"><img src="iconos/grabar.png" width="94" height="29" border="0" /></a>

<?php
}else{
	 echo'<input name="pregu1" type="hidden" id="pregu1" size="5" />
                                          <input name="pregu2" type="hidden" id="pregu2" size="5" /> 
                                          <input name="pregu3" type="hidden" id="pregu3" size="5" /> ';
	?>
<a href="#" onClick="grabar_renta()"><img src="iconos/grabar.png" width="94" height="29" border="0" /></a>

<?php
	
	}

 ?>
