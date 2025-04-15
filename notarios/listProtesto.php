<?php 
include("conexion.php");

$sql =mysql_query("SELECT * FROM protesto",$conn) or die(mysql_error());

?>
<!DOCTYPE html>
<html lang="es"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<link rel="stylesheet" type="text/css" href="includes/css/uniform.default.min.css" />
<script language="JavaScript" type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="tcal.js"></script> 
<script src="includes/jquery-1.8.3.js"></script>
<script src="includes/js/jquery-ui-notarios.js"></script>
<script src="includes/jquery.uniform.min.js"></script>
<script language="JavaScript" type="text/javascript" src="js/prototype.js" ></script>
<script language="JavaScript" type="text/javascript" src="ajax/protocolares/protestos.js" ></script>

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

<body onLoad="buscar_protesto(1)">
<table width="858" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
      <form id="frm_protesto" name="frm_protesto" method="post" action="">
      <table width="837" border="0" cellspacing="0" cellpadding="0">
      	<tr>
            <td height="22"><span class="reskar2">Busqueda Por:</span></td>
        </tr>
        <tr>
        	<td>
            	<table>
                		<tr>
                        	<td width="53"><span class="titubuskar0">N° Acta :</span></td>
                            <td width="216"><input id="num_acta" name="num_acta" type="text" size="10" maxlength="11"></td>
                            <td width="98"><span class="titubuskar0">Nom.Participante :</span></td>
                            <td width="231"><input id="participante" name="participante" type="text" size="20" maxlength="80"/></td>
                            <td width="72"><span class="titubuskar0">Nro Protesto :</span></td>
                            <td width="127"><input id="nro_protesto" name="nro_protesto" type="text" size="10" maxlength="15" onKeyPress="return isNumberKey(event);"/></td>
                        </tr>
                </table>
            </td>
        </tr>
        <tr>
        	<td height="31"><span class="reskar2">Busqueda por fecha :</span></td>
        </tr>
        <tr>
        	<td>
            	<table width="832">
                		<tr>
                          <td width="39" height="29"><input id="fecha_criterio" name="fecha_criterio" type="hidden" /></td>
                          <td width="43"><span class="titubuskar0">Ingreso</span></td>
                                <td width="85"><input  id="fec_ing" name="fec_ing" type="checkbox" onClick="limpiar_checks(id)" value="1" /></td>
                                <td width="55"><span class="titubuskar0">Constancia</span></td>
                                <td width="76"><input id="fec_cons" name="fec_cons" type="checkbox" onClick="limpiar_checks(id)" value="2"/></td>
                                <td width="65"><span class="titubuskar0">Notificacion</span></td>
                                <td width="437"><input id="fec_not"  name="fec_not" type="checkbox" onClick="limpiar_checks(id)" value="3"/></td>
                        </tr>
                </table>
            </td>
        </tr>
        <tr>
        	<td>
            	<table>
                		<tr>
                        	<td width="65"><span class="titubuskar0">Desde:</span></td>
                            <td width="111"><input id="fechade" name="fechade" type="text" class="tcal" style="text-transform:uppercase"  size="10" readonly="readonly" /></td>
                            <td width="51"><span class="titubuskar0">Hasta:</span></td>
                            <td width="112"><input id="fechaa" name="fechaa" type="text" class="tcal" style="text-transform:uppercase"  size="10" readonly="readonly"/></td>
                            <td width="178"><a onClick="buscar_protesto(1)"><img src="iconos/buscarclie.png" width="72" height="29" border="0" /></a></td>
                            <td width="104">
                            	<input type="hidden" id="boton1" name="boton1" onclick="numerar(1)" value="Numerar Acta" style="font-family:Calibri; font-size:12px; color:#333; "></td>
                            <td width="166">
							
                            <!--	<input type="button" id="boton2" name="boton2" onclick="numerar(2)" value="Quitar Numeración" style="font-family:Calibri; font-size:13px; color:#333; "> -->
                                </td>
                        </tr>
                </table>
                </div>
            </td>
        </tr>
		
      </table>
      </form>   
      </td>
  </tr>
  <tr>
    <td>--------------------------------------------------------------------------------------------------------------------------------------------</td>
  </tr>
  <tr>
    <td ><div id="gennn" style="width:860px; height:690px; overflow:auto;">
      <table width="200" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><div id="lista_protesto"></div></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>

</body>
</html>



