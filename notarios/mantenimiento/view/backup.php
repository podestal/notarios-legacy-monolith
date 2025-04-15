<?php
	include("../../conexion.php");
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	 ;
	$oBarra = new BarraMenu() 				     ;
	$Grid1 = new GridView()					     ;
	$oCombo = new CmbList()  				     ;	
	
	//mysql_query("truncate kardex_ro",$conn);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Generar Backup de la Base de Datos</title>
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
<script type="text/javascript" src="backup.js"></script>

<script type="text/javascript">

     $(document).ready(function(){ 
		 $("input, textarea").uniform();
		 $("button").button();
		 $("#dialog").dialog();
		 $(".ui-dialog-titlebar").hide();
	})
	
	
	
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
width:400px; height:147px;
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
  <table width="400" height="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="400" height="30" bgcolor="#264965"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="28" height="30">&nbsp;</td>
          <td><span class="titulosprincipales">Generacion de  Backup de la Base de Datos</span></td>
          <td width="29">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
      <td valign="top">
            <table width="400" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="2"></td></tr>
              <tr>
                <td height="28" colspan="2" align="right" bgcolor="#FFFFFF" >&nbsp;</td>
              </tr>
                <td height="50" colspan="2" align="right"><span class="camposss"><!--Generar archivo Excel:--></span><!--<input 
                class="tcal" type="checkbox" name="option1" value="excel" >-->
                  <table width="314" border="0" align="center" cellpadding="1" cellspacing="1">
                    <tr>
                      <td width="310" align="center"><div id="message" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#036;">Listo para Crear Backup..!!!</div></td>
                    </tr>
                </table></td>
              </tr>
             
              <tr>
              <td height="40" colspan="2" align="center" bgcolor="#AECFF0" ><button  type="u" name="reiniciar"    id="reiniciar" value="" onClick="cargar_data();" >Crear Backup</button>  
              </td>
              </tr>
          </table>
        </td>
    </tr>
  </table>
</div>
</body>
</html>
