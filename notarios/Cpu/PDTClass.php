<?php
include_once '../conexion.php';
include_once 'ActFilePdt.php';
include_once 'BienFilePdt.php';
include_once 'ItemClass.php';
include_once 'OtorganteFilePdt.php';
include_once 'MedioFilePdt.php';
include_once 'FormFilePdt.php';
include_once 'LibFilePdt.php';
class PDTClass {

	private $_initialDate;
	private $_finalDate;
	private $_fkTypeKardex;
	private $_totalKardex;
	private $_arrObjActFilePdt = array();
	private $_arrObjBienFilePdt = array();
	private $_arrObjOtorganteFilePdt = array();
	private $_arrObjMedioFilePdt = array();
	private $_arrObjFormFilePdt = array();
	private $_arrErrorKardex = array();
	private $_arrErrorItems = array();
	private $_arrErrorsPdt = array();
	private $_arrObjLibFilePdt = array();
    private $_totalLibro;


	public function initialData(){
		//$this->_initialDate = $initialDate;
		//$this->_finalDate = $finaleDate;
		//$this->_fkTypeKardex = $fkTypeKardex;
		$this->_totalKardex = 0;
		$sql = "TRUNCATE pdt";
		$result = mysql_query($sql);
		$sql = "TRUNCATE temp_act";
		$result = mysql_query($sql);
		$sql = "SELECT DISTINCT kardex.codactos , kardex.idkardex ,  kardex.kardex, kardex.idtipkar, kardex.numescritura , kardex.fechaescritura , kardex.fechaconclusion  FROM kardex WHERE kardex.idtipkar = '$this->_fkTypeKardex' AND STR_TO_DATE(kardex.fechaconclusion,'%d/%m/%Y') 
				BETWEEN STR_TO_DATE('$this->_initialDate','%d/%m/%Y') AND STR_TO_DATE('$this->_finalDate','%d/%m/%Y') ORDER BY kardex.kardex ASC";
				
		///die($sql);
		$result = mysql_query($sql);
		$totalKardex = mysql_affected_rows();
		$affectedRowPdt = 0;
		while($row = mysql_fetch_assoc($result)){
			$idKardex = $row['idkardex'];
			$codActos = $row['codactos'];
			$kardex = $row['kardex'];
			$idTipoKardex = $row['idtipkar'];
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
				$sql = "SELECT idtipoacto,actosunat,actouif,idtipkar,desacto,umbral,impuestos,idcalnot,idecalreg,idmodelo,rol_part from tiposdeacto WHERE idtipoacto = '$codActo' and actosunat <> '' AND (actosunat = '01' OR actosunat = '02' OR actosunat = '03' 
								OR actosunat = '04' OR actosunat = '06' OR actosunat = '07' OR actosunat = '08'
								OR actosunat = '09' OR actosunat = '10' OR actosunat = '11' OR actosunat = '12' OR actosunat = '13'
								OR actosunat = '14' OR actosunat = '15' OR actosunat = '16' OR actosunat = '17' OR actosunat = '18'
								OR actosunat = '19' OR actosunat = '20' OR actosunat = '21' OR actosunat = '22' OR actosunat = '23'
								OR actosunat = '24' OR actosunat = '25' OR actosunat = '26')";

				$resultTipoActo = mysql_query($sql);
				$rowTipoActo = mysql_fetch_assoc($resultTipoActo);
				if($rowTipoActo){
					$idTipoActo = $rowTipoActo['idtipoacto'];
					$actoSunat = $rowTipoActo['actosunat'];
					$sql = "INSERT INTO pdt(idkardex, kardex, idTipoKardex, codActos, actoSunat, numeroEscritura, fechaEscritura, fechaConclusion) VALUES ('$idKardex','$kardex','$idTipoKardex','$idTipoActo','$actoSunat','$numeroEscritura','$fechaEscritura','$fechaConclusion')";
					//die($sql);
					$resultPdt = mysql_query($sql);
					if(mysql_affected_rows() == 1){
						$affectedRowPdt++;
					}
				}

			}
		}	
	}



	public function setInitialDate($value){
		$this->_initialDate = $value;
	}
	public function setFinalDate($value){
		$this->_finalDate = $value;
	}
	public function setFkTypeKardex($value){
		$this->_fkTypeKardex = $value;
	}

	public function loadDataLibros(){
		

	}

	public function  getDataByActSunat($fieldNumber, $value){
		
	}

	public function  loadDataAct(){
		$sql = "SELECT pdt.idPdt,pdt.idKardex,pdt.kardex,pdt.idTipoKardex,pdt.codActos,pdt.actoSunat,pdt.numeroEscritura,pdt.fechaEscritura,STR_TO_DATE(pdt.fechaConclusion,'%d/%m/%Y') AS fechaConclusionFormato,IF(pdt.fechaEscritura<=STR_TO_DATE(pdt.fechaConclusion,'%d/%m/%Y'),0,1) AS validationFechaEscritura,pdt.fechaConclusion,
			patrimonial.itemmp, patrimonial.idmon,patrimonial.nminuta AS fechaInscripcionMinuta,patrimonial.importetrans,
			tiposdeacto.desacto AS acto ,patrimonial.exhibiomp AS exhibioMp,patrimonial.tipocambio,patrimonial.idtipoacto AS idTipoActo   FROM pdt INNER JOIN patrimonial  ON pdt.kardex = patrimonial.kardex 	LEFT JOIN tiposdeacto ON tiposdeacto.idtipoacto = patrimonial.idtipoacto 
			WHERE pdt.kardex = patrimonial.kardex AND pdt.codactos = patrimonial.idtipoacto ORDER BY CAST(pdt.numeroEscritura AS UNSIGNED) ASC";


		//die($sql);

				

		$arrActs = array('10','04','24','26');	
		$result = mysql_query($sql);
		$arrErrors = array();
		//$arrObjRowActFile = array();
		$this->_totalKardex = mysql_affected_rows();
		$numeroSecuencial = 0;

		while($row = mysql_fetch_assoc($result)){

			$arrObjRowActFile = array();
			$idPdt  = $row['idPdt'];
			$kardex = $row['kardex'];
			$idKardex = $row['idKardex'];
			$idTipoKardex = $row['idTipoKardex'];
			$codAct = $row['codActos'];
			$acto = $row['acto'];
			$actoSunat = $row['actoSunat'];
			$numeroEscritura = (int) $row['numeroEscritura'];
			$fechaEscritura = $row['fechaEscritura'];
			$fechaConclusion = $row['fechaConclusion'];
			$fechaInscripcionMinuta = $row['fechaInscripcionMinuta'];
			$itemmp = $row['itemmp'];
			$idMoneda = $row['idmon'];
			$tipoCambio = $row["tipocambio"];
			$importe = $row['importetrans'];
			$exhibioMp = $row['exhibioMp'];
			$validationFechaEscritura = $row['validationFechaEscritura'];
			$numeroSecuencial++;


			$objRowActFilePdt = new ActFilePdt();
			//$objRowActFilePdt->setIdKardex($idKardex);
			//$objRowActFilePdt->setKardex($kardex);

			#VALIDANDO TIPO DE KARDEX
			if($idTipoKardex == 1){
				$tipoKardex = 1;
			}else if($idTipoKardex == 3){
				$tipoKardex = 2;
			}else if($idTipoKardex == 4){
				$tipoKardex = 5;
			}
			$objRowActFilePdt->getItem('tipoKardex')->setItemValue($tipoKardex);
			#FIN DE VALIDACION DE TIPO DE KARDEX


			 #Validando  numero de escritura
			$objRowActFilePdt->getItem('numeroEscritura')->setItemValue($numeroEscritura);
			if($numeroEscritura == 0){

				$objRowActFilePdt->getItem('numeroEscritura')->setKardex($kardex);
				$objRowActFilePdt->getItem('numeroEscritura')->setIdKardex($idKardex);
				$objRowActFilePdt->getItem('numeroEscritura')->setAct($acto);
				$objRowActFilePdt->getItem('numeroEscritura')->setErrorItem('Numero de escritura no puedo ser cero.');
				$arrObjRowActFile[] = $objRowActFilePdt->getItem('numeroEscritura');
			}
			#Validando fecha de escritura

			#Validando la fecha de conclusion
			$arrFechaEscritura = explode('-', $fechaEscritura);
			$intFechaEscritura = intval($arrFechaEscritura[0].$arrFechaEscritura[1].$arrFechaEscritura[2]);
			$formatFechaEscritura = $arrFechaEscritura[2].'/'.$arrFechaEscritura[1].'/'.$arrFechaEscritura[0];
			
			#SI ES GARANTIA RESETEAMOS FECHA DE ESCRITURA Y CONCLUSION
			if($tipoKardex == 5){
				$objRowActFilePdt->getItem('fechaEscritura')->setItemValue('');
				$objRowActFilePdt->getItem('fechaConclusion')->setItemValue('');
				$objRowActFilePdt->getItem('fechaLegalizacion')->setItemValue($formatFechaEscritura);
			}else{
				$objRowActFilePdt->getItem('fechaEscritura')->setItemValue($formatFechaEscritura);
				$objRowActFilePdt->getItem('fechaConclusion')->setItemValue($fechaConclusion);
				$objRowActFilePdt->getItem('fechaLegalizacion')->setItemValue('');
			}
		
			
			$arrFechaConclusion = explode('/', $fechaConclusion);
			$intFechaConclusion = intval($arrFechaConclusion[2].$arrFechaConclusion[1].$arrFechaConclusion[0]);

			if($intFechaConclusion<$intFechaEscritura){
				$objRowActFilePdt->getItem('fechaConclusion')->setKardex($kardex);
				$objRowActFilePdt->getItem('fechaConclusion')->setIdKardex($idKardex);
				$objRowActFilePdt->getItem('fechaConclusion')->setValueRemplace($fechaEscritura);
				$objRowActFilePdt->getItem('fechaConclusion')->setAct($acto);
				$objRowActFilePdt->getItem('fechaConclusion')->setCategoryCorrect(1);
				$objRowActFilePdt->getItem('fechaConclusion')->setError(1);
				$objRowActFilePdt->getItem('fechaConclusion')->setErrorItem('La fecha de conclusion no puede ser menor que la fecha de escritura.');
				$arrObjRowActFile[] = $objRowActFilePdt->getItem('fechaConclusion');
			}
			

			
			
			#FIN DE VALIDACION FECHA DE LEGALIZACION

			#VALIDANDO ACTO SUNAT 
			$objRowActFilePdt->getItem('actoSunat')->setItemValue($actoSunat);
			#FIN DE VALIDACION DE ACTO SUNAT

			
			#FIN DE VALIDANDO SECUENCIAL

			#VALIDANDO CODIGO DE MONEDA
			if($idMoneda == 1){
				$codigoMoneda = 2;
			}else if($idMoneda == 2 ){
				$codigoMoneda = 1;
			}else if($idMoneda == 3){
				$nuevoImporte = floatval($importe) * floatval($tipoCambio); 
 				$codigoMoneda = 1; 
 				$importe = $nuevoImporte; 
			}
			$objRowActFilePdt->getItem('moneda')->setItemValue($codigoMoneda);
			#VALIDANDO CODIGO DE  MONEDA

			#VALIDACION DE IMPORTE
			$objRowActFilePdt->getItem('importe')->setItemValue($importe);
			#FIN DE VALIDACION DE IMPORTE
			$plazoInicial = '';
			$objRowActFilePdt->getItem('plazoInicial')->setItemValue($plazoInicial);
			$plazoFinal = '';
			$objRowActFilePdt->getItem('plazoFinal')->setItemValue($plazoFinal);

			#VALIDACION DEL NOMBRE DEL ACTO
			if($actoSunat == 14){
				$nombreContrato = $acto;
			}else{
				$nombreContrato = '';
			}
			$objRowActFilePdt->getItem('nombreContrato')->setItemValue($nombreContrato);
			#FIN DE VALIDACION DEL NOMBRE DEL ACTO

			#Validando la fecha de la inscripcion de la minuta
			if(in_array($actoSunat,$arrActs)){
				$objRowActFilePdt->getItem('fechaInscripcionMinuta')->setItemValue($fechaInscripcionMinuta);
				$arrFechaInscripcionMinuta = explode('/', $fechaInscripcionMinuta);
				$intFechaInscripcionMinuta = intval($arrFechaInscripcionMinuta[2].$arrFechaInscripcionMinuta[1].$arrFechaInscripcionMinuta[0]);
				//die($intFechaEscritura.' '.$intFechaInscripcionMinuta);
				#VALIDANDO FECHA DE INSCRIPCION DE LA MINUTA -SPENCER
				$IsIncorrectDate = false;
				if(!$this->validateDate($fechaInscripcionMinuta)){
					$mensageErrorFechaAdquisicion = 'Fecha de inscripcion de la minuta, formato incorrecto';
					$IsIncorrectDate = true;
					$errorFechaInscripcion = 1;
					$objRowActFilePdt->getItem('fechaInscripcionMinuta')->setKardex($kardex);
					$objRowActFilePdt->getItem('fechaInscripcionMinuta')->setIdKardex($idKardex);
					$objRowActFilePdt->getItem('fechaInscripcionMinuta')->setAct($acto);
					$objRowActFilePdt->getItem('fechaInscripcionMinuta')->setError(1);
					$objRowActFilePdt->getItem('fechaInscripcionMinuta')->setErrorItem($mensageErrorFechaAdquisicion);
					$arrObjRowActFile[] = $objRowActFilePdt->getItem('fechaInscripcionMinuta');
				}





				if($intFechaEscritura<$intFechaInscripcionMinuta){
					/*$this->_vars['fechaConclusion']->setSQL("UPDATE patrimonial SET nminuta = '$fechaEscritura' WHERE kardex = '' AND item = '' ");*/
					$objRowActFilePdt->getItem('fechaInscripcionMinuta')->setKardex($kardex);
					$objRowActFilePdt->getItem('fechaInscripcionMinuta')->setIdKardex($idKardex);
					$objRowActFilePdt->getItem('fechaInscripcionMinuta')->setValueRemplace($fechaEscritura);
					$objRowActFilePdt->getItem('fechaInscripcionMinuta')->setAct($acto);
					$objRowActFilePdt->getItem('fechaInscripcionMinuta')->setError(1);
					$objRowActFilePdt->getItem('fechaInscripcionMinuta')->setCategoryCorrect(1);
					$objRowActFilePdt->getItem('fechaInscripcionMinuta')->setTypeAct($codAct);
					$objRowActFilePdt->getItem('fechaInscripcionMinuta')->setitemMp($itemmp);
					$objRowActFilePdt->getItem('fechaInscripcionMinuta')->setWritingDate($formatFechaEscritura);
					$objRowActFilePdt->getItem('fechaInscripcionMinuta')->setTypeOfCorrection(1);
					$objRowActFilePdt->getItem('fechaInscripcionMinuta')->setIsCorrectable(1);
					$objRowActFilePdt->getItem('fechaInscripcionMinuta')->setErrorItem('La fecha de suscripción de la minuta no  puede ser mayor que la fecha de escritura.');
					$arrObjRowActFile[] = $objRowActFilePdt->getItem('fechaInscripcionMinuta');
				}
			}else{
				$objRowActFilePdt->getItem('fechaInscripcionMinuta')->setItemValue('');
			}

			#FIN DE VALIDACION DE FECHA DE INSCRIPCION
			#VALIDACION DE EXIBIO MEDIO DE PAGO
			if(in_array($actoSunat,$arrActs)){
				$exhibioMp = $exhibioMp == 'SI'?1:0;
			}else{
				$exhibioMp = '';
			}
			$objRowActFilePdt->getItem('exibioMedioPago')->setItemValue($exhibioMp);
			if($exhibioMp == 1){
				$sql = "SELECT detmp,itemmp,kardex,tipacto FROM detallemediopago WHERE kardex = '$kardex' AND tipacto = '$codAct'";
				$resultDetalleBienes = mysql_query($sql);
				
				if(mysql_affected_rows() == 0){
					$objRowActFilePdt->getItem('exibioMedioPago')->setKardex($kardex);
					$objRowActFilePdt->getItem('exibioMedioPago')->setIdKardex($idKardex);
					$objRowActFilePdt->getItem('exibioMedioPago')->setAct($acto);
					$objRowActFilePdt->getItem('exibioMedioPago')->setError(1);
					$objRowActFilePdt->getItem('exibioMedioPago')->setErrorItem('Si exibio medio de pago, por favor ingrese el registro');
					$arrObjRowActFile[] = $objRowActFilePdt->getItem('exibioMedioPago');
				}
			}
			
			#FIN DE VALIDACION DE MEDIO DE PAGO
			$temp = 'T';
			#VALIDANDO SECUENCIAL 
			$objRowActFilePdt->getItem('secuencial')->setItemValue($numeroSecuencial);			
			$sql = "INSERT INTO temp_act(idact,idKardex,kardex, nombreActo,itemmp, idtipkar, numescritura, fechaescritura, fechaconclusion, fechalegal, actosunat, tipoacto, secuencialacto, idmon, importetransac, plazoini, plazofin, desacto, mminuta, exhibiomp, temp) VALUES (NULL,'".$idKardex."','".$kardex."','".$acto."','".$itemmp."','".$idTipoKardex."','".$numeroEscritura."','".$formatFechaEscritura."','".$fechaConclusion."','".$fechaLegalizacion."','".$actoSunat."','".$codAct."','".$numeroSecuencial."','".$codigoMoneda."','".$importe."','".$plazoInicial."','".$plazoFinal."','".$nombreContrato."','".$fechaInscripcionMinuta."','".$exhibioMp."','".$temp."')"; 
			mysql_query($sql);
			



			$keyArrError = $kardex.'_'.$idKardex;
			$this->_arrErrorItems[$keyArrError] = $arrObjRowActFile;
			$this->_arrObjActFilePdt[]  =  $objRowActFilePdt;
			

		}	
		//$this->_arrErrorsPdt = $arrErrors;

	}


	public function generateFileAct(){
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
		$arrDate = explode('/', $this->_initialDate);
		$year = $arrDate[2];

		$file = "3520".$year.$rucNotario.".Act";
		header('Content-Type: application/force-download');
		header('Content-Disposition: attachment; filename='.$file);
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: '.filesize($file));
		

		foreach ($this->_arrObjActFilePdt   as $objRow) {
			echo str_pad(substr(intval($objRow->getItem('tipoKardex')->getItemValue()),0,1),1," ",STR_PAD_LEFT)."|".
			str_pad(substr(intval($objRow->getItem('numeroEscritura')->getItemValue()),0,5),5," ",STR_PAD_LEFT)."|".
			str_pad(substr($objRow->getItem('fechaEscritura')->getItemValue(),0,10),10," ",STR_PAD_LEFT)."|".
			str_pad(substr($objRow->getItem('fechaConclusion')->getItemValue(),0,10),10," ",STR_PAD_LEFT)."|".
			str_pad(substr($objRow->getItem('fechaLegalizacion')->getItemValue(),0,10),10," ",STR_PAD_LEFT)."|".
			str_pad(substr($objRow->getItem('actoSunat')->getItemValue(),0,2),2," ",STR_PAD_LEFT)."|".
			str_pad(substr($objRow->getItem('secuencial')->getItemValue(),0,5),5," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('moneda')->getItemValue(),0,1),1," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('importe')->getItemValue(),0,15),15," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('plazoInicial')->getItemValue(),0,10),10," ",STR_PAD_LEFT)."|".
			str_pad(substr($objRow->getItem('plazoFinal')->getItemValue(),0,11),11," ",STR_PAD_LEFT)."|".
			str_pad(substr($this->remplaceStringPdt($objRow->getItem('nombreContrato')->getItemValue()),0,30),30," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('fechaInscripcionMinuta')->getItemValue(),0,10),10," ",STR_PAD_LEFT)."|".
			str_pad(substr($objRow->getItem('exibioMedioPago')->getItemValue(),0,1),1," ",STR_PAD_LEFT)."|".chr(13).chr(10);

		}


	}
	


	public function loadDataBien(){
		$sql = "TRUNCATE temp_bie";
		$result = mysql_query($sql);
		$sql = "SELECT  idKardex,kardex,nombreActo,itemmp,idtipkar,numescritura,fechaescritura,fechaconclusion,fechalegal,actosunat,tipoacto,secuencialacto,idmon,importetransac,plazoini,plazofin,desacto,mminuta,exhibiomp,temp FROM temp_act ORDER BY CAST(numescritura AS UNSIGNED) ASC";

		$resultTempAct = mysql_query($sql);
		
		$arrCodigoBienOpcionPlaca = array('01','07','09');
		$arrCodigoBienOrigenBien = array('04','99');
		$arrCodigoBienNumeroSerie = array('05');
		$arrCodigoBienUbigeo = array('04');
		$arrCodigoBienDescripcionOtros = array('99');
		$arrNoBienes = array('10');
		$arrErrors = array();
		$numeroSecuencialBien = 0;
		while($rowTempAct = mysql_fetch_assoc($resultTempAct)){
			
			$idKardex = $rowTempAct['idKardex'];
			$kardexAct = $rowTempAct['kardex'];
			$nombreActo = $rowTempAct['nombreActo'];
			$itemMpAct = $rowTempAct['itemmp'];

			$idTipoKardex = $rowTempAct['idtipkar'];
			
			$fechaEscritura = $rowTempAct['fechaescritura'];
			$fechaConclusion = $rowTempAct['fechaconclusion'];
			$fechaLegal = $rowTempAct['fechalegal'];
			$actoSunat = $rowTempAct['actosunat'];
			$tipoActoAct = $rowTempAct['tipoacto'];
			
			$idMoneda = $rowTempAct['idmon'];
			$importe = $rowTempAct['importetransac'];
			$plazoInical  = $rowTempAct['plazoini'];
			$plazoFinal  = $rowTempAct['plazofin'];
			$nombreContrato = $rowTempAct['desacto'];
			$fechaInscripcionMinuta =  $rowTempAct['mminuta'];
			$exhibioMp = $rowTempAct['exhibiomp'];

			if($idTipoKardex == 1){
				$tipoKardex = '1';
			}else if($idTipoKardex == 3){
				$tipoKardex = '2';
			}else if($idTipoKardex == 4){
				$tipoKardex = '5';
			}

			if($this->_fkTypeKardex == 3){
				$sql = "SELECT detveh,kardex,idtipacto,idplaca,numplaca,clase,marca,anofab,modelo,combustible,carroceria,fecinsc,color,motor,numcil,numserie FROM  detallevehicular WHERE kardex = '$kardexAct'";
				$resultVehicular = mysql_query($sql);
				if(mysql_affected_rows() != 0 ){
					while($rowVehicular = mysql_fetch_array($resultVehicular)){
						$idDetalleBien = $rowVehicular['detveh'];
						$placa = $rowVehicular['numplaca'];
						$numeroSerie = $rowVehicular['numserie'];
						$motor = $rowVehicular['motor'];
						$fechaAdquisicionBien = $rowVehicular['fecinsc'];
						$sql = "SELECT  idtipbien,codbien,uif,desestcivil FROM  tipobien WHERE idtipbien = '8' ";
						$resultTipoBien = mysql_query($sql);
						$rowTipoBien  = mysql_fetch_array($resultTipoBien);
						$codBienTipoBien = $rowTipoBien['codbien'];
						$numeroSecuencialBien++;
						$arrObjRowBienFile = array();
						$secuencialActo = $rowTempAct['secuencialacto'];
						$numeroEscritura = $rowTempAct['numescritura'];
						$objRowBienFilePdt = new BienFilePdt();

						#TIPO DE KARDEX
						$objRowBienFilePdt->getItem('tipoKardex')->setItemValue($tipoKardex);
						#NUMERO DE ESCRITURA
						$objRowBienFilePdt->getItem('numeroEscritura')->setItemValue($numeroEscritura);
						#FECHA DE ESCRITURA
						$objRowBienFilePdt->getItem('fechaEscritura')->setItemValue($fechaEscritura);
						#TIPO DE BIEN
						$tipoBien = 'B';
						$objRowBienFilePdt->getItem('tipoBien')->setItemValue($tipoBien);
						#CODIGO DEL BIEN
						$objRowBienFilePdt->getItem('codigoBien')->setItemValue($codBienTipoBien);

						if($placa != ''){
							$vTpsm = '1';
							$numeroOpcionalPlacaSerieMotor = $placa;
						}else if($numeroSerie != ''){
							$vTpsm = '2';
							$numeroOpcionalPlacaSerieMotor = $numeroSerie;
						}else{
							$vTpsm = '3';
							$numeroOpcionalPlacaSerieMotor = $motor;
						}
						#OPCION DE PLACA/SERIE/MOTOR
						$objRowBienFilePdt->getItem('opcionPlacaSerieMotor')->setItemValue($vTpsm);
						#PLACA/SERIE/MOTOR
						$objRowBienFilePdt->getItem('numeroPlacaSerieMotor')->setItemValue($numeroOpcionalPlacaSerieMotor);
						#NUMERO DE SERIE
						$numeroSerie = '';
						$objRowBienFilePdt->getItem('numeroSerie')->setItemValue($numeroSerie);
						$origenBien = '';
						$objRowBienFilePdt->getItem('origenBien')->setItemValue($origenBien);
						#CODIGO UBICACIÓN DEL BIEN
						$codigoDistrito = '';
						$objRowBienFilePdt->getItem('codigoHubicacion')->setItemValue($codigoDistrito);
						#FECHA DE ADQUISICIÓN DEL BIEN
						$objRowBienFilePdt->getItem('fechaAdquisicionBien')->setItemValue($fechaAdquisicionBien);
						$mensageErrorFechaAdquisicion = null;
						$errorFechaAdquisicion = 0;
						if($fechaAdquisicionBien != ''){
							$IsIncorrectDate = false;
							//die($fechaAdquisicionBien.'hola');
							if(!$this->validateDate($fechaAdquisicionBien)){
								$mensageErrorFechaAdquisicion = 'Fecha de Adquisicion del bien, formato incorreto';
								$IsIncorrectDate = true;
								$errorFechaAdquisicion = 1;
								
							}

							if(!$IsIncorrectDate){
								//die($fechaAdquisicionBien.'aa');
								$arrFechaAdquisicion = explode('/', $fechaAdquisicionBien);
								$day = $arrFechaAdquisicion[0];
								$month = $arrFechaAdquisicion[1];
								$year = $arrFechaAdquisicion[2];
						
								if(!checkdate($month,$day,$year)){
									$mensageErrorFechaAdquisicion = 'Fecha de Adquisicion del bien, No existe fecha en el mes';
									$errorFechaAdquisicion = 2;
								}
							}
							if(!is_null($mensageErrorFechaAdquisicion)){
								$objRowBienFilePdt->getItem('fechaAdquisicionBien')->setKardex($kardexAct);
								$objRowBienFilePdt->getItem('fechaAdquisicionBien')->setIdKardex($idKardex);
								$objRowBienFilePdt->getItem('fechaAdquisicionBien')->setAct($nombreActo);
								$objRowBienFilePdt->getItem('fechaAdquisicionBien')->setError($errorFechaAdquisicion);
								$objRowBienFilePdt->getItem('fechaAdquisicionBien')->setErrorItem($mensageErrorFechaAdquisicion);
								$arrObjRowBienFile[] = $objRowBienFilePdt->getItem('fechaAdquisicionBien');	
							}
							

						}




						#DESCRIPCION OTROS BIENES
						$observacionEspecifica = '';
						$objRowBienFilePdt->getItem('descripcionOtrosBienes')->setItemValue($observacionEspecifica);

						#NUMERO SECUENCIAL DEL BIEN
						$objRowBienFilePdt->getItem('numeroSecuencialBien')->setItemValue($numeroSecuencialBien);
							
						//echo $numeroEscritura.' - '.$secuencialActo.'<br>';	
						$objRowBienFilePdt->getItem('numeroSecuencialActo')->setItemValue($secuencialActo);

						$keyArrError = $kardexAct.'_'.$idKardex.'_'.$idDetalleBien;
						$this->_arrErrorItems[$keyArrError] = $arrObjRowBienFile;
						$this->_arrObjBienFilePdt[]  =  $objRowBienFilePdt;


						$tempo = 'T';
						$sql = "INSERT INTO temp_bie(idbie, kardex, idtipkar, numescritura, fechaescrituracion, secuacto, secubien, tipobien, codbien, nopcion, npsm, numserie, oriegenbien, ubibien, fechaadd, descrip, flag) 
					 		VALUES (NULL,'".$kardexAct."','".$idTipoKardex."','".$numeroEscritura."','".$fechaEscritura."','".$secuencialActo."','".$numeroSecuencialBien."','".$tipoBien."','".$codBienTipoBien."','".$vTpsm."','".$numeroOpcionalPlacaSerieMotor."','".$numeroSerie."','".$origenBien."','".$codigoDistrito."','".$fechaAdquisicionBien."','".$observacionEspecifica."','".$tempo."')";
					 		//die($sql);
					 	mysql_query($sql);
					}
				}else{
					$objRowBienFilePdt->getItem('filaBien')->setKardex($kardexAct);
					$objRowBienFilePdt->getItem('filaBien')->setIdKardex($idKardex);
					$objRowBienFilePdt->getItem('filaBien')->setAct($nombreActo);
					$objRowBienFilePdt->getItem('filaBien')->setTypeAct($tipoActoAct);
					$objRowBienFilePdt->getItem('filaBien')->setitemMp($itemMpAct);
					$objRowBienFilePdt->getItem('filaBien')->setError(1);
					$objRowBienFilePdt->getItem('filaBien')->setCategoryCorrect(2);
					$objRowBienFilePdt->getItem('filaBien')->setTypeOfCorrection(2);
					//$objRowBienFilePdt->getItem('filaBien')->setIsCorrectable(1);
					$objRowBienFilePdt->getItem('filaBien')->setErrorItem('No existe bien, ingrese un bien');
					$arrObjRowBienFile[] = $objRowBienFilePdt->getItem('filaBien');
					$keyArrError = $kardexAct.'_'.$idKardex.'_'.$itemMpAct;
					//die($keyArrError);
					$this->_arrErrorItems[$keyArrError] = $arrObjRowBienFile;
					$this->_arrObjBienFilePdt[]  =  $objRowBienFilePdt;
				}

			}else{
				$sql = "SELECT detbien,itemmp,kardex,idtipacto,tipob,idtipbien,coddis,fechaconst,oespecific,smaquiequipo,tpsm,npsm,pregistral,idsedereg FROM detallebienes WHERE itemmp = '".$itemMpAct."'";
				$resultBien = mysql_query($sql);
				if(mysql_affected_rows() != 0){
					while($rowBien = mysql_fetch_assoc($resultBien)){
						$numeroSecuencialBien++;
						$arrObjRowBienFile = array();
						$objRowBienFilePdt = new BienFilePdt();
						
						$kardexBien = $rowBien['detbien'];
						$idDetalleBien = $rowBien['detbien'];
						$itemMpBien = $rowBien['itemmp'];
						$kardexBien = $rowBien['kardex'];
						$tipoActoBien = $rowBien['idtipacto'];
						$tipoB = $rowBien['tipob'];
						$idTipoBien = $rowBien['idtipbien'];
						$numeroEscritura = $rowTempAct['numescritura'];
						#NUMERO SECUENCIAL DEL ACTO
						/*$sql = "SELECT secuencialacto FROM  temp_act  WHERE kardex = '$kardexBien' AND tipoacto='$tipoActoBien' LIMIT 1 ";
						
						$resultSecuencialActo = mysql_query($sql);
						$rowSecuencialActo = mysql_fetch_array($resultSecuencialActo);*/
						$secuencialActo = $rowTempAct['secuencialacto'];
						
						
						$fechaAdquisicionBien  = $rowBien['fechaconst'];
						
						$numeroSerie =  $rowBien['smaquiequipo'];
						$tpsm =  $rowBien['tpsm'];
						$numeroOpcionalPlacaSerieMotor =  $rowBien['npsm'];
						$partidaRegistralBien = $rowBien['pregistral'];
						$idSedeRegistralBien = $rowBien['idsedereg'];
						$sql = "SELECT  idtipbien,codbien,uif,desestcivil FROM  tipobien WHERE idtipbien = '".$idTipoBien."'";

						$resultTipoBien = mysql_query($sql);
						$rowTipoBien = mysql_fetch_assoc($resultTipoBien);
						$codBienTipoBien = $rowTipoBien['codbien'];

						$observacionEspecifica = $codBienTipoBien == '99'?$rowBien['oespecific']:'';
						$codigoDistrito = $codBienTipoBien == '04'?$rowBien['coddis']:'';
						#TIPO DE KARDEX
						$objRowBienFilePdt->getItem('tipoKardex')->setItemValue($tipoKardex);
						#NUMERO DE ESCRITURA
						$objRowBienFilePdt->getItem('numeroEscritura')->setItemValue($numeroEscritura);
						#FECHA DE ESCRITURA
						$objRowBienFilePdt->getItem('fechaEscritura')->setItemValue($fechaEscritura);
						


						if($tipoB == 'BIENES'){
							$tipoBien = 'B';
						}else{
							$tipoBien = 'A';
						}

						$descripcionPlacaSerieMotor = '';
						switch ($tpsm) {
							case 'P':
								# code...
								$vTpsm = 1;
								$descripcionPlacaSerieMotor = "PLACA";
								break;
							case 'S':
								$vTpsm = 2;
								$descripcionPlacaSerieMotor = "SERIE";
								break;
							case 'M':
								$vTpsm = 3;
								$descripcionPlacaSerieMotor = "MOTOR";
								break;	
							case '':
								$vTpsm = '';
								break;
							default:
								# code...
								break;
						}
						#TIPO DE BIEN
						$objRowBienFilePdt->getItem('tipoBien')->setItemValue($tipoBien);
						#CODIGO DEL BIEN
						$objRowBienFilePdt->getItem('codigoBien')->setItemValue($codBienTipoBien);

						#OPCION DE PLACA/SERIE/MOTOR
						$objRowBienFilePdt->getItem('opcionPlacaSerieMotor')->setItemValue($vTpsm);
						if(in_array($codBienTipoBien, $arrCodigoBienOpcionPlaca) && $vTpsm == ''){
							$objRowBienFilePdt->getItem('opcionPlacaSerieMotor')->setKardex($kardexAct);
							$objRowBienFilePdt->getItem('opcionPlacaSerieMotor')->setIdKardex($idKardex);
							$objRowBienFilePdt->getItem('opcionPlacaSerieMotor')->setAct($nombreActo);
							$objRowBienFilePdt->getItem('opcionPlacaSerieMotor')->setError(1);
							$objRowBienFilePdt->getItem('opcionPlacaSerieMotor')->setErrorItem('Selecione N° de Placa/Serie/Motor');
							$arrObjRowBienFile[] = $objRowBienFilePdt->getItem('opcionPlacaSerieMotor');
						}
						#PLACA/SERIE/MOTOR
						$objRowBienFilePdt->getItem('numeroPlacaSerieMotor')->setItemValue($numeroOpcionalPlacaSerieMotor);
						if(in_array($codBienTipoBien, $arrCodigoBienOpcionPlaca) && $numeroOpcionalPlacaSerieMotor == ''){
							$objRowBienFilePdt->getItem('numeroPlacaSerieMotor')->setKardex($kardexAct);
							$objRowBienFilePdt->getItem('numeroPlacaSerieMotor')->setIdKardex($idKardex);
							$objRowBienFilePdt->getItem('numeroPlacaSerieMotor')->setAct($nombreActo);
							$objRowBienFilePdt->getItem('numeroPlacaSerieMotor')->setError(1);
							$objRowBienFilePdt->getItem('numeroPlacaSerieMotor')->setErrorItem('Ingrese Placa/Serie/Motor');
							$arrObjRowBienFile[] = $objRowBienFilePdt->getItem('numeroPlacaSerieMotor');
						}

						#NUMERO DE SERIE
						$objRowBienFilePdt->getItem('numeroSerie')->setItemValue($numeroSerie);
						if(in_array($codBienTipoBien, $arrCodigoBienNumeroSerie) && $numeroSerie == ''){
							$objRowBienFilePdt->getItem('numeroSerie')->setKardex($kardexAct);
							$objRowBienFilePdt->getItem('numeroSerie')->setIdKardex($idKardex);
							$objRowBienFilePdt->getItem('numeroSerie')->setAct($nombreActo);
							$objRowBienFilePdt->getItem('numeroSerie')->setError(1);
							$objRowBienFilePdt->getItem('numeroSerie')->setErrorItem('Ingrese Numero de serie');
							$arrObjRowBienFile[] = $objRowBienFilePdt->getItem('numeroSerie');
						}
						
						#ORIGEN DEL BIEN
						if($codigoDistrito != ''){
							if(in_array($codBienTipoBien, $arrCodigoBienOrigenBien)){
								$origenBien = 1;
							}else{
								$origenBien = '';
								
							}
						}else{
							$origenBien = '';
						}
						
						$objRowBienFilePdt->getItem('origenBien')->setItemValue($origenBien);

						#CODIGO UBICACIÓN DEL BIEN
						$objRowBienFilePdt->getItem('codigoHubicacion')->setItemValue($codigoDistrito);
						//die('hola'.$codBienTipoBien);
						
						//die($codBienTipoBien.'-'.$codigoDistrito);
						if(in_array($codBienTipoBien, $arrCodigoBienUbigeo) && $codigoDistrito === ''){
							//die('hola');
							$objRowBienFilePdt->getItem('codigoHubicacion')->setKardex($kardexAct);
							$objRowBienFilePdt->getItem('codigoHubicacion')->setIdKardex($idKardex);
							$objRowBienFilePdt->getItem('codigoHubicacion')->setAct($nombreActo);
							$objRowBienFilePdt->getItem('codigoHubicacion')->setError(1);
							$objRowBienFilePdt->getItem('codigoHubicacion')->setErrorItem('Ingrese Ubigeo para el Bien');
							$arrObjRowBienFile[] = $objRowBienFilePdt->getItem('codigoHubicacion');
						}

						#FECHA DE ADQUISICIÓN DEL BIEN
						$objRowBienFilePdt->getItem('fechaAdquisicionBien')->setItemValue($fechaAdquisicionBien);
						$mensageErrorFechaAdquisicion = null;
						$errorFechaAdquisicion = 0;
						if($fechaAdquisicionBien != ''){
							$IsIncorrectDate = false;
							//die($fechaAdquisicionBien.'hola');
							if(!$this->validateDate($fechaAdquisicionBien)){
								$mensageErrorFechaAdquisicion = 'Fecha de Adquisicion del bien, formato incorreto';
								$IsIncorrectDate = true;
								$errorFechaAdquisicion = 1;
								
							}

							if(!$IsIncorrectDate){
								//die($fechaAdquisicionBien.'aa');
								$arrFechaAdquisicion = explode('/', $fechaAdquisicionBien);
								$day = $arrFechaAdquisicion[0];
								$month = $arrFechaAdquisicion[1];
								$year = $arrFechaAdquisicion[2];
						
								if(!checkdate($month,$day,$year)){
									$mensageErrorFechaAdquisicion = 'Fecha de Adquisicion del bien, No existe fecha en el mes';
									$errorFechaAdquisicion = 2;
								}
							}
							if(!is_null($mensageErrorFechaAdquisicion)){
								$objRowBienFilePdt->getItem('fechaAdquisicionBien')->setKardex($kardexAct);
								$objRowBienFilePdt->getItem('fechaAdquisicionBien')->setIdKardex($idKardex);
								$objRowBienFilePdt->getItem('fechaAdquisicionBien')->setAct($nombreActo);
								$objRowBienFilePdt->getItem('fechaAdquisicionBien')->setError($errorFechaAdquisicion);
								$objRowBienFilePdt->getItem('fechaAdquisicionBien')->setErrorItem($mensageErrorFechaAdquisicion);
								$arrObjRowBienFile[] = $objRowBienFilePdt->getItem('fechaAdquisicionBien');	
							}
							

						}
						#DESCRIPCION OTROS BIENES
						$objRowBienFilePdt->getItem('descripcionOtrosBienes')->setItemValue($observacionEspecifica);
						if(in_array($codBienTipoBien, $arrCodigoBienDescripcionOtros) && $observacionEspecifica == ''){
							$objRowBienFilePdt->getItem('descripcionOtrosBienes')->setKardex($kardexAct);
							$objRowBienFilePdt->getItem('descripcionOtrosBienes')->setIdKardex($idKardex);
							$objRowBienFilePdt->getItem('descripcionOtrosBienes')->setAct($nombreActo);
							$objRowBienFilePdt->getItem('descripcionOtrosBienes')->setTypeAct($tipoActoAct);
							$objRowBienFilePdt->getItem('descripcionOtrosBienes')->setitemMp($itemMpAct);
							$objRowBienFilePdt->getItem('descripcionOtrosBienes')->setTypeOfCorrection(3);
							$objRowBienFilePdt->getItem('descripcionOtrosBienes')->setCategoryCorrect(2);
							$objRowBienFilePdt->getItem('descripcionOtrosBienes')->setIsCorrectable(1);
							$objRowBienFilePdt->getItem('descripcionOtrosBienes')->setError(1);
							$objRowBienFilePdt->getItem('descripcionOtrosBienes')->setErrorItem('Ingrese una descripción Bien Acto Jurídico');
							$arrObjRowBienFile[] = $objRowBienFilePdt->getItem('descripcionOtrosBienes');
						}

						#NUMERO SECUENCIAL DEL BIEN
						$objRowBienFilePdt->getItem('numeroSecuencialBien')->setItemValue($numeroSecuencialBien);
							
						//echo $numeroEscritura.' - '.$secuencialActo.'<br>';	
						$objRowBienFilePdt->getItem('numeroSecuencialActo')->setItemValue($secuencialActo);
						/*if($numeroEscritura == 59){
							die('hola'.$secuencialActo);
						}*/

					 	$keyArrError = $kardexAct.'_'.$idKardex.'_'.$idDetalleBien;
						$this->_arrErrorItems[$keyArrError] = $arrObjRowBienFile;
						$this->_arrObjBienFilePdt[]  =  $objRowBienFilePdt;


						$tempo = 'T';
						$sql = "INSERT INTO temp_bie(idbie, kardex, idtipkar, numescritura, fechaescrituracion, secuacto, secubien, tipobien, codbien, nopcion, npsm, numserie, oriegenbien, ubibien, fechaadd, descrip, flag) 
					 		VALUES (NULL,'".$kardexAct."','".$idTipoKardex."','".$numeroEscritura."','".$fechaEscritura."','".$secuencialActo."','".$numeroSecuencialBien."','".$tipoBien."','".$codBienTipoBien."','".$vTpsm."','".$numeroOpcionalPlacaSerieMotor."','".$numeroSerie."','".$origenBien."','".$codigoDistrito."','".$fechaAdquisicionBien."','".$observacionEspecifica."','".$tempo."')";
					 		//die($sql);
					 	mysql_query($sql);

						

						
					}	
				}else if(!in_array($actoSunat, $arrNoBienes)){
					//Error no tiene Bien
					$arrObjRowBienFile = array();
					$objRowBienFilePdt = new BienFilePdt();
					$sql = "SELECT detbien FROM  detallebienes WHERE kardex = '$kardexAct' AND idtipacto = '$tipoActoAct' LIMIT 1 ";
					$result = mysql_query($sql);
					if(mysql_affected_rows() == 0){
						$objRowBienFilePdt->getItem('filaBien')->setKardex($kardexAct);
						$objRowBienFilePdt->getItem('filaBien')->setIdKardex($idKardex);
						$objRowBienFilePdt->getItem('filaBien')->setAct($nombreActo);
						$objRowBienFilePdt->getItem('filaBien')->setTypeAct($tipoActoAct);
						$objRowBienFilePdt->getItem('filaBien')->setitemMp($itemMpAct);
						$objRowBienFilePdt->getItem('filaBien')->setError(1);
						$objRowBienFilePdt->getItem('filaBien')->setCategoryCorrect(2);
						$objRowBienFilePdt->getItem('filaBien')->setTypeOfCorrection(2);
						$objRowBienFilePdt->getItem('filaBien')->setIsCorrectable(1);
						$objRowBienFilePdt->getItem('filaBien')->setErrorItem('No existe bien, ingrese un bien');
						$arrObjRowBienFile[] = $objRowBienFilePdt->getItem('filaBien');
						$keyArrError = $kardexAct.'_'.$idKardex.'_'.$itemMpAct;
						//die($keyArrError);
						$this->_arrErrorItems[$keyArrError] = $arrObjRowBienFile;
						$this->_arrObjBienFilePdt[]  =  $objRowBienFilePdt;
					}else{
						$objRowBienFilePdt->getItem('filaBien')->setKardex($kardexAct);
						$objRowBienFilePdt->getItem('filaBien')->setIdKardex($idKardex);
						$objRowBienFilePdt->getItem('filaBien')->setAct($nombreActo);
						$objRowBienFilePdt->getItem('filaBien')->setError(1);
						$objRowBienFilePdt->getItem('filaBien')->setCategoryCorrect(2);
						$objRowBienFilePdt->getItem('filaBien')->setTypeAct($tipoActoAct);
						$objRowBienFilePdt->getItem('filaBien')->setitemMp($itemMpAct);
						$objRowBienFilePdt->getItem('filaBien')->setTypeOfCorrection(1);
						$objRowBienFilePdt->getItem('filaBien')->setIsCorrectable(1);

						$objRowBienFilePdt->getItem('filaBien')->setErrorItem('Si existe bien, pero no ha sido registrado correctamente');
						$arrObjRowBienFile[] = $objRowBienFilePdt->getItem('filaBien');
						$keyArrError = $kardexAct.'_'.$idKardex.'_'.$itemMpAct;
						//die($keyArrError);
						$this->_arrErrorItems[$keyArrError] = $arrObjRowBienFile;
						$this->_arrObjBienFilePdt[]  =  $objRowBienFilePdt;
					}


					
					
				}

			}

			

			


		}
		//die();
		//$this->_arrErrorsPdt = $this->_arrErrorItems;


	}

	public function generateFileBien(){
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
		$arrDate = explode('/', $this->_initialDate);
		$year = $arrDate[2];

		$file = "3520".$year.$rucNotario.".Bie";
		header('Content-Type: application/force-download');
		header('Content-Disposition: attachment; filename='.$file);
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: '.filesize($file));
		

		foreach ($this->_arrObjBienFilePdt   as $objRow) {
			echo str_pad(substr(intval($objRow->getItem('tipoKardex')->getItemValue()),0,1),1," ",STR_PAD_RIGHT)."|".
			str_pad(substr(intval($objRow->getItem('numeroEscritura')->getItemValue()),0,5),5," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('fechaEscritura')->getItemValue(),0,10),10," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('numeroSecuencialActo')->getItemValue(),0,5),5," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('numeroSecuencialBien')->getItemValue(),0,5),5," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('tipoBien')->getItemValue(),0,1),1," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('codigoBien')->getItemValue(),0,2),2," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('opcionPlacaSerieMotor')->getItemValue(),0,1),1," ",STR_PAD_RIGHT)."|".
			str_pad(substr($this->remplaceStringPdt($objRow->getItem('numeroPlacaSerieMotor')->getItemValue()),0,20),20," ",STR_PAD_RIGHT)."|".
			str_pad(substr($this->remplaceStringPdt($objRow->getItem('numeroSerie')->getItemValue()),0,20),20," ",STR_PAD_RIGHT)."|".
			str_pad(substr($this->remplaceStringPdt($objRow->getItem('origenBien')->getItemValue()),0,1),1," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('codigoHubicacion')->getItemValue(),0,6),6," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('fechaAdquisicionBien')->getItemValue(),0,10),10," ",STR_PAD_RIGHT)."|".
			str_pad(substr($this->remplaceStringPdt($objRow->getItem('descripcionOtrosBienes')->getItemValue()),0,30),30," ",STR_PAD_RIGHT)."|".chr(13).chr(10);

		}


	}

	public function loadDataOtorgante(){
		$sql = "TRUNCATE temp_otg";
		$result = mysql_query($sql);
		$sql = "SELECT  idKardex,kardex,nombreActo,itemmp,idtipkar,numescritura,fechaescritura,fechaconclusion,fechalegal,actosunat,tipoacto,secuencialacto,idmon,importetransac,plazoini,plazofin,desacto,mminuta,exhibiomp,temp FROM temp_act ORDER BY CAST(numescritura AS UNSIGNED) ASC";
		


		$resultTempAct = mysql_query($sql);
		$numeroSecuencialOtorgante = 1;
		while($rowTempAct = mysql_fetch_array($resultTempAct)){
			$idKardex = $rowTempAct['idKardex'];
			$kardexAct = $rowTempAct['kardex'];
			$nombreActo = $rowTempAct['nombreActo'];
			$idTipoKardex = $rowTempAct['idtipkar'];
			$tipoActoAct = $rowTempAct['tipoacto'];
			$numeroEscritura = $rowTempAct['numescritura'];
			$fechaEscritura = $rowTempAct['fechaescritura'];
			$fechaConclusion = $rowTempAct['fechaconclusion'];
			$fechaLegal = $rowTempAct['fechalegal'];
			$actoSunat = $rowTempAct['actosunat'];
			$secuencialActo = $rowTempAct['secuencialacto'];

			if($idTipoKardex == 1){
				$tipoKardex = '1';
			}else if($idTipoKardex == 3){
				$tipoKardex = '2';
			}else if($idTipoKardex == 4){
				$tipoKardex = '5';
			}



			$sql = "SELECT descripcionTipoOtorgante,tipoOtorgante FROM pdt_actos_tipo_otorgante WHERE actoSunat = '$actoSunat' AND habilitado = 1 AND parte = 1 LIMIT 1";
			$resultTipoOtorganteParte1 = mysql_query($sql);
			if($rowTipoOtorganteParte1 = mysql_fetch_array($resultTipoOtorganteParte1)){
				$tipoOtorganteParte1 = $rowTipoOtorganteParte1['tipoOtorgante'];
				$descripcionTipoOtorganteParte1 = $rowTipoOtorganteParte1['descripcionTipoOtorgante'];
			}
			else
				$tipoOtorganteParte1 = 0;

			$sql = "SELECT descripcionTipoOtorgante,tipoOtorgante FROM pdt_actos_tipo_otorgante WHERE actoSunat = '$actoSunat' AND habilitado = 1 AND parte = 2 LIMIT 1";
			$resultTipoOtorganteParte2 = mysql_query($sql);
			if($rowTipoOtorganteParte2 = mysql_fetch_array($resultTipoOtorganteParte2)){
				$tipoOtorganteParte2 = $rowTipoOtorganteParte2['tipoOtorgante'];
				$descripcionTipoOtorganteParte2 = $rowTipoOtorganteParte2['descripcionTipoOtorgante'];
			}	
			else
				$tipoOtorganteParte2 = 0;

			$sql = "SELECT id,idtipkar,kardex,idtipoacto,idcontratante,item,idcondicion,parte,porcentaje,uif,formulario,monto,opago,ofondo,montop FROM  contratantesxacto  WHERE kardex = '$kardexAct' AND idtipoacto = '$tipoActoAct' AND(parte = 1 OR parte = 2)";
			//die($sql);
			$resultContratantesActo = mysql_query($sql);
			//$arrTipoOtorganteParte1 = array();
			//$arrTipoOtorganteParte2 = array();
			$exiteOtorganteParte1 = false;
			$exiteOtorganteParte2 = false;
			$sumPorcentajeParte1 = 0;
			$sumPorcentajeParte2 = 0;
			$arrOtorganteDnis = array('0');
			while($rowContratanteActo = mysql_fetch_array($resultContratantesActo)){
				$idContratante = $rowContratanteActo['idcontratante'];
				$idCondicion = $rowContratanteActo['idcondicion'];
				$porcentaje = number_format($rowContratanteActo['porcentaje'], 2, '.','');
				$parte = $rowContratanteActo['parte'];

				$sql = "SELECT  idcontratante,idcliente,tipper,apepat,apemat,prinom,segnom ,IF(tipper = 'N',nombre,razonsocial) AS contratante,direccion,idtipdoc,numdoc,razonsocial,domfiscal,idubigeo FROM cliente2 WHERE idcontratante = '$idContratante'";
			
				$resultCliente2 = mysql_query($sql);
				$arrObjRowOtorganteFile = array();
				if($rowCliente2 = mysql_fetch_array($resultCliente2)){

					$objRowOtorganteFilePdt = new OtorganteFilePdt();
					$idtipdoc = $rowCliente2['idtipdoc'];
					$numeroDocumento = $rowCliente2['numdoc'];
					$tipper = $rowCliente2['tipper'];
					$contratante = $rowCliente2['contratante'];
					$razonSocial = $this->remplaceStringPdt($rowCliente2['razonsocial']);
					$apellidoPaterno = $this->remplaceStringPdt($rowCliente2['apepat']);
					$apellidoMaterno = $this->remplaceStringPdt($rowCliente2['apemat']);
					$primerNombre = $this->remplaceStringPdt($rowCliente2['prinom']);
					$segundoNombre = $this->remplaceStringPdt($rowCliente2['segnom']);
					$Ubigeo = $rowCliente2['idubigeo'] == '999999'?'':$rowCliente2['idubigeo'];

					#TIPO DE KARDEX
					$objRowOtorganteFilePdt->getItem('tipoKardex')->setItemValue($tipoKardex);
					#NUMERO DE ESCRITURA
					$objRowOtorganteFilePdt->getItem('numeroEscritura')->setItemValue($numeroEscritura);
					#FECHA DE ESCRITURA
					$objRowOtorganteFilePdt->getItem('fechaEscritura')->setItemValue($fechaEscritura);
					#NUMERO SECUENCIAL DEL ACTO
					$objRowOtorganteFilePdt->getItem('numeroSecuencialActo')->setItemValue($secuencialActo);

					#NUMERO SECUENCIAL DEL BIEN
					$numeroSecuencialBien = '';
					$objRowOtorganteFilePdt->getItem('numeroSecuencialBien')->setItemValue($numeroSecuencialBien);

					#NUMERO SECUENCIAL DEL OTORGANTE
					$objRowOtorganteFilePdt->getItem('numeroSecuencialOtorgante')->setItemValue($numeroSecuencialOtorgante);

					$arrTipoDocumento = array('01','04','07');
					switch ($idtipdoc) {
						case 1:
							# code...
							$oTipoDocumento = '01'; 
							break;
						case 2:
							$oTipoDocumento = '04'; 
							break;
						case 5:
							$oTipoDocumento = '07'; 
							break;	
						case 8:
							$oTipoDocumento = '06'; 
							break;
						case 10:
							$oTipoDocumento = '-'; 
							$numeroDocumento = '';
							break;
						case 9:
							$oTipoDocumento = '-'; 
							$numeroDocumento = '';
						break;	
						default:
							# code...
							break;
					}

					#TIPO DE DOCUMENTO
					$objRowOtorganteFilePdt->getItem('tipoDocumento')->setItemValue($oTipoDocumento);
					if(in_array($oTipoDocumento, $arrTipoDocumento) && ($tipper != 'N')){
						//Error Tipo de documento no corresponde al tipo de persona
						$objRowOtorganteFilePdt->getItem('tipoDocumento')->setKardex($kardexAct);
						$objRowOtorganteFilePdt->getItem('tipoDocumento')->setIdKardex($idKardex);
						$objRowOtorganteFilePdt->getItem('tipoDocumento')->setAct($nombreActo);
						$objRowOtorganteFilePdt->getItem('tipoDocumento')->setError(1);
						$objRowOtorganteFilePdt->getItem('tipoDocumento')->setErrorItem($contratante.',tipo de documento no corresponde al tipo de persona');
						$arrObjRowOtorganteFile[] = $objRowOtorganteFilePdt->getItem('tipoDocumento');
					}
					/*if($idtipdoc == 9 && $numeroDocumento == ''){
						$objRowOtorganteFilePdt->getItem('tipoDocumento')->setKardex($kardexAct);
						$objRowOtorganteFilePdt->getItem('tipoDocumento')->setIdKardex($idKardex);
						$objRowOtorganteFilePdt->getItem('tipoDocumento')->setAct($nombreActo);
						$objRowOtorganteFilePdt->getItem('tipoDocumento')->setError(1);
						$objRowOtorganteFilePdt->getItem('tipoDocumento')->setErrorItem($contratante.',tipo de documento no corresponde al numero del documento');
						$arrObjRowOtorganteFile[] = $objRowOtorganteFilePdt->getItem('tipoDocumento');
					}*/


					#NUMERO DE DOCUMENTO
					$objRowOtorganteFilePdt->getItem('numeroDocumento')->setItemValue($numeroDocumento);
					//VALIDANDO DNI
					if($oTipoDocumento == '01'){
						if(strlen($numeroDocumento) != 8){
							//error longitud del documento
							$objRowOtorganteFilePdt->getItem('numeroDocumento')->setKardex($kardexAct);
							$objRowOtorganteFilePdt->getItem('numeroDocumento')->setIdKardex($idKardex);
							$objRowOtorganteFilePdt->getItem('numeroDocumento')->setAct($nombreActo);
							$objRowOtorganteFilePdt->getItem('numeroDocumento')->setError(1);
							$objRowOtorganteFilePdt->getItem('numeroDocumento')->setErrorItem($contratante.',longitud de su  DNI, es incorrecto');
							$arrObjRowOtorganteFile[] = $objRowOtorganteFilePdt->getItem('numeroDocumento');
						}else{
							if(!ctype_digit($numeroDocumento)){
								//no es numerico
								$objRowOtorganteFilePdt->getItem('numeroDocumento')->setKardex($kardexAct);
								$objRowOtorganteFilePdt->getItem('numeroDocumento')->setIdKardex($idKardex);
								$objRowOtorganteFilePdt->getItem('numeroDocumento')->setAct($nombreActo);
								$objRowOtorganteFilePdt->getItem('numeroDocumento')->setError(1);
								$objRowOtorganteFilePdt->getItem('numeroDocumento')->setErrorItem($contratante.',no es un dato numerico su DNI');
								$arrObjRowOtorganteFile[] = $objRowOtorganteFilePdt->getItem('numeroDocumento');
							}
						}
					}else{
						//VALIDANDO RUC
						if($oTipoDocumento == '06'){
							if(strlen($numeroDocumento) != 11){
								//error longitud del documento
								$objRowOtorganteFilePdt->getItem('numeroDocumento')->setKardex($kardexAct);
								$objRowOtorganteFilePdt->getItem('numeroDocumento')->setIdKardex($idKardex);
								$objRowOtorganteFilePdt->getItem('numeroDocumento')->setAct($nombreActo);
								$objRowOtorganteFilePdt->getItem('numeroDocumento')->setError(1);
								$objRowOtorganteFilePdt->getItem('numeroDocumento')->setErrorItem($contratante.',longitud de su  RUC, es incorrecto');
								#SI SON CONSTITUCIONES Y SU TIPO DE DOCUMENTO NO ES 10
								if($actoSunat == '22'){
									$objRowOtorganteFilePdt->getItem('numeroDocumento')->setCategoryCorrect(3);
									$objRowOtorganteFilePdt->getItem('numeroDocumento')->setTypeOfCorrection(1);
									$objRowOtorganteFilePdt->getItem('numeroDocumento')->setIsCorrectable(1);
									$objRowOtorganteFilePdt->getItem('numeroDocumento')->setIdContractor($idContratante);

								}


								$arrObjRowOtorganteFile[] = $objRowOtorganteFilePdt->getItem('numeroDocumento');



							}else{
								if(!ctype_digit($numeroDocumento)){
									//no es numerico
									$objRowOtorganteFilePdt->getItem('numeroDocumento')->setKardex($kardexAct);
									$objRowOtorganteFilePdt->getItem('numeroDocumento')->setIdKardex($idKardex);
									$objRowOtorganteFilePdt->getItem('numeroDocumento')->setAct($nombreActo);
									$objRowOtorganteFilePdt->getItem('numeroDocumento')->setError(1);
									$objRowOtorganteFilePdt->getItem('numeroDocumento')->setErrorItem($contratante.',no es un dato numerico su RUC');
									$arrObjRowOtorganteFile[] = $objRowOtorganteFilePdt->getItem('numeroDocumento');
								}
							}
						}
					}
					if(in_array($numeroDocumento, $arrOtorganteDnis)){
						$objRowOtorganteFilePdt->getItem('numeroDocumento')->setKardex($kardexAct);
						$objRowOtorganteFilePdt->getItem('numeroDocumento')->setIdKardex($idKardex);
						$objRowOtorganteFilePdt->getItem('numeroDocumento')->setAct($nombreActo);
						$objRowOtorganteFilePdt->getItem('numeroDocumento')->setError(1);
						$objRowOtorganteFilePdt->getItem('numeroDocumento')->setErrorItem($contratante.',el contratante existe mas de una ves en la lista de otorgantes');
						$arrObjRowOtorganteFile[] = $objRowOtorganteFilePdt->getItem('numeroDocumento');


					}else if($numeroDocumento != ''){
						$arrOtorganteDnis[] = $numeroDocumento;
					}



					#TIPO DE OTORGANTE
					$sql = "SELECT totorgante  FROM actocondicion WHERE idcondicion = '$idCondicion'";

					$resultCondicion = mysql_query($sql);
					if($rowCondicion = mysql_fetch_array($resultCondicion)){
						$tipoOtorgante = $rowCondicion['totorgante'];
						if($tipoOtorganteParte1 == $tipoOtorgante){
							$exiteOtorganteParte1 = true;
						}
						if($tipoOtorganteParte2 == $tipoOtorgante){
							$exiteOtorganteParte2 = true;
							$a = $tipoOtorgante;
						}
						//$arrTipoOtorgante[] = $tipoOtorgante;

					}else{
						$objRowOtorganteFilePdt->getItem('tipoOtorgante')->setKardex($kardexAct);
						$objRowOtorganteFilePdt->getItem('tipoOtorgante')->setIdKardex($idKardex);
						$objRowOtorganteFilePdt->getItem('tipoOtorgante')->setAct($nombreActo);
						$objRowOtorganteFilePdt->getItem('tipoOtorgante')->setError(1);
						$objRowOtorganteFilePdt->getItem('tipoOtorgante')->setErrorItem($contratante.',tipo de otorgante incorrecto');
						$arrObjRowOtorganteFile[] = $objRowOtorganteFilePdt->getItem('tipoOtorgante');
						$tipoOtorgante = '';
					}
					$objRowOtorganteFilePdt->getItem('tipoOtorgante')->setItemValue($tipoOtorgante);


					#TIPO DE PERSONA
					$tipoPersona = '';
					switch ($tipper) {
						case 'N':
							# code...
							$tipoPersona = 1;
							break;
						case 'J':
							$tipoPersona = 2;
							$apellidoPaterno = '';
							$apellidoMaterno = '';
							$primerNombre = '';
							$segundoNombre = '';
							break;
						default:
							# code...
							break;
					}
					$objRowOtorganteFilePdt->getItem('tipoPersona')->setItemValue($tipoPersona);

					#UBIGEO-UBICACIÓN
					if(strlen($Ubigeo) == 6)
						$objRowOtorganteFilePdt->getItem('codigoHubicacion')->setItemValue($Ubigeo);
					else
						$objRowOtorganteFilePdt->getItem('codigoHubicacion')->setItemValue('');
					#PORCENTAJE APROXIMADO
					$objRowOtorganteFilePdt->getItem('porcetanjeParticipacion')->setItemValue($porcentaje);

					if($tipoOtorganteParte1 == $tipoOtorgante){
						$sumPorcentajeParte1 = $sumPorcentajeParte1 + $porcentaje;
					}
					if($tipoOtorganteParte2 == $tipoOtorgante){
						$sumPorcentajeParte2 = $sumPorcentajeParte2 + $porcentaje;
					}


					#RAZON SOCIAL
					if(($tipoPersona == 2 || $tipoPersona == 4) && $razonSocial == ''){
						$objRowOtorganteFilePdt->getItem('razonSocial')->setKardex($kardexAct);
						$objRowOtorganteFilePdt->getItem('razonSocial')->setIdKardex($idKardex);
						$objRowOtorganteFilePdt->getItem('razonSocial')->setAct($nombreActo);
						$objRowOtorganteFilePdt->getItem('razonSocial')->setError(1);
						$objRowOtorganteFilePdt->getItem('razonSocial')->setErrorItem('Ingrese razon social para la Persona Juridica');
						$arrObjRowOtorganteFile[] = $objRowOtorganteFilePdt->getItem('razonSocial');
						//Reseteamos los valores de apepat,apemat,prinom,segnom
						/*$apellidoPaterno = '';
						$apellidoMaterno = '';
						$primerNombre = '';
						$segundoNombre = '';*/
						$objRowOtorganteFilePdt->getItem('razonSocial')->setItemValue($razonSocial);
					}
					if($tipoPersona == 1)
						$razonSocial = '';
					$objRowOtorganteFilePdt->getItem('razonSocial')->setItemValue($razonSocial);
					#APELLIDO PATERNO
					$objRowOtorganteFilePdt->getItem('apellidoPaterno')->setItemValue($apellidoPaterno);
					if($tipoPersona == 1 && $apellidoPaterno == ''){
						$objRowOtorganteFilePdt->getItem('apellidoPaterno')->setKardex($kardexAct);
						$objRowOtorganteFilePdt->getItem('apellidoPaterno')->setIdKardex($idKardex);
						$objRowOtorganteFilePdt->getItem('apellidoPaterno')->setAct($nombreActo);
						$objRowOtorganteFilePdt->getItem('apellidoPaterno')->setError(1);
						$objRowOtorganteFilePdt->getItem('apellidoPaterno')->setErrorItem($contratante.' Ingrese apellido Paterno para la Persona Natural');
						$arrObjRowOtorganteFile[] = $objRowOtorganteFilePdt->getItem('apellidoPaterno');
					}
					#APELLIDO MATERNO
					$objRowOtorganteFilePdt->getItem('apellidoMaterno')->setItemValue($apellidoMaterno);
					if($tipoPersona == 1  && $apellidoMaterno == ''){
						$objRowOtorganteFilePdt->getItem('apellidoMaterno')->setKardex($kardexAct);
						$objRowOtorganteFilePdt->getItem('apellidoMaterno')->setIdKardex($idKardex);
						$objRowOtorganteFilePdt->getItem('apellidoMaterno')->setAct($nombreActo);
						$objRowOtorganteFilePdt->getItem('apellidoMaterno')->setError(1);
						$objRowOtorganteFilePdt->getItem('apellidoMaterno')->setErrorItem($contratante.' Ingrese apellido Materno para la Persona Natural');
						$arrObjRowOtorganteFile[] = $objRowOtorganteFilePdt->getItem('apellidoMaterno');						
					}
					#PRIMER NOMBRE
					$objRowOtorganteFilePdt->getItem('primerNombre')->setItemValue($primerNombre);
					if($tipoPersona == 1  && $primerNombre == ''){
						$objRowOtorganteFilePdt->getItem('primerNombre')->setKardex($kardexAct);
						$objRowOtorganteFilePdt->getItem('primerNombre')->setIdKardex($idKardex);
						$objRowOtorganteFilePdt->getItem('primerNombre')->setAct($nombreActo);
						$objRowOtorganteFilePdt->getItem('primerNombre')->setError(1);
						$objRowOtorganteFilePdt->getItem('primerNombre')->setErrorItem($contratante.' Ingrese apellido Primer Nombre para la Persona Natural');
						$arrObjRowOtorganteFile[] = $objRowOtorganteFilePdt->getItem('primerNombre');	
					}

					#SEGUNDO NOMBRE
					$objRowOtorganteFilePdt->getItem('segundoNombre')->setItemValue($segundoNombre);



					#RENTA, PREGUNTA1,PREGUNTA2,PREGUNTA3
					$pregunta1 = '';
					$pregunta2 = '';
					$pregunta3 = '';
					$idRenta = 0;
					if($actoSunat == '24'){
						$pregunta1 = '';
						$pregunta2 = '';
						$pregunta3 = '';
					}
					if(in_array($actoSunat,array('01','22','16','26'))){
						if($tipper == 'J'){
							$pregunta1 = '';
							$pregunta2 = '';
							$pregunta3 = '';
						}
						if($tipper == 'N'){
							if($parte == '1'){
								$pregunta1 = '0';
								$pregunta2 = '0';
								$pregunta3 = '1';
							}
							if($parte == '2'){
								$pregunta1 = '';
								$pregunta2 = '';
								$pregunta3 = '';
							}
						}
					}
					if(in_array($actoSunat, array('04','03'))){

						if($tipper == 'J'){
							$pregunta1 = '';
							$pregunta2 = '';
							$pregunta3 = '';
						}
						if($tipper == 'N'){
							
							if($parte == '1'){
							
								$sql = "SELECT itemmp,kardex,fechaconst FROM  detallebienes WHERE kardex = '$kardexAct' AND idtipacto = '$tipoActoAct'";
								
								$resultDetalleBien = mysql_query($sql);
								$rowDetalleBien = mysql_fetch_array($resultDetalleBien);
								$fechaAdquisicion = $rowDetalleBien['fechaconst'];
								
								if($fechaAdquisicion != ''){
									$arrFechaAdquisicion = explode('/', $fechaAdquisicion);
									$numeroFechaAdquisicion = $arrFechaAdquisicion[2].$arrFechaAdquisicion[1].$arrFechaAdquisicion[0];
									
									
										$sql = "SELECT  idrenta,kardex,pregu1,pregu2,pregu3 FROM  renta WHERE idcontratante = '$idContratante' AND kardex = '$kardexAct'";
										$registroRenta = false;
										$resultRenta = mysql_query($sql);
										if($rowRenta = mysql_fetch_array($resultRenta)){
											$pregunta1 = $rowRenta['pregu1'];
											$pregunta2 = $rowRenta['pregu2'];
											$pregunta3 = $rowRenta['pregu3'];
											$idRenta = $rowRenta['idrenta'];
											if($pregunta1 == ''){
												$objRowOtorganteFilePdt->getItem('pregunta1')->setKardex($kardexAct);
												$objRowOtorganteFilePdt->getItem('pregunta1')->setIdKardex($idKardex);
												$objRowOtorganteFilePdt->getItem('pregunta1')->setAct($nombreActo);
												$objRowOtorganteFilePdt->getItem('pregunta1')->setError(1);
												$objRowOtorganteFilePdt->getItem('pregunta1')->setErrorItem($contratante.'. Renta, la pregunta #1 no se ha grabado correctamente');
												$arrObjRowOtorganteFile[] = $objRowOtorganteFilePdt->getItem('pregunta1');
											}
											if($pregunta2 == ''){
												$objRowOtorganteFilePdt->getItem('pregunta2')->setKardex($kardexAct);
												$objRowOtorganteFilePdt->getItem('pregunta2')->setIdKardex($idKardex);
												$objRowOtorganteFilePdt->getItem('pregunta2')->setAct($nombreActo);
												$objRowOtorganteFilePdt->getItem('pregunta2')->setError(1);
												$objRowOtorganteFilePdt->getItem('pregunta2')->setErrorItem($contratante.'. Renta,la pregunta #2 no se ha grabado correctamente');
												$arrObjRowOtorganteFile[] = $objRowOtorganteFilePdt->getItem('pregunta2');
											}
											if($pregunta3 == ''){
												$objRowOtorganteFilePdt->getItem('pregunta3')->setKardex($kardexAct);
												$objRowOtorganteFilePdt->getItem('pregunta3')->setIdKardex($idKardex);
												$objRowOtorganteFilePdt->getItem('pregunta3')->setAct($nombreActo);
												$objRowOtorganteFilePdt->getItem('pregunta3')->setError(1);
												$objRowOtorganteFilePdt->getItem('pregunta3')->setErrorItem($contratante.'. Renta,la pregunta #3 no se ha grabado correctamente');
												$arrObjRowOtorganteFile[] = $objRowOtorganteFilePdt->getItem('pregunta3');
											}


										}else{
											$objRowOtorganteFilePdt->getItem('pregunta1')->setKardex($kardexAct);
											$objRowOtorganteFilePdt->getItem('pregunta1')->setIdKardex($idKardex);
											$objRowOtorganteFilePdt->getItem('pregunta1')->setAct($nombreActo);
											$objRowOtorganteFilePdt->getItem('pregunta1')->setError(1);
											$objRowOtorganteFilePdt->getItem('pregunta1')->setCategoryCorrect(3);
											$objRowOtorganteFilePdt->getItem('pregunta1')->setTypeOfCorrection(3);
											$objRowOtorganteFilePdt->getItem('pregunta1')->setIsCorrectable(1);
											$objRowOtorganteFilePdt->getItem('pregunta1')->setIdContractor($idContratante);
											$objRowOtorganteFilePdt->getItem('pregunta1')->setErrorItem($contratante.',Ingrese renta de tercera categoria');
											$arrObjRowOtorganteFile[] = $objRowOtorganteFilePdt->getItem('pregunta1');
										}	
											
										
									
									/*else{
										$pregunta1 = '';
										$pregunta2 = '';
										$pregunta3 = '';
									}*/
								}else{
									$pregunta1 = '0';
									$pregunta2 = '0';
									$pregunta3 = '1';
								}


							}
							if($parte == 2){
								$pregunta1 = '';
								$pregunta2 = '';
								$pregunta3 = '';
							}
						}

					}
					#01: ANTICIPO ,16: PERMUTA  Y 22:APORTE DE SOCIEDADES SI TIENE RENTA
					if(!in_array($actoSunat, array('04','22','01','16','26'))){
						$pregunta1 = '';
						$pregunta2 = '';
						$pregunta3 = '';
					}
					$objRowOtorganteFilePdt->getItem('pregunta1')->setItemValue($pregunta1);
					$objRowOtorganteFilePdt->getItem('pregunta2')->setItemValue($pregunta2);
					$objRowOtorganteFilePdt->getItem('pregunta3')->setItemValue($pregunta3);


					$sql = "INSERT INTO temp_otg(idotg, idtipkar, numescritura, fechaescritura, secuencialacto, secubien, secuencialoto, tipodocu, numdocu, tipootorgante, tipper, ubigeo, porcentaje, razonsocial, apepat, apemat, prinom, segnom, pregu1, pregu2, pregu3, idrenta) VALUES (NULL,'$idTipoKardex','$numeroEscritura','$fechaEscritura','$secuencialActo','$numeroSecuencialBien','$numeroSecuencialOtorgante','$oTipoDocumento','$numeroDocumento','$tipoOtorgante','$tipoPersona','$Ubigeo','$porcentaje','$razonSocial','$apellidoPaterno','$apellidoMaterno','$primerNombre','$segundoNombre','$pregunta1','$pregunta2','$pregunta3','$idRenta')";
					//die($sql);
					$resultTempOtg = mysql_query($sql);

					$keyArrError = $kardexAct.'_'.$idKardex.'_otorgante_'.$numeroSecuencialOtorgante;
					//die($keyArrError);
					$this->_arrErrorItems[$keyArrError] = $arrObjRowOtorganteFile;
					$this->_arrObjOtorganteFilePdt[]  =  $objRowOtorganteFilePdt;

					$numeroSecuencialOtorgante = $numeroSecuencialOtorgante + 1;
				}


				//$this->_arrErrorsPdt = $this->_arrErrorItems;


			}

			//VALIDACIONES EXTRAS 
			#TIPO DE OTORGANTE
			if(!$exiteOtorganteParte1 && $tipoOtorganteParte1 != 0){
				$arrObjRowOtorganteFile = array();
				$objRowOtorganteFilePdt = new OtorganteFilePdt();
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setKardex($kardexAct);
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setIdKardex($idKardex);
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setAct($nombreActo);
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setError(1);
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setErrorItem('Falta registrar el '.$descripcionTipoOtorganteParte1);
				$arrObjRowOtorganteFile[] = $objRowOtorganteFilePdt->getItem('filaOtorgante');
				$keyArrError = $kardexAct.'_'.$idKardex.'_otorgante_'.$numeroSecuencialOtorgante.'_tipo_otorgante';
				$this->_arrErrorItems[$keyArrError] = $arrObjRowOtorganteFile;

			}
			if(!$exiteOtorganteParte2 && $tipoOtorganteParte2 != 0){
				
				
				$arrObjRowOtorganteFile = array();
				$objRowOtorganteFilePdt = new OtorganteFilePdt();
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setKardex($kardexAct);
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setIdKardex($idKardex);
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setAct($nombreActo);
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setError(1);
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setErrorItem('Falta registrar el '.$descripcionTipoOtorganteParte2);
				$arrObjRowOtorganteFile[] = $objRowOtorganteFilePdt->getItem('filaOtorgante');
				$keyArrError = $kardexAct.'_'.$idKardex.'_otorgante_'.$numeroSecuencialOtorgante.'_tipo_otorgante';
				$this->_arrErrorItems[$keyArrError] = $arrObjRowOtorganteFile;
			}
			#SUMA DE PORCENTAJES DE LOS TIPOS DE OTORGANTES TIENE QUE SER IGUAL AL 100%
			$porcenjateObligatorio = number_format(100,2,'.','');
			$sumPorcentajeParte1 = number_format($sumPorcentajeParte1,2,'.','');
			$sumPorcentajeParte2 = number_format($sumPorcentajeParte2,2,'.','');
			if($sumPorcentajeParte1 != $porcenjateObligatorio && $exiteOtorganteParte1){
				$arrObjRowOtorganteFile = array();
				$objRowOtorganteFilePdt = new OtorganteFilePdt();
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setKardex($kardexAct);
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setIdKardex($idKardex);
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setAct($nombreActo);
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setError(1);
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setErrorItem('Asigne el porcentaje de participacion por contratante....');
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setCategoryCorrect(3);
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setTypeOfCorrection(2);
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setIsCorrectable(1);
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setTypeAct($tipoActoAct);
				$arrObjRowOtorganteFile[] = $objRowOtorganteFilePdt->getItem('filaOtorgante');
				$keyArrError = $kardexAct.'_'.$idKardex.'_otorgante_'.$numeroSecuencialOtorgante.'_porcentaje';
				$this->_arrErrorItems[$keyArrError] = $arrObjRowOtorganteFile;
			}
			else if($sumPorcentajeParte2 != $porcenjateObligatorio && $exiteOtorganteParte2){
				$arrObjRowOtorganteFile = array();
				$objRowOtorganteFilePdt = new OtorganteFilePdt();
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setKardex($kardexAct);
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setIdKardex($idKardex);
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setAct($nombreActo);
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setError(1);
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setErrorItem('Asigne el porcentaje de participacion por contratante');
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setCategoryCorrect(3);
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setTypeOfCorrection(2);
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setIsCorrectable(1);
				$objRowOtorganteFilePdt->getItem('filaOtorgante')->setTypeAct($tipoActoAct);
				$arrObjRowOtorganteFile[] = $objRowOtorganteFilePdt->getItem('filaOtorgante');
				$keyArrError = $kardexAct.'_'.$idKardex.'_otorgante_'.$numeroSecuencialOtorgante.'_porcentaje';
				$this->_arrErrorItems[$keyArrError] = $arrObjRowOtorganteFile;
			}


		}


	}

	public function generateFileOtorgante(){
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
		$arrDate = explode('/', $this->_initialDate);
		$year = $arrDate[2];

		$file = "3520".$year.$rucNotario.".Otg";
		header('Content-Type: application/force-download');
		header('Content-Disposition: attachment; filename='.$file);
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: '.filesize($file));
		

		foreach ($this->_arrObjOtorganteFilePdt   as $objRow) {
			echo str_pad(substr(intval($objRow->getItem('tipoKardex')->getItemValue()),0,1),1," ",STR_PAD_LEFT)."|".
			str_pad(substr(intval($objRow->getItem('numeroEscritura')->getItemValue()),0,5),5," ",STR_PAD_LEFT)."|".
			str_pad(substr($objRow->getItem('fechaEscritura')->getItemValue(),0,10),10," ",STR_PAD_LEFT)."|".
			str_pad(substr($objRow->getItem('numeroSecuencialActo')->getItemValue(),0,5),5," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('numeroSecuencialBien')->getItemValue(),0,5),5," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('numeroSecuencialOtorgante')->getItemValue(),0,5),5," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('tipoDocumento')->getItemValue(),0,2),2," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('numeroDocumento')->getItemValue(),0,12),12," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('tipoOtorgante')->getItemValue(),0,2),2," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('tipoPersona')->getItemValue(),0,1),1," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('codigoHubicacion')->getItemValue(),0,6),6," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('porcetanjeParticipacion')->getItemValue(),0,6),6," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('razonSocial')->getItemValue(),0,40),40," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('apellidoPaterno')->getItemValue(),0,20),20," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('apellidoMaterno')->getItemValue(),0,20),20," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('primerNombre')->getItemValue(),0,20),20," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('segundoNombre')->getItemValue(),0,30),30," ",STR_PAD_RIGHT)."|".
			str_pad($objRow->getItem('pregunta1')->getItemValue(),1," ",STR_PAD_RIGHT)."|".str_pad($objRow->getItem('pregunta2')->getItemValue(),1," ",STR_PAD_RIGHT)."|".
			str_pad($objRow->getItem('pregunta3')->getItemValue(),1," ",STR_PAD_RIGHT)."|".chr(13).chr(10);

		}


	}

	public function  loadDataMedioPago(){

		$sql = "SELECT  idKardex,kardex,nombreActo,itemmp,idtipkar,numescritura,fechaescritura,fechaconclusion,fechalegal,actosunat,tipoacto,secuencialacto,idmon,importetransac,plazoini,plazofin,desacto,mminuta,exhibiomp,temp FROM temp_act ORDER BY CAST(numescritura AS UNSIGNED) ASC";
		$resultTempAct = mysql_query($sql);
		$numeroSecuencialMedioPago = 1;
		$arrActosMediosPago = array('04','10','24','26');
		while($rowTempAct = mysql_fetch_array($resultTempAct)){
			$idKardex = $rowTempAct['idKardex'];
			$kardexAct = $rowTempAct['kardex'];
			$nombreActo = $rowTempAct['nombreActo'];
			$idTipoKardex = $rowTempAct['idtipkar'];
			$tipoActoAct = $rowTempAct['tipoacto'];
			$numeroEscritura = $rowTempAct['numescritura'];
			$fechaEscritura = $rowTempAct['fechaescritura'];
			$fechaConclusion = $rowTempAct['fechaconclusion'];
			$itemMpAct = $rowTempAct['itemmp'];
			$exhibioMp = $rowTempAct['exhibiomp'];
			$secuencialActo = $rowTempAct['secuencialacto'];

			if($idTipoKardex == 1){
				$tipoKardex = '1';
			}else if($idTipoKardex == 3){
				$tipoKardex = '2';
			}else if($idTipoKardex == 4){
				$tipoKardex = '5';
			}

			$objRowMedioFilePdt = new MedioFilePdt();
			if($exhibioMp == 1){
				$sql = "SELECT detmp,itemmp,kardex,tipacto,codmepag,fpago,idbancos,importemp,idmon,foperacion,documentos FROM  detallemediopago WHERE itemmp = '$itemMpAct'";
				$resultDetalleMedioPago = mysql_query($sql);
				$arrObjRowMedioFile = array();

				if(mysql_affected_rows() != 0){
					while($rowDetalleMedioPago = mysql_fetch_array($resultDetalleMedioPago)){
						$idTipoActo = $rowDetalleMedioPago['tipacto'];
						$detMp = $rowDetalleMedioPago['detmp'];
						$codigoMedioPago = $rowDetalleMedioPago['codmepag'];
						$idBanco = $rowDetalleMedioPago['idbancos'];
						$importeMp = $rowDetalleMedioPago['importemp'];
						$idMoneda = $rowDetalleMedioPago['idmon'];
						$fechaOperacion = $rowDetalleMedioPago['foperacion'];
						$documentos = $this->remplaceStringPdt($rowDetalleMedioPago['documentos']);
						$sql = "SELECT actosunat FROM tiposdeacto WHERE idtipoacto = '$idTipoActo' LIMIT 1";

						$resultTipoActo = mysql_query($sql);
						$rowTipoActo = mysql_fetch_array($resultTipoActo);
						$actoSunatMedioPago = $rowTipoActo['actosunat']; 

						if(in_array($actoSunatMedioPago, $arrActosMediosPago)){

							

							#TIPO DE KARDEX
							$objRowMedioFilePdt->getItem('tipoKardex')->setItemValue($tipoKardex);
							#NUMERO DE ESCRITURA
							$objRowMedioFilePdt->getItem('numeroEscritura')->setItemValue($numeroEscritura);
							#NUMERO SECUENCIAL
							$objRowMedioFilePdt->getItem('numeroSecuencialActo')->setItemValue($secuencialActo);

							$sql = "SELECT codmepag,uif,sunat,desmpagos FROM  mediospago WHERE codmepag = '$codigoMedioPago' LIMIT 1 ";

							$resultMedioPago = mysql_query($sql);
							$rowMedioPago = mysql_fetch_array($resultMedioPago);
							$uifMedioPago = $rowMedioPago['uif'];
							$sunatMedioPago = $rowMedioPago['sunat'];
							$descripcionMedioPago = $rowMedioPago['desmpagos'];
							#MEDIO DE PAGO
							$objRowMedioFilePdt->getItem('medioPago')->setItemValue($sunatMedioPago);
							$arrMedioPagos = array('001','002','003','004','005','006','007','008','009','010','011','012','013','099');
							$arrMedioPagoDocumento = array('001','002','003','005','006','007','012','099');
							$arrMedioPagoBancos = array('001','002','003','005','006','007','012');
							if(!in_array($sunatMedioPago, $arrMedioPagos)){
								//Error de medio de pago
								$objRowMedioFilePdt->getItem('medioPago')->setKardex($kardexAct);
								$objRowMedioFilePdt->getItem('medioPago')->setIdKardex($idKardex);
								$objRowMedioFilePdt->getItem('medioPago')->setAct($nombreActo);
								$objRowMedioFilePdt->getItem('medioPago')->setError(1);
								$objRowMedioFilePdt->getItem('medioPago')->setErrorItem('Codigo de medio de pago es incorrecto');
								$arrObjRowMedioFile[] = $objRowMedioFilePdt->getItem('medioPago');
							}

							$codigoMoneda = '';
							switch ($idMoneda) {
								case '1':
									# code...
									$codigoMoneda = '2';
									break;
								case '2':
									$codigoMoneda = '1';
									break;
								default:
									# code...
									break;
							}
							$objRowMedioFilePdt->getItem('monedaMedioPago')->setItemValue($codigoMoneda);
							$objRowMedioFilePdt->getItem('montoPagado')->setItemValue($importeMp);

							$objRowMedioFilePdt->getItem('fechaPago')->setItemValue($fechaOperacion);
							if($fechaOperacion == ''){
								//Error de fecha de la operacion
								$objRowMedioFilePdt->getItem('fechaPago')->setKardex($kardexAct);
								$objRowMedioFilePdt->getItem('fechaPago')->setIdKardex($idKardex);
								$objRowMedioFilePdt->getItem('fechaPago')->setAct($nombreActo);
								$objRowMedioFilePdt->getItem('fechaPago')->setError(1);
								$objRowMedioFilePdt->getItem('fechaPago')->setErrorItem('Ingrese fecha de operacion del medio de pago');
								$arrObjRowMedioFile[] = $objRowMedioFilePdt->getItem('fechaPago');	
							}

							


							if($documentos == '' && in_array($sunatMedioPago, $arrMedioPagoDocumento)){
								//Error de documentos
								$objRowMedioFilePdt->getItem('numeroDocumentoMedioPago')->setKardex($kardexAct);
								$objRowMedioFilePdt->getItem('numeroDocumentoMedioPago')->setIdKardex($idKardex);
								$objRowMedioFilePdt->getItem('numeroDocumentoMedioPago')->setAct($nombreActo);
								$objRowMedioFilePdt->getItem('numeroDocumentoMedioPago')->setTypeAct($tipoActoAct);
								$objRowMedioFilePdt->getItem('numeroDocumentoMedioPago')->setitemMp($itemMpAct);
								$objRowMedioFilePdt->getItem('numeroDocumentoMedioPago')->setError(1);
								$objRowMedioFilePdt->getItem('numeroDocumentoMedioPago')->setCategoryCorrect(4);
								$objRowMedioFilePdt->getItem('numeroDocumentoMedioPago')->setTypeOfCorrection(1);
								$objRowMedioFilePdt->getItem('numeroDocumentoMedioPago')->setIsCorrectable(1);
								$objRowMedioFilePdt->getItem('numeroDocumentoMedioPago')->setErrorItem('Ingrese documentos del medio de pago.');
								$arrObjRowMedioFile[] = $objRowMedioFilePdt->getItem('numeroDocumentoMedioPago');
							}
							if(!in_array($sunatMedioPago, $arrMedioPagoDocumento)){
								$documentos = '';
							}
							$objRowMedioFilePdt->getItem('numeroDocumentoMedioPago')->setItemValue($documentos);
							
							$arrBancos = array('02','03','05','07','08','09','11','12','16','18','22','23','25','26','29','35','37','38','39','40','41','42','43','44','45','46','47','48','49','50','99','51','53','54','55','56','58');
							$sql = "SELECT codbancos,desbanco FROM  bancos WHERE idbancos = '$idBanco' LIMIT 1";
							$resultBanco = mysql_query($sql);
							$rowBanco = mysql_fetch_array($resultBanco);
							$codigoBanco = $rowBanco['codbancos'];
							$descripcionBanco  = $rowBanco['desbanco'];
							
							if(!in_array($codigoBanco, $arrBancos) && in_array($sunatMedioPago, $arrMedioPagoBancos)){
								//Error del banco
								$objRowMedioFilePdt->getItem('entidadFinanciera')->setKardex($kardexAct);
								$objRowMedioFilePdt->getItem('entidadFinanciera')->setIdKardex($idKardex);
								$objRowMedioFilePdt->getItem('entidadFinanciera')->setAct($nombreActo);
								$objRowMedioFilePdt->getItem('entidadFinanciera')->setError(1);
								$objRowMedioFilePdt->getItem('entidadFinanciera')->setErrorItem('Codigo de la entidad financiera es incorrecto');
								$arrObjRowMedioFile[] = $objRowMedioFilePdt->getItem('entidadFinanciera');
							}
							if(!in_array($sunatMedioPago, $arrMedioPagoBancos)){
								$codigoBanco = '';
							}
							$objRowMedioFilePdt->getItem('entidadFinanciera')->setItemValue($codigoBanco);


							$keyArrError = $kardexAct.'_'.$idKardex.'_medio_'.$secuencialActo;
							//die($keyArrError);
							$this->_arrErrorItems[$keyArrError] = $arrObjRowMedioFile;
							$this->_arrObjMedioFilePdt[]  =  $objRowMedioFilePdt;

						}
						//$this->_arrErrorsPdt = $this->_arrErrorItems;


					}
				}else{
					$sql = "SELECT detmp FROM detallemediopago WHERE kardex = '$kardexAct' AND tipacto = '$tipoActoAct'";
					$result = mysql_query($sql);
					if(mysql_affected_rows() != 0){
						$objRowMedioFilePdt->getItem('filaMedioPago')->setKardex($kardexAct);
						$objRowMedioFilePdt->getItem('filaMedioPago')->setIdKardex($idKardex);
						$objRowMedioFilePdt->getItem('filaMedioPago')->setAct($nombreActo);
						$objRowMedioFilePdt->getItem('filaMedioPago')->setTypeAct($tipoActoAct);
						$objRowMedioFilePdt->getItem('filaMedioPago')->setError(1);
						$objRowMedioFilePdt->getItem('filaMedioPago')->setitemMp($itemMpAct);
						$objRowMedioFilePdt->getItem('filaMedioPago')->setCategoryCorrect(4);
						$objRowMedioFilePdt->getItem('filaMedioPago')->setTypeOfCorrection(2);
						$objRowMedioFilePdt->getItem('filaMedioPago')->setIsCorrectable(1);

						$objRowMedioFilePdt->getItem('filaMedioPago')->setErrorItem('Si  existe registro de medio de pago, pero  su item de medio de pago esta vacio.');
						$arrObjRowMedioFile[] = $objRowMedioFilePdt->getItem('filaMedioPago');
						$keyArrError = $kardexAct.'_'.$idKardex.'_medio_'.$secuencialActo;
						//die($keyArrError);
						$this->_arrErrorItems[$keyArrError] = $arrObjRowMedioFile;
						$this->_arrObjMedioFilePdt[]  =  $objRowMedioFilePdt;
					}
						

				}

			}

		}		

	}

	public function generateFileMedio(){
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
		$arrDate = explode('/', $this->_initialDate);
		$year = $arrDate[2];

		$file = "3520".$year.$rucNotario.".Mpa";
		header('Content-Type: application/force-download');
		header('Content-Disposition: attachment; filename='.$file);
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: '.filesize($file));
		

		foreach ($this->_arrObjMedioFilePdt   as $objRow) {
			echo str_pad(substr(intval($objRow->getItem('tipoKardex')->getItemValue()),0,1),1," ",STR_PAD_LEFT)."|".
				str_pad(substr(intval($objRow->getItem('numeroEscritura')->getItemValue()),0,5),5," ",STR_PAD_LEFT)."|".
				str_pad(substr($objRow->getItem('numeroSecuencialActo')->getItemValue(),0,5),5," ",STR_PAD_RIGHT)."|".
				str_pad(substr($objRow->getItem('medioPago')->getItemValue(),0,3),3," ",STR_PAD_RIGHT)."|".
				str_pad(substr($objRow->getItem('monedaMedioPago')->getItemValue(),0,1),1," ",STR_PAD_RIGHT)."|".
				str_pad(substr($objRow->getItem('montoPagado')->getItemValue(),0,15),15," ",STR_PAD_RIGHT)."|".
				str_pad(substr($objRow->getItem('fechaPago')->getItemValue(),0,10),10," ",STR_PAD_RIGHT)."|".
				str_pad(substr($objRow->getItem('numeroDocumentoMedioPago')->getItemValue(),0,25),25," ",STR_PAD_RIGHT)."|".
				str_pad(substr($objRow->getItem('entidadFinanciera')->getItemValue(),0,2),2," ",STR_PAD_RIGHT)."|".chr(13).chr(10);

		}
	}

	public function  loadDataFormulario(){
		$sql = "SELECT idtipkar,numescritura,secuencialacto,secuencialoto,tipootorgante,idrenta FROM temp_otg";
		$resultOtorgante = mysql_query($sql);
		$arrObjRowFormFile = array();
		while($rowOtorgante = mysql_fetch_array($resultOtorgante)){
			$idTipoKardex = $rowOtorgante['idtipkar'];
			$numeroEscritura = $rowOtorgante['numescritura'];
			$secuencialActo = $rowOtorgante['secuencialacto'];
			$secuencialOtorgante = $rowOtorgante['secuencialoto'];
			$tipoOtorgante = $rowOtorgante['tipootorgante'];
			$idRenta = $rowOtorgante['idrenta'];
				
			if($idRenta != 0){
				$objRowFormFilePdt = new FormFilePdt();
				$sql = "SELECT idformulario,idrenta,numformu,monto FROM formulario WHERE idrenta = '$idRenta' LIMIT 1";
				$resultRenta = mysql_query($sql);
				$numeroFormulario = '';
				$monto = '';
				if($rowRenta  = mysql_fetch_array($resultRenta)){
					$numeroFormulario = $rowRenta['numformu'];
					$monto = $rowRenta['monto'];
				}
				$objRowFormFilePdt->getItem('tipoKardex')->setItemValue($idTipoKardex);
				$objRowFormFilePdt->getItem('numeroEscritura')->setItemValue($numeroEscritura);	
				$objRowFormFilePdt->getItem('numeroSecuencialActo')->setItemValue($secuencialActo);	
				$objRowFormFilePdt->getItem('numeroSecuencialOtorgante')->setItemValue($secuencialOtorgante);
				$objRowFormFilePdt->getItem('tipoOtorgante')->setItemValue($tipoOtorgante);
				$objRowFormFilePdt->getItem('numeroFormulario')->setItemValue($numeroFormulario);
				$objRowFormFilePdt->getItem('pagoCuenta')->setItemValue($monto);			

				$keyArrError = 'form_'.$secuencialOtorgante;
				//die($keyArrError);
				$this->_arrErrorItems[$keyArrError] = $arrObjRowFormFile;
				$this->_arrObjFormFilePdt[]  =  $objRowFormFilePdt;

			}

		}
		$this->_arrErrorsPdt = $this->_arrErrorItems;

	}
	public function generateFileForm(){
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
		$arrDate = explode('/', $this->_initialDate);
		$year = $arrDate[2];

		$file = "3520".$year.$rucNotario.".For";
		header('Content-Type: application/force-download');
		header('Content-Disposition: attachment; filename='.$file);
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: '.filesize($file));
		

		foreach ($this->_arrObjFormFilePdt   as $objRow) {
			echo str_pad(substr(intval($objRow->getItem('tipoKardex')->getItemValue()),0,1),1," ",STR_PAD_LEFT)."|".
			str_pad(substr(intval($objRow->getItem('numeroEscritura')->getItemValue()),0,5),5," ",STR_PAD_LEFT)."|".
			str_pad(substr($objRow->getItem('numeroSecuencialActo')->getItemValue(),0,5),5," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('numeroSecuencialOtorgante')->getItemValue(),0,5),5," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('tipoOtorgante')->getItemValue(),0,2),2," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('numeroFormulario')->getItemValue(),0,10),10," ",STR_PAD_RIGHT)."|".
			str_pad(substr($objRow->getItem('pagoCuenta')->getItemValue(),0,15),15," ",STR_PAD_RIGHT)."|".chr(13).chr(10);

		}
	}


	public function  getCountErrors(){
		$countErrors = 0;
		foreach ($this->_arrErrorsPdt as $key => $row) {
			$countErrors = $countErrors + count($this->_arrErrorsPdt[$key]);
		}
		return $countErrors;
	}
	public function  getTotalKardex(){
		return  $this->_totalKardex;
	}

	public function  getRowActiFile(){
		return $this->_arrErrorsPdt;

	}
	public function  getErrorsLib(){
		return $this->_arrErrorsPdt;

	}
	public function getTotalLibro(){
		return $this->_totalLibro;
	}

	public function  loadDataLibro(){
		$sql = "SELECT numlibro,fecing,tipper,apepat,apemat,prinom,segnom,ruc,empresa,idtiplib,folio,ano  FROM libros WHERE fecing BETWEEN STR_TO_DATE('$this->_initialDate','%d/%m/%Y') AND STR_TO_DATE('$this->_finalDate','%d/%m/%Y') AND (CAST(idtiplib AS UNSIGNED)>=1 AND CAST(idtiplib AS UNSIGNED)<= 15) AND idnlibro <> '0'";
		//die($sql);
		$result = mysql_query($sql);
		$this->_totalLibro = mysql_affected_rows();
		$numeroSecuencial = 0;
		$arrTipoLibro = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15');
		while($row = mysql_fetch_array($result)){
			$numeroSecuencial++;
			$numeroLibro = $row['numlibro'];
			$fechaIngreso = $row['fecing'];
			$tipoPersona = $row['tipper'] == 'N'?1:2;
			$apellidoPaterno = $row['apepat'];
			$apellidoMaterno = $row['apemat'];
			$primerNombre = $row['prinom'];
			$segundoNombre = $row['segnom'];
			$ruc = $row['ruc'];
			$razonSocial = $row['empresa'];
			$idTipoLibro = $row['idtiplib'];
			$folio = $row['folio'];
			$anio = $row['ano'];
			$idNumeroLibro  = $numeroLibro.'-'.$anio;

			$arrFechaIngreso = explode('-', $fechaIngreso);
			$formatFechaIngreso = $arrFechaIngreso[2].'/'.$arrFechaIngreso[1].'/'.$arrFechaIngreso[0];

			$objLibFilePdt = new LibFilePdt();
			$arrObjRowLibFile = array();
			
			$objLibFilePdt->getItem('numeroLibro')->setItemValue($numeroLibro);
			$objLibFilePdt->getItem('fechaIngreso')->setItemValue($formatFechaIngreso);
			$objLibFilePdt->getItem('folio')->setItemValue($folio);
			$objLibFilePdt->getItem('idTipoLibro')->setItemValue($idTipoLibro);
			$objLibFilePdt->getItem('tipoPersona')->setItemValue($tipoPersona);
			$objLibFilePdt->getItem('ruc')->setitemValue($ruc);
			$objLibFilePdt->getItem('apellidoPaterno')->setItemValue($apellidoPaterno);
			$objLibFilePdt->getItem('apellidoMaterno')->setItemValue($apellidoMaterno);
			$objLibFilePdt->getItem('primerNombre')->setitemValue($primerNombre);
			$objLibFilePdt->getItem('segundoNombre')->setItemValue($segundoNombre);
			$objLibFilePdt->getItem('razonSocial')->setitemValue($razonSocial);
			
			#validando TIPO DE LIBRO
			if(!in_array($idTipoLibro, $arrTipoLibro)){
				$objLibFilePdt->getItem('idTipoLibro')->setErrorItem('El numero de tipo de libro '. $idTipoLibro. ',es incorrecto');
				$objLibFilePdt->getItem('idTipoLibro')->setBookNumber($idNumeroLibro);
				$arrObjRowLibFile[] =  $objLibFilePdt->getItem('idTipoLibro');
			}

			
			$objLibFilePdt->getItem('folio')->setItemValue($folio);
			#validando NUMERO DE LIBRO
			if($numeroLibro == ''){
				$objLibFilePdt->getItem('numeroLibro')->setErrorItem('Ingrese numero de libro');
				$objLibFilePdt->getItem('numeroLibro')->setBookNumber($idNumeroLibro);
				$arrObjRowLibFile[] =  $objLibFilePdt->getItem('numeroLibro');
			}
			#validando FECHA DE INGRESO

			#validando FOLIO
			if($folio == ''){
				$objLibFilePdt->getItem('folio')->setErrorItem('Ingrese folio');
				$objLibFilePdt->getItem('folio')->setBookNumber($idNumeroLibro);
				$arrObjRowLibFile[] = $objLibFilePdt->getItem('folio');
			}
			#validando RUC
			if(strlen($ruc) != 11 || !ctype_digit($ruc)){
				$objLibFilePdt->getItem('ruc')->setBookNumber($idNumeroLibro);
				$objLibFilePdt->getItem('ruc')->setErrorItem('RUC Incorrecto');

				$arrObjRowLibFile[] = $objLibFilePdt->getItem('ruc');
			}
			#validando APELLIDO PATERNO
			if($tipoPersona == 1){
				if($apellidoPaterno == ''){
					$objLibFilePdt->getItem('apellidoPaterno')->setErrorItem('Ingrese Apellido Paterno');
					$objLibFilePdt->getItem('apellidoPaterno')->setBookNumber($idNumeroLibro);
					$arrObjRowLibFile[] = $objLibFilePdt->getItem('apellidoPaterno');
				}
				if($apellidoMaterno == ''){
					$objLibFilePdt->getItem('apellidoMaterno')->setErrorItem('Ingrese Apellido Materno');
					$objLibFilePdt->getItem('apellidoMaterno')->setBookNumber($idNumeroLibro);
					$arrObjRowLibFile[] = $objLibFilePdt->getItem('apellidoMaterno');
				}
				if($primerNombre == ''){
					$objLibFilePdt->getItem('primerNombre')->setErrorItem('Ingrese Primer Nombre');
					$objLibFilePdt->getItem('primerNombre')->setBookNumber($idNumeroLibro);
					$arrObjRowLibFile[] =  $objLibFilePdt->getItem('primerNombre');
				}
			}
			#valindando RAZON SOCIAL
			if($tipoPersona == 2){
				if($razonSocial == ''){
					$objLibFilePdt->getItem('razonSocial')->setErrorItem('Ingrese Razon Social');
					$objLibFilePdt->getItem('razonSocial')->setBookNumber($idNumeroLibro);
					$arrObjRowLibFile[] = $objLibFilePdt->getItem('razonSocial');
				}
				
			}	

			$keyArrError = $numeroLibro.'_libro_'.$numeroSecuencial;
			$this->_arrErrorItems[$keyArrError] = $arrObjRowLibFile;
			$this->_arrObjLibFilePdt[]  =  $objLibFilePdt;	

		}
		$this->_arrErrorsPdt = $this->_arrErrorItems;
	}

	public function generateFileLibro(){
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
		$arrDate = explode('/', $this->_initialDate);
		$year = $arrDate[2];
		$file = "3520".$year.$rucNotario.".lib";
		header('Content-Type: application/force-download');
		header('Content-Disposition: attachment; filename='.$file);
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: '.filesize($file));
		//die('hola');
		foreach ($this->_arrObjLibFilePdt   as $objRow) {

			echo str_pad(substr($objRow->getItem('numeroLibro')->getItemValue(),0,10),10," ",STR_PAD_LEFT)."|"; 
			echo $objRow->getItem('fechaIngreso')->getItemValue()."|";
			echo str_pad(substr(intval($objRow->getItem('idTipoLibro')->getItemValue()),0,2),2," ",STR_PAD_LEFT)."|";
			echo str_pad(substr(intval($objRow->getItem('folio')->getItemValue()),0,10),10," ",STR_PAD_LEFT)."|";
			echo $objRow->getItem('tipoPersona')->getItemValue()."|";
			echo str_pad(substr($objRow->getItem('ruc')->getItemValue(),0,11),11," ",STR_PAD_RIGHT)."|";
			echo str_pad(strtoupper (substr($this->remplaceStringPdt($objRow->getItem('apellidoPaterno')->getItemValue()),0,15)),15," ",STR_PAD_RIGHT)."|";
			echo str_pad(strtoupper (substr($this->remplaceStringPdt($objRow->getItem('apellidoMaterno')->getItemValue()),0,15)),15," ",STR_PAD_RIGHT)."|";
			echo str_pad(strtoupper (substr($this->remplaceStringPdt($objRow->getItem('primerNombre')->getItemValue()),0,15)),15," ",STR_PAD_RIGHT)."|";
			echo  str_pad(strtoupper (substr($this->remplaceStringPdt($objRow->getItem('segundoNombre')->getItemValue()),0,30)),30," ",STR_PAD_RIGHT)."|";
			echo str_pad(strtoupper (substr($this->remplaceStringPdt($objRow->getItem('razonSocial')->getItemValue()),0,40)),40," ",STR_PAD_RIGHT)."|".chr(13).chr(10);

		}

	}

	public function remplaceStringPdt($dato){
		$dato1=str_replace("?"," ",$dato);
	    $dato2=str_replace("*"," ",$dato1);
	    $dato3=str_replace("QQ11QQ"," ",$dato2);
		$dato4=str_replace("Ñ","N",$dato3);
		$dato5=str_replace("ñ","n",$dato4);
		$dato6=str_replace("°"," ",$dato5);
		$dato7=str_replace("#"," ",$dato6);
		$dato8=str_replace("é"," ",$dato7);
		$dato9=str_replace("á"," ",$dato8);
		$dato10=str_replace("í"," ",$dato9);
		$dato11=str_replace("ó"," ",$dato10);
		$dato12=str_replace("ú"," ",$dato11);
		$dato13=str_replace("'"," ",$dato12);
		$dato14=str_replace("&"," ",$dato13);
		$dato15=str_replace("É"," ",$dato14);
		$dato16=str_replace("Á"," ",$dato15);
		$dato17=str_replace("Ó"," ",$dato16);
		$dato18=str_replace("Ú"," ",$dato17);
		$dato19=str_replace("Í"," ",$dato18);
		$dato20 = str_replace(","," ",$dato19);
	    $resultado=str_replace("QQ22KK"," ",$dato20); 
	    return $resultado;	
	}

	function validateDate($date)
	{
	    return preg_match('/^(\d\d\/\d\d\/\d\d\d\d){1,1}$/', $date);
	}



}