<?php 


function fdate($mifecha)    

		{
		$var = str_replace('/', '-', $mifecha);
		return date('Y-m-d', strtotime($var));
		}

include('conexion.php');


$fechade = $_POST['startDate'];
$fecha=explode("/",$fechade);
$desde=$fecha[2]."-".$fecha[1]."-".$fecha[0];

$fechaa  = $_POST['endDate'];
$fecha2=explode("/",$fechaa);
$hasta=$fecha2[2]."-".$fecha2[1]."-".$fecha2[0];



/* FECHA DE ESCRITURA BUSQUEDA
$consulta = mysql_query("SELECT @numero:=@numero+1 AS POSICION, IDKARDEX AS IDKARDEX, KARDEX AS KARDEX, KARDEX.IDTIPKAR AS TIPO_KARDEX, CODACTOS AS CODIGO_ACTO,
				CONTRATO AS CONTRATO, FECHAINGRESO AS FECHA_INGRESO, FECHACONCLUSION AS FECHA_CONCLUSION,
				NUMESCRITURA AS NUMERO_ESCRITURA, FECHAESCRITURA AS FECHA_ESCRITURA  FROM KARDEX ,tiposdeacto ta				
				WHERE STR_TO_DATE(FECHAESCRITURA,'%Y-%m-%d') BETWEEN STR_TO_DATE('$desde','%Y-%m-%d') 
				AND STR_TO_DATE('$hasta','%Y-%m-%d') AND SUBSTRING(KARDEX.codactos,1,3)=ta.idtipoacto 
				AND numescritura <>'' AND cod_ancert <>'' ORDER BY KARDEX DESC  ", $conn) or die(mysql_error());*/

//FECHA DE MODIFICACION
$consulta = mysql_query("SELECT sisgen_report.id_envio AS ID,  tipo_kardex AS TIPKAR,kardex.idkardex AS IDKARDEX, sisgen_report.kardex AS KARDEX, 
						num_escritura AS NUM_ESC, 
						CONCAT(fech_envio,' ',hora_envio ) AS FEC_ENVIO, sisgen_report.status AS ESTATUS, 
						 kardex.contrato AS CONTRATO FROM sisgen_report 
						INNER JOIN kardex ON sisgen_report.kardex = kardex.kardex
						WHERE STR_TO_DATE(FECH_ENVIO,'%d/%m/%y') BETWEEN STR_TO_DATE('$fechade','%d/%m/%y') 
						AND STR_TO_DATE('$fechaa','%d/%m/%y') 
						ORDER BY sisgen_report.kardex DESC , sisgen_report.id_envio DESC  ", $conn) or die(mysql_error());

	
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

$data = array();
while($row = mysql_fetch_array($consulta)){

	$tipkar=$row['TIPKAR'];
	$idkardex=$row['IDKARDEX'];
	$kardex=$row['KARDEX'];
	$numescritura=$row['NUM_ESC'];
	$fechenvio=$row['FEC_ENVIO'];
	$mensaje=$row['MENSAJE'];
	$estado=$row['ESTATUS'];
	$contrato=$row['CONTRATO'];

	$data[] = $row;
			
}

$consulta = mysql_query("SELECT CONCAT('..La Lista contiene: ',COUNT(kardex), ' Filas.') AS cantidad FROM sisgen_report
	WHERE STR_TO_DATE(FECH_ENVIO,'%d/%m/%y') BETWEEN STR_TO_DATE('$fechade','%d/%m/%y') AND STR_TO_DATE('$fechaa','%d/%m/%y') ", $conn) or die(mysql_error()); 

while($cantidad = mysql_fetch_array($consulta)){ 
	$canti=$cantidad['cantidad'];
} 

echo json_encode(array('list'=>$data,'cantidad'=>$canti));


				
			

			
			