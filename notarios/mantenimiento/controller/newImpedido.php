<?php 
include("../../conexion.php");
require_once("../includes/combo.php")    ;
$oCombo = new CmbList()  ;	
$civil =mysql_query("SELECT * FROM tipoestacivil",$conn) or die(mysql_error());
$naci =mysql_query("SELECT * FROM nacionalidades order by desnacionalidad asc",$conn) or die(mysql_error());
?>

<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../includes/css/uniform.default.min.css" />
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<script language="JavaScript" type="text/javascript" src="../includes/ext_script1.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<script src="../../includes/jquery-1.8.3.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script src="../../includes/jquery.uniform.min.js"></script>
<script src="../../includes/maskedinput.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 



<script type="text/javascript">
$(document).ready(function(){ 

	$("#frmclientes").dialog({height:800, width:740, position :["center","top"],style: "margin:0px; padding:0px; float:none;",  resizable:false,title:'Mant. de Impedidos'}); 
		 $("button").button();
		 $("#dialog").dialog();
		 $(".ui-dialog-titlebar").hide();
	
		 fmuestraGrid();
	
		})
	
	$('#btncerrar2').click( function() { alert('das');
		$("#frmclientes").dialog("close");
	});
	
	
	
$(document).ready(function(){ 
	 $("#dialog").dialog();
	 
	 // sets
	 $("#actmunicipal").val("K");
	 $("#idsedereg3").val("09");
	 
	 // sets :
	 $("#_select_ubigensc").click(function(){
		 	$("#buscaubisc3").attr("style","text-transform:uppercase");
			$("#buscaubisc3").val("");
			$("#buscaubisc3").focus();
			$("#resulubisc").html("");
		 })
		 
	 $("#_select_buscaprofe").click(function(){
		 	$("#buscaprofes").attr("style","text-transform:uppercase");
			$("#buscaprofes").val("");
			$("#buscaprofes").focus();
			$("#resulprofesiones").html("");
		 })	 
	
	 $("#_select_buscacargooo").click(function(){
		 	$("#buscacargooss").attr("style","text-transform:uppercase");
			$("#buscacargooss").val("");
			$("#buscacargooss").focus();
			$("#resulcargito").html("");
		 })	 	 
	  
	  $("#_select_buscaubiRUC").click(function(){
		 	$("#buscaubigeo").attr("style","text-transform:uppercase");
			$("#buscaubigeo").val("");
			$("#buscaubigeo").focus();
			$("#resulubigeo").html("");
		 })	 
	 
	 
	 $("#tipoper").bind("click, change",function(){
		 	
			var div_clie_juridico = $("#clie_juridico");
			var div_clienatural   = $("#div_clienatural");
			
			if($(this).val()=='J')
			{
				div_clie_juridico.removeAttr("style","display:none");
				div_clienatural.attr("style","display:none");
			}
				else if($(this).val()=='N')
				{
					div_clie_juridico.attr("style","display:none");
					div_clienatural.removeAttr("style","display:none");
				}
					else
					{
						div_clie_juridico.attr("style","display:none");
						div_clienatural.attr("style","display:none");
					}
					
			//limpia valores:
				// natural
				$("#numdoc").val("");
				$("#apepat").val("");
				$("#apemat").val("");
				$("#prinom").val("");
				$("#segnom").val("");
				$("#direccion").val("");
				$("#ubigensc").val("");
				$("#idestcivil").val("");
				$("#sexo").val("");
				$("#natper").val("");
				$("#cumpclie").val("");
				$("#docpaisemi").val("");
				$("#nomprofesiones").val("");
				$("#nomcargoss").val("");
				$("#telcel").val("");
				$("#telofi").val("");
				$("#telfijo").val("");
				$("#email").val("");
				// juridico
				$("#razonsocial").val("");
				$("#domfiscal").val("");
				$("#ubigen2").val("");
				$("#contacempresa").val("");
				$("#fechaconstitu").val("");
				$("#numregistro").val("");
				$("#idsedereg3").val("09");
				$("#numpartida").val("");
				$("#telempresa").val("");
				$("#actmunicipal").val("K");
				$("#mailempresa").val("");
				$("#codubisc4").val("");
				$("#fechaing2").val("");
				$("#oficio2").val("");
				$("#origen2").val("");
				$("#motivo2").val("");
				$("#codubisc").val("");
				$("#idprofesion").val("");
				$("#idcargoo").val("");
				$("#pep2").val("");
				$("#laft2").val("");
					
		 })
	
	})

jQuery(function($){
//$("#cumpclie").mask("99/99/9999",{placeholder:"_"});

});

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
		 var _tipdocu = $("#tipoper").val();
		 if(_tipdocu=='N')  
		  {
			  grabNewImpedido();
		  }
		   else if(_tipdocu=='J')
			 {
				 grabNewImpedidoRUC();
			 }
	  }
