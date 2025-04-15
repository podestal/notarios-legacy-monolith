<?php 
session_start();
include("conexion2.php");
include("extraprotocolares/view/funciones.php");

$kardex=$_REQUEST["kardex"];

$sql="select so,nombre from servidor where idservidor='1'";
$rpta=mysqli_query($conn_i,$sql) or die(mysqli_error($conn_i));
$row=mysqli_fetch_array($rpta);

/*
$sql_ruta="select ruta_generar from rutaplantillas where id='22'";
$rpta_ruta=mysqli_query($conn_i,$sql_ruta) or die(mysqli_error($conn_i));
$row_ruta=mysqli_fetch_array($rpta_ruta);
*/

if(!isset($row_ruta["ruta_generar"]))
	$row_ruta["ruta_generar"]="";
if($row["so"]=="WINDOWS"){
	//$path="\\"."\\".$row["nombre"];
	$path="C:/Minutas/";
}else if($row["so"]=="LINUX"){
	$path=$row["nombre"]."//";
} 
$preextension=explode(".", $_FILES['archivo']['name']);
$extension = pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);

/*
$uploads_dir0 = "\\home\Archivos\Data\Minutas\\".$kardex.".".$extension;
$rsp=move_uploaded_file($_FILES['archivo']['tmp_name'],$uploads_dir0);
*/

$uploads_dir = $path.$row_ruta["ruta_generar"]."__MIN__".$kardex.".".$extension;
$val=move_uploaded_file($_FILES['archivo']['tmp_name'],$uploads_dir);


if ($val){
		$updateQuery="update kardex set documentos='1' where kardex='$kardex'";
		mysqli_query($conn_i,$updateQuery);
		$kardex	= $_REQUEST['kardex'];
		$tipo	= "CUERPO";
		$obs	= "SE ACTUALIZO EL CUERPO DEL DOCUMENTO (MINUTA) PARA ESTE KARDEX.";
		$fecha=date("Y-m-d G:i:s");
		$insertDocGenerados="
		insert into documentogenerados (observacion,fecha,usuario,pc,ip,tipogeneracion,kardex,flag) 
		values ('".$obs."',NOW(),'".$_SESSION["id_usu"]."','".php_uname('n')."','".$_SESSION["computadora"]."','".$tipo."','".$kardex."','MIN')";
		
		mysqli_query($conn_i,$insertDocGenerados);
		


$sql="select so,nombre from servidor where idservidor='1'";
$rpta=mysqli_query($conn_i,$sql) or die(mysqli_error($conn_i));
$row=mysqli_fetch_array($rpta);
$server = $row['nombre'];


		if($server=="WINDOWS"){
			$directorio="\\"."\\".$server;
		}else if($row["so"]=="LINUX"){
			$directorio="";
		} 
$directorio.= $row_ruta["ruta_generar"]."__MIN__".$kardex.".".$extension;

	


		chmod($directorio, 0777);

		header ("Location: cargaminuta.php?kardex=$kardex");
   	}else{
		header ("Location: cargaminuta.php?kardex=$kardex");
	}
	


?>