<?php
include('../conexion.php');

$fechade = $_GET['fec_desde'];
$fecha=explode("/",$fechade);
$desde=$fecha[2]."-".$fecha[1]."-".$fecha[0];

$fechaa  = $_GET['fec_hasta'];
$fecha2=explode("/",$fechaa);
$hasta=$fecha2[2]."-".$fecha2[1]."-".$fecha2[0];

//$tipokardex = $_POST['tipokar'];






	$consulta = mysql_query("SELECT sisgen.id_envio AS ID,  tipo_kardex AS TIPKAR, sisgen.kardex AS KARDEX, num_escritura AS NUM_ESC, 
		fech_envio AS FEC_ENVIO, hora_envio AS HORA_ENVIO,estado AS ESTADO, IF ( mensaje IS NULL , '',mensaje) AS MENSAJE, sisgen.status AS ESTATUS, sisgen_temp.idkardex AS IDKARDEX, sisgen_temp.contrato AS CONTRATO FROM sisgen 
		LEFT JOIN sisgen_mensaje ON sisgen.kardex = sisgen_mensaje.kardex 
		INNER JOIN sisgen_temp ON sisgen.kardex = sisgen_temp.kardex
		ORDER BY sisgen.kardex ASC", $conn) or die(mysql_error());

	
	/*
while($row = mysql_fetch_array($consulta)){

echo"<table width='834' border='1' cellpadding='0' cellspacing='0' >
  <tr>
    <td width='83' align='center'><span style='font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;' >";
	if($row['TIPO_KARDEX']=='1'){ echo "ESCRITURA PUBLICA"; 	}
	if($row['TIPO_KARDEX']=='2'){ echo "NO CONTENSIOSOS"; 	}
	if($row['TIPO_KARDEX']=='3'){ echo "TRANSFERENCIAS VEHICULARES"; 	}
	if($row['TIPO_KARDEX']=='4'){ echo "GARANTIAS MOBILIARIAS"; 	}
	if($row['TIPO_KARDEX']=='5'){ echo "TESTAMENTOS"; 	}
	 echo"</span></td>
	<td width='35'  align='center' ><span style='font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;' >".$row['KARDEX']."</span></td>
    <td width='43'  align='center' height='19' ><span style='font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;' >". $row['FECHA_CONCLUSION']."</span></td>
	<td width='92'  align='center' ><span style='font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;' >".$row['NUMERO_ESCRITURA']."</span></td>
	<td width='167'  align='center' ><span style='font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;' >".$row['CONTRATO']."</span></td>
    <?php 
	
	?>
	<td width='56'  align='center' type='checkbox' >  ".$row['IDKARDEX']."</td>
  </tr>
</table>";
*/
	$consultaguardados=mysql_query("SELECT CONCAT(apellido,' ',nombre) AS NOTARIO, ruc AS CODIGONOTARIA FROM confinotario", $conn)or die(mysql_error());while ($row = mysql_fetch_array($consultaguardados))
	{	$CODNOTARIA=$row['CODIGONOTARIA'];
		$NOTARIO=$row['NOTARIO'];
	}

	$consultaguardados=mysql_query("SELECT COUNT(*) AS cantidadguardados FROM sisgen WHERE sisgen.status ='GUARDADO'", $conn)or die(mysql_error());while ($row = mysql_fetch_array($consultaguardados))
	{$guardados=$row['cantidadguardados'];}

	$consultafallidos=mysql_query("SELECT COUNT(*) AS cantidadguardados FROM sisgen WHERE sisgen.status ='FALLIDO'", $conn)or die(mysql_error());while ($row = mysql_fetch_array($consultafallidos))
	{$fallidos=$row['cantidadguardados'];}

	$consultaobservados=mysql_query("SELECT COUNT(*) AS cantidadguardados FROM sisgen WHERE sisgen.status ='CON OBSERVACIONES'", $conn)or die(mysql_error());while ($row = mysql_fetch_array($consultaobservados))
	{$observados=$row['cantidadguardados'];}		
		
$data = array();
	
			

while($row = mysql_fetch_array($consulta)){



	$tipkar=$row['TIPKAR'];
	$kardex=$row['KARDEX'];
	$numescritura=$row['NUM_ESC'];
	$fechenvio=$row['FEC_ENVIO'];
	$mensaje=$row['MENSAJE'];
	$estado=$row['ESTATUS'];
	$idkardex=$row['IDKARDEX'];
	$contrato=$row['CONTRATO'];
	$horaenvio=$row['HORA_ENVIO'];
	
	$data[] = $row;
	}

?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        
        	<title>.:: REPORTE DE ENVIO - SISGEN (BASE CENTRALIZADA) ::.</title>
			
		   <style type="text/css">
			#logo_emp{
				float:left;
				padding:0px;
				margin:0px;
				margin-top:10px;
				margin-left:10px;
				}
			#fec_actual{
				float:right;
				padding:0px;
				margin:0px;
				margin-top:10px;
				margin-right:10px;
				}	
			</style>
	</head>
        <body>
		<div class="container">
        <div class="row">
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div class="col-sm-9">
			<h2 align="center">REPORTE DE ENVIO SISGEN (BASE CENTRALIZADA)</h2>
		</div>
		
		<div align ="center">
		<table  BORDER=1 CELLSPACING=1 CELLPADDING=1 align="center">
	     <tbody align ="center">
			<tr>
	             <td width="35%">RUC:</td>
	             <td width="65%"><?php echo $CODNOTARIA; ?> 
	             </td>
	         </tr>
			 <tr>
	             <td width="35%">NOTARIO:</td>
	             <td width="65%"><?php echo utf8_decode($NOTARIO); ?> 
	             </td>
	         </tr>
	         <tr>
	             <td width="35%">PERIODO DE ENVIO:</td>
	             <td width="65%"><?php echo $fechade; ?> A <?php echo $fechaa; ?> 
		            <input type="hidden" id="txtInitialDate" name="initialDate" value="<?php echo $initialDate; ?>">
		            <input type="hidden" id="txtFinalDate" name="finalDate" value="<?php echo $finalDate; ?>">
	             </td>

	         </tr>
			 <tr>
	             <td width="35%">FECHA DE ENVIO:</td>
	             <td width="65%"><?php echo ($fechenvio." / ".$horaenvio); ?> 
	             </td>
	         </tr>
	         <tr>
	             <td width="35%">CANTIDAD DE KARDEX GUARDADOS:</td>
	             <td width="65%"><?php  echo  $guardados;?></td>
	         </tr>
	         <tr>
	             <td width="35%">CANTIDAD DE KARDEX CON OBSERVACIONES:</td>
	             <td width="65%"><?php  echo  $observados;?></td>
	         </tr>
	         <tr>	             
	             <td width="35%">CANTIDAD DE KARDEX FALLIDOS:</td>
	             <td width="65%"><?php  echo  $fallidos;?></td>
	         </tr>
			 
	         
	     </tbody>
	 </table>
	</div>
		
		</div>
		</div>
</body>
</html>