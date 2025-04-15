<?php
	include("../../conexion.php");
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	 ;
	$oBarra = new BarraMenu() 				     ;
	$Grid1 = new GridView()					     ;
	$oCombo = new CmbList()  				     ;	
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Generar Bloque de Kardex</title>
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../includes/css/uniform.default.min.css" />
<link rel="stylesheet" type="text/css" href="../../tcal.css" />

<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/ext_script1.js"></script> 
<script src="../../includes/jquery-1.8.3.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script src="../../includes/jquery.uniform.min.js"></script>
<script src="../../includes/maskedinput.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 

<script type="text/javascript">
     $(document).ready(function(){ 
	 $("#div_genkar").dialog({height:300, width:400,position :["center","top"], style: "margin:0px; padding:0px; float:none;",  resizable:false,title:'Mantenimiento de Servicios'}); 
	 
			 $("input, textarea").uniform();
			 $("button").button();
			 $("#dialog").dialog();
			 $(".ui-dialog-titlebar").hide();
			 
	})

	function cerrar2(){ $("#div_genkar").dialog("close");	}	
	
	function fcrearBloque()
	{
		var _num_kinicial    = document.getElementById('num_kinicial');
		var _num_registros   = document.getElementById('num_registros');
		var _fec_ingreso     = document.getElementById('fec_ingreso');
		
		if(_num_kinicial.value=='' || _num_registros.value=='' ||_fec_ingreso.value=='')
		{alert('Falta ingresar datos');return;}
		
		fcreaBloqueKar();
	}

	function objetoAjax(){
		var xmlhttp=false;
		try {
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
			   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (E) {
				xmlhttp = false;
			}
		}
	
		if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
			xmlhttp = new XMLHttpRequest();
		}
		return xmlhttp;
	}

// CREA BLOQUES DE KARDEX (VARIOS KARDEX) DEACUERDO AL NUMERO DE KARDEX Y KARDEX INICIAL SELECCIONADOS
	function fcreaBloqueKar()
	{
		var _num_kinicial    = document.getElementById('num_kinicial').value;
		var _num_registros   = document.getElementById('num_registros').value;
		var _fec_ingreso     = document.getElementById('fec_ingreso').value;
		
		ajax=objetoAjax();
	
		ajax.open("POST", "../model/guardaBloquePoderes.php",true);	
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4 && ajax.status==200) {
				
				alert('Se guardo El Bloque de '+_num_registros+' Registros satisfactoriamente');
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("num_registros="+_num_registros+"&num_kinicial="+_num_kinicial+"&fec_ingreso="+_fec_ingreso);		
	}


</script>
<style type="text/css">
div.div_genkar
{ 
  background-color: #ffffff;
border: 4px solid #264965;  

-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:400px; height:200px;
float:left;
margin-left:30%;
margin-top:10px;
}

.titulosprincipales {
	font-family: Calibri;
	font-size: 18px;
	color: #FF9900;
	font-style: italic;
}
.line {color: #FFFFFF}

<!--
.Estilo7 {font-family: Calibri; font-size: 13px; font-style: italic; }
.Estilo14 {font-family: Calibri; font-size: 12px; color: #333333; font-weight: bold; }
.Estilo12 {font-family: Calibri; font-size: 12px; color: #333333; font-style: italic; }
-->
.camposss {font-family: Calibri; font-style: italic; font-size: 14px; color: #333333; }
</style>
</head>

<body style="font-size:62.5%;">
<div id="div_genkar" style="background-color: #ffffff;
border: 4px solid #264965;  
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:400; height:200;">
  <table width="100%" height="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="30" bgcolor="#264965"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="33" height="30"><img src="../../iconos/newproto.png" alt="" width="26" height="26" /></td>
          <td width="328"><span class="titulosprincipales">Generar Bloque para poderes</span></td>
          <td >&nbsp;</td>
          <td width="29"><a  onClick="cerrar2()" id="btncerrar" href="#"><img id="btncerrar" src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
        </tr>
      </table></td>
    </tr>
      <td valign="top"><form id="frmescri" name="frmescri" method="post" action="">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="2"></td></tr>

              <tr>
                <td height="22" align="right" ><span class="camposss">Nro  Inicial : </span></td>
                <td height="22" valign="bottom"><span class="sprytextfield1">
                    &nbsp;<input name="num_kinicial" type="text"  id="num_kinicial" style="text-transform:uppercase;" size="5" />
                </span></td>
              </tr>
              <tr>
                <td width="110" height="22" align="right" ><span class="camposss">Nro Final : </span></td>
                <td width="251" height="22" valign="bottom"><span id="sprytextfield1">
              <label></label>
                  <span class="textfieldRequiredMsg"><span class="titus33">
                  &nbsp;<input name="num_registros" type="text"  id="num_registros" style="text-transform:uppercase;" size="5" />
                  </span></span></span></td>
                
              </tr>

              <tr>
                <td height="28" align="right"><span class="camposss">Fec Ingreso </span>: </td>
                <td height="28"><span id="sprytextfield5">
                <label>
                  &nbsp;<input name="fec_ingreso" type="text" id="fec_ingreso" style="text-transform:uppercase;" size="10" value="<?php echo date("d/m/Y"); ?>" class="tcal" />
                  </label>
                </span></td>
              </tr>
              
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" colspan="2"><button  type="button" name="generar"    id="generar" value="anadir" onclick="fcrearBloque();" ><img src="../../images/success.png" width="14" height="14" align="absmiddle" /> Generar</button></td>
              </tr>
              <tr>
                <td align="center" colspan="2"><span class="camposss">Usar solo para la configuración Inicial del sistema</span></td>
              </tr>
          </table>
        </form></td>
    </tr>
  </table>
</div>
</body>
</html>
