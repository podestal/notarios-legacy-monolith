<?php
include("conexion.php");
	require_once("barramenu.php") ;
	require_once("includes/gridView.php")  ;
	require_once("includes/combo.php")  	 ;
	$oBarra = new BarraMenu() 				     ;
	$Grid1 = new GridView()					     ;
	$oCombo = new CmbList()  				     ;	

$id_prote    = $_REQUEST["id_prote"];
$id_contrata = $_REQUEST["id_contrata"];
$cod_tipop   = $_REQUEST["cod_tipop"];


$consulcontrat = mysql_query("SELECT * FROM	protesto_participantes WHERE protesto_participantes.id_protesto='$id_prote' AND protesto_participantes.id_participante = '$id_contrata'", $conn) or die(mysql_error());
$rowpart = mysql_fetch_array($consulcontrat);
	
?>
<script type="text/javascript" src="ajax.js"></script> 
<style type="text/css">
div.dalib {
	background:#333333;
	border: 1px solid #333333;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
	-moz-box-shadow: 0px 0px 2px #000000;
	-webkit-box-shadow: 0px 0px 2px #000000;
	box-shadow: 0px 0px 2px #000000;
	width:760px;
	height:299px;
	position:absolute;
	left: 440px;
	top: 40px;
	margin-top: 10px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=70)"; /* expected to work in IE 8 */
	filter: alpha(opacity=70);   /* IE 4-7 */
	zoom: 1;

}
.submenutitu {	font-family: Calibri;
	font-size: 16px;
	font-style: italic;
	color:#FF9900;
}

</style>
<script type="text/javascript">

$(document).ready(function(){ 

	 if(document.getElementById('tipoper').value=='N')
	 {
		 document.getElementById('numdoc').setAttribute('maxlength','8');
	}else if(document.getElementById('tipoper').value=='J')
	 {
		 document.getElementById('numdoc').setAttribute('maxlength','11');
	}
	 
	 
	 
	 $("button").button();
	 $("#dialog").dialog();
	 
	// $("#cumpclie").mask("99/99/9999",{placeholder:"_"});//.datepicker({ dateFormat: "dd/mm/yy" });
	 
	})

	function vercliente(){
		
		buscarclienteprotesto();
		}

	function Destructor()
	{
		$("#div_newpartic").remove();
		$("#datos").remove();	
		$("#div_newpartic").dialog("close");
	}


	function addCont()
	{
		
		
	 var _tipoper = document.getElementById('tipoper').value;
	 
	 if(_tipoper == 'N')
	 {
		var _sino = document.getElementById('c_fircontrat');
		var _condicion = document.getElementById('c_condicontrat');
		
	
				if(document.getElementById('napepat1'))
				{
					
				apepaterno1(); apematerno1(); prinombre1(); direccion1();
				}
				else {
					
					napepat2();
					nprinom2();
					ndireccion2();
					napemat2();
					}
				
			    evalGuardaParticipante();
				 
	 }
 
	 else if(_tipoper == 'J') { faddCondicionesRUC(); }
	}


	function evalGuardaParticipante() { fAddCondiciones3(); }
	
	function fcerrardivedicion3()
	{
		$("#div_newcontra").dialog("close");
		$("#div_newcontra").remove();
		$("#datos").remove();	
	}
		

// #= Para agregar nuevo cliente:
	 function ggclie1()
	 {		
	 		apepaterno();
		    apematerno();
		    prinombre();
		    direccion();
		   ggclie1result();
		 
		
		 }
		 
	function ggclie1result()
	 {
		var _apepat = document.getElementById('apepat');
		var _prinom = document.getElementById('prinom');
		//var _apemat = document.getElementById('apemat');
		var _codubisc= document.getElementById('codubisc');
		var _direccion= document.getElementById('direccion');
		
		var _idestcivil = document.getElementById('idestcivil').value;
		
		if( _apepat.value == '' || _prinom.value == '' )
		
		{alert('Faltan ingresar datos');return;}
		else{
		   grabarclienteprotesto();
		   alert("Cliente grabado satisfactoriamente");
		   /*apepaterno();
		   apematerno();
		   prinombre();
		   direccion();*/

		   ocultar_desc('clientenewdni');
			}
	  
		 }


