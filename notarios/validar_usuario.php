<?php 
session_start();
include("conexion.php");


$usuario=strtoupper($_POST['usuario']);
$password=strtoupper($_POST['clave']);

$sql = "SELECT * FROM usuarios WHERE loginusuario='".$usuario."'";
$result = mysql_query($sql,$conn) or die(mysql_error());
			
if($row=mysql_fetch_array($result))

 { 				
   if ($row["password"] == $password & $row["estado"]==1)
   {				   
     //establecermos las variables de sesión
     
	  $_SESSION["apepat_usu"] = $row["apepat"];
	  $_SESSION["apemat_usu"] = $row["apemat"];
	  $_SESSION["nom1_usu"] = $row["prinom"];
	  $_SESSION["nom2_usu"] = $row["segnom"];
      $_SESSION["id_usu"] = $row["idusuario"];

	  ?>
		<script type="text/javascript">window.location="area_notarial.php"; </script> 
      <?php
	  }else{
	  ?>
	  <script language='javascript'>alert('La contraseña es incorrecta o el usuario esta bloqueado');</script> 
        <script type="text/javascript">window.location="index.php"; </script> 
	  <?php
	  }
 } else{
 ?>
	  <script language='javascript'>alert('El usuario no existe');</script> 
        <script type="text/javascript">window.location="index.php"; </script> 
	  <?php
 
 }
 
 
	  ?>	

