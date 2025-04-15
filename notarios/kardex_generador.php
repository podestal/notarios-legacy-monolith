
<?php 
include("conexion.php");

$num_registros    = $_POST["num_registros"];
$num_kinicial     = $_POST["num_kinicial"];
$fec_ingreso 	  = $_POST["fec_ingreso"];
$idtipkar 	  = $_POST["idtipkar"];
$dato = explode("/", $fec_ingreso); 

$anio=$dato[2];

$in=intval($num_kinicial);
$fin=intval($num_registros);
$total=intval( $fin - $in );

// consultamos si es unico = 0  - multiple = 1
$consul_sisnot=mysql_query("Select ltrim(rtrim(c_valor)) as c_valor from tb_control where c_c_control='10001'", $conn) or die(mysql_error());

$row_sisnot=mysql_fetch_array($consul_sisnot);
$tipo_sisnot= $row_sisnot['c_valor'];



$consulta_k=mysql_query("select c_valor from tb_abreviatura where c_c_abreviatura='10001'", $conn) or die(mysql_error());
$row_k = mysql_fetch_array($consulta_k);
$abre_k=$row_k["c_valor"];
$consulta_nc=mysql_query("select c_valor from tb_abreviatura where c_c_abreviatura='10002'", $conn) or die(mysql_error());
$row_nc = mysql_fetch_array($consulta_nc);
$abre_nc=$row_nc["c_valor"];
$consulta_ac=mysql_query("select c_valor from tb_abreviatura where c_c_abreviatura='10003'", $conn) or die(mysql_error());
$row_ac = mysql_fetch_array($consulta_ac);
$abre_ac=$row_ac["c_valor"];
$consulta_ga=mysql_query("select c_valor from tb_abreviatura where c_c_abreviatura='10004'", $conn) or die(mysql_error());
$row_ga = mysql_fetch_array($consulta_ga);
$abre_ga=$row_ga["c_valor"];
$consulta_te=mysql_query("select c_valor from tb_abreviatura where c_c_abreviatura='10005'", $conn) or die(mysql_error());
$row_te = mysql_fetch_array($consulta_te);
$abre_te=$row_te["c_valor"];
$x=0;
//$num_kinicial ;
echo $total;

// si es multiple = 1
if($tipo_sisnot!='0'){

for ($x = 0; $x <= $total; $x++) {
	
	
if($idtipkar==1){
$suma= intval($num_kinicial) + $x  ;
$nkardexx=$abre_k.$suma.'-'.$anio;
}else if($idtipkar==2){
$suma= intval($num_kinicial) + $x;
$nkardexx=$abre_nc.$suma.'-'.$anio;
}else if($idtipkar==3){
$suma= intval($num_kinicial) + $x;
$nkardexx=$abre_ac.$suma.'-'.$anio;
}else if($idtipkar==4){
$suma= intval($num_kinicial) + $x ;
$nkardexx=$abre_ga.$suma.'-'.$anio;
}else if($idtipkar==5){
$suma= intval($num_kinicial) + $x ;
$nkardexx=$abre_te.$suma.'-'.$anio;
}

$sql2=mysql_query("select kardex.kardex from kardex WHERE kardex.kardex='$nkardexx'", $conn) or die(mysql_error());
$totalFilas2    =    mysql_num_rows($sql2); 

if($totalFilas2==0){
	
$sql="INSERT INTO kardex(idkardex, kardex, idtipkar, kardexconexo, fechaingreso, horaingreso, referencia, codactos,contrato, idusuario, responsable, observacion, documentos, fechacalificado, fechainstrumento, fechaconclusion, numinstrmento, folioini, folioinivta, foliofin, foliofinvta, papelini, papelinivta, papelfin, papelfinvta, comunica1, contacto, telecontacto, mailcontacto, retenido, desistido, autorizado, idrecogio, pagado, visita, dregistral, dnotarial, idnotario, numminuta, numescritura, fechaescritura) VALUES (NULL,'$nkardexx','$idtipkar','','$fec_ingreso ','','','','','1','1','','','','','','','',0,'',0,'',0,'',0,'','','','',0,0,0,0,0,0,'','',0,'','','0000-00-00')"; 
mysql_query($sql,$conn) or die(mysql_error());
}

} 
// si es unico = 0
}else{
	
	
for ($x = 0; $x <= $total; $x++) {
$suma= intval($num_kinicial) + $x  ;
$nkardexx=$suma;


$sql2=mysql_query("select kardex.kardex from kardex WHERE kardex.kardex='$nkardexx'", $conn) or die(mysql_error());
$totalFilas2    =    mysql_num_rows($sql2); 

if($totalFilas2==0){

$sql="INSERT INTO kardex(idkardex, kardex, idtipkar, kardexconexo, fechaingreso, horaingreso, referencia, codactos,contrato, idusuario, responsable, observacion, documentos, fechacalificado, fechainstrumento, fechaconclusion, numinstrmento, folioini, folioinivta, foliofin, foliofinvta, papelini, papelinivta, papelfin, papelfinvta, comunica1, contacto, telecontacto, mailcontacto, retenido, desistido, autorizado, idrecogio, pagado, visita, dregistral, dnotarial, idnotario, numminuta, numescritura, fechaescritura) VALUES (NULL,'$nkardexx','$idtipkar','','$fec_ingreso ','','','','','1','1','','','','','','','',0,'',0,'',0,'',0,'','','','',0,0,0,0,0,0,'','',0,'','','0000-00-00')"; 
mysql_query($sql,$conn) or die(mysql_error());
}

}	


}

?>