///////////// Funciones cliente div misma pagina:
	function ocultar_desc(objac2)
		{
			
		if(document.getElementById(objac2).style.display=="")
			document.getElementById(objac2).style.display="none";
		else
			document.getElementById(objac2).style.display="none";
		}	
	
	function mostrar_desc(objac)
		{
			if(document.getElementById(objac).style.display=="none")
				document.getElementById(objac).style.display=""
			else
				document.getElementById(objac).style.display="";
		}
		
// permite crear nueva empresa			
	function newclientempresa()
		{
		mostrar_desc('clientenew');
		}

// boton que graba nueva empresa
	function btngrabaremp()
	{
		grabarempresanp();
		ocultar_desc('clientenew');	
	}
	
// permite crear nueva persona natural
	function newclient()    {	mostrar_desc('clientenewdni');	}	
		
	function mostrarubigeoosc(id,name)
		{
			  document.getElementById('ubigensc').value = id;
			  document.getElementById('codubisc').value = name;  
			  ocultar_desc('buscaubisc');        
		}	

	function fEvalCondi()
	{
		var _tipcondi = document.getElementById('c_condicontrat').value;
		if(_tipcondi=='007')
		{
			document.getElementById('div_codasegurado').style.display = '';
			document.getElementById('div_codtestigo').style.display   = 'none';
			document.getElementById('labelcod1').style.display   = 'none';
			document.getElementById('labelcod2').style.display   = '';
			if(document.getElementById('65149889'))
			{document.getElementById('codi_testigo').value 			  = '';	}
		}
		else if(_tipcondi=='008')
		{
			fshowTestigo();
			document.getElementById('div_codtestigo').style.display   = '';
			document.getElementById('div_codasegurado').style.display = 'none';
			document.getElementById('labelcod1').style.display   = 'none';
			document.getElementById('labelcod2').style.display   = 'none';
			document.getElementById('codi_asegurado').value 		  = '';	
		}
		else if(_tipcondi=='009')
		{
			fshowTestigo();
			document.getElementById('div_codtestigo').style.display   = 'none';
			document.getElementById('labelcod1').style.display   = '';
			document.getElementById('labelcod2').style.display   = 'none';
			document.getElementById('div_codasegurado').style.display = '';
			document.getElementById('codi_asegurado').value 		  = '';	
		}
		else
		{
			document.getElementById('div_codtestigo').style.display   = 'none';
			document.getElementById('div_codasegurado').style.display = 'none';
			document.getElementById('labelcod1').style.display   = 'none';
			document.getElementById('labelcod2').style.display   = 'none';
			if(document.getElementById('codi_testigo'))
			{document.getElementById('codi_testigo').value 			  = '';}
			document.getElementById('codi_asegurado').value 		  = '';	
		}		
	}	


    function combotipodocumento(){
		
		mostrarcombitotipdocu();
		
		}

	function evallenght()
	{
		var _docu = document.getElementById('numdoc');	
		var _tipdoc = document.getElementById('tipoper');
		
		if(_tipdoc.value=='N')
		{ 
			_docu.setAttribute('maxlength','8');
			document.getElementById('numdoc').value = ''
		
		}
		if(_tipdoc.value=='J')
		{
		  _docu.setAttribute('maxlength','11');
		  document.getElementById('numdoc').value = ''
		}
	
	}

