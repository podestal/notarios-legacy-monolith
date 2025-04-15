<?php 
session_start();
include("conexion.php");

$idtipkar=intval($_POST['idtipkar']);
$fechaingreso=$_POST['fechaingreso'];
$responsable=intval($_POST['responsable']);
$referenciatexto=$_POST['nreferencia'];
$cabioapostro=str_replace("'","?",$referenciatexto);
$referencia=strtoupper($cabioapostro);


$codactos=$_POST['codactos'];
$contrato=$_POST['contrato'];
$dregistral=$_POST['dregistral'];
$dnotarial=$_POST['dnotarial'];

$idusuario=intval($_SESSION["id_usu"]);

$responsable_new=$_POST['responsable_new'];
$idabogado=$_POST['idabogado'];

$idusuarios=$_POST['idusuarios'];
$horaingreso=$_POST['horaingreso'];
$funcionario_new=$_POST['funcionario_new'];
/*  capturar el año de ingreso para validar */

$dato = explode("/", $fechaingreso); 

$anio=$dato[2];

/* Aqui si crea el kardex si es escritura publica*/






if($idtipkar==1){


$consulta=mysql_query("SELECT MAX(CAST(FN_ONLYNUM(SUBSTRING_INDEX(kardex,'-',1)) AS SIGNED)) AS kardex FROM kardex WHERE idtipkar='1'  AND 
YEAR(STR_TO_DATE(fechaingreso,'%d/%m/%Y'))='$anio'", $conn) or die(mysql_error());
$row = mysql_fetch_array($consulta);

/*
$consulta=mysql_query("Select MAX(CAST(FN_ONLYNUM(kardex) as SIGNED)) AS kardex from kardex where idtipkar='1' ", $conn) or die(mysql_error());
$row = mysql_fetch_array($consulta);
*/
$consul_abre=mysql_query("Select ltrim(rtrim(c_valor)) as c_valor from tb_abreviatura where c_c_abreviatura='10001'", $conn) or die(mysql_error());

$row_abre=mysql_fetch_array($consul_abre);

$abreviatura= $row_abre['c_valor'];



$karescri=$row['kardex'];
$numero=$karescri;


$suma= intval($numero) + 1;
$nkardexx=$abreviatura.$suma.'-'.$anio;
$nmuestra=$abreviatura.$suma;

if($codactos==""){
 ?>
<script language='javascript'>alert('Los campos de codigo de actos o contratos estan vacios, por favor ingresar datos');</script> 
<?php
}else{

$sql="INSERT INTO kardex(idkardex, kardex, idtipkar, kardexconexo, fechaingreso, horaingreso, referencia, codactos,contrato, idusuario, responsable, observacion, documentos, fechacalificado, fechainstrumento, fechaconclusion, numinstrmento, folioini, folioinivta, foliofin, foliofinvta, papelini, papelinivta, papelfin, papelfinvta, comunica1, contacto, telecontacto, mailcontacto, retenido, desistido, autorizado, idrecogio, pagado, visita, dregistral, dnotarial, idnotario, numminuta, numescritura, fechaescritura,idabogado,responsable_new,recepcion,funcionario_new) VALUES (NULL,'$nkardexx','$idtipkar','','$fechaingreso','$horaingreso','$referencia','$codactos','$contrato','$idusuario','$responsable','','','','','','','',0,'',0,'',0,'',0,'','','','',0,0,0,0,0,0,'$dregistral','$dnotarial',0,'','','0000-00-00','$idabogado','$responsable_new','$idusuarios','$funcionario_new')"; 

mysql_query($sql,$conn) or die(mysql_error());

echo "<input name='codkardex' id='codkardex' readonly='readonly' type='text' value='".$nkardexx."' style='font-family:Calibri; font-size:20px; color:#003366; border:none;' size='12'>";

}
    $acto1=substr($codactos,0,3);
	$acto2=substr($codactos,3,3);
	$acto3=substr($codactos,6,3);
	$acto4=substr($codactos,9,3);
	$acto5=substr($codactos,12,3);
	
	$actoss = array($acto1,$acto2,$acto3,$acto4,$acto5);
 $i=0;
	while ($i < count ($actoss) ) {
		$numacto=$actoss[$i];
        $consulta=mysql_query("Select * from tiposdeacto where idtipoacto = '$numacto'", $conn) or die(mysql_error());
		$row=mysql_fetch_array($consulta);
		if(!empty($row)){
		        $desactos=$row['desacto']; $idtipoacto=$row['idtipoacto']; $actosunat=$row['actosunat']; $actouif=$row['actouif'];
				$sql2="INSERT INTO detalle_actos_kardex(item, kardex, idtipoacto, actosunat, actouif, idtipkar, desacto) VALUES (NULL,'$nkardexx','$idtipoacto','$actosunat','$actouif','$idtipkar','$desactos')";
				mysql_query($sql2,$conn) or die(mysql_error());    
					
					}
		$i++;
		}	

}

/* Aqui si crea el kardex si es No contenciosos */

if($idtipkar==2){
$consulta=mysql_query("SELECT MAX(CAST(FN_ONLYNUM(SUBSTRING_INDEX(kardex,'-',1)) AS SIGNED)) AS kardex FROM kardex WHERE idtipkar='2'  AND 
YEAR(STR_TO_DATE(fechaingreso,'%d/%m/%Y'))='$anio'", $conn) or die(mysql_error());
$row = mysql_fetch_array($consulta);

$consul_abre=mysql_query("Select ltrim(rtrim(c_valor)) as c_valor from tb_abreviatura where c_c_abreviatura='10002'", $conn) or die(mysql_error());

$row_abre=mysql_fetch_array($consul_abre);

$abreviatura= $row_abre['c_valor'];



$karescri=$row['kardex'];
$numero=$karescri;
$suma= intval($numero) + 1;
$nkardexx=$abreviatura.$suma.'-'.$anio;
$nmuestra=$abreviatura.$suma;


if($codactos==""){
 ?>
<script language='javascript'>alert('Los campos de codigo de actos o contratos estan vacios, por favor ingresar datos');</script> 
<?php
}else{

$sql="INSERT INTO kardex(idkardex, kardex, idtipkar, kardexconexo, fechaingreso, horaingreso, referencia, codactos,contrato, idusuario, responsable, observacion, documentos, fechacalificado, fechainstrumento, fechaconclusion, numinstrmento, folioini, folioinivta, foliofin, foliofinvta, papelini, papelinivta, papelfin, papelfinvta, comunica1, contacto, telecontacto, mailcontacto, retenido, desistido, autorizado, idrecogio, pagado, visita, dregistral, dnotarial, idnotario, numminuta, numescritura, fechaescritura,idabogado,responsable_new) VALUES (NULL,'$nkardexx','$idtipkar','','$fechaingreso','$horaingreso','$referencia','$codactos','$contrato','$idusuario','$responsable','','','','','','','',0,'',0,'',0,'',0,'','','','',0,0,0,0,0,0,'$dregistral','$dnotarial',0,'','','0000-00-00','$idabogado','$responsable_new')"; 

mysql_query($sql,$conn) or die(mysql_error());

echo "<input name='codkardex' id='codkardex' readonly='readonly' type='text' value='".$nkardexx."' style='font-family:Calibri; font-size:20px; color:#003366; border:none;' size='12'>";

}
    $acto1=substr($codactos,0,3);
	$acto2=substr($codactos,3,3);
	$acto3=substr($codactos,6,3);
	$acto4=substr($codactos,9,3);
	$acto5=substr($codactos,12,3);
	
	$actoss = array($acto1,$acto2,$acto3,$acto4,$acto5);
 $i=0;
	while ($i < count ($actoss) ) {
		$numacto=$actoss[$i];
        $consulta=mysql_query("Select * from tiposdeacto where idtipoacto = '$numacto'", $conn) or die(mysql_error());
		$row=mysql_fetch_array($consulta);
		if(!empty($row)){
		        $desactos=$row['desacto']; $idtipoacto=$row['idtipoacto']; $actosunat=$row['actosunat']; $actouif=$row['actouif'];
				$sql2="INSERT INTO detalle_actos_kardex(item, kardex, idtipoacto, actosunat, actouif, idtipkar, desacto) VALUES (NULL,'$nkardexx','$idtipoacto','$actosunat','$actouif','$idtipkar','$desactos')";
				mysql_query($sql2,$conn) or die(mysql_error());    
					
					}
		$i++;
		}	

}


/*crea kardex si es transferencia vehicular*/
if($idtipkar==3){

$consulta=mysql_query("SELECT MAX(CAST(FN_ONLYNUM(SUBSTRING_INDEX(kardex,'-',1)) AS SIGNED)) AS kardex FROM kardex WHERE idtipkar='3'  AND 
YEAR(STR_TO_DATE(fechaingreso,'%d/%m/%Y'))='$anio'", $conn) or die(mysql_error());
$row = mysql_fetch_array($consulta);

$consul_abre=mysql_query("Select ltrim(rtrim(c_valor)) as c_valor from tb_abreviatura where c_c_abreviatura='10003'", $conn) or die(mysql_error());

$row_abre=mysql_fetch_array($consul_abre);

$abreviatura= $row_abre['c_valor'];



$karescri=$row['kardex'];
$numero=$karescri;
$suma= intval($numero) + 1;
$nkardexx=$abreviatura.$suma.'-'.$anio;
$nmuestra=$abreviatura.$suma;
 

	

if($codactos==""){
 ?>
<script language='javascript'>alert('Los campos de codigo de actos o contratos estan vacios, por favor ingresar datos');</script> 
<?php
}else{

$sql="INSERT INTO kardex(idkardex, kardex, idtipkar, kardexconexo, fechaingreso, horaingreso, referencia, codactos,contrato, idusuario, responsable, observacion, documentos, fechacalificado, fechainstrumento, fechaconclusion, numinstrmento, folioini, folioinivta, foliofin, foliofinvta, papelini, papelinivta, papelfin, papelfinvta, comunica1, contacto, telecontacto, mailcontacto, retenido, desistido, autorizado, idrecogio, pagado, visita, dregistral, dnotarial, idnotario, numminuta, numescritura, fechaescritura,idabogado,responsable_new) VALUES (NULL,'$nkardexx','$idtipkar','','$fechaingreso','$horaingreso','$referencia','$codactos','$contrato','$idusuario','$responsable','','','','','','','',0,'',0,'',0,'',0,'','','','',0,0,0,0,0,0,'$dregistral','$dnotarial',0,'','','0000-00-00','$idabogado','$responsable_new')"; 

mysql_query($sql,$conn) or die(mysql_error());

echo "<input name='codkardex' id='codkardex' readonly='readonly' type='text' value='".$nkardexx."' style='font-family:Calibri; font-size:20px; color:#003366; border:none;' size='12'>";

}
    $acto1=substr($codactos,0,3);
	$acto2=substr($codactos,3,3);
	$acto3=substr($codactos,6,3);
	$acto4=substr($codactos,9,3);
	$acto5=substr($codactos,12,3);
	
	$actoss = array($acto1,$acto2,$acto3,$acto4,$acto5);
 $i=0;
	while ($i < count ($actoss) ) {
		$numacto=$actoss[$i];
        $consulta=mysql_query("Select * from tiposdeacto where idtipoacto = '$numacto'", $conn) or die(mysql_error());
		$row=mysql_fetch_array($consulta);
		if(!empty($row)){
		        $desactos=$row['desacto']; $idtipoacto=$row['idtipoacto']; $actosunat=$row['actosunat']; $actouif=$row['actouif'];
				$sql2="INSERT INTO detalle_actos_kardex(item, kardex, idtipoacto, actosunat, actouif, idtipkar, desacto) VALUES (NULL,'$nkardexx','$idtipoacto','$actosunat','$actouif','$idtipkar','$desactos')";
				mysql_query($sql2,$conn) or die(mysql_error());    
					
					}
		$i++;
		}	

}

/*crea si es garantias Moviliarias*/
if($idtipkar==4){
$consulta=mysql_query("SELECT MAX(CAST(FN_ONLYNUM(SUBSTRING_INDEX(kardex,'-',1)) AS SIGNED)) AS kardex FROM kardex WHERE idtipkar='4'  AND 
YEAR(STR_TO_DATE(fechaingreso,'%d/%m/%Y'))='$anio'", $conn) or die(mysql_error());
$row = mysql_fetch_array($consulta);

$consul_abre=mysql_query("Select ltrim(rtrim(c_valor)) as c_valor from tb_abreviatura where c_c_abreviatura='10004'", $conn) or die(mysql_error());

$row_abre=mysql_fetch_array($consul_abre);

$abreviatura= $row_abre['c_valor'];



$karescri=$row['kardex'];
$numero=$karescri;
$suma= intval($numero) + 1;
$nkardexx=$abreviatura.$suma.'-'.$anio;
$nmuestra=$abreviatura.$suma;
	
if($codactos==""){
 ?>
<script language='javascript'>alert('Los campos de codigo de actos o contratos estan vacios, por favor ingresar datos');</script> 
<?php
}else{

$sql="INSERT INTO kardex(idkardex, kardex, idtipkar, kardexconexo, fechaingreso, horaingreso, referencia, codactos,contrato, idusuario, responsable, observacion, documentos, fechacalificado, fechainstrumento, fechaconclusion, numinstrmento, folioini, folioinivta, foliofin, foliofinvta, papelini, papelinivta, papelfin, papelfinvta, comunica1, contacto, telecontacto, mailcontacto, retenido, desistido, autorizado, idrecogio, pagado, visita, dregistral, dnotarial, idnotario, numminuta, numescritura, fechaescritura,idabogado,responsable_new) VALUES (NULL,'$nkardexx','$idtipkar','','$fechaingreso','$horaingreso','$referencia','$codactos','$contrato','$idusuario','$responsable','','','','','','','',0,'',0,'',0,'',0,'','','','',0,0,0,0,0,0,'$dregistral','$dnotarial',0,'','','0000-00-00','$idabogado','$responsable_new')"; 

mysql_query($sql,$conn) or die(mysql_error());

echo "<input name='codkardex' id='codkardex' readonly='readonly' type='text' value='".$nkardexx."' style='font-family:Calibri; font-size:20px; color:#003366; border:none;' size='12'>";

}
    $acto1=substr($codactos,0,3);
	$acto2=substr($codactos,3,3);
	$acto3=substr($codactos,6,3);
	$acto4=substr($codactos,9,3);
	$acto5=substr($codactos,12,3);
	
	$actoss = array($acto1,$acto2,$acto3,$acto4,$acto5);
 $i=0;
	while ($i < count ($actoss) ) {
		$numacto=$actoss[$i];
        $consulta=mysql_query("Select * from tiposdeacto where idtipoacto = '$numacto'", $conn) or die(mysql_error());
		$row=mysql_fetch_array($consulta);
		if(!empty($row)){
		        $desactos=$row['desacto']; $idtipoacto=$row['idtipoacto']; $actosunat=$row['actosunat']; $actouif=$row['actouif'];
				$sql2="INSERT INTO detalle_actos_kardex(item, kardex, idtipoacto, actosunat, actouif, idtipkar, desacto) VALUES (NULL,'$nkardexx','$idtipoacto','$actosunat','$actouif','$idtipkar','$desactos')";
				mysql_query($sql2,$conn) or die(mysql_error());    
					
					}
		$i++;
		}	

}

/*crea si es testamento*/
if($idtipkar==5){

$consulta=mysql_query("SELECT MAX(CAST(FN_ONLYNUM(SUBSTRING_INDEX(kardex,'-',1)) AS SIGNED)) AS kardex FROM kardex WHERE idtipkar='5'  AND 
YEAR(STR_TO_DATE(fechaingreso,'%d/%m/%Y'))='$anio'", $conn) or die(mysql_error());
$row = mysql_fetch_array($consulta);

$consul_abre=mysql_query("Select ltrim(rtrim(c_valor)) as c_valor from tb_abreviatura where c_c_abreviatura='10005'", $conn) or die(mysql_error());

$row_abre=mysql_fetch_array($consul_abre);

$abreviatura= $row_abre['c_valor'];



$karescri=$row['kardex'];
$numero=$karescri;
$suma= intval($numero) + 1;
$nkardexx=$abreviatura.$suma.'-'.$anio;
$nmuestra=$abreviatura.$suma;

	
if($codactos==""){
 ?>
<script language='javascript'>alert('Los campos de codigo de actos o contratos estan vacios, por favor ingresar datos');</script> 
<?php
}else{

$sql="INSERT INTO kardex(idkardex, kardex, idtipkar, kardexconexo, fechaingreso, horaingreso, referencia, codactos,contrato, idusuario, responsable, observacion, documentos, fechacalificado, fechainstrumento, fechaconclusion, numinstrmento, folioini, folioinivta, foliofin, foliofinvta, papelini, papelinivta, papelfin, papelfinvta, comunica1, contacto, telecontacto, mailcontacto, retenido, desistido, autorizado, idrecogio, pagado, visita, dregistral, dnotarial, idnotario, numminuta, numescritura, fechaescritura,idabogado,responsable_new) VALUES (NULL,'$nkardexx','$idtipkar','','$fechaingreso','$horaingreso','$referencia','$codactos','$contrato','$idusuario','$responsable','','','','','','','',0,'',0,'',0,'',0,'','','','',0,0,0,0,0,0,'$dregistral','$dnotarial',0,'','','0000-00-00','$idabogado','$responsable_new')"; 

mysql_query($sql,$conn) or die(mysql_error());

echo "<input name='codkardex' id='codkardex' readonly='readonly' type='text' value='".$nkardexx."' style='font-family:Verdana; background:#B8E7DF; font-size:20px; color:#003366;' class='texto' size='12'>";

}
    $acto1=substr($codactos,0,3);
	$acto2=substr($codactos,3,3);
	$acto3=substr($codactos,6,3);
	$acto4=substr($codactos,9,3);
	$acto5=substr($codactos,12,3);
	
	$actoss = array($acto1,$acto2,$acto3,$acto4,$acto5);
 $i=0;
	while ($i < count ($actoss) ) {
		$numacto=$actoss[$i];
        $consulta=mysql_query("Select * from tiposdeacto where idtipoacto = '$numacto'", $conn) or die(mysql_error());
		$row=mysql_fetch_array($consulta);
		if(!empty($row)){
		        $desactos=$row['desacto']; $idtipoacto=$row['idtipoacto']; $actosunat=$row['actosunat']; $actouif=$row['actouif'];
				$sql2="INSERT INTO detalle_actos_kardex(item, kardex, idtipoacto, actosunat, actouif, idtipkar, desacto) VALUES (NULL,'$nkardexx','$idtipoacto','$actosunat','$actouif','$idtipkar','$desactos')";
				mysql_query($sql2,$conn) or die(mysql_error());    
					
					}
		$i++;
		}	

}

?>