<?php

require_once("../includes/barramenu.php") ;
require_once("../includes/gridView.php")  ;
$oBarra = new BarraMenu() 				  ;
$Grid1  = new GridView()				  ;

include("../../extraprotocolares/view/funciones.php");
$conexion = Conectar();
$sql_tipkar = "select idtipkar, nomtipkar from tipokar";
$exe_tipkar = mysql_query($sql_tipkar, $conexion);

?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>Mantenimiento de Plantillas</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>

<link href="../includes/scrollableFixedHeaderTable.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<!--<link rel="stylesheet" href="../../css/uniform.default.css" type="text/css" media="screen">-->

<!--<script type="text/javascript" src="../../librerias/jquery/external/jquery/jquery.js"></script>-->

<!--<script type="text/javascript" src="../../librerias/jquery/jquery-ui.js"></script>-->

<!--<script src="../../includes/js/jquery-1.9.0.js"></script>-->

<script src="../../Libs/jquery/jquery-3.1.0.min.js"></script>

<script src="../../includes/js/jquery-ui-notarios.js"></script>
<!--<script src="../../jquery.uniform.js" type="text/javascript" charset="utf-8"></script>-->	  

<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/jquery.scrollableFixedHeaderTable.js"></script>
<script language="JavaScript" type="text/javascript" src="../../ajax2.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/script1.js"></script>
<script language="JavaScript" type="text/javascript" src="../includes/ext_script1.js"></script>

<script type="text/javascript" src="../../js/prototype.js"></script>
<script type="text/javascript" src="../Ajax/plantilla.js" ></script>
<script type="text/javascript" src="../../librerias/scriptaculous/src/scriptaculous.js" ></script>

<style type="text/css">

div.menuactos {
	background:#333333;
	border: 1px solid #333333;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
	-moz-box-shadow: 0px 0px 7px #000000;
	-webkit-box-shadow: 0px 0px 7px #000000;
	box-shadow: 0px 0px 7px #000000;
	width:760px;
	height:220px;
	position:absolute;
	left: 400px;
	top: 182px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=50)"; /* expected to work in IE 8 */
	filter: alpha(opacity=50);   /* IE 4-7 */
	zoom: 1;

}
.titulomenuacto {
    font-family: Calibri;
    color: #FFFFFF;
    font-size: 14px;
    font-style: italic;
}

div.tipoacto{ width:740px; height:150px; overflow:auto;}

#field_remitente, #field_destinatario, #field_responpago, #field_diligencia, #field_cargo, #div_detfact{
	margin:0 auto;
	border: 2px solid #ddd; 
	border-radius: 10px; 
	padding: 2px; 
	box-shadow: #ccc 5px 0 5px;
	margin-bottom:0px;
	}

table.aatable {
	border-top: #333333 2px solid;
	border-left: #333333 2px solid;
	border-collapse: collapse;
	width: 100%;
padding: 1px 1px 1px 1px;

  font-size: 11px;
}
table.aatable th {

	border-right: #333333 2px solid;
	border-bottom: #333333 2px solid;
	background-color: #CCCCCC;
	padding: 3px 0px 3px 0px;
	text-align: center;
  font-size: 10px;
  font-family:Verdana, Geneva, sans-serif;
}
table.aatable td {
	/*border-right: #f5ebce 1px solid;
	border-bottom: #f5ebce 1px solid;*/
	border-right: #333333 2px solid;
	border-bottom: #333333 2px solid;
	padding-left:4px;
	color: #000000;
	/*vertical-align: top;*/
	padding:4px 2px 2px 2px;
	 font-size: 10px;
  font-family:Verdana, Geneva, sans-serif;

}
table.aatable td.label {
	border-right: #f5ebce 1px solid;
	border-bottom: #f5ebce 1px solid;
	background-color: #fffae8;
	border-right: #F69424 1px solid;
	border-bottom: #F69424 1px solid;
	background-color: #F69424;
	text-align:left;
	font-weight:500;		
}
table.aatable tr
{
height:12px;
}
table.aatable tr.tr0 td {
	background-color:#e3fdfb;
}
table.aatable tr.tr1 td {
	background-color:#fff;
}
table.aatable tr.trResaltado td {
	background-color:#fdeec5;
}

<!--
#title_client{
background-color: #ffffff;
border: 4px solid #264965;  
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;	
}
div.frmclientes
{ 
background-color: #ffffff;
border: 4px solid #264965;  
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:820px; height:750px;
}

.submenutitu {
	font-family: Calibri;
	font-size: 18px;
	font-style: italic;
	color:#FF9900;
}
#frmclientes{
	padding-bottom:0px;
	margin-bottom:0px;
	}
.GridPar
{
	border:0px;
	border-spacing:0px;
	border-collapse:0px;
	font:Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#300;
	cursor:pointer;
	background-color:#FFFFFF;
}
.GridImp
{
	border:0px;
	border-spacing:0px;
	border-collapse:0px;
	font:Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#300;
	cursor:pointer;
	background-color:#E8E8E8;
}
.GridCab
{
	font-size:17px;
	
	
}
<!-- end table -->

