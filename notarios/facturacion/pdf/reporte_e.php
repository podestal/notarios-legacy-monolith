
<?php 

//include('../../conexion.php');
include('../../extraprotocolares/view/funciones.php');
include("conexion.php");

	$fechade = $_REQUEST['fechade'];
	$fechaa  = $_REQUEST['fechaa'];
	$filtro  = $_REQUEST['filtro_e'];
	
	$desde = fechan_abd($fechade);
	$hasta = fechan_abd($fechaa); 

$conexion = conection();
//	$conexion = Conectar();

//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Reporte_ep.xls");	

	$sql_cuentas = "SELECT 
                    m_regventas.fecha AS fecha,
					tipocomprobante.descompro AS des_comp,
					m_regventas.serie AS serie,
					m_regventas.factura AS numdoc,
					IF(( SELECT COUNT(d_regventas.kardex) FROM d_regventas WHERE d_regventas.id_regventas=m_regventas.id_regventas)<>0,
                    ( SELECT MAX(d_regventas.kardex) FROM d_regventas WHERE d_regventas.id_regventas=m_regventas.id_regventas ),'') AS kardex,
					m_regventas.num_docu AS doic,
					m_regventas.concepto AS cliente,
					m_regventas.subtotal AS subtotal,
					m_regventas.impuesto AS impuesto,
					m_regventas.imp_total AS total,
                    m_regventas.tipopago					
