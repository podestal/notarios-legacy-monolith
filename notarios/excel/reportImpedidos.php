
<?php 

include('../conexion.php');

include('../extraprotocolares/view/funciones.php');
mysql_query("SET NAMES utf8");
	$conexion = Conectar();
if($_POST['fechade']!="" && $_POST['fechaa']!="") {	

	$fechade = $_REQUEST['fechade'];
	$fechaa  = $_REQUEST['fechaa'];
	
	$desde = fechan_abd($fechade);
	$hasta = fechan_abd($fechaa); 
	
		
	$desde = fechabd_an($desde);
	$hasta = fechabd_an($hasta); 


//Exportar datos de php a Excel
header("Content-Description: File Transfer");  
header("Content-Type: application/force-download"); 
header("Content-Disposition: attachment; filename=REP_IMPE.doc");

	$ejecutar = mysql_query("SELECT DISTINCT impedidos.idimpedido AS 'id',impedidos.fechaing,
impedidos.origen AS 'entidad',impedidos.motivo AS 'motivo' FROM impedidos 
WHERE  STR_TO_DATE(impedidos.fechaing,'%d/%m/%Y') >= STR_TO_DATE('$desde','%d/%m/%Y') 
AND STR_TO_DATE(impedidos.fechaing,'%d/%m/%Y') <= STR_TO_DATE('$hasta','%d/%m/%Y')", $conn);

$confinotario=mysql_query("SELECT nombre,apellido FROM confinotario",$conn);
$resnotario=mysql_fetch_assoc($confinotario);
$nombrenotario=$resnotario['nombre']." ".$resnotario['apellido'];
?>
<HTML LANG="es">
<TITLE>::. Exportacion de Datos .::</TITLE>
<style>
.Estilo12{
   font-size: 9px;
}
</style>
</head><body>

<table width='700' border='0' cellpadding='0' cellspacing='0'>
<tr>
	<td colspan="2" align="left"><b><span><font size="-1">Notaria </font></span><font size="-1"><?php echo $nombrenotario;?></font></b></td>
</tr>
<tr>
	<td align="left" width="300"><b><span><font size="-3">REPORTES DE CLIENTE IMPEDIDOS</font></span></b></td>
    <td align="center" width="300"><b><span><?php echo "del ".fechabd_an($desde)." al ".fechabd_an($hasta); ?></span></b></td>
</tr>
</table>

<table width="700" bordercolor="#333333"  BORDER="0" align="center">      

<tr><td colspan="6"><hr/></td>
</tr> 
		
            
            <?php
			
			echo "<tr class='titulos'>
              
              <td width='50' bgcolor='' align='center' style='font-size:11px'><span class='Estilo14'>Nro </span></td>
              <td width='70' bgcolor='' align='center' style='font-size:11px'><span class='Estilo14'>Fec Ingreso</span></td>
              <td width='240' bgcolor='' align='center' style='font-size:11px'><span class='Estilo14'>Cliente</span></td>
           <td width='100' bgcolor='' align='right' style='font-size:11px'><span class='Estilo14'>Entidad</span></td>
              <td width='180' bgcolor='' align='center' style='font-size:11px'><span class='Estilo14'>Motivo</span></td> 
            </tr>";
			$i=0;
			while($escrituras = mysql_fetch_array($ejecutar)){

	$arr_escrituras[$i][0] = $escrituras["id"]; 
	$arr_escrituras[$i][1] = $escrituras["fechaing"]; 
	$arr_escrituras[$i][2] = $escrituras["entidad"]; 
	$arr_escrituras[$i][3] = $escrituras["motivo"]; 
	$i++; 
	  
}

			?>
            
            <tr><td colspan="6"><hr/></td>
</tr> 
</TABLE>            

<table width="700" bordercolor="#333333"  BORDER="0" align="center">  
<?php


for($j=0; $j<count($arr_escrituras); $j++) { 


		$id_kardex = $arr_escrituras[$j][0];

		$consulta_clientes = "SELECT deta_impe.`idimpedido`,CONCAT(cliente.prinom,' ',cliente.segnom,' ',cliente.apepat,' ',cliente.apemat,' ') AS   nombre,cliente.`razonsocial` AS empresa
FROM cliente
INNER JOIN deta_impe ON cliente.`idcliente` = `deta_impe`.`idcliente`
WHERE deta_impe.`idimpedido`= '".$id_kardex."'";

		$ejecuta_clientes= mysql_query($consulta_clientes, $conexion);

		echo "<tr>
				<td WIDTH='50' align='center' valign='top'><span class='Estilo12'>".($arr_escrituras[$j][0])."</span></td>
			    <td WIDTH='70' align='center' valign='top'><span class='Estilo12'>".$arr_escrituras[$j][1]."</span></td>
			    <td WIDTH='240' valign='top' cellpadding='0' cellspacing='0'>";
					
					while($clientes = mysql_fetch_array($ejecuta_clientes, MYSQL_ASSOC))
					{
						echo "<table><tr><td><span class='Estilo12'>&nbsp;&nbsp;&nbsp;&nbsp;".simbolos(strtoupper($clientes[nombre].$clientes[empresa]))."</span></td></tr></table>";	
						
					}

		echo   "</td>
				<td WIDTH='100' valign='top' align='center'><span class='Estilo12'>".strtoupper($arr_escrituras[$j][2])."</span></td>
			    <td WIDTH='180' valign='top'><span class='Estilo12'>".holaacentos(strtoupper($arr_escrituras[$j][3]))."</span></td>
			   
		 	  </tr>";


	}

?>
</table>
</body>
</html>
<?php
}else{
	echo "<script>window.location='../indicecroesrituras.php'</script>";	
}



