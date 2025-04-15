<?php
require_once 'conexion.php';
$fechaDesde = $_POST['fechaDesde'];
$fechaHasta = $_POST['fechaHasta'];
$tipoInstrumento = $_POST['tipoInstrumento'];
$estado = $_POST['estado'];
$codigoActo = $_POST['codigoActo'];
$all = false;

$where = "";
if($codigoActo != 0){
	$where = " AND ta.idtipoacto = '$codigoActo'";
	//die();
	
}


$sqlTruncate = "TRUNCATE sisgen_temp";
mysqli_query($conn,$sqlTruncate) or die(mysqli_error());

if($estado == 4){
	$sql = "SELECT kardex.idkardex,kardex.kardex,kardex.numescritura,kardex.fechaescritura,
	IF(ta.cod_ancert IS NULL,'',ta.cod_ancert)AS cod_ancert,kardex.estado_sisgen,kardex.idtipkar,kardex.fechaingreso,kardex.codactos,kardex.contrato,kardex.folioini,foliofin,kardex.fechaconclusion,ta.actouif,ta.actosunat
FROM kardex  , tiposdeacto ta WHERE  STR_TO_DATE(kardex.fechaescritura,'%Y-%m-%d') BETWEEN STR_TO_DATE('$fechaDesde','%Y-%m-%d')
				AND STR_TO_DATE('$fechaHasta','%Y-%m-%d') AND SUBSTRING(kardex.codactos,1,3)=ta.idtipoacto
				AND numescritura <>''   and kardex.idtipkar = '$tipoInstrumento' AND (ta.cod_ancert = '' OR ta.cod_ancert IS NULL) ".$where." ORDER BY cast(kardex.numescritura as unsigned) ";
}else if($estado == 0){
$sql = "SELECT kardex.idkardex,kardex.kardex,kardex.numescritura,kardex.fechaescritura,IF(ta.cod_ancert IS NULL,'',ta.cod_ancert)AS cod_ancert,kardex.estado_sisgen,kardex.idtipkar,kardex.fechaingreso,kardex.codactos,kardex.contrato,kardex.folioini,foliofin,kardex.fechaconclusion,ta.actouif,ta.actosunat
FROM kardex  , tiposdeacto ta WHERE  STR_TO_DATE(kardex.fechaescritura,'%Y-%m-%d') BETWEEN STR_TO_DATE('$fechaDesde','%Y-%m-%d')
				AND STR_TO_DATE('$fechaHasta','%Y-%m-%d') AND SUBSTRING(kardex.codactos,1,3)=ta.idtipoacto
				AND numescritura <>''   and kardex.idtipkar = '$tipoInstrumento' AND kardex.estado_sisgen='$estado' AND ta.cod_ancert != '' ".$where." ORDER BY cast(kardex.numescritura as unsigned)";
}else
if( $estado == 5){
	$sql = "SELECT kardex.idkardex,kardex.kardex,kardex.numescritura,kardex.fechaescritura,IF(ta.cod_ancert IS NULL,'',ta.cod_ancert)AS cod_ancert,kardex.estado_sisgen,kardex.idtipkar,kardex.fechaingreso,kardex.codactos,kardex.contrato,kardex.folioini,foliofin,kardex.fechaconclusion,ta.actouif,ta.actosunat
FROM kardex  , tiposdeacto ta WHERE  STR_TO_DATE(kardex.fechaescritura,'%Y-%m-%d') BETWEEN STR_TO_DATE('$fechaDesde','%Y-%m-%d')
				AND STR_TO_DATE('$fechaHasta','%Y-%m-%d') AND SUBSTRING(kardex.codactos,1,3)=ta.idtipoacto
				AND numescritura <>''   and kardex.idtipkar = '$tipoInstrumento' ".$where."  ORDER BY cast(kardex.numescritura as unsigned)";
				$all = true;
}else
if($estado == 3){
	$sql = "SELECT kardex.idkardex,kardex.kardex,kardex.numescritura,kardex.fechaescritura,IF(ta.cod_ancert IS NULL,'',ta.cod_ancert)AS cod_ancert,kardex.estado_sisgen,kardex.idtipkar,kardex.fechaingreso,kardex.codactos,kardex.contrato,kardex.folioini,foliofin,kardex.fechaconclusion,ta.actouif,ta.actosunat
FROM kardex  , tiposdeacto ta WHERE  STR_TO_DATE(kardex.fechaescritura,'%Y-%m-%d') BETWEEN STR_TO_DATE('$fechaDesde','%Y-%m-%d')
				AND STR_TO_DATE('$fechaHasta','%Y-%m-%d') AND SUBSTRING(kardex.codactos,1,3)=ta.idtipoacto
				AND numescritura <>''   and kardex.idtipkar = '$tipoInstrumento' AND kardex.estado_sisgen='3' AND  ta.cod_ancert != '' ".$where." ORDER BY cast(kardex.numescritura as unsigned)";
}elseif($estado == -1){
	$sql = "SELECT kardex.idkardex,kardex.kardex,kardex.numescritura,kardex.fechaescritura,IF(ta.cod_ancert IS NULL,'',ta.cod_ancert)AS cod_ancert,kardex.estado_sisgen,kardex.idtipkar,kardex.fechaingreso,kardex.codactos,kardex.contrato,kardex.folioini,foliofin,kardex.fechaconclusion,ta.actouif,ta.actosunat
FROM kardex  , tiposdeacto ta WHERE  STR_TO_DATE(kardex.fechaescritura,'%Y-%m-%d') BETWEEN STR_TO_DATE('$fechaDesde','%Y-%m-%d')
				AND STR_TO_DATE('$fechaHasta','%Y-%m-%d') AND SUBSTRING(kardex.codactos,1,3)=ta.idtipoacto
				AND numescritura <>''   and kardex.idtipkar = '$tipoInstrumento' ".$where." ORDER BY cast(kardex.numescritura as unsigned)";
}else{
	$sql = "SELECT kardex.idkardex,kardex.kardex,kardex.numescritura,kardex.fechaescritura,IF(ta.cod_ancert IS NULL,'',ta.cod_ancert)AS cod_ancert,kardex.estado_sisgen,kardex.idtipkar,kardex.fechaingreso,kardex.codactos,kardex.contrato,kardex.folioini,foliofin,kardex.fechaconclusion,ta.actouif,ta.actosunat
FROM kardex  , tiposdeacto ta WHERE  STR_TO_DATE(kardex.fechaescritura,'%Y-%m-%d') BETWEEN STR_TO_DATE('$fechaDesde','%Y-%m-%d')
				AND STR_TO_DATE('$fechaHasta','%Y-%m-%d') AND SUBSTRING(kardex.codactos,1,3)=ta.idtipoacto
				AND numescritura <>''   and kardex.idtipkar = '$tipoInstrumento' AND kardex.estado_sisgen='$estado' ".$where." ORDER BY cast(kardex.numescritura as unsigned)";
}

