<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="stylesglobal.css">
<script language="JavaScript" type="text/javascript" src="ajax.js"></script>
<script src="jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="jquery.uniform.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="css/uniform.default.css" type="text/css" media="screen">
<script type="text/javascript" charset="utf-8">
	  var j = jQuery.noConflict();
      j(function(){
        j("input, textarea, select, button").uniform();
      });
	  
	  
function limpiarnombre(){
	document.getElementById('nombre').value="";
	}
	
function limpiarkardex(){
	document.getElementById('num_kardex').value="";
	}
  function send(e){ 
     
     tecla = (document.all) ? e.keyCode : e.which;
       if (tecla==13){
     
     
       buscar_kardex4(1);} 
   } 
</script>
<script language="JavaScript" type="text/javascript" src="js/prototype.js" ></script>
<script language="JavaScript" type="text/javascript" src="ajax/protocolares/kardex.js" ></script>

<title>Protocolares - Kardex</title>
<style type="text/css">
<!--
.titubuskar {
	font-family: Calibri;
	font-size: 12px;
	font-weight: bold;
	font-style: italic;
	color: #003366;
}
.titubuskar0 {font-family: Calibri; font-size: 12px; font-style: italic; font-weight: bold; color: #333333; }
.titubuskar1 {color: #333333}
.reskar2 {font-family: Calibri; font-size: 13px; font-weight: bold; font-style: italic; color: #003366; }
.reskar {font-size: 12px; font-style: italic; color: #333333; font-family: Calibri;}
-->
</style>
</head>

<body onload="buscar_kardex4(1)">
<table width="858" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="781" height="32"><span class="reskar2">Busqueda Por:</span></td>
    <td width="79"> <div style="float:left; margin-left:20px; margin-top:0px; cursor:pointer;" title="Lista Ofac"><a onClick="window.open('http://www.treasury.gov/ofac/downloads/t11sdn.pdf', '_blank', 'toolbar=yes, scrollbars=yes, resizable=yes, top=300, left=800, width=600, height=600, location=0');" href="#"><img src="imagenes/ofac.jpg" width="23" height="23"/></a></div></td>
  </tr>
  <tr>
    <td colspan="2">
      <form id="frm_kardex" name="frm_kardex" method="post" action="">
      <table width="837" border="0" cellspacing="0" cellpadding="0">
         <tr>
           <td width="56"><span class="titubuskar0">N° Kardex:</span></td>
           <td width="107"><input id="num_kardex" name="num_kardex" type="text" size="12" maxlength="10"  onclick="limpiarnombre();" onKeyPress="send(event);"></td>
           <td><span class="titubuskar0">Nro.Doc</span></td>
            <td><input id="doi" name="doi" type="text" size="10"  style="border:solid 1px #069; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#036; text-transform:uppercase;" onKeyPress="send(event);"/></td>
		   <td width="51"><span class="titubuskar0">Nombre:</span></td>
       
           <td width="344"><input id="nombre" name="nombre" style="text-transform:uppercase; width:315px" type="text"  maxlength="200" onclick="limpiarkardex();" onKeyPress="send(event);"></td>
           <td width="75"><span class="titubuskar0">Nº Escr/Acta:</span></td>
           <td width="112"><input id="nroacta" name="nroacta" style="text-transform:uppercase; width:80px" type="text" maxlength="6" onkeypress="return isNumberKey(event)" onKeyPress="send(event);"></td>
           <td width="92"><a onclick="buscar_kardex4(1)"><img src="iconos/buscarclie.png" width="72" height="29" border="0" /></a></td>
         </tr>
      </table>
      </form>   
    </td>
  </tr>
  <tr>
    <td colspan="2">--------------------------------------------------------------------------------------------------------------------------------------------</td>
  </tr>
  <tr>
    <td colspan="2"><div id="gennn" style="width:860px; height:690px;">
      <table width="200" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><div id="lista_kardex"></div></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>

</body>
</html>



