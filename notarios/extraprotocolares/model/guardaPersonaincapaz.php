<?php
include('../../conexion.php');

$num_crono     = strtoupper($_POST["num_crono"]);
$fecha         = strtoupper($_POST["fecha"]);
$num_formu     = strtoupper($_POST["_num_formu"]);
$documento     = strtoupper($_POST["documento"]);

$apepatexto=strtoupper($_POST['nombre']);
$cabioapostroa=str_replace("'","?",$apepatexto);
$nombre=strtoupper($cabioapostroa);

$tipdocu       = strtoupper($_POST["tipdocu"]);
$numdocu       = strtoupper($_POST["numdocu"]);
$nacionalidad  = strtoupper($_POST["nacionalidad"]);
$ecivil 	   = strtoupper($_POST["ecivil"]);

$apemattexto=strtoupper($_POST['direccion']);
$cabioapostrom=str_replace("'","?",$apemattexto);
$direccion=strtoupper($cabioapostrom);

$observaciones = strtoupper($_POST["observaciones"]);
$idzona        = strtoupper($_POST["idzona"]);


$representantep=strtoupper($_POST['representante']);
$representantepp=str_replace("'","?",$representantep);
$representante=strtoupper($representantepp);

$tipdocu_rep   = strtoupper($_POST["tipdocu_rep"]);
$numdocu_rep   = strtoupper($_POST["numdocu_rep"]);
$nombre_rep    = strtoupper($_POST["nombre_rep"]);


$segnomp=strtoupper($_POST['nom_testigo']);
$cabioapostromm=str_replace("'","?",$segnomp);
$nom_testigo=strtoupper($cabioapostromm);


$tdoc_testigo  = strtoupper($_POST["tdoc_testigo"]);
$ndocu_testigo = strtoupper($_POST["ndocu_testigo"]);

$pelectronica	= strtoupper($_POST["pelectronica"]);
$especi	= strtoupper($_POST["especi"]);


if ($pelectronica==""){
$pelectronicaa="";
}else{
$pelectronicaa=$pelectronica;
}	

$id_supervivencia = "";
$swt_capacidad = "I";

// verifica la existendia del numero de certificado, sino edita

if($num_crono =='')
{
	
//guarda el cronologico.
$busnumkardex = "SELECT CONCAT(YEAR(NOW()),REPEAT('0',6-LENGTH((MAX(CAST(RIGHT(cert_supervivencia.num_crono,6) AS DECIMAL))+1))),
(MAX(CAST(RIGHT(cert_supervivencia.num_crono,6) AS DECIMAL))+1)) AS numcrono FROM cert_supervivencia WHERE YEAR(fecha)=YEAR(NOW()) AND swt_capacidad='I'";

$numkarbus = mysql_query($busnumkardex,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numkarbus);
$newnumkar  = $rownum[0];

if($newnumkar == '')
{
	$new_num_kar = date("Y").'000001';
}
else if($newnumkar != '')
{
	$new_num_kar = $newnumkar;
}

########
echo "<input name='num_crono' id='num_crono' readonly='readonly' type='hidden' value='".$new_num_kar."' style='font-family:Calibri; font-size:14px; color:#003366; border:none;' size='8'>";

// Muestra el ID en la forma:  000001-2013
$numkar = $new_num_kar;
$numkar2 = substr($numkar,5,6).'-'.substr($numkar,0,4);

echo "<input name='muesnumcrono' id='muesnumcrono' readonly='readonly' type='text' value='".$numkar2."' style='font-family:Calibri; font-size:16px; color:#003366; border:none;' size='8'>";
########

$grabpersonacapaz = "INSERT INTO cert_supervivencia(id_supervivencia, num_crono, fecha, num_formu, documento, nombre, tipdocu, numdocu, nacionalidad, ecivil, ubigeo,
direccion, observaciones, representante, tipdocu_rep, numdocu_rep, nombre_rep, nom_testigo, tdoc_testigo, ndocu_testigo, swt_capacidad, pelectronica,especificacion) VALUES(NULL, '$new_num_kar', STR_TO_DATE('$fecha','%d/%m/%Y'), '$num_formu', '$documento', '$nombre', '$tipdocu', '$numdocu', '$nacionalidad', '$ecivil', '$idzona', '$direccion', '$observaciones', '$representante', '$tipdocu_rep', '$numdocu_rep', '$nombre_rep', '$nom_testigo', '$tdoc_testigo', '$ndocu_testigo', '$swt_capacidad','$pelectronicaa','$especi')";

mysql_query($grabpersonacapaz,$conn) or die(mysql_error());

}

# edicion
if($num_crono != '')
{
$updatepersonacapaz = "UPDATE cert_supervivencia SET  fecha = STR_TO_DATE('$fecha','%d/%m/%Y'), num_formu = '$num_formu', documento = '$documento', nombre = '$nombre', 
tipdocu = '$tipdocu', numdocu = '$numdocu', nacionalidad = '$nacionalidad', ecivil = '$ecivil', ubigeo = '$idzona'  , direccion = '$direccion', observaciones = '$observaciones',representante='$representante', tipdocu_rep = '$tipdocu_rep',
numdocu_rep = '$numdocu_rep',
swt_capacidad = '$swt_capacidad', nom_testigo = '$nom_testigo', tdoc_testigo = '$tdoc_testigo', ndocu_testigo = '$ndocu_testigo', pelectronica='$pelectronicaa' , especificacion='$especi' WHERE num_crono = '$num_crono' AND swt_capacidad = 'I'";

mysql_query($updatepersonacapaz, $conn) or die(mysql_error());

################
echo "<input name='num_crono' id='num_crono' readonly='readonly' type='hidden' value='".$num_crono."' style='font-family:Calibri; font-size:20px; color:#003366; border:none;' 																																																										size='8'>";

// Muestra el ID en la forma:  000001-2013
$numkarE = $num_crono;
$numkar3 = substr($numkarE,5,6).'-'.substr($numkarE,0,4);

echo "<input name='muesnumcrono' id='muesnumcrono' readonly='readonly' type='text' value='".$numkar3."' style='font-family:Calibri; font-size:16px; color:#003366; border:none;' size='8'>";
################		
}

mysql_close($conn);
?>


