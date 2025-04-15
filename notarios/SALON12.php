<?php
$fechade = $_REQUEST['fecini'];
$fechaa  = $_REQUEST['fecfin'];
//$nomnotaria = "Nombre de la Notaria";
//$fechade = '01/01/2013';
//$fechaa = '31/01/2013';
?>
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
        

<?php 
include('conexion.php');

//$fechade=$_REQUEST['fecini'];
$fechade = $_REQUEST['fecini'];

$tiempo = explode ("/", $fechade);
$desde = $tiempo[2] . "-" . $tiempo[1] . "-" . $tiempo[0];

//$fechaa = $_REQUEST['fecfin'];
$fechaa = $_REQUEST['fecfin'];

$tiempo2 = explode ("/", $fechaa);
$hasta = $tiempo2[2] . "-" . $tiempo2[1] . "-" . $tiempo2[0];

$consulta = mysql_query("SELECT * FROM kardex WHERE idtipkar='1' AND (fechaescritura BETWEEN DATE_FORMAT(STR_TO_DATE('$fechade','%d/%m/%Y'),'%Y-%m-%d') AND DATE_FORMAT(STR_TO_DATE('$fechaa','%d/%m/%Y'),'%Y-%m-%d') ) ORDER BY fechaescritura,numescritura ASC", $conn) or die(mysql_error());

/*echo"<TABLE  BORDER=1 CELLSPACING=0 CELLPADDING=0 align='center'>
            
       <TR><TD width='70' height='19'>Fecha Escr</TD><TD width='50'>Kardex</TD><TD width='275'>Contratantes</TD><TD width='171'>Acto</TD><TD width='93'>&nbsp; Instrumento</TD><TD width='86'>&nbsp; Minuta</TD><TD width='89'>&nbsp; Folio</TD></TR>
</TABLE>";
*/
echo"<table width='850' bordercolor='#333333'  BORDER=1 align='center' CELLPADDING=0 CELLSPACING=0 >";

while($row = mysql_fetch_array($consulta)){

echo"
			<TR>	
			<TD width='77'  align='center' height='19' valign='top'><span style='font-size:11px;'>"; $time=explode("-",$row['fechaescritura']); echo $time[2] . "/" . $time[1] . "/" . $time[0]; 
	 echo"</span></TD>
    <TD width='70' align='center' valign='top'><span style='font-size:11px;'>".$row['kardex']."</span></TD>
    <TD width='280' align='center' valign='top'><span style='font-size:11px;'>"; 
	$kardex=$row['kardex'];
	$consultr = mysql_query("SELECT * FROM contratantes WHERE kardex='$kardex' and indice='1'", $conn) or die(mysql_error());
	while($row2 = mysql_fetch_array($consultr)){
	  $contratante=$row2['idcontratante'];
	  $consultrr = mysql_query("SELECT * FROM cliente2 WHERE idcontratante='$contratante' order by idcontratante asc", $conn) or die(mysql_error());
	  while($row3 = mysql_fetch_array($consultrr)){
	   if($row3['tipper']=="N") { 
	   $nom = $row3['apepat']." ".$row3['apemat'].", ".$row3['prinom']." ".$row3['segnom']."<br>";  
	   $textormat=str_replace("?","'",$nom);
    $textoampermat=str_replace("*","&",$textormat);
	echo strtoupper($textoampermat);
	   }else {
		   	$textormat4=str_replace("?","'",$row3['razonsocial']);
    $textoampermat4=str_replace("*","&",$textormat4);
	echo strtoupper($textoampermat4);  
	   echo "<br>"; }
	  }
	}
	echo"</span></td>
    <TD width='224' align='center' valign='top'><span style='font-size:11px;'>".$row['contrato']."</span></TD>
    <TD width='79'  align='center' valign='top'><span style='font-size:11px;'>".$row['numescritura']."</span></TD>
    <TD width='53'  align='center' valign='top'><span style='font-size:11px;'>".$row['numminuta']."</span></TD>
    <TD width='51' align='center' valign='top'><span style='font-size:11px;'>".$row['folioini']."</span></TD>
  </TR>
";
}
echo"</TABLE>";
?>
