<?php
require_once('class.ezpdf.php');


include('conexion.php');

/*$fechade=$_POST['fechade'];
$tiempo = explode ("/", $fechade);
$desde = $tiempo[2] . "-" . $tiempo[1] . "-" . $tiempo[0];

$fechaa=$_POST['fechaa'];
$tiempo2 = explode ("/", $fechaa);
$hasta = $tiempo2[2] . "-" . $tiempo2[1] . "-" . $tiempo2[0];*/

$fechade="12/11/2012";
$tiempo = explode ("/", $fechade);
$desde = $tiempo[2] . "-" . $tiempo[1] . "-" . $tiempo[0];

$fechaa="12/11/2013";
$tiempo2 = explode ("/", $fechaa);
$hasta = $tiempo2[2] . "-" . $tiempo2[1] . "-" . $tiempo2[0];

$consulta = mysql_query("SELECT * FROM kardex WHERE idtipkar='1' AND (fechaescritura BETWEEN '$desde' AND '$hasta') order by fechaescritura asc", $conn) or die(mysql_error());

$pdf =& new Cezpdf('a4');
$pdf->selectFont('../fonts/courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
//$pdf->ezImage("img.jpg", 0, 169, 'none', 'left');
$pdf->ezText("<b>REPORTE DE INDICE CRONOLOGICO DE ESCRITURAS PUBLICAS</b>\n",15);
$pdf->ezText("Desde: ".$desde."\n",15);
$pdf->ezText("Hasta: ".$hasta."\n",15);

$pdf->ezText("----------------------------------------------------------------------------",10);
$txttit= " \n";
while($row = mysql_fetch_array($consulta)){

echo"$txttit.='<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#E5E5E5'>
  <tr>
    <td width='70' height='19' valign='top'><span class='Estilo12'>"; $time=explode("-",$row['fechaescritura']); echo $time[2] . "/" . $time[1] . "/" . $time[0];
	 echo"</span></td>
    <td width='50' valign='top'><span class='Estilo12'>".$row['kardex']."</span></td>
    <td width='275' valign='top'><span class='Estilo12'>"; 
	$kardex=$row['kardex'];
	$consultr = mysql_query("SELECT * FROM contratantes WHERE kardex='$kardex' and indice='1'", $conn) or die(mysql_error());
	while($row2 = mysql_fetch_array($consultr)){
	  $contratante=$row2['idcontratante'];
	  $consultrr = mysql_query("SELECT * FROM cliente2 WHERE idcontratante='$contratante' order by idcontratante asc", $conn) or die(mysql_error());
	  while($row3 = mysql_fetch_array($consultrr)){
	   if($row3['tipper']=="N") { echo $row3['apepat']." ".$row3['apemat'].", ".$row3['prinom']." ".$row3['segnom']."<br>";  }else {  echo $row3['razonsocial']."<br>"; }
	
	  }
	}
	echo"</span></td>
    <td width='171' valign='top'><span class='Estilo12'>".$row['contrato']."</span></td>
    <td width='93' valign='top'><span class='Estilo12'>".$row['numescritura']."</span></td>
    <td width='86' valign='top'><span class='Estilo12'>".$row['numminuta']."</span></td>
    <td width='89' valign='top'><span class='Estilo12'>".$row['folioini']."</span></td>
  </tr>
</table>'";
}

$pdf->ezText($txttit, 12);
$pdf->ezTable($data, $titles, '', $options);
$pdf->ezText("\n\n\n", 10);
$pdf->ezStream();
?>