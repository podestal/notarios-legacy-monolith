<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<script src="../../includes/js/jquery-1.9.0.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>

<script type="text/javascript" src="../../js/prototype.js"></script>
<script type="text/javascript" src="../Ajax/abogado.js" ></script>
<script type="text/javascript" src="../../librerias/scriptaculous/src/scriptaculous.js" ></script>

<title>Certificado Domiciliario</title>
<style type="text/css">


.titulosprincipales {
	font-family: Calibri;
	font-size: 18px;
	color: #FF9900;
	font-style: italic;
}
.line {color: #FFFFFF}
.submenutitu {
	font-family: Calibri;
	font-size: 18px;
	font-style: italic;
	color:#FF9900;
}

</style>
</head>

<!--<script type="text/javascript">
$(document).ready(function(){ 

	$("#frmcartas").dialog({height:700, width:930,position :["center","top"], style: "margin:0px; padding:0px; float:none;",  resizable:false,title:'Mantenimiento de Servicios'}); 
		 $("button").button();
		 $("#dialog").dialog();
		 $(".ui-dialog-titlebar").hide();
	})
function cerrar2(){ $("#frmcartas").dialog("close");	}	
</script>-->

<body onload="listar_servicios(1)" >
<div id="frmcartas" style="background-color: #ffffff;
border: 4px solid #264965;  
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:900px; height:600px;">
  <table width="900" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="30" bgcolor="#264965"><table width="900" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="33" height="30"><img src="../../iconos/newproto.png" alt="" width="26" height="26" /></td>
          <td width="328"><span class="titulosprincipales">Mantenimiento de Abogados Externos</span></td>
          <td width="510" align="left"><table width="422" border="0" align="right" cellpadding="0" cellspacing="0">
            <tr>
              <td width="265" height="30">&nbsp;</td>
              <td width="69">
              	<img src="../../iconos/nuevo.png" width="62" height="22" border="0" onclick="nuevo_servicio()" style="cursor:pointer"/>
              </td>
              <td width="24"><span class="line">|</span></td>
              <td width="64"><a onClick="listar_servicios(1)" style="cursor:pointer"><img src="../../images/search.png" width="22" height="22" border="0" /></a></td>
              </tr>
          </table></td>
         <!-- <td width="29"><a  onClick="cerrar2()" id="btncerrar" href="#"><img id="btncerrar" src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>-->
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
    </tr>
    <tr>
      <td align="center">
      	  <div id="lst_servicios"></div>
      </td>
    </tr>
  </table>
  
       <div id="div_nservicio" style=" display:none; position:absolute; top:110px; left:195px; width:580px; height:auto; border-radius:10px; -moz-border-radius: 10px;  border: black 1px solid; background-color:white; z-index:1 "></div>
         
       <div id="div_mservicio" style=" display:none; position:absolute; top:110px; left:195px; width:580px; height:auto; border-radius:10px; -moz-border-radius: 10px;  border: black 1px solid; background-color:white; z-index:1 "></div>
  
</div>
</body>
</html>
