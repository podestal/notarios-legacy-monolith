<?php 
session_start();

	include("../../conexion.php");
	
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	 ;
	$oBarra = new BarraMenu() 				     ;
	$Grid1 = new GridView()					     ;
	$oCombo = new CmbList()  				     ;  	
	
	$id_viaje = $_REQUEST["id_viaje"];
	
	$id_usuario= $_SESSION["id_usu"];
    $sqlu  = mysql_query("SELECT * FROM permisos_usuarios where idusuario = '$id_usuario'",$conn) or die(mysql_error());

    $rowu= mysql_fetch_array($sqlu);


?>
<script type="text/javascript" src="../includes/Mantenimientos.js"></script>
<style type="text/css">
<!--
.titubuskar {
	font-family: Calibri;
	font-size: 12px;
	font-weight: bold;
	font-style: italic;
	color: #003366;
}
.titubuskar0 {font-family: Calibri; font-size: 12px; font-style: italic; font-weight: bold; color: #333333; }
.titubuskar1 {color: #333333}
.reskar2 {font-family: Calibri; font-size: 13px; font-weight: bold; font-style: italic; color: #003366; }
.reskar {font-size: 12px; font-style: italic; color: #333333; font-family: Calibri;}
-->
</style>

<script type="text/javascript">

$(document).ready(function(){ 

	 $("button").button();
	 $("#dialog").dialog();
	 
	 
	 $("#_selectUbiViaje").live("click", function(){
		 	$("#_buscaubisc").val("");
			$("#_buscaubisc").focus();
			$("#resulubisc").html("");
		 })
		 
	// 	 
	 
	})
	
// EDITA PARTICIPANTE DEL PERMISO
function hola(){
		
		valord=document.getElementById('c_descontrat').value;
	 	textod=valord.replace(/&/g,"*");
		 document.getElementById('nc_descontrat').value=textod;
	}
	
	function editContratante(_id_viaje, _id_contratante)
	{
	
		var divobs = $('<div id="div_editparti" title="div_editparti"></div>');
		
		$('<div id="div_editparti" title="div_editparti"></div>').load('EditParticipantes.php?id_viaje='+_id_viaje+'&id_contratante='+_id_contratante)
		.dialog({
						autoOpen: true,
						position :["center","top"],
						width   : 800,
						height  : 350,
						modal:false,
						resizable:false,
						buttons: [{id: "btnActDatos", text: "Actualizar Datos Cliente",click: function() {ActDatosPartic(); }},
								  {id: "editPartic", text: "Aceptar",click: function() {evaleditParticipante();$(this).dialog("destroy").remove(); }},
						{text: "Cancelar",click: function() {$(this).dialog("destroy").remove(); }}],
						title:'Editar participantes'
						
						}).width(800).height(350);	
						$(".ui-dialog-titlebar").hide();
	}

// ABRE VENTANA CON LOS DATOS DEL CLIENTE A EDITAR:
	function ActDatosPartic()
	{
		var _dni_cliente = document.getElementById('c_codcontrat').value;
		$('<div id="div_editdatosCLient"></div>').load('EditDatosClient.php?dni_cliente='+_dni_cliente)
		.dialog({
						autoOpen: true,
						position :["center","top"],
						width   : 620,
						height  : 600,
						modal:false,
						resizable:false,
						buttons: [/*{id: "btnActDatos", text: "Actualizar",click: function() {$(this).dialog("destroy").remove(); }},*/
								  {text: "Cancelar",click: function() {$(this).dialog("destroy").remove(); }}],
						title:'Editar Datos del Cliente'
						});
						$(".ui-dialog-titlebar").hide();
	}


// GUARDA NUEVO PARTICIPANTE PARA EL PERMISO;
	function newParticipante()
	{
			var _eval2 = document.getElementById('_evalIngreso').value;	
			var _id_viaje = document.getElementById('id_viaje').value;
			var _id_contratante = "";
			
		$('<div id="div_newpartic" title="div_newpartic"></div>').load('NewParticipantes2.php?id_viaje='+_id_viaje+'&id_contratante='+_id_contratante+'&eval='+_eval2)
		.dialog({
						autoOpen: true,
						position :["center","top"],
						width   : 850,
						height  : 450,
						modal:false,
						resizable:false,
						buttons: [{id: "btnAcepPartic2", text: "Aceptar",click: function() {evalGuardaParticipante(); }},
						{text: "Cancelar",click: function() {$(this).dialog("destroy").remove(); }}],
						title:'Agregar participantes'
						
						}).width(850).height(450);	
						$(".ui-dialog-titlebar").hide();		
	}
	
	function ElimContratante(_viaje, _contratante)
	{
		 var _a = _viaje;
		 var _b = _contratante; 
		 
		if(confirm('Desea eliminar el contratante..?'))
		{ 
			fElimViajePartic(_a, _b);
		}	
	}


	function Destructor(){ $("#div_participantes").remove();	}

	$('#bntAcepPartic').click( function() { Destructor(); });


</script>
<table width="780" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td >
	
	
	
	<?php
	if($rowu['editvia'] == '1')
      {
		        $oBarra->Nuevo          = "1"           	  ; 
				$oBarra->NuevoClick     = "newParticipante();"   	  ;
				$oBarra->clase          = "css"      		  ; 
				$oBarra->widthtxt       = "20"				  ; 
				$oBarra->Show();  			
		}else{
			
			echo "";
			
			}
				
				?>
      <input name="id_viaje" type="hidden" id="id_viaje"  value="<?php echo $id_viaje; ?>"  />
      <input name="_evalIngreso" type="hidden" id="_evalIngreso" value="<?php echo $_POST["_evalIngreso"] ?>" />
                </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="2"><div id="divmues_contratantes" style="width:420; height:380; ">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#333333" bgcolor="#CCCCCC">
            <tr>
              <td width="20" align="center"><span class="titubuskar0">No</span></td>
              <td width="90" align="center"><span class="titubuskar0">Codigo</span></td>
              <td width="150" align="center"><span class="titubuskar0">Nombre</span></td>
              <td width="20" align="center"><span class="titubuskar0">Firma</span></td>
              <td width="100" align="center"><span class="titubuskar0">Condicion</span></td>
              <td width="17" align="center"><span class="titubuskar0">&nbsp;</span></td>
              <td width="17" align="center"><span class="titubuskar0">&nbsp;</span></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><div id="bkardex">
            <?php 

$consulcontrat=mysql_query("Select * from viaje_contratantes WHERE viaje_contratantes.id_viaje='$id_viaje'", $conn) or die(mysql_error());
$i = 1;
while($row = mysql_fetch_array($consulcontrat)){
$des=$row['c_descontrat'];
$des2=str_replace("?","'",$des);
$des3=str_replace("*","&",$des2);
$des4=strtoupper($des3);

echo "<table width='100%' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
    <td width='20' align='center' ><span class='reskar'>".$i."</span></td>
	<td width='90' align='center' ><span class='reskar'>".$row['c_codcontrat']."</span></td>
	<td width='149' align='center' ><span class='reskar'>".$des4."</span></td>
	<td width='28' align='center' ><span class='reskar'>".$row['c_fircontrat']."</span></td>
    <td width='100' align='center'><span class='reskar'>";
	
	$sqltb=mysql_query("SELECT * FROM c_condiciones WHERE c_condiciones.id_condicion ='".$row['c_condicontrat']."'", $conn) or die(mysql_error());
	$rowtb=mysql_fetch_array($sqltb);
	echo $rowtb['des_condicion'];	
	echo "</span></td>
	<td width='15' align='center' ><span class='reskar'><a href='#' id='".$row['id_viaje']."' name='".$row['id_contratante']."' onclick='editContratante(this.id,this.name)'><img src='../../iconos/editamv.png' width='16' height='18'></a></span></td>
	<td width='15' align='center' ><span class='reskar'><a href='#' id='".$row['id_viaje']."' name='".$row['id_contratante']."' onclick='ElimContratante(this.id,this.name)'><img src='../../iconos/eliminamv.png' width='16' height='18'></a></span></td>
	
  </tr>
</table>";
$i++;
}
?>
          </div></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
