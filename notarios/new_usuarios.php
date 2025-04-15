<?php 
session_start();

if (empty($_SESSION["id_usu"])) 
  {
    ?>
		<script type="text/javascript">window.location="index.php"; </script> 
<?php  
  }
include("conexion.php");
$sql=mysql_query("SELECT * FROM cargousu",$conn);
$sql2=mysql_query("SELECT * FROM ubigeo",$conn);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="JavaScript" type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="includes/Mantenimientos.js"></script> 
<script src="js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="includes/jquery-1.8.3.js"></script>
<script src="includes/js/jquery-ui-notarios.js"></script>
<script type="text/javascript" src="includes/maskedinput.js"></script>
<link href="includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<link href="includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" charset="utf-8">
      
	  $(document).ready(function(){
	  $("#fecnac").mask("99/99/9999",{placeholder:"_"});

	});
	  
	  
	  $(function(){
        $("input, textarea, select, button").uniform();
      });
    </script>
<script type="text/javascript">
function seleccion(id) {
   document.frmusu.idusu.value=id;
   }
function seleccion2(id) {
   document.frmpermiso.idusu2.value=id;
   }
function seleccion3(id) {
   document.frmclave.idusu3.value=id;
   }
   
   function validar(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; //Tecla de retroceso (para poder borrar)
    patron = /\d/; //Solo acepta números
    te = String.fromCharCode(tecla);
    return patron.test(te); 
   }
   
function soloLetras(e){
 key = e.keyCode || e.which;
 tecla = String.fromCharCode(key).toLowerCase();
 letras = " áéíóúabcdefghijklmnñopqrstuvwxyz-:/._";
 especiales = [8,37,39,46];

 tecla_especial = false
 for(var i in especiales){
     if(key == especiales[i]){
  tecla_especial = true;
  break;
            } 
 }
 
        if(letras.indexOf(tecla)==-1 && !tecla_especial)
     return false;
     } 
	 
	    function valida() {
   var login=document.getElementById("loginusuario").value;
   var pri=document.getElementById("prinom").value;
   var ape=document.getElementById("apepat").value;
   
	   if(login=="" || pri=="" || ape==""){
		   alert ("Debe ingresar como minimo el usuario, primer nombre y el apellido paterno del usuario");
		   return false;
	   }else{
		   document.frmusuario.submit();
		   return true;
	   }

	   
   }
   
   
</script>

<link rel="stylesheet" href="css/uniform.default.css" type="text/css" media="screen">
<link rel="stylesheet" type="text/css" href="tcal.css" />
	<script type="text/javascript" src="tcal.js"></script> 

