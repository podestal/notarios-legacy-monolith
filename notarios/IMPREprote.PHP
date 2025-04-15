<?php
$fechade = $_REQUEST['fecini'];
$fechaa  = $_REQUEST['fecfin'];
//$nomnotaria = "Nombre de la Notaria";
$nomnotaria = " ";
//$fechade = '01/01/2013';
//$fechaa = '31/01/2013';
$condicion = $_REQUEST['condicion'];
 echo "hola".$condicion;


?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        
        	<title>.::Indice Cronologico de protestos::.</title>
            <style type="text/css">
			#logo_emp{
				float:left;
				padding:0px;
				margin:0px;
				margin-top:10px;
				margin-left:10px;
				}
			#fec_actual{
				float:right;
				padding:0px;
				margin:0px;
				margin-top:10px;
				margin-right:10px;
				}	
			</style>
	</head>
        <body>
        <div><div id="logo_emp"><?php echo $nomnotaria ?></div> <!--<div id="fec_actual">Fecha: <?php echo $fec=date("d/m/Y H:m:s"); ?></div>--></div>        
<p align="center">  <br><br>
     <strong>REPORTE A LA CAMARA DE COMERCIO  DE PROTESTOS</strong></p>
<p align="center"><strong>Listado del <?php echo $fechade ?> al <?php echo $fechaa ?> <?php echo $text_check ?></strong></p>

<TABLE  BORDER=1 CELLSPACING=0 CELLPADDING=0 align="center">
            
       <!--<TR><TD width="70" height="19">Numero</TD><TD width="86">Fec. Ingr.</TD><TD width="86">Fec. Dilig.</TD><TD width="93">Zona</TD><TD width="171">&nbsp; Remitente</TD><TD width="275">&nbsp; Destinatario</TD></TR>-->
       
       		  <TR>
                <TD width="30" height="19">Nro Tit. Valor</td>
                <TD width="60">Nro Acta.</td>
                <TD width="60">Fecha Ingreso</td>
                <TD width="60">Fecha Notificacion.</td>
                <TD width="150">Solicitante</td>
                <TD width="150">Participantes</td>
                <TD width="60">Fecha Protesto</td>
                <TD width="60">Tipo Moneda</td>
                <TD width="60">Importe</td>
              </TR>
       
       
</TABLE>
<?php 
include('conexion.php');
$fechade = $_REQUEST['fecini'];
$fechaa  = $_REQUEST['fecfin'];



if($condicion == '1')
{
$consulta = mysql_query("SELECT protesto.id_protesto,protesto.solicitante,protesto.num_protesto,protesto.numero ,DATE_FORMAT(protesto.fec_ingreso,'%d/%m/%Y') AS 'fec_ingreso2' 
,DATE_FORMAT(protesto.fec_notificacion,'%d/%m/%Y') AS 'fec_notificacion2',
DATE_FORMAT(protesto.fec_constancia,'%d/%m/%Y') AS 'fec_constancia2',monedas.desmon,protesto.importe
FROM protesto
LEFT OUTER JOIN monedas ON monedas.idmon = protesto.moneda
WHERE protesto.fec_constancia BETWEEN STR_TO_DATE('$fechade','%d/%m/%Y') AND STR_TO_DATE('$fechaa','%d/%m/%Y')
ORDER BY protesto.id_protesto DESC", $conn) or die(mysql_error());
}
else if($condicion== '2')
{
$consulta = mysql_query("SELECT protesto.id_protesto,protesto.solicitante,protesto.num_protesto,protesto.numero ,DATE_FORMAT(protesto.fec_ingreso,'%d/%m/%Y') AS 'fec_ingreso2' 
,DATE_FORMAT(protesto.fec_notificacion,'%d/%m/%Y') AS 'fec_notificacion2',
DATE_FORMAT(protesto.fec_constancia,'%d/%m/%Y') AS 'fec_constancia2',monedas.desmon,protesto.importe
FROM protesto
LEFT OUTER JOIN monedas ON monedas.idmon = protesto.moneda
WHERE protesto.fec_notificacion BETWEEN STR_TO_DATE('$fechade','%d/%m/%Y') AND STR_TO_DATE('$fechaa','%d/%m/%Y')
ORDER BY protesto.id_protesto DESC", $conn) or die(mysql_error());		
}
else if($condicion == '3')
{
$consulta = mysql_query("SELECT protesto.id_protesto,protesto.solicitante,protesto.num_protesto,protesto.numero ,DATE_FORMAT(protesto.fec_ingreso,'%d/%m/%Y') AS 'fec_ingreso2' 
,DATE_FORMAT(protesto.fec_notificacion,'%d/%m/%Y') AS 'fec_notificacion2',
DATE_FORMAT(protesto.fec_constancia,'%d/%m/%Y') AS 'fec_constancia2',monedas.desmon,protesto.importe
FROM protesto
LEFT OUTER JOIN monedas ON monedas.idmon = protesto.moneda
WHERE protesto.fec_ingreso BETWEEN STR_TO_DATE('$fechade','%d/%m/%Y') AND STR_TO_DATE('$fechaa','%d/%m/%Y')
ORDER BY protesto.id_protesto DESC", $conn) or die(mysql_error());		
}


while($rowkar = mysql_fetch_array($consulta)){
	
$numkar = $rowkar['num_protesto'];
$numkar2 = substr($numkar,5,6).'-'.substr($numkar,0,4);

$feci = $rowkar['fec_ingreso2'];
$fecn = $rowkar['fec_notificacion2'];
$solicitante = strtoupper($rowkar['solicitante']);

echo"<TABLE BORDER='1' CELLPADDING='0' CELLSPACING='0' ALIGN='CENTER'>
  <TR>
    <TD WIDTH='30'  HEIGHT='19' >".$rowkar['id_protesto']."</TD>
    <TD WIDTH='60'  valign='top'>".$numkar2."</TD>
	<td width='60' valign='top'><span class='Estilo12'>".$feci."</span></td>
	<td width='60' valign='top'><span class='Estilo12'>".$fecn."</span></td>
	<td width='150' valign='top'><span class='Estilo12'>".$solicitante."</span></td>
    <TD WIDTH='150'  valign='top'>";
	$consulcont = mysql_query("SELECT * FROM protesto_participantes WHERE protesto_participantes.id_protesto='".$rowkar['id_protesto']."'", $conn) or die(mysql_error());
	while($rowcont = mysql_fetch_array($consulcont)){
		$cantidadc=$rowcont['tip_condi'];
		
	switch ($cantidadc) {
	case "001":
	$ncliente="ACREEDOR";
	break;
	case "002":
	$ncliente="DEUDOR";	
	break;
	case "003":
	$ncliente="AVAL";
	break;
	}

	echo  $ncliente.": ".$rowcont['descri_parti']."<br>";
	}
	echo"</TD>
	<td width='60' valign='top'><span class='Estilo12'>".$rowkar['fec_constancia2']."</span></td>
  	<td width='60' valign='top'><span class='Estilo12'>".$rowkar['desmon']."</span></td>
	<td width='60' valign='top'><span class='Estilo12'>".$rowkar['importe']."</span></td>
  </TR>
</TABLE>";
}
?>
</body>
</html>