.line {color: #FFFFFF}
.titulosprincipales {	font-family: Calibri;
	font-size: 14px;
	color: #FF9900;
	font-style: italic;
}

.Estilo7 {font-family: Calibri; font-size: 13px; font-style: italic; }
.Estilo14 {font-family: Calibri; font-size: 12px; color: #333333; font-weight: bold; }
.Estilo12 {font-family: Calibri; font-size: 12px; color: #333333; font-style: italic; cursor:pointer; }
-->
</style>

</head>

<body style=" font-size:63.5%;" onLoad="listarPlantilla(1)">
<div id="frmtipkar" style="background-color: #ffffff;
border: 4px solid #264965;  
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:940px; height:650px;">
	<table id="title_client" width="100%" cellpadding="0" cellspacing="0" height="620">
 	  <tr>
            <td width="36" height="28" align="center" bgcolor="#264965"><img src="../../iconos/nuevo2.png" width="20" height="22" /></td>
            <td width="745" bgcolor="#264965"><span class="submenutitu">Gestor de Plantillas</span></td>
      </tr>
      <tr>
        	<td></td>
            <td height="46" >
            <div style="border: 1px solid #79B7E7; border-radius: 3px ; background-color:#DDECF7; padding:4px; width:63px; height:20px; cursor:pointer; margin-top:5px; float:left " title="Nuevo" onClick="showFrmAddTemplate()">
        <img src="../../images/new.png" width="20" height="20" /><span style="color:#3A7099; position:relative; left:5px; top:-5px";><B>NUEVO</B></span>
        </div>
            <div style="float:left; margin-left:20px; margin-top:8px; cursor:pointer;" title="Lista Ofac"><a onClick="window.open('http://www.treasury.gov/ofac/downloads/t11sdn.pdf', '_blank', 'toolbar=yes, scrollbars=yes, resizable=yes, top=300, left=800, width=600, height=600, location=0');" href="#"><img src="../../imagenes/ofac.jpg" width="23" height="23"/></a></div>
            </td>
      </tr>
      <tr height="40">
            <td colspan="2" valign="top">
            	<form id="frm_presentante" name="frm_presentante" method="post" >
                <fieldset id="field_remitente" style=" width:850px; margin-top:0px">
                <legend><span class="Estilo7">Buscar Plantilla</span>               </legend>
                <table width="830" height="42" border="0" cellpadding="0" cellspacing="0">
               		<tr>
                    	
                        <td>
                        <!--<input id="txtNumeroDocumento" name="numeroDocumento" type="text" maxlength="120" class="Estilo7" style="width:392px"/>-->
                        <select id="cmbSearchFkTypeKardex" name="cmbSearchFkTypeKardex">
                        	<option value="0">--Seleccion Kardex --</option>
                        	<?php
					            while($tip_kar = mysql_fetch_array($exe_tipkar)){ ?>
					              <option value="<?php echo $tip_kar["idtipkar"]; ?>"><?php echo $tip_kar["nomtipkar"]; ?></option>
					                    
					         <?php 
					            }
					         ?>
                        </select>
                        </td>
                        <td width="170">
                        	<span class="Estilo7" style="margin-left:5px">Nombre de la Plantilla</span>:
                        </td>
                        <td>
                        	<input type="text" name="txtSearchNameTemplate" id="txtSearchNameTemplate" size="30">
                        </td>
						<td width="112"><input type="button" value="Buscar" class="Estilo7" onClick="listarPlantilla(1)"/></td>
						<td width="112"><input type="button" value="Mostrar Todos" class="Estilo7" onClick="displayAllTemplate(1)"/></td>
                    </tr>
               </table>
               </fieldset>
               </form>
            </td>
    	</tr>
        <tr height="480">
            <td colspan="2" valign="top" align="center"><div id="list-plantilla" style="margin-top:10px"></div></td>
        </tr>
        
    </table>
   <div id="div_nplantilla" style=" display:none; position:absolute; top:160px; left:225px; width:580px; height:auto; border-radius:10px; -moz-border-radius: 10px;  border: black 1px solid; background-color:white; z-index:1 "></div>
     
   <div id="div_nconyugue" style=" display:none; position:absolute; top:240px; left:350px; width:580px; height:auto; border-radius:10px; -moz-border-radius: 10px;  border: black 1px solid; background-color:#D2E9FF; z-index:2 "></div>
  
   <div id="div_mplantilla" style=" display:none; position:absolute; top:160px; left:225px; width:580px; height:auto; border-radius:10px; -moz-border-radius: 10px;  border: black 1px solid; background-color:white; z-index:1 "></div>
    <div id="div_aplantilla" style=" display:none; position:absolute; top:160px; left:225px; width:580px; height:auto; border-radius:10px; -moz-border-radius: 10px;  border: black 1px solid; background-color:white; z-index:1 "></div>

</form>
</div>

<div id="div_login" style="background-color:#DDECF7; width:300px; height:auto; border-radius: 10px; border-color:#DDECF7; position:absolute; left:360px; top:220px; display:none"></div>

</body>
</html>
