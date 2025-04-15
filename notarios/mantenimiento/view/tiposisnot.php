<?php
	include("../../conexion.php");
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	 ;
	$oBarra = new BarraMenu() 				     ;
	$Grid1 = new GridView()					     ;
	$oCombo = new CmbList()  				     ;	
	
	mysql_query("truncate kardex_ro",$conn);
	
	
	$consulta_config=mysql_query("SELECT * FROM tb_control WHERE c_c_control ='10001'", $conn) or die(mysql_error());
	$row_config = mysql_fetch_array($consulta_config);
    $unico_multiple=$row_config["c_valor"];
	$banco=$row_config["c_banco"];

	$consulta_config2=mysql_query("SELECT * FROM tb_control WHERE c_c_control ='10002'", $conn) or die(mysql_error());
	$row_config2 = mysql_fetch_array($consulta_config2);
    $reinicio=$row_config2["c_valor"];

	
	
	
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
<script type="text/javascript" src="func_ini_sisnot.js"></script>

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

-moz-border-radius: 5px;
-webkit-border-radius: 5px;
border-radius: 5px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:550px; height:300px;
float:left;
margin-left:30%;
margin-top:10px;
}

.titulosprincipales {
	font-family: Verdana;
	font-size: 14px;
	color: #F90;
	font-style: italic;	
}
.line {color: #FFFFFF}

<!--
.Estilo7 {font-family: Calibri; font-size: 13px; font-style: italic; }
.Estilo14 {font-family: Calibri; font-size: 12px; color: #333333; font-weight: bold; }
.Estilo12 {font-family: Calibri; font-size: 12px; color: #333333; font-style: italic; }
-->
.camposss {font-family: Verdana; font-size: 11px; color: #333333; }
body{ font-family: Arial, Helvetica, sans-serif; font-size:12px; font-weight: bold; margin-bottom:50px;}
.cajas{ margin-bottom:25px;}
</style>
</head>

<body  style="font-size:62.5%;">
<div class="div_genkar">
  <table width="553" height="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="553" height="30" bgcolor="#264965"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="22" height="30">&nbsp;</td>
          <td width="516" align="center" valign="middle"><span class="titulosprincipales">Configuración Inicial SISNOT</span></td>
          <td width="20">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
      <td valign="top">
            <table width="550" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="4"></td></tr>
              <tr>
                <td height="22" colspan="2" align="right" bgcolor="#FFFFFF" >&nbsp;</td>
                <td height="28" colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
              </tr>
              <tr>
                <td width="56" height="33" align="right" bgcolor="#FFFFFF" >
			<input id="ini_sisnot"  name="ini_sisnot" type="checkbox" value="1" 
            <?php
			if($unico_multiple=='1'){
				echo "checked='checked'";
			}
			?>
             class="Estilo7" style="width:30px"/>
				
				</td>
                      <td width="244" align="left" bgcolor="#FFFFFF" ><span class="camposss">Multiple - On / Unico - Off </span></td>
                      <td width="38" height="33" align="right" bgcolor="#FFFFFF">

					  <input id="ini_correlativo"  name="ini_correlativo" type="checkbox" value="1" 
                        <?php
		            	if($reinicio=='1'){
			          	echo "checked='checked'";
		             	}
		            	?>
                        class="Estilo7" style="width:30px"/>

					  
					  </td>
                      <td width="219" bgcolor="#FFFFFF"><span class="camposss">Reincia Correlativo  </span></td>
              </tr>
         
              <tr>
                <td height="34" align="right" bgcolor="#FFFFFF" >

				<input id="ini_banco"  name="ini_banco" type="checkbox" value="1" 
            <?php
			if($banco=='1'){
				echo "checked='checked'";
			}
			?>
             class="Estilo7" style="width:30px"/>

				</td>
                <td height="34" align="left" bgcolor="#FFFFFF" ><span class="camposss">Bancos (Solo funciona con Multiple) </span></td>
                <td height="34" align="right" bgcolor="#FFFFFF">&nbsp;</td>
                <td height="34" bgcolor="#FFFFFF">&nbsp;</td>
              <tr>
                <td height="94" colspan="4" align="center" valign="bottom">
                  <table width="540" border="0" align="center" cellpadding="1" cellspacing="1">
                    <tr>
                      <td width="540" height="74" align="center" valign="middle"><div id="message" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#036;" >&nbsp;</div></td>
                    </tr>
                  </table>				</td>
              </tr>
             
              <tr>
              <td height="97" colspan="4" align="center"  ><button  type="u" name="reiniciar"    id="reiniciar" value="" onClick="config_inicial();" >Grabar Cambios</button>                </td>
              </tr>
        </table>
        </td>
    </tr>
  </table>
</div>
</body>
</html>
