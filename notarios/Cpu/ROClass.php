<?php
/**
 *  Clase para realizar Las validaciones RO
 * @version 1.2.0
 * @author Spencer Castillo <spencer.leo040890@gmail.com>
 * @copyright 2016
 * @license  GPL
 */ 
ini_set('memory_limit', '-1');
set_time_limit(0);
include_once('conexion.php');
require_once 'ItemRoClass.php';
require_once 'RowRoClass.php';
include_once '../../includes/ClaseLetras.class.php';
class RoClass {
	private $_initialDate;
	private $_finalDate;
	private $_arrObjRo = array();
	private $_arrErrorsRo = array();
	private $_totalKardex;
	private $_arrErrorKardex = array();
	private $_umbral;
	private $_totalKardexUmbral;
	private $_totalAmountOperationUmbral;
	private $_year;
	private $_exchangeRate;

	private $_dataKardex =  array();

	public function __construct($initialDate, $finalDate){
		$this->_initialDate = $initialDate;
		$this->_finalDate = $finalDate;
		$this->_totalKardex = 0;
		$this->_umbral = 2500;
		$this->_exchangeRate = 3.00;
	}

	public function  setYear($year){
		$this->_year = $year;
	}

	public function setExchangeRate($value){
		$this->_exchangeRate = $value;
	}

	public function loadDataByYear(){
		$sql = "TRUNCATE ro";
		$result = mysql_query($sql);
		$sql = "SELECT DISTINCT kardex.idkardex,kardex.codactos, kardex.kardex, kardex.idtipkar,
				(CASE KARDEX.idtipkar WHEN 1 THEN 'E' WHEN 3 THEN 'T' WHEN 4 THEN 'G'  ELSE  'SIN INICIAL' END ) AS tipoInstumentoPublicoNotarial,
				kardex.numescritura,kardex.fechaescritura,kardex.fechaescritura,kardex.fechaconclusion FROM 
				 kardex WHERE kardex.idtipkar != 2 AND kardex.idtipkar != 5 AND YEAR(kardex.fechaescritura) = '$this->_year' 

				 ORDER BY kardex.idtipkar,kardex.fechaescritura,CAST(kardex.numescritura AS UNSIGNED) ASC";

		$result = mysql_query($sql);
		$totalKardex = mysql_affected_rows();
		$affectedRowRo = 0;
		while($row = mysql_fetch_assoc($result)){

			$idKardex = $row['idkardex'];
			$codActos = $row['codactos'];
			$kardex = $row['kardex'];
			$idTipoKardex = $row['idtipkar'];
			$tipoInstumentoPublicoNotarial = $row['tipoInstumentoPublicoNotarial'];
			$numeroEscritura = $row['numescritura'];
			$fechaEscritura = $row['fechaescritura'];
			$fechaConclusion = $row['fechaconclusion'];

			$arrCodActos = array();
			for($i = 0;$i<strlen($codActos);$i = $i+3){
				$arrCodActos[] = array('codActo'=>substr($codActos, $i ,3));
			}
			foreach ($arrCodActos as  $item) {
				# code...
				$codActo = $item['codActo'];
				$sql = "SELECT idtipoacto,actosunat,actouif,idtipkar,desacto,umbral,impuestos,idcalnot,idecalreg,idmodelo,rol_part FROM  tiposdeacto WHERE actouif != '' AND idtipoacto='$codActo'";

				$resultTipoActo = mysql_query($sql);
				$rowTipoActo = mysql_fetch_assoc($resultTipoActo);

				if($rowTipoActo){
					$actoUif = $rowTipoActo['actouif'];
					$tipo = 'I';
					$sql = "INSERT INTO  ro (idKardex,kardex,idTipoKardex,tipoInstumentoPublicoNotarial,codActos,uif,numeroEscritura,fechaEscritura,fechaConclusion,tipo) VALUES ('$idKardex','$kardex','$idTipoKardex','$tipoInstumentoPublicoNotarial','$codActo','$actoUif','$numeroEscritura','$fechaEscritura','$fechaConclusion','$tipo')";
			
					$resultRo = mysql_query($sql);
					if(mysql_affected_rows() == 1){
						$affectedRowRo++;
					}
				}

			}
		}

	}

	public function loadData(){
		$sql = "TRUNCATE ro";
		$result = mysql_query($sql);
		$sql = "TRUNCATE ro_not";
		$result = mysql_query($sql);
		$sql = "SELECT DISTINCT kardex.idkardex,kardex.codactos, kardex.kardex, kardex.idtipkar,(CASE KARDEX.idtipkar WHEN 1 THEN 'E' WHEN 3 THEN 'T' WHEN 4 THEN 'G'  ELSE  'SIN INICIAL' END ) AS tipoInstumentoPublicoNotarial,kardex.numescritura,kardex.fechaescritura,kardex.fechaescritura,kardex.fechaconclusion FROM  kardex WHERE kardex.idtipkar != 2 AND kardex.idtipkar != 5 AND kardex.fechaescritura >= STR_TO_DATE('$this->_initialDate','%d/%m/%Y') AND kardex.fechaescritura <= STR_TO_DATE('$this->_finalDate','%d/%m/%Y')   ORDER BY kardex.idtipkar,kardex.fechaescritura,CAST(kardex.numescritura AS UNSIGNED) ASC";
	//die($sql);
		$result = mysql_query($sql);
		$totalKardex = mysql_affected_rows();
		$affectedRowRo = 0;
		$affectedRowRoNot = 0;
		while($row = mysql_fetch_assoc($result)){

			$idKardex = $row['idkardex'];
			$codActos = $row['codactos'];
			$kardex = $row['kardex'];
			$idTipoKardex = $row['idtipkar'];
			$tipoInstumentoPublicoNotarial = $row['tipoInstumentoPublicoNotarial'];
			$numeroEscritura = $row['numescritura'];
			$fechaEscritura = $row['fechaescritura'];
			$fechaConclusion = $row['fechaconclusion'];

			$arrCodActos = array();
			for($i = 0;$i<strlen($codActos);$i = $i+3){
				$arrCodActos[] = array('codActo'=>substr($codActos, $i ,3));
			}
			foreach ($arrCodActos as  $item) {
				# code...
				$codActo = $item['codActo'];
				$sql = "SELECT idtipoacto,actosunat,actouif,idtipkar,desacto,umbral,impuestos,idcalnot,idecalreg,idmodelo,rol_part FROM  tiposdeacto WHERE actouif != '' AND idtipoacto='$codActo'";

				$resultTipoActo = mysql_query($sql);
				$rowTipoActo = mysql_fetch_assoc($resultTipoActo);


			//	if($rowTipoActo==true && $kardex!= 'KAR16099-2018' ){
				if($rowTipoActo){
					$actoUif = $rowTipoActo['actouif'];
					$tipo = 'I';

					$sql = "INSERT INTO  ro (idKardex,kardex,idTipoKardex,tipoInstumentoPublicoNotarial,codActos,uif,numeroEscritura,fechaEscritura,fechaConclusion,tipo) VALUES ('$idKardex','$kardex','$idTipoKardex','$tipoInstumentoPublicoNotarial','$codActo','$actoUif','$numeroEscritura','$fechaEscritura','$fechaConclusion','$tipo')";
					

					$resultRo = mysql_query($sql);
					if(mysql_affected_rows() == 1){
						$affectedRowRo++;
					}
				}else{
					$sql = "INSERT INTO  ro_not (idKardex,kardex,idTipoKardex,tipoInstumentoPublicoNotarial,codActos,uif,numeroEscritura,fechaEscritura,fechaConclusion,tipo) VALUES ('$idKardex','$kardex','$idTipoKardex','$tipoInstumentoPublicoNotarial','$codActo','$actoUif','$numeroEscritura','$fechaEscritura','$fechaConclusion','$tipo')";

					$resultRo = mysql_query($sql);
					if(mysql_affected_rows() == 1){
						$affectedRowRoNot++;
					}
				}



			}
		}

		#INFORMACION COMPLEMENTARIA
		$sql = "SELECT DISTINCT  kardex.idkardex,kardex.kardex,kardex.idtipkar,(CASE KARDEX.idtipkar WHEN 1 THEN 'E' WHEN 3 THEN 'T' WHEN 4 THEN 'G'  ELSE  'SIN INICIAL' END ) AS tipoInstumentoPublicoNotarial,
			kardex.codactos,kardex.numescritura,kardex.fechaescritura,kardex.fechaconclusion,contratantes.fechafirma FROM  contratantesxacto 
			INNER JOIN contratantes ON  contratantesxacto.kardex  = contratantes.kardex
			LEFT JOIN kardex ON contratantesxacto.kardex = kardex.kardex WHERE
			contratantes.fechafirma != '' AND STR_TO_DATE(contratantes.fechafirma,'%d/%m/%Y') >= STR_TO_DATE('$this->_initialDate','%d/%m/%Y')
			AND STR_TO_DATE(contratantes.fechafirma,'%d/%m/%Y') <= STR_TO_DATE('$this->_finalDate','%d/%m/%Y') AND kardex.fechaescritura != ''
			AND kardex.fechaescritura < STR_TO_DATE('$this->_initialDate','%d/%m/%Y') AND kardex.idtipkar != 2 
			AND kardex.idtipkar != 5 GROUP BY contratantesxacto.kardex";
		//die($sql);
		$result = mysql_query($sql);

		while($row = mysql_fetch_assoc($result)){
			$idKardex = $row['idkardex'];
			$kardex = $row['kardex'];
			$idTipoKardex = $row['idtipkar'];
			$tipoInstumentoPublicoNotarial = $row['tipoInstumentoPublicoNotarial'];
			$codActos = $row['codactos'];
			$numeroEscritura = $row['numescritura'];
			$fechaEscritura = $row['fechaescritura'];
			$fechaConclusion = $row['fechaconclusion'];



			$arrCodActos = array();
			for($i = 0;$i<strlen($codActos);$i = $i+3){
				$arrCodActos[] = array('codActo'=>substr($codActos, $i ,3));
			}


			foreach ($arrCodActos as  $item) {
				# code...
				$codActo = $item['codActo'];
				$sql = "SELECT idtipoacto,actosunat,actouif,idtipkar,desacto,umbral,impuestos,idcalnot,idecalreg,idmodelo,rol_part FROM  tiposdeacto WHERE actouif != '' AND idtipoacto='$codActo'";

				$resultTipoActo = mysql_query($sql);
				$rowTipoActo = mysql_fetch_assoc($resultTipoActo);

				if($rowTipoActo){
					$actoUif = $rowTipoActo['actouif'];
					$tipo = 'C';
					$sql = "INSERT INTO  ro (idKardex,kardex,idTipoKardex,tipoInstumentoPublicoNotarial,codActos,uif,numeroEscritura,fechaEscritura,fechaConclusion,tipo) VALUES ('$idKardex','$kardex','$idTipoKardex','$tipoInstumentoPublicoNotarial','$codActo','$actoUif','$numeroEscritura','$fechaEscritura','$fechaConclusion','$tipo')";
						
					$resultRo = mysql_query($sql);
					if(mysql_affected_rows() == 1){
						$affectedRowRo++;
					}
				}

			}

		}
	}






	public function loadDataRoNotUmbral(){
        $sql = "SELECT idRo,idKardex,kardex,idTipoKardex,tipoInstumentoPublicoNotarial,numeroEscritura,fechaEscritura,fechaConclusion FROM ro WHERE ro=0";
	//die($sql);

        $result = mysql_query($sql);
		$totalKardex = mysql_affected_rows();
		$affectedRowRo = 0;
        while($row = mysql_fetch_assoc($result)){

			$idKardex = $row['idKardex'];
			$codActos = $row['codactos'];
			$kardex = $row['kardex'];
			$idTipoKardex = $row['idTipoKardex'];
			$tipoInstumentoPublicoNotarial = $row['tipoInstumentoPublicoNotarial'];
			$numeroEscritura = $row['numeroEscritura'];
			$fechaEscritura = $row['fechaescritura'];
			$fechaConclusion = $row['fechaconclusion'];
			$tipo = 'I';
			$sql = "INSERT INTO  ro_not (idKardex,kardex,idTipoKardex,tipoInstumentoPublicoNotarial,codActos,uif,numeroEscritura,fechaEscritura,fechaConclusion,tipo) VALUES ('$idKardex','$kardex','$idTipoKardex','$tipoInstumentoPublicoNotarial','$codActos','$actoUif','$numeroEscritura','$fechaEscritura','$fechaConclusion','$tipo')";
			
            $resultRo = mysql_query($sql);
            if(mysql_affected_rows() == 1){
                $affectedRowRoNot++;
            }
        
        }
	
	
	}















