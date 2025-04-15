<?php

$fechade = $_POST['fechade'];
$fecha=explode("/",$fechade);
$desde=$fecha[2]."-".$fecha[1]."-".$fecha[0];

$fechaa  = $_POST['fechaa'];
$fecha2=explode("/",$fechaa);
$hasta=$fecha2[2]."-".$fecha2[1]."-".$fecha2[0];

$fec_not = $_POST['fec_not'];
$fec_cons = $_POST['fec_cons'];
$fec_ing = $_POST['fec_ing'];

if($_POST["fechade"]!="" or $_POST["fechaa"]!="") {
	
include("../extraprotocolares/view/funciones.php");	
include("../conexion.php");


//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Reporte_camara.xls");


if($fec_not==true){						
		$consulta_camara = "SELECT
						protesto.id_protesto AS id_protesto,
						protesto.fec_notificacion AS fec_notificacion,
						protesto.fec_constancia AS fec_constancia,
						protesto.fec_ingreso AS fec_ingreso,
						tipo_protesto.des_tipop AS tip_prot,
						protesto.importe AS importe,
						protesto.solicitante AS solicitante,
						protesto_participantes.descri_parti AS participante,
						protesto_participantes.num_docparti AS dni,
						protesto_participantes.direccion AS direccion
						FROM protesto
						LEFT OUTER JOIN monedas ON monedas.idmon = protesto.moneda
						LEFT OUTER JOIN tipo_protesto ON tipo_protesto.cod_tipop = protesto.tipo
						LEFT OUTER JOIN protesto_participantes ON protesto_participantes.id_protesto = protesto.id_protesto where STR_TO_DATE(protesto.fec_notificacion,'%Y-%m-%d') >= STR_TO_DATE('".$desde."','%Y-%m-%d') AND STR_TO_DATE(protesto.fec_notificacion,'%Y-%m-%d') <= STR_TO_DATE('".$hasta."','%Y-%m-%d')";
	}
	
	if($fec_cons==true){						
		$consulta_camara = "SELECT
						protesto.id_protesto AS id_protesto,
						protesto.fec_notificacion AS fec_notificacion,
						protesto.fec_constancia AS fec_constancia,
						protesto.fec_ingreso AS fec_ingreso,
						tipo_protesto.des_tipop AS tip_prot,
						protesto.importe AS importe,
						protesto.solicitante AS solicitante,
						protesto_participantes.descri_parti AS participante,
						protesto_participantes.num_docparti AS dni,
						protesto_participantes.direccion AS direccion
						FROM protesto
						LEFT OUTER JOIN monedas ON monedas.idmon = protesto.moneda
						LEFT OUTER JOIN tipo_protesto ON tipo_protesto.cod_tipop = protesto.tipo
						LEFT OUTER JOIN protesto_participantes ON protesto_participantes.id_protesto = protesto.id_protesto where STR_TO_DATE(protesto.fec_constancia,'%Y-%m-%d') >= STR_TO_DATE('".$desde."','%Y-%m-%d') AND STR_TO_DATE(protesto.fec_constancia,'%Y-%m-%d') <= STR_TO_DATE('".$hasta."','%Y-%m-%d')";
	}
	if($fec_ing==true){						
		$consulta_camara = "SELECT
						protesto.id_protesto AS id_protesto,
						protesto.fec_notificacion AS fec_notificacion,
						protesto.fec_constancia AS fec_constancia,
						protesto.fec_ingreso AS fec_ingreso,
						protesto.fec_ingreso AS fec_ingreso,
						tipo_protesto.des_tipop AS tip_prot,
						protesto.importe AS importe,
						protesto.solicitante AS solicitante,
						protesto_participantes.descri_parti AS participante,
						protesto_participantes.num_docparti AS dni,
						protesto_participantes.direccion AS direccion
						FROM protesto
						LEFT OUTER JOIN monedas ON monedas.idmon = protesto.moneda
						LEFT OUTER JOIN tipo_protesto ON tipo_protesto.cod_tipop = protesto.tipo
						LEFT OUTER JOIN protesto_participantes ON protesto_participantes.id_protesto = protesto.id_protesto where STR_TO_DATE(protesto.fec_ingreso,'%Y-%m-%d') >= STR_TO_DATE('".$desde."','%Y-%m-%d') AND STR_TO_DATE(protesto.fec_ingreso,'%Y-%m-%d') <= STR_TO_DATE('".$hasta."','%Y-%m-%d')";
	}
	
	
       $consulta_camara = $consulta_camara." ORDER BY protesto.id_protesto DESC";
	   
	   $datos_camara = mysql_query($consulta_camara, $conn);
	   
	   
$confinotario=mysql_query("SELECT nombre,apellido FROM confinotario",$conn);
$resnotario=mysql_fetch_assoc($confinotario);
$nombrenotario=$resnotario['nombre']." ".$resnotario['apellido'];							
$paginador=2;					   
?>
<HTML LANG="es">
<TITLE>::. Exportacion de Datos .::</TITLE>
</head>
<body>


<table width="1250" bordercolor="#333333"  BORDER="1" align="center" CELLPADDING="0" CELLSPACING="0">
<th align="center" height="50" valign="middle" bgcolor="#254061" style="color:#FFF; font-size:11px">
		<?php 
		echo "1";
		?>
<th width='35%' colspan="9" align="center" height="50" valign="middle" bgcolor="#254061" style="color:#FFF; font-size:11px"><span><font size="+3">REPORTE DE INDICES CRONOLOGICOS CAMARA DEL COMERCIO</font></span></th><tr>
<th width='35%' colspan="10" align="center" height="50" valign="middle" bgcolor="#254061" style="color:#FFF; font-size:11px"><span><font size="+2"><?php echo "del $desde al $hasta"; ?></font></span></th></tr>
<tr class="titulos">
              <td width='23' height='19' align="center"><span class='Estilo14'>CP</span></td>
              <td width='58' align="center"><span class='Estilo14'>Fec. Not.</span></td>
              <td width='60' align="center"><span class='Estilo14'>Fec. Prot</span></td>
               <td width='60' align="center"><span class='Estilo14'>Fec. Ingreso</span></td>
              <td width='100' align="center"><span class='Estilo14'>TIT Val</span></td>
              <td width='65' align="center"><span class='Estilo14'>Monto</span></td>
              <td width='173' align="center"><span class='Estilo14'>Solicitante</span></td>
              <td width='173' align="center"><span class='Estilo14'>Aceptante/Aval</span></td>
              <td width='58' align="center"><span class='Estilo14'>Ruc/DNI</span></td>
              <td width='150' align="center"><span class='Estilo14'>Direcci&oacute;n Obligado o Aval</span></td>
            </tr>

<?php

	$x=0;
	while($camara = mysql_fetch_assoc($datos_camara)){ 

	echo "<tr>
			<td width='40' valign='top' align='center'><span class='Estilo12'>".$camara['id_protesto']."</span></td>
			<td width='80' valign='top' align='center'><span class='Estilo12'>".fechabd_an($camara['fec_notificacion'])."</span></td>
			<td width='80' valign='top' align='center'><span class='Estilo12'>".fechabd_an($camara['fec_constancia'])."</span></td>
			<td width='80' valign='top' align='center'><span class='Estilo12'>".fechabd_an($camara['fec_ingreso'])."</span></td>
			<td width='200' valign='top' align='center'><span class='Estilo12'>".$camara['tip_prot']."</span></td>
			<td width='80' valign='top' align='center'><span class='Estilo12'>".$camara['importe']."</span></td>
			<td width='250' valign='top' align='center'><span class='Estilo12'>".strtoupper($camara['solicitante'])."</span></td>
			<td width='250' valign='top' align='center'><span class='Estilo12'>".$camara['participante']."</span></td>
			<td width='90' valign='top' align='center'><span class='Estilo12'>".$camara['dni']."</span></td>
			<td width='180' valign='top' align='center'><span class='Estilo12'>".$camara['direccion']."</span></td>
 	</tr>";
	
	if(25==$x)
    {
		
        include ('TablaGara.php');
        $x = 0;
		$paginador++;
    }
    
    $x++;
   }

?>

</table>
</body>
</html>

<?php
}else{
	echo "<script>window.location='../indicecronocamara.php'</script>";	
}