<?php
session_start();

include('../conexion.php');
include('../extraprotocolares/view/funciones.php');

include('../facturacion/consultas/comprobante.php');

$sql=mysql_query("SELECT MAX(m_regventas.id_regventas) AS ultimo						
				FROM m_regventas",$conn);
$res=mysql_fetch_assoc($sql);

$id=$res['ultimo'];	
							
$arr_regventa = dame_comprobante($id);

	$id_pago=$arr_regventa[10];
	$id_bol=$arr_regventa[1];
	
$arr_documentos = dame_documentos();
$arr_comprobantes = dame_comprobantes($id_bol);
$arr_tipospagos = dame_tipopagos($id_pago);
$arr_servicios = dame_servicios();
$arr_usuarios = dame_usuarios();
$arr_dregventas = dame_dregventas($id);


?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>hola</title>
<style>
body{
	font-size:10px ;
	font-family:arial;
 }
</style>
</head>
<body>

<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr><!-- FILA 1 -->
    <td height="30" bgcolor="#264965" colspan="4"><table width="900" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="33" height="30"></td>
          <td width="328"><span class="titulosprincipales">EMISION DE COMPROBANTES</span></td>
          <td width="510" align="left"><table width="454" border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="376" height="30">&nbsp;</td>
                <td width="10"><span class="line">|</span></td>
                <td width="69" align="center"><span style="color:#FFF"><?php echo $id;?></span></td>
              </tr>
            </table></td>
          <td width="29">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
<!--FIN FILA 1 --> 

<!--FILA 2 -->
<div>
  <table>
    <tr>
      <td width="314">Comprobante &nbsp;<?php echo $arr_comprobantes[1];?></td>
      <td width="301">N. Docum &nbsp; <?php echo $arr_regventa[2]." - ".$arr_regventa[3]?></td>
      <td width="281">Fecha Emision &nbsp; <?php echo fechabd_an($arr_regventa[4])?></td>
    </tr>
  </table>
</div>
<!--FIN FILA 2 --> 

<!--DIV 1 -->
<tr>
  <td><div style="position::static; border: 2px solid #D3D3D3; border-radius: 8px ; padding:10px; width:875px;margin-bottom:5px;" id="div_datoscliente">
      <table border="0" width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td width="120">RUC / DNI:</td>
          <td width="250"><?php echo $arr_regventa[7];?></td>
          <td width="120">&nbsp;</td>
          <td width="120">Telefono</td>
          <td width="120"><?php echo $arr_regventa[9];?></td>
        </tr>
        <tr>
          <td width="120">Nombre Cliente:</td>
          <td width="500" colspan="4"><?php echo $arr_regventa[6];?></td>
        </tr>
        <tr>
          <td width="120">Direccion:</td>
          <td width="500" colspan="4"><?php echo $arr_regventa[8];?></td>
        </tr>
      </table>
    </div></td>
</tr>
<!--FIN DIV 1 --> 
<!--DIV 2 -->
<tr>
  <td><div style="position::static; border: 2px solid #D3D3D3; border-radius: 8px ; padding:10px; width:875px;margin-bottom:5px;" id="div_datoscliente">
      <table border="0" width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td width="139">Detalle:</td>
          <td colspan="4"><?php echo $arr_regventa[11];?></td>
        </tr>
        <tr>
          <td width="139">Pago:</td>
          <td width="301">
		  		<?php 
					echo $arr_tipospagos[1];
	
				?>
          </td>
          <td width="174">Atendido por:</td>
          <td width="237"><?php echo $arr_regventa[13];?></td>
        </tr>
      </table>
    </div></td>
</tr>
<!--FIN DIV 2 -->

<tr>
  <div style="border: 1px solid ; border-radius: 8px ;  width:895px; height:auto; min-height:75px;margin-bottom:5px" id="div_detalle">
    <table cellspacing="0" cellpadding="0" border="1" width="100%" style="background:#E1E1E1" id="myTable">
      <tr>
        <th width="99"><span style="margin-left:5px" class="camposss">C&oacute;digo</span></th>
        <th width="316"><span style="margin-left:10px" class="camposss">Descripci&oacute;n</span></th>
        <th align="center" width="106"><span class="camposss">Precio</span></th>
        <th align="center" width="122"><span class="camposss">Cantidad</span></th>
        <th align="center" width="89"><span class="camposss">Total</span></th>
        <th align="center" width="70"><span class="camposss">Kardex</span></th>
      </tr>
      <?php 
								for($i=0; $i<count($arr_dregventas); $i++){
								?>
      <tr>
        <td width="90" align="center"><span style="margin-left:5px" class="camposss"><?php echo $arr_dregventas[$i][3]?></span></td>
        <td width="242"><span style="margin-left:10px" class="camposss"><?php echo $arr_dregventas[$i][4]?></span></td>
        <td align="center" width="100"><span class="camposss"><?php echo $arr_dregventas[$i][5]?></span></td>
        <td align="center" width="100"><span class="camposss"><?php echo (int)$arr_dregventas[$i][6]?></span></td>
        <td align="center" width="90"><span class="camposss"><?php echo $arr_dregventas[$i][7]?></span></td>
        <td align="center" width="90"><span class="camposss"><?php echo $arr_dregventas[$i][0]?></span></td>
      </tr>
      <?php 
								} ?>
    </table>
  </div>
</tr>

<!--DIV 3 -->
<tr>
  <td><div style="position::static; border: 2px solid #D3D3D3; border-radius: 8px ; padding:10px; width:875px;margin-bottom:3px;" id="div_datoscliente">
      <table border="0" width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td width="500">&nbsp;</td>
          <th width="100">Sub Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div style="border: 1px solid ;border-radius: 8px ;height:20px;width:80px;"><?php echo $arr_regventa[14];?></div></th>
          <th width="100">IGV (18%)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div style="border: 1px solid ; border-radius: 8px ;height:20px;width:80px;"><?php echo $arr_regventa[15];?></div></th>
          <th width="100">TOTAL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div style="border: 1px solid ; border-radius: 8px ;height:20px;width:80px;"  ><?php echo $arr_regventa[16];?></div></th>
        </tr>
      </table>
    </div></td>
</tr>
<!--FIN DIV 3 -->

</body></html>
