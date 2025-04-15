<?php 
include("../../conexion.php");
require_once("../../includes/combo.php") ;
$oCombo = new CmbList()  				 ;	

 $codigocliente = $_REQUEST['id_cliente'];
$tipop         = $_REQUEST['tipop']  ;

$civil = mysql_query("SELECT * FROM tipoestacivil",$conn) or die(mysql_error());
$naci  = mysql_query("SELECT * FROM nacionalidades order by desnacionalidad asc",$conn) or die(mysql_error());


$consulcliente=mysql_query("Select * from cliente where idcliente='$codigocliente'", $conn) or die(mysql_error());
$rowclientte = mysql_fetch_array($consulcliente);

$consuljuri=mysql_query("SELECT * FROM cliente WHERE idcliente='$codigocliente'", $conn) or die(mysql_error());
$rowjuridica = mysql_fetch_array($consuljuri);

$domfiscal =  $rowjuridica['domfiscal'];
$razonsocial =  $rowjuridica['razonsocial'];

 $impedido =  $rowjuridica['tipocli'];
 
  $tipper =  $rowjuridica['tipper']

?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>Actualizar Cliente</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link href="../includes/scrollableFixedHeaderTable.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<!--<link rel="stylesheet" href="../../css/uniform.default.css" type="text/css" media="screen"> -->
<script src="../../includes/js/jquery-1.9.0.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<!--<script src="../../jquery.uniform.js" type="text/javascript" charset="utf-8"></script>-->	  

<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/jquery.scrollableFixedHeaderTable.js"></script>
<script language="JavaScript" type="text/javascript" src="../../ajax2.js"></script>
<script language="JavaScript" type="text/javascript" src="../../ajax.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/script1.js"></script>
<script language="JavaScript" type="text/javascript" src="../includes/ext_script1.js"></script>
<!--<script src="../../jquery.uniform.js" type="text/javascript" charset="utf-8"></script> --> 
<style type="text/css">
<!--
<!-- ini table -->
.GridPar
{
	border:0px #036;
	border-spacing:0px;
	border-collapse:0px;
	font:Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#300;
	cursor:pointer;
	background-color:#D6F3D8;
}
.GridImp
{
	border:0px #036;
	border-spacing:0px;
	border-collapse:0px;
	font:Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#300;
	cursor:pointer;
	background-color:#DADADA;
}
.GridCab
{
	font-size:17px;
	font-weight:bold;
}
<!-- end table -->

