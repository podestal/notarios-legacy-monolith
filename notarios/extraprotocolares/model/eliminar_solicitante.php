
   <?php 
include("../../conexion.php");
$idSolicitante=$_POST['idSolicitante'];

$query = "DELETE FROM solicitanteLegalizacion WHERE idSolicitanteLocalizacion=$idSolicitante";
$result = mysql_query($query, $conn) or die(mysql_error());




// if($nombrer=='' and $nombred==''){
// $consulkar=mysql_query("SELECT * FROM ingreso_cartas WHERE RIGHT(num_carta,6) LIKE '%$lol%' ", $conn) or die(mysql_error());

// while($rowkar = mysql_fetch_array($consulkar)){
// $numcarta = $rowkar['num_carta'];
// $numcarta2 = substr($numcarta,5,6).'-'.substr($numcarta,0,4);

// echo "<table width='858' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
//   <tr>
  
 
   
//     <td width='63' align='center' ><span class='reskar'><a href='EditCartasVie.php?numcarta=".$rowkar['num_carta']."'>".$numcarta2."</a></span></td>
// 	<td width='86' align='center' ><span class='reskar'>".$rowkar['fec_ingreso']."</span></td>
// 	<td width='200' align='center' ><span class='reskar'>"; 
// 	$sqlss=mysql_query("Select * from cliente where numdoc='".$rowkar['id_remitente']."'", $conn) or die(mysql_error());
// 	$rowss=mysql_fetch_array($sqlss);
// 	echo $rowss['nombre'];
// 	echo"</span></td>
//     <td width='224' align='center'><span class='reskar'>".$rowkar['nom_destinatario']."</span></td>
//   </tr>
// </table>";
// }
// }
// else if($lol=='' and $nombred==''){
// 	$consulkar=mysql_query("
// 	SELECT cliente.nombre,ingreso_cartas.*
// 	FROM ingreso_cartas
// 	INNER JOIN cliente ON cliente.numdoc=ingreso_cartas.id_remitente
// 	WHERE cliente.nombre LIKE '%$nombrer%'
// 	ORDER BY ingreso_cartas.num_carta DESC");
	
// while($rowkar = mysql_fetch_array($consulkar)){
// $numcarta = $rowkar['num_carta'];
// $numcarta2 = substr($numcarta,5,6).'-'.substr($numcarta,0,4);

// echo "<table width='850' border='1' bordercolor='#333333' >
//   <tr>
  
   
//     <td width='63' align='center' ><span class='reskar'><a href='EditCartasVie.php?numcarta=".$rowkar['num_carta']."'>".$numcarta2."</a></span></td>
// 	<td width='86' align='center' ><span class='reskar'>".$rowkar['fec_ingreso']."</span></td>
// 	<td width='200' align='center' ><span class='reskar'>"; 
// 	$sqlss=mysql_query("Select * from cliente where numdoc='".$rowkar['id_remitente']."'", $conn) or die(mysql_error());
// 	$rowss=mysql_fetch_array($sqlss);
// 	echo $rowss['nombre'];
// 	echo"</span></td>
//     <td width='224' align='center'><span class='reskar'>".$rowkar['nom_destinatario']."</span></td>
//   </tr>
// </table>";
// }
// 	}
// else if($lol=='' and $nombrer==''){
// 	$consulkar=mysql_query("SELECT * FROM ingreso_cartas WHERE nom_destinatario LIKE '%$nombred%'");
	
// while($rowkar = mysql_fetch_array($consulkar)){
// $numcarta = $rowkar['num_carta'];
// $numcarta2 = substr($numcarta,5,6).'-'.substr($numcarta,0,4);

// echo "<table width='850' border='1' bordercolor='#333333' >
//   <tr>
  
   
//     <td width='63' align='center' ><span class='reskar'><a href='EditCartasVie.php?numcarta=".$rowkar['num_carta']."'>".$numcarta2."</a></span></td>
// 	<td width='86' align='center' ><span class='reskar'>".$rowkar['fec_ingreso']."</span></td>
// 	<td width='200' align='center' ><span class='reskar'>"; 
// 	$sqlss=mysql_query("Select * from cliente where numdoc='".$rowkar['id_remitente']."'", $conn) or die(mysql_error());
// 	$rowss=mysql_fetch_array($sqlss);
// 	echo $rowss['nombre'];
// 	echo"</span></td>
//     <td width='224' align='center'><span class='reskar'>".$rowkar['nom_destinatario']."</span></td>
//   </tr>
// </table>";
// 	}
// }
?>

