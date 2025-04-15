<?php 
session_start();
include("conexion.php");
$tipoescritura=intval($_POST['tipoescritura']);
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

$fecha_modificacion = date("d/m/Y");

$dato = explode("/", $fechaingreso); 

$anio = $dato[2];

$xidkardex=0;

/* Aqui si crea el kardex si es escritura publica*/
//consultamos si es unico 0/multiple 1
$consul_sisnot = mysql_query("Select ltrim(rtrim(c_valor)) as c_valor from tb_control where c_c_control='10001'", $conn) or die(mysql_error());

$row_sisnot = mysql_fetch_array($consul_sisnot);
$tipo_sisnot= $row_sisnot['c_valor'];

$consul_reinicio=mysql_query("Select ltrim(rtrim(c_valor)) as c_valor from tb_control where c_c_control='10002'", $conn) or die(mysql_error());

$row_reinicio = mysql_fetch_array($consul_reinicio);
$tipo_reinicio = $row_reinicio['c_valor'];
// consutamos si es unico = 0   --   multiple = 1
//aca si es multiple



if($tipo_sisnot!='0'){

if($idtipkar == 1){
	
$consul_abre_escritura = mysql_query("Select ltrim(rtrim(c_valor)) as c_valor from tb_abreviatura where c_c_abreviatura='10001'", $conn) or die(mysql_error());
$row_escritura = mysql_fetch_array($consul_abre_escritura);
$abre_escritura = $row_escritura["c_valor"];

$consul_abre_bcp = mysql_query("Select ltrim(rtrim(c_valor)) as c_valor from tb_abreviatura where c_c_abreviatura ='10006'", $conn) or die(mysql_error());

$row_bcp = mysql_fetch_array($consul_abre_bcp);
$abre_bcp = $row_bcp["c_valor"];

$consul_abre_sc=mysql_query("Select ltrim(rtrim(c_valor)) as c_valor from tb_abreviatura where c_c_abreviatura='10007'", $conn) or die(mysql_error());
$row_sc = mysql_fetch_array($consul_abre_sc);
$abre_sc=$row_sc["c_valor"];


$consul_abre_conti=mysql_query("Select ltrim(rtrim(c_valor)) as c_valor from tb_abreviatura where c_c_abreviatura ='10008'", $conn) or die(mysql_error());
$row_conti = mysql_fetch_array($consul_abre_conti);
$abre_conti=$row_conti["c_valor"];

$consul_abre_int=mysql_query("Select ltrim(rtrim(c_valor)) as c_valor from tb_abreviatura where c_c_abreviatura ='10009'", $conn) or die(mysql_error());
$row_int = mysql_fetch_array($consul_abre_int);
$abre_int=$row_int["c_valor"];


$consul_abre_otro=mysql_query("Select ltrim(rtrim(c_valor)) as c_valor from tb_abreviatura where c_c_abreviatura ='10010'", $conn) or die(mysql_error());
$row_otro = mysql_fetch_array($consul_abre_otro);
$abre_otro=$row_otro["c_valor"];



if ($tipoescritura == '0'){
 	$abre_fin = $abre_escritura ;

}

if ($tipoescritura=='1'){ $abre_fin=$abre_bcp;}
if ($tipoescritura=='2'){ $abre_fin=$abre_sc;}
if ($tipoescritura=='3'){ $abre_fin=$abre_conti;}
if ($tipoescritura=='4'){ $abre_fin=$abre_int;}
if ($tipoescritura=='5'){ $abre_fin=$abre_otro;}


if ($tipo_reinicio == '1'){



$consulta = mysql_query("SELECT MAX(CAST(FN_ONLYNUM(SUBSTRING_INDEX(kardex,'-',1)) AS SIGNED)) AS kardex FROM kardex WHERE idtipkar='1'  AND 
YEAR(STR_TO_DATE(fechaingreso,'%d/%m/%Y'))='$anio' and (TRIM(SUBSTRING(KARDEX,1,(LENGTH((SUBSTRING_INDEX(kardex,'-',1))) - LENGTH(FN_ONLYNUM((SUBSTRING_INDEX(kardex,'-',1)))))))='$abre_fin')", $conn) or die(mysql_error());


$row = mysql_fetch_array($consulta);

$karescri = $row['kardex'];
$numero = $karescri;

}else{


$consulta = mysql_query("SELECT MAX(CAST(FN_ONLYNUM(SUBSTRING_INDEX(kardex,'-',1)) AS SIGNED)) AS kardex FROM kardex WHERE idtipkar='1' and (TRIM(SUBSTRING(KARDEX,1,(LENGTH((SUBSTRING_INDEX(kardex,'-',1))) - LENGTH(FN_ONLYNUM((SUBSTRING_INDEX(kardex,'-',1))))))) = '$abre_fin') AND YEAR(STR_TO_DATE(fechaingreso,'%d/%m/%Y')) = '$anio'  ", $conn) or die(mysql_error());


////ojo verificar

//$consulta = mysql_query("SELECT MAX(CAST((SUBSTRING(kardex,4,4)) AS SIGNED))AS kardex  FROM kardex WHERE idtipkar='1' and YEAR(STR_TO_DATE(fechaingreso,'%d/%m/%Y')) = '$anio'  ", $conn) or die(mysql_error());


$row = mysql_fetch_array($consulta);
$karescri = $row['kardex'];
$numero = $karescri;


}



$suma = intval($numero) + 1;
$nkardexx = $abre_fin.$suma.'-'.$anio;
$nmuestra = $abre_fin.$suma;

if($codactos == ""){
 ?>
<script language='javascript'>alert('Los campos de codigo de actos o contratos estan vacios, por favor ingresar datos');</script> 
<?php
}else{

$sql = "INSERT INTO kardex(idkardex, kardex, idtipkar, kardexconexo, fechaingreso, horaingreso, referencia, codactos,contrato, idusuario, responsable, observacion, documentos, fechacalificado, fechainstrumento, fechaconclusion, numinstrmento, folioini, folioinivta, foliofin, foliofinvta, papelini, papelinivta, papelfin, papelfinvta, comunica1, contacto, telecontacto, mailcontacto, retenido, desistido, autorizado, idrecogio, pagado, visita, dregistral, dnotarial, idnotario, numminuta, numescritura, fechaescritura,idabogado,responsable_new,recepcion,funcionario_new,nc,fecha_modificacion,estado_sisgen) VALUES (NULL,'$nkardexx','$idtipkar','','$fechaingreso','$horaingreso','$referencia','$codactos','$contrato','$idusuario','$responsable','','','','','','','',0,'',0,'',0,'',0,'','','','',0,0,0,0,0,0,'$dregistral','$dnotarial',0,'','','0000-00-00','$idabogado','$responsable_new','$idusuarios','$funcionario_new','','$fecha_modificacion','0')"; 


mysql_query($sql,$conn) or die(mysql_error());
$xidkardex=mysql_insert_id();

echo "<input type='hidden' id='idcodkardex' value='".$xidkardex."'>";

echo "<input name='codkardex' id='codkardex' readonly='readonly' type='text' value='".$nkardexx."' style='font-family:Calibri; font-size:20px; color:#003366; border:none;' size='12'>";

}
    $acto1=substr($codactos,0,3);
	$acto2=substr($codactos,3,3);
	$acto3=substr($codactos,6,3);
	$acto4=substr($codactos,9,3);
	$acto5=substr($codactos,12,3);
	
	$actoss = array($acto1,$acto2,$acto3,$acto4,$acto5);
 	$i = 0;
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

if($tipo_reinicio=='1'){

$consulta=mysql_query("SELECT MAX(CAST(FN_ONLYNUM(SUBSTRING_INDEX(kardex,'-',1)) AS SIGNED)) AS kardex FROM kardex WHERE idtipkar='2'  AND 
YEAR(STR_TO_DATE(fechaingreso,'%d/%m/%Y'))='$anio'", $conn) or die(mysql_error());
$row = mysql_fetch_array($consulta);
$karescri=$row['kardex'];
}else{

$consulta=mysql_query("SELECT MAX(CAST(FN_ONLYNUM(SUBSTRING_INDEX(kardex,'-',1)) AS SIGNED)) AS kardex FROM kardex WHERE idtipkar='2' AND 
YEAR(STR_TO_DATE(fechaingreso,'%d/%m/%Y'))='$anio' ", $conn) or die(mysql_error());
$row = mysql_fetch_array($consulta);
$karescri=$row['kardex'];


}


$consul_abre=mysql_query("Select ltrim(rtrim(c_valor)) as c_valor from tb_abreviatura where c_c_abreviatura='10002'", $conn) or die(mysql_error());

$row_abre=mysql_fetch_array($consul_abre);

$abreviatura= $row_abre['c_valor'];


$numero=$karescri;
$suma= intval($numero) + 1;
$nkardexx=$abreviatura.$suma.'-'.$anio;
$nmuestra=$abreviatura.$suma;


if($codactos==""){
 ?>
<script language='javascript'>alert('Los campos de codigo de actos o contratos estan vacios, por favor ingresar datos');</script> 
<?php
}else{

$sql="INSERT INTO kardex(idkardex, kardex, idtipkar, kardexconexo, fechaingreso, horaingreso, referencia, codactos,contrato, idusuario, responsable, observacion, documentos, fechacalificado, fechainstrumento, fechaconclusion, numinstrmento, folioini, folioinivta, foliofin, foliofinvta, papelini, papelinivta, papelfin, papelfinvta, comunica1, contacto, telecontacto, mailcontacto, retenido, desistido, autorizado, idrecogio, pagado, visita, dregistral, dnotarial, idnotario, numminuta, numescritura, fechaescritura,idabogado,responsable_new,nc,fecha_modificacion,estado_sisgen) VALUES (NULL,'$nkardexx','$idtipkar','','$fechaingreso','$horaingreso','$referencia','$codactos','$contrato','$idusuario','$responsable','','','','','','','',0,'',0,'',0,'',0,'','','','',0,0,0,0,0,0,'$dregistral','$dnotarial',0,'','','0000-00-00','$idabogado','$responsable_new','','$fecha_modificacion','0')"; 

mysql_query($sql,$conn) or die(mysql_error());
$xidkardex=mysql_insert_id();
echo "<input type='hidden' id='idcodkardex' value='".$xidkardex."'>";

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
if($idtipkar == 3){

if($tipo_reinicio=='1'){

$consulta=mysql_query("SELECT MAX(CAST(FN_ONLYNUM(SUBSTRING_INDEX(kardex,'-',1)) AS SIGNED)) AS kardex FROM kardex WHERE idtipkar='3'  AND 
YEAR(STR_TO_DATE(fechaingreso,'%d/%m/%Y'))='$anio'", $conn) or die(mysql_error());
$row = mysql_fetch_array($consulta);
$karescri=$row['kardex'];
}else{
$consulta=mysql_query("SELECT MAX(CAST(FN_ONLYNUM(SUBSTRING_INDEX(kardex,'-',1)) AS SIGNED)) AS kardex FROM kardex WHERE idtipkar='3' AND 
YEAR(STR_TO_DATE(fechaingreso,'%d/%m/%Y'))='$anio' ", $conn) or die(mysql_error());
$row = mysql_fetch_array($consulta);
$karescri=$row['kardex'];}


$consul_abre=mysql_query("Select ltrim(rtrim(c_valor)) as c_valor from tb_abreviatura where c_c_abreviatura='10003'", $conn) or die(mysql_error());

$row_abre=mysql_fetch_array($consul_abre);

$abreviatura= $row_abre['c_valor'];

$numero = $karescri;
$suma = intval($numero) + 1;
$nkardexx = $abreviatura.$suma.'-'.$anio;
$nmuestra = $abreviatura.$suma;
 

	

if($codactos==""){
 ?>
<script language='javascript'>alert('Los campos de codigo de actos o contratos estan vacios, por favor ingresar datos');</script> 
<?php
}else{

$sql = "INSERT INTO kardex(idkardex, kardex, idtipkar, kardexconexo, fechaingreso, horaingreso, referencia, codactos,contrato, idusuario, responsable, observacion, documentos, fechacalificado, fechainstrumento, fechaconclusion, numinstrmento, folioini, folioinivta, foliofin, foliofinvta, papelini, papelinivta, papelfin, papelfinvta, comunica1, contacto, telecontacto, mailcontacto, retenido, desistido, autorizado, idrecogio, pagado, visita, dregistral, dnotarial, idnotario, numminuta, numescritura, fechaescritura,idabogado,responsable_new,nc,fecha_modificacion,estado_sisgen) VALUES (NULL,'$nkardexx','$idtipkar','','$fechaingreso','$horaingreso','$referencia','$codactos','$contrato','$idusuario','$responsable','','','','','','','',0,'',0,'',0,'',0,'','','','',0,0,0,0,0,0,'$dregistral','$dnotarial',0,'','','0000-00-00','$idabogado','$responsable_new','','$fecha_modificacion','0')"; 

mysql_query($sql,$conn) or die(mysql_error());
$xidkardex=mysql_insert_id();
echo "<input type='hidden' id='idcodkardex' value='".$xidkardex."'>";

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
	
	if($tipo_reinicio=='1'){

$consulta = mysql_query("SELECT MAX(CAST(FN_ONLYNUM(SUBSTRING_INDEX(kardex,'-',1)) AS SIGNED)) AS kardex FROM kardex WHERE idtipkar = '4'  AND 
YEAR(STR_TO_DATE(fechaingreso,'%d/%m/%Y'))='$anio'", $conn) or die(mysql_error());
$row = mysql_fetch_array($consulta);
$karescri=$row['kardex'];

}else{

	$consulta=mysql_query("SELECT MAX(CAST(FN_ONLYNUM(SUBSTRING_INDEX(kardex,'-',1)) AS SIGNED)) AS kardex FROM kardex WHERE idtipkar='4' AND 
YEAR(STR_TO_DATE(fechaingreso,'%d/%m/%Y'))='$anio' ", $conn) or die(mysql_error());
$row = mysql_fetch_array($consulta);
$karescri = $row['kardex'];
}


$consul_abre=mysql_query("Select ltrim(rtrim(c_valor)) as c_valor from tb_abreviatura where c_c_abreviatura='10004'", $conn) or die(mysql_error());

$row_abre=mysql_fetch_array($consul_abre);

$abreviatura= $row_abre['c_valor'];



$numero = $karescri;
$suma= intval($numero) + 1;
$nkardexx = $abreviatura.$suma.'-'.$anio;
$nmuestra=$abreviatura.$suma;
	
if($codactos == ""){
 ?>
<script language='javascript'>alert('Los campos de codigo de actos o contratos estan vacios, por favor ingresar datos');</script> 
<?php
}else{

$sql="INSERT INTO kardex(idkardex, kardex, idtipkar, kardexconexo, fechaingreso, horaingreso, referencia, codactos,contrato, idusuario, responsable, observacion, documentos, fechacalificado, fechainstrumento, fechaconclusion, numinstrmento, folioini, folioinivta, foliofin, foliofinvta, papelini, papelinivta, papelfin, papelfinvta, comunica1, contacto, telecontacto, mailcontacto, retenido, desistido, autorizado, idrecogio, pagado, visita, dregistral, dnotarial, idnotario, numminuta, numescritura, fechaescritura,idabogado,responsable_new,nc,fecha_modificacion,estado_sisgen) VALUES (NULL,'$nkardexx','$idtipkar','','$fechaingreso','$horaingreso','$referencia','$codactos','$contrato','$idusuario','$responsable','','','','','','','',0,'',0,'',0,'',0,'','','','',0,0,0,0,0,0,'$dregistral','$dnotarial',0,'','','0000-00-00','$idabogado','$responsable_new','','$fecha_modificacion','0')"; 

mysql_query($sql,$conn) or die(mysql_error());
$xidkardex=mysql_insert_id();

echo "<input type='hidden' id='idcodkardex' value='".$xidkardex."'>";

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
if($idtipkar == 5){
if($tipo_reinicio=='1'){
$consulta=mysql_query("SELECT MAX(CAST(FN_ONLYNUM(SUBSTRING_INDEX(kardex,'-',1)) AS SIGNED)) AS kardex FROM kardex WHERE idtipkar='5'  AND 
YEAR(STR_TO_DATE(fechaingreso,'%d/%m/%Y'))='$anio'", $conn) or die(mysql_error());
$row = mysql_fetch_array($consulta);

$karescri=$row['kardex'];
}else {
	$consulta=mysql_query("SELECT MAX(CAST(FN_ONLYNUM(SUBSTRING_INDEX(kardex,'-',1)) AS SIGNED)) AS kardex FROM kardex WHERE idtipkar='5' AND 
YEAR(STR_TO_DATE(fechaingreso,'%d/%m/%Y'))='$anio' ", $conn) or die(mysql_error());
$row = mysql_fetch_array($consulta);

$karescri=$row['kardex'];}

$consul_abre=mysql_query("Select ltrim(rtrim(c_valor)) as c_valor from tb_abreviatura where c_c_abreviatura='10005'", $conn) or die(mysql_error());

$row_abre=mysql_fetch_array($consul_abre);

$abreviatura= $row_abre['c_valor'];



$numero=$karescri;
$suma= intval($numero) + 1;
$nkardexx=$abreviatura.$suma.'-'.$anio;
$nmuestra=$abreviatura.$suma;

	
  if($codactos==""){
	  
    ?>
<script language='javascript'>alert('Los campos de codigo de actos o contratos estan vacios, por favor ingresar datos');</script> 
  <?php
   }else{

$sql="INSERT INTO kardex(idkardex, kardex, idtipkar, kardexconexo, fechaingreso, horaingreso, referencia, codactos,contrato, idusuario, responsable, observacion, documentos, fechacalificado, fechainstrumento, fechaconclusion, numinstrmento, folioini, folioinivta, foliofin, foliofinvta, papelini, papelinivta, papelfin, papelfinvta, comunica1, contacto, telecontacto, mailcontacto, retenido, desistido, autorizado, idrecogio, pagado, visita, dregistral, dnotarial, idnotario, numminuta, numescritura, fechaescritura,idabogado,responsable_new,nc,fecha_modificacion,estado_sisgen) VALUES (NULL,'$nkardexx','$idtipkar','','$fechaingreso','$horaingreso','$referencia','$codactos','$contrato','$idusuario','$responsable','','','','','','','',0,'',0,'',0,'',0,'','','','',0,0,0,0,0,0,'$dregistral','$dnotarial',0,'','','0000-00-00','$idabogado','$responsable_new','','$fecha_modificacion','0')"; 

mysql_query($sql,$conn) or die(mysql_error());
$xidkardex=mysql_insert_id();

echo "<input type='hidden' id='idcodkardex' value='".$xidkardex."'>";


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

// aca si es unico
}else{
	

$consulta = mysql_query("Select * from kardex order by CONVERT(KARDEX,UNSIGNED INTEGER) DESC LIMIT 1 ", $conn) or die(mysql_error());

$row = mysql_fetch_array($consulta);

$numero=$row['kardex'];
$suma= intval($numero) + 1;
$nkardexx=$suma;	

if($codactos==""){
 ?>
<script language='javascript'>alert('Los campos de codigo de actos o contratos estan vacios, por favor ingresar datos');</script> 
<?php
}else{

$sql="INSERT INTO kardex(idkardex, kardex, idtipkar, kardexconexo, fechaingreso, horaingreso, referencia, codactos,contrato, idusuario, responsable, observacion, documentos, fechacalificado, fechainstrumento, fechaconclusion, numinstrmento, folioini, folioinivta, foliofin, foliofinvta, papelini, papelinivta, papelfin, papelfinvta, comunica1, contacto, telecontacto, mailcontacto, retenido, desistido, autorizado, idrecogio, pagado, visita, dregistral, dnotarial, idnotario, numminuta, numescritura, fechaescritura,idabogado,responsable_new,nc,fecha_modificacion,estado_sisgen) VALUES (NULL,'$nkardexx','$idtipkar','','$fechaingreso','$horaingreso',UPPER('$referencia'),'$codactos',UPPER('$contrato'),'$idusuario','$responsable','','','','','','','',0,'',0,'',0,'',0,'','','','',0,0,0,0,0,0,'$dregistral','$dnotarial',0,'','','0000-00-00','$idabogado','$responsable_new','','$fecha_modificacion','0')"; 

mysql_query($sql,$conn) or die(mysql_error());
$xidkardex=mysql_insert_id();

echo "<input type='hidden' id='idcodkardex' value='".$xidkardex."'>";

echo "<input name='codkardex' id='codkardex' readonly='readonly' type='text' value='".$nkardexx."' style='font-family:Calibri; font-size:24px; color:#003366; border:none;' size='8'>";

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