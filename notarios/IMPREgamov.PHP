
<?php
$fechade = $_REQUEST['fecini'];
$fechaa  = $_REQUEST['fecfin'];
//$nomnotaria = "Nombre de la Notaria";
$nomnotaria = " ";
//$fechade = '01/01/2013';
//$fechaa = '31/01/2013';
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        
        	<title>.::Indice Cronologico de Garantias Mobiliarias::.</title>
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
     <strong>INDICE CRONOLOGICO DE GARANTIAS MOBILIARIAS</strong></p>
<p align="center"><strong>Listado del <?php echo $fechade ?> al <?php echo $fechaa ?></strong></p>

<TABLE  BORDER=1 CELLSPACING=0 CELLPADDING=0 align="center">
            
       <TR><TD width="70" height="19">Fecha Escr</TD><TD width="50">Kardex</TD><TD width="275">Contratantes</TD><TD width="171">Acto</TD><TD width="93">&nbsp; Escritura</TD><TD width="86">&nbsp; Minuta</TD><TD width="89">&nbsp; Folio</TD></TR>
</TABLE>
<?php 
include('conexion.php');

$fechade = $_REQUEST['fecini'];
$tiempo  = explode ("/", $fechade);
$desde   = $tiempo[2] . "-" . $tiempo[1] . "-" . $tiempo[0];

$fechaa  = $_REQUEST['fecfin'];
$tiempo2 = explode ("/", $fechaa);
$hasta   = $tiempo2[2] . "-" . $tiempo2[1] . "-" . $tiempo2[0];

$consulta = mysql_query("SELECT * FROM kardex WHERE idtipkar='4' AND (fechaescritura BETWEEN DATE_FORMAT(STR_TO_DATE('$fechade','%d/%m/%Y'),'%Y-%m-%d') AND DATE_FORMAT(STR_TO_DATE('$fechaa','%d/%m/%Y'),'%Y-%m-%d') ) ORDER BY fechaescritura ASC", $conn) or die(mysql_error());

while($row = mysql_fetch_array($consulta)){

echo"<TABLE  BORDER=0 CELLSPACING=1 CELLPADDING=1 align='center'>
  			<TR><TD width='70' height='19' valign='top'>"; $time=explode("-",$row['fechaescritura']); echo $time[2] . "/" . $time[1] . "/" . $time[0]; 
	 echo"</TD>
    <TD width='50' valign='top'>".$row['kardex']."</TD>
    <TD width='275' valign='top'>"; 
	$kardex=$row['kardex'];
	$consultr = mysql_query("SELECT * FROM contratantes WHERE kardex='$kardex' and indice='1'", $conn) or die(mysql_error());
	while($row2 = mysql_fetch_array($consultr)){
	  $contratante=$row2['idcontratante'];
	  $consultrr = mysql_query("SELECT * FROM cliente2 WHERE idcontratante='$contratante' order by idcontratante asc", $conn) or die(mysql_error());
	  while($row3 = mysql_fetch_array($consultrr)){
	   if($row3['tipper']=="N") { 
	   $nom=$row3['apepat']." ".$row3['apemat'].", ".$row3['prinom']." ".$row3['segnom'];
	$textormat=str_replace("?","'",$nom);
    $textoampermat=str_replace("*","&",$textormat);
	echo strtoupper($textoampermat);
	
	   echo "<br>";  }
	   else {  
	   $textormatx=str_replace("?","'",$row3['razonsocial']);
    $textoampermatx=str_replace("*","&",$textormatx);
	echo strtoupper($textoampermatx);
	   echo "<br>"; }
	
	  }
	}
	echo"</td>
    <TD width='171' valign='top'>".$row['contrato']."</TD>
    <TD width='93' valign='top'>".$row['numescritura']."</TD>
    <TD width='86' valign='top'>".$row['numminuta']."</TD>
    <TD width='89' valign='top'>".$row['folioini']."</TD>
  </TR>
</TABLE>";
}
?>
</body>
</html>