//die($sql);
$result = mysqli_query($conn,$sql);
$data = array();
$i = 1;
$affectedRow = mysqli_affected_rows($conn);
while($row = mysqli_fetch_array($result)){
	$estadoSisgen = $row['estado_sisgen'];
	switch ($estadoSisgen) {
		case 0:
			# code...
			$row['estado_sisgen'] = 'No Enviado';
			break;
		case 1:
			# code...
			$row['estado_sisgen'] = 'Enviado';
			break;
		case 2:
		# code...
			$row['estado_sisgen'] = 'Enviado(Observado)';
			break;
		case 3:
			# code...
			$row['estado_sisgen'] = 'No Enviado(Fallido)';

			break;
		
		default:
			# code...
			break;
	}


	$kardex = $row['kardex'];
	$numeroEscritura = $row['numescritura'];
	if($i == 1){
		$auxNumeroEscritura = $numeroEscritura;
		$auxKardex = $kardex;
	}else{ 
		if($auxNumeroEscritura == $numeroEscritura && $all){
			$data[] = array('numescritura'=>$numeroEscritura,
				'idkardex'=>'','kardex'=>$auxKardex.','.$kardex,'idtipkar'=>'','fechaingreso'=>'',
				'fechaescritura'=>'','cod_ancert'=>'-2','folioini'=>'',
				'fechaconclusion'=>'','codactos'=>'','contrato'=>'','estado_sisgen'=>'-1',
				'actouif'=>'','actosunat'=>'');
		}else
		if($auxNumeroEscritura  != ($numeroEscritura-1) && $all){
			$data[] = array('numescritura'=>($numeroEscritura-1),
				'idkardex'=>'','kardex'=>'','idtipkar'=>'','fechaingreso'=>'',
				'fechaescritura'=>'','cod_ancert'=>'-1','folioini'=>'',
				'fechaconclusion'=>'','codactos'=>'','contrato'=>'','estado_sisgen'=>'-1',
				'actouif'=>'','actosunat'=>'');
		}
		$auxNumeroEscritura = $numeroEscritura;
		$auxKardex = $kardex;
	}

	$idKardex = $row['idkardex'];
	
	$idTipoKardex = $row['idtipkar'];
	$fechaIngreso = $row['fechaingreso'];

	

	$fechaEscritura = $row['fechaescritura'];
	$arrFechaEscritura = explode('-', $fechaEscritura);
	$row['fechaescritura'] = $arrFechaEscritura[2].'/'.$arrFechaEscritura[1].'/'.$arrFechaEscritura[0];
	$codigoAncert = $row['cod_ancert'];
	$folioInicial = $row['folioini'];
	$folioFinal = $row['foliofin'];
	$fechaConclusion = $row['fechaconclusion'];
	
	$codigoActo = $row['codactos'];
	$contrato = $row['contrato'];
	$row['contrato'] = utf8_encode($row['contrato']);
	$row[9] = utf8_encode($row[9]);
	if($row['idtipkar']=='1'){$tipoKardexSisgen ='E';}
	if($row['idtipkar']=='2'){$tipoKardexSisgen ='C';}
	if($row['idtipkar']=='3'){$tipoKardexSisgen ='V';}
	if($row['idtipkar']=='4'){$tipoKardexSisgen ='G';}
	if($row['idtipkar']=='5'){$tipoKardexSisgen ='T';}

	if($estado != 5){
		$data[] = $row;
	}
	

	$sqlInsertSisgenTemp = "INSERT INTO sisgen_temp(idkardex,kardex,idtipkar,fecha_ingreso,codactos,contrato,folioini,foliofin,fecha_conclusion,numescritura,fechaescritura, cod_ancert ) VALUES ('$idKardex','$kardex','$tipoKardexSisgen','$fechaIngreso','$codigoActo','$contrato','$folioInicial','$folioFinal','$fechaConclusion','$numeroEscritura','$fechaEscritura','$codigoAncert')";
	//die($sqlInsertSisgenTemp);

	mysqli_query($conn,$sqlInsertSisgenTemp) or die(mysqli_error());
	$i++;
}



if($estado == 5){
	$affectedRow = count($data);
}



$objResponse = new stdClass();
$objResponse->error = 0;
$objResponse->data = $data;
$objResponse->total = $affectedRow ;


echo json_encode($objResponse);
