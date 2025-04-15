<?php 
include("conexion.php");
$valor = $_POST['valor'];


if($valor=='cliente'){
 include("mostrarnewclientedni.php");
}else{
 include("mostrarnewclienteruc.php");
}

 
?>
