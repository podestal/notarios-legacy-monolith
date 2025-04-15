<?php


	$fechade = $_POST['fechade'];
	$fecha=explode("/",$fechade);
	$desde=$fecha[2]."-".$fecha[1]."-".$fecha[0];

	$fechaa  = $_POST['fechaa'];
	$fecha2=explode("/",$fechaa);
	$hasta=$fecha2[2]."-".$fecha2[1]."-".$fecha2[0];

	function obtenerFechaEnLetra($fecha){
		$dia= conocerDiaSemanaFecha($fecha);
		$num = date("j", strtotime($fecha));
		$anno = date("Y", strtotime($fecha));
		$mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
		$mes = $mes[(date('m', strtotime($fecha))*1)-1];
		return $dia.', '.$num.' de '.$mes.' del '.$anno;
	}
	function conocerDiaSemanaFecha($fecha) {
		$dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sabado');
		$dia = $dias[date('w', strtotime($fecha))];
		return $dia;
	}


	if($_POST['fechade']!="" or $_POST['fechaa']!="") {
		
		include("../../conexion.php");
		// include("../extraprotocolares/view/funciones.php");	
		//Exportar datos de php a Excel y Word
		$tipoDocumento = $_POST['enviarrr'];
		$extension = '';
		if($tipoDocumento == 'EXCEL'){
			$extension = 'xls';
		}else if($tipoDocumento == 'WORD'){
			$extension = 'doc';
		}else{
			$extension = 'doc';
		}

		header("Content-Description: File Transfer");  
		header("Content-Type: application/force-download"); 
		header("Content-Disposition: attachment; filename=INDICE_ALFABETICO_ESCRITURAS_PUBLICAS_".$fecha2[2].".".$extension);

		$queryKardex = "SELECT fechaescritura,
								k.kardex,
								contrato,
								numescritura,
								numminuta,
								folioini, 
								CAST(numescritura AS SIGNED) AS numescritura2,
								p.importetrans as precio,
								m.simbolo as moneda
						FROM kardex as k 
						LEFT JOIN patrimonial as p ON p.kardex=k.kardex AND p.idtipoacto = k.codactos
						LEFT JOIN monedas as m ON m.idmon=p.idmon
						WHERE k.idtipkar='1' and nc=0 and fechaescritura <> '' 
						AND STR_TO_DATE(fechaescritura,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
						AND STR_TO_DATE(fechaescritura,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d') 
						ORDER BY numescritura2 asc,fechaescritura ASC";

		$consultaKardex = mysql_query($queryKardex, $conn) or die(mysql_error());
							
		// $contador=mysql_num_rows($consultaKardex);
		
		$confinotario=mysql_query("SELECT nombre,apellido,telefono,correo,ruc,direccion,distrito FROM confinotario",$conn);
		$resnotario=mysql_fetch_assoc($confinotario);
		$nombrenotario = $resnotario['nombre']." ".$resnotario['apellido'];
		$direccion = $resnotario['direccion'];
		$telefono = $resnotario['telefono'];
		$correo = $resnotario['correo'];
		$ruc = $resnotario['ruc'];
		$distrito = $resnotario['distrito'];


		
		function array_sort($array, $on, $order=SORT_ASC)
		{
			$new_array = array();
			$sortable_array = array();

			if (count($array) > 0) {
				foreach ($array as $k => $v) {
					if (is_array($v)) {
						foreach ($v as $k2 => $v2) {
							if ($k2 == $on) {
								$sortable_array[$k] = $v2;
							}
						}
					} else {
						$sortable_array[$k] = $v;
					}
				}

				switch ($order) {
					case SORT_ASC:
						asort($sortable_array);
					break;
					case SORT_DESC:
						arsort($sortable_array);
					break;
				}

				foreach ($sortable_array as $k => $v) {
					$new_array[$k] = $array[$k];
				}
			}

			return $new_array;
		}	
	?>
	<html lang="es">
	<head>
	<title>::. Exportacion de Datos .::</title>
	<style>
		table{
			font-family:Arial;
			font-size: 13px;
			width:100%;
			border-collapse:collapse;
		}
	</style>
	</head>
	<body>
	<table border='0' cellpadding='0' cellspacing='0'>
		<tr>
			<td colspan="4" align="center" style="font-size:18.5px"><b>INDICE ALFABETICO - ESCRITURAS PUBLICAS</b></td>
		</tr>
		<tr>
			<td colspan="4" align="center" style="font-size:18.5px"><b><?php echo utf8_decode('AÑO ').$fecha2[2];?></b></td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td align="left"><b><span>NOTARIA</span></b></td>
			<td align="left"><span>: <?php echo $nombrenotario;?></span></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td align="left"><b><span>DIRECCION</span></b></td>
			<td align="left"><span>: <?php echo $direccion;?></span></td>
			<td><b>TELEFONO</b></td>
			<td>: <?php echo $telefono;?></td>
		</tr>
		<tr>
			<td align="left"><b><span>DEPARTAMENTO</span></b></td>
			<td align="left"><span>: PUNO</span></td>
			<td><b>RUC</b></td>
			<td>: <?php echo $ruc;?></td>
		</tr>
		<tr>
			<td align="left"><b><span>PROVINCIA</span></b></td>
			<td align="left"><span>: SAN ROMAN</span></td>
			<td align="left"><b><span>DESDE </span></b></td>
			<td align="left"><span>: <?php echo strtoupper(obtenerFechaEnLetra($desde));?></span></td>
		</tr>
		<tr>
			<td align="left"><b><span>DISTRITO</span></b></td>
			<td align="left"><span>: <?php echo $distrito;?></span></td>
			<td align="left"><b><span>HASTA</span></b></td>
			<td align="left"><span>: <?php echo strtoupper(obtenerFechaEnLetra($hasta)); ?></span></td>
		</tr>
	</table>
	<br>
	<table border="1" width="1000" align="center" cellpadding="0" cellspacing="0">       
		<tr>   
			<th align="center">ESCR.</th>
			<th align="center">FECH.ESCR.</th>
			<th align="center">OTORGANTE</th>
			<th align="center">A FAVOR</th>
			<th align="center">ACTO JURIDICO</th>
			<th align="center">PRECIO</th>
			<th align="center">NUM.FOLIO</th>
		</tr> 
		<?php
			$arrIndices = array();
			while($row = mysql_fetch_array($consultaKardex)){
				
				$kardex = $row['kardex'];
				$time = explode("-",$row['fechaescritura']);

				$query = "SELECT 
							c2.tipper,
							UPPER(CONCAT(c2.apepat,' ',c2.apemat,' ',c2.prinom,' ',c2.segnom)) AS nombre,
							cxa.idcontratante,
							UPPER(c2.razonsocial) AS empresa,
							cxa.parte,
							cxa.uif,
							(SELECT cxar.parte 
								FROM contratantesxacto AS cxar
								WHERE con.idcontratanterp = cxar.idcontratante AND  cxar.kardex = '$kardex' limit 1) as parte_representada
						FROM contratantesxacto AS cxa
						INNER JOIN contratantes AS con ON con.idcontratante=cxa.idcontratante
						INNER JOIN cliente2 AS c2 ON c2.idcontratante=con.idcontratante
						WHERE cxa.kardex = '$kardex' ORDER BY c2.tipper ASC";

				$otorgante = mysql_query($query, $conn) or die(mysql_error());
				$otorgado = mysql_query($query, $conn) or die(mysql_error());

				$parte1='';
				$parte2='';
				while($row3 = mysql_fetch_array($otorgante)){
					if($row3['parte']==1 || $row3['parte_representada']==1 || $row3['uif']=='O'){
						if($row3['uif']=='O' && $row3['parte_representada']==2){
							$parte1.= '';
						}else{
							// $parte1.= ($row3['tipper']=='N')?utf8_decode($row3['nombre']).", ":utf8_decode($row3['empresa']).", ";
							$parte1.= ($row3['tipper']=='N')?utf8_decode(str_replace("Ñ", "NZZ",$row3['nombre'])).", ":utf8_decode(str_replace("Ñ", "NZZ",$row3['empresa'])).", ";
						}
					}
				}
			
				while($row4 = mysql_fetch_assoc($otorgado)){
					if($row4['parte']==2 || $row4['parte_representada']==2 || $row4['uif']=='B' || $row4['uif']=='N'){
						if($row4['uif']=='B' && $row4['parte_representada']==1){
							$parte2 .='';
						}else{
							$parte2 .= ($row4['tipper']=='N')?utf8_decode($row4['nombre']).", ":utf8_decode($row4['empresa']).", ";
						}
					}
				}

				$arrIndices[] = array(
					'numero_escritura' => $row['numescritura'],
					'fecha' => $time[2] . "/" . $time[1] . "/" . $time[0],
					'otorgante' => ($row['contrato']=='NO CORRE / ')?"NO CORRE":substr(empty($parte1)?$parte2:$parte1,0,-2),
					'otorgado' => ($row['contrato']=='NO CORRE / ')?"NO CORRE":substr($parte2,0,-2),
					'contrato' => str_replace('/','',strtoupper($row['contrato'])),
					'monto' => $row['moneda'].' '.$row['precio'],
					'folio' => $row['folioini'],
				); 	

			}
			// print_r($arrIndices);
			$indicesOrdenados = (array_sort($arrIndices, 'otorgante', SORT_ASC));
			
			foreach($indicesOrdenados as $value){
				$html = "<tr>";
					$html .= "<td align='center'>".$value['numero_escritura']."</td>";
					$html .= "<td align='center'>".$value['fecha']."</td>";						
					$html .= "<td>".utf8_decode(str_replace('NZZ','Ñ',$value['otorgante']))."</td>";
					$html .= "<td>".$value['otorgado']."</td>";
					$html .= "<td>".$value['contrato']."</span></td>";
					$html .= "<td style='white-space: nowrap;' align='right'>".$value['monto']."&nbsp;</td>";
					$html .= "<td align='center'>".$value['folio']."</td>";
				$html .=  "</tr>";

				echo $html;
			}
		?>
	</table>
	</body>
	</html>
	<?php
}else{
	echo "<script>window.location='../../indicecroesriturasalfa.php'</script>";	
}
?>
