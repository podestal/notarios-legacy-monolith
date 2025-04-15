<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script language="JavaScript" type="text/javascript" src="ajaxpass.js"></script>
<script type="text/javascript">

function cambiar_contra(){
	changepass();
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

function changepass(){
	//donde se mostrará el resultado
	//divResultado = document.getElementById('werwerwer');
	//tomamos el valor de la lista desplegable
	pass = document.getElementById('pass').value; 

	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST", "changepassword.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			alert('Contraseña actualizada satisfactoriamente');
			document.getElementById('pass').value ='';
			//mostrar resultados en esta capa
			//divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("pass="+pass)
}

	
	
</script>

<style type="text/css">
.Estilo22 {	color: #FFA41C;
	font-family: Calibri;
	font-size: 22px;
	font-style: italic;
}
.Estilo23 {color: #264965}
.camposss {font-family: Calibri; font-style: italic; font-size: 14px; color: #333333; }
.titusss {	font-family: Calibri;
	font-size: 16px;
	font-style: italic;
	color: #333333;
	font-weight: bold;
}
div.buscar {width:620px; height:135px;
 background-color: #264965;
border: 4px solid #264965;
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;  }
div.buscar1 {width:620px; height:135px;
 background-color: #264965;
border: 4px solid #264965;
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;  }
</style>
</head>

<body>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div class="buscar1" id="buscar">
      <table width="619" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="19" height="32"><img src="iconos/users.png" width="31" height="30" /></td>
          <td width="600"><span class="Estilo22">Cambiar Contraseña</span></td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#FFFFFF"><form id="frmpass" name="frmpass" method="post" action="">
            <table width="588" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="181" height="19" bgcolor="#FFFFFF" class="camposss">&nbsp;</td>
                <td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
              </tr>
              <tr>
                <td height="28" bgcolor="#FFFFFF" class="camposss"> Ingrese su nueva contraseña:</td>
                <td width="200" height="28" bgcolor="#FFFFFF"><input style="text-transform:uppercase;" name="pass" type="password" id="pass" size="30" /></td>
                <td width="207" bgcolor="#FFFFFF"><span class="camposss">
                  <input type="button" name="button" onclick="cambiar_contra()" id="button" value="Cambiar Contraseña" />
                </span></td>
              </tr>
              <tr>
                <td height="7" colspan="3" bgcolor="#FFFFFF" class="camposss">&nbsp;</td>
              </tr>
              <tr>
                <td height="7" colspan="3" valign="top" bgcolor="#FFFFFF" class="camposss Estilo23"><span class="camposss">
                  <label>_________________________________________________________________________________</label>
                </span></td>
              </tr>
            </table>
          </form></td>
        </tr>
        <tr>
          <td height="12" colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
</body>
</html>