///////////////////////// FUNCIONES GUARDAR :
function grabNewImpedido()
{
	var _tipoper   = $("#tipoper").val(); 
	var _tipodoc   = $("#tipodoc").val(); 
	var _numdoc    = $("#numdoc").val(); 
	var _apepat    = $("#apepat").val(); 
	var _apemat    = $("#apemat").val(); 
	var _prinom    = $("#prinom").val(); 
	var _segnom    = $("#segnom").val(); 
	var _direccion = $("#direccion").val(); 
	var _email     = $("#email").val(); 
	var _telfijo   = $("#telfijo").val(); 
	var _telcel    = $("#telcel").val(); 
	var _telofi    = $("#telofi").val(); 
	var _sexo      = $("#sexo").val(); 
	var _idestcivil   = $("#idestcivil").val(); 
	var _nacionalidad = $("#nacionalidad").val(); 
	var _idprofesion  = $("#idprofesion").val(); 
	var _idcargoo  = $("#idcargoo").val(); 
	var _cumpclie  = $("#cumpclie").val(); 
	var _natper    = $("#natper").val(); 
	var _codubisc  = $("#codubisc").val(); 
	var _nomprofesiones = $("#nomprofesiones").val(); 
	var _nomcargoss = $("#nomcargoss").val(); 
	var _ubigensc   = $("#ubigensc").val(); 
	//var _cconyuge = $("#cconyuge").val(); 
	var _residente  = $("#residente").val(); 
	var _docpaisemi = $("#docpaisemi").val(); 
	
	// Datos de Impedido:
	var _fechaing  = $("#fechaing2").val();
	var _oficio    = $("#oficio2").val(); 
	var _origen    = $("#origen2").val(); 
	var _motivo    = $("#motivo2").val(); 
	var _pep       = $("#pep2").val(); 
	var _laft      = $("#laft2").val(); 
	
	// new
	var _entidad   = $("#entidad2").val(); 
	var _remite    = $("#remite2").val(); 
	
	var data = {
					tipoper : _tipoper,
					tipodoc : _tipodoc,
					numdoc  : _numdoc,
					apepat  : _apepat,
					apemat  : _apemat,
					prinom  : _prinom,
					segnom  : _segnom,
					direccion : _direccion,
					email   : _email,
					telfijo : _telfijo,
					telcel  : _telcel,
					telofi  : _telofi,
					sexo    : _sexo,
					idestcivil : _idestcivil,
					nacionalidad : _nacionalidad,
					idprofesion  : _idprofesion,
					idcargoo : _idcargoo,
					cumpclie : _cumpclie,
					natper   : _natper,
					codubisc : _codubisc,
					nomprofesiones : _nomprofesiones,
					nomcargoss     : _nomcargoss,
					ubigensc : _ubigensc,
					residente : _residente,
					docpaisemi : _docpaisemi,
					fechaing  : _fechaing,
					oficio    : _oficio,
					origen    : _origen,
					motivo    : _motivo,
					pep       : _pep,
					laft      : _laft,
					entidad   : _entidad,
					remite    : _remite
					
		} ;
	
	$.post("../controller/grabar_impedido.php", data , function(){
			alert('Grabado Correctamente');
			fmuestraGrid();
			$("#tippersona").val("");
			$("#descrio").val("");
		})
}


