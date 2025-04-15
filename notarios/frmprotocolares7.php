<?php
session_start();
include("conexion.php");
$id_usuario= $_SESSION["id_usu"];
$sqlu  = mysql_query("SELECT * FROM permisos_usuarios where idusuario = '$id_usuario'",$conn) or die(mysql_error());

$rowu= mysql_fetch_array($sqlu);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
div.frmprotocolar
{ 
  background-color: #ffffff;
border: 4px solid #264965;  
width:100%; height:1050px;overflow:none;
}

.titulosprincipales {
	font-family: Verdana;
	font-size: 16px;
	color: #FFFFFF;
	
}
.line {color: #FFFFFF}


</style>

<script type="text/javascript">
<!--$(document).ready(function(){ -->

<!--cargakardex(0)-->
<!--});-->

function inconcluso(isChecked){
		//esta funcion chequea si el check esta chekqueado
	if(isChecked){

		document.getElementById('rangof1').value='';
		document.getElementById('rangof2').value='';	
		document.getElementById('radio7').value='';
		document.getElementById('inconcluso').value='1';
		document.getElementById('concluso').value='0';
		document.getElementById('concluso').checked='';
		
	}else{
		
		document.getElementById('inconcluso').value='0';
		
	}
		
}

function concluso(isChecked){
		//esta funcion chequea si el check esta chekqueado
	if(isChecked){
		document.getElementById('concluso').value='1';
		document.getElementById('inconcluso').value='0';
		document.getElementById('inconcluso').checked='';	
		document.getElementById('noescriturado').value='0';
		document.getElementById('noescriturado').checked='';
		document.getElementById('escriturado').value='0';
		document.getElementById('escriturado').checked='';	
	}else{
		document.getElementById('concluso').value='0';
	}		
}

function noescriturado(isChecked){
		//esta funcion chequea si el check esta chekqueado
	if(isChecked){
		document.getElementById('noescriturado').value='1';
		document.getElementById('escriturado').value='0';	
		document.getElementById('escriturado').checked='';	
		document.getElementById('concluso').value='0';
		document.getElementById('concluso').checked='';		
	}else{
		document.getElementById('noescriturado').value='0';
	}		
}

function escriturado(isChecked){
		//esta funcion chequea si el check esta chekqueado
	if(isChecked){
		document.getElementById('noescriturado').value='0';
		document.getElementById('escriturado').value='1';
		document.getElementById('noescriturado').checked='';			
	}else{
		document.getElementById('escriturado').value='0';
	}		
}

function pagado(isChecked){
		//esta funcion chequea si el check esta chekqueado
	if(isChecked){
		document.getElementById('pagado').value='1';
		document.getElementById('nopagado').value='0';	
		document.getElementById('nopagado').checked='';		
	}else{
		document.getElementById('pagado').value='0';
	}		
}

function nopagado(isChecked){
		//esta funcion chequea si el check esta chekqueado
	if(isChecked){
		document.getElementById('nopagado').value='1';
		document.getElementById('pagado').value='0';	
		document.getElementById('pagado').checked='';	
		document.getElementById('saldo').value='0';	
		document.getElementById('saldo').checked='';		
	}else{
		document.getElementById('nopagado').value='0';
	}		
}

function saldo(isChecked){
		//esta funcion chequea si el check esta chekqueado
	if(isChecked){
		document.getElementById('saldo').value='1';
		document.getElementById('nopagado').value='0';	
		document.getElementById('nopagado').checked='';		
	}else{
		document.getElementById('saldo').value='0';
	}		
}

function estado(valor){
document.getElementById('opcionradio').value=valor;

}

function nopresentado(isChecked){
	if(isChecked){
		document.getElementById('nopresentado').value='1';
	}else{
		document.getElementById('nopresentado').value='0';
	}


}

function retenido(isChecked){
	if(isChecked){
		document.getElementById('retenido').value='1';
	}else{
		document.getElementById('retenido').value='0';
	}


}

function desistido(isChecked){
	if(isChecked){
		document.getElementById('desistido').value='1';
	}else{
		document.getElementById('desistido').value='0';
	}
}
function cargakardexava2(pag)
{
	var v1=document.getElementById("nombre").value;
	var v2=document.getElementById("numdoc").value;
	var v3=document.getElementById("tipoper").value;
	
	
	if(v1!="" && v3==""){
		alert("Debe seleccionar el tipo de persona");		
	}else if(v2!="" && v3==""){	
		alert("Debe seleccionar el tipo de persona");		
	}else{
	buscarkardexavanzada3(pag); 
	}
}

</script>

</head>

<body   >
<div class="frmprotocolar">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="30" bgcolor="#264965"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="37" height="30" align="center"><img src="iconos/newproto.png" alt="" width="26" height="26" /></td>
          <td width="278"><span class="titulosprincipales">Búsqueda Avanzada</span></td>
          <td width="70%" align="left"><table width="454" border="0" align="right" cellpadding="0" cellspacing="0">
            <tr>
              <td width="192" height="30">&nbsp;</td>
              <td width="87"><?php /*
			  if($rowu['newkar'] == '1')
              {
                    echo'<a href="protocolares.php" target="protocolar"><img src="iconos/nuevo.png" width="76" height="27" border="0"  /></a>';
			  }else{
				    echo'<img src="iconos/nuevo.png" title="Nuevo Kardex" width="62" height="22" border="0" />';
				  }*/
			  ?></td>
              <td width="17" align="center"><span class="line">|</span></td>
              <td width="158"><a href="listadokardex7.php" target="protocolar"><img src="iconos/search.png" width="20" height="27" border="0" title="Búsqueda" /></a></td>
            </tr>
          </table></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><iframe name="protocolar" src="listadokardex7.php" frameborder="0" width="100%" height="1015" allowtransparency="true" scrolling="no"></iframe></td>
    </tr>
  </table>
</div>
</body>
</html>