<style type="text/css">
<!--
.titus3 {
	font-family: Calibri;
	font-size: 22px;
	font-style: italic;
	color: #333333;
}
-->
</style>
<style type="text/css">
<!--
.camposss {font-family: Calibri;  font-size: 13px; color: #333333; }
.titus33 {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 11px;
	
}
.titus34 {
	font-family:Verdana, Geneva, sans-serif;
	font-size: 9px;
	
}
-->
</style>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.titusss {
	font-family: Calibri;
	font-size: 15px;
	color: #333333;
	font-weight: bold;
}

div.newusu
{ 
  background-color: #ffffff;
border: 4px solid #264965;  

-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:900px; height:250px;
}


.titus2 {color: #FFA41C}

div.buscar{ width:620px; height:420px;
 background-color: #264965;
border: 4px solid #264965;
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;  }

div.mante{ width:310px; height:420px;
background-color: #264965;
border: 4px solid #264965;
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;  } 


.Estilo22 {
	color: #FFA41C;
	font-family: Calibri;
	font-size: 22px;
	font-style: italic;
}
.Estilo23 {color: #264965}
.titumante {color: #FFA41C; font-family: Calibri; font-size: 18px; font-style: italic; }

.editcam {
	font-family: Calibri;
	font-size: 15px;
	font-style: italic;
	font-weight: bold;
	color: #FF9900;
}
.editcampp {font-family: Calibri; font-style: italic; font-size: 14px; color: #FFFFFF; }
.editcampos {color: #FFFFFF}
-->
</style>
</head>

<body>
<table width="959" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="623" height="28">&nbsp;</td>
    <td width="14">&nbsp;</td>
    <td width="322">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><div class="newusu" id="newusu"><form id="frmusuario" name="frmusuario" method="post"  action="grabar_usuarios.php" >
  <table width="900" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="34" height="36" bgcolor="#264965"><img src="iconos/newusuario.png" width="31" height="30" /></td>
      <td width="916" bgcolor="#264965"><span class="titus3 titus2">Crear Nuevo Usuario</span></td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td><table width="777" border="0" cellspacing="0" cellpadding="0">

        <tr>
          <td width="110" height="45" valign="bottom"><span class="camposss">Usuario : </span></td>
          <td width="251" height="45" valign="bottom"><span id="sprytextfield1">
            <label>
            <input name="loginusuario" type="text" id="loginusuario" style="text-transform:uppercase;"  onchange="verifiuser()" maxlength="50" onKeyPress="return soloLetras(event)" />
            </label>
            <span class="textfieldRequiredMsg"><span class="titus33">Obligatorio</span>.</span></span><div id="comprobar" style="width:100px; font:Calibri; font-size:11px; color:#FF3300;"></div></td>
          <td width="30" rowspan="6" align="center" valign="middle"><img src="iconos/separadorrusu.jpg" width="10" height="162" /></td>
          <td width="97" height="45" valign="bottom" class="camposss">Contraseña : </td>
          <td height="45" colspan="2" valign="bottom"><span id="sprytextfield2">
            <label>
            <input name="password" type="password" id="password" style="text-transform:uppercase;" maxlength="30" />
            </label>
            <span class="textfieldRequiredMsg"><span class="titus33">Obligatorio</span>.</span></span></td>
        </tr>
        <tr>
          <td height="27"><span class="camposss">Ape. Paterno : </span></td>
          <td height="27"><span id="sprytextfield3">
            <label>
            <input name="apepat" type="text" id="apepat" style="text-transform:uppercase;" maxlength="100" onKeyPress="return soloLetras(event)" />
            </label>
            <span class="textfieldRequiredMsg"><span class="titus33">Obligatorio.</span></span></span></td>
          <td height="27" class="camposss">Ape. Materno : </td>
          <td height="27" colspan="2"><span id="sprytextfield4">
            <label>
            <input name="apemat" type="text" id="apemat" style="text-transform:uppercase;" maxlength="100" onKeyPress="return soloLetras(event)" />
            </label>
            <span class="textfieldRequiredMsg"><span class="titus33">Obligatorio</span>.</span></span></td>
        </tr>
        <tr>
          <td height="28"><span class="camposss">1º Nombre</span> : </td>
          <td height="28"><span id="sprytextfield5">
            <label>
            <input name="prinom" type="text" id="prinom" style="text-transform:uppercase;" maxlength="100" onKeyPress="return soloLetras(event)" />
            </label>
            <span class="textfieldRequiredMsg"><span class="titus34"><span class="titus33">Obligatorio</span></span>.</span></span></td>
          <td height="28" class="camposss">2º Nombre : </td>
          <td width="210" height="28"><label>
            <input name="segnom" type="text" id="segnom" style="text-transform:uppercase;" maxlength="100" onKeyPress="return soloLetras(event)" />
          </label></td>
          <td width="79"><input type="button" name="button"  id="button"  onclick="valida()" value="Grabar" /></td>
        </tr>
        <tr>
          <td height="28"><span class="camposss">Fecha de Naci. : </span></td>
          <td height="28"><label>
            <input name="fecnac" id="fecnac" type="text" size="20" maxlength="10" />
          </label></td>
          <td height="28" class="camposss">Teléfono : </td>
          <td height="28"><span id="sprytextfield6">
          <label>
          <input name="telefono" type="text" id="telefono" onKeyPress="return validar(event)" size="15" maxlength="15" />
          </label>
          <span class="textfieldInvalidFormatMsg titus34">Solo Números</span></span></td>
          <td height="28"><input type="reset" name="button2" id="button2" value="Limpiar" /></td>
        </tr>
        <tr>
          <td height="28"><span class="camposss">Domicilio :</span></td>
          <td height="28"><label>
            <input name="domicilio" type="text" id="domicilio" style="text-transform:uppercase;" onKeyPress="return soloLetras(event)" size="35" maxlength="100" />
          </label></td>
          <td height="28" class="camposss">Cargo : </td>
          <td height="28" colspan="2"><label>
          <select name="idcargo" id="idcargo">
            <?php
	       while($row2 = mysql_fetch_array($sql)){
	         echo "<option value=".$row2['idcargo'].">".$row2['descargo']."</option> \n";
             }
	     ?>
          </select>
          </label></td>
        </tr>
        <tr>
        <td height="28" class="camposss">DNI : </td>
          <td width="210" height="28"><label>
            <input name="dni" type="text" id="dni" style="text-transform:uppercase;" maxlength="100" />
          </label></td>
        </tr>
        <tr>
          <td height="28">&nbsp;</td>
          <td height="28"><label></label></td>
          <td height="28">&nbsp;</td>
          <td height="28" colspan="2">&nbsp;</td>
        </tr>
        

              </table></td>
    </tr>
  </table>
</form>
</div></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div class="buscar" id="buscar">
      <table width="619" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="19" height="32"><img src="iconos/users.png" width="31" height="30" /></td>
          <td width="600"><span class="Estilo22">Listado de Usuarios</span></td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#FFFFFF"></td>
          </tr>
        <tr>
          <td height="12" colspan="2" bgcolor="#FFFFFF"><table width="595" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td width="595"></td>
            </tr>
            <tr>
              <td></td>
            </tr>
            <tr>
              <td></td>
            </tr>
            <tr>
              <td></td>
            </tr>
            <tr>
              <td></td>
            </tr>
            <tr>
              <td></td>
            </tr>
            <tr>
              <td></td>
            </tr>
            <tr>
              <td></td>
            </tr>
            <tr>
              <td height="19" bgcolor="#FFFFFF"><table width="569" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
                  <tr>
                    <td width="160" height="40" align="center" bgcolor="#D6D6D6" class="titusss">Apellidos y Nombres</td>
                    <td width="102" align="center" bgcolor="#D6D6D6" class="titusss">Tipo Usuario</td>
                    <td width="85" align="center" bgcolor="#D6D6D6" class="titusss">Usuario</td>
                    <td width="67" align="center" bgcolor="#D6D6D6" class="titusss">Estado</td>
                    <td width="143" align="center" bgcolor="#D6D6D6" class="titusss">Mantenimiento</td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td height="11" bgcolor="#FFFFFF"><div id="resultado" style="width:595px; height:300px; overflow:auto;">
                  <?php 
include("conexion.php");


$consulta = mysql_query("SELECT * FROM usuarios", $conn) or die(mysql_error());
echo "<table width='568' border='1' cellpadding='0' cellspacing='0' bordercolor='#CCCCCC'>";
while($row = mysql_fetch_array($consulta)){
echo "
  <tr> 
    <td width='160' height='31' class='titus34'>".strtoupper($row['apepat']." ".$row['apemat'].",".$row['prinom']." ".$row['segnom'])."</td>
    <td width='102' align='center' class='titus34'>";

     $cargos="select * from cargousu where idcargo='".$row['idcargo']."'";
     $rpta = mysql_query($cargos, $conn) or die(mysql_error());
     $row3 = mysql_fetch_array($rpta);
     echo $row3['descargo'];


echo"</td> 
    <td width='85' align='center' class='titus34'>".$row['loginusuario']."</td>
    <td width='67' align='center' class='titus34'>"; if ($row['estado']==0)
	{echo "Inhabilitado";}else{echo "Habilitado";} echo "</td>
    <td width='34' align='center'>"; if ($row['estado']==0)
	{echo "<a href='activar_usu.php?idusu=".$row['idusuario']."'><img src='iconos/desbloquear.png' title='Desbloquear Usuario' width='34' height='36' border='0' /></a>";}else{echo "<a href='bloquear_usu.php?idusu=".$row['idusuario']."'><img src='iconos/bloquear.png' title='Bloquear Usuario' width='34' height='36' border='0' /></a>";} echo "</td>
    <td width='34' align='center'><a href='#' onmouseover='seleccion(".$row['idusuario'].")' onClick='editar()'><img src='iconos/editar.jpg' width='51' title='Editar Usuario' height='36' border='0' /></a></td>
    
    <td width='51' align='center'><a href='#' onmouseover='seleccion3(".$row['idusuario'].")' onClick='clave()'><img src='iconos/clave.jpg' width='34' height='36' border='0' title='Cambiar Clave' /></a></td>
  </tr>
";
}
echo "</table>";

?>
              </div></td>
            </tr>
            <tr>
              <td height="12" bgcolor="#FFFFFF">&nbsp;</td>
            </tr>
          </table></td>
          </tr>
      </table>
    </div></td>
    <td>&nbsp;</td>
    <td><div class="mante" id="mante">
      <table width="315" height="416" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="34" height="35"><img src="iconos/herramientas.png" width="31" height="30" /></td>
          <td width="276"><span class="titumante">Mantenimiento</span></td>
        </tr>
        <tr>
          <td height="381" colspan="2" valign="top"><table width="309" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="12">&nbsp;</td>
              <td width="297"><div id="resultado2" style="width:290px"></div></td>
            </tr>
          </table></td>
          </tr>
      </table>
    </div></td>
  </tr>
</table>
<form id="frmusu" name="frmusu"  method="post" style="visibility:;" action="">
     <input type="hidden" name="idusu" id="idusu" />
</form>
<form id="frmpremiso" name="frmpremiso"  method="post" style="visibility:;" action="">
     <input type="hidden" name="idusu2" id="idusu2" />
</form>
<form id="frmclave" name="frmclave"  method="post" style="visibility:;" action="">
     <input type="hidden" name="idusu3" id="idusu3" />
</form>
  <script type="text/javascript">
<!--
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "integer", {validateOn:["change"], isRequired:false});
//-->
</script>
</body>

</html>