// Agrega el ubigeo seleccionado:
	function mostrarubigeoo(id,name)
		{
		  document.getElementById('ubigen').value = id;
		  document.getElementById('codubi').value = name;  
		  ocultar_desc('buscaubi');       
		}
	
	function fshowTestigo()
	{
		
		var _idpoder = document.getElementById('id_poder').value;
		var _testigo = fShowAjaxDato('../includes/showtestigo.php?idpoder='+_idpoder);
		var _tipinca = fShowAjaxDato('../includes/showcmbTipInca.php');	
		document.getElementById('div_codtestigo').innerHTML  ="<table><tr><td></td><td align='center'>Nombre</td><td align='center'>Tipo</td></tr><tr><td>De:</td><td>"+_testigo+"</td><td>"+_tipinca+"</td></tr></table>";		
	}	
	
function apepaterno(){
 valord=document.getElementById('napepat').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('apepat').value=textod;
}

function apematerno(){
 valord=document.getElementById('napemat').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('apemat').value=textod;

}
function prinombre(){
 valord=document.getElementById('nprinom').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('prinom').value=textod;

}
function segnombre(){
 valord=document.getElementById('nsegnom').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('segnom').value=textod;

}
function direccion(){
 valord=document.getElementById('ndireccion').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('direccion').value=textod;

}

//grabar en 2da tabla

function apepaterno1(){

 valord=document.getElementById('napepat1').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('apepat1').value=textod;
}

function apematerno1(){
 valord=document.getElementById('napemat1').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('apemat1').value=textod;

}
function prinombre1(){
 valord=document.getElementById('nprinom1').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('prinom1').value=textod;

}
function segnombre1(){
 valord=document.getElementById('nsegnom1').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('segnom1').value=textod;

}
function direccion1(){
 valord=document.getElementById('ndireccion1').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('direccion1').value=textod;

}

function napepat2(){
 valord=document.getElementById('napepat2').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('apepat2').value=textod;

}

function nprinom2(){
 valord=document.getElementById('nprinom2').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('prinom2').value=textod;

}
function ndireccion2(){
 valord=document.getElementById('ndireccion2').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('direc').value=textod;

}
function napemat2(){
 valord=document.getElementById('napemat2').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('napemat22').value=textod;

}

function casadito(valor)
	{
		var _idtipdoc = $("#idestcivil").val();
		if(_idtipdoc == '1' || _idtipdoc == '3')
		{
			$("#cconyuge").val("0");
		}
		
		
	   if(valor==2){
		mostrar_desc('casado');
	   }else{
		ocultar_desc('casado');
	}

}

function ggclie4()
		{   
			   grabarcliente4();
			   ocultar_desc('conyugesss');
			   alert("Conyuge grabado satisfactoriamente");
		}

function ggclie2()
		{   
		   grabarConyuge2();
		   ocultar_desc('conyugesss');
		   alert("Conyuge grabado satisfactoriamente");
		}
	
</script>

<table>
<tr>
<td>
	<table>
	<tr>
                <td><strong>Busqueda de Cliente</strong></td>
                <td height="26" align="right"><input type="hidden" name="id_protesto" id="id_protesto" value="<?php echo $id_prote  ?>" /></td>
                <td height="26" align="right"><input type="hidden" name="fec_ingreso" id="fec_ingreso" value="<?php echo $fec_ingreso  ?>" /></td>
                <td height="26" align="right"><input type="hidden" name="id_contrata" id="id_contrata" value="<?php echo $rowpart['id_participante']; ?>" />
                <input type="hidden" name="id_tippoder" id="id_tippoder" value="<?php echo $cod_tipop ; ?>" /></td>
                <td height="26" align="right">&nbsp;</td>
                <td height="26" align="right">&nbsp;</td>
              </tr>
              <tr>
                <td height="43" colspan="7"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="22"><select name="tipoper" id="tipoper" onchange="combotipodocumento();" >
                      <option value = "A" selected="selected">TIPO DE PERSONA</option>
                      <option value="N">Natural</option>
                      <option value="J">Jurídica</option>
                    </select></td>
                    <td width="550"><table width="510" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="261" bgcolor="#FFFFFF"><div id="cmbshow"></div></td>
                        <td width="160" align="center" bgcolor="#FFFFFF"><input name="numdoc" type="text" id="numdoc" size="18"  maxlength="11"   /></td>
                        <td width="77" align="right" bgcolor="#FFFFFF"><a  onClick="vercliente();"><img src="iconos/buscarclie.png" width="72" height="29" border="0" /></a></td>
                        <td width="12" align="center" bgcolor="#FFFFFF">&nbsp;</td>
                      </tr>
                    </table>
