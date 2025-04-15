<?php
//DECLARAMOS LA CONEXION
include("conexion.php");
$nom=$_REQUEST["kardex"];
//CONSUTA PARA EL SERVIDOR
$sql="select * from servidor where idservidor='1'";
$rpta=mysql_query($sql,$conn) or die(mysql_error());
$row=mysql_fetch_array($rpta);
/*
$sql_ruta="select * from rutaplantillas where id='22'";
$rpta_ruta=mysql_query($sql_ruta,$conn) or die(mysql_error());
$row_ruta=mysql_fetch_array($rpta_ruta);
*/
//ASIGNAMOS SU EXTENSION SEGUN LA HAYAMOS CONFIGURADO
$archivo = "__".$nom.".".$_REQUEST["ext"]; 
//COMPROBAMOS EL SISTEMA OPERATIVO, PARA PODER JALAR POR IP
if($row["so"]=="WINDOWS"){
	$path="\\"."\\".$row["nombre"];
}else if($row["so"]=="LINUX"){
	$path="";
} 
//DECLARAMOS EL TYPE
$type = '';
//BASENAMOS DE ARCHIVO IMPORTANTE SINO SE NOS DESCARARA EL FICHERO COMO .PHP Y NO .***
$file = basename($archivo);
$path="C:/Minutas/"."__MIN".$file;
$path=$path;

var_dump($path);
if (is_file($path))
{
echo $path;
  	if(unlink($path)){
		echo "si";
	}else{
	echo "no";	
	}
 
}

?>