.line {color: #FFFFFF}
.titulosprincipales {	font-family: Calibri;
	font-size: 16px;
	color: #FF9900;
	font-style: italic;
}

.Estilo7 {font-family: Calibri; font-size: 13px; font-style: italic; }
.Estilo14 {font-family: Calibri; font-size: 12px; color: #333333; font-weight: bold; }
.Estilo12 {font-family: Calibri; font-size: 12px; color: #333333; font-style: italic; cursor:pointer; }
-->
</style>
<script type="text/javascript">
$(document).ready(function(){ 
		
	 var tipop = '<?php echo $tipop; ?>';
	 fTipoBusq(tipop);
	 

	 //$("input, textarea, select, button").uniform();
	 $("button").button();
	 $("#dialog").dialog();
	 //$(".ui-dialog-titlebar").hide();
	 //muestragrid();
	 
// ##############################################################################################
// ##############################################################################################
	 $("#div_dataImpedido").attr("style","display:none");
	 
	 /// Volver Impedido a un cliente natural:
	 $(".setImpedido_N").click(function(){

		 var _id_cliente_edit = $('#id_cliente_edit').val();
		 var _eval = $('#_eval').val();
			if(_eval=='2')
				{	 
					 $('#div_dataImpedido').fadeOut();
					 $('#_eval').val("1");
					 $("#fechaing2").val("");
					 $("#origen2").val("");
					 $("#entidad2").val("");
					 $("#remite2").val("");
					 $("#motivo2").val("");
					 $("#oficio2").val("");
					 $("#pep2").val("");
					 $("#laft2").val("");
				}
			else if(_eval=='1')	
				{$('#div_dataImpedido').fadeIn();
				 $('#_eval').val("2");
				 
				 	$.getJSON("buscaDataImpedido.php",{ id_cliente : _id_cliente_edit}, function(respuesta){
						var _Datos = respuesta;

				 	if(_Datos[0].idcliente == '')
						{
							$("#fechaing2").val("");
							$("#origen2").val("");
							$("#entidad2").val("");
							$("#remite2").val("");
							$("#motivo2").val("");
							$("#oficio2").val("");
							$("#pep2").val("");
							$("#laft2").val("");
						}
						else if(_Datos[0].idcliente != '')
						{
							$("#fechaing2").val(_Datos[0].impeingre);
							$("#origen2").val(_Datos[0].impeorigen);
							$("#entidad2").val(_Datos[0].impentidad);
							$("#remite2").val(_Datos[0].impremite);
							$("#motivo2").val(_Datos[0].impmotivo);
							$("#oficio2").val(_Datos[0].impnumof);
							$("#pep2").val("");
							$("#laft2").val("");
						}
				 })
				 
				}
			 
		 })	
		 
		 $("#Act_Impedido").click(function(){
			 	
				var _id_cliente_edit = $('#id_cliente_edit').val();
				var _fechaing2 = $("#fechaing2").val();
				var _origen2   = $("#origen2").val();
				var _entidad2  = $("#entidad2").val();
				var _remite2   = $("#remite2").val();
				var _motivo2   = $("#motivo2").val();
				var _oficio2   = $("#oficio2").val();
				var _pep2      = $("#pep2").val();
				var _laft2     = $("#laft2").val();
				
				var data = {
						id_cliente_edit : _id_cliente_edit,
						fechaing2 		 : _fechaing2,
						origen2   		 : _origen2,
						entidad2  		 : _entidad2,
						remite2   		 : _remite2,
						motivo2   		 : _motivo2,
						oficio2   		 : _oficio2,
						pep2      		 : _pep2,
						laft2     		 : _laft2
					}
				$.post("EditData_CImpedido.php", data, function(){
						alert("Se actualizo los datos de Impedido");
					})
				return false;		
					
			 })
		  
// ##############################################################################################	 
// ##############################################################################################	 

	 ShowDetComprobante();
	 $('#div_buscadoc').attr('style','display:none');
	 $('#fAgregarItem').attr('style','display:none');
	 
	 $('#cboBusca').val('2');

	 //$("input, textarea, select, button").uniform();
	 //$("input, textarea").uniform();
	 $("button").button();
	 $("#dialog").dialog();
	 //$("#div_bloques").sortable();
	 
	 //ShowCCarac();
	 
	 $(".ui-dialog-titlebar").hide();
	 //muestragrid();

	})
	

jQuery(function($){
    $("#fec_ingreso").mask("99/99/9999",{placeholder:"_"});
});
function fTipoBusq(_obj)
{ 
		
	if(_obj=='Natural') 	   // x documento
	{
		
		$('#div_buscadoc').attr('style','display:none');
		$('#div_buscaclie').removeAttr('style');
	}
	else if(_obj=='Juridica')  // x codigo de cliente
	{
	
		$('#div_buscadoc').removeAttr('style');
		$('#div_buscaclie').attr('style','display:none');
		
	}
}




 
function muesdatos()
{
	muestragrid();
}

function selectidkar(id) {
	
document.getElementById('datos').value = id;
fllenardatos();
}

function fllenardatos()
{
	/*_datos = document.getElementById('datos').value;
	_datos = _datos.split('|');
	document.getElementById('idkardex').value = _datos[0];
	document.getElementById('tipkar').value = _datos[1];
	document.getElementById('nomtipkar').value = _datos[2];*/
	
}


function focusSearch(evento)
{if(evento.keyCode==13){document.getElementById('Buscar').focus();}} 

function fini()
{
	//document.getElementById('cboBusca').selectedIndex='1'
	//document.getElementById('txtBuscar').focus();
}	
function ggclie1()
    {   
	   grabarcliente();
	   alert("Cliente grabado satisfactoriamente");
    }
function ggclie3()
    {   
	   grabEdiCliente();
	   //ocultar_desc('conyugesss2');
	   //alert("Cliente Actualizado satisfactoriamente");
    }	
function ggempresaa()
    {   
	   grabEdiEmpresa();
	   //ocultar_desc('conyugesss2');
	   //alert("Cliente Actualizado satisfactoriamente");
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


function mostrarubigeoo(id,name)
    {
  document.getElementById('codubisc3').value = name;
  document.getElementById('ubigen').value = id;  
  ocultar_desc('buscaubisc3');     
        
    }
function mostrarubigeoo2(id,name)
    {
		
  document.getElementById('codubisc4').value = name;
  document.getElementById('ubigen2').value = id;
  ocultar_desc('buscaubi');        
    }
	
	
	
	
function mostrarprofesioness3(id,name)
    {
  document.getElementById('idprofesion3').value = id; 
  document.getElementById('nomprofesiones3').value = name; 
  ocultar_desc('buscaprofe3');        
    }
function mostrarcargoos3(id,name)
    {
  document.getElementById('idcargoo3').value = id; 
  document.getElementById('nomcargoss3').value = name; 
  ocultar_desc('buscacargooo3');        
    }
	
	
//********************************************************************************************************************
//********************************************************************************************************************
function casadito2(valor)
{
   if(valor==2){
    mostrar_desc('casado2');
   }else{
       if(valor==5){
		mostrar_desc('casado2');
	   }else{
		ocultar_desc('casado2');
	   }
   }
   
}
		
</script>
</head>

<body onLoad="fini();">
<div class="frmclient" id="frmclient" style="width:680px;">
<form id="frmprotocolares" name="frmprotocolares" method="post" action="">
<?php if($tipper=="N"){?>
<div id="div_buscaclie">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>
    <td width="119" height="30" align="right"><span class="camposss">Apellido Paterno :</span></td>
    <td width="180" height="30"><input type="text" name="apepat3" style="text-transform:uppercase; background:#FFFFFF" id="apepat3" value="<?php echo $rowclientte['apepat'];  ?>" /><span style="color:#F00">*</span></td>
    <td width="63" height="30" align="left"><span class="camposss">Apellido Materno :</span></td>
    <td width="226" height="30"><input type="text" name="apemat3" style="text-transform:uppercase; background:#FFFFFF" value="<?php echo $rowclientte['apemat'];  ?>" id="apemat3" /></td>
  </tr>
  <tr>
    <td height="30" align="right"><span class="camposss">1er Nombre :</span></td>
    <td height="30"><input type="text" name="prinom3" style="text-transform:uppercase; background:#FFFFFF" id="prinom3" value="<?php echo $rowclientte['prinom'];  ?>" /><span style="color:#F00">*</span></td>
    <td height="30" align="left"><span class="camposss">2do Nombre :</span></td>
    <td height="30"><input type="text" name="segnom3" style="text-transform:uppercase; background:#FFFFFF" id="segnom3" value="<?php echo $rowclientte['segnom'];  ?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right"><span class="camposss">Direccion :</span></td>
    <td height="30" colspan="3"><input name="direccion3" style="text-transform:uppercase; background:#FFFFFF" type="text" id="direccion3" value="<?php echo $rowclientte['direccion'];  ?>" size="50" /><span style="color:#F00">*</span></td>
  </tr>
  <tr>
    <td height="30" align="right"><span class="camposss">Ubigeo :</span></td>
    <td height="30" colspan="3"><table width="449" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="318">
        <input name="ubigen" type="text" id="ubigen" size="50"  value="<?php $sqlubiubi=mysql_query("select * from ubigeo where coddis='".$rowclientte['idubigeo']."'", $conn) or die(mysql_error());
        $rowubiubi=mysql_fetch_array($sqlubiubi);
		echo $rowubiubi['nomdpto']."/".$rowubiubi['nomprov']."/".$rowubiubi['nomdis']; ?>"/><span style="color:#F00">*</span></td>
        <td width="94"><a href="#" onClick="mostrar_desc('buscaubisc3')"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a>
              <div id="buscaubisc3" style="position:absolute; display:none; width:637px; height:223px; left: -8px; top: 146px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; float:left; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
                <table width="637" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="24" height="29">&nbsp;</td>
                    <td width="585"><span class="camposss">Seleccionar Ubigeo:</span></td>
                    <td width="28"><a href="#" onClick="ocultar_desc('buscaubisc3')"><img src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><label>
                      <input name="buscaubisc33" type="text" id="buscaubisc33"  style="background:#FFFFFF;" size="50" onKeyUp="buscaubigeosscEdit();" />
                    </label></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><div id="resulubisc3" style="width:585px; height:150px; overflow:auto"></div></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
              </div>
              <!-- DIV BUSQUEDA PROFESION -->
              <div id="buscaprofe3" style="position:absolute; display:none; width:637px; height:223px; left: 8px; top: 146px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; float:left; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="637" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24" height="29">&nbsp;</td>
      <td width="585"><span class="camposss">Seleccionar Profesión:</span></td>
      <td width="28"><a href="#" onClick="ocultar_desc('buscaprofe3')"><img src="../../iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input name="buscaprofes3" type="text" id="buscaprofes3"  style="background:#FFFFFF;" size="50" onKeyPress="buscaprofesionesEdit()" />
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div id="resulprofesiones3" style="width:585px; height:150px; overflow:auto"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
   <!-- DIV BUSQUEDA CARGO -->  
   <div id="buscacargooo3" style="position:absolute; display:none; width:637px; height:223px; left: 8px; top: 146px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; float:left; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="637" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24" height="29">&nbsp;</td>
      <td width="585"><span class="camposss">Seleccionar Cargo:</span></td>
      <td width="28"><a href="#" onClick="ocultar_desc('buscacargooo3')"><img src="../../iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input name="buscacargooss3" type="text" id="buscacargooss3"  style="background:#FFFFFF;" size="50" onKeyPress="buscacarguitossEdit()" />
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div id="resulcargito3" style="width:585px; height:150px; overflow:auto"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>         
              </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30" align="right"><span class="camposss">Estado Civil :</span></td>
    <td height="30"><select name="idestcivil3" id="idestcivil3" onchange="casadito2(this.value)">
      <?php 
	     $sqltec=mysql_query("select * from tipoestacivil where  idestcivil='".$rowclientte['idestcivil']."'", $conn) or die(mysql_error());
        $rowtec=mysql_fetch_array($sqltec);
		echo "<option value = ".$rowtec["idestcivil"]." selected='selected'>".nl2br($rowtec["desestcivil"])."</option>";
		
		  while($rowcicil=mysql_fetch_array($civil)){
		  echo "<option value = ".$rowcicil["idestcivil"].">".nl2br($rowcicil["desestcivil"])."</option>";  
		  }
		?>
      </select><span style="color:#F00">*</span></td>
    <td height="30" colspan="2" align="left"><div id="ccconyuge2"></div></td>
  </tr>
  <!-- <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right">Casado(a) con :</td>
    <td height="30" colspan="3"><?php if ($rowclientte['idestcivil']==2){
	$sqlteccc=mysql_query("select * from cliente where idcliente='".$rowclientte['conyuge']."'", $conn) or die(mysql_error());
        $rowteccc=mysql_fetch_array($sqlteccc);
		echo $rowteccc["nombre"]." ";
		echo"<a href='#' onclick='hhh()'><img src='../../iconos/grabarconyuge2.png' width='111' height='29' border='0' /></a>";
	}
	?><div id="casado2" style="display:none"><table width="272" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="139" align="right"><span class="camposss">Conyuge :</span></td>
          <td width="133"><a href="#" onclick="mostrar_desc('conyugesss2')"><img src="../../iconos/grabarconyuge.png" width="111" height="29" border="0" /></a></td>
        </tr>
      </table>
    </div></td>
  </tr>-->
  <tr>
    <td height="30" align="right"><span class="camposss">Sexo :</span></td>
    <td height="30"><select name="sexo3" id="sexo3">
      <?php if ($rowclientte['sexo']=="M"){
		      echo "<option value='M' selected='selected'>MASCULINO</option>
			  		<option value='F' >FEMENINO</option>";
			} else{
			  echo "<option value='F' selected='selected'>FEMENINO</option>
			  		<option value='M' >MASCULINO</option>";
			}  
		?>
     <!-- <option value="M">MASCULINO</option>
      <option value="F">FEMENINO</option>-->
    </select><span style="color:#F00">*</span></td>
    <td height="30" align="left" class="camposss"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT CAST(tipodocumento.codtipdoc AS DECIMAL) AS 'id', tipodocumento.destipdoc AS 'des'
FROM tipodocumento
ORDER BY tipodocumento.destipdoc ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "120"; 
			$oCombo->name       = "tipdocu";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  $rowclientte['idtipdoc'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
    <td height="30"><label>
      <input name="numdoc3" style="background:#FFFFFF" type="text" id="numdoc3" size="20" value="<?php echo $rowclientte['numdoc'];  ?>" />
    </label></td>
  </tr>
  <tr>
    <td height="30" align="right"><span class="camposss">Nacionalidad :</span></td>
    <td height="30">
    <?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT nacionalidades.idnacionalidad AS 'id', nacionalidades.descripcion AS 'des'
FROM nacionalidades
ORDER BY nacionalidades.desnacionalidad ASC ";
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "200"; 
			$oCombo->name       = "nacionalidad3";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  $rowclientte['nacionalidad'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
    <td height="30" align="left"><span class="camposss">Residente :</span></td>
    <td height="30"><label>
      <select name="residente3" id="residente3">
        <?php if ($rowclientte['residente']=="1"){
		      echo "<option value='1' selected='selected'>SI</option>";
			} else{
			  echo "<option value='0' selected='selected'>NO</option>";
			} 
		?>
        <option value="1">SI</option>
        <option value="0">NO</option>
      </select>
    </label></td>
  </tr>
  <tr>
    <td height="30" align="right"><span class="camposss">Natural de :</span></td>
    <td height="30"><input type="text" style="text-transform:uppercase; background:#FFFFFF" name="natper3" id="natper3" value="<?php echo $rowclientte['natper'];  ?>" /></td>
    <td height="30" align="left"><span class="camposss">Fecha de Nac. :</span></td>
    <td height="30"><input name="cumpclie3" type="text" id="cumpclie3" style="text-transform:uppercase; background:#FFFFFF" size="20" value="<?php echo $rowclientte['cumpclie'];  ?>"/></td>
  </tr>
  <tr>
    <td height="30" colspan="2" align="right"><span class="camposss">Pais de Emisi&oacute;n del Documento de Identidad :</span></td>
    <td height="30" colspan="2"><label>
      <input type="text" style="text-transform:uppercase; background:#FFFFFF" name="docpaisemi3" id="docpaisemi3" value="<?php echo $rowclientte['docpaisemi'];  ?>" />
      </label></td>
  </tr>
  <tr>
    <td height="30" align="right"><span class="camposss">Prof./Ocupaci&oacute;n :</span></td>
    <td height="30" colspan="3"><table width="410" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="281"><label>
          <input name="nomprofesiones3" style="text-transform:uppercase; background:#FFFFFF" type="text" id="nomprofesiones3" size="45" value="<?php echo $rowclientte['detaprofesion'];  ?>" />
        </label></td>
        <td width="129"><a href="#" onClick="mostrar_desc('buscaprofe3')"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a><span style="color:#F00">*</span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30" align="right"><span class="camposss">Cargo :</span></td>
    <td height="30" colspan="3"><table width="409" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="281"><label>
          <input name="nomcargoss3" style="text-transform:uppercase; background:#FFFFFF" type="text" id="nomcargoss3" size="45" value="<?php echo $rowclientte['profocupa'];  ?>" />
        </label></td>
        <td width="128"><a href="#" onClick="mostrar_desc('buscacargooo3')"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30" align="right"><span class="camposss">Telefono Cel. :</span></td>
    <td height="30"><input name="telcel3" style="text-transform:uppercase; background:#FFFFFF" type="text" id="telcel3" size="20" value="<?php echo $rowclientte['telcel'];  ?>" /></td>
    <td height="30" align="left"><span class="camposss">Telefono Oficina :</span></td>
    <td height="30"><input name="telofi3" style="text-transform:uppercase; background:#FFFFFF" type="text" id="telofi3" size="20" value="<?php echo $rowclientte['telofi'];  ?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right"><span class="camposss">Telefono Fijo :</span></td>
    <td height="30"><input name="telfijo3" style="text-transform:uppercase; background:#FFFFFF" type="text" id="telfijo3" size="20" value="<?php echo $rowclientte['telfijo'];  ?>" /></td>
    <td height="30">&nbsp;</td>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30" align="right"><span class="camposss">Email :</span></td>
    <td height="30" colspan="3"><input name="email3" style="background:#FFFFFF" type="text" id="email3" size="60" value="<?php echo $rowclientte['email'];  ?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right">&nbsp;</td>
    <td height="30"><a href="#" onclick="ggclie3()"><img src="../../iconos/grabar.png" width="94" height="29" border="0" /></a></td>
    <td height="30"><a class="setImpedido_N" href="#">Impedido</a></td><td>&nbsp;&nbsp;&nbsp;<?php if($impedido=='1'){echo "<div style='color:#F63; font-size:13px;' >El Cliente se encuentra impedido</div>";}else{ echo "<div style='color:#F63; font-size:13px;' >El Cliente no se encuentra impedido</div>";}?></td>
    <td width="92" height="30">
    
    <input name="codubisc3" type="hidden" id="codubisc3" size="15" value="<?php echo $rowclientte['idubigeo'];  ?>" />
    
    <input name="idprofesion3" type="hidden" id="idprofesion3" size="15" value="<?php echo $rowclientte['idprofesion'];  ?>" />
    
        <input name="idcargoo3" type="hidden" id="idcargoo3" size="15" value="<?php echo $rowclientte['idcargoprofe'];  ?>" />
        
        <input name="codclie" type="hidden" id="codclie" size="15" value="<?php echo $rowclientte['idcliente'];  ?>" /></td>
  </tr>
</table>
</div>
<?php }?>

<?php if($tipper=="J"){?>
<div id="div_buscadoc">
 
         <table width="637" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
    <td height="32" align="right" ><span class="camposss">Razón Social</span></td>
    <td height="32" >&nbsp;</td>
    <td height="32" colspan="5"><label>
      <input name="razonsocial" type="text" style="text-transform:uppercase" id="razonsocial" size="60" value="<?php echo $rowjuridica['razonsocial']; ?>"/><span style="color:#F00">*</span>
    </label>      <label></label>    <div id="menucondicion" class="menucondicion" style="display:none; z-index:3;" >
      <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="29" colspan="2" class="style30"><table width="196" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="16">&nbsp;</td>
                <td width="180"><span class="titulomenuacto">Seleccione Condición(es)</span></td>
              </tr>
            </table></td>
            <td width="45" align="right" valign="middle">&nbsp;</td>
          </tr>
        <tr>
          <td height="50" colspan="3"><table width="750" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="25">&nbsp;</td>
                <td width="725"><div id="tipocondicion" class="tipoacto"></div></td>
              </tr>
            </table></td>
          </tr>
        <tr>
          <td width="620" height="10">&nbsp;</td>
            <td width="95"><a href='#' onclick="ocultar_desc('menucondicion')"><img src="iconos/aceptar.png" alt="" width="95" height="29" border="0" /></a></td>
            <td height="10">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="3" align="center" valign="middle"></td>
          </tr>
        <tr></tr>
        </table>
    </div></td>
  </tr>
  <tr>
    <td height="26" align="right" ><span class="camposss">Domicilio Fiscal</span></td>
    <td height="26" >&nbsp;</td>
    <td height="26" colspan="5">
      <input name="domfiscal" style="text-transform:uppercase" type="text" id="domfiscal" size="60"value="<?php echo $rowjuridica['domfiscal'];  ?>" />
   <span style="color:#F00">*</span>
     </td>
  </tr>
  <tr>
    <td height="30" align="right" ><span class="camposss">Ubigeo</span></td>
    <td height="0" >&nbsp;</td>
    <td height="0" colspan="5" valign="middle"><table width="500" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="381">
  <input name="ubigen2" type="text" id="ubigen2" size="50"  value="<?php $sqlubiubi=mysql_query("select * from ubigeo where coddis='".$rowjuridica['idubigeo']."'", $conn) or die(mysql_error());
        $rowubiubi=mysql_fetch_array($sqlubiubi);
		echo $rowubiubi['nomdpto']."/".$rowubiubi['nomprov']."/".$rowubiubi['nomdis']; ?>"/>
        <span style="color:#F00">*</span></td>
       
       <td width="223"><a href="#" onclick="mostrar_desc('buscaubi')"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a>
       <!-- buscar ubi --> 
      <div id="buscaubi" style="position:absolute; display:none; width:637px; height:223px; left: -8px; top: 146px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; float:left; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
        <table width="637" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24" height="29">&nbsp;</td>
            <td width="585"><span class="camposss">Seleccionar Ubigeo:</span></td>
            <td width="28"><a href="#" onclick="ocultar_desc('buscaubi')"><img src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><label>
              <input name="buscaubigeo" type="text" id="buscaubigeo"  style="background:#FFFFFF;" size="50" onKeyUp="buscaubigeosscEditJ()" />
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><div id="resulubigeo" style="width:585px; height:150px; overflow:auto"></div></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
    </div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30" align="right" ><span class="camposss"><span class="camposss">Objeto Social</span></td>
    <td height="0" >&nbsp;</td>
    <td height="0" colspan="5"><input name="contacempresa" style="text-transform:uppercase" type="text" id="contacempresa" size="60" value="<?php echo $rowjuridica['contacempresa'];?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" ><span class="camposss">Fecha de Const.</span></td>
    <td height="30" >&nbsp;</td>
    <td width="152" height="30"><input type="text" name="fechaconstitu" class="tcal" style="text-transform:uppercase" id="fechaconstitu" value="<?php echo $rowjuridica['fechaconstitu'];?>" /></td>
    <td width="14" height="30" >&nbsp;</td>
    <td width="135" height="30" align="right" ><span class="camposss">Nº de Registro</span></td>
    <td width="11" height="30" >&nbsp;</td>
    <td width="208" height="30" ><input type="text" name="numregistro" style="text-transform:uppercase" id="numregistro" value="<?php echo $rowjuridica['numregistro'];?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" ><span class="camposss">Sede Registral</span></td>
    <td height="30" >&nbsp;</td>
    <td height="30">
      <!--<select name="idsedereg3" id="idsedereg3">
        <?php
		 /*  
		   $sqlsedesss=mysql_query("SELECT * FROM sedesregistrales",$conn) or die(mysql_error()); 
	       while($rowsedesss = mysql_fetch_array($sqlsedesss)){
	         echo "<option value=".$rowsedesss['idsedereg'].">".$rowsedesss['dessede']."</option> \n";
             }
		*/	 
	     ?>
      </select>-->
      <?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT CAST(sedesregistrales.idsedereg AS DECIMAL) AS 'id', sedesregistrales.dessede AS 'des' FROM sedesregistrales"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "100"; 
			$oCombo->name       = "idsedereg3";
			$oCombo->style      = ""; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  $rowjuridica['idsedereg'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>
      </td>
    <td height="30">&nbsp;</td>
    <td height="30" align="right" ><span class="camposss">N° de Partida</span></td>
    <td height="30" >&nbsp;</td>
    <td height="30" ><label>
      <input type="text" name="numpartida" style="text-transform:uppercase" id="numpartida" value="<?php echo $rowjuridica['numpartida'];?>" />
    </label></td>
  </tr>
  <tr>
    <td width="110" height="30" align="right" ><span class="camposss">Telefono</span></td>
    <td width="7" height="30" >&nbsp;</td>
    <td height="30"><label>
      <input type="text" name="telempresa" style="text-transform:uppercase" id="telempresa" value="<?php echo $rowjuridica['telempresa'];?>" />
    </label></td>
    <td height="30">&nbsp;</td>
    <td height="30" align="right" >CIIU</td>
    <td height="30" >&nbsp;</td>
    <td height="30" ><label>
       <?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT ciiu.coddivi AS 'id', ciiu.nombre AS 'des' FROM ciiu ORDER BY ciiu.nombre ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "200"; 
			$oCombo->name       = "actmunicipal";
			$oCombo->style      = ""; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  $rowjuridica['actmunicipal'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>
    </label></td>
  </tr>
  <tr>
    <td height="30" align="right" ><span class="camposss">Correo de la empresa</span></td>
    <td height="30" >&nbsp;</td>
    <td height="30" valign="middle" ><input name="mailempresa" type="text" id="mailempresa" value="<?php echo $rowjuridica['mailempresa'];?>" /></td>
    <td height="30" valign="middle" >&nbsp;</td>
    <td height="30" align="right" valign="middle" ><span class="camposss">R.U.C.</span></td>
    <td height="30" valign="middle" >&nbsp;</td>
    <td height="30" valign="middle" ><input type="text" name="numero_ruc" style="text-transform:uppercase" id="numero_ruc" value="<?php echo $rowjuridica['numdoc'];?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" >&nbsp;</td>
    <td height="30" >&nbsp;</td>
    <td height="30" valign="middle" ><a  onClick="ggempresaa()"><img src="../../iconos/grabar.png" width="94" height="29" border="0" />
      <input name="codclie2" type="hidden" id="codclie2" size="15" value="<?php echo $rowclientte['idcliente'];  ?>" />
    </a></td>
    <td height="30" valign="middle" >&nbsp;</td>
    <td height="30" align="right" valign="middle" ><center><span class="camposss"> <a class="setImpedido_N" href="#">Impedido</a>:</span></center></td>
    <td height="30" valign="middle" >&nbsp;</td>
    <td height="30" valign="middle" ><?php if($impedido=='1'){echo "<div style='color:#F63; font-size:15px;' >El Cliente se encuentra impedido</div>";}else{ echo "<div style='color:#F63; font-size:15px;' >El Cliente no se encuentra impedido</div>";}?></td>
  </tr>
  <tr>
    <td height="30" align="right" >&nbsp;</td>
    <td height="30" >&nbsp;</td>
    <td height="30" colspan="5" >&nbsp;&nbsp;&nbsp;</td>
    <td height="30"><input name="codubisc4" type="hidden" id="codubisc4" size="15" value="<?php echo $rowjuridica['idubigeo'];  ?>" />
</td>
  </tr>
</table>
        </div>
        <?php }?>
<div id="div_dataImpedido"><table  width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
	<tr>
    	<td height="21" colspan="5" align="center" ><div style="height:90%; width:90%;" class="ui-state-hover ui-corner-all">Datos de Impedido</div></td>
    </tr>
  <tr>
    <td height="21" align="right">Fecha ing.: </td>
    <td height="21" align="left"><input name="fechaing2" type="text" id="fechaing2" style="text-transform:uppercase;" size="10" class="tcal" /></td>
    <td height="21" align="right">Oficio: </td>
    <td height="21" align="left"><input style="text-transform:uppercase;" name="oficio2" type="text" id="oficio2" size="10"  /></td>
  </tr>
  <tr>
    <td height="21" align="right">Origen: </td>
    <td height="21" colspan="3" align="left"><input style="text-transform:uppercase;" name="origen2" type="text" id="origen2" size="30"  /></td>
    </tr>
  <tr>
    <td height="21" align="right">Entidad: </td>
    <td height="21" colspan="3" align="left"><input style="text-transform:uppercase;" name="entidad2" type="text" id="entidad2" size="30"  /></td>
  </tr>
  <tr>
    <td height="21" align="right">Remite: </td>
    <td height="21" colspan="3" align="left"><input style="text-transform:uppercase;" name="remite2" type="text" id="remite2" size="30"  /></td>
  </tr>
  <tr>
    <td height="21" align="right" valign="top">Motivo: </td>
    <td height="21" colspan="3" align="left" valign="top"><textarea style="text-transform:uppercase;" name="motivo2" id="motivo2" cols="75" rows="2"></textarea>
      <input name="pep2" type="hidden" id="pep2" style="text-transform:uppercase;" size="10" />
      <input name="laft2" type="hidden" id="laft2" style="text-transform:uppercase;" size="10" />
      <input name="_eval" type="hidden" id="_eval" value="1" />
      <input name="_eval_persona" type="hidden" id="_eval_persona" value="<?php echo $tipop; ?>" />
      <input name="id_cliente_edit" type="hidden" id="id_cliente_edit" value="<?php echo $codigocliente; ?>" />
      </td>
    </tr>
  <tr>
    <td height="21" colspan="4" align="center" style="font-size:12px"><button id="Act_Impedido">Actualizar Datos Impedido</button></td>
    </tr>
</table>
</div>        
        
</form>
</div>		
</body>
</html>