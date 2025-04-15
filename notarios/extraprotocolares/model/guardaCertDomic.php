<?php
include('../../conexion.php');

$num_certificado    = $_POST["num_certificado"];
$fec_ingreso        = $_POST["fec_ingreso"];
$num_formu          = $_POST["num_formu"];


$apepatexto=strtoupper($_POST['nombre_solic']);
$cabioapostroa=str_replace("'","?",$apepatexto);
$nombre_solic=strtoupper($cabioapostroa);

$tipdoc_solic       = $_POST["tipdoc_solic"];
$numdoc_solic       = $_POST["numdoc_solic"];


$apepatexto=strtoupper($_POST['domic_solic']);
$cabioapostroa=str_replace("'","?",$apepatexto);
$domic_solic=strtoupper($cabioapostroa);

$motivo_solic       = $_POST["motivo_solic"];
$distrito_solic 	= $_POST["distrito_solic"];
$texto_cuerpo       = $_POST["texto_cuerpo"];
$justifi_cuerpo     = $_POST["justifi_cuerpo"];
$sexo				= $_POST['sexo'];
$idestcivil 		= intval($_POST['idestcivil']);


$apepatexto=strtoupper($_POST['nom_testigo']);
$cabioapostroa=str_replace("'","?",$apepatexto);
$nom_testigo=strtoupper($cabioapostroa);

$tdoc_testigo       = $_POST["tdoc_testigo"];
$ndocu_testigodom   = $_POST["ndocu_testigodom"];

$idprofesionc		= $_POST["hdnnomprofesionesc"];
$nomprofesionesc	= $_POST["nomprofesionesc"];

// verifica la existendia del numero de certificado, sino edita

$fecha_ocupa = $_POST['fecha_ocupa'];
$declara_ser = $_POST['declara_ser'];
$propietario = $_POST['propietario'];
$recibido = $_POST['recibido'];
$recibo_empresa = $_POST['recibo_empresa'];
$numero_recibo = $_POST['numero_recibo'];
$mes_facturado = $_POST['mes_facturado'];

if($num_certificado == '')
{
	
// se arma el numero de certificado: formato 000001

$busnumcarta = "SELECT num_certificado FROM cert_domiciliario WHERE num_certificado <> '' ORDER BY num_certificado DESC LIMIT 0,1";

$numcartabus = mysql_query($busnumcarta,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numcartabus);
$newnumcarta  = $rownum['num_certificado'];
$anio_act=intval(date("Y"));
$anio_crono=intval(substr($newnumcarta, 0,4));
$numero_crono=intval(substr($newnumcarta, 4));

if($newnumcarta == '')
{
	$new_num_carta = date("Y")."000001";
}
else if($newnumcarta != '')
{
	
	if($anio_crono<$anio_act){
		$new_num_carta = date("Y").'000001';
	}else{
	  $suma_num=$numero_crono + 1;
	  $cantidad= strlen($suma_num);
		 switch ($cantidad) {
			case "1":
			 $new_num_carta=$anio_act."00000".$suma_num;
			break;
			case "2":
			 $new_num_carta=$anio_act."0000".$suma_num;	
			break;
			case "3":
			 $new_num_carta=$anio_act."000".$suma_num;
			break;
			case "4":
			 $new_num_carta=$anio_act."00".$suma_num;	
			break;
			case "5":
			 $new_num_carta=$anio_act."0".$suma_num;
			break;
			case "6":
			 $new_num_carta=$anio_act.$suma_num;	
			break;	
						
		  }
	 
		}
}





########
echo "<input name='num_certificado' id='num_certificado' readonly='readonly' type='hidden' value='".$new_num_carta."' style='font-family:Calibri; font-size:14px; color:#003366; border:none;' size='8'>";

// Muestra el ID en la forma:  000001-2013
$numkar = $new_num_carta;
$numkar2 = substr($numkar,5,6).'-'.substr($numkar,0,4);

echo "<input name='muesnumcerti' id='muesnumcerti' readonly='readonly' type='text' value='".$numkar2."' style='font-family:Calibri; font-size:16px; color:#003366; border:none;' size='8'>";
########

$grabcertidom = "INSERT INTO cert_domiciliario(id_domiciliario, num_certificado,fec_ingreso, num_formu, nombre_solic, tipdoc_solic, numdoc_solic, domic_solic,
motivo_solic, distrito_solic, texto_cuerpo, justifi_cuerpo, nom_testigo, tdoc_testigo, ndocu_testigo, idestcivil, sexo,detprofesionc,profesionc,fecha_ocupa,declara_ser,propietario,recibido,recibo_empresa,numero_recibo,mes_facturado) VALUES (NULL, '$new_num_carta', STR_TO_DATE('$fec_ingreso','%d/%m/%Y'), '$num_formu', '$nombre_solic', 
'$tipdoc_solic', '$numdoc_solic', '$domic_solic', '$motivo_solic', '$distrito_solic', '$texto_cuerpo', '$justifi_cuerpo', '$nom_testigo', '$tdoc_testigo', '$ndocu_testigodom' , '$idestcivil' ,'$sexo','$nomprofesionesc','$idprofesionc','$fecha_ocupa','$declara_ser','$propietario','$recibido','$recibo_empresa','$numero_recibo','$mes_facturado')";


mysql_query($grabcertidom,$conn) or die(mysql_error());

}

# edicion
if($num_certificado != '')
{

$updatecertidom = "UPDATE cert_domiciliario SET fec_ingreso = STR_TO_DATE('$fec_ingreso','%d/%m/%Y'), num_formu = '$num_formu', nombre_solic = '$nombre_solic', 
tipdoc_solic = '$tipdoc_solic', numdoc_solic = '$numdoc_solic', domic_solic = '$domic_solic', motivo_solic = '$motivo_solic', 
distrito_solic = '$distrito_solic', texto_cuerpo = '$texto_cuerpo', justifi_cuerpo = '$justifi_cuerpo', nom_testigo = '$nom_testigo', tdoc_testigo = '$tdoc_testigo', ndocu_testigo = '$ndocu_testigodom' ,
idestcivil = '$idestcivil' , sexo = '$sexo',
detprofesionc = '$nomprofesionesc',
profesionc = '$idprofesionc',
fecha_ocupa = '$fecha_ocupa',
declara_ser = '$declara_ser',
propietario = '$propietario',
recibido = '$recibido',
recibo_empresa = '$recibo_empresa',
numero_recibo = '$numero_recibo',
mes_facturado = '$mes_facturado'
WHERE num_certificado = '$num_certificado'";

mysql_query($updatecertidom, $conn) or die(mysql_error());

################
echo "<input name='num_certificado' id='num_certificado' readonly='readonly' type='hidden' value='".$num_certificado."' style='font-family:Calibri; font-size:20px; color:#003366; border:none;' 																																																size='8'>";

// Muestra el ID en la forma:  000001-2013
$numkarE = $num_certificado;
$numkar3 = substr($numkarE,5,6).'-'.substr($numkarE,0,4);

echo "<input name='muesnumcerti' id='muesnumcerti' readonly='readonly' type='text' value='".$numkar3."' style='font-family:Calibri; font-size:16px; color:#003366; border:none;' size='8'>";
################

	
}

mysql_close($conn);
?>


