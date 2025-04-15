<?php
include('../../conexion.php');

$num_registros    = $_POST["num_registros"];
$num_kinicial     = $_POST["num_kinicial"];
$fec_ingreso 	  = $_POST["fec_ingreso"];
$idtipkar 	  = $_POST["idtipkar"];


$grababloqKardex = "INSERT INTO kardex(idkardex, kardex, idtipkar, kardexconexo, fechaingreso, horaingreso, referencia, codactos, contrato, idusuario, responsable, observacion, documentos, fechacalificado, fechainstrumento, fechaconclusion, numinstrmento, folioini, folioinivta, foliofin, foliofinvta, papelini, papelinivta, papelfin, papelfinvta, comunica1, contacto, telecontacto, mailcontacto, retenido, desistido, autorizado, idrecogio, pagado, visita, dregistral, dnotarial, idnotario, numminuta, numescritura, fechaescritura )
VALUES (NULL, '$num_kinicial', '$idtipkar', '', '$fec_ingreso', '', '', '', '', '1', '1', '', '', '', '', '', '', '', '', '', '0', '', '0', '', '0', '', '', '', '', '0', '0', '0', '0', '0', '0', '', '', '0', '', '', date_format('00/00/000','%d/%m/%Y'))";
mysql_query($grababloqKardex,$conn) or die(mysql_error());

//SE CREA EL BLOQUE DE CARTAS
for($i=1;$i <= $num_registros-1 ; $i++) 
{	
// se arma el numero de la kardex  formato:  '000001';

$busnumkar = "Select * from kardex where idtipkar='$idtipkar' order by idkardex DESC LIMIT 1";

$numkarbus = mysql_query($busnumkar,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numkarbus);




if($idtipkar==1){
	$karescri=str_replace("K","",$rownum['kardex']);
	$numero=$karescri;
	$suma= intval($numero) + 1;

	$newnumkar  = "K".$suma[0];
}else if($idtipkar==2){
	$karescri=str_replace("N","",$rownum['kardex']);
	$numero=$karescri;
	$suma= intval($numero) + 1;

	$newnumkar  = "N".$suma[0];
}else if($idtipkar==3){
	$karescri=str_replace("TV","",$rownum['kardex']);
	$numero=$karescri;
	$suma= intval($numero) + 1;

	$newnumkar  = "TV".$suma[0];
}else if($idtipkar==4){
	$karescri=str_replace("G","",$rownum['kardex']);
	$numero=$karescri;
	$suma= intval($numero) + 1;

	$newnumkar  = "G".$suma[0];
}else if($idtipkar==5){
	$karescri=str_replace("T","",$rownum['kardex']);
	$numero=$karescri;
	$suma= intval($numero) + 1;

	$newnumkar  = "T".$suma[0];
}

$grababloqKardex2 = "INSERT INTO kardex(idkardex, kardex, idtipkar, kardexconexo, fechaingreso, horaingreso, referencia, codactos, contrato, idusuario, responsable, observacion, documentos, fechacalificado, fechainstrumento, fechaconclusion, numinstrmento, folioini, folioinivta, foliofin, foliofinvta, papelini, papelinivta, papelfin, papelfinvta, comunica1, contacto, telecontacto, mailcontacto, retenido, desistido, autorizado, idrecogio, pagado, visita, dregistral, dnotarial, idnotario, numminuta, numescritura, fechaescritura )
VALUES (NULL, '$newnumkar', '$idtipkar', '', '$fec_ingreso', '', '', '', '', '1', '1', '', '', '', '', '', '', '', '', '', '0', '', '0', '', '0', '', '', '', '', '0', '0', '0', '0', '0', '0', '', '', '0', '', '', date_format('00/00/000','%d/%m/%Y'))";
mysql_query($grababloqKardex2,$conn) or die(mysql_error());

}

mysql_close($conn);
?>


