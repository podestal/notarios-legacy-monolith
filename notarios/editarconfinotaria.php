<?php 
include("conexion.php");
$sqlupdates="SELECT * FROM confinotario where idnotar='1'"; 
$rpta=mysql_query($sqlupdates,$conn) or die(mysql_error());
$row = mysql_fetch_array($rpta);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script> 
<style type="text/css">
div.frmprotocolar
{ 
  background-color: #ffffff;
border: 4px solid #264965;  

-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:900px; height:800px;
}

.titulosprincipales {
	font-family: Calibri;
	font-size: 18px;
	color: #FF9900;
	font-style: italic;
}
.line {color: #FFFFFF}
</style>
</head>

<body>
<div class="frmprotocolar">
  <table width="900" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="30" bgcolor="#264965"><table width="900" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="33" height="30"><img src="iconos/newproto.png" alt="" width="26" height="26" /></td>
          <td width="328"><span class="titulosprincipales">Configuracion de la Notaria</span></td>
          <td width="510" align="left">&nbsp;</td>
          <td width="29">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><form id="form1" name="form1" method="post" action="grabarnotarioedit.php">
        <table width="740" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="36" colspan="6"><span style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#036;"><strong>EDITE DATOS DEL NOTARIO</strong></span></td>
            </tr>
          <tr>
            <td width="180">&nbsp;</td>
            <td width="210">&nbsp;</td>
            <td width="18">&nbsp;</td>
            <td width="165">&nbsp;</td>
            <td width="156">&nbsp;</td>
            <td width="81">&nbsp;</td>
          </tr>
          <tr>
            <td height="31"><span style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#036;">Nombres</span></td>
            <td colspan="4"><input type="text" style="text-transform:uppercase;"  name="nombre" id="nombre"  size="50"  value="<?php echo $row['nombre'];  ?>" /></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="31"><span style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#036;">Apellidos</span></td>
            <td colspan="4"><input type="text"  style="text-transform:uppercase;"  name="apellido" id="apellido"  size="50"  value="<?php echo $row['apellido'];  ?>"  /></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="31"><span style="font-family: Verdana, Geneva, sans-serif; font-size: 14px; color: #036">Distrito</span></td>
            <td colspan="4"><input type="text"  style="text-transform:uppercase;"  name="notariode" id="notariode"  size="50"  value="<?php echo $row['distrito'];  ?>"  /></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="31"><span style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#036;">RUC</span></td>
            <td colspan="4"><input type="text"  rows="10" name="ruc" id="ruc"  size="50" maxlength="11" value="<?php echo $row['ruc'];  ?>"  /></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="31"><span style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#036;">Telefono</span></td>
            <td colspan="4"><input type="text"   name="telefono" id="telefono"  size="25"  value="<?php echo $row['telefono'];  ?>" /></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="31"><span style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#036;">Correo</span></td>
            <td colspan="4"><input type="text"   name="correo" id="correo" style="text-transform:uppercase;"  size="50"  value="<?php echo $row['correo'];  ?>" /></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="31"><span style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#036;">Dirección</span></td>
            <td><input type="text"  style="text-transform:uppercase;"  name="direccion" id="direccion"  size="50"  value="<?php echo $row['direccion'];  ?>"  /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
		  <tr>
            <td height="31"><span style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#036;">Código de Notaria</span></td>
            <td><input type="text"  style="text-transform:uppercase;"  name="codnotario" id="codnotario"  size="50" maxlength="11" value="<?php echo $row['codnotario'];  ?>"  /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
          </tr>
		  <tr>
            <td height="36" colspan="6"><span style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#036;"><strong>REGISTRO DE OPERACIONES UIF</strong></span></td>
            </tr>
			<tr><td>&nbsp;</td></tr>
          <tr>
		  <tr>
            <td height="31"><span style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#036;">Código de Oficial de Cumplimiento</span></td>
            <td><input type="text"  style="text-transform:uppercase;"  name="codoficial" id="codoficial"  size="50" maxlength="11" value="<?php echo $row['codoficial'];  ?>"  /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
		  <tr>
            <td height="31"><span style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#036;">Código de Notaria</span></td>
            <td><input type="text"  style="text-transform:uppercase;"  name="coduif" id="coduif"  size="50" maxlength="11" value="<?php echo $row['coduif'];  ?>"  /></td>
            <td>&nbsp;</td>
            <tr><td>&nbsp;</td></tr>
          </tr>
		  
		   <tr>
            <td height="36" colspan="6"><span style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#036;"><strong>REGISTRO DE LICENCIA</strong></span></td>
            </tr>
			<tr><td>&nbsp;</td></tr>
          <tr>
		   <tr>
            <td height="31"><span style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#036;">NOMBRE NOTARIO</span></td>
            <td colspan="4"><input type="text" style="text-transform:uppercase;"  name="nombrenot" id="nombrenot"  size="50"  value="<?php echo $row['notario'];  ?>" /></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="31"><span style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#036;">RESOLUCION</span></td>
            <td colspan="4"><input type="text"  style="text-transform:uppercase;"  name="resolucion" id="resolucion"  size="50"  value="<?php echo $row['resolucion'];  ?>"  /></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="31"><span style="font-family: Verdana, Geneva, sans-serif; font-size: 14px; color: #036">INICIO</span></td>
            <td colspan="4"><input type="text"  style="text-transform:uppercase;"  name="inicio" id="inicio"  size="15"  value="<?php echo $row['fechainicio'];  ?>"  /></td>
            
			<td>&nbsp;</td>
          </tr>
		  <tr>
            <td height="31"><span style="font-family: Verdana, Geneva, sans-serif; font-size: 14px; color: #036">FIN</span></td>
            <td colspan="4"><input type="text"  style="text-transform:uppercase;"  name="fin" id="fin"  size="15"  value="<?php echo $row['fechafin'];  ?>"  /></td>
            
			<td>&nbsp;</td>
          </tr>
		  
		 
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
            <td height="31">&nbsp;</td>
            <td><input type="submit" name="button" id="button" value="Actualizar datos" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </form></td>
    </tr>
  </table>
</div>
</body>
</html>
