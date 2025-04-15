<?php
session_start();
include("conexion.php");
$id_usuario= $_SESSION["id_usu"];
$sqlu  = mysql_query("SELECT * FROM permisos_usuarios where idusuario = '$id_usuario'",$conn) or die(mysql_error());

$rowu= mysql_fetch_array($sqlu);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Permisos de viaje</title>
<style type="text/css">
div.frmcartas
{ 
  background-color: #ffffff;
border: 4px solid #264965;  

-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:900px; height:850px;
}

.titulosprincipales {
	font-family: Verdana;
	font-size: 16px;
	color: #FFFFFF;
	
}
.line {color: #FFFFFF}
</style>
</head>

<body>
<div class="frmcartas">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="924" height="30" bgcolor="#264965"><table width="900" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="33" height="30"><img src="../../iconos/newproto.png" alt="" width="26" height="26" /></td>
          <td width="328"><span class="titulosprincipales">Permisos de viaje</span></td>
          <td width="510" align="left"><table width="454" border="0" align="right" cellpadding="0" cellspacing="0">
            <tr>
              <td width="239" height="30">&nbsp;</td>
              <td width="80">
              <?php
			  if($rowu['newvia'] == '1')
              {
                    echo'<a href="PermiviajeVie.php" target="npermisos"><img src="../../iconos/nuevo.png" width="62" height="22" border="0" /></a>';
			  }else{
				    echo'<img src="../../iconos/nuevo.png" width="62" height="22" border="0" />';
				  }
              
			  
			  ?>
			  </td>
              <td width="17"><span class="line">|</span></td>
              <td width="118"><a href="listpermiviaje.php" target="npermisos"><img src="../../images/search.png" width="22" height="22" border="0" /></a></td>
              </tr>
          </table></td>
          <td width="29">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><iframe name="npermisos" src="listpermiviaje.php" frameborder="0" width="97%" height="800" allowtransparency="true" scrolling="auto"></iframe></td>
    </tr>
  </table>
</div>
</body>
</html>
