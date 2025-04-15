
<?php 

include('../../conexion.php');
include('../../extraprotocolares/view/funciones.php');


	$fechade = $_REQUEST['fechade'];
	$fechaa  = $_REQUEST['fechaa'];
	
	$desde = fechan_abd($fechade);
	$hasta = fechan_abd($fechaa); 

	$conexion = Conectar();
	
if($_POST['fechade']!="" or $_POST['fechaa']!="") {	

//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Reporte_ep.xls");	

	$ejecutar = mysql_query("SELECT 
							kardex.fechaescritura as fec_escritura, 
							kardex.kardex as kardex, 
							concat(cliente2.prinom,' ',cliente2.segnom,' ',cliente2.apepat,' ',cliente2.apemat) as cliente, 
							cliente2.razonsocial as empresa, 
							kardex.contrato as contrato, 
							kardex.numescritura as escritura, 
							kardex.numminuta as minuta, 
							kardex.folioini as folio 
							FROM kardex INNER JOIN contratantes ON contratantes.kardex = kardex.kardex 
							INNER JOIN cliente2 ON cliente2.idcontratante = contratantes.idcontratante WHERE kardex.idtipkar='5'
							AND STR_TO_DATE(kardex.fechaescritura,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
							AND STR_TO_DATE(kardex.fechaescritura,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')
							and nc=0
							ORDER BY kardex.idkardex DESC", $conexion);

$paginador=2;	

$confinotario=mysql_query("SELECT nombre,apellido FROM confinotario",$conn);
$resnotario=mysql_fetch_assoc($confinotario);
$nombrenotario=$resnotario['nombre']." ".$resnotario['apellido'];
?>
<HTML LANG="es">
<TITLE>::. Exportacion de Datos .::</TITLE>
</head><body>
<table width="1300" bordercolor="#333333"  BORDER="1" align="center" CELLPADDING="0" CELLSPACING="0">
<th align="center" height="50" valign="middle" bgcolor="#254061" style="color:#FFF; font-size:11px">
		<?php 
		echo "1";
		?>
        </th><th width='35%' colspan="6" align="center" height="50" valign="middle" bgcolor="#254061" style="color:#FFF; font-size:11px"><span><font size="+3">INDICE ALFABETICO DE TRANS. VEHICULARES</font></span></th>
         <tr><th colspan="7" align="center" height="50" valign="middle" bgcolor="#254061" style="color:#FFF; font-size:11px"><span><font size="+2"><?php echo "del $desde al $hasta"; ?></font></span></th></tr>
		<tr class="titulos">
              <td width='273' colspan="2" height='19' align="center"><span class='Estilo14'>Contratantes</span></td>
              <td width='68' align="center"><span class='Estilo14'>Fecha Escr.</span></td>
              <td width='75' align="center"><span class='Estilo14'>Kardex</span></td>
              <td width='262' align="center"><span class='Estilo14'>Acto</span></td>
              <td width='70' align="center"><span class='Estilo14'>Nro. Acta</span></td>
              <td width='72' align="center"><span class='Estilo14'>Nro Folio</span></td>
            </tr>

            
<?php
$x=0;
while($roww = mysql_fetch_array($ejecutar)){

echo "<tr>
			<td width='273' valign='top'><span class='Estilo12'>".strtoupper($roww['cliente'])."</span></td>
			<td width='68' valign='top'><span class='Estilo12'>".$roww['fec_escritura']."</span></td>
			<td width='75' valign='top'><span class='Estilo12'>".$roww['kardex']."</span></td>
			<td width='262' valign='top'><span class='Estilo12'>".strtoupper($roww['contrato'])."</span></td>
			<td width='70' valign='top'><span class='Estilo12'>".simbolos($roww['minuta'])."</span></td>
			<td width='72' valign='top'><span class='Estilo12'>".simbolos($roww['folio'])."</span></td>
			
 	</tr>";
	
	if(25==$x)
    {
		
        include ('tablaTestamentos.php');
        $x = 0;
		$paginador++;
    }
    
    $x++;
}

   
echo"</table>";

?>
</table>
</body>
</html>
<?php
}else{
	echo "<script>window.location='../indicecrotestamentosalfa.php'</script>";	
}



