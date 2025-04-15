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
$buscacargooss6 = $_POST['buscacargoosscnt'];

$sqlbuspro=mysql_query("select * from cargoprofe where  descripcrapro LIKE '%$buscacargooss6%'", $conn) or die(mysql_error());
while ($rowbuspro=mysql_fetch_array($sqlbuspro)){

echo"<table width='520' border='1' cellpadding='0' cellspacing='0' bordercolor='#B0B0B0'>
  <tr>
    <td width='411'><span class='textubi'>".$rowbuspro['descripcrapro']."</span></td>
    <td width='89'><a href='#' id='".$rowbuspro['idcargoprofe']."' name='".$rowbuspro['descripcrapro']."' onclick='mostrarcargooscnt(this.id,this.name)'><img src='../../iconos/seleccionar.png' width='94' height='29'></a></td>
  </tr>
</table>";

};



?>
