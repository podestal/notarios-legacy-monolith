<?php 
session_start();

	include("../../conexion.php");
	
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	  ;
	$oBarra = new BarraMenu() 				  ;
	$Grid1 = new GridView()					  ;
	$oCombo = new CmbList()  				  ;	
	
?>
<script type="text/javascript" src="../../ajax.js"></script> 
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
	 {document.getElementById('numdoc').setAttribute('maxlength','8');}
	 
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
		grabarempresa();
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
		if(_tipdoc.value!='N')
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
<form method="post" action="addContratanteN_datos.php">
<table align="center">
<tr>
<td>
</td>                    
</tr>                    
<tr>
   <td height="33" colspan="7" align="left">
<table width="760" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="18" height="29">&nbsp;</td>
                              <td width="707" class="submenutitu">Agregar Cliente</td>
                                                          </tr>
                            <tr>
                              <td colspan="3"><table width="724" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td width="724" height="54" bgcolor="#FFFFFF"><div id="busclie" style=" width:750px; height:250px;">
                                    <table width="659" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10" height="30">&nbsp;</td>
    <td width="119" height="30" align="right"><span class="camposss">Apellido Paterno :</span></td>
    <td width="206" height="30"><input type="text" name="napepat" style="text-transform:uppercase" id="napepat"  onkeyup="apepaterno();"/><span style="color:#F00">*</span></td>
    <td width="125" height="30" align="right"><span class="camposss">Apellido Materno :</span></td>
    <td width="199" height="30"><input type="text" name="napemat" style="text-transform:uppercase" id="napemat"  onkeyup="apematerno();"/></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">1er Nombre :</span></td>
    <td height="30"><input type="text" name="nprinom" style="text-transform:uppercase" id="nprinom"  onkeyup="prinombre();"/><span style="color:#F00">*</span></td>
    <td height="30" align="right"><span class="camposss">2do Nombre :</span></td>
    <td height="30"><input type="text" name="nsegnom" style="text-transform:uppercase" id="nsegnom"  onkeyup="segnombre();"/></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Direccion :</span></td>
    <td height="30" colspan="3"><input name="ndireccion" style="text-transform:uppercase" type="text" id="ndireccion" size="55"  onkeyup="direccion();"/></td>
  </tr>
  <tr>
    <td height="44">&nbsp;</td>
    <td height="44" align="right"><span class="camposss">Ubigeo :</span></td>
    <td height="44" colspan="3"><table width="471" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="336"><input name="ubigensc" readonly="readonly" type="text" id="ubigensc" size="25" /></td>
        <td width="135"><a href="#" onclick="mostrar_desc('buscaubisc')"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a>
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
    <td height="30"><input type="image" src="../../iconos/grabar.png" width="94" height="29" border="0" />
    <input type="hidden" name="numdoc" value="<?php echo $_GET['numdoc'];?>" />
    <input type="hidden" name="tipdoc" value="<?php echo $_GET['tipdoc'];?>" />
    <input type="hidden" name="tipper" value="<?php echo $_GET['tipper'];?>" />
    
    </td>
  </tr>
</table>
</form>
                                  