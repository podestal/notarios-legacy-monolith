<?php 
include("conexion.php");
$codkardex=$_POST['codkardex'];

$movreg=mysql_query("select * from movirrpp where kardex='$codkardex'",$conn) or die(mysql_error());
$rowmov=mysql_fetch_array($movreg);
	
$sqlsaldito="select * from saldorrpp where idmovreg='".$rowmov['idmovreg']."'";
$rptasaldito=mysql_query($sqlsaldito,$conn) or die(mysql_error());	
$rowsaldito=mysql_fetch_array($rptasaldito);

echo"<table width='174' height='150' border='0' cellpadding='0' cellspacing='0'>
		  <tr>
			<td width='200' height='25' colspan='3' align='center' bgcolor='#FFFF99'><span class='Estilo40'>Pagado a RR.PP </span></td>
		  </tr>
		  <tr>
			<td height='24' colspan='3' align='center' bgcolor='#FFFF99'><span class='Estilo40'>
			  <label></label>
			  </span> <span class='Estilo40'>
				<label>
				  <input name='prrpp' type='text' id='prrpp' value='".$rowsaldito['pagadorrpp']."' size='10' />
			  </label>
			  </span> </td>
		  </tr>
		  <tr>
			<td height='27' colspan='3' align='center' bgcolor='#FFFF99'><span class='Estilo40'> Mayor Derecho por Pagar</span></td>
		  </tr>
		  <tr>
			<td height='22' colspan='3' align='center' bgcolor='#FFFF99'><span class='Estilo40'>
			  <input name='mder' type='text' id='mder' size='10' value=''".$rowsaldito['mayorderecho']."'' />
			</span> </td>
		  </tr>
		  <tr>
			<td height='26' colspan='3' align='center' bgcolor='#FFFF99'><span class='Estilo40'> Por Cobrar al Cliente</span></td>
		  </tr>
		  <tr>
			<td height='26' colspan='3' align='center' bgcolor='#FFFF99'><input name='xcobra' type='text' id='xcobra' value='".$rowsaldito['xcobrarclie']."' size='10' /></td>
		  </tr>
		</table>";



?>