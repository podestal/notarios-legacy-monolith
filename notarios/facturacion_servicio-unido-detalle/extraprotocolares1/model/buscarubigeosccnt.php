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

$texto=$_POST['buscaubisccnt'];
$buscaubisc6= str_replace("ñ", "Ñ", $texto);

$sqlbusubi=mysql_query("select * from ubigeo where  nomdis LIKE '%$buscaubisc6%'", $conn) or die(mysql_error());
while ($rowbusubi=mysql_fetch_array($sqlbusubi)){

echo"<table width='520' border='1' cellpadding='0' cellspacing='0' bordercolor='#B0B0B0'>
  <tr>
    <td width='411'><span class='textubi'>".$rowbusubi['nomdpto']."/".$rowbusubi['nomprov']."/".$rowbusubi['nomdis']."</span></td>
    <td width='89'><a href='#' id='".$rowbusubi['nomdpto']."/".$rowbusubi['nomprov']."/".$rowbusubi['nomdis']."' name='".$rowbusubi['coddis']."' onclick='mostrarubigeoosccnt(this.id,this.name)'><img src='../../iconos/seleccionar.png' width='94' height='29'></a></td>
  </tr>
</table>";

};



?>
