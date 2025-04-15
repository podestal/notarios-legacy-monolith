<?php
require_once 'conexion.php';
//die('hola');
$kardex = $_POST['kardex'];
$all = $_POST['all'];
function updateKardex($kardex){
	global $conn;
	$sql = "SELECT  idcontratante,idtipkar,kardex,condicion,firma,fechafirma,resfirma,tiporepresentacion,idcontratanterp,idsedereg,numpartida,facultades,indice,visita,inscrito FROM contratantes WHERE kardex = '$kardex'";
	//die($sql);
	$result = mysqli_query($conn,$sql);

	while($row = mysqli_fetch_array($result)){

		$idcontra = $row['idcontratante'];
		$idtipkar = $row['idtipkar'];
		$codkardex = $row['kardex'];
		$codconn = $row['condicion'];
		$firma = $row['firma'];
		$fechaFirma = $row['fechafirma'];
		$resfirma = $row['resfirma'];
		$tipoRepresentacion = $row['tiporepresentacion'];
		$idcontratanteR = $row['idcontratanterp'];
		$idSedeReg = $row['idsedereg'];
		$numeroPartida = $row['numpartida'];
		$facultades = $row['facultades'];
		$indice = $row['indice'];
		$visita = $row['visita'];
		$inscrito = $row['inscrito'];


		$sqldelcontaxacto = "DELETE FROM contratantesxacto WHERE idcontratante='$idcontra'"; 
		mysqli_query($conn,$sqldelcontaxacto) or die(mysqli_error());


		$condiciones = explode("/",$codconn);
		$condi1 = $condiciones[0];
		$condi2 = $condiciones[1];
		$condi3 = $condiciones[2];
		$condi4 = $condiciones[3];
		$condi5 = $condiciones[4];
		$condi6 = $condiciones[5];
		$condi7 = $condiciones[6];
		$condi8 = $condiciones[7];
		$condi9 = $condiciones[8];
		$condi10 = $condiciones[9];
		
		
		$ressepa = explode(".",$condi1);
		$codcondi = $ressepa[0]; $item0 = $ressepa[1];
		
		$ressepa1 = explode(".",$condi2);
		$codcondi1 = $ressepa1[0]; $item1 = $ressepa1[1];
		
		$ressepa2 = explode(".",$condi3);
		$codcondi2 = $ressepa2[0]; $item2 = $ressepa2[1];
		
		$ressepa3 = explode(".",$condi4);
		$codcondi3 = $ressepa3[0]; $item3 = $ressepa3[1];
		
		$ressepa4 = explode(".",$condi5);
		$codcondi4 = $ressepa4[0]; $item4 = $ressepa4[1];
		
		$ressepa5 = explode(".",$condi6);
		$codcondi5 = $ressepa5[0]; $item5 = $ressepa5[1];
		
		$ressepa6 = explode(".",$condi7);
		$codcondi6 = $ressepa6[0]; $item6 = $ressepa6[1];
		
		$ressepa7 = explode(".",$condi8);
		$codcondi7 = $ressepa7[0]; $item7 = $ressepa7[1];
		
		$ressepa8 = explode(".",$condi9);
		$codcondi8 = $ressepa8[0]; $item8 = $ressepa8[1];
		
		$ressepa9 = explode(".",$condi10);
		$codcondi9 = $ressepa9[0]; $item9 = $ressepa9[1];
		
		$condicionesss = array($codcondi,$codcondi1,$codcondi2,$codcondi3,$codcondi4,$codcondi5,$codcondi6,$codcondi7,$codcondi8,$codcondi9);
		$itemsss= array($item0,$item1,$item2,$item3,$item4,$item5,$item6,$item7,$item8,$item9);
		
		$i =  0;
		//var_dump($condicionesss);
		//die();
		while ($i < count ($condicionesss)) {
			$numitem = $condicionesss[$i];
			//die("SELECT * FROM actocondicion WHERE idcondicion='$numitem'");
	        $consulta = mysqli_query($conn,"SELECT * FROM actocondicion WHERE idcondicion='$numitem'") or die(mysqli_error());
			$rowpendex = mysqli_fetch_array($consulta);
			if(!empty($rowpendex)){
			        $condition = $rowpendex['idcondicion'];
			        $parte=$rowpendex['parte']; 
			        $idtipoacto=$rowpendex['idtipoacto'];
			        $itemm = $itemsss[$i]; 
			        $uif=$rowpendex['uif']; 
			        $formu=$rowpendex['formulario']; 
			         $montop=$rowpendex['montop'];
					                                       
					$sqlxxx = "INSERT INTO contratantesxacto(id, idtipkar, kardex, idtipoacto, idcontratante, item, idcondicion, parte, porcentaje, uif, formulario, monto, opago, ofondo, montop) VALUES ( NULL, '$idtipkar','$codkardex','$idtipoacto','$idcontra','$itemm','$condition','$parte','','$uif','$formu','','','','$montop')";
					//die($sqlxxx);
					mysqli_query($conn,$sqlxxx) or die(mysqli_error());    
							//die($sqlxxx);
						}
			
			$i++;

			}


	}
}



if($all == 0){
	updateKardex($kardex);
}else{
	$sql = "SELECT idkardex,kardex FROM sisgen_temp  ";
	$result1 = mysqli_query($conn,$sql);
	while($row1 = mysqli_fetch_array($result1)){
		$kardex = $row1['kardex'];
		//die('hola'.$kardex);
	//	echo $kardex.'<br>';
		updateKardex($kardex);
	}
}

$objResponse = new stdClass();
$objResponse->error = 0;
echo json_encode($objResponse);
