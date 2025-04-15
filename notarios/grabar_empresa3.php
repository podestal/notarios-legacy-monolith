<?php 

include("conexion.php");

$razonsocialtexto=$_POST['razonsocial'];
$cabioapostro=str_replace("'","?",$razonsocialtexto);
$bbb=str_replace("ñ","Ñ",$cabioapostro);
$razonsocial=strtoupper($bbb);

$domfiscaltexto=$_POST['domfiscal'];
$cabioapostro2=str_replace("'","?",$domfiscaltexto);
$aaa=str_replace("ñ","Ñ",$cabioapostro2);
$domfiscal=strtoupper($aaa);

$telempresa=$_POST['telempresa'];
$mailempresa=$_POST['mailempresa'];
$contacempresa=strtoupper($_POST['contacempresa']);
$fechaconstitu=$_POST['fechaconstitu'];
$numregistro=$_POST['numregistro'];
$numpartida=$_POST['numpartida'];
$actmunicipal=strtoupper($_POST['actmunicipal']);
$codubi=$_POST['codubi'];

$idcliente=$_POST['idclie'];
$contra=$_POST['contra'];
$ruc_emp=$_POST['ruc_emp'];

if($_POST['idsedereg3']==""){
$idsedereg3=0;	
}else{
$idsedereg3=$_POST['idsedereg3'];	
	
}


mysql_query("UPDATE cliente2 SET  idubigeo='$codubi',razonsocial='$razonsocial',numdoc='$ruc_emp',domfiscal='$domfiscal',telempresa='$telempresa',mailempresa='$mailempresa',contacempresa='$contacempresa',fechaconstitu='$fechaconstitu',idsedereg='$idsedereg3',numregistro='$numregistro',numpartida='$numpartida',actmunicipal='$actmunicipal' WHERE idcontratante = '$contra'  ", $conn) or die(mysql_error());

mysql_query("UPDATE cliente SET  idubigeo='$codubi',razonsocial='$razonsocial',numdoc='$ruc_emp',domfiscal='$domfiscal',telempresa='$telempresa',mailempresa='$mailempresa',contacempresa='$contacempresa',fechaconstitu='$fechaconstitu',idsedereg='$idsedereg3',numregistro='$numregistro',numpartida='$numpartida',actmunicipal='$actmunicipal' WHERE idcliente = '$idcliente'  ", $conn) or die(mysql_error());

?>