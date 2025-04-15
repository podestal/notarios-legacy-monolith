<?php

include('../conexion.php');
include_once('../includes/ClaseLetras.class.php');

$fecha = new ClaseNumeroLetra();

$dia  = $fecha->fun_fecha_dia(); 
$mes  = $fecha->fun_fecha_mes();
$anio = $fecha->fun_fecha_anio();

$fec_letras = $fecha->fun_fech_comple("2013/03/14");

$num_crono = $_REQUEST["num_crono"];

$consulcartas = mysql_query('SELECT UPPER(cert_supervivencia.nombre) AS "NOMBRE_PERSONA", UPPER(tipodocumento.destipdoc) AS "TIP_DOC", UPPER(cert_supervivencia.numdocu) AS "NUM_DOC", 
UPPER(nacionalidades.desnacionalidad) AS "NACIONALIDAD", UPPER(tipoestacivil.desestcivil) AS "EST_CIVIL", UPPER(cert_supervivencia.direccion) AS "DOMICILIO",
UPPER(ubigeo.nomdis) AS "NOM_DIST"
FROM cert_supervivencia    
INNER JOIN tipodocumento ON cert_supervivencia.tipdocu = tipodocumento.codtipdoc
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cert_supervivencia.nacionalidad
INNER JOIN tipoestacivil ON tipoestacivil.idestcivil = cert_supervivencia.ecivil
INNER JOIN ubigeo ON ubigeo.coddis = cert_supervivencia.ubigeo
WHERE num_crono = "2013000013"', $conn) or die(mysql_error());
$registro = mysql_fetch_array($consulcartas);

$d=mysql_num_rows($consulcartas);
if($d>0){
	header('Content-type: application/vnd.ms-word');
	header('Content-Disposition: attachment; filename=archivo.doc');
	header('Pragma: no-cache');
	header('Expires: 0');
	
	echo('');
	
}
else{
echo('No hay registros en la tabla');
}
mysql_close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>Formulario Persona Capaz</title>
<style type="text/css"> 
.pJustifica{ 
text-align: justify; 
} 
.msletra
{	
	display:block;
	font-family:Verdana, Geneva, sans-serif;
	font-size:13px;
	text-align:justify;
}

.msSub
{	
	display:block;
	font-family:Verdana, Geneva, sans-serif;
	font-size:13px;
	text-align:center;
}

.mstitulo
{
	display:block;
	font-family:Verdana, Geneva, sans-serif;
	font-size:14px;
}
</style>
<script type="text/javascript">
function fmedida()
{ 	
	var _get = document.getElementById('primer_parrafo')
	var _med = document.getElementById('primer_parrafo').height;
		
}

</script>
</head>
<body>
<h3 class="mstitulo" align="center">CERTIFICADO DE SUPERVIVENCIA DE PERSONA CAPAZ</h3>
<h3 class="mstitulo" align="center">EL(LA) NOTARIO(A) QUE SUSCRIBE, CERTIFICA:</h3>
<p class="msletra" align="justify">&nbsp;</p>
<p class="msletra" align="justify">LA SUPERVIVENCIA DE <strong><?php echo $registro[0]; ?></strong></p>
<p class="msletra" align="justify">IDENTIFICADA CON <strong><?php echo $registro[1]; ?></strong> N. <strong><?php echo $registro[2]; ?></strong> </p>
<p class="msletra" align="justify">QUIEN PRESENTE ANTE MI EL DIA DE HOY, MANIFIESTA SER: DE </p>
<p class="msletra" align="justify">NACIONALIDAD <strong><?php echo $registro[3]; ?></strong>, DE ESTADO CIVIL <strong><?php echo $registro[4]; ?></strong>. </p>
<p class="msletra" align="justify">Y DOMICILIAR EN: <strong><?php echo $registro[5]; ?></strong>, DISTRITO DE <strong><?php echo $registro[6]; ?></strong> </p>
<p class="msletra" align="justify">OBSERVACIONES: SE DEJA CONSTANCIA QUE SE FOTOCOPIA EL DOCUMENTO NACIONAL DE IDENTIDAD <strong><?php echo $registro[1]; ?></strong> AL REVERSO DEL PRESENTE DOCUMENTO.</p>
<br>
<br>
<br>
<p class="msSub" align="center">EN LIMA, A LOS  <?php echo $fec_letras; ?> </p>
<br>
<br>
<br>
<br>
<p class="msSub" align="center">FIRMA DE LA INTERESADA</p>
<p class="msletra" align="justify">&nbsp;</p>
<p class="msletra" align="justify">&nbsp;</p>
<p class="msletra" align="justify">&nbsp;</p>
<p class="msSub" align="center">FIRMA Y SELLO DEL(LA) NOTARIO(A)</p>
</body>
</html>

