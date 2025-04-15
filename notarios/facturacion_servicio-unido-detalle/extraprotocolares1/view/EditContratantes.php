<?php
include("../../conexion.php");
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	 ;
	$oBarra = new BarraMenu() 				     ;
	$Grid1 = new GridView()					     ;
	$oCombo = new CmbList()  				     ;	

$id_poder = $_REQUEST["id_poder"];
$id_contrata  = $_REQUEST["id_contrata"];

$consulcontratantes = mysql_query("SELECT * FROM poderes_contratantes WHERE poderes_contratantes.id_poder='$id_poder' AND poderes_contratantes.id_contrata = '$id_contrata'", $conn) or die(mysql_error());
$rowpart = mysql_fetch_array($consulcontratantes);
	
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>Editar Contratantes</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 

<script type="text/javascript">
       $(document).ready(function(){ 
		
		$("#_selUbieclient").live("click", function(){
				$("#buscaubisccnt").val("");
				$("#buscaubisccnt").focus();
				$("#resulubisccnt").html("");
			})
			
		$("#_selProfeclient").live("click", function(){
				$("#buscaprofescnt").val("");
				$("#buscaprofescnt").focus();
				$("#resulprofesionescnt").html("");
			})
			
		$("#_selCargoclient").live("click", function(){
				$("#buscacargoosscnt").val("");
				$("#buscacargoosscnt").focus();
				$("#resulcargitocnt").html("");
			})		

		})

	function evaleditParticipante(){	
	grab1();
	fEditContratantesPoder(); }
	
	function fcerrardivedicion4()
	{
		$("#div_editcontra").dialog("close");
		$("#div_editcontra").remove();	
	}

	function ActDivContratantes()
	{
		var _id_poder = $("#id_poder").val()
		$("#div_pcontratantes").load("PoderContratantes.php", {id_poder : _id_poder}, function(){
			
			});
	}


	function fShowDatosProveeClick()
	{
	$('<div id="div_addParticipante" title="div_addParticipante"></div>').load('AddParticipante.php')
	.dialog({
					autoOpen : true,
					position :["center","top"],
					width    : 550,
					height   : 250,
					modal : false,
					resizable : false,
					buttons: [{id: "btnaceptar", text: "Aceptar",click: function() {pasadatos();$(this).dialog("close");$("#div_addParticipante").remove(); }},
					{text: "Cancelar",click: function() { $(this).dialog("close");$("#div_addParticipante").remove(); }}],
					title:'Ayuda Cartas'
					
					}).width(550).height(250);	
					$(".ui-dialog-titlebar").hide();
	
		
	}

// Actualiza Datos Cliente:
function ggcliecnt1()
{	
	c_descontrat();
	napepatcnt(),
	napematcnt();
	nprinomcnt();
	nsegnomcnt();
	ndireccioncnt();
	ggcliecntresult1();

}	

