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
		 $("input, textarea").uniform();
		 $("button").button();
		 $("#dialog").dialog();
		 $(".ui-dialog-titlebar").hide();
	})
	
	function fShowRO()
	{
		var _desde    = document.getElementById('fec_desde').value;
		var _hasta    = document.getElementById('fec_hasta').value;
		var _idkardex = document.getElementById('id_kardex').value;
		
		window.open('../includes/reportUIFscreen.php?idkardex='+_idkardex+'&fDesde='+_desde+'&fHasta='+_hasta);			
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
body{ font-family: Arial, Helvetica, sans-serif; font-size:12px; font-weight: bold; margin-bottom:50px;}
.cajas{ margin-bottom:25px;}
</style>
</head>

<body style="font-size:62.5%;">
<div class="div_genkar">
  <table width="100%" height="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="30" bgcolor="#264965"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="33" height="30"><img src="iconos/newproto.png" alt="" width="26" height="26" /></td>
          <td width="328"><span class="titulosprincipales">Informacion requerida para UIF</span></td>
          <td >&nbsp;</td>
          <td width="29">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
      <td valign="top"><form id="frmescri" name="frmescri" method="post" action="exportaro.php" >
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="2"></td></tr>
              <tr>
                <td width="184" height="22" align="right" ><span class="camposss">Desde : </span></td>
                
                
                      <td width="305" height="28"><span id="sprytextfield5">
                <label>
                  &nbsp;<input name="fec_desde" type="text" id="fec_desde" style="text-transform:uppercase; margin-left:15px;" size="10" value="<?php echo date("d/m/Y"); ?>" class="tcal" />
                  </label>
                <input name="id_kardex" type="hidden" id="id_kardex"  />
                </span></td>
                
                
                
              </tr>
         
              <tr>
                <td height="28" align="right"><span class="camposss">Hasta :</span></td>
                <td height="28"><span id="sprytextfield5">
                <label>
                  &nbsp;<input name="fec_hasta" type="text" id="fec_hasta" style="text-transform:uppercase; margin-left:15px;" size="10" value="<?php echo date("d/m/Y"); ?>" class="tcal" />
                  </label>
                </span></td>
                <tr>
                <td height="28" align="right"><span class="camposss"><!--Generar archivo Excel:--></span></td>
                <td height="28"><!--<input 
                class="tcal" type="checkbox" name="option1" value="excel" >--></td>
              </tr>
              <tr>
             
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
              <td align="right" ><button  type="s" name="generar"    id="generar" value="anadir" ><img src="../../images/success.png" width="14" height="14" align="absmiddle" /> Aceptar</button></td>
               <td align="left" style="margin-left:50px;" ><button    style="margin-left:15px;"type="submit" name="generar"    id="generar" value="anadir" onclick="" ><img src="../../images/success.png" width="14" height="14" align="absmiddle" /> Cancelar</button>
               </td>
              </tr>
          </table>
        </form></td>
    </tr>
  </table>
</div>
</body>
</html>
