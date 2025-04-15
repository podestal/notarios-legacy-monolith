<?php 
session_start();

if (empty($_SESSION["id_usu"])) 
  {
    ?>
		<script type="text/javascript">window.location="index.php"; </script> 
<?php  
  }
include("conexion.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="JavaScript" type="text/javascript"  src="ajax3.js"></script>
<script src="jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="jquery.uniform.js" type="text/javascript" charset="utf-8"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
      $(function(){
        $("input, textarea, select, button").uniform();
      });
    </script>
<script type="text/javascript">
</script>
<link rel="stylesheet" href="css/uniform.default.css" type="text/css" media="screen">
<link rel="stylesheet" type="text/css" href="tcal.css" />
	<script type="text/javascript" src="tcal.js"></script> 
    <script type="text/javascript">
function seleccion(id) {
   document.frmusu.idusu.value=id;
   }
   </script>
   
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
.camposss {font-family: Calibri; font-style: italic; font-size: 14px; color: #333333; }
.titus33 {
	font-family: Calibri;
	font-size: 11px;
	font-style: italic;
}
.titus34 {
	font-family: Calibri;
	font-size: 11px;
	font-style: italic;
}
-->
</style>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.titusss {
	font-family: Calibri;
	font-size: 16px;
	font-style: italic;
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
width:950px; height:250px;
}


.titus2 {color: #FFA41C}

div.buscar{ width:950px; height:420px;
 background-color: #264965;
border: 4px solid #264965;
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;  }

div.mante{ width:620px; height:420px;
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
div.buscar1 {width:950px; height:420px;
 background-color: #264965;
border: 4px solid #264965;
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;  }
div.buscar11 {width:950px; height:420px;
 background-color: #264965;
border: 4px solid #264965;
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;  }
-->
</style>
</head>

<body>

<table width="868" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="868"><div class="buscar11" id="buscar">
        <table width="950" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="322" height="32"><span class="Estilo22">Listado de Actos</span></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF"><form id="frmbuacto" name="frmbuacto" method="post" action="">
              <table width="925" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="237" height="27" bgcolor="#FFFFFF" class="camposss"><strong>Busquedas por:</strong></td>
                  <td width="488" bgcolor="#FFFFFF">&nbsp;</td>
                </tr>
                <tr>
                  <td height="28" bgcolor="#FFFFFF" class="camposss">Nombre de Acto:</td>
                  <td height="28" bgcolor="#FFFFFF"><input style="text-transform:uppercase;" name="acto" type="text" id="acto" onKeyPress="buscaacto()" size="50" />
                          <label></label></td>
                </tr>
                <tr>
                  <td height="7" colspan="2" bgcolor="#FFFFFF" class="camposss"><label><span class="camposss Estilo23">_______________________________________________________________________________________________</span></label></td>
                </tr>
                <tr>
                  <td height="19" colspan="2" valign="top" bgcolor="#FFFFFF" class="camposss Estilo23">&nbsp;</td>
                </tr>
              </table>
            </form></td>
          </tr>
          <tr>
            <td height="12" bgcolor="#FFFFFF"><table width="925" border="0" align="center" cellpadding="0" cellspacing="0">
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
                <td height="19" bgcolor="#FFFFFF"><table width="916" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
                  <tr>
                    <td width="89" height="40" align="center" bgcolor="#D6D6D6" class="titusss">Tipo de Kardex</td>
                    <td width="175" align="center" bgcolor="#D6D6D6" class="titusss">Nombre de Acto</td>
                    <td width="67" align="center" bgcolor="#D6D6D6" class="titusss">Umbral</td>
                    <td width="88" align="center" bgcolor="#D6D6D6" class="titusss">Impuestos</td>
                    <td width="88" align="center" bgcolor="#D6D6D6" class="titusss">idcalnot</td>
                    <td width="88" align="center" bgcolor="#D6D6D6" class="titusss">idecalreg</td>
                    <td width="88" align="center" bgcolor="#D6D6D6" class="titusss">Modelo</td>
                    <td width="216" align="center" bgcolor="#D6D6D6" class="titusss">Mantenimiento</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="11" bgcolor="#FFFFFF"><div id="resultado" style="width:916
              px; height:230px; overflow:auto;"> </div></td>
              </tr>
              <tr>
                <td height="12" bgcolor="#FFFFFF">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
        </table>
      </div></td>
    </tr>
</table>
  
  <p></p>
  <div class="newusu" id="newusu"><form id="frmnewacto" name="frmnewacto" method="post" action="grabar_usuarios.php">
  <table width="934" align="center" border="1" cellspacing="0" cellpadding="0">
    <tr><td><table width="868" border="0" cellspacing="0" cellpadding="0"><tr><td height="28">
    <table width="932" border="0" cellspacing="0" cellpadding="0">
  <tr>
          <td width="10" height="36" bgcolor="#264965">&nbsp;</td>
          <td width="922" bgcolor="#264965"><span class="titus3 titus2">Crear Acto</span></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><table width="868" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="110" height="45" valign="bottom"><span class="camposss">Cod. Acto : </span></td>
                <td width="251" height="45" valign="bottom"><span id="sprytextfield1">
                  <label></label>
                  <span class="textfieldRequiredMsg"><span class="titus33">
                  <input type="text" name="codsunat2" style="text-transform:uppercase;" id="codsunat2" value="<?php echo $row['idtipoacto']; ?>" />
                  Obligatorio</span>.</span></span></td>
                <td width="30" rowspan="6" align="center" valign="middle"><img src="iconos/separadorrusu.jpg" width="10" height="162" /></td>
                <td width="101" height="45" valign="bottom" class="camposss">Umbral : </td>
                <td height="45" colspan="2" valign="bottom"><span id="sprytextfield2">
                 <label>
                  <input type="text" name="umbral" id="umbral" value="<?php echo $row['umbral']; ?>"  />
                  </label>
                  <span class="textfieldRequiredMsg"><span class="titus33">Obligatorio</span>.</span></span></td>
              </tr>
              <tr>
                <td height="27"><span class="camposss">Cod. Sunat: </span></td>
                <td height="27"><span id="sprytextfield3">
                  <label>
                  <input type="text" name="codacto" style="text-transform:uppercase;" id="codacto" value="<?php echo $row['actosunat']; ?>" />
                  </label>
                  <span class="textfieldRequiredMsg"><span class="titus33">Obligatorio.</span></span></span></td>
                <td height="27" class="camposss">Impuestos : </td>
                <td height="27" colspan="2"><span id="sprytextfield4">
                  <label>
                  <input type="text" style="text-transform:uppercase;" name="impuestos" id="impuestos" value="<?php echo $row['impuestos']; ?>" />
                  </label>
                  <span class="textfieldRequiredMsg"><span class="titus33">Obligatorio</span>.</span></span></td>
              </tr>
              <tr>
                <td height="28"><span class="camposss">Cod. UIF</span> : </td>
                <td height="28"><span id="sprytextfield5">
                  <label>
                  <input type="text" name="coduif" style="text-transform:uppercase;" id="coduif" value="<?php echo $row['coduif']; ?>" />
                  </label>
                  <span class="textfieldRequiredMsg"><span class="titus34"><span class="titus33">Obligatorio</span></span>.</span></span></td>
                <td height="28" class="camposss">Calculo Notarial : </td>
                <td width="206" height="28"><label>
                  <input type="text" name="calnotarial" id="calnotarial" style="text-transform:uppercase;" value="<?php echo $row['calnotarial']; ?>" />
                </label></td>
                <td width="170"><input type="submit" name="button" id="button" value="Grabar" /></td>
              </tr>
              <tr>
                <td height="28"><span class="camposss">Cod. Kardex : </span></td>
                <td height="28"><label><span style="width:100px; font:Calibri; font-size:11px; color:#FF3300;">
                  <select name="idtipkar" id="idtipkar">
                    <?php
	       while($row2 = mysql_fetch_array($sql)){
	         echo "<option value=".$row2['idtipkar'].">".$row2['nomtipkar']."</option> \n";
             }
	     ?>
                  </select>
                </span></label></td>
                <td height="28" class="camposss">Calculo Registral : </td>
                <td height="28"><span id="sprytextfield6">
                  <label>
                  <input name="calregistral" type="text" id="calregistral" size="15" value="<?php echo $row['calregistral']; ?>" />
                  </label>
                  <span class="textfieldInvalidFormatMsg titus34">Solo Números</span></span></td>
                <td height="28"><input type="submit" name="button2" id="button2" value="Limpiar" /></td>
              </tr>
              <tr>
                <td height="28"><span class="camposss">iNombre Acto:</span></td>
                <td height="28"><label>
                  <input type="text" name="desacto" style="text-transform:uppercase;" id="desacto" value="<?php echo $row['desacto']; ?>" />
                </label></td>
                <td height="28" class="camposss">Modelo : </td>
                <td height="28" colspan="2"><label>
                  <input name="modelo" type="text" id="modelo" size="15" value="<?php echo $row['modelo']; ?>" />
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
      </table></td>
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
