<?php 

	include("../conexion.php");
	include("../extraprotocolares/view/funciones.php");

	$id_regventas  = $_REQUEST['id_regventas'];
	$conexion = Conectar();

	$sql_cuentas = "SELECT
					m_regventas.concepto AS concepto,
					m_regventas.fecha AS fecha,
					m_regventas.num_docu AS doic,
					d_regventas.id_regventas AS id_regventas,
					d_regventas.cantidad AS cantidad,
					d_regventas.detalle AS detalle,
					d_regventas.precio AS precio,
					m_regventas.subtotal AS subtotal,
					m_regventas.impuesto AS impuesto,
					m_regventas.imp_total AS total
					FROM
					d_regventas
					Inner Join m_regventas ON d_regventas.id_regventas = m_regventas.id_regventas
					where d_regventas.id_regventas ='$id_regventas'";
	
    $datos_cuentas = mysql_query($sql_cuentas, $conexion);	
    $dato_cuentas_cli = mysql_fetch_array($datos_cuentas);
	
    echo '
	<table width="589" height="343" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="65" height="19">&nbsp;</td>
    <td width="348">&nbsp;</td>
    <td width="83">&nbsp;</td>
    <td width="93">&nbsp;</td>
  </tr>
  <tr>
    <td height="45" colspan="4"><table width="584" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="65">&nbsp;</td>
        <td width="185">'.ucwords($dato_cuentas_cli['concepto']).'</td>
        <td width="89">&nbsp;</td>
        <td width="245">'.fecha_aletra(fechabd_an($dato_cuentas_cli['fecha'])).'</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>'.$dato_cuentas_cli['doic'].'</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="32">cant</td>
    <td>descripcion</td>
    <td>unitario</td>
    <td>importe</td>
  </tr>
  
  <tr>
    <td height="224" colspan="4" valign="top">
    <table width="589" height="28" border="0" cellpadding="0" cellspacing="0">
	';
    while($dato_cuentas = mysql_fetch_array($datos_cuentas)){
		
	      echo '
		  <tr>
			<td width="66" height="28">'.$dato_cuentas['cantidad'].'</td>
			<td width="346">'.ucwords ($dato_cuentas['detalle']).'</td>
			<td width="84">'.$dato_cuentas['precio'].'</td>
			<td width="93"></td>
		  </tr>
		  ';
		  
		  
		  
	}

echo'
    </table>
    </td>
  </tr>
  <tr>
    <td height="23">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>'.$dato_cuentas_cli['total'].'</td>
  </tr>
</table>
';


?>