<?php
include_once '../conexion.php';
$listErrors = $_POST['listError'];
$data = json_decode($listErrors);


$totalCorrectErrors = count($data);
$totalCorrectErrorOk = 0;
foreach ($data as $row) {
	# code...
	$kardex = $row->kardex;
	$tipoActo = $row->tipoActo;
	$itemMp = $row->itemMp;
	$typeOfCorrection = $row->typeOfCorrection;
	$categoryCorrect = $row->categoryCorrect;

	#ACTOS
	if($categoryCorrect == 1){
		$fechaEscritura = $row->writingDate;
		$sql = "UPDATE patrimonial SET nminuta = '$fechaEscritura' WHERE itemmp = '$itemMp'";
		$result = mysql_query($sql);
		if(mysql_affected_rows() != 0){
			$totalCorrectErrorOk = $totalCorrectErrorOk +1;
		}
	}
	#BIENES
	if($categoryCorrect == 2){
		#valores predeterminados
		$idtipbien = '10';
		$oespecific = 'VARIOS';
		$tipob = 'BIENES';
		if($typeOfCorrection == 1){
			$sql = "UPDATE detallebienes SET  itemmp = '$itemMp' WHERE kardex = '$kardex' AND idtipacto = '$tipoActo' ";
			//die($sql);
			$result = mysql_query($sql);
			if(mysql_affected_rows() != 0){
				$totalCorrectErrorOk = $totalCorrectErrorOk +1;
			}
		}else if($typeOfCorrection == 2){	
			$sql = "INSERT INTO detallebienes(itemmp,kardex,idtipacto,tipob,idtipbien,oespecific,coddis,fechaconst,smaquiequipo,tpsm,npsm,pregistral,idsedereg) VALUES('$itemMp','$kardex','$tipoActo','$tipob','$idtipbien','$oespecific','','','','','','','')";
			
			$result = mysql_query($sql);
			if(mysql_affected_rows() != 0){
				$totalCorrectErrorOk = $totalCorrectErrorOk + 1;
			}
		}else if($typeOfCorrection == 3){
			$sql = "UPDATE detallebienes SET  oespecific = '$oespecific' WHERE  itemmp = '$itemMp' ";
		
			$result = mysql_query($sql);
			if(mysql_affected_rows() != 0){
				$totalCorrectErrorOk = $totalCorrectErrorOk + 1;
			}
		}
	}
	#OTORGANTE
	if($categoryCorrect == 3){	
		if($typeOfCorrection == 1){
			$idtipdoc = 10;
			$numdoc = '';
			$idContratante = $row->idContractor;
			$sql = "UPDATE cliente2 SET idtipdoc = '$idtipdoc',numdoc = '$numdoc' WHERE idcontratante = '$idContratante' ";
			//die($sql);
			$result = mysql_query($sql);
			if(mysql_affected_rows() != 0){
				$totalCorrectErrorOk = $totalCorrectErrorOk + 1;
			}
		}
		if($typeOfCorrection == 2){
			$p = '100';
			/*$sql = "SELECT importetrans FROM patrimonial WHERE kardex = '$kardex' AND idtipoacto = '$tipoActo' LIMIT 1";
			
			$resultPatrimonial = mysql_query($sql);
			$rowPatrimonial = mysql_fetch_array($resultPatrimonial);
			$importeTrans = $rowPatrimonial['importetrans'];*/

			$sql = "SELECT actosunat FROM tiposdeacto WHERE idtipoacto = '$tipoActo' LIMIT 1";

			$resultActoSunat = mysql_query($sql);
			$rowActoSunat = mysql_fetch_array($resultActoSunat);
			$actoSunat = $rowActoSunat['actosunat'];

			#PARTE 1
			$sql = "SELECT  tipoOtorgante FROM  pdt_actos_tipo_otorgante WHERE   actoSunat = '$actoSunat' AND parte = 1 LIMIT 1";
			
			$resultActoTipoOtorgante = mysql_query($sql);
			$rowActoTipoOtorgante1 = mysql_fetch_array($resultActoTipoOtorgante);
			$tipoOtorganteParte1  = $rowActoTipoOtorgante1['tipoOtorgante'];
			$sql = "SELECT contratantesxacto.id,CAST(contratantesxacto.porcentaje AS DECIMAL(12,2)) AS porcentaje FROM  contratantesxacto  LEFT JOIN 
					 actocondicion ON contratantesxacto.idcondicion = actocondicion.idcondicion
					WHERE  contratantesxacto.idtipoacto = '$tipoActo' AND contratantesxacto.kardex = '$kardex' AND actocondicion.totorgante = '$tipoOtorganteParte1' ";
					//die($sql);
					
			$resultContratantesParte1 = mysql_query($sql);
			$sumParte1 = 0;
			$countContratantes = mysql_affected_rows();
			$porcenjatePorContratante  = ($p/$countContratantes);
			$porcenjatePorContratante = number_format($porcenjatePorContratante,2,'.','');
			$arrIdContratante = array();
			while($rowContratante = mysql_fetch_array($resultContratantesParte1)){
				$id = (int)$rowContratante['id'];
				$arrIdContratante[] = array('id'=>$id,'porcentaje'=>$porcenjatePorContratante);
				$sumParte1 = $sumParte1 + $rowContratante['porcentaje'];

			}
			
			if($sumParte1 != $p){
				$primerContratantePorcentaje  = ($p - (($countContratantes-1)*$porcenjatePorContratante));

				$arrIdContratante[0]['porcentaje'] = $primerContratantePorcentaje;

				foreach ($arrIdContratante as $key => $value) {
					# code...
					$porcentaje = $value['porcentaje'];
					$id = $value['id'];
					$sql = "UPDATE contratantesxacto SET porcentaje = '$porcentaje' WHERE id = '$id'";

					$resultPorcentaje = mysql_query($sql);
					if(mysql_affected_rows() != 0){
						$totalCorrectErrorOk = $totalCorrectErrorOk + 1;
					}
				}
			}

			#PARTE 2
			$sql = "SELECT  tipoOtorgante FROM  pdt_actos_tipo_otorgante WHERE   actoSunat = '$actoSunat' AND parte = 2 LIMIT 1";
			$resultActoTipoOtorgante = mysql_query($sql);
			$rowActoTipoOtorgante2 = mysql_fetch_array($resultActoTipoOtorgante);
			$tipoOtorganteParte2  = $rowActoTipoOtorgante2['tipoOtorgante'];
			$sql = "SELECT contratantesxacto.id,CAST(contratantesxacto.porcentaje AS DECIMAL(12,2)) AS porcentaje FROM  contratantesxacto  LEFT JOIN 
					 actocondicion ON contratantesxacto.idcondicion = actocondicion.idcondicion
					WHERE  contratantesxacto.idtipoacto = '$tipoActo' AND contratantesxacto.kardex = '$kardex' AND actocondicion.totorgante = '$tipoOtorganteParte2' ";
			$resultContratantesParte2 = mysql_query($sql);
			$sumParte2 = 0;
			$countContratantes = mysql_affected_rows();
			$porcenjatePorContratante  = ($p/$countContratantes);
			$porcenjatePorContratante = number_format($porcenjatePorContratante,2,'.','');
			$arrIdContratante = array();
			while($rowContratanteParte2 = mysql_fetch_array($resultContratantesParte2)){
				$id = (int)$rowContratanteParte2['id'];
				$arrIdContratante[] = array('id'=>$id,'porcentaje'=>$porcenjatePorContratante);
				$sumParte2 = $sumParte2 + $rowContratanteParte2['porcentaje'];

			}

			if($sumParte2 != $p){
				$primerContratantePorcentaje  = ($p - (($countContratantes-1)*$porcenjatePorContratante));
				$arrIdContratante[0]['porcentaje'] = $primerContratantePorcentaje;
				foreach ($arrIdContratante as $key => $value) {
					# code...
					$porcentaje = $value['porcentaje'];
					$id = $value['id'];
					$sql = "UPDATE contratantesxacto SET porcentaje = '$porcentaje' WHERE id = '$id'";
					$resultPorcentaje = mysql_query($sql);
					if(mysql_affected_rows() != 0){
						$totalCorrectErrorOk = $totalCorrectErrorOk + 1;
					}
				}
			}


		}
		if($typeOfCorrection == 3){
			$idContratante = $row->idContractor;
			$sql = "SELECT LPAD((CAST(idrenta AS UNSIGNED)+1),6,'0') AS idRenta FROM renta ORDER BY idrenta DESC LIMIT 1";
			$resultIdRenta = mysql_query($sql);
			$rowIdRenta =  mysql_fetch_array($resultIdRenta);	
			$idRenta = $rowIdRenta['idRenta']; 
			$sql = "INSERT INTO  renta (idrenta,idcontratante,kardex,pregu1,pregu2,pregu3) VALUES('$idRenta','$idContratante','$kardex','0','0','1')";
			
			$resultRenta = mysql_query($sql);
			if(mysql_affected_rows() != 0){
				$totalCorrectErrorOk = $totalCorrectErrorOk + 1;
			}	
				
		}
		


		//die($sql);
		/*if(){

		}*/
	}
	#MEDIO DE PAGO
	if($categoryCorrect == 4){
		if($typeOfCorrection == 1){
			$documentos = 'VOUCHER';
			$sql = "UPDATE detallemediopago SET documentos = '$documentos'  WHERE itemmp = '$itemMp'";
			$result = mysql_query($sql);
			if(mysql_affected_rows() != 0){
				$totalCorrectErrorOk = $totalCorrectErrorOk + 1;
			}
		}
		
		if($typeOfCorrection == 2){
			$sql = "UPDATE detallemediopago SET itemmp = '$itemMp' WHERE kardex = '$kardex' AND tipacto = '$tipoActo'";
			//die($sql);
			$result = mysql_query($sql);
			if(mysql_affected_rows() != 0){
				$totalCorrectErrorOk = $totalCorrectErrorOk + 1;
			}
		}
	}


	


}		



#SUBSANANDO ERRORES DE MEDIOS DE PAGO
/*if($typeFile == 4){	
	$documentos = 'VOUCHER';
	$sql = "UPDATE detallemediopago SET documentos = '$documentos'  WHERE itemmp = '$itemMp'";
}*/






$objStdClass = new stdClass();
$objStdClass->error = 0;
$objStdClass->errorDescription = 'Se afectaron '.$totalCorrectErrorOk.' registros.';
echo json_encode($objStdClass);