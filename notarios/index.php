<?
  session_start();  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema Infomático Notarial</title>
<script src="jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="jquery.uniform.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
      $(function(){
        $("input, textarea, select, button").uniform();
      });
    </script>
<link rel="stylesheet" href="css/uniform.default.css" type="text/css" media="screen">
<link rel="shortcut icon" type="image/jpg" href="imagenes/logocolegio.jpg" />
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(imagenes/fndinicio.jpg);
}
.Estilo5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; color: #013334; }
.Estilo6 {color: #013334}
.boton{
        
        background:url(imagenes/boton3.png);
        border:0px;
        width:57px;
        height:20px;
       }
.boton2{
        
        background:url(imagenes/boton2.png);
        border:0px;
        width:57px;
        height:20px;
       }
.style5 {font-family: Calibri; font-size: 15px; color: #013334; font-style: italic; }
-->
</style></head>

<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="519" height="272" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th background="imagenes/login.png" scope="col"><form id="form1" name="form1" method="post" action="validar_usuario.php">
      <table width="519" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <th width="279" height="35" align="right" scope="col">&nbsp;</th>
          <th width="7" scope="col">&nbsp;</th>
          <th width="233" scope="col">&nbsp;</th>
        </tr>
        <tr>
          <td height="29" align="right"><span class="style5">Usuario</span></td>
          <td>&nbsp;</td>
          <td align="left">
            <input name="usuario" style="text-transform:uppercase" type="text" id="usuario" size="20" />
          </td>
        </tr>
        <tr>
          <td align="right"><span class="style5">Contraseña</span></td>
          <td>&nbsp;</td>
          <td align="left">
            <input name="clave" type="password" id="clave" size="20" />
         </td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="25" colspan="2" align="right"><input type="submit" name="button" id="button" value="Ingresar" /></td>
          <td align="left">
           
            <input type="reset" name="button2" id="button2" value="Cancelar" />
          </td>
        </tr>
      </table>
        </form>
    </th>
  </tr>
</table>
</body>
</html>
