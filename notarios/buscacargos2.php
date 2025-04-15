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
include("conexion.php");
$buscacargooss2=$_POST['buscacargooss2'];

$sqlbuspro=mysql_query("select * from cargoprofe where  descripcrapro LIKE '%$buscacargooss2%'", $conn) or die(mysql_error());
while ($rowbuspro=mysql_fetch_array($sqlbuspro)){

echo"<table width='550' border='1' cellpadding='0' cellspacing='0' bordercolor='#B0B0B0' ba>
  <tr>
    <td width='461'><span class='textubi'>".$rowbuspro['descripcrapro']."</span></td>
    <td width='89'><a href='#' id='".$rowbuspro['idcargoprofe']."' name='".$rowbuspro['descripcrapro']."' onclick='mostrarcargoos2(this.id,this.name)'><img src='iconos/seleccionar.png' width='94' height='29'></a></td>
  </tr>
</table>";

};



?>
