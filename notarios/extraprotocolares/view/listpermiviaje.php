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

<script language="JavaScript" type="text/javascript" src="../../ajax.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<script src="../../js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="../../includes/jquery-1.8.3.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script src="../../includes/jquery.uniform.min.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../../js/prototype.js"></script>
<script type="text/javascript" src="../ajax/funciones.js"></script> 
<script type="text/javascript">
function limpiartextosgen(){
		
		document.getElementById('num_crono').value='';
		document.getElementById('nro_control').value='';
		document.getElementById('rango1').value='';
		document.getElementById('rango2').value='';
		document.getElementById('opcion1').checked = false;
		document.getElementById('opcion2').checked = false;
		document.getElementById('tip_permiso').selectedIndex=0;
		
		}
		
function limpiar_crono(){
	    document.getElementById('participante').value='';
		document.getElementById('nro_control').value='';
		document.getElementById('rango1').value='';
		document.getElementById('rango2').value='';
		document.getElementById('opcion1').checked = false;
		document.getElementById('opcion2').checked = false;
		document.getElementById('tip_permiso').selectedIndex=0;
	}
	
function limpiarcontrol(){
	    document.getElementById('num_crono').value='';
		document.getElementById('participante').value='';
		document.getElementById('rango1').value='';
		document.getElementById('rango2').value='';
		document.getElementById('opcion1').checked = false;
		document.getElementById('opcion2').checked = false;
		document.getElementById('tip_permiso').selectedIndex=0;
	}
function limpiacombo(){
	    document.getElementById('num_crono').value='';
		document.getElementById('nro_control').value='';
		document.getElementById('participante').value='';
		
	}
function limpiar_fechas(){
	    document.getElementById('num_crono').value='';
		document.getElementById('participante').value='';
		document.getElementById('nro_control').value='';
	}
function limpiaoption(){
	    document.getElementById('num_crono').value='';
		document.getElementById('nro_control').value='';
		document.getElementById('participante').value='';
	}


</script>

<title>Lista de Permisos de Viajes</title>
<style type="text/css">
<!--
.titubuskar {
	font-family: Calibri;
	font-size: 12px;
	font-weight: bold;
	font-style: italic;
	color: #003366;
}
.titubuskar0 {font-family: Verdana; font-size: 11px;  color: #333333; }
.titubuskar1 {color: #333333}
.reskar2 {font-family: Verdana; font-size: 11px; font-weight: bold;  color: #003366; }
.reskar {font-size: 12px; font-style: italic; color: #333333; font-family: Calibri;}
-->
</style>

</head>

<body onload="buscar_viaje(1);">

<table width="858" border="0" cellspacing="0" cellpadding="0">
<tr>
  <td width="20"><table width="858" border="0" cellspacing="0" cellpadding="0">
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr>
      <td width="20" ><span class="reskar2">Busqueda Por:</span></td>
      <td width="58">&nbsp;</td>
      <td width="25">&nbsp;</td>
      <td width="62" align="right">&nbsp;</td>
      <td width="72">&nbsp;</td>
    </tr>
    <tr>
      <td><form id="frm_buscarviaje" name="frm_buscarviaje" method="post" action="">
        <table width="868" border="0" cellspacing="0" cellpadding="0" >
          <tr>
            <td width="71" align="right"><span class="titubuskar0">N° Crono :</span></td>
            <td width="77"><span class="titubuskar0">
              <input id="num_crono" name="num_crono" type="text"  size="12" maxlength="11" onclick="limpiar_crono()" />		
            </span></td>
            <td width="14">&nbsp;</td>
               <td width="133"><span class="titubuskar0">
            <select id="tip_permiso" name="tip_permiso"  class="Estilo7" onchange="buscar_viaje(2, 1, 1); limpiacombo();">
            <option value ="" selected="selected">TIPO PERMISO</option>
            <option value="001">Interior</option>
            <option value="002">Exterior</option>
          </select>
            </span></td>
            <td width="160" align="right"><span class="titubuskar0">
             Nombre Participante :</span></td>
            <td width="205"><label><input id="participante" name="participante" type="text" style="text-transform:uppercase;" size="30" maxlength="50" onclick="limpiartextosgen()"/>
            </label></td>
             <td width="96" align="right"><span class="titubuskar0">
             Nro Control :</span></td>
            <td width="112"><label><input id="nro_control" name="nro_control" style="text-transform:uppercase;"  type="text"  size="11" onkeypress="return isNumberKey(event)" onclick="limpiarcontrol()" />
            </label></td>
          </tr>
          <tr>
            <td width="71">&nbsp;</td>
            <td width="77">&nbsp;</td>
            <td width="14"><span class="titubuskar0"></span></td>
          </tr>
        </table>
        <table width="867"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="25" colspan="8" align="left"><span class="reskar2">Busqueda por Fecha Cronologico:</span></td>
            </tr>
          <tr>
         	
            <td width="103" align="right"><span class="titubuskar0">Desde:</span></td>
            <td width="88">
            <input id="rango1" name="rango1" type="text"  class="tcal" style="text-transform:uppercase"  size="10" readonly="readonly" value="" onclick="limpiar_fechas();"/>
            </td>
            
            <td width="10">&nbsp;</td>
            
            <td width="53" align="center"><span class="titubuskar0">Hasta</span></td>
            <td width="120">
            <input id="rango2" name="rango2" type="text"  class="tcal" style="text-transform:uppercase"  size="10" readonly="readonly" value="" onclick="limpiar_fechas();" />
            </td>
            
            <td width="120">
            <span class="titubuskar0">Fecha.Ingreso</span>
            <input id="opcion1" name="opcion" type="radio" value="1" onclick="limpiaoption();">
            <span class="titubuskar0">Fecha.Crono</span> 
            <input id="opcion2" name="opcion" type="radio" value="2" onclick="limpiaoption();"></td>
            <td width="120">
            <div style="margin-left:25px; margin-bottom:10px"><input type="button" value="Limpiar" onclick="limpiar_cajas_viajes()" style="width:70px; height:26px; display:none"/></div>
            </td>
            <td width="201" align="left">
            <label><a onclick="buscar_viaje(1);"><img src="../../iconos/buscarclie.png" width="72" height="29" border="0" /></a>
            </label>
           </td>
           </tr>
    </table> 
      </form></td>
    </tr>
    <tr>
      <td colspan="2">------------------------------------------------------------------------------------------------------------------------------------------------</td>
    </tr>
    <tr>
      <td colspan="2"><div id="gennn" style="width:860px; height:550px; overflow:auto;">
        <table width="200" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><div id="lista_viajes" style="height:auto"></div></td>
          </tr>
        </table>
      </div></td>
    </tr>
  </table>    
   <span class="reskar2"></span></td>
</tr>
</table>
</body>
</html>



