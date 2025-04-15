<?php 
include('conexion.php');

$fechade = $_POST['fec_desde'];
$fecha=explode("/",$fechade);
$desde=$fecha[2]."-".$fecha[1]."-".$fecha[0];

$fechaa  = $_POST['fec_hasta'];
$fecha2=explode("/",$fechaa);
$hasta=$fecha2[2]."-".$fecha2[1]."-".$fecha2[0];

$tipokardex = $_POST['tipokar'];


if($tipokardex=='')
{
	$consulta = mysql_query("SELECT IDKARDEX AS IDKARDEX, SUBSTRING_INDEX(KARDEX,'-',1) AS KARDEX, IDTIPKAR AS TIPO_KARDEX, CODACTOS AS CODIGO_ACTO,
				CONTRATO AS CONTRATO, FECHAINGRESO AS FECHA_INGRESO, FECHACONCLUSION AS FECHA_CONCLUSION,
				NUMESCRITURA AS NUMERO_ESCRITURA, FECHAESCRITURA AS FECHA_ESCRITURA  FROM KARDEX 				
				WHERE STR_TO_DATE(FECHA_MODIFICACION,'%d/%m/%Y') BETWEEN STR_TO_DATE('$fechade','%d/%m/%Y') 
				AND STR_TO_DATE('$fechaa','%d/%m/%Y') AND numescritura <>'' ORDER BY STR_TO_DATE(FECHA_MODIFICACION,'%d/%m/%Y') DESC  ", $conn) or die(mysql_error());
}
	else
	{
	$consulta = mysql_query("SELECT IDKARDEX AS IDKARDEX,SUBSTRING_INDEX(KARDEX,'-',1) AS KARDEX, IDTIPKAR AS TIPO_KARDEX, CODACTOS AS CODIGO_ACTO,
				CONTRATO AS CONTRATO, FECHAINGRESO AS FECHA_INGRESO, FECHACONCLUSION AS FECHA_CONCLUSION,
				NUMESCRITURA AS NUMERO_ESCRITURA, FECHAESCRITURA AS FECHA_ESCRITURA  FROM KARDEX 				
				WHERE STR_TO_DATE(FECHA_MODIFICACION,'%d/%m/%Y') BETWEEN STR_TO_DATE('$fechade','%d/%m/%Y') 
				AND STR_TO_DATE('$fechaa','%d/%m/%Y') AND IDTIPKAR = '$tipokardex' AND numescritura <>'' ORDER BY STR_TO_DATE(FECHA_MODIFICACION,'%d/%m/%Y') ", $conn) or die(mysql_error());
			
	}
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

		$borrardatos="TRUNCATE sisgen_temp";
		mysql_query($borrardatos,$conn) or die(mysql_error());
		
		

while($row = mysql_fetch_array($consulta)){

	if($row['TIPO_KARDEX']=='1'){$TIPO ='EP';}
	if($row['TIPO_KARDEX']=='2'){$TIPO ='NC';}
	if($row['TIPO_KARDEX']=='3'){$TIPO ='TV';}
	if($row['TIPO_KARDEX']=='4'){$TIPO ='GM';}
	if($row['TIPO_KARDEX']=='5'){$TIPO ='T';}
	$kardex=$row['KARDEX'];
	$fecha_conclusion=$row['FECHA_CONCLUSION'];
	$num_escritura=$row['NUMERO_ESCRITURA'];
	$contrato=$row['CONTRATO'];

?>
<table width='840' border='1' cellpadding='0' cellspacing='0'  height='auto'>
<tr height='25'>
		<td width='82' align='center'>
			<span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;" ><?php echo $TIPO;?> </span>
		</td>
        <td width='40' align='center'>
			<span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;" ><?php echo $row['KARDEX'];?> </span>
		</td>
        <td width='65' align='center'>
			<span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;" ><?php echo $row['FECHA_CONCLUSION'];?> </span>
		</td>
		<td width='89' align='center'>
			<span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;" ><?php echo $row['NUMERO_ESCRITURA'];?> </span>
		</td>		
        <td width='165' align='center'>
			<span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;" ><?php echo $row['CONTRATO'];?> </span>
		</td>
		<td width='58' align="center">
            	<input  
                <?php 
				if($row['FECHA_CONCLUSION']!=''){
					echo "checked='checked' ";
					echo "disabled='disabled' ";
				}?>type="checkbox" <?php echo $row['FECHA_CONCLUSION'] 
				
				?>" />
            </td>
        </tr>
		</table>
		<?php 
		
		$grabardatatemp="INSERT INTO sisgen_temp(tipo, kardex, fecha_conclusion, numescritura ) VALUES ('$TIPO','$kardex','$fecha_conclusion','$num_escritura')";
		mysql_query($grabardatatemp,$conn) or die(mysql_error());
			
		}
		$consulta = mysql_query("SELECT COUNT(kardex) AS cantidad FROM sisgen_temp", $conn) or die(mysql_error()); 
				while($cantidad = mysql_fetch_array($consulta)){ 
				$canti=$cantidad['cantidad'];
				} 
				
			
		?>
			
			