FROM m_regventas 
INNER JOIN tipocomprobante ON  m_regventas.tipo_docu= tipocomprobante.idcompro
					where  STR_TO_DATE(m_regventas.fecha,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
					and STR_TO_DATE(m_regventas.fecha,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d') ";
	if($filtro<>0){
		if($filtro==1){$sql_cuentas =	$sql_cuentas." AND ( m_regventas.tipo_docu='02' or m_regventas.tipo_docu='01' ) ";}
		if($filtro==2){$sql_cuentas =	$sql_cuentas." AND m_regventas.tipo_docu='02'";}
		if($filtro==3){$sql_cuentas =	$sql_cuentas." AND m_regventas.tipo_docu='01'";}
		if($filtro==4){$sql_cuentas =	$sql_cuentas." AND m_regventas.tipo_docu='04'";}
	}
   $sql_cuentas =	$sql_cuentas." GROUP BY m_regventas.id_regventas ORDER BY m_regventas.fecha desc, m_regventas.tipo_docu asc, fn_onlynum(m_regventas.factura) desc ";
   $datos_cuentas2 = mysql_query($sql_cuentas, $conexion);	
			
$paginador=2;	

?>

<HTML LANG="es">
<TITLE>::. Exportacion de Datos .::</TITLE>
<style>
.cualquierotroestilo{
   font-size: 9px;
}
</style>

<style type="text/css">

.textosss
 {mso-style-parent:style0;
 mso-number-format:"\@";}
 
</style>

</head><body>
<table width="1300" bordercolor="#333333"  BORDER="1" align="center" CELLPADDING="0" CELLSPACING="0">

<th width='35%' colspan="11" align="center" height="40" valign="middle" style="font-size:11px"><span><font size="+3">REPORTE DE COMPROBANTES</font></span></th>
<tr class="titulos">
<th width='35%' colspan="6" align="center" height="25" valign="middle"style="font-size:11px"><span><font size="+2"><?php echo "del ".fechabd_an($desde)." al ".fechabd_an($hasta); ?></font></span></th>
<tr class="titulos">
 <th width='100'align="center" height="35" bgcolor="#254061" style="color:#FFF; font-size:11px" ><div style='height:auto;width:20px'><span cla5s='Estilo14'>Fecha</span></div></TH >
 <th width='70' align="center" height="35" bgcolor="#254061" style="color:#FFF; font-size:11px" ><div style='height:auto;width:20px'><span cla5s='Estilo14'>Tipo Documento.</span></div></TH >
 <th width='50' align="center" height="35" bgcolor="#254061" style="color:#FFF; font-size:11px" ><div style='height:auto;width:20px'><span cla5s='Estilo14'>Serie</span></div></TH >
 <th width='80' align="center" height="35" bgcolor="#254061" style="color:#FFF; font-size:11px" ><div style='height:auto;width:20px'><span cla5s='Estilo14'>N° Doc. Pago</span></div></TH >
 <th width='80' align="center" height="35" bgcolor="#254061" style="color:#FFF; font-size:11px" ><div style='height:auto;width:20px'><span cla5s='Estilo14'>Kardex</span></div></TH >
 <th width='100' align="center" height="35" bgcolor="#254061" style="color:#FFF; font-size:11px" ><div style='height:auto;width:20px'><span cla5s='Estilo14'>N° Doc. Cliente</span></div></TH >
 <th width='250' align="center" height="35" bgcolor="#254061" style="color:#FFF; font-size:11px" ><div style='height:auto;width:20px'><span cla5s='Estilo14'>Razon Social</span></div></TH >
 <th width='70' align="center" height="35" bgcolor="#254061" style="color:#FFF; font-size:11px" ><div style='height:auto;width:20px'><span cla5s='Estilo14'>Subtotal</span></div></TH >
 <th width='70' align="center" height="35" bgcolor="#254061" style="color:#FFF; font-size:11px" ><div style='height:auto;width:20px'><span cla5s='Estilo14'>Impuesto</span></div></TH >
 <th width='70' align="center" height="35" bgcolor="#254061" style="color:#FFF; font-size:11px" ><div style='height:auto;width:20px'><span cla5s='Estilo14'>Total Efectivo</span></div></TH >
 <th width='70' align="center" height="35" bgcolor="#254061" style="color:#FFF; font-size:11px" ><div style='height:auto;width:20px'><span cla5s='Estilo14'>Total credito</span></div></TH >
 </tr> 
<?php

while($roww = mysql_fetch_array($datos_cuentas2)){
	   $fechaconv=explode('-',$roww['fecha']);
	   $fechacomprobante=$fechaconv[2]."/".$fechaconv[1]."/".$fechaconv[0];
echo "<tr>
	<td width='100' align='center' valign='top' class='cualquierotroestilo'><div style='height:40px;width:20px'><span class='Estilo12'><font size='2'>".$fechacomprobante."</font></span></div></td>
	<td width='70' align='center' valign='top' class='cualquierotroestilo'><div style='height:40px;width:20px'><span class='Estilo12'><font size='2'>".strtoupper($roww['des_comp'])."</font></span></div></td>";
	
?>
    <td width="50" align="center"  valign="top"  class="textosss" ><div style="height:40px;width:20px"><span class="Estilo12"><font size="2"><?php echo  $roww['serie']; ?></font></span></div></td>
<?php
echo  "	
	<td width='80' align='center' valign='top' class='cualquierotroestilo'><div style='height:40px;width:20px'><span class='Estilo12'><font size='2'>".$roww['numdoc']."</font></span></div></td>
	<td width='80' align='center' valign='top' class='cualquierotroestilo'><div style='height:40px;width:20px'><span class='Estilo12'><font size='2'>".strtoupper($roww['kardex'])."</font></span></div></td>
	<td width='100' align='center' valign='top' class='cualquierotroestilo'><div style='height:40px;width:20px'><span class='Estilo12'><font size='2'>".$roww['doic']."</font></span></div></td>
	<td width='250' align='center' valign='top' class='cualquierotroestilo'><div style='height:40px;width:20px'><span class='Estilo12'><font size='2'>".utf8_decode(strtoupper($roww['cliente']))."</font></span></div></td>";
	

	
	
	if($roww['subtotal']=='' || $roww['subtotal']=='0' || $roww['subtotal']=='0.00'){
	$subtotal=  round($roww['total']/1.18,2);
	$igv=  $roww['total']-$subtotal;	
    }else{
	$subtotal= $roww['subtotal'];
	$igv=  $roww['impuesto'];		
	}
	
	
?>
	<td width="70" valign="top" class="cualquierotroestilo" style="mso-number-format:'0.00';"><div style="height:40px;width:20px"><span class="Estilo12"><font size="2"><?php echo $subtotal; ?></font></span></div></td>
	<td width="70" valign="top" class="cualquierotroestilo" style="mso-number-format:'0.00';"><div style="height:40px;width:20px"><span class="Estilo12"><font size="2"><?php echo $igv; ?></font></span></div></td>
<?php	
if ($roww['tipopago']=='1'){	
?>
    <td width="80" valign="top" class="cualquierotroestilo" style="mso-number-format:'0.00';"><div style="height:40px;width:20px"><span class="Estilo12"><font size="2"><?php echo $roww['total']; ?></font></span></div></td>
	<td width="80" valign="top" class="cualquierotroestilo" style="mso-number-format:'0.00';"><div style="height:40px;width:20px"><span class="Estilo12"><font size="2">0.00</font></span></div></td>
 	</tr>
<?php	
}else{
	?>
	<td width="80" valign="top" class="cualquierotroestilo" style="mso-number-format:'0.00';"><div style="height:40px;width:20px"><span class="Estilo12"><font size="2">0.00</font></span></div></td>
	<td width="80" valign="top" class="cualquierotroestilo" style="mso-number-format:'0.00';"><div style="height:40px;width:20px"><span class="Estilo12"><font size="2"><?php echo $roww['total']; ?></font></span></div></td>
 	</tr>
<?php
}
	if($roww['tipopago']=='1'){
	$total_efe=$total_efe+$roww['total'];
	}else{
	$total_cre=$total_cre+$roww['total'];
	}
	
}

	$subtotal_efe=  round($total_efe/1.18,2);
	$igv_efe=  $total_efe-$subtotal_efe;	
	$subtotal_cre=  round($total_cre/1.18,2);
	$igv_cre=  $total_cre-$subtotal_cre;
	
    echo "<tr>
	<td colspan='7' align='center' valign='top' class='cualquierotroestilo'><div style='height:40px;width:20px'><span class='Estilo12'>".''."</span></div></td>
	<td colspan='2' align='right' height='25' valign='top' class='cualquierotroestilo'><div style='height:40px;width:20px'><span class='Estilo12'><font size='+1'>".' Total Subtotal :'."</font></span></div></td>";
	?>
	<td width="80" valign="top" class="cualquierotroestilo" style="mso-number-format:'0.00';"><div style="height:40px;width:20px"><span class="Estilo12"><font size="+1"><?php echo $subtotal_efe; ?></font></span></div></td>
	<td width="80" valign="top" class="cualquierotroestilo" style="mso-number-format:'0.00';"><div style="height:40px;width:20px"><span class="Estilo12"><font size="+1"><?php echo $subtotal_cre; ?></font></span></div></td>
	</tr>
	<?php
	echo "<tr>
	<td colspan='7' align='center' valign='top' class='cualquierotroestilo'><div style='height:40px;width:20px'><span class='Estilo12'>".''."</span></div></td>
	<td colspan='2' align='right' height='25' valign='top' class='cualquierotroestilo'><div style='height:40px;width:20px'><span class='Estilo12'><font size='+1'>".' Total IGV :'."</font></span></div></td>";
 	?>
	<td width="80" valign="top" class="cualquierotroestilo" style="mso-number-format:'0.00';"><div style="height:40px;width:20px"><span class="Estilo12"><font size="+1"><?php echo $igv_efe; ?></font></span></div></td>
	<td width="80" valign="top" class="cualquierotroestilo" style="mso-number-format:'0.00';"><div style="height:40px;width:20px"><span class="Estilo12"><font size="+1"><?php echo $igv_cre; ?></font></span></div></td>
	</tr>
	<?php
	echo "<tr>
	<td colspan='7' align='center' valign='top' class='cualquierotroestilo'><div style='height:40px;width:20px'><span class='Estilo12'>".''."</span></div></td>
	<td colspan='2' align='right' height='25' valign='top' class='cualquierotroestilo'><div style='height:40px;width:20px'><span class='Estilo12'><font size='+1'>".' Total Venta :'."</font></span></div></td>";
 	?>
	<td width="80" valign="top" class="cualquierotroestilo" style="mso-number-format:'0.00';"><div style="height:40px;width:20px"><span class="Estilo12"><font size="+1"><?php echo $total_efe; ?></font></span></div></td>
	<td width="80" valign="top" class="cualquierotroestilo" style="mso-number-format:'0.00';"><div style="height:40px;width:20px"><span class="Estilo12"><font size="+1"><?php echo $total_cre; ?></font></span></div></td>
	</tr>
</table>
</body>
</html>




		
		
		
