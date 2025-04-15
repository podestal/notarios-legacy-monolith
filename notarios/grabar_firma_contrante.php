<?php 
session_start();
include("conexion.php");

$firmitaa=$_POST['firmitaa'];
$fecfirmaa=$_POST['fecfirmaa'];
$codkardex=$_POST['codkardex'];
$fecha_modificacion = date("d/m/Y");
$codiusuario=intval($_SESSION["id_usu"]);

$sqlupdatefirma="UPDATE contratantes SET fechafirma='$fecfirmaa',resfirma='$codiusuario' WHERE idcontratante='".$firmitaa."'"; 
mysql_query($sqlupdatefirma,$conn) or die(mysql_error());

$consulta = mysql_query("SELECT * from contratantes where kardex='$codkardex' and (firma='1' and fechafirma='')", $conn) or die(mysql_error());
$numero = mysql_num_rows($consulta);

if($numero==0) 
  {  
  
  $sql=mysql_query("SELECT MAX(REPLACE(STR_TO_DATE(fechafirma,'%d/%m/%Y'), '-', '')) AS ultima FROM contratantes WHERE kardex='$codkardex' AND firma='1'",$conn);
$last = mysql_fetch_array($sql);

$year=substr($last[0],0,4);
$month=substr($last[0],4,2);
$day=substr($last[0],6,2);

 $fecha=$day."/".$month."/".$year;


  mysql_query("update kardex set fechaconclusion='$fecha',fecha_modificacion ='$fecha_modificacion' where kardex='$codkardex'", $conn) or die(mysql_error());	
	#$rowresult = mysql_fetch_array($updatek);
	#$res = $rowresult['fechaconclusion'];
	echo"<span>Fecha conclusion: ".$fecha."<span>";
  }

#if($numeroa[0]!='')

#{echo"<span>Fecha: ".$numeroa[0]."<span>";}


?>
