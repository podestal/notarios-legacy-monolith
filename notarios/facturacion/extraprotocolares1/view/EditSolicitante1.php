<?php
include("../../conexion.php");
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	 ;
	$oBarra = new BarraMenu() 				     ;
	$Grid1 = new GridView()					     ;
	$oCombo = new CmbList()  				     ;	

$id_cambio       = $_REQUEST["id_cambio"];
$id_solicitante  = $_REQUEST["id_solicitante"];

$consulsoli = mysql_query("SELECT * FROM ccaracter_solicitantes WHERE ccaracter_solicitantes.id_cambio='$id_cambio' AND ccaracter_solicitantes.id_solicitante = '$id_solicitante'", $conn) or die(mysql_error());
$rowpart = mysql_fetch_array($consulsoli);
	
?>
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<script type="text/javascript">


	function evaleditParticipante(){ feditaCondiciones();}
	
	function fcerrardivedicion()
	{
		$("#div_editparti").dialog("close");
		$("#div_editparti").remove();	
	}

// *********************************************************************************************************
// *********************************************************************************************************

// Actualiza Datos Cliente:
function ggcliecnt()
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
		
		$.getJSON("../model/grabar_clientecntViaje.php", data, function(respuesta){
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
		
		
	function ActDivContratantes()
	{
		var _id_viaje = $("#id_viaje").val()
		$("#div_participantes").load("PermiParticipantes.php", {id_viaje : _id_viaje}, function(){
					
			});
	}
	function fShowDatosProvee5(evento)
{
	var _tipdoc     = document.getElementById('tipdoc_repedit').value;
	var _numdoc		= document.getElementById('numdocu_repedit').value;
	var _nrepresedit	= document.getElementById('nrepresentacion_soli');
	var _nrepresedit1	= document.getElementById('representacion_soli');	
	
	if(evento.keyCode==13) 
				{
					if(_numdoc=='' || _tipdoc==''){alert('Ingrese un numero de documento');return;}
					
					var _des = fShowAjaxDato('../includes/ccnombre.php?numdoc='+_numdoc);
					document.getElementById('nrepresentacion_soli').value = _des;
					document.getElementById('representacion_soli').value = _des;
					
			
					if(_nrepresedit.value==''){alert('No se encuentra registrado');
					
						$('#nrepresentacion_soli').val('');
				

					return; }
				}
}


</script>
<form id="frmescri" name="frmescri" method="post" action="">
           
              <div id="div_editar">
    <table  width="100%">
    <tr>
          <td><span class="camposss">Identificado con:</span> </td>
          <td width="10%"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipodocumento.codtipdoc AS 'id', tipodocumento.destipdoc AS 'des'
FROM tipodocumento
ORDER BY tipodocumento.destipdoc ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "200"; 
			$oCombo->name       = "tipdoc_soli";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  $rowpart['tipdoc_solicitante'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
          <td width="18%" align="right"><span class="camposss">Nro:</span></td>
          <td width="58%"><input name="num_docu_soli" type="text" id="num_docu_soli" style="text-transform:uppercase" onKeyPress="//fShowDatosProvee(event);" value="<?php echo $rowpart['numdocu_solicitante']; ?>" size="16" maxlength="12" /></td>
          </tr>
        <tr>
          <td width="14%"><span class="camposss">Solicitantee:</span></td>
          <td colspan="3">
          <input name="nnombre_soli" type="text" id="nnombre_soli" onkeyup="nuevonnombre_solic();" style="text-transform:uppercase" value="<?php 
		   $c_desc = $rowpart['descri_solicitante'];
		  $textorpat=str_replace("?","'",$c_desc);
		  $textoamperpat=str_replace("*","&",$textorpat);
		  echo strtoupper($textoamperpat); ?>" size="60" maxlength="500" />
           <input type="hidden" name= "nombre_soli" id="nombre_soli" />
          
            </td>
          </tr>
        
        <tr>
          <td><span class="camposss">Domicilio:</span> </td>
          <td colspan="3">
          <input name="ndireccion_soli" type="text" id="ndireccion_soli" onkeyup="nuevondireccion_solic();" style="text-transform:uppercase" value="<?php 
		   $c_desc = $rowpart['domic_solicitante'];
		  $textorpat=str_replace("?","'",$c_desc);
		  $textoamperpat=str_replace("*","&",$textorpat);
		  echo strtoupper($textoamperpat); ?>" size="60" maxlength="3000" />
          <input type="hidden" name= "direccion_soli" id="direccion_soli" />
       </td>
        </tr>
          <tr>
          <td><span class="camposss">Distrito:</span></td>
          <td colspan="3"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT ubigeo.coddis AS 'id', CONCAT(ubigeo.nomdis,'/', ubigeo.nomprov,'/',ubigeo.nomdpto)  AS 'descripcion' FROM ubigeo
ORDER BY ubigeo.nomdis ASC
"; 
			$oCombo->value      = "id";
			$oCombo->text       = "descripcion";
			$oCombo->size       = "150"; 
			$oCombo->name       = "distrito_solic0";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectzona(this.value);";   
			$oCombo->selected   =  $rowpart['ubigeo'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
        </tr>
        <tr>
          <td><span class="camposss">Estado civil:</span></td>
          <td colspan="3"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipoestacivil.idestcivil AS 'id', tipoestacivil.desestcivil AS 'des'
FROM tipoestacivil
ORDER BY tipoestacivil.desestcivil ASC "; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "200"; 
			$oCombo->name       = "ecivil_soli";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  $rowpart['ecivil_solicitante'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
        </tr>
        <tr>
          <td colspan="4">
            <input name="c_nombre" type="hidden" id="c_nombre" style="text-transform:uppercase" value="<?php echo $rowcrono['c_nombre']; ?>" size="60" />
            <input name="c_tipdoc" type="hidden" id="c_tipdoc"  value="<?php echo $rowcrono['c_tipdoc']; ?>" size="60" /><input name="c_numdoc" type="hidden" id="c_numdoc" style="text-transform:uppercase" onKeyPress="//fShowDatosProvee(event);" value="<?php echo $rowcrono['c_numdoc']; ?>" size="15" readonly="readonly" /></td>
        </tr>
        <tr>
          <td colspan="4"><span class="camposss">Quien manifesto actuar por su propio derecho, o en representacion de :</span></td>
        </tr>
        <tr>
          <td><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipodocumento.codtipdoc AS 'id', tipodocumento.destipdoc AS 'des'
FROM tipodocumento
ORDER BY tipodocumento.destipdoc ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "tipdoc_repedit";
			$oCombo->style      = "camposss"; 
			//$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->click      = "validacion1()"; 
			$oCombo->selected   =   $rowpart['tipdoc_representante'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
          <td width="12%" align="center"><span class="camposss">Nro:</span></td>
          <td width="17%"><input name="numdocu_repedit" type="text" id="numdocu_repedit" style="text-transform:uppercase" onKeyPress="fShowDatosProvee5(event);" size="16" maxlength="11" value="<?php echo $rowpart['numdocu_representante']; ?>" /></td>
          <td width="61%">&nbsp;</td>

          </tr>
        <tr>
          <td colspan="4">
     <input name="nrepresentacion_soli" type="text" id="nrepresentacion_soli" onkeyup="nuevorepresentacion_solic();" style="text-transform:uppercase" value="<?php 
		   $c_desc = $rowpart['representante'];
		  $textorpat=str_replace("?","'",$c_desc);
		  $textoamperpat=str_replace("*","&",$textorpat);
		  echo strtoupper($textoamperpat); ?>" size="100" maxlength="500" />
          <input type="hidden" name= "representacion_soli" id="representacion_soli" /></td>
          </tr>
        <tr>
          <td align="right"><span class="camposss">Segun poder inscrito en :</span></td>
          <td colspan="3"><input name="poder_inscrito_soli" type="text" id="poder_inscrito_soli" style="text-transform:uppercase" value="<?php echo $rowpart['poder_inscrito']; ?>" size="84" maxlength="500" /></td>
          </tr>
        <tr>
          <td align="right"><span class="camposss">O tercero con interes legitimo segun</span></td>
          <td colspan="3"><input name="int_legitimo_soli" type="text" id="int_legitimo_soli" style="text-transform:uppercase" value="<?php echo $rowpart['tercero']; ?>" size="84" maxlength="500" /></td>
          </tr>
       
            <tr>
                <td colspan="2"><label><input type="hidden" name="id_cambio" id="id_cambio" value="<?php echo $rowpart['id_cambio']; ?>" />
                  <input type="hidden" name="id_solicitante2" id="id_solicitante2" value="<?php echo $id_solicitante; ?>" />
                </label></td>
              </tr>
        </table>
        </div>
       
            </form>