function grabNewImpedidoRUC()
{
	var _tipoper       = $("#tipoper").val(); 
	var _tipodoc       = $("#tipodoc").val(); 
	var _numdoc        = $("#numdoc").val(); 
	var _razonsocial   = $("#razonsocial").val(); 
	var _domfiscal     = $("#domfiscal").val(); 
	var _ubigen2       = $("#ubigen2").val(); 
	var _contacempresa = $("#contacempresa").val(); 
	var _fechaconstitu = $("#fechaconstitu").val(); 
	var _numregistro   = $("#numregistro").val(); 
	var _idsedereg3    = $("#idsedereg3").val(); 
	var _numpartida    = $("#numpartida").val(); 
	var _telempresa    = $("#telempresa").val(); 
	var _actmunicipal  = $("#actmunicipal").val(); 
	var _mailempresa   = $("#mailempresa").val(); 
	var _codubisc4     = $("#codubisc4").val(); 

	// Datos de Impedido:
	var _fechaing      = $("#fechaing2").val();
	var _oficio        = $("#oficio2").val(); 
	var _origen        = $("#origen2").val(); 
	var _motivo        = $("#motivo2").val(); 
	var _pep           = $("#pep2").val(); 
	var _laft          = $("#laft2").val(); 
	
	// new
	var _entidad       = $("#entidad2").val(); 
	var _remite        = $("#remite2").val(); 
	
	var data = {
					tipoper       : _tipoper,
					tipodoc       : _tipodoc,
					numdoc        : _numdoc,
					razonsocial   : _razonsocial,
					domfiscal     : _domfiscal,
					ubigen2       : _ubigen2,
					contacempresa : _contacempresa,
					fechaconstitu : _fechaconstitu,
					numregistro   : _numregistro,
					idsedereg3    : _idsedereg3,
					numpartida    : _numpartida,
					telempresa    : _telempresa,
					actmunicipal  : _actmunicipal,
					mailempresa   : _mailempresa,
					codubisc4     : _codubisc4,
					fechaing      : _fechaing,
					oficio        : _oficio,
					origen        : _origen,
					motivo        : _motivo,
					pep           : _pep,
					laft          : _laft,
					entidad   : _entidad,
					remite    : _remite
		      };
	
	$.post("../controller/grabar_impedidoRUC.php", data , function(){
			alert('Grabado Correctamente');
			fmuestraGrid();
			$("#tippersona").val("");
			$("#descrio").val("");
		})		
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

function mostrarubigeoosc(id,name)
    {
  	  document.getElementById('ubigensc').value = id;
	  document.getElementById('codubisc').value = name;	
	  ocultar_desc('buscaubisc');        
    }

function mostrarprofesioness(id,name)
    {
	  document.getElementById('idprofesion').value = id;
	  document.getElementById('nomprofesiones').value = name;  
	  ocultar_desc('buscaprofe');        
    }
function mostrarcargoos(id,name)
    {
	  document.getElementById('idcargoo').value = id;
	  document.getElementById('nomcargoss').value = name; 
	  ocultar_desc('buscacargooo');        
    }	
	
function casadito(valor)
{
  /* if(valor==2){
    mostrar_desc('casado');
   }else{
    ocultar_desc('casado');
   }*/
}		

// #############################################################################

function mostrarubigeoo2(id,name)
    {
		
	  document.getElementById('codubisc4').value = name;
	  document.getElementById('ubigen2').value = id;
	  ocultar_desc('buscaubi');        
    }

function numnot(f){if (isNaN(f)) {
alert("Error:\nEste campo debe tener sólo números.");
document.getElementById('numdoc').value="";
document.getElementById('numdoc').focus();
return (false);
 }
 }
 
	function fbuscadir(f)
	{
		var combo = document.getElementById('tipoper').value;
		var combo1 = document.getElementById('tipodoc').value;
		var numdoc = document.getElementById('numdoc').value;
		//alert(combo1);
        		
		if(combo == "")
		{alert('Seleccione tipo de persona')
		exit();
		}
		
	   if(combo1 == "")
		{alert('Seleccione tipo de documento')
		exit();
		}
		
		if (isNaN(f)) {
       		if(combo1!=5){
alert("Error:\nEste campo debe tener sólo números.");
document.getElementById('numdoc').value="";
document.getElementById('numdoc').focus();
return (false);

       }

 }
		
		
		$("#dgrid_kardex").load('newimpedidoglobal.php' ,	{_epublic  : combo,val  : numdoc,valor  : combo1	}, function(){
			$('#gridClientes').scrollableFixedHeaderTable(700,500,null,null);
			});
			
	   
			
	}	
	
	 function fmuestraGrid()
	{
		var _ini="ini";
		$("#dgrid_kardex").load('newimpedidoglobal.php',{_epublic  : _ini }, function(){
			$('#gridClientes').scrollableFixedHeaderTable(700,500,null,null);
			});
	}	  
				
</script>
<div id="frmclientes">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="19">
      				  <input name="tipop" id="tipop" type="hidden" />
      				  <input name="datos" id="datos" type="hidden" />
      				  <input name="codclie" id="codclie" type="hidden" />
      				  <input name="tipkar" id="tipkar" type="hidden" />
                      <input name="nomtipkar" id="nomtipkar" type="hidden" />
                      <input name="txtbuscar" id="txtbuscar" type="hidden" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="23%" height="30" align="right">Tipo de persona:</td>
    <td width="18%" height="30"><select name="tipoper" id="tipoper" >
                                        <option value = "" selected="selected">TIPO DE PERSONA</option>
                                        <option value="N">Natural</option>
                                        <option value="J">Jurídica</option>
                                      </select></td>
    <td width="12%" height="30" align="right">Tipo Docum.:</td>
    <td width="47%" height="30"><?php 

			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipodocumento.idtipdoc AS 'id', tipodocumento.destipdoc AS 'des' FROM tipodocumento"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "tipodoc";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//funcionprueba()";   
			$oCombo->selected   =  $variable;
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
  </tr>
  <tr>
    <td height="30" align="right">Num. Docu.:</td>
    <td height="30" colspan="3"><input name="numdoc" type="text" id="numdoc" onkeyup="fbuscadir(this.value)"   maxlength="11" />
      <span style="color:#F00">*</span></td>
  </tr>
 
 
 
  </table>
                   
    </td>
</tr>
<tr><td  width="790" height="19" valign="top">
<!-- <div class="frmclient" id="frmclient" style="width:100%;">

  
</div>-->
<div id="dgrid_kardex" style="width:705px; height:750px; overflow:auto;">

</div></td>
        </tr>
   </table>
</div>


