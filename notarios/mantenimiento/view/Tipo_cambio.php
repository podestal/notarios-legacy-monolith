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
	 
	 $("#fecha_tcambio").datepicker({ dateFormat: "dd/mm/yy" });
	 
	 $("#div_genkar").dialog({height:600, width:500,position :["center","top"], style: "margin:0px; padding:0px; float:none;",  resizable:false,title:'Tipo de Cambio'}); 
	 
			 $("input, textarea").uniform();
			 $("button").button();
			 $("#dialog").dialog();
			 $(".ui-dialog-titlebar").hide();
			 
			 Act_Divtcambio();
			 
	})

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
	return xmlhttp;}

function fShowAjaxDato(url){
		
		   _ajax = objetoAjax();
		    var _pag = '';
		    _ajax.open('GET', url,false);
		    _ajax.onreadystatechange = function(){
				
		    if(_ajax.readyState==4 && _ajax.status==200)
			{ 
		     _pag = _ajax.responseText;

			 }
		  }
	  _ajax.send(null);
	  return _pag; 
	  			 
	}

	function cerrar2(){ $("#div_genkar").dialog("close");	}	
	
	function fSavetcambio()
	{
		var _fecha_tcambio   = $("#fecha_tcambio").val();
		var _tcambio_dol     = $("#tcambio_dol").val();
		var _tcambio_eur     = $("#tcambio_eur").val();
		
		var data = {
						fecha_tcambio : _fecha_tcambio,
						tcambio_dol   : _tcambio_dol,
						tcambio_eur   : _tcambio_eur
				   }
		
		var _existe_fecha = fBuscaTCambio();
		
		if(_existe_fecha =='')		
		{   		   
			$.post("../controller/Savetcambio.php",data,function(){Act_Divtcambio();new_tcambio();alert('Registrado satisfactoriamente..!!')});
		}
			else if(_existe_fecha !='')	
			{
				if(confirm("Fecha ya registrada \nDesea actualizar el tipo de cambio..?"))
				{
					$.post("../controller/Savetcambio.php",data,function(){Act_Divtcambio();new_tcambio();});	
				}
			}
	}
	
	function Act_Divtcambio()
	{
		$("#div_tcambio").load("list_tcambio.php");	
	}
	
	function fbusTipCmb()
	{
		var _fecha_tcambio   = $("#fecha_tcambio").val();
		$("#div_tcambio").load("list_tcambio.php",{ fecha_tcambio : _fecha_tcambio});		
	}
	
	function new_tcambio()
	{
		Act_Divtcambio();
		$("#fecha_tcambio").val("<?php echo date("d/m/Y"); ?>");
		$("#tcambio_dol").val("0.00");
		$("#tcambio_eur").val("0.00");	
	}

	function fBuscaTCambio()
	{
		var _fecha_tcambio   = $("#fecha_tcambio").val();
		var _tcambio_dol     = $("#tcambio_dol").val();
		var _tcambio_eur     = $("#tcambio_eur").val();
		
		var _compare_fecha2 =fShowAjaxDato("../controller/busca_tcambioFec.php?fecha_tcambio="+_fecha_tcambio); 
		return _compare_fecha2;
			 
	}

function fShowDetail(obj)

		{
			var _id = obj.cells[0].innerHTML;
			var _gridView = document.getElementById('gridTCambio');
			var _rows  = _gridView.rows.length;
			for(i=1;i<=_rows-1;i++)
				{
					if(i%2==0)
						{
							_gridView.rows[i].style.backgroundColor = '#FFFFFF';
						}
					else
						{
							_gridView.rows[i].style.backgroundColor = '#E8E8E8';
						}
				}
			obj.style.backgroundColor = '#b4b4b4'; //#E8E8E8
			
			var fil=obj.id;
			document.getElementById('txtfilas').value=fil;

			    _datos =  $GridData(obj);

				$("#fecha_tcambio").val(_datos[0]);
				$("#tcambio_dol").val(_datos[1]);
				$("#tcambio_eur").val(_datos[2]);
		}
		

	function NumCheck(e, field) 
	{
		key = e.keyCode ? e.keyCode : e.which
		// backspace
		if (key == 8) return true
		if(key==13){
		//document.getElementById("bpag").focus();
		}
		// 0-9
		if (key > 47 && key < 58) {
		if (field.value == "") return true
		regexp = /.[0-9]{*}$/
		return !(regexp.test(field.value))
		}
		// .
		if (key == 46) {
		if (field.value == "") return false
		regexp = /^[0-9]+$/
		return regexp.test(field.value)
		}
		// other key
		return false
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
</style>
</head>

<body style="font-size:62.5%;">
<div id="div_genkar" style="background-color: #ffffff;
border: 4px solid #264965;  
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:400; height:200;">
  <table width="100%" height="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="30" bgcolor="#264965"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="33" height="30"><img src="../../iconos/newproto.png" alt="" width="26" height="26" /></td>
          <td width="328"><span class="titulosprincipales">Tipo de Cambio</span></td>
          <td >&nbsp;</td>
          <td width="29"><a  onClick="cerrar2()" id="btncerrar" href="#"><img id="btncerrar" src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
        </tr>
      </table></td>
    </tr>
      <td valign="top"><form id="frmescri" name="frmescri" method="post" action="">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="2"><input type="hidden" id="txtfilas" name="txtfilas" value="" /></td></tr>
              <tr>
                <td width="193" height="22" align="right" ><span class="camposss">Fecha: </span></td>
                <td width="250" height="22" valign="bottom"><input name="fecha_tcambio" type="text" id="fecha_tcambio" style="text-transform:uppercase; text-align:right;" value="<?php echo date("d/m/Y"); ?>"   size="15" />
                </td>
                
              </tr>
              <tr>
                <td height="27" colspan="2" align="left">
                  <table  width="100%">
                    <tr>
                      <td width="43%" align="right"><span class="camposss">Tip.Cambio Dolares: </span></td>
                      <td width="57%"><input name="tcambio_dol" type="text" id="tcambio_dol" style="text-transform:uppercase; text-align:right;"  value="0.00" size="15" onKeyPress="return NumCheck(event, this);" /></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td height="28" align="right"><span class="camposss">Tip.Cambio Euros: </span> </td>
                <td height="28">
                  <input name="tcambio_eur" type="text" id="tcambio_eur" style="text-transform:uppercase; text-align:right;"  value="0.00" size="15" onKeyPress="return NumCheck(event, this);" /></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" colspan="2"><button  type="button" name="generar"    id="generar" value="anadir" onclick="new_tcambio();" ><img src="../../images/new.png" width="14" height="14" align="absmiddle" /> Nuevo</button>&nbsp;&nbsp;&nbsp;<button  type="button" name="generar"    id="generar" value="anadir" onclick="fSavetcambio();" ><img src="../../images/success.png" width="14" height="14" align="absmiddle" /> Registrar</button>&nbsp;&nbsp;&nbsp;<button  type="button" name="generar"    id="generar" value="anadir" onclick="fbusTipCmb();" ><img src="../../images/search.png" width="14" height="14" align="absmiddle" /> Buscar</button></td>
              </tr>
              <tr>
                <td align="center" colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2"><div id="div_tcambio" style="height:320px; overflow:auto;"></div></td>
              </tr>
          </table>
        </form></td>
    </tr>
  </table>
</div>
</body>
</html>
