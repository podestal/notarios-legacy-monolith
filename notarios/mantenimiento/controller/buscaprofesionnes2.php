<style type="text/css">
<!--
.textubi {
	font-family: Calibri;
	font-size: 12px;
	color: #333333;
}
-->
</style>
<?php 
include("../../conexion.php");
$buscaprofeconyuge=$_POST['buscaprofeconyuge'];

$sqlbuspro=mysql_query("select * from profesiones where  desprofesion LIKE '%$buscaprofeconyuge%'", $conn) or die(mysql_error());
while ($rowbuspro=mysql_fetch_array($sqlbuspro)){

echo"<table width='550' border='1' cellpadding='0' cellspacing='0' bordercolor='#B0B0B0' ba>
  <tr>
    <td width='461'><span class='textubi'>".$rowbuspro['desprofesion']."</span></td>
    <td width='89'><a href='#' id='".$rowbuspro['idprofesion']."' name='".$rowbuspro['desprofesion']."' onclick='mostrarprofesioness2(this.id,this.name)'><img src='../../iconos/seleccionar.png' width='94' height='29'></a></td>
  </tr>
</table>";

};



?>