</td>                    
</tr>                    
<tr>
   <td height="33" colspan="7" align="left"><div id="datos" style="height:130px"></div><div id="clientenewdni" class="dalib" style="display:none; z-index:7;">
<table width="760" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="18" height="29">&nbsp;</td>
                              <td width="707" class="submenutitu">Agregar Cliente</td>
                              <td width="35"><a  onclick="ocultar_desc('clientenewdni')"><img src="iconos/cerrar.png"  width="21" height="20" /></a></td>
                            </tr>
                            <tr>
                              <td colspan="3"><table width="724" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td width="724" height="54" bgcolor="#FFFFFF"><div id="busclie" style=" width:750px; height:250px; overflow:auto">
                                    <table width="607" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10" height="30">&nbsp;</td>
    <td width="119" height="30" align="right"><span class="camposss">Apellido Paterno :</span></td>
    <td width="180" height="30"><input type="text" name="napepat" style="text-transform:uppercase" id="napepat"  onkeyup="apepaterno();"/><input type="hidden" name="apepat" style="text-transform:uppercase" id="apepat" /><span style="color:#F00">*</span></td>
    <td width="119" height="30" align="right"><span class="camposss">Apellido Materno :</span></td>
    <td width="179" height="30"><input type="text" name="napemat" style="text-transform:uppercase" id="napemat"  onkeyup="apematerno();"/><input type="hidden" name="apemat" style="text-transform:uppercase" id="apemat" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">1er Nombre :</span></td>
    <td height="30"><input type="text" name="nprinom" style="text-transform:uppercase" id="nprinom"  onkeyup="prinombre();"/><input type="hidden" name="prinom" style="text-transform:uppercase" id="prinom" /><span style="color:#F00">*</span></td>
    <td height="30" align="right"><span class="camposss">2do Nombre :</span></td>
    <td height="30"><input type="text" name="nsegnom" style="text-transform:uppercase" id="nsegnom"  onkeyup="segnombre();"/><input type="hidden" name="segnom" style="text-transform:uppercase" id="segnom" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Direccion :</span></td>
    <td height="30" colspan="3"><input name="ndireccion" style="text-transform:uppercase" type="text" id="ndireccion" size="55"  onkeyup="direccion();"/><input type="hidden" name="direccion" style="text-transform:uppercase" id="direccion" /></td>
  </tr>
  <tr>
    <td height="44">&nbsp;</td>
    <td height="44" align="right"><span class="camposss">Ubigeo :</span></td>
    <td height="44" colspan="3"><table width="471" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="336"><input name="ubigensc" readonly="readonly" type="text" id="ubigensc" size="25" /></td>
        <td width="135"><a href="#" onclick="mostrar_desc('buscaubisc')"><img src="iconos/seleccionar.png" width="94" height="29" border="0" /></a>
      <div id="buscaubisc" style="position:absolute; display:none; width:637px; height:223px; left: -8px; top: 146px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
        <table width="637" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24" height="29">&nbsp;</td>
            <td width="585"><strong><span class="camposss">Seleccionar Ubigeo:</span></strong></td>
            <td width="28"><a href="#" onclick="ocultar_desc('buscaubisc')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><label>
              <input name="_buscaubisc" type="text" id="_buscaubisc"  style="background:#FFFFFF;" size="50" onkeypress="buscaubigeosscprotestos()" />
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><div id="resulubisc" style="width:585px; height:150px; overflow:auto"></div></td>
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
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Estado Civil :</span></td>
    <td height="30"><select name="idestcivil" id="idestcivil" >
      <option value = "1" selected="selected"></option>
      <?php
	   	  $civil=mysql_query("SELECT * FROM tipoestacivil",$conn) or die(mysql_error());
		  while($rowcicil=mysql_fetch_array($civil)){
		  echo "<option value = ".$rowcicil["idestcivil"].">".nl2br($rowcicil["desestcivil"])."</option>";  
		  }
		?>
    </select></td>
    <td height="30" colspan="2" align="left"><div id="casado" style="display:none"><input id="cconyuge" type="hidden" name="cconyuge">
      <table width="272" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="139" align="right"><span class="camposss">Conyuge :</span></td>
          <td width="133"><a href="#" onclick="mostrar_desc('conyugesss')"><img src="iconos/grabarconyuge.png" width="111" height="29" border="0" /></a></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Sexo :</span></td>
    <td height="30"><select name="sexo" id="sexo">
      <option value = "" selected="selected">SELECCIONE SEXO</option>
      <option value="M">MASCULINO</option>
      <option value="F">FEMENINO</option>
    </select></td>
    <td height="30" align="right">&nbsp;</td>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Nacionalidad :</span></td>
    <td height="30"><select style="width:120px;" name="nacionalidad" id="nacionalidad">
      <option value = "177" selected="selected">PERUANA</option>
      <?php
		  while($rownaci=mysql_fetch_array($naci)){
		  echo "<option value = ".$rownaci["idnacionalidad"].">".nl2br($rownaci["descripcion"])."</option>";  
		  }
		?>
    </select></td>
    <td height="30" align="right"><span class="camposss">Residente :</span></td>
    <td height="30"><label>
      <select name="residente" id="residente">
        <option value="1" selected="selected">SI</option>
        <option value="0">NO</option>
                  </select>
    </label></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Natural de :</span></td>
    <td height="30"><input type="text" style="text-transform:uppercase" name="natper" id="natper" /></td>
    <td height="30" align="right"><span class="camposss">Fecha de Nac. :</span></td>
    <td height="30"><input name="cumpclie" type="text" class="tcal" id="cumpclie" style="text-transform:uppercase" size="20" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Telefono Cel. :</span></td>
    <td height="30"><input name="telcel" type="text" id="telcel" size="20" /></td>
    <td height="30" align="right"><span class="camposss">Telefono Oficina :</span></td>
    <td height="30"><input name="telofi" type="text" id="telofi" size="20" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Telefono Fijo :</span></td>
    <td height="30"><input name="telfijo" type="text" id="telfijo" size="20" /></td>
    <td height="30">&nbsp;</td>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Email :</span></td>
    <td height="30" colspan="3"><input name="email" type="text" id="email" size="60" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right">&nbsp;</td>
    <td height="30"><a  onclick="ggclie1()"><img src="iconos/grabar.png" width="94" height="29" border="0" /></a></td>
    <td height="30">&nbsp;</td>
    <td height="30"><input name="codubisc" type="hidden" id="codubisc" size="15" /><input name="idprofesion" type="hidden" id="idprofesion" size="15" value="0" /><input name="idcargoo" type="hidden" id="idcargoo" size="15" value="0" />
      <input name="nomcargoss" type="hidden" id="nomcargoss" size="40" />
      <input name="nomprofesiones" type="hidden" id="nomprofesiones" size="40" />
      <input type="hidden" name="docpaisemi" id="docpaisemi" value="PERU" /></td>
  </tr>
