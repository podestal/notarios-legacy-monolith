<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script src="jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="tcal3.js"></script>
<script type="text/javascript">
function fExportatxt()
		{
			desde=document.getElementById('desde').value;
		    hasta=document.getElementById('hasta').value;
			
			//var B =  AjaxReturn('pdtescriAct.php?desde='+desde+'&hasta='+hasta);
			if(window.open('pdtescriAct.php?desde='+desde+'&hasta='+hasta))
			{
				window.open('pdtescriBie.php?desde='+desde+'&hasta='+hasta);
				}
			
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

<body>
<div class="frmprotocolar">
  <table width="900" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="30" bgcolor="#264965"><table width="900" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="33" height="30"><img src="iconos/newproto.png" alt="" width="26" height="26" /></td>
          <td width="328"><span class="titulosprincipales">PDT Transferencias Vehiculares</span></td>
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
            <td width="68">&nbsp;</td>
            <td width="147">&nbsp;</td>
            <td width="66">&nbsp;</td>
            <td width="159">&nbsp;</td>
            <td width="219">&nbsp;</td>
            <td width="81">&nbsp;</td>
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
            <td><input type="button" name="button" id="button" value="Exportar" onclick="fExportatxt()" /></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="6">&nbsp;</td>
            </tr>
        </table>
      </form></td>
    </tr>
  </table>
</div>

</body>
</html>
