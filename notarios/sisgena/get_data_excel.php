<?php


$estado = $_POST['estado'];
require_once '../PHPExcel/Classes/PHPExcel.php';
$archivo = "libro1.xlsx";

$inputFileType = PHPExcel_IOFactory::identify($archivo);

$objReader = PHPExcel_IOFactory::createReader($inputFileType);

$objPHPExcel = $objReader->load($archivo);
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();
$i = 1;

$data = array();
for ($row = 2; $row <= $highestRow; $row++){ 

	$kardex = 	$sheet->getCell("A".$row)->getValue();
	$fechaEscritura = $sheet->getCell("C".$row)->getValue();
	$tipoInstrumento = $sheet->getCell("D".$row)->getValue();
	$numeroInstrumento = $sheet->getCell("E".$row)->getValue();
	$descripcionActo = $sheet->getCell("F".$row)->getValue();
	$error = $sheet->getCell("G".$row)->getValue();
	

	if($i == 1){
		$auxNumeroInstrumento = $numeroInstrumento;
	}else{

		if($auxNumeroInstrumento  != ($numeroInstrumento-1) ){
			$cont =   $numeroInstrumento-$auxNumeroInstrumento;
			//die($auxNumeroInstrumento.' -' .$numeroInstrumento);
			for($y = 1;$y<$cont;$y++){
				$data[] = array('numero'=>$i,'kardex'=>'-1','fechaEscritura'=>'-',
				'tipoInstrumento'=>'-','numeroInstrumento'=>$auxNumeroInstrumento+$y,
				'descripcionActo'=>'','error'=>'');
				$i++;
			}

			/*$data[] = array('numero'=>$i,'kardex'=>'-1','fechaEscritura'=>'-',
				'tipoInstrumento'=>'-','numeroInstrumento'=>($auxNumeroInstrumento-1),
				'descripcionActo'=>'','error'=>'');
			$i++;*/
		}
		$auxNumeroInstrumento = $numeroInstrumento;
	}
	if($estado != 2){
		$data[] = array('numero'=>$i,'kardex'=>$kardex,'fechaEscritura'=>$fechaEscritura,
		'tipoInstrumento'=>$tipoInstrumento,'numeroInstrumento'=>$numeroInstrumento,
		'descripcionActo'=>$descripcionActo,'error'=>$error);
		
	}
	$i++;

}	

$objResponse = new stdClass();
$objResponse->error = 0;
$objResponse->data = $data;
echo json_encode($objResponse);