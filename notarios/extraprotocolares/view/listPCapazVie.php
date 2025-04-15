<?php 
include("../../conexion.php");

$sql =mysql_query("SELECT * FROM cert_supervivencia WHERE cert_supervivencia.swt_capacidad = 'C'",$conn) or die(mysql_error());

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
<script src="../../includes/jquery-1.8.3.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script src="../../includes/jquery.uniform.min.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../../js/prototype.js"></script>
<script type="text/javascript" src="../ajax/capaces.js"></script> 

<title>Listado Capaces</title>
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

<body onload="buscar_capaces(1);">


<form id="frm_buscarcapaces" name="frm_buscarcapaces" method="post" action="">
<table width="858" border="0" cellspacing="0" cellpadding="0">
		    <tr>
        	<td height="22"><span class="reskar2">Busqueda Por:</span></td>
        </tr>
        <tr>
        	<td height="41">
        	<table width="807">
            		<tr>
                    <td width="78">
                        <span class="titubuskar0">N° crono :</span>
                    </td>
                    <td width="247">
                        <input id="num_crono" name="num_crono" type="text"  size="12" maxlength="11" />
                    </td>
                    <td width="91">
                        <span class="titubuskar0">Nombre P. Capaz:</span>
                    </td>
                    <td width="332">
                         <input id="nombre" name="nombre" type="text" size="30" maxlength="100" />
                    </td>
                </tr>
            </table>	
            </td>
        </tr>
        <tr>
        	<td height="30" ><span class="reskar2">Busqueda por fecha:</span></td>
        </tr>
        <tr>
        	<td>
            	<table width="804" >
                	 <tr>
                     	<td width="41">
                          <span class="titubuskar0">Desde</span>
                      </td>
                      <td width="171">
                          <input id="rango1" name="rango1" type="text"  class="tcal" style="text-transform:uppercase"  size="12" readonly="readonly" />
                      </td>
                      <td width="55">
                          <span class="titubuskar0">Hasta</span>
                      </td>
                      <td width="172">
                           <input id="rango2" name="rango2" type="text"  class="tcal" style="text-transform:uppercase"  size="12" readonly="readonly"/>
                      </td>
                      <td width="341">
                          <div onclick="buscar_capaces(1)"><img src="../../iconos/buscarclie.png" width="72" height="29" border="0" /></div>
                      </td>
                    </tr>
                </table>
            </td>	
        </tr>
        <tr>
          <td colspan="2">--------------------------------------------------------------------------------------------------------------------------------------------</td>
        </tr>
        <tr>
          <td colspan="2">
          <div id="lista_capaces"></div>
          </td>
        </tr>
</table>
</form>


</body>
</html>



