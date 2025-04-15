<?php
$fechade = $_REQUEST['fecini'];
$fechaa  = $_REQUEST['fecfin'];
?>

<?php 
echo '<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm">
 		<page_footer>		
		<table width="200" border="0" cellspacing="0" align="center"  cellpadding="0">
		  <tr>
			<td height="45">Pagina : [[page_cu]]/[[page_nb]]</td>
		  </tr>
		</table>       
        </page_footer>
		</page>
		';

?>
   <style type="text/css">
	.fuente_crono {
	 font-size: 12px;
	 font-weight: bold;
	 }
    </style>

<p align="center">  <br><br>
     <strong>INDICE CRONOLOGICO DE ASUNTOS NO CONTENCIOSOS</strong></p>
<p align="center"><strong>Listado del <?php echo $fechade ?> al <?php echo $fechaa ?></strong></p>

<TABLE width="850"  BORDER=1 align="center" CELLPADDING=0 CELLSPACING=0>
            
       <TR class="fuente_crono">
         <TD width="78" height="39" align="center">Fecha<br> Instrumento</TD><TD width="49" align="center">Kardex</TD><TD width="273" align="center">Contratantes</TD><TD width="246" align="center">Acto</TD>
       <TD width="81" align="center">&nbsp; Instrumento</TD>
       <TD width="56" align="center"> Minuta</TD><TD width="51" align="center">&nbsp; Folio</TD></TR>
</TABLE>
<?php 
include('conexion.php');

//$fechade=$_REQUEST['fecini'];
$fechade = $_REQUEST['fecini'];

$tiempo = explode ("/", $fechade);
$desde  = $tiempo[2] . "-" . $tiempo[1] . "-" . $tiempo[0];

//$fechaa = $_REQUEST['fecfin'];
$fechaa = $_REQUEST['fecfin'];

$tiempo2 = explode ("/", $fechaa);
$hasta = $tiempo2[2] . "-" . $tiempo2[1] . "-" . $tiempo2[0];

$consulta = mysql_query("SELECT kardex.*, IF((kardex.contrato LIKE '%SUCESION INTESTADA%'),'S/M', kardex.numminuta) AS 'numminuta_sucesion' FROM kardex
WHERE idtipkar='2' AND (fechaescritura BETWEEN DATE_FORMAT(STR_TO_DATE('$fechade','%d/%m/%Y'),'%Y-%m-%d') AND DATE_FORMAT(STR_TO_DATE('$fechaa','%d/%m/%Y'),'%Y-%m-%d') ) 
ORDER BY fechaescritura ASC", $conn) or die(mysql_error());

echo"<TABLE bordercolor='#333333' width='850'  BORDER=1 CELLSPACING=0 CELLPADDING=0 align='center'>";

while($row = mysql_fetch_array($consulta)){

echo"<TR><TD width='78' height='19' valign='top'><span style='font-size:11px;'>"; $time=explode("-",$row['fechaescritura']); echo $time[2] . "/" . $time[1] . "/" . $time[0]; 
	 echo"</span></TD>
    <TD width='49' valign='top'><span style='font-size:11px;'>".$row['kardex']."</span></TD>
    <TD width='273' valign='top'><span style='font-size:11px;'>"; 
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
    <TD width='246' valign='top'><span style='font-size:11px;'>".$row['contrato']."</span></TD>
    <TD width='81' valign='top'><span style='font-size:11px;'>".$row['numescritura']."</span></TD>
    <TD width='56' valign='top'><span style='font-size:11px;'>".$row['numminuta_sucesion']."</span></TD>
    <TD width='51' valign='top'><span style='font-size:11px;'>".$row['folioini']."</span></TD>
  </TR>
";
}
echo "</TABLE>";
?>
