<?php 
include('conexion.php');

$fechade = $_POST['fec_desde'];
$fecha=explode("/",$fechade);
$desde=$fecha[2]."-".$fecha[1]."-".$fecha[0];

$fechaa  = $_POST['fec_hasta'];
$fecha2=explode("/",$fechaa);
$hasta=$fecha2[2]."-".$fecha2[1]."-".$fecha2[0];

//$tipokardex = $_POST['tipokar'];






	$consulta = mysql_query("SELECT sisgen.id_envio AS ID,  tipo_kardex AS TIPKAR, sisgen.kardex AS KARDEX, num_escritura AS NUM_ESC, 
	fech_envio AS FEC_ENVIO, estado AS ESTADO, mensaje AS MENSAJE, sisgen.status AS ESTATUS, kardex.idkardex AS IDKARDEX FROM sisgen 
	LEFT JOIN sisgen_mensaje ON sisgen.kardex = sisgen_mensaje.kardex 
	INNER JOIN kardex ON sisgen.kardex = kardex.kardex 
	ORDER BY ESTATUS ASC", $conn) or die(mysql_error());

	
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

		
		

while($row = mysql_fetch_array($consulta)){
	$tipkar=$row['TIPKAR'];
	$kardex=$row['KARDEX'];
	$numescritura=$row['NUM_ESC'];
	$fechenvio=$row['FEC_ENVIO'];
	$mensaje=$row['MENSAJE'];
	$estado=$row['ESTATUS'];
	$idkardex=$row['IDKARDEX'];
	
	if($estado=='FALLIDO'){$estadodeenvio='ER';}
	if($estado=='GUARDADO'){$estadodeenvio='OK';}
	if($estado=='CON OBSERVACIONES'){$estadodeenvio='OB';}
	
		
?>
<table width='840' border='1' cellpadding='0' cellspacing='0'  height='auto'>
<tr height='25'>
		<td width='40' align='center'>
			<span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;" ><?php echo $tipkar;?> </span>
		</td>
        <td width='100' align='center'>
			<span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;" ><a target="_blank" id="<?php echo $kardex;?>" name="<?php echo $kardex;?>" style="color:#06C; cursor:pointer" href="../../../verkardex.php?kardex=<?php echo $kardex;?>&id=<?php echo $idkardex;?>" ><?php echo $kardex;?> </a>
		</td>
        <td width='55' align='center'>
			<span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;" ><?php echo $numescritura;?> </span>
		</td>
		<td width='55' align='center'>
			<span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;" ><?php echo $fechenvio;?> </span>
		</td>
		<td width='55' align='center'>
			<span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;" ><?php echo $mensaje;?> </span>
		</td>
		<td width='30' align='center'>
			<a id="<?php echo $tipkar;?>" name="<?php echo $kardex;?>" style="color:#06C; cursor:pointer" onclick="asi2(); return false"><?php echo $estadodeenvio;?> </a>
		</td>  
                <?php 
							}?>
            
        </tr>
		</table>
		
			
			