function ggcliecntresult1()
{	
	var numdoccnt		= $("#numdoccnt").val(); 
	var apepatcnt		= $("#apepatcnt").val(); 
	var apematcnt		= $("#apematcnt").val(); 
	var prinomcnt		= $("#prinomcnt").val(); 
	var segnomcnt		= $("#segnomcnt").val(); 
	var direccioncnt	= $("#direccioncnt").val(); 
	var emailcnt		= $("#emailcnt").val(); 
	var telfijocnt		= $("#telfijocnt").val(); 
	var telcelcnt		= $("#telcelcnt").val(); 
	var teloficnt		= $("#teloficnt").val(); 
	var sexocnt			= $("#sexocnt").val(); 
	var idestcivilcnt	= $("#idestcivilcnt").val();
	var nacionalidadcnt	= $("#nacionalidadcnt").val(); 
	var idprofesioncnt	= $("#idprofesioncnt").val(); 
	var idcargoocnt		= $("#idcargoocnt").val(); 
	var cumpcliecnt		= $("#cumpcliecnt").val(); 
	var natpercnt		= $("#natpercnt").val(); 
	var codubisccnt		= $("#codubisccnt").val(); 
	var nomprofesionescnt = $("#nomprofesionescnt").val(); 
	var nomcargosscnt	= $("#nomcargosscnt").val(); 
	var ubigensccnt		= $("#ubigensccnt").val(); 
	var residentecnt	= $("#residentecnt").val(); 
	var docpaisemicnt	= $("#docpaisemicnt").val(); 
	var codcliecnt		= $("#codcliecnt").val(); 
	var cconyugecnt		= $("#cconyugecnt").val(); 

	var data = {
				numdoccnt : numdoccnt,
				apepatcnt : apepatcnt,
				apematcnt : apematcnt,
				prinomcnt : prinomcnt,
				segnomcnt : segnomcnt,
				direccioncnt : direccioncnt,
				emailcnt : emailcnt,
				telfijocnt : telfijocnt,
				telcelcnt : telcelcnt,
				teloficnt : teloficnt,
				sexocnt : sexocnt,
				idestcivilcnt : idestcivilcnt,
				nacionalidadcnt : nacionalidadcnt,
				idprofesioncnt : idprofesioncnt,
				idcargoocnt : idcargoocnt,
				cumpcliecnt : cumpcliecnt,
				natpercnt : natpercnt,
				codubisccnt : codubisccnt,
				nomprofesionescnt : nomprofesionescnt,
				nomcargosscnt : nomcargosscnt,
				ubigensccnt : ubigensccnt,
				residentecnt : residentecnt,
				docpaisemicnt : docpaisemicnt,
				codcliecnt : codcliecnt,
				cconyugecnt : cconyugecnt
		}
		
		$.getJSON("../model/grabar_clientecnt.php", data, function(respuesta){
				var _Datos = respuesta;
				
				$("#c_codcontrat").val(_Datos[0].numdoc);
				$("#c_descontrat").val(_Datos[0].nombre);
				alert("Se actualizo el cliente");
				ActDivContratantes();
				$("#div_editdatosCLient").dialog("destroy").remove();
			})	

}	

	function mostrar_desc(objac)
		{
			if(document.getElementById(objac).style.display=="none")
				{document.getElementById(objac).style.display="";}
			else
				{document.getElementById(objac).style.display="";}
		}
	
	function ocultar_desc(objac2)
		{
			if(document.getElementById(objac2).style.display=="")
				{document.getElementById(objac2).style.display="none";}
			else
				{document.getElementById(objac2).style.display="none";}
		}	

	// UBIGEOS
	function buscaubigeossccnt()
		{ 	
			var _buscaubisccnt = $("#buscaubisccnt").val();
			$("#resulubisccnt").load("../model/buscarubigeosccnt.php",{ buscaubisccnt : _buscaubisccnt});
		}
	
		
	function mostrarubigeoosccnt(id,name)
		{
			$("#ubigensccnt").val(id);
			$("#codubisccnt").val(name);
			ocultar_desc('div_buscaubisccnt');  
		}
		
	// PROFESIONES
	function buscaprofesionescnt()
		{ 	
			var _buscaprofescnt = $("#buscaprofescnt").val();
			$("#resulprofesionescnt").load("../model/buscaprofesionnescnt.php",{ buscaprofescnt : _buscaprofescnt});
		}	
		
	function mostrarprofesionesscnt(id,name)
		{
			$("#idprofesioncnt").val(id);
			$("#nomprofesionescnt").val(name);
			ocultar_desc('buscaprofecnt');  
		}
		
	function buscacarguitosscnt()
		{ 	
			var _buscacargoosscnt = $("#buscacargoosscnt").val();
			$("#resulcargitocnt").load("../model/buscacargoscnt.php",{ buscacargoosscnt : _buscacargoosscnt});
		}
		
	function mostrarcargooscnt(id,name)
		{
			$("#idcargoocnt").val(id);
			$("#nomcargosscnt").val(name);
			ocultar_desc('buscacargooocnt');       
		}	
		
	function c_descontrat(){
 	valord=document.getElementById('c_descontrat').value;
 	textod=valord.replace(/&/g,"*");
 	document.getElementById('nc_descontrat').value=textod;
	}
	function napepatcnt(){
 	valord=document.getElementById('napepatcnt').value;
 	textod=valord.replace(/&/g,"*");
 	document.getElementById('apepatcnt').value=textod;
	}
	function napematcnt(){
 	valord=document.getElementById('napematcnt').value;
 	textod=valord.replace(/&/g,"*");
 	document.getElementById('apematcnt').value=textod;
	}
	function nprinomcnt(){
 	valord=document.getElementById('nprinomcnt').value;
 	textod=valord.replace(/&/g,"*");
 	document.getElementById('prinomcnt').value=textod;
	}
	function nsegnomcnt(){
 	valord=document.getElementById('nsegnomcnt').value;
 	textod=valord.replace(/&/g,"*");
 	document.getElementById('segnomcnt').value=textod;
	}
	function ndireccioncnt(){
 	valord=document.getElementById('ndireccioncnt').value;
 	textod=valord.replace(/&/g,"*");
 	document.getElementById('direccioncnt').value=textod;
	}