</table>
                                    </div></td>
                                  </tr>
                              </table></td>
                            </tr>
                          </table>
</div>

<!-- ############################################################################################### -->
<!-- PARA AGREGAR NUEVO CON RUCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCC  -->
<form id="frmprotocolares" name="frmprotocolares">
<div id="clientenew" class="dalib" style="display:none; z-index:7; color: #F90; font-weight: bold; font-family: Calibri; font-style: italic;">
                          <table width="760" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="18" height="29">&nbsp;</td>
                              <td width="707" class="editcampp">Agregar Cliente</td>
                              <td width="35"><a  onclick="ocultar_desc('clientenew')"><img src="iconos/cerrar.png" width="21" height="20" /></a></td>
                            </tr>
                            <tr>
                              <td height="233" colspan="3"><table width="724" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td width="724" height="54" bgcolor="#FFFFFF"><div id="busclie" style=" width:720px; height:230px; overflow:auto">
                                      <table width="637" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
                                        <tr>
                                          <td height="32" align="right" ><span class="camposss">Razón Social</span></td>
                                          <td height="32" >&nbsp;</td>
                                          <td height="32" colspan="5"><label>
                                            <input name="razonsocial" type="text" style="text-transform:uppercase" id="razonsocial" size="60" />
                                            <span style="color:#F00">*</span> </label>
                                            <label></label>
                                            <div id="menucondicion" class="menucondicion" style="display:none; z-index:3;" >
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
                                          <td height="26" colspan="5"><input name="domfiscal" style="text-transform:uppercase" type="text" id="domfiscal" size="60" />
                                            <span style="color:#F00">*</span></td>
                                        </tr>
                                        <tr>
                                          <td height="30" align="right" ><span class="camposss">Ubigeo</span></td>
                                          <td height="0" >&nbsp;</td>
                                          <td height="0" colspan="5" valign="middle"><table width="500" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td width="381"><input name="ubigen" type="text" id="ubigen" size="50" />
                                                <span style="color:#F00">*</span></td>
                                              <td width="119"><a href="#" onclick="mostrar_desc('buscaubi')"><img src="iconos/seleccionar.png" width="94" height="29" border="0" /></a></td>
                                            </tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td height="30" align="right" ><span class="camposss">Objeto Social</span></td>
                                          <td height="0" >&nbsp;</td>
                                          <td height="0" colspan="5"><input name="contacempresa" style="text-transform:uppercase" type="text" id="contacempresa" size="60" /></td>
                                        </tr>
                                        <tr>
                                          <td height="30" align="right" ><span class="camposss">Fecha de Const.</span></td>
                                          <td height="30" >&nbsp;</td>
                                          <td width="155" height="30"><input type="text" name="fechaconstitu" class="tcal" style="text-transform:uppercase" id="fechaconstitu" /></td>
                                          <td width="15" height="30" >&nbsp;</td>
                                          <td width="138" height="30" align="right" ><span class="camposss">Nº de Registro</span></td>
                                          <td width="14" height="30" >&nbsp;</td>
                                          <td height="30" ><input type="text" name="numregistro" style="text-transform:uppercase" id="numregistro" /></td>
                                        </tr>
                                        <tr>
                                          <td height="30" align="right" ><span class="camposss">Sede Registral</span></td>
                                          <td height="30" >&nbsp;</td>
                                          <td height="30"><label><span class="titupatrimo">
                                            <select name="idsedereg3" id="idsedereg3">
                                              <?php
		   
		   $sqlsedesss=mysql_query("SELECT * FROM sedesregistrales",$conn) or die(mysql_error()); 
	       while($rowsedesss = mysql_fetch_array($sqlsedesss)){
	         echo "<option value=".$rowsedesss['idsedereg'].">".$rowsedesss['dessede']."</option> \n";
             }
	     ?>
                                            </select>
                                          </span></label></td>
                                          <td height="30">&nbsp;</td>
                                          <td height="30" align="right" ><span class="camposss">N° de Partida</span></td>
                                          <td height="30" >&nbsp;</td>
                                          <td height="30" ><label>
                                            <input type="text" name="numpartida" style="text-transform:uppercase" id="numpartida" />
                                          </label></td>
                                        </tr>
                                        <tr>
                                          <td width="141" height="30" align="right" ><span class="camposss">Telefono</span></td>
                                          <td width="10" height="30" >&nbsp;</td>
                                          <td height="30"><label>
                                            <input type="text" name="telempresa" style="text-transform:uppercase" id="telempresa" />
                                          </label></td>
                                          <td height="30">&nbsp;</td>
                                          <td height="30" align="right" ><span class="camposss">Rubro del Cliente</span></td>
                                          <td height="30" >&nbsp;</td>
                                          <td height="30" ><label>
                                            <select style="width:200px;" name="actmunicipal" id="actmunicipal">
                                              <?php
		   
		   $sqlciiu=mysql_query("SELECT * FROM ciiu",$conn) or die(mysql_error()); 
	       while($rowciuu = mysql_fetch_array($sqlciiu)){
	         echo "<option value=".$rowciuu['coddivi'].">".$rowciuu['nombre']."</option> \n";
             }
	     ?>
                                            </select>
                                          </label></td>
                                        </tr>
                                        <tr>
                                          <td height="30" align="right" ><span class="camposss">Correo de la empresa</span></td>
                                          <td height="30" >&nbsp;</td>
                                          <td height="30" colspan="5" valign="middle" ><label>
                                            <input name="mailempresa" type="text" id="mailempresa" size="60" />
                                          </label>
                                            <div id="buscaubi" style="position:absolute; display:none; width:637px; height:223px; left: 8px; top: 110px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
                                              <table width="637" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                  <td width="24" height="29">&nbsp;</td>
                                                  <td width="585" class="camposss">Seleccionar Ubigeo:</td>
                                                  <td width="28"><a href="#" onclick="ocultar_desc('buscaubi')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                                                </tr>
                                                <tr>
                                                  <td>&nbsp;</td>
                                                  <td><label>
                                                    <input name="buscaubi" type="text" id="buscaubi" size="50"  onkeyup="buscaubigeos()" />
                                                  </label></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                  <td>&nbsp;</td>
                                                  <td><div id="resulubi" style="width:585px; height:150px; overflow:auto"></div></td>
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
                                        <tr>
                                          <td height="30" align="right" >&nbsp;</td>
                                          <td height="30" >&nbsp;</td>
                                          <td height="30" colspan="5" ><a  onclick="btngrabaremp()"><img src="iconos/grabar.png" width="94" height="29" border="0" />
                                            <input name="codubi" type="hidden" id="codubi" size="15" />
                                          </a></td>
                                        </tr>
                                      </table>
                                    </div></td>
                                  </tr>
                              </table></td>
                            </tr>
                          </table>
                      </div>                      
