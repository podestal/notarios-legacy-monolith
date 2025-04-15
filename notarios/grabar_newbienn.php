 <?php session_start();
include("conexion.php");

$codkardex=$_POST['codkardex'];
$fecha_modificacion = date("d/m/Y");
# se adiciono guardar el id del tipo de acto:
$concatenado   = $_POST['idtipacto'];
$rows = explode("|",$concatenado );
$idtipacto = $rows[0];

$len = strlen($idtipacto);
if($len < 3)
{
	$idtipacto2 = '0'.$_POST['idtipacto'];
}
else
{
	$idtipacto2 = $_POST['idtipacto'];
}

$tipob = $_POST['tipob'];
$tipobien       = $_POST['tipobien'];
if($tipobien=='8'){
$oespecific     = "";
$smaquiequipo   = "";
$tpsm		    = $_POST['tpsm'];
$npsm		    = $_POST['npsm'];	
}

if($tipobien=='5'){
$oespecific     = "";
$smaquiequipo   = $_POST['smaquiequipo'];
$tpsm		    = "";
$npsm		    = "";	
}

if($tipobien=='10'){
$oespecific     = $_POST['oespecific'];
$smaquiequipo   = "";
$tpsm		    = "";
$npsm		    = "";	
}

if($tipobien!='10' && $tipobien!='8' && $tipobien!='5'){
$oespecific     = "";
$smaquiequipo   = "";
$tpsm		    = "";
$npsm		    = "";	
}

$codubis        = $_POST['codubis'];
$fechaconst     = $_POST['fechaconst'];

//$itemmpp = $_REQUEST['itemmpp']=='' ? $_SESSION['varitem'] : $_REQUEST['itemmpp'];

$pregis		    = $_POST['pregis'];
$idsederegbien	= $_POST['idsederegbien'];


$consulta_mp=mysql_query(" select itemmp from patrimonial where kardex='".$codkardex."'",$conn) or die(mysql_error());
$row_mp=mysql_fetch_array($consulta_mp);


$itemmpp=$row_mp['itemmp'];


mysql_query("INSERT INTO detallebienes(detbien, itemmp, kardex, idtipacto, tipob, idtipbien, coddis, fechaconst, oespecific, smaquiequipo, tpsm, npsm, pregistral, idsedereg) VALUES (NULL,'$itemmpp','$codkardex', '$idtipacto', '$tipob','$tipobien','$codubis','$fechaconst','$oespecific','$smaquiequipo','$tpsm','$npsm', '$pregis', '$idsederegbien' )", $conn) or die(mysql_error());

$sqlmodificacion="UPDATE KARDEX SET  fecha_modificacion ='$fecha_modificacion',estado_sisgen='0' WHERE KARDEX ='$codkardex'"; 
mysql_query($sqlmodificacion,$conn) or die(mysql_error());


?>
