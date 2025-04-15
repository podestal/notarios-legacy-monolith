<?php 
session_start();
	include("../../conexion.php");
	
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	 ;
	$oBarra = new BarraMenu() 				     ;
	$Grid1  = new GridView()					 ;
	$oCombo = new CmbList()  				     ;  	
	
	$id_poder = $_REQUEST['id_poder'];
	$anio = $_REQUEST['anio'];
	
	$sql =mysql_query("SELECT * FROM poderes_contratantes WHERE poderes_contratantes.id_poder='$id_poder'",$conn) or die(mysql_error());
	
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

	})

	function fremove(){  $("#div_pcontratantes").remove(); }

// EDITA PARTICIPANTE DEL PERMISO
	function editContratante1(_id_poder, _id_contrata)
	{
		$('<div id="div_editcontra" title="div_editcontra"></div>').load('EditContratantes.php?id_poder='+_id_poder+'&id_contrata='+_id_contrata)
		.dialog({
						autoOpen: true,
						position :["center","top"],
						width   : 500,
						height  : 200,
						modal:false,
						resizable:false,
						buttons: [{id: "btnActDatos", text: "Actualizar Datos Cliente",click: function() {ActDatosPartic1(); }},
						
								  {id: "btnaceptar", text: "Aceptar",click: function() {evaleditParticipante();$(this).dialog("destroy").remove(); }},
								  
						{text: "Cancelar",click: function() {$(this).dialog("destroy").remove(); }}],
						title:'Editar Contratantes'
						
						}).width(500).height(200);	
						$(".ui-dialog-titlebar").hide();
	}

// ABRE VENTANA CON LOS DATOS DEL CLIENTE A EDITAR:
// ActDatosPartic()
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
	function ActDatosPartic1()
	{
		var _dni_cliente = document.getElementById('c_codcontrat').value;
		$('<div id="div_editdatosCLient"></div>').load('EditDatosClient1.php?dni_cliente='+_dni_cliente)
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



// GUARDA NUEVO CONTRATANTE PARA EL PODER.
	function newcontratante()
	{
		var _id_poder = document.getElementById('id_poder').value;
		var _tip_poder = document.getElementById('id_asunto').value
		var _id_contrata = "";
		
		$('<div id="div_newcontra" title="div_newcontra"></div>').load('NewContratantes2.php?id_poder='+_id_poder+'&id_contrata='+_id_contrata+'&tip_poder='+_tip_poder)
	.dialog({
					autoOpen: true,
					position :["center","top"],
					width   : 750,
					height  : 400,
					modal:false,
					resizable:false,
					buttons: [{id: "btnAContratante", text: "Aceptar",click: function() { addCont(); }},
					{text: "Cancelar",click: function() {$(this).dialog("destroy").remove(); }}],
					title:'Editar participantes'
					
					}).width(750).height(400);	
					$(".ui-dialog-titlebar").hide();		
	}
	
	function ElimContratante(_id_poder2, _id_contrata2)
	{
		var _id_poder	 = _id_poder2;
		var _id_contrata = _id_contrata2;
		if(confirm('Desea eliminar el contratante..?'))
		{
			felimContratante(_id_poder, _id_contrata);
		}	
	}
	

	function grab1()
	{
		valord=document.getElementById('c_descontrat').value;
	 	textod=valord.replace(/&/g,"*");
		document.getElementById('nc_descontrat').value=textod;
	}
	
	

</script>
<table width="780" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td ><?php
	
	
			  if($rowu['editpod'] == '1')
              { $oBarra->Nuevo        = "1"           	    ; 
				$oBarra->NuevoClick   = "newcontratante();" ;
				$oBarra->clase        = "css"      		    ; 
				$oBarra->widthtxt     = "20"			    ; 
				$oBarra->Show()  						    ; 
                   
			  }else{
				    echo'';
				  }

				?>
      <input name="id_poder" type="hidden" id="id_poder"  value="<?php echo $id_poder; ?>"  />
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
              <td width="16" align="center"><span class="titubuskar0">&nbsp;</span></td>
              <td width="16" align="center"><span class="titubuskar0">&nbsp;</span></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><div id="bkardex">
            <?php 
include("../../conexion.php");


$consulcontrat=mysql_query("SELECT poderes_contratantes.id_poder, poderes_contratantes.id_contrata, poderes_contratantes.c_codcontrat, poderes_contratantes.c_descontrat,
poderes_contratantes.c_fircontrat, c_condiciones.des_condicion
FROM poderes_contratantes 
INNER JOIN c_condiciones ON c_condiciones.id_condicion = poderes_contratantes.c_condicontrat
WHERE poderes_contratantes.id_poder = '$id_poder'", $conn) or die(mysql_error());
$i = 1;
while($row = mysql_fetch_array($consulcontrat)){

$dess=$row['c_descontrat'];
$dess2=str_replace("?","'",$dess);
$dess3=str_replace("*","&",$dess2);
$dess4=strtoupper($dess3);


echo "<table width='100%' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
    <td width='20' align='center' ><span class='reskar'>".$i."</span></td>
	<td width='90' align='center' ><span class='reskar'>".$row['c_codcontrat']."</span></td>
	<td width='151' align='center' ><span class='reskar'>".$dess4."</span></td>
	<td width='28' align='center' ><span class='reskar'>".$row['c_fircontrat']."</span></td>
    <td width='100' align='center'><span class='reskar'>".$row['des_condicion']."</span></td>
	<td width='15' align='center' ><span class='reskar'><a href='#' id='".$row['id_poder']."' name='".$row['id_contrata']."' onclick='editContratante1(this.id,this.name)'><img src='../../iconos/editamv.png' width='16' height='18'></a></span></td>
	<td width='15' align='center' ><span class='reskar'><a href='#' id='".$row['id_poder']."' name='".$row['id_contrata']."' onclick='ElimContratante(this.id,this.name)'><img src='../../iconos/eliminamv.png' width='16' height='18'></a></span></td>
	
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