<!-- ############ FIN NUEVO CON RUUUUUUUUCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCC ######################### -->
<!-- ############################################################################################### -->
</td>
</tr>                    
</table>
</form>
<!------------------------------------- INGRESO DE CONYUGE ---------------------------------------------->
<div id="conyugesss" style="position:absolute; display:none; width:662px; height:307px; left: 10px; top: 100px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="659" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="13" height="29">&nbsp;</td>
      <td width="130"><span class="Estilo42">Ingresar Conyuge </span></td>
      <td width="206" align="right" class="camposss"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT CAST(tipodocumento.codtipdoc AS DECIMAL) AS 'id', tipodocumento.destipdoc AS 'des'
FROM tipodocumento
ORDER BY tipodocumento.destipdoc ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "120"; 
			$oCombo->name       = "tipdoc_conyuge";
			$oCombo->style      = ""; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   = "1";
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>&nbsp;&nbsp;
        N°:</td>
      <td width="143"><input name="numdoc2" type="text" id="numdoc2" style="background:#FFFFFF" size="20" maxlength="11"  /></td>
      <td width="144"><a  onclick="buscaclientes2()"><img src="iconos/buscarclie.png" width="72" height="29" border="0" /></a></td>
      <td width="23"><a href="#" onClick="ocultar_desc('conyugesss')"><img src="iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td colspan="4"><div id="nuevaconyuge" style="width:618px; height:220px; overflow:auto"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="4">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>

<!------------------------------------- FIN INGRESO DE CONYUGE ------------------------------------------>