<?php 
include("../../conexion.php");

$sql =mysql_query("SELECT * FROM ingreso_poderes",$conn) or die(mysql_error());

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link rel="stylesheet" href="stylesglobal.css">
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
<script type="text/javascript" src="../ajax/poderes.js"></script> 
<title>Lista de Poderes</title>

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

<body onLoad="buscar_poderes(1)" >

<form id="frm_poderes" name="frm_poderes" method="post" action="">
<table>
    	<tr>
            <td width="831" colspan="2"><span class="reskar2">Busqueda Por:</span></td>
        </tr>
        <tr>
            <td height="51" colspan="2">
            	<table width="800">
                 	<tr>
                       <td width="66" height="32"><span class="titubuskar0">N° Crono :</span></td>
                       <td width="186">
                       <input id="num_crono" name="num_crono" type="text" maxlength="11">
                       </td>
                       <td width="112"><span class="titubuskar0">Nom. contratante :</span></td>
                       <td width="194">
                       <input id="contratante" name="contratante" style="text-transform:uppercase;" type="text" maxlength="50"/>
                       </td>
                       <td width="80"><span class="titubuskar0">Nro Control :</span></td>
                       <td width="142">
                       <input id="nro_control" name="nro_control" style="text-transform:uppercase;" type="text" maxlength="10" onkeypress="return isNumberKey(event)"/>
                       </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td height="17" colspan="2"><span class="reskar2">Busqueda por fecha:</span></td>
        </tr>
        <tr>
            <td colspan="2">
                <table width="805">
                	<tr>
                       <td width="50" height="54"><span class="titubuskar0">Desde :</span></td>
                       <td width="180">
                            <input id="rango1" name="rango1" type="text" class="tcal" readonly="readonly" />
                       </td>
                       <td width="40"><span class="titubuskar0">Hasta:</span></td>
                       <td width="183">
                            <input id="rango2" name="rango2"  type="text" class="tcal" readonly="readonly"/>
                       </td>
                       <td width="193">
                          <table width="191">
                                <tr>
                                    <td width="95"><span class="titubuskar0">Fecha.Ingreso</span></td>
                                    <td width="59">
                                    <input id="opcion1" name="opcion" type="radio" value="1">
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="titubuskar0">Fecha.Crono</span></td>
                                    <td>
                                    <input id="opcion2" name="opcion" type="radio" value="2">
                                    </td>
                                </tr>
                          </table>
                       </td>
                       <td width="131"><a onClick="buscar_poderes(1)"><img src="../../iconos/buscarclie.png" width="72" height="29" border="0" /></a></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    
    </form>   
      
      <tr>
        <td colspan="2">--------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
      </tr>
  
      <tr>
         <td colspan="2"><div id="gennn" style="width:840px; height:690px; overflow:auto;">
           <table width="200" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><div id="lista_poderes"></div></td>
            </tr>
          </table>
          </div>
         </td>
         
      </tr>
</table>

</body>
</html>



