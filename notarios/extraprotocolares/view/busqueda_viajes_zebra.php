<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../includes/css/uniform.default.min.css" />
<style type="text/css">
<!--
.titubuskar {
	font-family: Calibri;
	font-size: 12px;
	font-weight: bold;
	font-style: italic;
	color: #003366;
}
.titubuskar0 {font-family: Calibri; font-size: 12px; font-style: italic; font-weight: bold; color: #333333; }
.titubuskar1 {color: #333333}
.reskar2 {font-family: Calibri; font-size: 13px; font-weight: bold; font-style: italic; color: #003366; }
.reskar {font-size: 12px; font-style: italic; color: #333333; font-family: Calibri;}
-->
</style>

<?php 
require_once("../../includes/_ClsCon.php");
require_once("../../includes/Zebra_Pagination.php");
$_obj   = new _ClsCon();        	


	$numformu     = $_REQUEST['numformu'];
	$participante = $_REQUEST['participante'];
	$rango1       = $_REQUEST['rango1'];
	$rango2       = $_REQUEST['rango2'];
	$tippersona   = $_REQUEST['tippersona'];
	
    $consulkar    = "CALL spLisViajes('".$rango1."' ,'".$rango2."' ,'".$tippersona."' ,'".$participante."','".$numformu."')";
	
	$consulta_viajes = $_obj->_trans($consulkar);
	//var_dump($consulta_poderes);
	//exit();
	
	// devuelve el numero de rows de la consulta
	$numrows    = $_obj->_count_rows($consulkar);
	$resultados = 5;
	
	$paginacion = new Zebra_Pagination();
	$paginacion->records($numrows);
	$paginacion->records_per_page($resultados);
	

echo "<table width='880' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
	<thead>
		<tr>
                <td width='30' align='center'><span class='titubuskar0'>Nro Control</span></td>
                <td width='60' align='center'><span class='titubuskar0'>Cronologico</span></td>
                <td width='15' style='max-width:150px;' align='center'><span class='titubuskar0'>Referencia</span></td>
                <td width='86' align='center'><span class='titubuskar0'>Fecha Crono.</span></td>
                <td width='150' align='center'><span class='titubuskar0'>Tip.Permiso</span></td>
                <td width='86' align='center'><span class='titubuskar0'>Fec. Ingreso</span></td>
                <td width='86' align='center'><span class='titubuskar0'>Participante</span></td>
                <td width='86' align='center'><span class='titubuskar0'>Descripcion</span></td>
              </tr>
	</thead>
  <tbody>";
 while ($rowkar = $consulta_viajes->fetch_array(MYSQLI_BOTH))
{	
$numkar = $rowkar['num_kardex'];
$numkar2 = substr($numkar,5,6).'-'.substr($numkar,0,4);
$fecha = $rowkar['fec_ingreso'];
$fecha2 = explode ("-",$fecha);
$fecha3 = $fecha2[2] . "/" . $fecha2[1] . "/" . $fecha2[0];
 
 echo " <tr>
    <td width='38' align='center' ><span class='reskar'><a href='EditPermiViajeVie.php?id_viaje=".$rowkar['id_viaje']."'>".$rowkar['id_viaje']."</a></span></td>
	<td width='60' align='center' ><span class='reskar'>".$numkar2."</span></td>
	<td width='150' style=max-width:160px;' align='center' ><span class='reskar'>".$rowkar['referencia']."</span></td>
	<td width='86' align='center' ><span class='reskar'>".$rowkar['fecha_crono']."</span></td>
    <td width='150' align='center'><span class='reskar'>".$rowkar['tipo_permiso']."</span></td>
	<td width='86' align='center'><span class='reskar'>".$fecha3."</span></td>
	<td width='86' align='center'><span class='reskar'>".$rowkar['c_descontrat']."</span></td>
	<td width='86' align='center'><span class='reskar'>".$rowkar['des_condicion']."</span></td>
  </tr> ";
  }
echo "</tbody></table>";
$paginacion->render();
?>


