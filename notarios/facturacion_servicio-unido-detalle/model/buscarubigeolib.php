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
$buscaubi=$_POST['buscaubi'];

$sqlbusubi=mysql_query("select * from ubigeo where  nomdis LIKE '%$buscaubi%'", $conn) or die(mysql_error());
while ($rowbusubi=mysql_fetch_array($sqlbusubi)){

echo"<table width='550' border='1' cellpadding='0' cellspacing='0' bordercolor='#B0B0B0' ba>
  <tr>
    <td width='461'><span class='textubi'>".$rowbusubi['nomdpto']."/".$rowbusubi['nomprov']."/".$rowbusubi['nomdis']."</span></td>
    <td width='89'><a href='#' id='".$rowbusubi['nomdpto']."/".$rowbusubi['nomprov']."/".$rowbusubi['nomdis']."' name='".$rowbusubi['coddis']."' onclick='mostrarubigeoo(this.id,this.name)'><img src='../../iconos/seleccionar.png' width='94' height='29'></a></td>
  </tr>
</table>";

};



?>
