<?php 

include("conexion.php");


$nombre=strtoupper($_POST['nombre']);


$sql="select * from servidor where idservidor='1'";
$rpta=mysql_query($sql,$conn) or die(mysql_error());
$row=mysql_fetch_array($rpta);


if($row['idservidor']=='1'){
	?>
    <script language='javascript'>alert('Ya se encuentra registrado el Servidor');</script>
	<?php
	}else{
		
		$grabarclientesc="INSERT INTO servidor(idservidor, nombre) VALUES (NULL,'$nombre')";
mysql_query($grabarclientesc,$conn) or die(mysql_error());

?>
<script language='javascript'>alert('grabado satisfactoriamente');</script> 
<?php
		
		}


?>
