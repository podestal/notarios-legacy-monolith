<?php 

include("extraprotocolares/view/funciones.php");

$conexion = Conectar();

$codkardex = $_POST['codkardex'];

$sql_fact = "SELECT
			d_regventas.id_regventas,
			d_regventas.kardex,
			m_regventas.fecha,
			tipo_pago.descrip,
			m_regventas.serie,
			m_regventas.factura,
			m_cteventas.saldo,
			SUM(d_regventas.total) AS imp_total,
			tipocomprobante.descompro
			FROM
			d_regventas
			Inner Join m_regventas ON m_regventas.id_regventas = d_regventas.id_regventas
			Inner Join tipo_pago ON tipo_pago.codigo = m_regventas.tipopago
			Left Join m_cteventas ON m_cteventas.id_regventas = m_regventas.id_regventas
			Inner Join tipocomprobante ON tipocomprobante.idcompro = m_regventas.tipo_docu
			where d_regventas.kardex = '$codkardex' GROUP BY id_Regventas";
			
			$exe_fact = mysql_query($sql_fact, $conexion);
			
			$i = 1;
			?>
            
            
	<table id='detPagosTb' width='100%' border='1' cellspacing='0' cellpadding='0'>
      <tr>
          <td width="156" height="27" align="center"  bgcolor="#CCCCCC" ><span class="Estilo18">Tipo</span></td>
          <td width="93" height="27" align="center" bgcolor="#CCCCCC"><span class="Estilo18">N.Docu.</span></td>
          <td width="89" align="center" bgcolor="#CCCCCC"><span class="Estilo18">Fecha</span></td>
          <td width="121" align="center" bgcolor="#CCCCCC"><span class="Estilo18">Condición</span></td>
          <td width="79" align="center" bgcolor="#CCCCCC"><span class="Estilo18">Pv</span></td>
          <td width="73" align="center" bgcolor="#CCCCCC"><span class="Estilo18">Saldo</span></td>
      </tr>		
			
	<?php 
	while($row = mysql_fetch_array($exe_fact)){
	?>
    
      <tr class='well' style='cursor:pointer'>
        <td align='center'><label style='color:#333333'><?php echo $row['descompro']; ?></label></td>
        <td align='center' ><label style='color:#333333'><?php echo $row['serie'].'-'.$row['factura']; ?></label></td>
        <td align='center' ><label style='color:#333333'><?php echo fechabd_an($row['fecha']); ?></label></td>
        <td align='center'><label style='color:#333333'><?php echo $row['descrip']; ?></label></td>
        <td align='center' ><label style='color:#333333'><?php echo $row['imp_total']; ?></label></td>
        <td align='center' ><label style='color:#333333'><?php echo $row['saldo']; ?></label></td>
      </tr>
    

<?php $i++;
} 
?>

	</table>
    
            <!--<input id='datosTb".$i."' type='text' value='".$row['tip_docu']."|".$row['num_docu']."|".$row['fec_emision']."|".$row['condicion']."|".$row['precio_vta']."|".$row['saldo']."' type="hidden"/>-->