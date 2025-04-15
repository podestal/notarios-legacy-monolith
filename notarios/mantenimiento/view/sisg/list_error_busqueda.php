<?php 

include('conexion.php');


$valor = $_POST['valorcombo'];

	if($valor ==''){

		$consulta = mysql_query("SELECT sisgen.id_envio AS ID,  tipo_kardex AS TIPKAR, sisgen.kardex AS KARDEX, num_escritura AS NUM_ESC, 
		fech_envio AS FEC_ENVIO, estado AS ESTADO, IF ( mensaje IS NULL , '',mensaje) AS MENSAJE, sisgen.status AS ESTATUS, sisgen_temp.idkardex AS IDKARDEX, sisgen_temp.contrato AS CONTRATO FROM sisgen 
		LEFT JOIN sisgen_mensaje ON sisgen.kardex = sisgen_mensaje.kardex 
		INNER JOIN sisgen_temp ON sisgen.kardex = sisgen_temp.kardex
		ORDER BY sisgen.kardex ASC ", $conn) or die(mysql_error());

	}else{

		$consulta = mysql_query("SELECT sisgen.id_envio AS ID,  tipo_kardex AS TIPKAR, sisgen.kardex AS KARDEX, num_escritura AS NUM_ESC, 
		fech_envio AS FEC_ENVIO, estado AS ESTADO, IF ( mensaje IS NULL , '',mensaje) AS MENSAJE, sisgen.status AS ESTATUS, sisgen_temp.idkardex AS IDKARDEX, sisgen_temp.contrato AS CONTRATO FROM sisgen 
		LEFT JOIN sisgen_mensaje ON sisgen.kardex = sisgen_mensaje.kardex 
		INNER JOIN sisgen_temp ON sisgen.kardex = sisgen_temp.kardex AND sisgen.status ='$valor'
		ORDER BY sisgen.kardex ASC", $conn) or die(mysql_error());
	}

	

$data = array();
while($row = mysql_fetch_array($consulta)){
	$tipkar=$row['TIPKAR'];
	$kardex=$row['KARDEX'];
	$numescritura=$row['NUM_ESC'];
	$fechenvio=$row['FEC_ENVIO'];
	$mensaje=$row['MENSAJE'];
	$estado=$row['ESTATUS'];
	$idkardex=$row['IDKARDEX'];
	$contrato=$row['CONTRATO'];
	$data[] = $row;
}

echo json_encode(array("list"=>$data));


		