	public function  generateData(){

		$arrErrors = array();

		$sql = "SELECT pkDataField,numberOfData,dataType,numberDataType,columnLength,decimalLength,initialPosition,
		finalPosition,columnCode,columnDescription FROM  ro_data_field ORDER BY numberOfData";

		$resultRoDataField = mysql_query($sql);
		$arrRoDataField = array();
		while($row = mysql_fetch_assoc($resultRoDataField)){
			$row['columnDescription'] = $row['columnDescription'];
			$arrRoDataField[] = $row;
		}
		$sql = "SELECT 
			ro.idRo,ro.idKardex,ro.kardex,ro.idTipoKardex,ro.tipo AS tipoEnvio,ro.tipoInstumentoPublicoNotarial AS IPNP,ro.codActos,ro.uif,
			ro.uif AS tipoOperacion,tiposdeacto.desacto AS act,IF (ro.numeroEscritura = ' ',5,0) AS validationNumeroEscritura,
			ro.numeroEscritura,ro.fechaEscritura,REPLACE(ro.fechaEscritura,'-','') AS fechaEscrituraRo,
			STR_TO_DATE(ro.fechaConclusion,'%d/%m/%Y') AS fechaConclusion, 
			(CASE  WHEN  ro.fechaConclusion='' OR ro.fechaConclusion IS NULL THEN 'N' ELSE 'C' END ) AS conclusion,
			patrimonial.importetrans AS montoTotalOperacion,
			(CASE  WHEN (patrimonial.idmon != 0 AND (patrimonial.importetrans = '0.00' OR patrimonial.importetrans = '') ) THEN 51 WHEN ( IF(patrimonial.importetrans IS NULL,'V',patrimonial.importetrans) REGEXP   (SELECT ro_validation_by_act.dataValue FROM ro_validation_by_act
						 WHERE ro_validation_by_act.codeAct = ro.uif AND ro_validation_by_act.fkDataField = 51 LIMIT 1)) != 0
						 THEN 0 ELSE 51 END)AS validationMontoOperacion,
			patrimonial.exhibiomp,patrimonial.presgistral,patrimonial.fpago ,
			(SELECT ro_validation_by_act.detailValue FROM ro_validation_by_act
			 WHERE ro_validation_by_act.codeAct = ro.uif AND ro_validation_by_act.fkDataField = 46) AS detailValueFormaPago,
			(CASE  WHEN (fpago_uif.codigo REGEXP   (SELECT ro_validation_by_act.dataValue FROM ro_validation_by_act
			 WHERE ro_validation_by_act.codeAct = ro.uif AND ro_validation_by_act.fkDataField = 46 LIMIT 1
			)) != 0 THEN 0 ELSE 46 END) AS validationFormaPago,
			fpago_uif.codigo AS codigoFormaPago,
			(SELECT ro_validation_by_act.detailValue FROM ro_validation_by_act
			 WHERE ro_validation_by_act.codeAct = ro.uif AND ro_validation_by_act.fkDataField = 47) AS detailValueOportunidadPago,
			 (CASE  WHEN (IF(patrimonial.idoppago = '','V',patrimonial.idoppago) REGEXP   (SELECT ro_validation_by_act.dataValue FROM ro_validation_by_act
			 WHERE ro_validation_by_act.codeAct = ro.uif AND ro_validation_by_act.fkDataField = 47 LIMIT 1
			)) != 0 THEN 0 ELSE 47 END) AS validationOportunidadPago, 
			patrimonial.idoppago AS oportunidadPago,
			IF(patrimonial.idoppago = 99 AND patrimonial.des_idoppago = '' ,0,0) AS validationDescripcionOportunidadPago,
			IF(patrimonial.idoppago = 99 ,'NO PRECISA','')AS descripcionOportunidadPago,
			patrimonial.idmon AS idMoneda ,
			monedas.codigo AS monedaOperacion,
			IF(patrimonial.tipocambio = '', '0.00',patrimonial.tipocambio) AS tipoCambio
			FROM  ro 
			LEFT JOIN patrimonial ON  ro.kardex = patrimonial.kardex AND ro.codActos = patrimonial.idtipoacto
			LEFT JOIN monedas ON patrimonial.idmon = monedas.idmon
			LEFT JOIN fpago_uif ON patrimonial.fpago = fpago_uif.id_fpago 
			LEFT JOIN tiposdeacto ON tiposdeacto.idtipoacto = patrimonial.idtipoacto 
			WHERE (patrimonial.idmon = 1 AND ROUND((patrimonial.importetrans/ROUND(IF(patrimonial.tipocambio = '',1,patrimonial.tipocambio),2)),2) >= IF( patrimonial.tipocambio = '',ROUND(7500,2), ROUND(2500,2)))OR
       (patrimonial.idmon = 2 AND ROUND(2500,2)<=ROUND(patrimonial.importetrans,2))
			OR (patrimonial.idmon = 2 AND ROUND(2500,2)<=ROUND(patrimonial.importetrans,2))
			OR ro.uif = '048' OR ro.uif = '050' OR ro.uif = '051' OR ro.uif='052' OR ro.uif='053' OR ro.uif='054' OR ro.uif='055' OR ro.uif = '037' OR ro.uif = '038' OR ro.uif = '039'
			OR ro.uif = '040' OR ro.uif = '041' OR ro.uif = '042' OR ro.uif = '043' OR ro.uif = '044' OR ro.uif = '045'
			 GROUP BY ro.idRo";

	    
		$result  = mysql_query($sql);
		$dataKardex = array();
		$codeRow = 0;
		$registrationNumberOperation = 0;
		$errorList = array();
		$arrRo = array();
		$arrObj = array();
		$this->_totalKardex = mysql_affected_rows();


		while($row = mysql_fetch_assoc($result)){

			$idRo = $row['idRo'];
			$sqll = "UPDATE ro SET ro ='1' WHERE idRO=".$idRo;	
		//	die($sqll);
			mysql_query($sqll);


			$row['codigoFila'] = $codeRow;
			$row['numeroIPNPA'] = '';
			$row['fechaIPNPA'] = '';
			$row['modalidadOperacion'] = '';
			$row['cantidadOperacionMultiple'] = '';
			$idKardex = $row['idKardex'];
			$kardex = $row['kardex'];
			$codAct = $row['codActos'];
			$IPNP = $row['IPNP'];
			$numeroEscritura = $row['numeroEscritura'];

			$validationNumeroEscritura = $row['validationNumeroEscritura'];

			$tipoEnvio = $row['tipoEnvio'];
			$fechaEscritura = $row['fechaEscrituraRo'];
			$conclusion = $row['conclusion'];
			$tipoOperacion = $row['tipoOperacion'];
			$codigoFormaPago = $row['codigoFormaPago'];
			$validationFormaPago = $row['validationFormaPago'];
			$detailValueFormaPago = $row['detailValueFormaPago'];
			$oportunidadPago = $row['oportunidadPago'];
			$validationOportunidadPago = $row['validationOportunidadPago'];
			$detailValueOportunidadPago = $row['detailValueOportunidadPago'];
			$descripcionOportunidadPago = $row['descripcionOportunidadPago'];
			$validationDescripcionOportunidadPago = $row['validationDescripcionOportunidadPago'];
			$monedaOperacion = $row['monedaOperacion'];
			$montoOperacion = $row['montoTotalOperacion'];
			$validationMontoOperacion = $row['validationMontoOperacion'];
			$tipoCambio = $row['tipoCambio'];
			$idMoneda = $row['idMoneda'];
			$act = $row['act'];
			$actUIF = $row['uif'];




			if($tipoEnvio == 'I'){
				$sql = $IPNP == 'T'? "SELECT detallevehicular.kardex ,(CASE WHEN detallevehicular.idsedereg != '' AND detallevehicular.pregistral != '' THEN 'I'  ELSE 'N' END) AS inscripcionRegistralBien  ,detallevehicular.idsedereg  AS zonaRegistralBien, detallevehicular.pregistral AS numeroPartidaRegistralBien FROM detallevehicular WHERE detallevehicular.kardex = '$kardex'  AND detallevehicular.idtipacto = '$codAct'":"SELECT  detallebienes.kardex,detallebienes.idsedereg AS zonaRegistralBien,
								detallebienes.pregistral AS numeroPartidaRegistralBien,
								(CASE WHEN detallebienes.idsedereg != '' AND detallebienes.pregistral != '' THEN 'I'  ELSE 'N' END) AS inscripcionRegistralBien 
								FROM detallebienes WHERE detallebienes.kardex = '$kardex' AND detallebienes.idtipacto='$codAct'";

				$resultDetalleBien = mysql_query($sql);
				if(mysql_affected_rows() != 0){
					$rowDetalleBien = mysql_fetch_assoc($resultDetalleBien);
					$inscripcionRegistralBien  = $rowDetalleBien['inscripcionRegistralBien'];
					$zonaRegistralBien = $rowDetalleBien['zonaRegistralBien'];
					$numeroPartidaRegistralBien = $rowDetalleBien['numeroPartidaRegistralBien'];
				}else{
					$inscripcionRegistralBien = 'N';
					$zonaRegistralBien = '';
					$numeroPartidaRegistralBien = '';
				}
				$sql = "SELECT DISTINCT detallemediopago.kardex,tiposdeacto.actouif  AS tipoOperacion,detallemediopago.tipacto AS tipoActo,
						 SUM(detallemediopago.importemp) AS montoTipoFondo, 
						  (CASE   WHEN ( IF(SUM(detallemediopago.importemp) IS NULL,'V',SUM(detallemediopago.importemp)) REGEXP   (SELECT ro_validation_by_act.dataValue FROM ro_validation_by_act
						 WHERE ro_validation_by_act.codeAct = tiposdeacto.actouif AND ro_validation_by_act.fkDataField = 53 LIMIT 1)) != 0 
						 THEN 0 ELSE 53 END)AS validationMontoTipoFondo,
						 (SELECT ro_validation_by_act.detailValue FROM ro_validation_by_act
						WHERE ro_validation_by_act.codeAct = tiposdeacto.actouif AND ro_validation_by_act.fkDataField = 53) AS detailValueMontoTipoFondo,
						 mediospago.uif AS codigoTipoFondo,
						 (CASE  WHEN (IF(mediospago.uif = '','V',mediospago.uif) REGEXP   (SELECT ro_validation_by_act.dataValue FROM ro_validation_by_act
						 WHERE ro_validation_by_act.codeAct = tiposdeacto.actouif AND ro_validation_by_act.fkDataField = 44 LIMIT 1)) != 0
						 THEN 0 ELSE 44 END)AS validationTipoFondo,
						 (SELECT ro_validation_by_act.detailValue FROM ro_validation_by_act
						WHERE ro_validation_by_act.codeAct = tiposdeacto.actouif AND ro_validation_by_act.fkDataField = 44) AS detailValueTipoFondo
						 FROM detallemediopago 
						 INNER JOIN mediospago ON detallemediopago.codmepag = mediospago.codmepag
						 LEFT JOIN fpago_uif ON fpago_uif.id_fpago=detallemediopago.fpago 
						 LEFT JOIN tiposdeacto  ON  detallemediopago.tipacto = tiposdeacto.idtipoacto
						 WHERE detallemediopago.kardex='$kardex' 
						 AND detallemediopago.tipacto='$codAct' 
						 GROUP BY detallemediopago.codmepag, detallemediopago.tipacto";


						

				$registrationNumberOperation = $registrationNumberOperation + 1;
				$resultMedioPago = mysql_query($sql);
				$tipoActoMedioPago = 0;
				$arrObjItemRo = array();

				if(mysql_affected_rows() != 0){

					while($rowMedioPago = mysql_fetch_assoc($resultMedioPago)){
						$codeRow++;

						
						$objRowRowClass = new RowRoClass($arrRoDataField);
						$tipoActoMedioPago = $rowMedioPago['tipoActo'];
						$montoTipoFondo = $rowMedioPago['montoTipoFondo'];
						$codigoTipoFondo = $rowMedioPago['codigoTipoFondo'];
						$validationTipoFondo = $rowMedioPago['validationTipoFondo'];
						$detailValueTipoFondo = $rowMedioPago['detailValueTipoFondo'];
						$validationMontoTipoFondo = $rowMedioPago['validationMontoTipoFondo'];
						$detailValueMontoTipoFondo = $rowMedioPago['detailValueMontoTipoFondo'];
						$arrFileRow['kardex'] = $kardex;


						$arrFileRow['codigoFila'] = $codeRow;
						$objRowRowClass->getItemRoByNumber(1)->setElementValue($codeRow);
						$objRowRowClass->getItemRoByNumber(1)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(1)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(1)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(1);


						$arrFileRow['numeroRegistroOperacion'] = $registrationNumberOperation;
						$objRowRowClass->getItemRoByNumber(2)->setElementValue($registrationNumberOperation);
						$objRowRowClass->getItemRoByNumber(2)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(2)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(2)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(2);

						
						$arrFileRow['tipoEnvio'] = $tipoEnvio;
						$objRowRowClass->getItemRoByNumber(3)->setElementValue($tipoEnvio);
						$objRowRowClass->getItemRoByNumber(3)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(3)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(3)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(3);

						$arrFileRow['IPNP'] = $IPNP;
						$objRowRowClass->getItemRoByNumber(4)->setElementValue($IPNP);
						$objRowRowClass->getItemRoByNumber(4)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(4)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(4)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(4);

						$arrFileRow['numeroIPNP'] = $numeroEscritura;
						$objRowRowClass->getItemRoByNumber(5)->setItemNumberError($validationNumeroEscritura);
						$objRowRowClass->getItemRoByNumber(5)->setElementValue($numeroEscritura);
						$objRowRowClass->getItemRoByNumber(5)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(5)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(5)->setAct($act);
						$objRowRowClass->getItemRoByNumber(5)->setDetailsError('El número de escritura no puede ser cero');
						if($numeroEscritura == '' ||  (int)($numeroEscritura)  === 0) 
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(5);



						$arrFileRow['fechaIPNP'] = $fechaEscritura;
						$objRowRowClass->getItemRoByNumber(6)->setElementValue($fechaEscritura);
						$objRowRowClass->getItemRoByNumber(6)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(6)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(6)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(6);

						$arrFileRow['numeroIPNPAclara'] = '';
						$objRowRowClass->getItemRoByNumber(7)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(7)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(7)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(7)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(7);

						$arrFileRow['fechaIPNPAclara'] = '';
						$objRowRowClass->getItemRoByNumber(8)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(8)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(8)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(8)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(8);


						$arrFileRow['conclusion'] = $conclusion;
						$objRowRowClass->getItemRoByNumber(9)->setElementValue($conclusion);
						$objRowRowClass->getItemRoByNumber(9)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(9)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(9)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(9);

						$arrFileRow['fechaFirmaParticipante'] = '';
						$objRowRowClass->getItemRoByNumber(10)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(10)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(10)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(1)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(10);


						$arrFileRow['modalidadOperacion'] = 'U';
						$objRowRowClass->getItemRoByNumber(11)->setElementValue('U');
						$objRowRowClass->getItemRoByNumber(11)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(11)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(11)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(11);

						$arrFileRow['cantidadOperacionMultiple'] = '';
						$objRowRowClass->getItemRoByNumber(12)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(12)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(12)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(12)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(12);

						$arrFileRow['representante'] = '';
						$objRowRowClass->getItemRoByNumber(13)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(13)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(13)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(13)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(13);
						$arrFileRow['validationRepresentante'] = 0;

						$arrFileRow['personaOperacion'] = '';
						$objRowRowClass->getItemRoByNumber(14)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(14)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(14)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(14)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(14);
						$arrFileRow['validationPersonaOperacion'] = 0;

						$arrFileRow['personaAFavor'] = '';
						$objRowRowClass->getItemRoByNumber(15)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(15)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(15)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(15)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(15);
						$arrFileRow['validationPersonaAFavor'] = 0;

						$arrFileRow['personaQueRepresenta'] = '';
						$objRowRowClass->getItemRoByNumber(16)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(16)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(16)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(16)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(16);
						$arrFileRow['validationPersonaQueRepresenta'] = 0;

						$arrFileRow['tipoRepresentacion'] = '';
						$objRowRowClass->getItemRoByNumber(17)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(17)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(17)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(17)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(17);
						$arrFileRow['validationTipoRepresentacion'] = 0;


						$arrFileRow['condicionResidencia'] = '';
						$objRowRowClass->getItemRoByNumber(18)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(18)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(18)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(18)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(18);
						$arrFileRow['validationCondicionResidencia'] = 0;

						$arrFileRow['tipoPersona'] = '';
						$objRowRowClass->getItemRoByNumber(19)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(19)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(19)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(19)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(19);
						$arrFileRow['validationTipoPersona'] = 0;


						$arrFileRow['codigoTipoDocumento'] = '';
						$objRowRowClass->getItemRoByNumber(20)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(20)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(20)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(20)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(20);
						$arrFileRow['validationTipoDocumento'] = 0;

						$arrFileRow['numeroDocumento'] = '';
						$objRowRowClass->getItemRoByNumber(21)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(21)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(21)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(21)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(21);
						$arrFileRow['validationNumeroDocumento'] = 0;

						$arrFileRow['numeroRuc'] = '';
						$objRowRowClass->getItemRoByNumber(22)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(22)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(22)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(22)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(22);
						$arrFileRow['validationNumeroRuc'] = 0;

						$arrFileRow['apellidoPaternoRazonSocial'] = '';
						$objRowRowClass->getItemRoByNumber(23)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(23)->setKardex($kardex);
						if($objRowRowClass->getItemRoByNumber(23)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(23);

						$arrFileRow['validationApellidoPaternoRazonSocial'] = 0;

						$arrFileRow['apellidoMaterno'] = '';
						$objRowRowClass->getItemRoByNumber(24)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(24)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(24)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(24)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(24);
						$arrFileRow['validationApellidoMaterno'] = 0;

						$arrFileRow['nombres'] = '';
						$objRowRowClass->getItemRoByNumber(25)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(25)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(25)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(25)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(25);
						$arrFileRow['validationNombres'] = 0;

						$arrFileRow['codigoNacion'] = '';
						$objRowRowClass->getItemRoByNumber(26)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(26)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(26)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(26)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(26);
						$arrFileRow['validationNacionalidad'] = 0;


						$arrFileRow['fechaNacimiento'] = '';
						$objRowRowClass->getItemRoByNumber(27)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(27)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(27)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(27)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(27);
						$arrFileRow['validationFechaNacimiento'] = 0;

						$arrFileRow['codigoEstadoCivil'] = '';
						$objRowRowClass->getItemRoByNumber(28)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(28)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(28)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(28)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(28);
						$arrFileRow['validationCodigoZonaRegistral'] = 0;

						$arrFileRow['codigoProfesion'] = '';
						$objRowRowClass->getItemRoByNumber(29)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(29)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(29)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(29)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(29);
						$arrFileRow['validationProfesion'] = 0;

						$arrFileRow['objectoSocial'] = '';
						$objRowRowClass->getItemRoByNumber(30)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(30)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(30)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(30)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(30);
						$arrFileRow['validationObjectoSocial'] = 0;

						$arrFileRow['codigoCiiu'] = '';
						$objRowRowClass->getItemRoByNumber(31)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(31)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(31)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(31)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(31);
						$arrFileRow['validationCiiu'] = 0;

						$arrFileRow['codigoCargo'] = '';
						$objRowRowClass->getItemRoByNumber(32)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(32)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(32)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(32)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(32);
						$arrFileRow['validationCargo'] = 0;

						$arrFileRow['codigoZonaRegistral'] = '';
						$objRowRowClass->getItemRoByNumber(33)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(33)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(33)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(33)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(33);
						$arrFileRow['validationCodigoZonaRegistral'] = 0;

						$arrFileRow['numeroPartidaRegistral'] = '';
						$objRowRowClass->getItemRoByNumber(34)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(34)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(34)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(34)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(34);
						$arrFileRow['validationNumeroPartidaRegistral'] = 0;

						$arrFileRow['direccion'] = '';
						$objRowRowClass->getItemRoByNumber(35)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(35)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(35)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(35)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(35);
						$arrFileRow['validationDireccion'] = 0;

						$arrFileRow['departamento'] = '';
						$objRowRowClass->getItemRoByNumber(36)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(36)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(36)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(36)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(36);
						$arrFileRow['validationDepartamento'] = 0;

						$arrFileRow['provincia'] = '';
						$objRowRowClass->getItemRoByNumber(37)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(37)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(37)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(37)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(37);
						$arrFileRow['validationProvincia'] = 0;

						$arrFileRow['distrito'] = '';
						$objRowRowClass->getItemRoByNumber(38)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(38)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(38)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(38)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(38);
						$arrFileRow['validationDistrito'] = 0;

						$arrFileRow['telefono'] = '';
						$objRowRowClass->getItemRoByNumber(39)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(39)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(39)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(39)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(39);
						$arrFileRow['validationTelefono'] = 0;

						$arrFileRow['participacionConyuge'] = '';
						$objRowRowClass->getItemRoByNumber(40)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(40)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(40)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(40)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(40);
						$arrFileRow['validationParticipacionConyuge'] = 0;

						$arrFileRow['apellidoPaternoConyuge'] = '';
						$objRowRowClass->getItemRoByNumber(41)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(41)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(41)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(41)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(41);
						$arrFileRow['validationPaternoConyuge'] = 0;

						$arrFileRow['apellidoMaternoConyuge'] = '';
						$objRowRowClass->getItemRoByNumber(42)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(42)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(42)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(42)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(42);
						$arrFileRow['validationMaternoConyuge'] = 0;

						$arrFileRow['nombresConyuge'] = '';
						$objRowRowClass->getItemRoByNumber(43)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(43)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(43)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(43)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(43);
						$arrFileRow['validationnombreConyuge'] = 0;


						$arrFileRow['codigoTipoFondo']  = $codigoTipoFondo;
						$objRowRowClass->getItemRoByNumber(44)->setElementValue($codigoTipoFondo);
						$objRowRowClass->getItemRoByNumber(44)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(44)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(44)->setItemNumberError($validationTipoFondo);
						$objRowRowClass->getItemRoByNumber(44)->setDetailsError($detailValueTipoFondo);
						$objRowRowClass->getItemRoByNumber(44)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(44)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(44);
						$arrFileRow['validationTipoFondo']  = $validationTipoFondo;

						$arrFileRow['tipoOperacion'] = $tipoOperacion;
						$objRowRowClass->getItemRoByNumber(45)->setElementValue($tipoOperacion);
						$objRowRowClass->getItemRoByNumber(45)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(45)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(45)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(45);

						$arrFileRow['codigoFormaPago'] = $codigoFormaPago;
						$objRowRowClass->getItemRoByNumber(46)->setElementValue($codigoFormaPago);
						$objRowRowClass->getItemRoByNumber(46)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(46)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(46)->setItemNumberError($validationFormaPago);
						$objRowRowClass->getItemRoByNumber(46)->setDetailsError($detailValueFormaPago);
						$objRowRowClass->getItemRoByNumber(46)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(46)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(46);
						$arrFileRow['validationFormaPago'] = $validationFormaPago;

						$arrFileRow['oportunidadPago'] = $oportunidadPago;
						$objRowRowClass->getItemRoByNumber(47)->setElementValue($oportunidadPago);
						$objRowRowClass->getItemRoByNumber(47)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(47)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(47)->setItemNumberError($validationOportunidadPago);
						$objRowRowClass->getItemRoByNumber(47)->setDetailsError($detailValueOportunidadPago);
						$objRowRowClass->getItemRoByNumber(47)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(47)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(47);
						$arrFileRow['validationOportunidadPago'] = $validationOportunidadPago;

						$arrFileRow['descripcionOportunidadPago'] =  strtoupper($this->remplace_string_ro($descripcionOportunidadPago));
						$objRowRowClass->getItemRoByNumber(48)->setElementValue(strtoupper($this->remplace_string_ro($descripcionOportunidadPago)));
						$objRowRowClass->getItemRoByNumber(48)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(48)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(48)->setItemNumberError($validationDescripcionOportunidadPago);
						$objRowRowClass->getItemRoByNumber(48)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(48)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(48);
						$arrFileRow['validationDescripcionOportunidadPago'] = $validationDescripcionOportunidadPago;

						$arrFileRow['origenFondo']  = '';
						$objRowRowClass->getItemRoByNumber(49)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(49)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(49)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(49)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(49);


						$arrFileRow['monedaOperacion'] = $monedaOperacion;
						$objRowRowClass->getItemRoByNumber(50)->setElementValue($monedaOperacion);
						$objRowRowClass->getItemRoByNumber(50)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(50)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(50)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(50)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(50);

						$arrFileRow['montoOperacion'] = $montoOperacion;
						$objRowRowClass->getItemRoByNumber(51)->setElementValue($montoOperacion);
						$objRowRowClass->getItemRoByNumber(51)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(51)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(51)->setItemNumberError($validationMontoOperacion);
						$objRowRowClass->getItemRoByNumber(51)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(51)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(51)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(51);
						$arrFileRow['validationMontoOperacion'] = $validationMontoOperacion;

						$arrFileRow['montoPorParticipante'] = '0.00';
						$objRowRowClass->getItemRoByNumber(52)->setElementValue('0.00');
						$objRowRowClass->getItemRoByNumber(52)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(52)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(52)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(52);
						$arrFileRow['validationMontoPorParticipante'] = 0;

						$arrFileRow['montoTipoFondo'] = $montoTipoFondo;
						$objRowRowClass->getItemRoByNumber(53)->setElementValue($montoTipoFondo);
						$objRowRowClass->getItemRoByNumber(53)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(53)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(53)->setItemNumberError($validationMontoTipoFondo);
						$objRowRowClass->getItemRoByNumber(53)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(53)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(53)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(53);
						$arrFileRow['validationMontoTipoFondo'] = $validationMontoTipoFondo;

						$arrFileRow['tipoCambio'] = $tipoCambio;
						$objRowRowClass->getItemRoByNumber(54)->setElementValue($tipoCambio);
						$objRowRowClass->getItemRoByNumber(54)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(54)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(54)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(54);

						$arrFileRow['inscripcionRegistralBien'] = $inscripcionRegistralBien;
						$objRowRowClass->getItemRoByNumber(55)->setElementValue($inscripcionRegistralBien);
						$objRowRowClass->getItemRoByNumber(55)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(55)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(55)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(55)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(55);

						$arrFileRow['zonaRegistralBien'] = $zonaRegistralBien;
						$objRowRowClass->getItemRoByNumber(56)->setElementValue($zonaRegistralBien);
						$objRowRowClass->getItemRoByNumber(56)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(56)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(56)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(56)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(56);

						$arrFileRow['numeroPartidaRegistralBien'] = $numeroPartidaRegistralBien;
						$objRowRowClass->getItemRoByNumber(57)->setElementValue($numeroPartidaRegistralBien);
						$objRowRowClass->getItemRoByNumber(57)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(57)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(57)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(57)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(57);

						$arrFileRow['tipoFila'] = 1;

						$arrRo[] = $arrFileRow;

						$this->_arrObjRo[] = $objRowRowClass;

					}
				}else{
					//aqui
					$objRowRowClass = new RowRoClass($arrRoDataField);
					$objRowRowClass->getItemRoByNumber(1)->setIdKardex($idKardex);
					$objRowRowClass->getItemRoByNumber(1)->setKardex($kardex);
					$objRowRowClass->getItemRoByNumber(1)->setCodeElement(590);
					$objRowRowClass->getItemRoByNumber(1)->setDescriptionElement('El  kardex ,no tiene fila de T. de Pago/T. de Fondo');
					$objRowRowClass->getItemRoByNumber(1)->setRowType(2);
					$objRowRowClass->getItemRoByNumber(1)->setAct($act);
					$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(1);
				}


				$sql = "SELECT cliente2.idcontratante,IF(cliente2.tipper = 'N', CONCAT(cliente2.apepat,' ',cliente2.apemat,' ',cliente2.prinom,' ',cliente2.segnom),
					 cliente2.razonsocial)  AS contratante,
					cliente2.direccion,cliente2.idtipdoc ,cliente2.numdoc,tipodocumento.destipdoc AS tipo_documento,cliente2.email,
					cliente2.telfijo AS telefono2,cliente2.telcel AS celular,cliente2.telofi,cliente2.sexo,
					cliente2.natper AS persona_natural,cliente2.tipper,
					 contratantes.firma,
					IF (REPLACE(STR_TO_DATE(contratantes.fechafirma,'%d/%m/%Y'),'-','') = '00000000','',
					REPLACE(STR_TO_DATE(contratantes.fechafirma,'%d/%m/%Y'),'-','')) AS fechaFirmaParticipante,
					(CASE WHEN  contratantesxacto.uif = '' THEN 13 ELSE 0 END ) AS validationRepresentante,
					(CASE WHEN contratantesxacto.uif = 'R' THEN contratantesxacto.uif ELSE '' END)AS representante,
					( CASE WHEN contratantesxacto.uif = '' THEN 14 ELSE 0 END ) AS  validationPersonaOperacion,
					(CASE WHEN (contratantesxacto.uif REGEXP '^[OGFN]') != 0  THEN contratantesxacto.uif ELSE '' END)AS personaOperacion,
					( CASE WHEN contratantesxacto.uif = '' THEN 15 ELSE 0 END ) AS  validationPersonaAFavor,
					(CASE WHEN contratantesxacto.uif = 'B'  THEN contratantesxacto.uif ELSE ''  END)AS personaAFavor,
					contratantes.idcontratanterp AS idContratanteR,
					 (
					 CASE WHEN  contratantes.idcontratanterp = '' AND contratantesxacto.uif = 'R'
					 THEN  16 ELSE 0  END
					 ) AS validationPersonaQueRepresenta,
					(CASE WHEN  contratantesxacto.uif = 'R' AND inscrito = '' THEN 17 ELSE 0 END ) AS validationTipoRepresentacion,
					(CASE WHEN  contratantesxacto.uif = 'R' AND contratantes.inscrito = 0 THEN 2 
					WHEN  contratantesxacto.uif = 'R' AND contratantes.inscrito = 1 THEN 1  ELSE '' END ) AS tipoRepresentacion,
					(CASE WHEN cliente2.residente = 'NULL'  THEN 18  ELSE  0 END ) AS validationCondicionResidencia,
					(CASE WHEN cliente2.residente = '' OR cliente2.residente = 1 THEN 1 ELSE  2  END) AS condicionResidencia,
					(CASE WHEN cliente2.tipper = '' THEN 19 ELSE 0 END)AS validationTipoPersona,
					(CASE WHEN  cliente2.tipper = 'N' THEN 1 ELSE 3 END)AS tipoPersona,
					(CASE WHEN cliente2.tipper = 'N' AND tipodocumento.idtipdoc IS NULL THEN  20 ELSE 0 END) AS validationTipoDocumento,
					(CASE WHEN cliente2.tipper = 'N'   THEN  CAST(tipodocumento.codtipdoc AS UNSIGNED)   ELSE '' END) AS codigoTipoDocumento,
					(CASE WHEN cliente2.tipper = 'N' AND cliente2.numdoc IS NULL  THEN 21 ELSE 0 END) AS validationNumeroDocumento,
					(CASE WHEN cliente2.tipper = 'N' THEN cliente2.numdoc ELSE ''  END) AS numeroDocumento,
					(CASE WHEN cliente2.tipper = 'J' AND tipodocumento.idtipdoc = 8 AND cliente2.numdoc = '' THEN  22 
					  ELSE 0 END) AS validationNumeroRuc,
					(CASE WHEN cliente2.tipper = 'J' AND tipodocumento.idtipdoc = 8  THEN  cliente2.numdoc 
					WHEN cliente2.tipper = 'J' AND  tipodocumento.idtipdoc = 10 THEN '99999999999'  ELSE '' END) AS numeroRuc,
					(CASE WHEN cliente2.tipper = 'N' AND cliente2.apepat = '' THEN 1
						WHEN cliente2.tipper = 'J' AND cliente2.razonsocial = '' THEN 23 ELSE 0  END) AS validationApellidoPaternoRazonSocial ,
					(CASE WHEN cliente2.tipper = 'N'  THEN cliente2.apepat
						WHEN cliente2.tipper = 'J'  THEN cliente2.razonsocial ELSE 0  END) AS apellidoPaternoRazonSocial,		
					(CASE WHEN cliente2.tipper = 'N'  THEN 24  ELSE 0 END) AS vaidationApellidoMaterno,
					
					(CASE  WHEN cliente2.tipper = 'J' THEN '' ELSE  cliente2.apemat END )AS apellidoMaterno,
					
					(CASE WHEN cliente2.tipper = 'N' AND (cliente2.prinom = ''  OR  cliente2.segnom = '') IS NULL  THEN 25 ELSE 0  END ) AS validationNombres,
					
					(CASE WHEN cliente2.tipper = 'J' THEN  '' ELSE  CONCAT(cliente2.prinom,' ',cliente2.segnom ) END )AS nombres,
					
					(CASE WHEN cliente2.tipper = 'N' AND nacionalidades.codnacion IS NULL  THEN 26 ELSE 0  END ) AS validationNacionalidad,
					(CASE WHEN cliente2.tipper = 'N'  THEN nacionalidades.codnacion ELSE ''  END ) AS codigoNacion, 
					nacionalidades.descripcion AS nacionalidad,
					(CASE WHEN cliente2.tipper = 'N' AND cliente2.cumpclie = ''  THEN 0 ELSE 0  END ) AS validationFechaNacimiento,
					(CASE WHEN cliente2.tipper = 'N' AND REPLACE(STR_TO_DATE(cliente2.cumpclie,'%d/%m/%Y'),'-','') != '00000000'  THEN REPLACE(STR_TO_DATE(cliente2.cumpclie,'%d/%m/%Y'),'-','')   ELSE ''  END ) AS fechaNacimiento, 
					(CASE WHEN  cliente2.tipper = 'N' AND  tipoestacivil.codestcivil IS NULL THEN 28 ELSE 0 END )AS validationEstadoCivil,
					(CASE WHEN  cliente2.tipper = 'N'  THEN tipoestacivil.idestcivil ELSE '' END )AS codigoEstadoCivil,
					tipoestacivil.desestcivil AS estadoCivil,
					(CASE  WHEN  cliente2.tipper = 'N'  AND profesiones.idprofesion IS NULL   THEN 29  ELSE 0 END) AS validationProfesion,
					profesiones.idprofesion, (CASE WHEN profesiones.codprof IS NULL OR cliente2.tipper = 'J' THEN ''  ELSE profesiones.codprof END) AS  codigoProfesion,profesiones.desprofesion AS profesion,
					(CASE WHEN  cliente2.tipper = 'J' AND cliente2.contacempresa = '' THEN 30 ELSE 0 END ) AS validationObjectoSocial,
					cliente2.contacempresa AS objectoSocial,
					(CASE WHEN  cliente2.tipper = 'J' AND  ciiu.coddivi IS NULL THEN 31 ELSE 0 END )AS validationCiiu,
					(CASE WHEN ciiu.coddivi IS NULL OR cliente2.tipper = 'N' THEN ''  ELSE ciiu.coddivi END) codigoCiiu,ciiu.nombre AS ciiu,
					(CASE  WHEN  cliente2.tipper = 'N' AND cargoprofe.idcargoprofe IS NULL THEN 32 ELSE 0 END  ) AS validationCargo,
					cargoprofe.idcargoprofe,
					(CASE WHEN cargoprofe.codcargoprofe IS NULL OR  cliente2.tipper = 'J'  THEN ''  ELSE cargoprofe.codcargoprofe END ) AS codigoCargo,cargoprofe.descripcrapro AS cargo,

					(CASE WHEN  contratantesxacto.uif = 'R'  /*AND  cliente2.tipper = 'J'*/ AND  contratantes.inscrito = 1 AND contratantes.idsedereg = 0  
					THEN 33 ELSE 0 END) AS validationCodigoZonaRegistral,
					(CASE WHEN  contratantesxacto.uif = 'R'   THEN LPAD(contratantes.idsedereg,2,0) 
					ELSE  '' END) AS codigoZonaRegistral ,
					(CASE WHEN contratantesxacto.uif = 'R'  /*AND cliente2.tipper = 'J' */AND  contratantes.inscrito = 1 AND  contratantes.numpartida  = ''  THEN 34 ELSE 0 END) AS validationNumeroPartidaRegistral,
					(CASE WHEN  contratantesxacto.uif = 'R' /* AND cliente2.tipper = 'J'*/ THEN contratantes.numpartida    
					ELSE  '' END) AS numeroPartidaRegistral ,
					
					(CASE WHEN    (cliente2.domfiscal = '' AND cliente2.tipper = 'J' ) OR  (cliente2.direccion = '' AND cliente2.tipper = 'N' )  THEN  35  ELSE 0   END) validationDireccion,
					(CASE WHEN cliente2.tipper = 'N'  THEN  cliente2.direccion 
					    ELSE cliente2.domfiscal END ) AS direccion,
					(CASE WHEN ubigeo.codpto IS NULL   THEN 36 ELSE 0 END) AS validationDepartamento,
					ubigeo.codpto AS departamento,
					(CASE WHEN ubigeo.codprov IS NULL   THEN 37 ELSE 0 END) AS validationProvincia,
					ubigeo.codprov AS provincia,
					(CASE WHEN ubigeo.coddist IS NULL   THEN 38 ELSE 0 END) AS validationDistrito,
					cliente2.idubigeo,
					ubigeo.coddist AS distrito,cliente2.conyuge,
					(CASE  WHEN   cliente2.tipper = 'N' AND cliente2.conyuge != '' THEN 'N' 
						WHEN  cliente2.tipper = 'J' AND cliente2.conyuge = '' THEN '' 
					ELSE  'N' END )AS participacionConyuge,
					contratantesxacto.ofondo AS origenFondo,
					contratantesxacto.monto AS montoPorParticipante,
					(CASE   WHEN ( IF(contratantesxacto.monto = '','V',contratantesxacto.monto) REGEXP   (SELECT ro_validation_by_act.dataValue FROM ro_validation_by_act
						 WHERE ro_validation_by_act.codeAct = tiposdeacto.actouif AND ro_validation_by_act.fkDataField = 52 LIMIT 1)) != 0 OR contratantesxacto.uif  = 'R'
						 THEN 0 ELSE 52 END)AS validationMontoPorParticipante,
					contratantesxacto.uif,contratantesxacto.parte,contratantesxacto.porcentaje,
					contratantesxacto.formulario,contratantesxacto.monto,
					contratantesxacto.ofondo,contratantesxacto.montop,contratantes.idcontratanterp		   
					FROM contratantesxacto
				   INNER JOIN cliente2 ON contratantesxacto.idcontratante= cliente2.idcontratante
				   LEFT JOIN contratantes ON cliente2.idcontratante =  contratantes.idcontratante 
				   INNER  JOIN  tiposdeacto ON contratantesxacto.idtipoacto = tiposdeacto.idtipoacto
				   LEFT JOIN profesiones ON cliente2.idprofesion =  profesiones.idprofesion
				   LEFT JOIN cargoprofe ON cliente2.idcargoprofe  = cargoprofe.idcargoprofe
				   LEFT JOIN  ubigeo ON   cliente2.idubigeo = ubigeo.coddis
				   LEFT JOIN ciiu ON cliente2.actmunicipal = ciiu.coddivi
				   LEFT JOIN tipoestacivil ON cliente2.idestcivil =  tipoestacivil.idestcivil 
				   LEFT JOIN  nacionalidades ON cliente2.nacionalidad = nacionalidades.idnacionalidad
				   LEFT JOIN tipodocumento ON cliente2.idtipdoc = tipodocumento.idtipdoc 
				   LEFT JOIN  sedesregistrales ON cliente2.idsedereg  = sedesregistrales.idsedereg
				   WHERE contratantesxacto.kardex='$kardex' AND contratantesxacto.idtipoacto='$tipoActoMedioPago'
				   AND contratantesxacto.uif <> '' AND (contratantesxacto.uif='O' 
				   OR contratantesxacto.uif='B' OR contratantesxacto.uif='R') 
				   ORDER BY 
				   contratantesxacto.uif DESC";

				  // die($sql);

					  
				$resultContratante = mysql_query($sql);	
				$arrFileRow = array();	 
				$sumMontoPorParticipanteO = 0;
				$sumMontoPorParticipanteB = 0;
				$arrO = array();
				$arrB = array();
				$arrActO = array('034','028');
				$arrActB = array('026','027');
				$arrDocumentsPE = array('1','8','10','11');
				$arrActConst = array('037','038','039','040','042');
		
				if(mysql_affected_rows() != 0){
					while($rowContratante = mysql_fetch_assoc($resultContratante)){
						$codeRow = $codeRow + 1;

						$codeUif = $rowContratante['uif'];
						$idContratanteCorrection = $rowContratante['idcontratante'];
						$idUbigeo = $rowContratante['idubigeo'];

						if($codeUif == 'O'){
							$sumMontoPorParticipanteO =  $sumMontoPorParticipanteO + $rowContratante['montoPorParticipante'];
						}
						if($codeUif == 'B'){
							$sumMontoPorParticipanteB =  $sumMontoPorParticipanteB + $rowContratante['montoPorParticipante'];
						}

						$objRowRowClass = new RowRoClass($arrRoDataField);

						$arrFileRow['kardex'] = $kardex;
						$arrFileRow['codigoFila'] = $codeRow;
						$objRowRowClass->getItemRoByNumber(1)->setElementValue($codeRow);
						$objRowRowClass->getItemRoByNumber(1)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(1)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(1)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(1);
					

						$arrFileRow['numeroRegistroOperacion'] = $registrationNumberOperation;
						$objRowRowClass->getItemRoByNumber(2)->setElementValue($registrationNumberOperation);
						$objRowRowClass->getItemRoByNumber(2)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(2)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(2)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(2);
						
						$arrFileRow['tipoEnvio'] = $tipoEnvio;
						$objRowRowClass->getItemRoByNumber(3)->setElementValue($tipoEnvio);
						$objRowRowClass->getItemRoByNumber(3)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(3)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(3)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(3);

						$arrFileRow['IPNP'] = $IPNP;
						$objRowRowClass->getItemRoByNumber(4)->setElementValue($IPNP);
						$objRowRowClass->getItemRoByNumber(4)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(4)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(4)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(4);

						$arrFileRow['numeroIPNP'] = $numeroEscritura;
						$objRowRowClass->getItemRoByNumber(5)->setElementValue($numeroEscritura);
						$objRowRowClass->getItemRoByNumber(5)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(5)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(5)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(5);

						$arrFileRow['fechaIPNP'] = $fechaEscritura;
						$objRowRowClass->getItemRoByNumber(6)->setElementValue($fechaEscritura);
						$objRowRowClass->getItemRoByNumber(6)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(6)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(6)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(6);

						$arrFileRow['numeroIPNPAclara'] = '';
						$objRowRowClass->getItemRoByNumber(7)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(7)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(7)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(7)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(7);

						$arrFileRow['fechaIPNPAclara'] = '';
						$objRowRowClass->getItemRoByNumber(8)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(8)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(8)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(8)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(8);

						$arrFileRow['conclusion'] = $conclusion;
						$tipoPersona = $rowContratante['tipper'];
						$firma =  $rowContratante['firma'];
						$fechaFirma = $rowContratante['fechaFirmaParticipante'];
						$c = $conclusion;;
						if($tipoPersona == 'N' && ($firma == 0 || $fechaFirma == '')){
								$c = 'N';
						}	
						$objRowRowClass->getItemRoByNumber(9)->setElementValue($c);
						$objRowRowClass->getItemRoByNumber(9)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(9)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(9)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(9);

						$arrFileRow['fechaFirmaParticipante'] = $rowContratante['fechaFirmaParticipante'];
						$objRowRowClass->getItemRoByNumber(10)->setElementValue($rowContratante['fechaFirmaParticipante']);
						$objRowRowClass->getItemRoByNumber(10)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(10)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(10)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(10)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(10)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(10)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(10);


						$arrFileRow['modalidadOperacion'] = 'U';
						$objRowRowClass->getItemRoByNumber(11)->setElementValue('U');
						$objRowRowClass->getItemRoByNumber(11)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(11)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(11)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(11);

						$arrFileRow['cantidadOperacionMultiple'] = '';
						$objRowRowClass->getItemRoByNumber(12)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(12)->setKardex($kardex);
						if($objRowRowClass->getItemRoByNumber(12)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(12);


						$arrFileRow['representante'] =  $rowContratante['representante'];
						$objRowRowClass->getItemRoByNumber(13)->setElementValue($rowContratante['representante']);
						$objRowRowClass->getItemRoByNumber(13)->setItemNumberError($rowContratante['validationRepresentante']);
						$objRowRowClass->getItemRoByNumber(13)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(13)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(13)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(13)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(13)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(13);
						$arrFileRow['validationRepresentante'] = $rowContratante['validationRepresentante'];

						$arrFileRow['personaOperacion'] = $rowContratante['personaOperacion'];


						
						$arrO[] = $rowContratante['personaOperacion'];
						//$isO = $rowContratante['personaOperacion'] == 'O' && $rowContratante['personaOperacion'] != ''? true:false;
						$objRowRowClass->getItemRoByNumber(14)->setElementValue($rowContratante['personaOperacion']);
						$objRowRowClass->getItemRoByNumber(14)->setItemNumberError($rowContratante['validationPersonaOperacion']);
						$objRowRowClass->getItemRoByNumber(14)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(14)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(14)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(14)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(14)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(14);
						$arrFileRow['validationPersonaOperacion'] = $rowContratante['validationPersonaOperacion'];

						$arrB[] = $rowContratante['personaAFavor'];
						$objRowRowClass->getItemRoByNumber(15)->setElementValue($rowContratante['personaAFavor']);
						$objRowRowClass->getItemRoByNumber(15)->setItemNumberError($rowContratante['validationPersonaAFavor']);
						$objRowRowClass->getItemRoByNumber(15)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(15)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(15)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(15)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(15)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(15);
						$arrFileRow['validationPersonaAFavor'] = $rowContratante['validationPersonaAFavor'];


						$objRowRowClass->getItemRoByNumber(16)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(16)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(16)->setRowType(2);
						$idContratanteR =  $rowContratante['idContratanteR'];
						if($rowContratante['uif'] == 'R' ){
							$sql = "SELECT uif FROM  contratantesxacto  WHERE contratantesxacto.idcontratante = '$idContratanteR' AND   (uif = 'B' OR uif = 'O' OR uif = 'G' OR uif = 'F' OR uif = 'N' OR uif = 'R') ";
							$resultRepresentate = mysql_query($sql);
							if(mysql_affected_rows() != 0){
								$rowRepresentante = mysql_fetch_assoc($resultRepresentate);
								$arrFileRow['personaQueRepresenta'] = $rowRepresentante['uif'] === 'R'?'N':$rowRepresentante['uif'];
								$arrFileRow['validationPersonaQueRepresenta'] = 0;
								$personaQueRepresenta = $rowRepresentante['uif'] === 'R'?'N':$rowRepresentante['uif'];
								$validationPersonaQueRepresenta = 0;
							}else{
								$arrFileRow['personaQueRepresenta'] = '';
								$arrFileRow['validationPersonaQueRepresenta'] = 16;
								$personaQueRepresenta = '';
								$validationPersonaQueRepresenta = 16;
								
							}
						}else{
							$arrFileRow['personaQueRepresenta'] = '';
							$arrFileRow['validationPersonaQueRepresenta'] = 0;
							$personaQueRepresenta = '';
							$validationPersonaQueRepresenta = 0;
							
						}
						$objRowRowClass->getItemRoByNumber(16)->setElementValue($personaQueRepresenta);
						$objRowRowClass->getItemRoByNumber(16)->setItemNumberError($validationPersonaQueRepresenta);
						$objRowRowClass->getItemRoByNumber(16)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(16)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(16)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(16);


						$arrFileRow['tipoRepresentacion'] = $rowContratante['tipoRepresentacion'];
						$objRowRowClass->getItemRoByNumber(17)->setElementValue($rowContratante['tipoRepresentacion']);
						$objRowRowClass->getItemRoByNumber(17)->setItemNumberError($rowContratante['validationTipoRepresentacion']);
						$objRowRowClass->getItemRoByNumber(17)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(17)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(17)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(17)->setRowType(2); 
						$objRowRowClass->getItemRoByNumber(17)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(17)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(17);
						$arrFileRow['validationTipoRepresentacion'] = $rowContratante['validationTipoRepresentacion'];


						$arrFileRow['condicionResidencia'] = $rowContratante['condicionResidencia'];
						$objRowRowClass->getItemRoByNumber(18)->setElementValue($rowContratante['condicionResidencia']);
						$objRowRowClass->getItemRoByNumber(18)->setItemNumberError($rowContratante['validationCondicionResidencia']);
						$objRowRowClass->getItemRoByNumber(18)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(18)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(18)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(18)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(18)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(18)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(18);
						$arrFileRow['validationCondicionResidencia'] = $rowContratante['validationCondicionResidencia'];

						$arrFileRow['tipoPersona'] = $rowContratante['tipoPersona'];
						$objRowRowClass->getItemRoByNumber(19)->setElementValue($rowContratante['tipoPersona']);
						$objRowRowClass->getItemRoByNumber(19)->setItemNumberError($rowContratante['validationTipoPersona']);
						$objRowRowClass->getItemRoByNumber(19)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(19)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(19)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(19)->setAct($act);
						

						if($objRowRowClass->getItemRoByNumber(19)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(19);
						$arrFileRow['validationTipoPersona'] = $rowContratante['validationTipoPersona'];

						$validationTipoDocumento = $rowContratante['validationTipoDocumento'];
						$arrFileRow['codigoTipoDocumento'] = $rowContratante['codigoTipoDocumento'];
						$objRowRowClass->getItemRoByNumber(20)->setElementValue($rowContratante['codigoTipoDocumento']);
						$objRowRowClass->getItemRoByNumber(20)->setItemNumberError($rowContratante['validationTipoDocumento']);
						$objRowRowClass->getItemRoByNumber(20)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(20)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(20)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(20)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(20)->setAct($act);
						$arrFileRow['validationTipoDocumento'] = $rowContratante['validationTipoDocumento'];
						if($objRowRowClass->getItemRoByNumber(20)->getItemNumberError() != 0){
							$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(20);
						}else{#validaciones extras para el tipo del documento segun la nacionalidad
							$codNacionalidad = $rowContratante['codigoNacion'];
	 						$codigoTipoDocumento = $rowContratante['codigoTipoDocumento'];
							if( ($codNacionalidad == 'PE' && !in_array($codigoTipoDocumento, $arrDocumentsPE)) || ($codNacionalidad != 'PE' && in_array($codigoTipoDocumento, $arrDocumentsPE)) ){
								$objRowRowClass->getItemRoByNumber(20)->setDescriptionElement(',la nacionalidad no corresponde al tipo del documento');
								$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(20);
							}
						}
						

						$arrFileRow['numeroDocumento'] = $rowContratante['numeroDocumento'];
						$objRowRowClass->getItemRoByNumber(21)->setElementValue($rowContratante['numeroDocumento']);
						$objRowRowClass->getItemRoByNumber(21)->setItemNumberError($rowContratante['validationNumeroDocumento']);
						$objRowRowClass->getItemRoByNumber(21)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(21)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(21)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(21)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(21)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(21)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(21);
						$arrFileRow['validationNumeroDocumento'] = $rowContratante['validationNumeroDocumento'];
						#validacion extras para el numero de documento segun el tipo de documento
						$numDocumento = $rowContratante['numdoc'];
					//	die($codTipoDocumento.'-'.$numDocumento);
						$idTipDoc = $rowContratante['idtipdoc'];
			
						if($idTipDoc == 1 && (strlen($numDocumento) != 8  || !ctype_digit($numDocumento))){
							$objRowRowClass->getItemRoByNumber(21)->setDescriptionElement(',su DNI es incorrecto');
							$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(21);
						}
						
						if(($tipoPersona == 'J' && $idTipDoc != 10) && (strlen($numDocumento) != 11 || !ctype_digit($numDocumento))){

							if(in_array($actUIF,$arrActConst)){
								$objRowRowClass->getItemRoByNumber(21)->setCategoryCorrect(1);
								$objRowRowClass->getItemRoByNumber(21)->setTypeOfCorrection(1);
								$objRowRowClass->getItemRoByNumber(21)->setIsCorrectable(1);
								$objRowRowClass->getItemRoByNumber(21)->setIdContractor($idContratanteCorrection);
							}

							$objRowRowClass->getItemRoByNumber(21)->setDescriptionElement(',su RUC es incorrecto');
							$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(21);
						}


						$arrFileRow['numeroRuc'] = $rowContratante['numeroRuc'];
						$objRowRowClass->getItemRoByNumber(22)->setElementValue($rowContratante['numeroRuc']);
						$objRowRowClass->getItemRoByNumber(22)->setItemNumberError($rowContratante['validationNumeroRuc']);
						$objRowRowClass->getItemRoByNumber(22)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(22)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(22)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(22)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(22)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(22)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(22);
						$arrFileRow['validationNumeroRuc'] = $rowContratante['validationNumeroRuc'];

						$arrFileRow['apellidoPaternoRazonSocial'] = $this->remplace_string_ro($rowContratante['apellidoPaternoRazonSocial'],$rowContratante['tipoPersona']);
						$objRowRowClass->getItemRoByNumber(23)->setElementValue($this->remplace_string_ro($rowContratante['apellidoPaternoRazonSocial'],$rowContratante['tipoPersona']));
						$objRowRowClass->getItemRoByNumber(23)->setItemNumberError($rowContratante['validationApellidoPaternoRazonSocial']);
						$objRowRowClass->getItemRoByNumber(23)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(23)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(23)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(23)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(23)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(23)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(23);
						$arrFileRow['validationApellidoPaternoRazonSocial'] = $rowContratante['validationApellidoPaternoRazonSocial'];

					    
					    $arrFileRow['apellidoMaterno']  =  strtoupper($this->remplace_string_ro($rowContratante['apellidoMaterno']));
					    $objRowRowClass->getItemRoByNumber(24)->setElementValue($this->remplace_string_ro($rowContratante['apellidoMaterno']));
						$objRowRowClass->getItemRoByNumber(24)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(24)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(24)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(24)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(24)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(24)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(24)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(24);
					    $arrFileRow['validationApellidoMaterno'] = 0;

						$arrFileRow['nombres'] =  strtoupper($this->remplace_string_ro($rowContratante['nombres']));
						$objRowRowClass->getItemRoByNumber(25)->setElementValue($this->remplace_string_ro($rowContratante['nombres']));
						$objRowRowClass->getItemRoByNumber(25)->setItemNumberError($rowContratante['validationNombres']);
						$objRowRowClass->getItemRoByNumber(25)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(25)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(25)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(25)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(25)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(25)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(25);
						$arrFileRow['validationNombres'] = $rowContratante['validationNombres'];


						$arrFileRow['codigoNacion'] = $rowContratante['codigoNacion'];
						$objRowRowClass->getItemRoByNumber(26)->setElementValue($rowContratante['codigoNacion']);
						$objRowRowClass->getItemRoByNumber(26)->setItemNumberError($rowContratante['validationNacionalidad']);
						$objRowRowClass->getItemRoByNumber(26)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(26)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(26)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(26)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(26)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(26)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(26);
						$arrFileRow['validationNacionalidad'] = $rowContratante['validationNacionalidad'];

						$arrFileRow['fechaNacimiento'] = $rowContratante['fechaNacimiento'];
						$objRowRowClass->getItemRoByNumber(27)->setElementValue($rowContratante['fechaNacimiento']);
						$objRowRowClass->getItemRoByNumber(27)->setItemNumberError($rowContratante['validationFechaNacimiento']);
						$objRowRowClass->getItemRoByNumber(27)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(27)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(27)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(27)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(27)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(27)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(27);
						$arrFileRow['validationFechaNacimiento'] = $rowContratante['validationFechaNacimiento'];


						$arrFileRow['codigoEstadoCivil'] = $rowContratante['codigoEstadoCivil'];
						$objRowRowClass->getItemRoByNumber(28)->setElementValue($rowContratante['codigoEstadoCivil']);
						$objRowRowClass->getItemRoByNumber(28)->setItemNumberError($rowContratante['validationEstadoCivil']);
						$objRowRowClass->getItemRoByNumber(28)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(28)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(28)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(28)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(28)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(28)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(28);
						$arrFileRow['validationEstadoCivil'] = $rowContratante['validationEstadoCivil'];

						$arrFileRow['codigoProfesion'] = $rowContratante['codigoProfesion'];
						$objRowRowClass->getItemRoByNumber(29)->setElementValue($rowContratante['codigoProfesion']);
						$objRowRowClass->getItemRoByNumber(29)->setItemNumberError($rowContratante['validationProfesion']);
						$objRowRowClass->getItemRoByNumber(29)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(29)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(29)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(29)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(29)->setAct($act);
						#Campos de Auto Correccion
						$objRowRowClass->getItemRoByNumber(29)->setCategoryCorrect(2);
						$objRowRowClass->getItemRoByNumber(29)->setTypeOfCorrection(1);
						$objRowRowClass->getItemRoByNumber(29)->setIsCorrectable(1);
						$objRowRowClass->getItemRoByNumber(29)->setIdContractor($idContratanteCorrection);
						#
						if($objRowRowClass->getItemRoByNumber(29)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(29);
						$arrFileRow['validationProfesion'] = $rowContratante['validationProfesion'];

						$arrFileRow['objectoSocial'] = strtoupper($this->remplace_string_ro($rowContratante['objectoSocial'],1));
						$objRowRowClass->getItemRoByNumber(30)->setElementValue($this->remplace_string_ro($rowContratante['objectoSocial'],1));
						$objRowRowClass->getItemRoByNumber(30)->setItemNumberError($rowContratante['validationObjectoSocial']);
						$objRowRowClass->getItemRoByNumber(30)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(30)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(30)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(30)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(30)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(30)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(30);
						$arrFileRow['validationObjectoSocial'] = $rowContratante['validationObjectoSocial'];

						$arrFileRow['codigoCiiu'] = $rowContratante['codigoCiiu'];
						$objRowRowClass->getItemRoByNumber(31)->setElementValue($rowContratante['codigoCiiu']);
						$objRowRowClass->getItemRoByNumber(31)->setItemNumberError($rowContratante['validationCiiu']);
						$objRowRowClass->getItemRoByNumber(31)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(31)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(31)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(31)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(31)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(31)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(31);
						$arrFileRow['validationCiiu'] = $rowContratante['validationCiiu'];


						$arrFileRow['codigoCargo'] = $rowContratante['codigoCargo'];
						$objRowRowClass->getItemRoByNumber(32)->setElementValue($rowContratante['codigoCargo']);
						$objRowRowClass->getItemRoByNumber(32)->setItemNumberError($rowContratante['validationCargo']);
						$objRowRowClass->getItemRoByNumber(32)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(32)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(32)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(32)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(32)->setAct($act);
						#Campos de Auto Correccion
						$objRowRowClass->getItemRoByNumber(32)->setCategoryCorrect(3);
						$objRowRowClass->getItemRoByNumber(32)->setTypeOfCorrection(1);
						$objRowRowClass->getItemRoByNumber(32)->setIsCorrectable(1);
						$objRowRowClass->getItemRoByNumber(32)->setIdContractor($idContratanteCorrection);
						#
						if($objRowRowClass->getItemRoByNumber(32)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(32);
						$arrFileRow['validationCargo'] = $rowContratante['validationCargo'];

						$arrFileRow['codigoZonaRegistral'] = $rowContratante['codigoZonaRegistral'];
						$objRowRowClass->getItemRoByNumber(33)->setElementValue($rowContratante['codigoZonaRegistral']);
						$objRowRowClass->getItemRoByNumber(33)->setItemNumberError($rowContratante['validationCodigoZonaRegistral']);
						$objRowRowClass->getItemRoByNumber(33)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(33)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(33)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(33)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(33)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(33)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(33);
						$arrFileRow['validationCodigoZonaRegistral'] = $rowContratante['validationCodigoZonaRegistral'];


						$arrFileRow['numeroPartidaRegistral'] = $rowContratante['numeroPartidaRegistral'];
						$objRowRowClass->getItemRoByNumber(34)->setElementValue($rowContratante['numeroPartidaRegistral']);
						$objRowRowClass->getItemRoByNumber(34)->setItemNumberError($rowContratante['validationNumeroPartidaRegistral']);
						$objRowRowClass->getItemRoByNumber(34)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(34)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(34)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(34)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(34)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(34)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(34);
						$arrFileRow['validationNumeroPartidaRegistral'] = $rowContratante['validationNumeroPartidaRegistral'];

						$arrFileRow['direccion'] =  strtoupper($this->remplace_string_ro($rowContratante['direccion']));
						

						$objRowRowClass->getItemRoByNumber(35)->setElementValue(strtoupper($this->remplace_string_ro($rowContratante['direccion'])));
						
						

						$objRowRowClass->getItemRoByNumber(35)->setItemNumberError($rowContratante['validationDireccion']);
						$objRowRowClass->getItemRoByNumber(35)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(35)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(35)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(35)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(35)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(35)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(35);
						$arrFileRow['validationDireccion'] = $rowContratante['validationDireccion'];


						$arrFileRow['departamento'] = $rowContratante['departamento'];
						$objRowRowClass->getItemRoByNumber(36)->setElementValue($rowContratante['departamento']);
						$objRowRowClass->getItemRoByNumber(36)->setItemNumberError($rowContratante['validationDepartamento']);
						$objRowRowClass->getItemRoByNumber(36)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(36)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(36)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(36)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(36)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(36)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(36);
						$arrFileRow['validationDepartamento'] = $rowContratante['validationDepartamento'];

						$arrFileRow['provincia'] = $rowContratante['provincia'];
						$objRowRowClass->getItemRoByNumber(37)->setElementValue($rowContratante['provincia']);
						$objRowRowClass->getItemRoByNumber(37)->setItemNumberError($rowContratante['validationProvincia']);
						$objRowRowClass->getItemRoByNumber(37)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(37)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(37)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(37)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(37)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(37)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(37);
						$arrFileRow['validationProvincia'] = $rowContratante['validationProvincia'];

						$arrFileRow['distrito'] = $rowContratante['distrito'];
						$objRowRowClass->getItemRoByNumber(38)->setElementValue($rowContratante['distrito']);
						$objRowRowClass->getItemRoByNumber(38)->setItemNumberError($rowContratante['validationDistrito']);
						$objRowRowClass->getItemRoByNumber(38)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(38)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(38)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(38)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(38)->setAct($act);
						
						if($objRowRowClass->getItemRoByNumber(38)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(38);
						if($idUbigeo == '' || empty($idUbigeo)){
							$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(38);
							$objRowRowClass->getItemRoByNumber(38)->setDescriptionElement('EL UBIGEO ES INCORRECTO, SELECIONE UN UBIGEO VALIDO');
						}	
					
						$arrFileRow['validationDistrito'] = $rowContratante['validationDistrito'];
						
						
						
						

						$arrFileRow['telefono'] = $rowContratante['telefono'];
						$objRowRowClass->getItemRoByNumber(39)->setElementValue($rowContratante['telefono']);
						$objRowRowClass->getItemRoByNumber(39)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(39)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(39)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(39)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(39)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(39)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(39)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(39);
						$arrFileRow['validationTelefono'] = 0;

						$objRowRowClass->getItemRoByNumber(40)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(41)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(42)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(42)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(43)->setKardex($kardex);

						$objRowRowClass->getItemRoByNumber(40)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(40)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(41)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(41)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(42)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(42)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(43)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(43)->setRowType(2);

						$objRowRowClass->getItemRoByNumber(40)->setElementValue($rowContratante['participacionConyuge']);


						$arrFileRow['participacionConyuge'] = $rowContratante['participacionConyuge'];
						$participacionConyuge = $rowContratante['participacionConyuge'];
						$conyuge = $rowContratante['conyuge'];

						
						$sql = "SELECT contratantesxacto.idcontratante,cliente2.apepat AS apellidoPaternoConyuge,cliente2.apemat AS apellidoMaternoConyuge,CONCAT(cliente2.prinom,' ',cliente2.segnom ) AS  nombresConyuge FROM contratantesxacto LEFT JOIN cliente2 ON  contratantesxacto.idcontratante = cliente2.idcontratante WHERE cliente2.idcliente='$conyuge' AND (contratantesxacto.uif = 'B' OR contratantesxacto.uif = 'O' OR contratantesxacto.uif = 'G' OR contratantesxacto.uif = 'F' OR contratantesxacto.uif = 'N' AND contratantesxacto.uif = 'R') AND (contratantesxacto.kardex='$kardex' AND contratantesxacto.idtipoacto='$tipoActoMedioPago')";

						//die($sql);

						$resultConyuge = mysql_query($sql);
						if(mysql_affected_rows() != 0 && $rowContratante['uif'] != 'R'){
							$rowConyuge = mysql_fetch_assoc($resultConyuge);
							$arrFileRow['apellidoPaternoConyuge'] = strtoupper($this->remplace_string_ro($rowConyuge['apellidoPaternoConyuge']));
							$arrFileRow['apellidoMaternoConyuge'] = strtoupper($this->remplace_string_ro($rowConyuge['apellidoMaternoConyuge']));	
							$arrFileRow['nombresConyuge'] = strtoupper($this->remplace_string_ro($rowConyuge['nombresConyuge']));
							$arrFileRow['validationParticipacionConyuge'] = 0;
							$arrFileRow['validationPaternoConyuge'] = 0;
							$arrFileRow['validationMaternoConyuge'] = 0;
							$arrFileRow['validationnombreConyuge'] = 0;
							$objRowRowClass->getItemRoByNumber(40)->setElementValue('S');
							$objRowRowClass->getItemRoByNumber(40)->setItemNumberError(0);
							$objRowRowClass->getItemRoByNumber(41)->setItemNumberError(0);
							$objRowRowClass->getItemRoByNumber(42)->setItemNumberError(0);
							$objRowRowClass->getItemRoByNumber(43)->setItemNumberError(0);
							
							$objRowRowClass->getItemRoByNumber(41)->setElementValue(strtoupper($this->remplace_string_ro($rowConyuge['apellidoPaternoConyuge'])));
							$objRowRowClass->getItemRoByNumber(42)->setElementValue(strtoupper($this->remplace_string_ro($rowConyuge['apellidoMaternoConyuge'])));
							$objRowRowClass->getItemRoByNumber(43)->setElementValue(strtoupper($this->remplace_string_ro($rowConyuge['nombresConyuge'])));
							
							/*$objRowRowClass->getItemRoByNumber(41)->setElementValue('');
							$objRowRowClass->getItemRoByNumber(42)->setElementValue('');
							$objRowRowClass->getItemRoByNumber(43)->setElementValue('');*/

						}else{
							$arrFileRow['validationParticipacionConyuge'] = 40;
							$arrFileRow['validationPaternoConyuge'] = 41;
							$arrFileRow['validationMaternoConyuge'] = 42;
							$arrFileRow['validationnombreConyuge'] = 43;
							$objRowRowClass->getItemRoByNumber(40)->setElementValue('N');
							$objRowRowClass->getItemRoByNumber(40)->setItemNumberError(0);
							$objRowRowClass->getItemRoByNumber(41)->setItemNumberError(0);
							$objRowRowClass->getItemRoByNumber(42)->setItemNumberError(0);
							$objRowRowClass->getItemRoByNumber(43)->setItemNumberError(0);
							$objRowRowClass->getItemRoByNumber(41)->setElementValue('');
							$objRowRowClass->getItemRoByNumber(42)->setElementValue('');
							$objRowRowClass->getItemRoByNumber(43)->setElementValue('');
						}


						if($objRowRowClass->getItemRoByNumber(40)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(40);
						if($objRowRowClass->getItemRoByNumber(41)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(41);
						if($objRowRowClass->getItemRoByNumber(42)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(42);
						if($objRowRowClass->getItemRoByNumber(43)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(43);

						$arrFileRow['codigoTipoFondo']  = '';
						$objRowRowClass->getItemRoByNumber(44)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(44)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(44)->setKardex($kardex);
						if($objRowRowClass->getItemRoByNumber(44)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(44);
						$arrFileRow['validationTipoFondo'] = 0;


						$arrFileRow['tipoOperacion'] = $tipoOperacion;
						$objRowRowClass->getItemRoByNumber(45)->setElementValue($tipoOperacion);
						$objRowRowClass->getItemRoByNumber(45)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(45)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(45)->setKardex($kardex);
						if($objRowRowClass->getItemRoByNumber(45)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(45);

						$arrFileRow['codigoFormaPago'] = '';
						$objRowRowClass->getItemRoByNumber(46)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(46)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(46)->setKardex($kardex);
						if($objRowRowClass->getItemRoByNumber(46)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(46);
						$arrFileRow['validationFormaPago'] = 0;

						$arrFileRow['oportunidadPago'] = '';
						$objRowRowClass->getItemRoByNumber(47)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(47)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(47)->setKardex($kardex);
						if($objRowRowClass->getItemRoByNumber(47)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(47);
						$arrFileRow['validationOportunidadPago'] = 0;

						$arrFileRow['descripcionOportunidadPago'] = '';
						$objRowRowClass->getItemRoByNumber(48)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(48)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(48)->setKardex($kardex);
						if($objRowRowClass->getItemRoByNumber(48)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(48);
						$arrFileRow['validationDescripcionOportunidadPago'] = 0;

						$arrFileRow['origenFondo']  = strtoupper($this->remplace_string_ro($rowContratante['origenFondo']));
						$objRowRowClass->getItemRoByNumber(49)->setElementValue(strtoupper($this->remplace_string_ro($rowContratante['origenFondo'])));
						$objRowRowClass->getItemRoByNumber(49)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(49)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(49)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(49)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(49)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(49);

						
						$monedaOperacionContratante = $rowContratante['representante'] == 'R'?'':$monedaOperacion;

						$arrFileRow['monedaOperacion'] = $monedaOperacionContratante ;
						$objRowRowClass->getItemRoByNumber(50)->setElementValue($monedaOperacionContratante );
						$objRowRowClass->getItemRoByNumber(50)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(50)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(50)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(50)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(50)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(50);

						$arrFileRow['montoOperacion'] = '0.00';
						$objRowRowClass->getItemRoByNumber(51)->setElementValue('0.00');
						$objRowRowClass->getItemRoByNumber(51)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(51)->setKardex($kardex);
						//$objRowRowClass->getItemRoByNumber(51)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(51)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(51)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(51);
						$arrFileRow['validationMontoOperacion'] = 0;

						$arrFileRow['montoPorParticipante'] = $rowContratante['montoPorParticipante'];
						#validaciones extras
						$montoParticipante = $rowContratante['montoPorParticipante'];
						$valMontoParticipante = $rowContratante['validationMontoPorParticipante'];
						$descriptionElement = ',codigo de  moneda no se debe informar sin montos';
						if($idMoneda != 0 && ($montoParticipante === '0.00' or $montoParticipante === '') && ($rowContratante['personaAFavor'] =! '') && ($rowContratante['personaOperacion'] != '')){
							$valMontoParticipante = 52;
							//die('ohola'.$kardex.'-'.$rowContratante['contratante']);
							$objRowRowClass->getItemRoByNumber(52)->setDescriptionElement($descriptionElement);
							
						}
						#Fin validaciones extras

						$objRowRowClass->getItemRoByNumber(52)->setElementValue($rowContratante['montoPorParticipante']);
						$objRowRowClass->getItemRoByNumber(52)->setItemNumberError($valMontoParticipante);
						$objRowRowClass->getItemRoByNumber(52)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(52)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(52)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(52)->setAct($act);
						$objRowRowClass->getItemRoByNumber(52)->setRowType(2);
						if($objRowRowClass->getItemRoByNumber(52)->getItemNumberError() != 0)
							$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(52);
							

						$arrFileRow['validationMontoPorParticipante'] = $rowContratante['validationMontoPorParticipante'];

						$arrFileRow['montoTipoFondo'] = '0.00';
						$objRowRowClass->getItemRoByNumber(53)->setElementValue('0.00');
						$objRowRowClass->getItemRoByNumber(53)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(53)->setKardex($kardex);
						if($objRowRowClass->getItemRoByNumber(53)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(53);
						$arrFileRow['validationMontoTipoFondo'] = 0;

						$arrFileRow['tipoCambio'] = '0.00';
						$objRowRowClass->getItemRoByNumber(54)->setElementValue('0.00');
						$objRowRowClass->getItemRoByNumber(54)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(54)->setKardex($kardex);
						if($objRowRowClass->getItemRoByNumber(54)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(54);

						$arrFileRow['inscripcionRegistralBien'] = '';
						$objRowRowClass->getItemRoByNumber(55)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(55)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(55)->setKardex($kardex);
						if($objRowRowClass->getItemRoByNumber(55)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(55);

						$arrFileRow['zonaRegistralBien'] = '';
						$objRowRowClass->getItemRoByNumber(56)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(56)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(56)->setKardex($kardex);
						if($objRowRowClass->getItemRoByNumber(56)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(56);

						$arrFileRow['numeroPartidaRegistralBien'] = '';
						$objRowRowClass->getItemRoByNumber(57)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(57)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(57)->setKardex($kardex);
						if($objRowRowClass->getItemRoByNumber(57)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(57);

						$arrFileRow['tipoFila'] = 0;

						$arrRo[] = $arrFileRow;

						$this->_arrObjRo[] = $objRowRowClass;
						



					}
					//validaciones extras
					$sumMontoPorParticipanteO = number_format($sumMontoPorParticipanteO,2,'.','');
					if($sumMontoPorParticipanteO != $montoOperacion && !in_array($actUIF,$arrActO)){
						$objRowRowClass = new RowRoClass($arrRoDataField);
						$objRowRowClass->getItemRoByNumber(1)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(1)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(1)->setCodeElement(600);
						$objRowRowClass->getItemRoByNumber(1)->setDescriptionElement('La suma de los montos de los contratantes otorgantes supera el monto total de la  operacion: '.$montoOperacion);
						$objRowRowClass->getItemRoByNumber(1)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(1)->setAct($act);
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(1);
					}
					$sumMontoPorParticipanteB = number_format($sumMontoPorParticipanteB,2,'.','');
					if($sumMontoPorParticipanteB != $montoOperacion && !in_array($actUIF,$arrActB)){
						$objRowRowClass = new RowRoClass($arrRoDataField);
						$objRowRowClass->getItemRoByNumber(1)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(1)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(1)->setCodeElement(600);
						$objRowRowClass->getItemRoByNumber(1)->setDescriptionElement('La suma de los montos de los contratantes beneficierios supera el monto total de la  operacion: '.$montoOperacion);
						$objRowRowClass->getItemRoByNumber(1)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(1)->setAct($act);
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(1);
					}
					if(!in_array('O', $arrO) && !in_array($actUIF,$arrActO)){
						$objRowRowClass = new RowRoClass($arrRoDataField);
						$objRowRowClass->getItemRoByNumber(14)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(14)->setKardex($kardex);
						//$objRowRowClass->getItemRoByNumber(14)->setCodeElement(140);
						//$objRowRowClass->getItemRoByNumber(1)->setDescriptionElement('La suma de los montos de los contratantes beneficierios supera el monto total de la  operacion: '.$montoOperacion);
						$objRowRowClass->getItemRoByNumber(14)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(14)->setAct($act);
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(14);
					}
					if(!in_array('B', $arrB) && !in_array($actUIF,$arrActB)){
						$objRowRowClass = new RowRoClass($arrRoDataField);
						$objRowRowClass->getItemRoByNumber(15)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(15)->setKardex($kardex);
						//$objRowRowClass->getItemRoByNumber(15)->setCodeElement(150);
						//$objRowRowClass->getItemRoByNumber(1)->setDescriptionElement('La suma de los montos de los contratantes beneficierios supera el monto total de la  operacion: '.$montoOperacion);
						$objRowRowClass->getItemRoByNumber(15)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(15)->setAct($act);
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(15);
					}



				}else{
					//aqui kardex
					$objRowRowClass = new RowRoClass($arrRoDataField);
					$objRowRowClass->getItemRoByNumber(1)->setIdKardex($idKardex);
					$objRowRowClass->getItemRoByNumber(1)->setKardex($kardex);
					$objRowRowClass->getItemRoByNumber(1)->setCodeElement(590);
					$objRowRowClass->getItemRoByNumber(1)->setDescriptionElement('El  kardex ,no tiene fila de Contratantes');
					$objRowRowClass->getItemRoByNumber(1)->setRowType(2);
					$objRowRowClass->getItemRoByNumber(1)->setAct($act);
					$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(1);
					
				}


			}
			# INFORMACION COMPLEMENTARIA.
			else{

				$sql = $IPNP == 'T'? "SELECT detallevehicular.kardex ,(CASE WHEN detallevehicular.idsedereg != '' AND detallevehicular.pregistral != '' THEN 'I'  ELSE 'N' END) AS inscripcionRegistralBien  ,detallevehicular.idsedereg  AS zonaRegistralBien, detallevehicular.pregistral AS numeroPartidaRegistralBien FROM detallevehicular WHERE detallevehicular.kardex = '$kardex'  AND detallevehicular.idtipacto = '$codAct'":"SELECT  detallebienes.kardex,detallebienes.idsedereg AS zonaRegistralBien,
								detallebienes.pregistral AS numeroPartidaRegistralBien,
								(CASE WHEN detallebienes.idsedereg != '' AND detallebienes.pregistral != '' THEN 'I'  ELSE 'N' END) AS inscripcionRegistralBien 
								FROM detallebienes WHERE detallebienes.kardex = '$kardex' AND detallebienes.idtipacto='$codAct'";

				$resultDetalleBien = mysql_query($sql);
				if(mysql_affected_rows() != 0){
					$rowDetalleBien = mysql_fetch_assoc($resultDetalleBien);
					$inscripcionRegistralBien  = $rowDetalleBien['inscripcionRegistralBien'];
					$zonaRegistralBien = $rowDetalleBien['zonaRegistralBien'];
					$numeroPartidaRegistralBien = $rowDetalleBien['numeroPartidaRegistralBien'];
				}else{
					$inscripcionRegistralBien = 'N';
					$zonaRegistralBien = '';
					$numeroPartidaRegistralBien = '';
				}
				$sql = "SELECT DISTINCT detallemediopago.kardex,tiposdeacto.actouif  AS tipoOperacion,detallemediopago.tipacto AS tipoActo,
						 SUM(detallemediopago.importemp) AS montoTipoFondo, 
						  (CASE   WHEN ( IF(SUM(detallemediopago.importemp) = '','V',SUM(detallemediopago.importemp)) REGEXP   (SELECT ro_validation_by_act.dataValue FROM ro_validation_by_act
						 WHERE ro_validation_by_act.codeAct = tiposdeacto.actouif AND ro_validation_by_act.fkDataField = 53 LIMIT 1)) != 0 
						 THEN 0 ELSE 53 END)AS validationMontoTipoFondo,
						 (SELECT ro_validation_by_act.detailValue FROM ro_validation_by_act
						WHERE ro_validation_by_act.codeAct = tiposdeacto.actouif AND ro_validation_by_act.fkDataField = 53) AS detailValueMontoTipoFondo,
						 mediospago.uif AS codigoTipoFondo,
						 (CASE  WHEN (IF(mediospago.uif = '','V',mediospago.uif) REGEXP   (SELECT ro_validation_by_act.dataValue FROM ro_validation_by_act
						 WHERE ro_validation_by_act.codeAct = tiposdeacto.actouif AND ro_validation_by_act.fkDataField = 44 LIMIT 1)) != 0
						 THEN 0 ELSE 44 END)AS validationTipoFondo,
						 (SELECT ro_validation_by_act.detailValue FROM ro_validation_by_act
						WHERE ro_validation_by_act.codeAct = tiposdeacto.actouif AND ro_validation_by_act.fkDataField = 44) AS detailValueTipoFondo
						 FROM detallemediopago 
						 INNER JOIN mediospago ON detallemediopago.codmepag = mediospago.codmepag
						 LEFT JOIN fpago_uif ON fpago_uif.id_fpago=detallemediopago.fpago 
						 LEFT JOIN tiposdeacto  ON  detallemediopago.tipacto = tiposdeacto.idtipoacto
						 WHERE detallemediopago.kardex='$kardex' 
						 AND detallemediopago.tipacto='$codAct' 
						 GROUP BY detallemediopago.codmepag, detallemediopago.tipacto";
				
				$resultMedioPago = mysql_query($sql);
				$tipoActoMedioPago = 0;
				$arrObjItemRo = array();
				$existsRowMedioPago = false;
				while($rowMedioPago = mysql_fetch_assoc($resultMedioPago)){
					$existsRowMedioPago = true;
					$tipoActoMedioPago = $rowMedioPago['tipoActo'];
					$montoTipoFondo = $rowMedioPago['montoTipoFondo'];
					$codigoTipoFondo = $rowMedioPago['codigoTipoFondo'];
					$validationTipoFondo = $rowMedioPago['validationTipoFondo'];
					$detailValueTipoFondo = $rowMedioPago['detailValueTipoFondo'];
					$validationMontoTipoFondo = $rowMedioPago['validationMontoTipoFondo'];
					$detailValueMontoTipoFondo = $rowMedioPago['detailValueMontoTipoFondo'];
					$arrFileRow['kardex'] = $kardex;

				}

				$sql = "SELECT IF(cliente2.tipper = 'N', CONCAT(cliente2.apepat,' ',cliente2.apemat,' ',cliente2.prinom,' ',cliente2.segnom),
					 cliente2.razonsocial)  AS contratante,
					cliente2.direccion,cliente2.idtipdoc ,cliente2.numdoc,tipodocumento.destipdoc AS tipo_documento,cliente2.email,
					cliente2.telfijo AS telefono2,cliente2.telcel AS celular,cliente2.telofi,cliente2.sexo,
					cliente2.natper AS persona_natural,
					IF (REPLACE(STR_TO_DATE(contratantes.fechafirma,'%d/%m/%Y'),'-','') = '00000000','',
					REPLACE(STR_TO_DATE(contratantes.fechafirma,'%d/%m/%Y'),'-','')) AS fechaFirmaParticipante,
					(CASE WHEN  contratantesxacto.uif = '' THEN 13 ELSE 0 END ) AS validationRepresentante,
					(CASE WHEN contratantesxacto.uif = 'R' THEN contratantesxacto.uif ELSE '' END)AS representante,
					( CASE WHEN contratantesxacto.uif = '' THEN 14 ELSE 0 END ) AS  validationPersonaOperacion,
					(CASE WHEN (contratantesxacto.uif REGEXP '^[OGFN]') != 0  THEN contratantesxacto.uif ELSE '' END)AS personaOperacion,
					( CASE WHEN contratantesxacto.uif = '' THEN 15 ELSE 0 END ) AS  validationPersonaAFavor,
					(CASE WHEN contratantesxacto.uif = 'B'  THEN contratantesxacto.uif ELSE ''  END)AS personaAFavor,
					contratantes.idcontratanterp AS idContratanteR,
					 (
					 CASE WHEN  contratantes.idcontratanterp = '' AND contratantesxacto.uif = 'R'
					 THEN  16 ELSE 0  END
					 ) AS validationPersonaQueRepresenta,
					(CASE WHEN  contratantesxacto.uif = 'R' AND inscrito = '' THEN 17 ELSE 0 END ) AS validationTipoRepresentacion,
					(CASE WHEN  contratantesxacto.uif = 'R' AND contratantes.inscrito = 0 THEN 2 
					WHEN  contratantesxacto.uif = 'R' AND contratantes.inscrito = 1 THEN 1  ELSE '' END ) AS tipoRepresentacion,
					(CASE WHEN cliente2.residente = 'NULL'  THEN 18  ELSE  0 END ) AS validationCondicionResidencia,
					(CASE WHEN cliente2.residente = '' OR cliente2.residente = 1 THEN 1 ELSE  2  END) AS condicionResidencia,
					(CASE WHEN cliente2.tipper = '' THEN 19 ELSE 0 END)AS validationTipoPersona,
					(CASE WHEN  cliente2.tipper = 'N' THEN 1 ELSE 3 END)AS tipoPersona,
					(CASE WHEN cliente2.tipper = 'N' AND tipodocumento.idtipdoc IS NULL THEN  20 ELSE 0 END) AS validationTipoDocumento,
					(CASE WHEN cliente2.tipper = 'N'   THEN  CAST(tipodocumento.codtipdoc AS UNSIGNED)   ELSE '' END) AS codigoTipoDocumento,
					(CASE WHEN cliente2.tipper = 'N' AND cliente2.numdoc IS NULL  THEN 21 ELSE 0 END) AS validationNumeroDocumento,
					(CASE WHEN cliente2.tipper = 'N' THEN cliente2.numdoc ELSE ''  END) AS numeroDocumento,
					(CASE WHEN cliente2.tipper = 'J' AND tipodocumento.idtipdoc = 8 AND cliente2.numdoc = '' THEN  22 
					  ELSE 0 END) AS validationNumeroRuc,
					(CASE WHEN cliente2.tipper = 'J' AND tipodocumento.idtipdoc = 8  THEN  cliente2.numdoc 
					WHEN cliente2.tipper = 'J' AND  tipodocumento.idtipdoc = 10 THEN '99999999999'  ELSE '' END) AS numeroRuc,
					(CASE WHEN cliente2.tipper = 'N' AND cliente2.apepat = '' THEN 1
						WHEN cliente2.tipper = 'J' AND cliente2.razonsocial = '' THEN 23 ELSE 0  END) AS validationApellidoPaternoRazonSocial ,
					(CASE WHEN cliente2.tipper = 'N'  THEN cliente2.apepat
						WHEN cliente2.tipper = 'J'  THEN cliente2.razonsocial ELSE 0  END) AS apellidoPaternoRazonSocial,		
					(CASE WHEN cliente2.tipper = 'N'  THEN 24  ELSE 0 END) AS vaidationApellidoMaterno,
					
					(CASE  WHEN cliente2.tipper = 'J' THEN '' ELSE  cliente2.apemat END )AS apellidoMaterno,
					
					(CASE WHEN cliente2.tipper = 'N' AND (cliente2.prinom = ''  OR  cliente2.segnom = '') IS NULL  THEN 25 ELSE 0  END ) AS validationNombres,
					
					(CASE WHEN cliente2.tipper = 'J' THEN  '' ELSE  CONCAT(cliente2.prinom,' ',cliente2.segnom ) END )AS nombres,
					
					(CASE WHEN cliente2.tipper = 'N' AND nacionalidades.codnacion IS NULL  THEN 26 ELSE 0  END ) AS validationNacionalidad,
					(CASE WHEN cliente2.tipper = 'N'  THEN nacionalidades.codnacion ELSE ''  END ) AS codigoNacion, 
					nacionalidades.descripcion AS nacionalidad,
					(CASE WHEN cliente2.tipper = 'N' AND cliente2.cumpclie = ''  THEN 0 ELSE 0  END ) AS validationFechaNacimiento,
					(CASE WHEN cliente2.tipper = 'N' AND REPLACE(STR_TO_DATE(cliente2.cumpclie,'%d/%m/%Y'),'-','') != '00000000'  THEN REPLACE(STR_TO_DATE(cliente2.cumpclie,'%d/%m/%Y'),'-','')   ELSE ''  END ) AS fechaNacimiento, 
					(CASE WHEN  cliente2.tipper = 'N' AND  tipoestacivil.codestcivil IS NULL THEN 28 ELSE 0 END )AS validationEstadoCivil,
					(CASE WHEN  cliente2.tipper = 'N'  THEN tipoestacivil.idestcivil ELSE '' END )AS codigoEstadoCivil,
					tipoestacivil.desestcivil AS estadoCivil,
					(CASE  WHEN  cliente2.tipper = 'N'  AND profesiones.idprofesion IS NULL   THEN 29  ELSE 0 END) AS validationProfesion,
					profesiones.idprofesion, (CASE WHEN profesiones.codprof IS NULL OR cliente2.tipper = 'J' THEN ''  ELSE profesiones.codprof END) AS  codigoProfesion,profesiones.desprofesion AS profesion,
					(CASE WHEN  cliente2.tipper = 'J' AND cliente2.contacempresa = '' THEN 30 ELSE 0 END ) AS validationObjectoSocial,
					cliente2.contacempresa AS objectoSocial,
					(CASE WHEN  cliente2.tipper = 'J' AND  ciiu.coddivi IS NULL THEN 31 ELSE 0 END )AS validationCiiu,
					(CASE WHEN ciiu.coddivi IS NULL OR cliente2.tipper = 'N' THEN ''  ELSE ciiu.coddivi END) codigoCiiu,ciiu.nombre AS ciiu,
					(CASE  WHEN  cliente2.tipper = 'N' AND cargoprofe.idcargoprofe IS NULL THEN 32 ELSE 0 END  ) AS validationCargo,
					cargoprofe.idcargoprofe,
					(CASE WHEN cargoprofe.codcargoprofe IS NULL OR  cliente2.tipper = 'J'  THEN ''  ELSE cargoprofe.codcargoprofe END ) AS codigoCargo,cargoprofe.descripcrapro AS cargo,

					(CASE WHEN  contratantesxacto.uif = 'R'  /*AND  cliente2.tipper = 'J'*/ AND  contratantes.inscrito = 1 AND contratantes.idsedereg = 0  
					THEN 33 ELSE 0 END) AS validationCodigoZonaRegistral,
					(CASE WHEN  contratantesxacto.uif = 'R'   THEN LPAD(contratantes.idsedereg,2,0) 
					ELSE  '' END) AS codigoZonaRegistral ,
					(CASE WHEN contratantesxacto.uif = 'R'  /*AND cliente2.tipper = 'J' */AND  contratantes.inscrito = 1 AND  contratantes.numpartida  = ''  THEN 34 ELSE 0 END) AS validationNumeroPartidaRegistral,
					(CASE WHEN  contratantesxacto.uif = 'R' /* AND cliente2.tipper = 'J'*/ THEN contratantes.numpartida    
					ELSE  '' END) AS numeroPartidaRegistral ,
					
					(CASE WHEN    (cliente2.domfiscal = '' AND cliente2.tipper = 'J' ) OR  (cliente2.direccion = '' AND cliente2.tipper = 'N' )  THEN  35  ELSE 0   END) validationDireccion,
					
					(CASE WHEN cliente2.tipper = 'N'  THEN  cliente2.direccion 
					    ELSE cliente2.domfiscal END ) AS direccion,
					(CASE WHEN ubigeo.codpto IS NULL   THEN 36 ELSE 0 END) AS validationDepartamento,
					ubigeo.codpto AS departamento,
					(CASE WHEN ubigeo.codprov IS NULL   THEN 37 ELSE 0 END) AS validationProvincia,
					ubigeo.codprov AS provincia,
					(CASE WHEN ubigeo.coddist IS NULL   THEN 38 ELSE 0 END) AS validationDistrito,
					ubigeo.coddist AS distrito,cliente2.conyuge,
					(CASE  WHEN   cliente2.tipper = 'N' AND cliente2.conyuge != '' THEN 'N' 
						WHEN  cliente2.tipper = 'J' AND cliente2.conyuge = '' THEN '' 
					ELSE  'N' END )AS participacionConyuge,
					contratantesxacto.ofondo AS origenFondo,
					contratantesxacto.monto AS montoPorParticipante,
					(CASE   WHEN ( IF(contratantesxacto.monto = '','V',contratantesxacto.monto) REGEXP   (SELECT ro_validation_by_act.dataValue FROM ro_validation_by_act
						 WHERE ro_validation_by_act.codeAct = tiposdeacto.actouif AND ro_validation_by_act.fkDataField = 52 LIMIT 1)) != 0 OR contratantesxacto.uif  = 'R'
						 THEN 0 ELSE 52 END)AS validationMontoPorParticipante,
					contratantesxacto.uif,contratantesxacto.parte,contratantesxacto.porcentaje,
					contratantesxacto.formulario,contratantesxacto.monto,
					contratantesxacto.ofondo,contratantesxacto.montop,contratantes.idcontratanterp		   
					FROM contratantesxacto
				   INNER JOIN cliente2 ON contratantesxacto.idcontratante= cliente2.idcontratante
				   LEFT JOIN contratantes ON cliente2.idcontratante =  contratantes.idcontratante 
				   INNER  JOIN  tiposdeacto ON contratantesxacto.idtipoacto = tiposdeacto.idtipoacto
				   LEFT JOIN profesiones ON cliente2.idprofesion =  profesiones.idprofesion
				   LEFT JOIN cargoprofe ON cliente2.idcargoprofe  = cargoprofe.idcargoprofe
				   LEFT JOIN  ubigeo ON   cliente2.idubigeo = ubigeo.coddis
				   LEFT JOIN ciiu ON cliente2.actmunicipal = ciiu.coddivi
				   LEFT JOIN tipoestacivil ON cliente2.idestcivil =  tipoestacivil.idestcivil 
				   LEFT JOIN  nacionalidades ON cliente2.nacionalidad = nacionalidades.idnacionalidad
				   LEFT JOIN tipodocumento ON cliente2.idtipdoc = tipodocumento.idtipdoc 
				   LEFT JOIN  sedesregistrales ON cliente2.idsedereg  = sedesregistrales.idsedereg
				   LEFT JOIN kardex ON kardex.kardex = contratantesxacto.kardex
				   WHERE contratantes.fechafirma <> '' AND  STR_TO_DATE(contratantes.fechafirma,'%d/%m/%Y') >= STR_TO_DATE('$this->_initialDate','%d/%m/%Y') 
				   AND STR_TO_DATE(contratantes.fechafirma,'%d/%m/%Y') <= STR_TO_DATE('$this->_finalDate','%d/%m/%Y') 
				  AND kardex.fechaescritura < STR_TO_DATE('$this->_initialDate','%d/%m/%Y') AND kardex.fechaescritura <> '' AND
				    contratantesxacto.kardex='$kardex' AND contratantesxacto.idtipoacto='$tipoActoMedioPago'
				   AND contratantesxacto.uif <> '' AND (contratantesxacto.uif='O' 
				   OR contratantesxacto.uif='B' OR contratantesxacto.uif='R')
				   ORDER BY 
				   contratantesxacto.uif DESC";

				$resultContratante = mysql_query($sql);	
				$arrFileRow = array();

				if($existsRowMedioPago){
					$registrationNumberOperation = $registrationNumberOperation + 1;
				}
				if(mysql_affected_rows() != 0){
					while($rowContratante = mysql_fetch_assoc($resultContratante)){					
						$codeRow = $codeRow + 1;
						$objRowRowClass = new RowRoClass($arrRoDataField);

						$arrFileRow['kardex'] = $kardex;
						$tipoPersona = $rowContratante['tipper'];

						$arrFileRow['codigoFila'] = $codeRow;
						$objRowRowClass->getItemRoByNumber(1)->setElementValue($codeRow);
						$objRowRowClass->getItemRoByNumber(1)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(1)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(1)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(1);
					

						$arrFileRow['numeroRegistroOperacion'] = $registrationNumberOperation;
						$objRowRowClass->getItemRoByNumber(2)->setElementValue($registrationNumberOperation);
						$objRowRowClass->getItemRoByNumber(2)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(2)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(2)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(2);
						
						$arrFileRow['tipoEnvio'] = $tipoEnvio;
						$objRowRowClass->getItemRoByNumber(3)->setElementValue($tipoEnvio);
						$objRowRowClass->getItemRoByNumber(3)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(3)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(3)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(3);

						$arrFileRow['IPNP'] = $IPNP;
						$objRowRowClass->getItemRoByNumber(4)->setElementValue($IPNP);
						$objRowRowClass->getItemRoByNumber(4)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(4)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(4)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(4);

						$arrFileRow['numeroIPNP'] = $numeroEscritura;
						$objRowRowClass->getItemRoByNumber(5)->setElementValue($numeroEscritura);
						$objRowRowClass->getItemRoByNumber(5)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(5)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(5)->setAct($act);
						$objRowRowClass->getItemRoByNumber(5)->setDetailsError('El número de escritura no puede ser cero');
						if($numeroEscritura == '' ||  (int)($numeroEscritura)  === 0) 
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(5);

						$arrFileRow['fechaIPNP'] = $fechaEscritura;
						$objRowRowClass->getItemRoByNumber(6)->setElementValue($fechaEscritura);
						$objRowRowClass->getItemRoByNumber(6)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(6)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(6)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(6);

						$arrFileRow['numeroIPNPAclara'] = '';
						$objRowRowClass->getItemRoByNumber(7)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(7)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(7)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(7)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(7);

						$arrFileRow['fechaIPNPAclara'] = '';
						$objRowRowClass->getItemRoByNumber(8)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(8)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(8)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(8)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(8);

						$arrFileRow['conclusion'] = $conclusion;
						$objRowRowClass->getItemRoByNumber(9)->setElementValue($conclusion);
						$objRowRowClass->getItemRoByNumber(9)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(9)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(9)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(9);

						$arrFileRow['fechaFirmaParticipante'] = $rowContratante['fechaFirmaParticipante'];
						$objRowRowClass->getItemRoByNumber(10)->setElementValue($rowContratante['fechaFirmaParticipante']);
						$objRowRowClass->getItemRoByNumber(10)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(10)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(10)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(10)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(10)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(10)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(10);


						$arrFileRow['modalidadOperacion'] = 'U';
						$objRowRowClass->getItemRoByNumber(11)->setElementValue('U');
						$objRowRowClass->getItemRoByNumber(11)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(11)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(11)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(11);

						$arrFileRow['cantidadOperacionMultiple'] = '';
						$objRowRowClass->getItemRoByNumber(12)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(12)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(12)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(12)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(12);


						$arrFileRow['representante'] =  $rowContratante['representante'];
						$objRowRowClass->getItemRoByNumber(13)->setElementValue($rowContratante['representante']);
						$objRowRowClass->getItemRoByNumber(13)->setItemNumberError($rowContratante['validationRepresentante']);
						$objRowRowClass->getItemRoByNumber(13)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(13)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(13)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(13)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(13)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(13);
						$arrFileRow['validationRepresentante'] = $rowContratante['validationRepresentante'];

						$arrFileRow['personaOperacion'] = $rowContratante['personaOperacion'];
						$objRowRowClass->getItemRoByNumber(14)->setElementValue($rowContratante['personaOperacion']);
						$objRowRowClass->getItemRoByNumber(14)->setItemNumberError($rowContratante['validationPersonaOperacion']);
						$objRowRowClass->getItemRoByNumber(14)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(14)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(14)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(14)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(14)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(14);
						$arrFileRow['validationPersonaOperacion'] = $rowContratante['validationPersonaOperacion'];


						$arrFileRow['personaAFavor'] = $rowContratante['personaAFavor'];
						$objRowRowClass->getItemRoByNumber(15)->setElementValue($rowContratante['personaAFavor']);
						$objRowRowClass->getItemRoByNumber(15)->setItemNumberError($rowContratante['validationPersonaAFavor']);
						$objRowRowClass->getItemRoByNumber(15)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(15)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(15)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(15)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(15)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(15);
						$arrFileRow['validationPersonaAFavor'] = $rowContratante['validationPersonaAFavor'];


						$objRowRowClass->getItemRoByNumber(16)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(16)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(16)->setRowType(2);
						$idContratanteR =  $rowContratante['idContratanteR'];
						if($rowContratante['uif'] == 'R' ){
							$sql = "SELECT uif FROM  contratantesxacto  WHERE contratantesxacto.idcontratante = '$idContratanteR' AND   (uif = 'B' OR uif = 'O' OR uif = 'G' OR uif = 'F' OR uif = 'N' OR uif = 'R') ";
							$resultRepresentate = mysql_query($sql);
							if(mysql_affected_rows() != 0){
								$rowRepresentante = mysql_fetch_assoc($resultRepresentate);
								$arrFileRow['personaQueRepresenta'] = $rowRepresentante['uif'] === 'R'?'N':$rowRepresentante['uif'];
								$arrFileRow['validationPersonaQueRepresenta'] = 0;
								$personaQueRepresenta = $rowRepresentante['uif'] === 'R'?'N':$rowRepresentante['uif'];
								$validationPersonaQueRepresenta = 0;
							}else{
								$arrFileRow['personaQueRepresenta'] = '';
								$arrFileRow['validationPersonaQueRepresenta'] = 16;
								$personaQueRepresenta = '';
								$validationPersonaQueRepresenta = 16;
								
							}
						}else{
							$arrFileRow['personaQueRepresenta'] = '';
							$arrFileRow['validationPersonaQueRepresenta'] = 0;
							$personaQueRepresenta = '';
							$validationPersonaQueRepresenta = 0;
							
						}
						$objRowRowClass->getItemRoByNumber(16)->setElementValue($personaQueRepresenta);
						$objRowRowClass->getItemRoByNumber(16)->setItemNumberError($validationPersonaQueRepresenta);
						$objRowRowClass->getItemRoByNumber(16)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(16)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(16)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(16);


						$arrFileRow['tipoRepresentacion'] = $rowContratante['tipoRepresentacion'];
						$objRowRowClass->getItemRoByNumber(17)->setElementValue($rowContratante['tipoRepresentacion']);
						$objRowRowClass->getItemRoByNumber(17)->setItemNumberError($rowContratante['validationTipoRepresentacion']);
						$objRowRowClass->getItemRoByNumber(17)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(17)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(17)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(17)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(17)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(17)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(17);
						$arrFileRow['validationTipoRepresentacion'] = $rowContratante['validationTipoRepresentacion'];


						$arrFileRow['condicionResidencia'] = $rowContratante['condicionResidencia'];
						$objRowRowClass->getItemRoByNumber(18)->setElementValue($rowContratante['condicionResidencia']);
						$objRowRowClass->getItemRoByNumber(18)->setItemNumberError($rowContratante['validationCondicionResidencia']);
						$objRowRowClass->getItemRoByNumber(18)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(18)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(18)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(18)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(18)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(18)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(18);
						$arrFileRow['validationCondicionResidencia'] = $rowContratante['validationCondicionResidencia'];

						$arrFileRow['tipoPersona'] = $rowContratante['tipoPersona'];
						$objRowRowClass->getItemRoByNumber(19)->setElementValue($rowContratante['tipoPersona']);
						$objRowRowClass->getItemRoByNumber(19)->setItemNumberError($rowContratante['validationTipoPersona']);
						$objRowRowClass->getItemRoByNumber(19)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(19)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(19)->setAct($act);
						
						if($objRowRowClass->getItemRoByNumber(19)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(19);
						$arrFileRow['validationTipoPersona'] = $rowContratante['validationTipoPersona'];

						$arrFileRow['codigoTipoDocumento'] = $rowContratante['codigoTipoDocumento'];
						$objRowRowClass->getItemRoByNumber(20)->setElementValue($rowContratante['codigoTipoDocumento']);
						$objRowRowClass->getItemRoByNumber(20)->setItemNumberError($rowContratante['validationTipoDocumento']);
						$objRowRowClass->getItemRoByNumber(20)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(20)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(20)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(20)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(20)->setAct($act);
						$arrFileRow['validationTipoDocumento'] = $rowContratante['validationTipoDocumento'];

						if($objRowRowClass->getItemRoByNumber(20)->getItemNumberError() != 0){
							$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(20);
						}else{
							#validaciones extras para el tipo del documento segun la nacionalidad
							$codNacionalidad = $rowContratante['codigoNacion'];
 							$codigoTipoDocumento = $rowContratante['codigoTipoDocumento'];
							if( ($codNacionalidad == 'PE' && !in_array($codigoTipoDocumento, $arrDocumentsPE)) || ($codNacionalidad != 'PE' && in_array($codigoTipoDocumento, $arrDocumentsPE)) ){
								$objRowRowClass->getItemRoByNumber(20)->setDescriptionElement(',la nacionalidad no corresponde al tipo del documento.');
								$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(20);
							}
						}
						
						$arrFileRow['numeroDocumento'] = $rowContratante['numeroDocumento'];
						$objRowRowClass->getItemRoByNumber(21)->setElementValue($rowContratante['numeroDocumento']);
						$objRowRowClass->getItemRoByNumber(21)->setItemNumberError($rowContratante['validationNumeroDocumento']);
						$objRowRowClass->getItemRoByNumber(21)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(21)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(21)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(21)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(21);
						$arrFileRow['validationNumeroDocumento'] = $rowContratante['validationNumeroDocumento'];

						#validacion extras para el numero de documento segun el tipo de documento
						$numDocumento = $rowContratante['numdoc'];
						$idTipDoc = $rowContratante['idtipdoc'];
						if($idTipDoc == 1 && (strlen($numDocumento) != 8 || !ctype_digit($numDocumento))){
							$objRowRowClass->getItemRoByNumber(21)->setDescriptionElement(',su DNI es incorrecto');
							$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(21);
						}
						if(($tipoPersona == 'J' && $idTipDoc != 10) && (strlen($numDocumento) != 11 || !ctype_digit($numDocumento))){
							$objRowRowClass->getItemRoByNumber(21)->setDescriptionElement(',su RUC es incorrecto');
							$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(21);
						}
						

						$arrFileRow['numeroRuc'] = $rowContratante['numeroRuc'];
						$objRowRowClass->getItemRoByNumber(22)->setElementValue($rowContratante['numeroRuc']);
						$objRowRowClass->getItemRoByNumber(22)->setItemNumberError($rowContratante['validationNumeroRuc']);
						$objRowRowClass->getItemRoByNumber(22)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(22)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(22)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(22)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(22);
						$arrFileRow['validationNumeroRuc'] = $rowContratante['validationNumeroRuc'];

						$arrFileRow['apellidoPaternoRazonSocial'] = $this->remplace_string_ro($rowContratante['apellidoPaternoRazonSocial'],$rowContratante['tipoPersona']);
						$objRowRowClass->getItemRoByNumber(23)->setElementValue($this->remplace_string_ro($rowContratante['apellidoPaternoRazonSocial'],$rowContratante['tipoPersona']));
						$objRowRowClass->getItemRoByNumber(23)->setItemNumberError($rowContratante['validationApellidoPaternoRazonSocial']);
						$objRowRowClass->getItemRoByNumber(23)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(23)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(23)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(23)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(23)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(23)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(23);
						$arrFileRow['validationApellidoPaternoRazonSocial'] = $rowContratante['validationApellidoPaternoRazonSocial'];

					    
					    $arrFileRow['apellidoMaterno']  =  strtoupper($this->remplace_string_ro($rowContratante['apellidoMaterno']));
					    $objRowRowClass->getItemRoByNumber(24)->setElementValue($this->remplace_string_ro($rowContratante['apellidoMaterno']));
						$objRowRowClass->getItemRoByNumber(24)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(24)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(24)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(24)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(24)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(24)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(24)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(24);
					    $arrFileRow['validationApellidoMaterno'] = 0;

						$arrFileRow['nombres'] =  strtoupper($this->remplace_string_ro($rowContratante['nombres']));
						$objRowRowClass->getItemRoByNumber(25)->setElementValue($this->remplace_string_ro($rowContratante['nombres']));
						$objRowRowClass->getItemRoByNumber(25)->setItemNumberError($rowContratante['validationNombres']);
						$objRowRowClass->getItemRoByNumber(25)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(25)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(25)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(25)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(25)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(25)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(25);
						$arrFileRow['validationNombres'] = $rowContratante['validationNombres'];


						$arrFileRow['codigoNacion'] = $rowContratante['codigoNacion'];
						$objRowRowClass->getItemRoByNumber(26)->setElementValue($rowContratante['codigoNacion']);
						$objRowRowClass->getItemRoByNumber(26)->setItemNumberError($rowContratante['validationNacionalidad']);
						$objRowRowClass->getItemRoByNumber(26)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(26)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(26)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(26)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(26)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(26)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(26);
						$arrFileRow['validationNacionalidad'] = $rowContratante['validationNacionalidad'];

						$arrFileRow['fechaNacimiento'] = $rowContratante['fechaNacimiento'];
						$objRowRowClass->getItemRoByNumber(27)->setElementValue($rowContratante['fechaNacimiento']);
						$objRowRowClass->getItemRoByNumber(27)->setItemNumberError($rowContratante['validationFechaNacimiento']);
						$objRowRowClass->getItemRoByNumber(27)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(27)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(27)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(27)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(27)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(27)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(27);
						$arrFileRow['validationFechaNacimiento'] = $rowContratante['validationFechaNacimiento'];


						$arrFileRow['codigoEstadoCivil'] = $rowContratante['codigoEstadoCivil'];
						$objRowRowClass->getItemRoByNumber(28)->setElementValue($rowContratante['codigoEstadoCivil']);
						$objRowRowClass->getItemRoByNumber(28)->setItemNumberError($rowContratante['validationEstadoCivil']);
						$objRowRowClass->getItemRoByNumber(28)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(28)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(28)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(28)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(28)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(28)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(28);
						$arrFileRow['validationEstadoCivil'] = $rowContratante['validationEstadoCivil'];

						$arrFileRow['codigoProfesion'] = $rowContratante['codigoProfesion'];
						$objRowRowClass->getItemRoByNumber(29)->setElementValue($rowContratante['codigoProfesion']);
						$objRowRowClass->getItemRoByNumber(29)->setItemNumberError($rowContratante['validationProfesion']);
						$objRowRowClass->getItemRoByNumber(29)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(29)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(29)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(29)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(29)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(29)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(29);
						$arrFileRow['validationProfesion'] = $rowContratante['validationProfesion'];

						$arrFileRow['objectoSocial'] = strtoupper($this->remplace_string_ro($rowContratante['objectoSocial']));
						$objRowRowClass->getItemRoByNumber(30)->setElementValue($this->remplace_string_ro($rowContratante['objectoSocial']));
						$objRowRowClass->getItemRoByNumber(30)->setItemNumberError($rowContratante['validationObjectoSocial']);
						$objRowRowClass->getItemRoByNumber(30)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(30)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(30)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(30)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(30)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(30)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(30);
						$arrFileRow['validationObjectoSocial'] = $rowContratante['validationObjectoSocial'];

						$arrFileRow['codigoCiiu'] = $rowContratante['codigoCiiu'];
						$objRowRowClass->getItemRoByNumber(31)->setElementValue($rowContratante['codigoCiiu']);
						$objRowRowClass->getItemRoByNumber(31)->setItemNumberError($rowContratante['validationCiiu']);
						$objRowRowClass->getItemRoByNumber(31)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(31)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(31)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(31)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(31)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(31)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(31);
						$arrFileRow['validationCiiu'] = $rowContratante['validationCiiu'];


						$arrFileRow['codigoCargo'] = $rowContratante['codigoCargo'];
						$objRowRowClass->getItemRoByNumber(32)->setElementValue($rowContratante['codigoCargo']);
						$objRowRowClass->getItemRoByNumber(32)->setItemNumberError($rowContratante['validationCargo']);
						$objRowRowClass->getItemRoByNumber(32)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(32)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(32)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(32)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(32)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(32)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(32);
						$arrFileRow['validationCargo'] = $rowContratante['validationCargo'];

						$arrFileRow['codigoZonaRegistral'] = $rowContratante['codigoZonaRegistral'];
						$objRowRowClass->getItemRoByNumber(33)->setElementValue($rowContratante['codigoZonaRegistral']);
						$objRowRowClass->getItemRoByNumber(33)->setItemNumberError($rowContratante['validationCodigoZonaRegistral']);
						$objRowRowClass->getItemRoByNumber(33)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(33)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(33)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(33)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(33)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(33)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(33);
						$arrFileRow['validationCodigoZonaRegistral'] = $rowContratante['validationCodigoZonaRegistral'];


						$arrFileRow['numeroPartidaRegistral'] = $rowContratante['numeroPartidaRegistral'];
						$objRowRowClass->getItemRoByNumber(34)->setElementValue($rowContratante['numeroPartidaRegistral']);
						$objRowRowClass->getItemRoByNumber(34)->setItemNumberError($rowContratante['validationNumeroPartidaRegistral']);
						$objRowRowClass->getItemRoByNumber(34)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(34)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(34)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(34)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(34)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(34)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(34);
						$arrFileRow['validationNumeroPartidaRegistral'] = $rowContratante['validationNumeroPartidaRegistral'];

						$arrFileRow['direccion'] =  strtoupper($this->remplace_string_ro($rowContratante['direccion']));
						

						$objRowRowClass->getItemRoByNumber(35)->setElementValue(strtoupper($this->remplace_string_ro($rowContratante['direccion'])));
						
						

						$objRowRowClass->getItemRoByNumber(35)->setItemNumberError($rowContratante['validationDireccion']);
						$objRowRowClass->getItemRoByNumber(35)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(35)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(35)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(35)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(35)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(35)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(35);
						$arrFileRow['validationDireccion'] = $rowContratante['validationDireccion'];


						$arrFileRow['departamento'] = $rowContratante['departamento'];
						$objRowRowClass->getItemRoByNumber(36)->setElementValue($rowContratante['departamento']);
						$objRowRowClass->getItemRoByNumber(36)->setItemNumberError($rowContratante['validationDepartamento']);
						$objRowRowClass->getItemRoByNumber(36)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(36)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(36)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(36)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(36)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(36)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(36);
						$arrFileRow['validationDepartamento'] = $rowContratante['validationDepartamento'];

						$arrFileRow['provincia'] = $rowContratante['provincia'];
						$objRowRowClass->getItemRoByNumber(37)->setElementValue($rowContratante['provincia']);
						$objRowRowClass->getItemRoByNumber(37)->setItemNumberError($rowContratante['validationProvincia']);
						$objRowRowClass->getItemRoByNumber(37)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(37)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(37)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(37)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(37)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(37)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(37);
						$arrFileRow['validationProvincia'] = $rowContratante['validationProvincia'];

						$arrFileRow['distrito'] = $rowContratante['distrito'];
						$objRowRowClass->getItemRoByNumber(38)->setElementValue($rowContratante['distrito']);
						$objRowRowClass->getItemRoByNumber(38)->setItemNumberError($rowContratante['validationDistrito']);
						$objRowRowClass->getItemRoByNumber(38)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(38)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(38)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(38)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(38)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(38)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(38);
						$arrFileRow['validationDistrito'] = $rowContratante['validationDistrito'];

						$arrFileRow['telefono'] = $rowContratante['telefono'];
						$objRowRowClass->getItemRoByNumber(39)->setElementValue($rowContratante['telefono']);
						$objRowRowClass->getItemRoByNumber(39)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(39)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(39)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(39)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(39)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(39)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(39)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(39);
						$arrFileRow['validationTelefono'] = 0;

						$objRowRowClass->getItemRoByNumber(40)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(41)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(42)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(42)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(43)->setKardex($kardex);

						$objRowRowClass->getItemRoByNumber(40)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(40)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(41)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(41)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(42)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(42)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(43)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(43)->setRowType(2);

						
						
						

						$arrFileRow['participacionConyuge'] = $rowContratante['participacionConyuge'];
						$participacionConyuge = $rowContratante['participacionConyuge'];
						$conyuge = $rowContratante['conyuge'];
							

						$sql = "SELECT contratantesxacto.idcontratante,cliente2.apepat AS apellidoPaternoConyuge,cliente2.apemat AS apellidoMaternoConyuge,CONCAT(cliente2.prinom,' ',cliente2.segnom ) AS  nombresConyuge FROM contratantesxacto LEFT JOIN cliente2 ON  contratantesxacto.idcontratante = cliente2.idcontratante WHERE cliente2.idcliente='$conyuge' AND (contratantesxacto.uif = 'B' OR contratantesxacto.uif = 'O' OR contratantesxacto.uif = 'G' OR contratantesxacto.uif = 'F' OR contratantesxacto.uif = 'N' AND contratantesxacto.uif = 'R') AND (contratantesxacto.kardex='$kardex' AND contratantesxacto.idtipoacto='$tipoActoMedioPago')";

						$resultConyuge = mysql_query($sql);
						if(mysql_affected_rows() != 0 && $rowContratante['uif'] != 'R'){
							$rowConyuge = mysql_fetch_assoc($resultConyuge);
							$arrFileRow['apellidoPaternoConyuge'] = strtoupper($this->remplace_string_ro($rowConyuge['apellidoPaternoConyuge']));
							$arrFileRow['apellidoMaternoConyuge'] = strtoupper($this->remplace_string_ro($rowConyuge['apellidoMaternoConyuge']));	
							$arrFileRow['nombresConyuge'] = strtoupper($this->remplace_string_ro($rowConyuge['nombresConyuge']));
							$arrFileRow['validationParticipacionConyuge'] = 0;
							$arrFileRow['validationPaternoConyuge'] = 0;
							$arrFileRow['validationMaternoConyuge'] = 0;
							$arrFileRow['validationnombreConyuge'] = 0;
							$objRowRowClass->getItemRoByNumber(40)->setElementValue('S');
							$objRowRowClass->getItemRoByNumber(40)->setItemNumberError(0);
							$objRowRowClass->getItemRoByNumber(41)->setItemNumberError(0);
							$objRowRowClass->getItemRoByNumber(42)->setItemNumberError(0);
							$objRowRowClass->getItemRoByNumber(43)->setItemNumberError(0);
							
							$objRowRowClass->getItemRoByNumber(41)->setElementValue(strtoupper($this->remplace_string_ro($rowConyuge['apellidoPaternoConyuge'])));
							$objRowRowClass->getItemRoByNumber(42)->setElementValue(strtoupper($this->remplace_string_ro($rowConyuge['apellidoMaternoConyuge'])));
							$objRowRowClass->getItemRoByNumber(43)->setElementValue(strtoupper($this->remplace_string_ro($rowConyuge['nombresConyuge'])));
							/*
							$objRowRowClass->getItemRoByNumber(41)->setElementValue('');
							$objRowRowClass->getItemRoByNumber(42)->setElementValue('');
							$objRowRowClass->getItemRoByNumber(43)->setElementValue('');*/

						}else{
							$arrFileRow['validationParticipacionConyuge'] = 40;
							$arrFileRow['validationPaternoConyuge'] = 41;
							$arrFileRow['validationMaternoConyuge'] = 42;
							$arrFileRow['validationnombreConyuge'] = 43;
							$objRowRowClass->getItemRoByNumber(40)->setElementValue('N');
							$objRowRowClass->getItemRoByNumber(40)->setItemNumberError(0);
							$objRowRowClass->getItemRoByNumber(41)->setItemNumberError(0);
							$objRowRowClass->getItemRoByNumber(42)->setItemNumberError(0);
							$objRowRowClass->getItemRoByNumber(43)->setItemNumberError(0);
							$objRowRowClass->getItemRoByNumber(41)->setElementValue('');
							$objRowRowClass->getItemRoByNumber(42)->setElementValue('');
							$objRowRowClass->getItemRoByNumber(43)->setElementValue('');
						}
							
						

						if($objRowRowClass->getItemRoByNumber(40)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(40);
						if($objRowRowClass->getItemRoByNumber(41)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(41);
						if($objRowRowClass->getItemRoByNumber(42)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(42);
						if($objRowRowClass->getItemRoByNumber(43)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(43);

						$arrFileRow['codigoTipoFondo']  = '';
						$objRowRowClass->getItemRoByNumber(44)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(44)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(44)->setKardex($kardex);
						if($objRowRowClass->getItemRoByNumber(44)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(44);
						$arrFileRow['validationTipoFondo'] = 0;


						$arrFileRow['tipoOperacion'] = $tipoOperacion;
						$objRowRowClass->getItemRoByNumber(45)->setElementValue($tipoOperacion);
						$objRowRowClass->getItemRoByNumber(45)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(45)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(45)->setKardex($kardex);
						if($objRowRowClass->getItemRoByNumber(45)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(45);

						$arrFileRow['codigoFormaPago'] = '';
						$objRowRowClass->getItemRoByNumber(46)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(46)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(46)->setKardex($kardex);
						if($objRowRowClass->getItemRoByNumber(46)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(46);
						$arrFileRow['validationFormaPago'] = 0;

						$arrFileRow['oportunidadPago'] = '';
						$objRowRowClass->getItemRoByNumber(47)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(47)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(47)->setKardex($kardex);
						if($objRowRowClass->getItemRoByNumber(47)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(47);
						$arrFileRow['validationOportunidadPago'] = 0;

						$arrFileRow['descripcionOportunidadPago'] = '';
						$objRowRowClass->getItemRoByNumber(48)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(48)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(48)->setKardex($kardex);
						if($objRowRowClass->getItemRoByNumber(48)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(48);
						$arrFileRow['validationDescripcionOportunidadPago'] = 0;

						$arrFileRow['origenFondo']  = strtoupper($this->remplace_string_ro($rowContratante['origenFondo']));
						$objRowRowClass->getItemRoByNumber(49)->setElementValue(strtoupper($this->remplace_string_ro($rowContratante['origenFondo'])));
						$objRowRowClass->getItemRoByNumber(49)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(49)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(49)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(49)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(49)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(49);

						
						$monedaOperacionContratante = $rowContratante['representante'] == 'R'?'':$monedaOperacion;

						$arrFileRow['monedaOperacion'] = $monedaOperacionContratante ;
						$objRowRowClass->getItemRoByNumber(50)->setElementValue($monedaOperacionContratante );
						$objRowRowClass->getItemRoByNumber(50)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(50)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(50)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(50)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(50)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(50);

						$arrFileRow['montoOperacion'] = '0.00';
						$objRowRowClass->getItemRoByNumber(51)->setElementValue('0.00');
						$objRowRowClass->getItemRoByNumber(51)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(51)->setKardex($kardex);
						//$objRowRowClass->getItemRoByNumber(51)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(51)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(51)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(51);
						$arrFileRow['validationMontoOperacion'] = 0;

						$arrFileRow['montoPorParticipante'] = $rowContratante['montoPorParticipante'];
						#validaciones extras
						$montoParticipante = $rowContratante['montoPorParticipante'];
						$valMontoParticipante = $rowContratante['validationMontoPorParticipante'];
						$descriptionElement = ',codigo de  moneda no se debe informar sin montos';
						if($idMoneda != 0 && ($montoParticipante === '0.00' or $montoParticipante === '') && ($rowContratante['personaAFavor'] =! '') && ($rowContratante['personaOperacion'] != '')){
							$valMontoParticipante = 52;
							//die('ohola'.$kardex.'-'.$rowContratante['contratante']);
							$objRowRowClass->getItemRoByNumber(52)->setDescriptionElement($descriptionElement);
							
						}
						#Fin validaciones extras
						$objRowRowClass->getItemRoByNumber(52)->setElementValue($rowContratante['montoPorParticipante']);
						$objRowRowClass->getItemRoByNumber(52)->setItemNumberError($valMontoParticipante);
						$objRowRowClass->getItemRoByNumber(52)->setIdKardex($idKardex);
						$objRowRowClass->getItemRoByNumber(52)->setKardex($kardex);
						$objRowRowClass->getItemRoByNumber(52)->setDetailsError($rowContratante['contratante']);
						$objRowRowClass->getItemRoByNumber(52)->setRowType(2);
						$objRowRowClass->getItemRoByNumber(52)->setAct($act);
						if($objRowRowClass->getItemRoByNumber(52)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(52);
						$arrFileRow['validationMontoPorParticipante'] = $rowContratante['validationMontoPorParticipante'];

						$arrFileRow['montoTipoFondo'] = '0.00';
						$objRowRowClass->getItemRoByNumber(53)->setElementValue('0.00');
						$objRowRowClass->getItemRoByNumber(53)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(53)->setKardex($kardex);
						if($objRowRowClass->getItemRoByNumber(53)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(53);
						$arrFileRow['validationMontoTipoFondo'] = 0;

						$arrFileRow['tipoCambio'] = '0.00';
						$objRowRowClass->getItemRoByNumber(54)->setElementValue('0.00');
						$objRowRowClass->getItemRoByNumber(54)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(54)->setKardex($kardex);
						if($objRowRowClass->getItemRoByNumber(54)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(54);

						$arrFileRow['inscripcionRegistralBien'] = '';
						$objRowRowClass->getItemRoByNumber(55)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(55)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(55)->setKardex($kardex);
						if($objRowRowClass->getItemRoByNumber(55)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(55);

						$arrFileRow['zonaRegistralBien'] = '';
						$objRowRowClass->getItemRoByNumber(56)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(56)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(56)->setKardex($kardex);
						if($objRowRowClass->getItemRoByNumber(56)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(56);

						$arrFileRow['numeroPartidaRegistralBien'] = '';
						$objRowRowClass->getItemRoByNumber(57)->setElementValue('');
						$objRowRowClass->getItemRoByNumber(57)->setItemNumberError(0);
						$objRowRowClass->getItemRoByNumber(57)->setKardex($kardex);
						if($objRowRowClass->getItemRoByNumber(57)->getItemNumberError() != 0)
						$arrObjItemRo[] = $objRowRowClass->getItemRoByNumber(57);

						$arrFileRow['tipoFila'] = 0;

						$arrRo[] = $arrFileRow;

						$this->_arrObjRo[] = $objRowRowClass;	

					}
				}else{
					$registrationNumberOperation = $registrationNumberOperation - 1;
				}	




			}


			$keyArrError = $kardex.'-'.$codAct;
			$arrErrors[$keyArrError] = $arrObjItemRo;
			$this->_dataKardex[] = $row;
			
		}

		$this->_arrErrorsRo = $arrErrors;

	}

	public function  generateDataByYearUnderUmbral(){
		$sql = "SELECT  numberMonth,monthExchangeRate,yearMonth FROM exchange_rate  WHERE yearMonth = '$this->_year'  ORDER BY numberMonth ";

		
		//die($sql);
		$result = mysql_query($sql);

		$array = array();
		while($row = mysql_fetch_assoc($result)){
			$exchangeRate = $row['monthExchangeRate'];

			$month = $row['numberMonth'];
			$row['nameMonth'] = ClaseNumeroLetra::fun_mes($row['numberMonth']);
			$sql = "SELECT ro.idRo,ro.idKardex,ro.kardex,ro.idTipoKardex,ro.tipo AS tipoEnvio,ro.tipoInstumentoPublicoNotarial AS IPNP,ro.codActos,ro.uif,
			ro.uif AS tipoOperacion,tiposdeacto.desacto AS act,
			ro.fechaEscritura,
			patrimonial.idmon AS idMoneda ,
			monedas.codigo AS monedaOperacion,
			patrimonial.importetrans AS montoTotalOperacion
			FROM  ro 
			LEFT JOIN patrimonial ON  ro.kardex = patrimonial.kardex AND ro.codActos = patrimonial.idtipoacto
			LEFT JOIN monedas ON patrimonial.idmon = monedas.idmon
			LEFT JOIN fpago_uif ON patrimonial.fpago = fpago_uif.id_fpago 
			LEFT JOIN tiposdeacto ON tiposdeacto.idtipoacto = patrimonial.idtipoacto 
			WHERE (patrimonial.idmon = 1 AND (2500*3)>patrimonial.importetrans AND  MONTH(ro.fechaEscritura) = '$month' AND YEAR(ro.fechaEscritura) = '$this->_year'  AND patrimonial.importetrans != 0.00) 
			 OR (patrimonial.idmon = 2 AND (2500)>patrimonial.importetrans AND MONTH(ro.fechaEscritura) = '$month' AND YEAR(ro.fechaEscritura) = '$this->_year' AND patrimonial.importetrans != 0.00) ";

		

			$result1  = mysql_query($sql);
			$totalOperations = mysql_affected_rows();
			$sumAmountOperations = 0;
			while($row1 = mysql_fetch_assoc($result1)){
				$kardex = $row1['kardex'];
				$codAct = $row1['codActos'];
				$montoOperacion = $row1['montoTotalOperacion'];
				$idMoneda = $row1['idMoneda'];
				if($idMoneda == 1){
					$montoOperacion = ($montoOperacion/$exchangeRate);
				}
				$sumAmountOperations = $sumAmountOperations + $montoOperacion;
			}
			$row['totalAmount'] = $sumAmountOperations;
			$row['totalOperations'] = $totalOperations;
			$array[] = $row;
		}

		return  $array;
	}

	public function getTotalKardexUmbral(){
		return $this->_totalKardexUmbral;
	}
	public function  getTotalAmountOperationUmbral(){
		return  $this->_totalAmountOperationUmbral;
	}

	public function getListErrors(){
		return $this->_arrErrorsRo;

	}
	public function  getCountErrors(){
		$countErrors = 0;
		foreach ($this->_arrErrorsRo as $key => $row) {
			$countErrors = $countErrors + count($this->_arrErrorsRo[$key]);
		}
		return $countErrors;
	}
	public function getListData(){
		return $this->_arrObjRo;
	}
	public function  getTotalKardex(){
		return  $this->_totalKardex;
	}

	public function  getDataKArdex(){
		return $this->_dataKardex;
	}

	public function generateFileRo(){
		$sql = "SELECT  idnotar AS idNotario,nombre AS nombreNotario, apellido AS apellidosNotario,CONCAT(nombre,' ',apellido)AS notario,telefono AS telefonoNotario,correo AS correoNotario, ruc AS rucNotario, direccion AS direccionNotario, distrito  AS distritoNotario, codnotario AS codigoNotario,codoficial AS codigoOficial, coduif AS codigoUif  FROM confinotario";

		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);

		$idNotario = $row['idNotario'];
		$nombreNotario = $row['nombreNotario'];
		$apellidoNotario = $row['apellidosNotario'];
		$telefonoNotario = $row['telefonoNotario'];
		$rucNotario = $row['rucNotario'];
		$direccionNotario = $row['direccionNotario'];
		$distritoNotario = $row['distritoNotario'];
		$codigoNotario = $row['codigoNotario'];

		$codigoOficial = str_pad($row['codigoOficial'],11,"0",STR_PAD_LEFT);
		$codigoUif = str_pad($row['codigoUif'],9,"0",STR_PAD_LEFT);

		$codidoUifExtension = $row['codigoUif'];

		$arrFinalDate = explode ('/', $this->_finalDate);
		$year = $arrFinalDate[2];
		$yearNameFile = substr($year,2,2);
		$month = $arrFinalDate[1];
		$day =  $arrFinalDate[0];
		$nameFile = "04".$yearNameFile.$month.$day."501.".$codidoUifExtension;

		$codeFormat = '0501';
		$annexCode = '04';
		$emptyHeaderFile = str_pad('',5," ");
		$dateHeaderFile = $year.$month.$day;
		$codeExpressionAmounts = '012';
		$controlData = str_pad('',15," ");

		$headerFile = $codeFormat.$annexCode.$emptyHeaderFile.$dateHeaderFile.$codeExpressionAmounts.$controlData.$codigoUif.$codigoOficial;
		
		header('Content-Type:text/plain');
		header('Content-Type: application/force-download');
		header('Pragma:public');
		header('Expires:0');
		header('Cache-Control:no-cache,must-revalidate,post-check=0,pre-check=0');
		header('Cache-Control:private,false');
		header('Content-Disposition: attachment; filename='.$nameFile);
		header('Content-Transfer-Encoding: utf8');

		echo    str_pad($headerFile,57," ",STR_PAD_LEFT).chr(13).chr(10);

		foreach ($this->_arrObjRo   as $objRo) {

			   echo str_pad(substr($objRo->getItemRoByNumber(1)->getElementValue(),0,8),8," ",STR_PAD_LEFT).	
				str_pad(substr($objRo->getItemRoByNumber(2)->getElementValue(),0,8) ,8," ",STR_PAD_LEFT).		
				str_pad(substr($objRo->getItemRoByNumber(3)->getElementValue(),0,1),1," ",STR_PAD_LEFT).		
				str_pad(substr($objRo->getItemRoByNumber(4)->getElementValue(),0,2),2," ",STR_PAD_RIGHT).		
				str_pad(substr($objRo->getItemRoByNumber(5)->getElementValue(),0,6),6," ",STR_PAD_RIGHT).		
				str_pad(substr($objRo->getItemRoByNumber(6)->getElementValue(),0,8),8," ",STR_PAD_LEFT).					
				str_pad(substr($objRo->getItemRoByNumber(7)->getElementValue(),0,6),6," ",STR_PAD_LEFT).		
				str_pad(substr($objRo->getItemRoByNumber(8)->getElementValue(),0,8),8," ",STR_PAD_LEFT).	
				str_pad(substr($objRo->getItemRoByNumber(9)->getElementValue(),0,1),1," ",STR_PAD_LEFT).	
				str_pad(substr($objRo->getItemRoByNumber(10)->getElementValue(),0,8),8," ",STR_PAD_LEFT).
				str_pad(substr($objRo->getItemRoByNumber(11)->getElementValue(),0,1),1," ",STR_PAD_LEFT).
				str_pad(substr($objRo->getItemRoByNumber(12)->getElementValue(),0,4),4," ",STR_PAD_LEFT).
				str_pad(substr($objRo->getItemRoByNumber(13)->getElementValue(),0,1),1," ",STR_PAD_LEFT).
				str_pad(substr($objRo->getItemRoByNumber(14)->getElementValue(),0,1),1," ",STR_PAD_LEFT).	
				str_pad(substr($objRo->getItemRoByNumber(15)->getElementValue(),0,1),1," ",STR_PAD_LEFT).	
				str_pad(substr($objRo->getItemRoByNumber(16)->getElementValue(),0,1),1," ",STR_PAD_LEFT).
				str_pad(substr($objRo->getItemRoByNumber(17)->getElementValue(),0,1),1," ",STR_PAD_LEFT).
				str_pad(substr($objRo->getItemRoByNumber(18)->getElementValue(),0,1),1," ",STR_PAD_LEFT).		
				str_pad(substr($objRo->getItemRoByNumber(19)->getElementValue(),0,1),1," ",STR_PAD_LEFT).	
				str_pad(substr($objRo->getItemRoByNumber(20)->getElementValue(),0,1),1," ",STR_PAD_LEFT).
				str_pad(substr($objRo->getItemRoByNumber(21)->getElementValue(),0,20),20," ",STR_PAD_RIGHT).
				str_pad(substr($objRo->getItemRoByNumber(22)->getElementValue(),0,11),11," ",STR_PAD_LEFT).		
				str_pad(substr($this->remplace_string_ro($objRo->getItemRoByNumber(23)->getElementValue()),0,120),120," ",STR_PAD_RIGHT).	
				str_pad(substr($this->remplace_string_ro($objRo->getItemRoByNumber(24)->getElementValue(),1),0,40),40," ",STR_PAD_RIGHT).
				str_pad(substr($this->remplace_string_ro($objRo->getItemRoByNumber(25)->getElementValue(),1),0,40),40," ",STR_PAD_RIGHT).	   
				str_pad(substr($objRo->getItemRoByNumber(26)->getElementValue(),0,2),2," ",STR_PAD_LEFT).		
				str_pad(substr($objRo->getItemRoByNumber(27)->getElementValue(),0,8),8," ",STR_PAD_LEFT).
				str_pad(substr($objRo->getItemRoByNumber(28)->getElementValue(),0,1),1," ",STR_PAD_LEFT).
				str_pad(substr($objRo->getItemRoByNumber(29)->getElementValue(),0,3),3," ",STR_PAD_LEFT).	
				str_pad(substr($this->remplace_string_ro($objRo->getItemRoByNumber(30)->getElementValue(),1),0,40),40," ",STR_PAD_RIGHT).
				str_pad(substr($objRo->getItemRoByNumber(31)->getElementValue(),0,4),4," ",STR_PAD_LEFT).
				str_pad(substr($objRo->getItemRoByNumber(32)->getElementValue(),0,3),3," ",STR_PAD_LEFT).
				str_pad(substr($objRo->getItemRoByNumber(33)->getElementValue(),0,2),2," ",STR_PAD_LEFT).
				str_pad(substr($objRo->getItemRoByNumber(34)->getElementValue(),0,12),12," ",STR_PAD_LEFT).	
				str_pad(substr($this->remplace_string_ro($objRo->getItemRoByNumber(35)->getElementValue(),1),0,150),150," ",STR_PAD_RIGHT).	
				str_pad(substr($objRo->getItemRoByNumber(36)->getElementValue(),0,2),2," ",STR_PAD_LEFT).		
				str_pad(substr($objRo->getItemRoByNumber(37)->getElementValue(),0,2),2," ",STR_PAD_LEFT).
				str_pad(substr($objRo->getItemRoByNumber(38)->getElementValue(),0,2),2," ",STR_PAD_LEFT).
				str_pad(substr($objRo->getItemRoByNumber(39)->getElementValue(),0,40),40," ",STR_PAD_RIGHT).
				str_pad(substr($objRo->getItemRoByNumber(40)->getElementValue(),0,1),1," ",STR_PAD_LEFT).
				str_pad(substr($objRo->getItemRoByNumber(41)->getElementValue(),0,40),40," ",STR_PAD_RIGHT).					
				str_pad(substr($objRo->getItemRoByNumber(42)->getElementValue(),0,40),40," ",STR_PAD_RIGHT).					
				str_pad(substr($objRo->getItemRoByNumber(43)->getElementValue(),0,40),40," ",STR_PAD_RIGHT).					
				str_pad(substr($objRo->getItemRoByNumber(44)->getElementValue(),0,2),2," ",STR_PAD_LEFT).		
				str_pad(substr($objRo->getItemRoByNumber(45)->getElementValue(),0,3),3," ",STR_PAD_LEFT).		
				str_pad(substr($objRo->getItemRoByNumber(46)->getElementValue(),0,1),1," ",STR_PAD_LEFT).		
				str_pad(substr($objRo->getItemRoByNumber(47)->getElementValue(),0,2),2," ",STR_PAD_LEFT).	
				str_pad(substr($objRo->getItemRoByNumber(48)->getElementValue(),0,40),40," ",STR_PAD_RIGHT).		
				str_pad(substr($objRo->getItemRoByNumber(49)->getElementValue(),0,40),40," ",STR_PAD_RIGHT).				
				str_pad(substr($objRo->getItemRoByNumber(50)->getElementValue(),0,3),3," ",STR_PAD_LEFT).		
				str_pad(substr($objRo->getItemRoByNumber(51)->getElementValue(),0,18),18," ",STR_PAD_LEFT).	
				str_pad(substr($objRo->getItemRoByNumber(52)->getElementValue(),0,18),18," ",STR_PAD_LEFT).		
				str_pad(substr($objRo->getItemRoByNumber(53)->getElementValue(),0,18),18," ",STR_PAD_LEFT).		
				str_pad(substr($objRo->getItemRoByNumber(54)->getElementValue(),0,6),6," ",STR_PAD_LEFT).			
				str_pad(substr($objRo->getItemRoByNumber(55)->getElementValue(),0,1),1," ",STR_PAD_LEFT).		
				str_pad(substr($objRo->getItemRoByNumber(56)->getElementValue(),0,2),2," ",STR_PAD_LEFT).		
				str_pad(substr($objRo->getItemRoByNumber(57)->getElementValue(),0,12),12," ",STR_PAD_LEFT).chr(13).chr(10);		

				


		}
	}

	public function remplace_string_ro($valueString,$typePerson = 1){
		if($typePerson == 1){
			$valueString = str_replace('"', '', $valueString);
			$valueString = str_replace('$', '', $valueString);
			$valueString = str_replace('&', '', $valueString);
			$valueString = str_replace('@', '', $valueString);
			$valueString = str_replace('/', '', $valueString);
			$valueString = str_replace('(', '', $valueString);
			$valueString = str_replace(')', '', $valueString);
			$valueString = str_replace('.', '', $valueString);
			$valueString = str_replace(',', '', $valueString);
			$valueString = str_replace(';', '', $valueString);
		}
		$valueString = str_replace("Ã¡","A", $valueString);
	    $valueString = str_replace("Ã©","E", $valueString);
	    $valueString = str_replace("Ã­","I", $valueString);
	    $valueString = str_replace("ï¿½","I",$valueString);
	    $valueString = str_replace("Ã³","O", $valueString);
	    $valueString = str_replace("Ãº","U", $valueString);
	    $valueString = str_replace("n~","#", $valueString);
	    $valueString = str_replace("ÃƒÂ¡","A", $valueString);
	    $valueString = str_replace("Ã±","#", $valueString);
	    $valueString = str_replace("Ã'","#", $valueString);
	    $valueString = str_replace("ÃƒÂ±","#", $valueString);
	    $valueString = str_replace("n~","#", $valueString);
	    $valueString = str_replace("Ãš","U", $valueString);
	    $valueString = str_replace("Ã?","#", $valueString);
		$valueString = str_replace("Ã??","#", $valueString);
		$valueString = str_replace("À?","#", $valueString);
		$valueString = str_replace("À‘","#", $valueString);
		$valueString = str_replace("À‘","#", $valueString);
		$valueString = str_replace("Ã‘","#", $valueString);
		$valueString = str_replace("ã¡","A", $valueString);
	    $valueString = str_replace("ã©","E", $valueString);
	    $valueString = str_replace("ã­","I", $valueString);
	    $valueString = str_replace("ï¿½","I", $valueString);
	    $valueString = str_replace("ã³","O", $valueString);
	    $valueString = str_replace("ãº","U", $valueString);
	    $valueString = str_replace("n~","#", $valueString);
	    $valueString = str_replace("ãƒÂ¡","A", $valueString);
	    $valueString = str_replace("ã±","#", $valueString);
	    $valueString = str_replace("Ã'","#", $valueString);
	    $valueString = str_replace("ãƒÂ±","#", $valueString);
	    $valueString = str_replace("n~","#", $valueString);
	    $valueString = str_replace("ãš","Ú", $valueString);
	    $valueString = str_replace("ã?","#", $valueString);
		$valueString = str_replace("ã??","#", $valueString);
		$valueString = str_replace("À?","#", $valueString);
		$valueString = str_replace("À‘","#", $valueString);
		$valueString = str_replace("Ã?","#", $valueString);
		$valueString = str_replace("ã‘","#", $valueString);
		$valueString = str_replace("*","&", $valueString);
		$valueString = str_replace("ÃŠ","U", $valueString);
		$valueString = str_replace("*","", $valueString);
		$valueString = str_replace("AÂ","A", $valueString);
		$valueString = str_replace("ÁÂ","A", $valueString);
		$valueString = str_replace("IÂ","I", $valueString);
		$valueString = str_replace("Ã‘","#", $valueString);

	    $valueString = str_replace("º","", $valueString);
	    $valueString = str_replace("Nº","Nro", $valueString);
		$valueString = str_replace("|","", $valueString);	
		$valueString = str_replace("N°","", $valueString);
		$valueString = str_replace('1°',"1", $valueString);
		$valueString = str_replace('2°',"2", $valueString);
		$valueString = str_replace('3°',"3", $valueString);
		$valueString = str_replace('4°',"4", $valueString);
		$valueString = str_replace('5°',"5", $valueString);
		$valueString = str_replace('6°',"6", $valueString);
		$valueString = str_replace('7°',"7", $valueString);
		$valueString = str_replace('8°',"8", $valueString);
		$valueString = str_replace('9°',"9", $valueString);
		$valueString = str_replace('0°',"0", $valueString);
		$valueString = str_replace('´',"", $valueString);
		$valueString = str_replace(' °',"", $valueString);
		$valueString = str_replace('°',"", $valueString);

		$valueString = str_replace('¿',"", $valueString);
		$valueString = str_replace('?',"", $valueString);
		$valueString = str_replace('-',"", $valueString);

		$valueString = str_replace(array('á','à','â','ã','ª','ä'),"a",$valueString);
		$valueString = str_replace(array('Á','À','Â','Ã','Ä'),"A",$valueString);
		$valueString = str_replace(array('Í','Ì','Î','Ï'),"I",$valueString);
		$valueString = str_replace(array('í','ì','î','ï'),"i",$valueString);
		$valueString = str_replace(array('é','è','ê','ë'),"e",$valueString);
		$valueString = str_replace(array('É','È','Ê','Ë'),"E",$valueString);
		$valueString = str_replace(array('ó','ò','ô','õ','ö','º'),"o",$valueString);
		$valueString = str_replace(array('Ó','Ò','Ô','Õ','Ö'),"O",$valueString);
		$valueString = str_replace(array('ú','ù','û','ü'),"u",$valueString);
		$valueString = str_replace(array('Ú','Ù','Û','Ü'),"U",$valueString);
		$valueString = str_replace(array('ñ','Ñ'), '#', $valueString);
		return $valueString;

	}

		



}

