<?php 
include('../conexion.php');

$fechade = $_POST['fechade'];
$fecha=explode("/",$fechade);
$desde=$fecha[2]."-".$fecha[1]."-".$fecha[0];

$fechaa  = $_POST['fechaa'];
$fecha2=explode("/",$fechaa);
$hasta=$fecha2[2]."-".$fecha2[1]."-".$fecha2[0];

$tipokar = $_POST['tipokar'];

if($tipokar=='')
{
	$consulta = mysql_query("SELECT kardex.kardex, kardex.idtipkar, kardex.contrato, DATE_FORMAT(kardex.fechaescritura,'%d/%m/%Y') AS fec_escritura, kardex.numescritura
FROM kardex WHERE kardex.fechaescritura<>'' AND kardex.fechaconclusion='' AND (kardex.fechaescritura BETWEEN '$desde' AND '$hasta') ORDER BY kardex.kardex DESC", $conn) or die(mysql_error());
}
	else
	{
		$consulta = mysql_query("SELECT kardex.kardex, kardex.idtipkar, kardex.contrato, DATE_FORMAT(kardex.fechaescritura,'%d/%m/%Y') AS fec_escritura, kardex.numescritura
FROM kardex WHERE kardex.fechaescritura<>'' AND kardex.fechaconclusion='' and kardex.idtipkar='$tipokar' AND (kardex.fechaescritura BETWEEN '$desde' AND '$hasta') ORDER BY kardex.kardex DESC", $conn) or die(mysql_error());
			
	}
while($row = mysql_fetch_array($consulta)){

echo"<table width='834' border='1' cellpadding='0' cellspacing='0' >
  <tr>
    <td width='100' valign='top'><span class='Estilo12'>";
	if($row['idtipkar']=='1'){ echo "Escrituras Publicas"; 	}
	if($row['idtipkar']=='2'){ echo "No Contenciosos"; 	}
	if($row['idtipkar']=='3'){ echo "Tranferencias Vehiculares"; 	}
	if($row['idtipkar']=='4'){ echo "Garantias Moviliarias"; 	}
	if($row['idtipkar']=='5'){ echo "Testamentos"; 	}
	 echo"</span></td>
	<td width='50' valign='top'><span class='Estilo12'>".$row['kardex']."</span></td>
    <td width='70' height='19' valign='top'><span class='Estilo12'>". $row['fec_escritura']."</span></td>
	  <td width='93' valign='top'><span class='Estilo12'>".$row['numescritura']."</span></td>
	  <td width='171' valign='top'><span class='Estilo12'>".$row['contrato']."</span></td>
    <td width='275' valign='top'><span class='Estilo12'>"; 
	$kardex=$row['kardex'];
	$consultr = mysql_query("SELECT * FROM contratantes WHERE kardex='$kardex' and indice='1'", $conn) or die(mysql_error());
	while($row2 = mysql_fetch_array($consultr)){
	  $contratante=$row2['idcontratante'];
	  $fechachirma=$row2['fechafirma'];
	  $sifirma=$row2['firma'];
	  if($sifirma=="1"){if($fechachirma==""){$variable="Falta Fimar";} else{$variable="Si Firmo";}}else{$variable="No Firma";}
	 	  $consultrr = mysql_query("SELECT * FROM cliente2 WHERE idcontratante='$contratante' order by idcontratante asc", $conn) or die(mysql_error());
	  while($row3 = mysql_fetch_array($consultrr)){
	   if($row3['tipper']=="N") { echo $row3['apepat']." ".$row3['apemat'].", ".$row3['prinom']." ".$row3['segnom']." - ".$variable."<br>";  }else {  echo str_replace("*","&",str_replace("?","'",$row3['razonsocial']))." - ".$variable."<br>"; }
	
	  }
	}
	echo"</span></td>
  </tr>
</table>";
}

?>