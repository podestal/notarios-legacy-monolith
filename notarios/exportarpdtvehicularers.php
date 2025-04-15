<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script src="jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="tcal3.js"></script>
<script language="javascript">
window.onload = function() {
vaciar_tablas();

}
</script>

<script type="text/javascript">
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

function fExportatxt()
		{
			desde=document.getElementById('desde').value;
		    hasta=document.getElementById('hasta').value;
			
			window.open('pdtescriAct.php?desde='+desde+'&hasta='+hasta);			
}


function fExportatxt2()
		{
			desde=document.getElementById('desde').value;
		    hasta=document.getElementById('hasta').value;
			
			window.open('pdtescriBie.php?desde='+desde+'&hasta='+hasta);
	
		}
function fExportatxt3()
		{
			desde=document.getElementById('desde').value;
		    hasta=document.getElementById('hasta').value;
			
			window.open('pdtescriOtg.php?desde='+desde+'&hasta='+hasta);
	
		}
		
function fExportatxt4()
		{
			desde=document.getElementById('desde').value;
		    hasta=document.getElementById('hasta').value;
			
			window.open('pdtescriMpa.php?desde='+desde+'&hasta='+hasta);	
		}		
		
		
function fExportatxt5()
		{
			desde=document.getElementById('desde').value;
		    hasta=document.getElementById('hasta').value;
			
			window.open('pdtescriFor.php?desde='+desde+'&hasta='+hasta);	
		}			
		
		
	function CreateObjectAjax(){
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
////////////////////////////////////////////////////////////
function AjaxReturn(url,_nom){
	      
		  desde=document.getElementById('desde').value;
		  hasta=document.getElementById('hasta').value;
		  ajax=CreateObjectAjax();
		  var _pag = '';
		    ajax.open('GET', url,true);
		    ajax.onreadystatechange = function(){
		    if(ajax.readyState == 4 && ajax.status==200)
			{
				if(ajax.responseText=='' )
					{
						// window.open('pdtescriAct.php?desde='+desde+'&hasta='+hasta);
						//window.open('pdtescriBie.php?desde='+desde+'&hasta='+hasta);
						//window.open('pdtescriOtg.php?desde='+desde+'&hasta='+hasta);
						//window.open('pdtescriMpa.php?desde='+desde+'&hasta='+hasta);
						//window.open('pdtescriFor.php?desde='+desde+'&hasta='+hasta);
					}
		     _pag = ajax.responseText;
			 //obj.innerHTML = _pag;
		    }
		  }
	  ajax.send(null);
	}
// JavaScript Document


function exportar(){
	
	//document.bie.submit();
	//document.act.submit(); 
	
}
<!---function pasarvariable(){
	
	//A=document.act.desde.value
	//document.bie.desdebie.value=A;
	
	//B=document.act.hasta.value
	//document.bie.hastabie.value=B;
//}-->


function fExportatxtBIE()
		{
			desde=document.getElementById('desde').value;
		    hasta=document.getElementById('hasta').value;

				window.open('pdtescriBie.php?desde='+desde+'&hasta='+hasta);

		}

function fExportatxtOTG()
		{
			desde=document.getElementById('desde').value;
		    hasta=document.getElementById('hasta').value;

				window.open('pdtescriOtg.php?desde='+desde+'&hasta='+hasta);

		}

function fExportatxtMPA()
		{
			desde=document.getElementById('desde').value;
		    hasta=document.getElementById('hasta').value;

				window.open('pdtescriMpa.php?desde='+desde+'&hasta='+hasta);

		}
		
function fExportatxtFOR()
		{
			desde=document.getElementById('desde').value;
		    hasta=document.getElementById('hasta').value;

				window.open('pdtescriFor.php?desde='+desde+'&hasta='+hasta);

		}
		
function vaciar_tablas(){
	//var divResultado = document.getElementById('resultado');
	var paterno      = "1";

	ajax=objetoAjax();
	ajax.open("POST", "borrar_tablas.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
			reiniciar();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("paterno="+paterno)
}

function mostrar_desc(objac)
		{
		
		if(document.getElementById(objac).style.display=="none")
		document.getElementById(objac).style.display=""
		else
		document.getElementById(objac).style.display="";
		}
		

function ocultar_desc(objac2)
		{
		
		if(document.getElementById(objac2).style.display=="")
		document.getElementById(objac2).style.display="none";
		else
		document.getElementById(objac2).style.display="none";
		}	

function carga_pdt(){
	var divResultado = document.getElementById('estado');
	var fecha_de= document.getElementById('desde').value;
	var fecha_ha=document.getElementById('hasta').value;

	ajax=objetoAjax();
	ajax.open("POST", "cargar_data_pdt.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
			ocultar_desc('gen_archi');
			mostrar_desc('gen_archi2');
			vaciar_tablas();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fecha_de="+fecha_de+"&fecha_ha="+fecha_ha)
	}


function reiniciar(){
	
	var divResultado = document.getElementById('estado');
	var numdoc2      = "";

	ajax=objetoAjax();
	ajax.open("POST", "mantenimiento/view/reiniciar_data.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
			ocultar_desc('gen_archi2');
			mostrar_desc('gen_archi');
			vaciar_tablas();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("numdoc2="+numdoc2)
	}
	
</script>

<style type="text/css">
div.frmprotocolar
{ 
  background-color: #ffffff;
border: 4px solid #264965;  

-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:900px; height:200px;
}

.titulosprincipales {
	font-family: Calibri;
	font-size: 18px;
	color: #FF9900;
	font-style: italic;
}
.line {color: #FFFFFF}
</style>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body onload="vaciar_tablas();">
<div class="frmprotocolar">
  <table width="900" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="30" bgcolor="#264965"><table width="900" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="33" height="30"><img src="iconos/newproto.png" alt="" width="26" height="26" /></td>
          <td width="328"><span class="titulosprincipales">PDT Escrituras</span></td>
          <td width="510" align="left">&nbsp;</td>
          <td width="29">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="19"></td>
    </tr>
    <tr>
      <td align="center"><form id="act" name="act" method="post" action="pdtescriAct.php" target="_blank">
        <table width="740" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="6"><span style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#036;"><strong>Seleccione fecha para exportar</strong></span></td>
            </tr>
          <tr>
            <td width="65">&nbsp;</td>
            <td width="143">&nbsp;</td>
            <td width="63">&nbsp;</td>
            <td width="153">&nbsp;</td>
            <td colspan="2" rowspan="4"><div id="gen_archi"><input type="button" name="button" id="button" value="Reiniciar Carga..!!!" / onclick="reiniciar();">
              <input type="button" name="button2" id="button2" value="Cargar Data..!!!" / onclick="carga_pdt();" /></div><div id="gen_archi2" style="display:none">
                <table width="228" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="118"><input type="button" name="button3" id="button3" value="1 Exportar ACT" onclick="fExportatxt()" /></td>
                    <td width="110"><input type="button" name="button4" id="button4" value="4 Exportar MPA" onclick="fExportatxt4()" /></td>
                  </tr>
                  <tr>
                    <td><input type="button" name="button3" id="button4" value="2 Exportar BIE" onclick="fExportatxt2()" /></td>
                    <td><input type="button" name="button5" id="button5" value="5 Exportar FOR" onclick="fExportatxt5()" /></td>
                  </tr>
                  <tr>
                    <td><input type="button" name="button3" id="button5" value="3 Exportar OTG" onclick="fExportatxt3()" /></td>
                    <td><input type="button" name="button6" id="button6" value="Reiniciar Carga..!!!" / onclick="reiniciar();" /></td>
                  </tr>
                </table>
              </div></td>
            </tr>
          <tr>
            <td><span style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#036;">Desde</span></td>
            <td><span id="fechadesdeeee">
              <input type="text" class="tcal"  name="desde" id="desde"  size="18" value="" />
              </td>
            <td><span style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#036;">Hasta</span></td>
            <td>
              <input type="text" class="tcal"  name="hasta" id="hasta"  size="18" value=""  />
            </td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4"><div id="estado" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#036; display:; font:bold;"></div></td>
            </tr>
          <tr>
            <td height="19" colspan="6">&nbsp;</td>
            </tr>
        </table>
      </form></td>
    </tr>
  </table>
</div>

</body>
</html>