</script>
<style type="text/css">
<!--
.line {color: #FFFFFF}
.Estilo7 {font-family: Calibri; font-size: 13px; font-style: italic; }
.Estilo14 {font-family: Calibri; font-size: 12px; color: #333333; font-weight: bold; }
.Estilo12 {font-family: Calibri; font-size: 12px; color: #333333; font-style: italic; }
-->
</style>
</head>

<body>

<form id="frmescri" name="frmescri" method="post" action="">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="110" height="45" valign="bottom"><span class="camposss">N.Documen.: </span></td>
                <td width="251" height="45" valign="bottom">
                  <input name="c_codcontrat" type="text"  id="c_codcontrat" style="text-transform:uppercase;"  value="<?php echo $rowpart['c_codcontrat']; ?>" readonly="readonly" />
                </td>
                
              </tr>
              <tr>
                <td height="27"><span class="camposss">Descripcion: </span></td>
                <td height="27"><span class="titus33">
                  <input name="c_descontrat" type="text"  id="c_descontrat" style="text-transform:uppercase;"  onkeyup="grab1();" value="<?php $c_desc = $rowpart['c_descontrat'];
					$textorpat=str_replace("?","'",$c_desc);
					$textoamperpat=str_replace("*","&",$textorpat);
					echo strtoupper($textoamperpat); ?>" size="40" maxlength="3000" readonly="readonly" />
                    <input type="hidden" name="nc_descontrat" id="nc_descontrat" />
                </span></td>
              </tr>
              <tr>
                <td height="28"><span class="camposss">Firma</span>: </td>
                <td height="28">
                  <select name="c_fircontrat" id="c_fircontrat">
                  <option value="SI" <?php if($rowpart['c_fircontrat']=="SI"){echo "selected";} ?>>SI</option>
                  <option value="NO" <?php if($rowpart['c_fircontrat']=="NO"){echo "selected";} ?>>NO</option>
                </select>
                  </td>
              </tr>
              <tr>
                <td height="28"><span class="camposss">Condicion: </span></td>
                <td height="28"><?php 

			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT c_condiciones.id_condicion AS 'id', c_condiciones.des_condicion AS 'des' FROM c_condiciones 
 WHERE c_condiciones.swt_condicion='P'
 ORDER BY des_condicion ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "c_condicontrat";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//funcionprueba()";   
			$oCombo->selected   = $rowpart['c_condicontrat'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
              </tr>
              <tr>
                <td height="28">&nbsp;</td>
                <td height="28"><label><input type="hidden" name="id_poder" id="id_poder" value="<?php echo $rowpart['id_poder']; ?>" />
                  <input type="hidden" name="id_contrata" id="id_contrata" value="<?php echo $rowpart['id_contrata']; ?>" />
                </label></td>
              </tr>
              <tr>
                <td height="28" colspan="2" align="left"></td>
              </tr>
          </table>
            </form>
            
</body>

</html>
