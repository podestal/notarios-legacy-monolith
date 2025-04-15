<?php 
include("../../conexion.php");

$sql =mysql_query("SELECT * FROM ingreso_cartas",$conn) or die(mysql_error());

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../includes/css/uniform.default.min.css" />
<link rel="stylesheet" type="text/css" href="../../tcal.css" />

<script language="JavaScript" type="text/javascript" src="../../ajax.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<script src="../../includes/jquery-1.8.3.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script src="../../includes/jquery.uniform.min.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../../js/prototype.js"></script>
<script type="text/javascript" src="../ajax/cartas.js"></script> 
<script type="text/javascript">
function completar(){

	var valor=document.getElementById('num_carta').value;
	var cantidad = valor.length;
	var caja=document.getElementById('num_carta').value;
	switch (cantidad) { 
   	case 1: 
      	document.getElementById('num_carta').value="00000"+caja;
      	break 
   	case 2: 
      	document.getElementById('num_carta').value="0000"+caja;
      	break 
   	case 3: 
      	document.getElementById('num_carta').value="000"+caja;
      	break 
   case 4: 
      	document.getElementById('num_carta').value="00"+caja;
      	break 
	case 5: 
      	document.getElementById('num_carta').value="0"+caja;
      	break 
	case 6: 
      	document.getElementById('num_carta').value=caja;
      	break 
	
	}
}
</script>
<title>Listado de Cartas</title>
<style type="text/css">
<!--
.titubuskar {
	font-family: Calibri;
	font-size: 12px;
	font-weight: bold;
	font-style: italic;
	color: #003366;
}
.titubuskar0 {font-family: Calibri; font-size: 12px; font-style: italic; font-weight: bold; color: #333333; }
.titubuskar1 {color: #333333}
.reskar2 {font-family: Calibri; font-size: 13px; font-weight: bold; font-style: italic; color: #003366; }
.reskar {font-size: 12px; font-style: italic; color: #333333; font-family: Calibri;}
-->
</style>

</head>

<body onload="buscar_cartas(1)">
<table width="858" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2">
    <form id="frm_buscarcartas" name="frm_buscarcartas" method="post" action="">
        <table width="845" cellpadding="0" cellspacing="0">
             <tr>
                <td height="30" colspan="6" ><span class="reskar2">Busqueda Por:</span></td>
             </tr>
             <tr>
				<td height="30" colspan="6">
                   <table>
                   		<tr>
                        	<td width="85"><label class="titubuskar0">N° Carta:</label></td>
                            <td width="156"><input id="num_carta" name="num_carta" type="text" size="12" maxlength="11"  onchange="completar();"></td>
                            <td width="73"><label class="titubuskar0">Remitente :</label></td>
                            <td width="255"><input id="remitente" name="remitente" type="text" size="20" maxlength="100" /></td>
                            <td width="76"><label class="titubuskar0">Destinatario :</label></td>
                            <td width="170"><input id="destinatario" name="destinatario" type="text" size="20" maxlength="100"/></td>	
                        </tr>
                   </table>
                </td>
             </tr>
             <tr>
                <td height="27"  colspan="6"><span class="reskar2">Busqueda por fecha:</span></td>
              </tr>
             <tr >
                <td width="65"><span class="titubuskar0">Desde: </span></td>
                <td width="122"><input id="rango1" name="rango1" type="text" class="tcal" size="10" readonly="readonly" /></td>
                <td width="62"><span class="titubuskar0">Hasta: </span></td>
                <td width="159"><input id="rango2" name="rango2" type="text" class="tcal" size="10"/ readonly="readonly"></td>
                <td width="208">
                    <table width="161">
                        <tr>
                            <td width="93"><span class="titubuskar0">Fecha.Ingreso</span></td>
                            <td width="56"><input id="opcion1" name="opcion" type="radio" value="1"></td>
                        </tr>
                        <tr>
                            <td><span class="titubuskar0">Fecha.Diligencia</span></td>
                            <td><input id="opcion2" name="opcion" type="radio" value="2"></td>
                        </tr>
                    </table>
                </td>
                <td width="227"><a onclick="buscar_cartas(1)"><img src="../../iconos/buscarclie.png" width="72" height="29" border="0" /></a></td>
             </tr>
           </table>
       </form>   
    </td>
  </tr>
  <tr>
    <td colspan="2">-----------------------------------------------------------------------------------------------------------------------------------------------</td>
  </tr>
  <tr>
    <td colspan="2">
      <div id="lista_cartas">
    </div></td>
  </tr>
</table>

</body>
</html>



