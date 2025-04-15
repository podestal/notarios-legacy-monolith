<?php
 session_start();
	
require_once("../dompdf/dompdf_config.inc.php");
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



$html ='<!doctype html>
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

<table width="525" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" colspan="4"><table width="525" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100"><span class="titulosprincipales">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EMISION DE COMPROBANTES</span></td>
          <td width="20" align="left"><table width="454" border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="100">&nbsp;</td>
                <td width="1"><span class="line">|</span></td>
                <td width="1" align="center"><span>  '.$id.'</span></td>
              </tr>
            </table></td>
          <td width="1">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>

<div>
  <table>
    <tr>
      <td width="180">Comprobante &nbsp;  '.$arr_comprobantes[1].'</td>
      <td width="230">N. Docum &nbsp;   '.$arr_regventa[2].' - '.$arr_regventa[3].'</td>
      <td width="180">Fecha Emision &nbsp;   '.fechabd_an($arr_regventa[4]).'</td>
    </tr>
  </table>
</div>

<table>
<tr>
  <td><div style="position::static; border: 2px solid #D3D3D3; border-radius: 8px ; padding:10px; width:675px;margin-bottom:5px;" id="div_datoscliente">
      <table border="0" width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td width="50">RUC / DNI:</td>
          <td width="100">  '.$arr_regventa[7].'</td>
          <td width="70">&nbsp;</td>
          <td width="50">Telefono</td>
          <td width="120">  '.$arr_regventa[9].'</td>
        </tr>
        <tr>
          <td width="50">Nombre Cliente:</td>
          <td width="500" colspan="4">  '.$arr_regventa[6].'</td>
        </tr>
        <tr>
          <td width="50">Direccion:</td>
          <td width="450" colspan="4">  '.$arr_regventa[8].'</td>
        </tr>
      </table>
    </div></td>
</tr>
</table>

<table>
<tr>
  <td><div style="position::static; border: 2px solid #D3D3D3; border-radius: 8px ; padding:10px; width:675px;margin-bottom:5px;" id="div_datoscliente">
      <table border="0" width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td width="50">Detalle:</td>
          <td colspan="4">  '.$arr_regventa[11].'</td>
        </tr>
        <tr>
          <td width="50">Pago:</td>
          <td width="250">
		  		 
					 '.$arr_tipospagos[1].'
	
				
          </td>
          <td width="50">Atendido por:</td>
          <td width="200">  '.$arr_regventa[13].'</td>
        </tr>
      </table>
    </div></td>
</tr>
</table>

<table>
<tr>
  <div style="border: 1px solid ; border-radius: 8px ;  width:695px; height:auto; min-height:75px;margin-bottom:5px;margin-left:5px;" id="div_detalle">
    <table cellspacing="0" cellpadding="0" border="1" width="100%" style="background:#E1E1E1" id="myTable">
      <tr>
        <th width="50"><span style="margin-left:5px" class="camposss">C&oacute;digo</span></th>
        <th width="150"><span style="margin-left:10px" class="camposss">Descripci&oacute;n</span></th>
        <th align="center" width="50"><span class="camposss">Precio</span></th>
        <th align="center" width="50"><span class="camposss">Cantidad</span></th>
        <th align="center" width="50"><span class="camposss">Total</span></th>
        <th align="center" width="50"><span class="camposss">Kardex</span></th>
      </tr>';
       
								for($i=0; $i<count($arr_dregventas); $i++){
								
$html =$html.'<tr>
        <td width="50" align="center"><span style="margin-left:5px" class="camposss">  '.$arr_dregventas[$i][3].'</span></td>
        <td width="150"><span style="margin-left:10px" class="camposss">  '.$arr_dregventas[$i][4].'</span></td>
        <td align="center" width="50"><span class="camposss">  '.$arr_dregventas[$i][5].'</span></td>
        <td align="center" width="50"><span class="camposss">  '.(int)$arr_dregventas[$i][6].'</span></td>
        <td align="center" width="50"><span class="camposss">  '.$arr_dregventas[$i][7].'</span></td>
        <td align="center" width="50"><span class="camposss">  '.$arr_dregventas[$i][0].'</span></td>
      </tr>';
       
								} 
$html =$html.'</table>
  </div>
</tr>
</table>

<table>
<tr>
  <td><div style="position::static; border: 2px solid #D3D3D3; border-radius: 8px ; padding:5px; width:685px;margin-bottom:3px;" id="div_datoscliente">
      <table border="0" width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td width="280">&nbsp;</td>
          <th width="80">Sub Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div style="border: 1px solid ;border-radius: 8px ;height:12px;width:80px;">  '.$arr_regventa[14].'</div></th>
          <th width="80">IGV (18%)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div style="border: 1px solid ; border-radius: 8px ;height:12px;width:80px;">  '.$arr_regventa[15].'</div></th>
          <th width="80">TOTAL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div style="border: 1px solid ; border-radius: 8px ;height:12px;width:80px;"  >  '.$arr_regventa[16].'</div></th>
        </tr>
      </table>
    </div></td>
</tr>
</table>
</body></html>';

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream('my.pdf',array('Attachment'=>1));




