<?php 
include("conexion.php");
$idusu=$_GET['idusu'];
$consulta = mysql_query("SELECT * FROM usuarios where idusuario=$idusu", $conn) or die(mysql_error());
$rowuser = mysql_fetch_array($consulta);

$consulta2 = mysql_query("SELECT * FROM permisos_usuarios where idusuario=$idusu", $conn) or die(mysql_error());
$rowuser2 = mysql_fetch_array($consulta2);

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Permisos de Usuario</title>

<script src="tabsx.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
 
    $('#tabs .tabscontent>div').not('div:first').hide();
    $('#tabs ul li:first,#tabs .tabscontent>div:first').addClass('active');
 
    $('#tabs ul li a').click(function(){
 
        var currentTab = $(this).parent();
        if(!currentTab.hasClass('active')){
            $('#tabs ul li').removeClass('active');             
 
            $('#tabs .tabscontent>div').slideUp('fast').removeClass('active');
 
            var currentcontent = $($(this).attr('href'));
            currentcontent.slideDown('fast', function() {
                currentTab.addClass('active');
                currentcontent.addClass('active');
            });
        }
        return false;                           
    });
});
</script>
<style type="text/css">
* { box-sizing: border-box;}
body{font-size:11px;font-family:Verdana, Geneva, sans-serif;}
a{ color: #000; text-decoration: none;}
.content *:first-child {margin-top: 0;}
.content *:last-child {margin-bottom: 0;}
 
/*clearfix*/
.clearfix:before, .clearfix:after { display: table; content: ""; }
.clearfix:after { clear: both; }
.clearfix { zoom: 1; }
 
/*tabs ul*/
.tabs ul{
    margin: 0;padding: 0;
}
 
/*tabs li*/
.tabs li { 
    position: relative; 
    display: inline-block; 
    margin: 1px .2em 0 0; 
    padding: 0;
    list-style: none; white-space: nowrap;
}
 
.tabs li.active a{
    position: relative;
    z-index: 10;
    margin-bottom: -1px;
    padding-bottom: 6px;
    background: #FAFAFA;
    box-shadow: 0 0 8px rgba(0, 0, 0, .2);
	font-family:Verdana, Geneva, sans-serif;
	font-size:15px;
	font:bold;
	color:#036;
}
 
/*tabs a*/
.tabs a{
    display: inline-block;
    margin-bottom: -5px;
    padding: 5px;
    padding-bottom: 10px;
    border: 1px solid #DFDFDF;
    border-bottom: none;
    border-radius: 5px 5px 0 0;
    background: #F3F3F3;
	font-family:Verdana, Geneva, sans-serif;
	font-size:13px;
	color:#036;
	
}
 
/*content*/
.tabs .tabscontent {
    position: relative;
    display: block;
    float: left; 
    border: 1px solid #DFDFDF;
    border-radius: 5px;
    background: #F3F3F3;
    box-shadow: 0 0 10px rgba(0, 0, 0, .2);
}
.tabs .tabscontent .active{
    position: relative;
    z-index: 200;
    display: inline-block;
    border-radius: 5px;
    background: #FAFAFA;
}
 
/*first tab with border-radius 0*/
.tabs .tabscontent:first-child,
.tabs .tabscontent .active:first-child {
    border-top-left-radius: 0;
}
 
.tabs .content{
    padding: 20px;
}
</style>

</head>

<body style="font-size:62.5%;">
<form action="grabar_permisos_usu.php" method="post">
<table  width="711" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
    <td height="50" colspan="3"><span style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#036;"><strong>Permisos Para : </strong></span><?php echo $rowuser['apepat']." ".$rowuser['apemat']." ".$rowuser['prinom']." ".$rowuser['segnom'];?>
      <label for="iduser"></label>
      <input type="hidden" name="iduser" id="iduser" value="<?php echo $rowuser['idusuario']; ?>"></td>
  </tr>
  <tr>
    <td height="49" colspan="3"><div id="tabs" class="tabs">
    <ul>
        <li><a href="#tab-1">Protocolares</a></li>
        <li><a href="#tab-2">Extra Protocolares</a></li>
        <li><a href="#tab-3">Reportes</a></li>
        <li><a href="#tab-4">Caja</a></li>
        <li><a href="#tab-5">Usuarios</a></li>
        <li><a href="#tab-6">Herramientas</a></li>
        <li><a href="#tab-7">Configuraciones</a></li>
    </ul>
    <div class="tabscontent">
        <div id="tab-1">
            <div class="content">
                <table width="670" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"><span style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#036"><strong>Kardex</strong></span></td>
    <td colspan="2"><span style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#036"><strong>Protestos</strong></span></td>
    </tr>
  <tr>
    <td width="27">&nbsp;</td>
    <td width="271">&nbsp;</td>
    <td width="29">&nbsp;</td>
    <td width="343">&nbsp;</td>
    </tr>
  <tr>
    <td>
    <?php if($rowuser2['kardex']=="1"){echo'<input type="checkbox" checked name="1" id="1">';}else{echo'<input type="checkbox" name="1" id="1">';} ?>
    </td>
    <td>Kardex</td>
    <td><?php if($rowuser2['protesto']=="1"){echo'<input type="checkbox" checked name="4" id="4">';}else{echo'<input type="checkbox" name="4" id="4">';} ?></td>
    <td>Protestos</td>
    </tr>
  <tr>
    <td>
    <?php if($rowuser2['newkar']=="1"){echo'<input type="checkbox" checked name="2" id="2">';}else{echo'<input type="checkbox" name="2" id="2">';} ?>
   </td>
    <td>Crear Kardex</td>
    <td>
    <?php if($rowuser2['newprot']=="1"){echo'<input type="checkbox" checked name="5" id="5">';}else{echo'<input type="checkbox" name="5" id="5">';} ?>
    </td>
    <td>Crear Protestos</td>
    </tr>
  <tr>
    <td><?php if($rowuser2['editkar']=="1"){echo'<input type="checkbox" checked name="3" id="3">';}else{echo'<input type="checkbox" name="3" id="3">';} ?></td>
    <td>Editar Kardex</td>
    <td><?php if($rowuser2['editprot']=="1"){echo'<input type="checkbox" checked name="6" id="6">';}else{echo'<input type="checkbox" name="6" id="6">';} ?></td>
    <td>Editar Protestos</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>

            </div>
        </div>
        <div id="tab-2">
            <div class="content">
              <table width="667" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td colspan="2"><span style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#036"><strong>Permisos de Viaje</strong></span></td>
                  <td colspan="2"><span style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#036"><strong>Poderes</strong></span></td>
                  <td colspan="2"><span style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#036"><strong>Cartas</strong></span></td>
                </tr>
                <tr>
                  <td width="23">&nbsp;</td>
                  <td width="183">&nbsp;</td>
                  <td width="22">&nbsp;</td>
                  <td width="216">&nbsp;</td>
                  <td width="23">&nbsp;</td>
                  <td width="200">&nbsp;</td>
                </tr>
                <tr>
                  <td><?php if($rowuser2['pviaje']=="1"){echo'<input type="checkbox" checked name="7" id="7">';}else{echo'<input type="checkbox" name="7" id="7">';} ?>
                    </td>
                  <td>Permisos de Viajes</td>
                  <td><?php if($rowuser2['poder']=="1"){echo'<input type="checkbox" checked name="10" id="10">';}else{echo'<input type="checkbox" name="10" id="10">';} ?></td>
                  <td>Poderes</td>
                  <td><?php if($rowuser2['cartas']=="1"){echo'<input type="checkbox" checked name="13" id="13">';}else{echo'<input type="checkbox" name="13" id="13">';} ?></td>
                  <td>Cartas</td>
                </tr>
                <tr>
                  <td><?php if($rowuser2['newvia']=="1"){echo'<input type="checkbox" checked name="8" id="8">';}else{echo'<input type="checkbox" name="8" id="8">';} ?></td>
                  <td>Crear Permisos de viajes</td>
                  <td><?php if($rowuser2['newpod']=="1"){echo'<input type="checkbox" checked name="11" id="11">';}else{echo'<input type="checkbox" name="11" id="11">';} ?></td>
                  <td>Crear Poderes</td>
                  <td><?php if($rowuser2['newcar']=="1"){echo'<input type="checkbox" checked name="14" id="14">';}else{echo'<input type="checkbox" name="14" id="14">';} ?></td>
                  <td>Crear Cartas</td>
                </tr>
                <tr>
                  <td><?php if($rowuser2['editvia']=="1"){echo'<input type="checkbox" checked name="9" id="9">';}else{echo'<input type="checkbox" name="9" id="9">';} ?></td>
                  <td>Editar Permisos de viajes</td>
                  <td><?php if($rowuser2['editpod']=="1"){echo'<input type="checkbox" checked name="12" id="12">';}else{echo'<input type="checkbox" name="12" id="12">';} ?></td>
                  <td>Editar Poderes</td>
                  <td><?php if($rowuser2['editcar']=="1"){echo'<input type="checkbox" checked name="15" id="15">';}else{echo'<input type="checkbox" name="15" id="15">';} ?></td>
                  <td>Editar Cartas</td>
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
                  <td colspan="2"><strong><span style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; color: #036">Libros</span></strong></td>
                  <td colspan="2"><span style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#036"><strong>Capaz</strong></span></td>
                  <td colspan="2"><span style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#036"><strong>Incapaz</strong></span></td>
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
                  <td><?php if($rowuser2['libros']=="1"){echo'<input type="checkbox" checked name="16" id="16">';}else{echo'<input type="checkbox" name="16" id="16">';} ?>
                    </td>
                  <td>Libros</td>
                  <td><?php if($rowuser2['capaz']=="1"){echo'<input type="checkbox" checked name="19" id="19">';}else{echo'<input type="checkbox" name="19" id="19">';} ?></td>
                  <td>Capaz</td>
                  <td><?php if($rowuser2['incapaz']=="1"){echo'<input type="checkbox" checked name="22" id="22">';}else{echo'<input type="checkbox" name="22" id="22">';} ?></td>
                  <td>Incapaz</td>
                </tr>
                <tr>
                  <td><?php if($rowuser2['newlib']=="1"){echo'<input type="checkbox" checked name="17" id="17">';}else{echo'<input type="checkbox" name="17" id="17">';} ?></td>
                  <td>Crear Libros</td>
                  <td><?php if($rowuser2['newcap']=="1"){echo'<input type="checkbox" checked name="20" id="20">';}else{echo'<input type="checkbox" name="20" id="20">';} ?></td>
                  <td>Crear Cert. Persona Capaz</td>
                  <td><?php if($rowuser2['newinca']=="1"){echo'<input type="checkbox" checked name="23" id="23">';}else{echo'<input type="checkbox" name="23" id="23">';} ?></td>
                  <td>Crear Cert. Persona Incapaz</td>
                </tr>
                <tr>
                  <td><?php if($rowuser2['editlib']=="1"){echo'<input type="checkbox" checked name="18" id="18">';}else{echo'<input type="checkbox" name="18" id="18">';} ?></td>
                  <td>Editar Libros</td>
                  <td><?php if($rowuser2['editcap']=="1"){echo'<input type="checkbox" checked name="21" id="21">';}else{echo'<input type="checkbox" name="21" id="21">';} ?></td>
                  <td>Editar Cert. Persona Capaz</td>
                  <td><?php if($rowuser2['editinca']=="1"){echo'<input type="checkbox" checked name="24" id="24">';}else{echo'<input type="checkbox" name="24" id="24">';} ?></td>
                  <td>Editar Cert. Persona Incapaz</td>
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
                  <td colspan="2"><strong><span style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; color: #036">Domiciliario</span></strong></td>
                  <td colspan="2"><span style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#036"><strong>Cambio de Caracteristicas</strong></span></td>
                  <td>&nbsp;</td>
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
                  <td><?php if($rowuser2['domiciliario']=="1"){echo'<input type="checkbox" checked name="25" id="25">';}else{echo'<input type="checkbox" name="25" id="25">';} ?></td>
                  <td>Cert. Domiciliario</td>
                  <td><?php if($rowuser2['caracteristicas']=="1"){echo'<input type="checkbox" checked name="28" id="28">';}else{echo'<input type="checkbox" name="28" id="28">';} ?></td>
                  <td>Cambio de Caracteristica</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><?php if($rowuser2['newdom']=="1"){echo'<input type="checkbox" checked name="26" id="26">';}else{echo'<input type="checkbox" name="26" id="26">';} ?></td>
                  <td>Crear Cert. Domiciliario</td>
                  <td><?php if($rowuser2['newcarac']=="1"){echo'<input type="checkbox" checked name="29" id="29">';}else{echo'<input type="checkbox" name="29" id="29">';} ?></td>
                  <td>Crear Cambio de Caracteristica</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><?php if($rowuser2['editdom']=="1"){echo'<input type="checkbox" checked name="27" id="27">';}else{echo'<input type="checkbox" name="27" id="27">';} ?></td>
                  <td>Editar Cert. Domiciliario</td>
                  <td><?php if($rowuser2['editcarac']=="1"){echo'<input type="checkbox" checked name="30" id="30">';}else{echo'<input type="checkbox" name="30" id="30">';} ?></td>
                  <td>Editar Cambio de Caracteristica</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
            </div>
        </div>
        <div id="tab-3">
            <div class="content">
                <table width="667" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td colspan="2"><span style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#036"><strong>Indices Cronologicos</strong></span></td>
                  <td colspan="2">&nbsp;</td>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td width="23">&nbsp;</td>
                  <td width="170">&nbsp;</td>
                  <td width="25">&nbsp;</td>
                  <td width="193">&nbsp;</td>
                  <td width="22">&nbsp;</td>
                  <td width="234">&nbsp;</td>
                </tr>
                <tr>
                  <td><?php if($rowuser2['indicronoep']=="1"){echo'<input type="checkbox" checked name="31" id="31">';}else{echo'<input type="checkbox" name="31" id="31">';} ?>
                    </td>
                  <td>Escrituras Públicas</td>
                  <td><?php if($rowuser2['indicronoprot']=="1"){echo'<input type="checkbox" checked name="39" id="39">';}else{echo'<input type="checkbox" name="39" id="39">';} ?></td>
                  <td>Protestos</td>
                  <td><?php if($rowuser2['indicronopod']=="1"){echo'<input type="checkbox" checked name="44" id="44">';}else{echo'<input type="checkbox" name="44" id="44">';} ?></td>
                  <td>Poderes</td>
                  </tr>
                <tr>
                  <td><?php if($rowuser2['indicrononc']=="1"){echo'<input type="checkbox" checked name="32" id="32">';}else{echo'<input type="checkbox" name="32" id="32">';} ?></td>
                  <td>No Contenciosos</td>
                  <td><?php if($rowuser2['infocamacome']=="1"){echo'<input type="checkbox" checked name="40" id="40">';}else{echo'<input type="checkbox" name="40" id="40">';} ?></td>
                  <td>Informe Camara de Comercio</td>
                  <td><?php if($rowuser2['indicronocapaz']=="1"){echo'<input type="checkbox" checked name="45" id="45">';}else{echo'<input type="checkbox" name="45" id="45">';} ?></td>
                  <td>Persona Capaz</td>
                  </tr>
                <tr>
                  <td><?php if($rowuser2['indicronotv']=="1"){echo'<input type="checkbox" checked name="33" id="33">';}else{echo'<input type="checkbox" name="33" id="33">';} ?></td>
                  <td>Transferencias Vehiculares</td>
                  <td><?php if($rowuser2['indicronocar']=="1"){echo'<input type="checkbox" checked name="41" id="41">';}else{echo'<input type="checkbox" name="41" id="41">';} ?></td>
                  <td>Cartas</td>
                  <td><?php if($rowuser2['indicronoincapaz']=="1"){echo'<input type="checkbox" checked name="46" id="46">';}else{echo'<input type="checkbox" name="46" id="46">';} ?></td>
                  <td>Persona Incapaz</td>
                  </tr>
                <tr>
                  <td><?php if($rowuser2['indicronogm']=="1"){echo'<input type="checkbox" checked name="34" id="34">';}else{echo'<input type="checkbox" name="34" id="34">';} ?></td>
                  <td>Garantias Mobiliarias</td>
                  <td><?php if($rowuser2['indicronolib']=="1"){echo'<input type="checkbox" checked name="42" id="42">';}else{echo'<input type="checkbox" name="42" id="42">';} ?></td>
                  <td>Libros</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><?php if($rowuser2['indicronotest']=="1"){echo'<input type="checkbox" checked name="35" id="35">';}else{echo'<input type="checkbox" name="35" id="35">';} ?></td>
                  <td>Testamentos</td>
                  <td><?php if($rowuser2['indicronovia']=="1"){echo'<input type="checkbox" checked name="43" id="43">';}else{echo'<input type="checkbox" name="43" id="43">';} ?></td>
                  <td>Viajes</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                  <td colspan="2">&nbsp;</td>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2"><strong><span style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; color: #036">Indices Alfabeticos</span></strong></td>
                  <td colspan="2">&nbsp;</td>
                  <td colspan="2">&nbsp;</td>
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
                  <td><?php if($rowuser2['alfaep']=="1"){echo'<input type="checkbox" checked name="47" id="47">';}else{echo'<input type="checkbox" name="47" id="47">';} ?></td>
                  <td>Escrituras Públicas</td>
                  <td><?php if($rowuser2['alfatv']=="1"){echo'<input type="checkbox" checked name="50" id="50">';}else{echo'<input type="checkbox" name="50" id="50">';} ?></td>
                  <td>Transferencias Vehiculares</td>
                  <td><?php if($rowuser2['alfatesta']=="1"){echo'<input type="checkbox" checked name="51" id="51">';}else{echo'<input type="checkbox" name="51" id="51">';} ?></td>
                  <td>Testamentos</td>
                </tr>
                <tr>
                  <td><?php if($rowuser2['alfanc']=="1"){echo'<input type="checkbox" checked name="49" id="49">';}else{echo'<input type="checkbox" name="49" id="49">';} ?></td>
                  <td>No Contenciosos</td>
                  <td><?php if($rowuser2['alfagm']=="1"){echo'<input type="checkbox" checked name="48" id="48">';}else{echo'<input type="checkbox" name="48" id="48">';} ?></td>
                  <td>Garantias Mobiliarias</td>
                  <td>&nbsp;</td>
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
                  <td colspan="2"><strong><span style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; color: #036">Archivos PDT</span></strong></td>
                  <td colspan="2"><span style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#036"><strong>Otros</strong></span></td>
                  <td>&nbsp;</td>
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
                  <td><?php if($rowuser2['pdtep']=="1"){echo'<input type="checkbox" checked name="52" id="52">';}else{echo'<input type="checkbox" name="52" id="52">';} ?></td>
                  <td>Escrituras Públicas</td>
                  <td><?php if($rowuser2['ro']=="1"){echo'<input type="checkbox" checked name="56" id="56">';}else{echo'<input type="checkbox" name="56" id="56">';} ?></td>
                  <td>Registro de Operaciones</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><?php if($rowuser2['pdtveh']=="1"){echo'<input type="checkbox" checked name="54" id="54">';}else{echo'<input type="checkbox" name="54" id="54">';} ?></td>
                  <td>Transferencias Vehiculares</td>
                  <td><?php if($rowuser2['reportuif']=="1"){echo'<input type="checkbox" checked name="57" id="57">';}else{echo'<input type="checkbox" name="57" id="57">';} ?></td>
                  <td>Reportes UIF / IAOC</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><?php if($rowuser2['pdtgm']=="1"){echo'<input type="checkbox" checked name="53" id="53">';}else{echo'<input type="checkbox" name="53" id="53">';} ?></td>
                  <td>Garantias Mobiliarias</td>
                  <td><?php if($rowuser2['reportpendfirma']=="1"){echo'<input type="checkbox" checked name="58" id="58">';}else{echo'<input type="checkbox" name="58" id="58">';} ?></td>
                  <td colspan="3">Reporte Pendiente de Conclusion</td>
                  </tr>
                <tr>
                  <td><?php if($rowuser2['pdtlib']=="1"){echo'<input type="checkbox" checked name="55" id="55">';}else{echo'<input type="checkbox" name="55" id="55">';} ?></td>
                  <td>Libros</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
            </div>
        </div>
        <div id="tab-4">
            <div class="content">
                <table width="666" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="2"><span style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#036"><strong>Caja</strong></span></td>
                    <td colspan="2">&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="23">&nbsp;</td>
                    <td width="170">&nbsp;</td>
                    <td width="25">&nbsp;</td>
                    <td width="182">&nbsp;</td>
                    <td width="22">&nbsp;</td>
                    <td width="244">&nbsp;</td>
                  </tr>
                  <tr>
                    <td><?php if($rowuser2['emicompro']=="1"){echo'<input type="checkbox" checked name="59" id="59">';}else{echo'<input type="checkbox" name="59" id="59">';} ?>
                     </td>
                    <td>Emisión de Comprobante</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><?php if($rowuser2['anucompro']=="1"){echo'<input type="checkbox" checked name="60" id="60">';}else{echo'<input type="checkbox" name="60" id="60">';} ?></td>
                    <td>Anulación de Comprobante</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><?php if($rowuser2['cancelcompro']=="1"){echo'<input type="checkbox" checked name="61" id="61">';}else{echo'<input type="checkbox" name="61" id="61">';} ?></td>
                    <td colspan="3">Cancelación de Comprobantes Emitidos</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><?php if($rowuser2['reportcomproemi']=="1"){echo'<input type="checkbox" checked name="62" id="62">';}else{echo'<input type="checkbox" name="62" id="62">';} ?></td>
                    <td colspan="3">Reporte de Comprobantes Emitidos</td>
                    <td>&nbsp;</td>
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
                    <td colspan="2"><strong><span style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; color: #036">Reporte de Comprobantes</span></strong></td>
                    <td colspan="2">&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
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
                    <td><?php if($rowuser2['pendpago']=="1"){echo'<input type="checkbox" checked name="63" id="63">';}else{echo'<input type="checkbox" name="63" id="63">';} ?>
                      </td>
                    <td>Pendientes de Pago</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><?php if($rowuser2['cancelados']=="1"){echo'<input type="checkbox" checked name="64" id="64">';}else{echo'<input type="checkbox" name="64" id="64">';} ?></td>
                    <td>Cancelados</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
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
                </table>
                
            </div>
        </div>
        <div id="tab-5">
            <div class="content">
                <table width="666" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="2"><span style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#036"><strong>Usuarios</strong></span></td>
                    <td colspan="2">&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="23">&nbsp;</td>
                    <td width="170">&nbsp;</td>
                    <td width="25">&nbsp;</td>
                    <td width="182">&nbsp;</td>
                    <td width="22">&nbsp;</td>
                    <td width="244">&nbsp;</td>
                  </tr>
                  <tr>
                    <td><?php if($rowuser2['manteusu']=="1"){echo'<input type="checkbox" checked name="65" id="65">';}else{echo'<input type="checkbox" name="65" id="65">';} ?></td>
                    <td colspan="3">Crear Usuarios y Mantenimientos</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><?php if($rowuser2['permiusu']=="1"){echo'<input type="checkbox" checked name="66" id="66">';}else{echo'<input type="checkbox" name="66" id="66">';} ?></td>
                    <td colspan="3">Permisos de Usuarios</td>
                    <td>&nbsp;</td>
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
                </table>
               
            </div>
        </div>
        <div id="tab-6">
            <div class="content">
                <table width="667" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="2"><span style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#036"><strong>Mantenimientos</strong></span></td>
                    <td colspan="2">&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="23">&nbsp;</td>
                    <td width="170">&nbsp;</td>
                    <td width="25">&nbsp;</td>
                    <td width="193">&nbsp;</td>
                    <td width="22">&nbsp;</td>
                    <td width="234">&nbsp;</td>
                  </tr>
                  <tr>
                    <td><?php if($rowuser2['tipoacto']=="1"){echo'<input type="checkbox" checked name="67" id="67">';}else{echo'<input type="checkbox" name="67" id="67">';} ?></td>
                    <td>Tipos de Acto</td>
                    <td><?php if($rowuser2['helpprot']=="1"){echo'<input type="checkbox" checked name="72" id="72">';}else{echo'<input type="checkbox" name="72" id="72">';} ?></td>
                    <td>Ayuda de Protestos</td>
                    <td><?php if($rowuser2['seriescaja']=="1"){echo'<input type="checkbox" checked name="77" id="77">';}else{echo'<input type="checkbox" name="77" id="77">';} ?></td>
                    <td>Series Iniciales Caja</td>
                  </tr>
                  <tr>
                    <td><?php if($rowuser2['mantecondi']=="1"){echo'<input type="checkbox" checked name="68" id="68">';}else{echo'<input type="checkbox" name="68" id="68">';} ?></td>
                    <td>Condiciones de Actos</td>
                    <td><?php if($rowuser2['contpod']=="1"){echo'<input type="checkbox" checked name="73" id="73">';}else{echo'<input type="checkbox" name="73" id="73">';} ?></td>
                    <td>Contenido de Poderes</td>
                    <td><?php if($rowuser2['mant_abogado']=="1"){echo'<input type="checkbox" checked name="99" id="99">';}else{echo'<input type="checkbox" name="99" id="99">';} ?></td>
                    <td>Mantenimiento de Abogados</td>
                  </tr>
                  <tr>
                    <td><?php if($rowuser2['manteclie']=="1"){echo'<input type="checkbox" checked name="69" id="69">';}else{echo'<input type="checkbox" name="69" id="69">';} ?></td>
                    <td>Clientes</td>
                    <td><?php if($rowuser2['manteservi']=="1"){echo'<input type="checkbox" checked name="74" id="74">';}else{echo'<input type="checkbox" name="74" id="74">';} ?></td>
                    <td>Servicios </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><?php if($rowuser2['manteimpe']=="1"){echo'<input type="checkbox" checked name="70" id="70">';}else{echo'<input type="checkbox" name="70" id="70">';} ?></td>
                    <td>Impedidos</td>
                    <td><?php if($rowuser2['asignaregis']=="1"){echo'<input type="checkbox" checked name="75" id="75">';}else{echo'<input type="checkbox" name="75" id="75">';} ?></td>
                    <td colspan="3">Asignaciones de Numeros de Protocolares y extraprotocolares</td>
                  </tr>
                  <tr>
                    <td><?php if($rowuser2['sellocartas']=="1"){echo'<input type="checkbox" checked name="71" id="71">';}else{echo'<input type="checkbox" name="71" id="71">';} ?></td>
                    <td>Sello de Cartas</td>
                    <td><?php if($rowuser2['tipo_cambio']=="1"){echo'<input type="checkbox" checked name="76" id="76">';}else{echo'<input type="checkbox" name="76" id="76">';} ?></td>
                    <td>Tipo de Cambio</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                </table>
               
            </div>
        </div>
        <div id="tab-7">
            <div class="content">
                <table width="667" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="2"><span style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#036"><strong>Configuracion</strong></span></td>
                    <td colspan="2">&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="23">&nbsp;</td>
                    <td width="170">&nbsp;</td>
                    <td width="25">&nbsp;</td>
                    <td width="193">&nbsp;</td>
                    <td width="22">&nbsp;</td>
                    <td width="234">&nbsp;</td>
                  </tr>
                  <tr>
                    <td><?php if($rowuser2['datonot']=="1"){echo'<input type="checkbox" checked name="78" id="78">';}else{echo'<input type="checkbox" name="78" id="78">';} ?></td>
                    <td>Datos del Notario</td>
                    <td><?php if($rowuser2['backup']=="1"){echo'<input type="checkbox" checked name="88" id="88">';}else{echo'<input type="checkbox" name="88" id="88">';} ?></td>
                    <td>Backup Sistema</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><?php if($rowuser2['editdatonot']=="1"){echo'<input type="checkbox" checked name="79" id="79">';}else{echo'<input type="checkbox" name="79" id="79">';} ?></td>
                    <td>Edicion de Datos del Notario</td>
                    <td><?php if($rowuser2['sisgen']=="1"){echo'<input type="checkbox" checked name="89" id="89">';}else{echo'<input type="checkbox" name="89" id="89">';} ?></td>
                    <td>Sisgen</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><?php if($rowuser2['regserver']=="1"){echo'<input type="checkbox" checked name="80" id="80">';}else{echo'<input type="checkbox" name="80" id="80">';} ?></td>
                    <td>Registrar Servidor</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><?php if($rowuser2['editserver']=="1"){echo'<input type="checkbox" checked name="81" id="81">';}else{echo'<input type="checkbox" name="81" id="81">';} ?></td>
                    <td>Editar Servidor</td>
                    <td>&nbsp;</td>
                    <td colspan="3">&nbsp;</td>
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
                    <td colspan="2">&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                </table>
                
            </div>
        </div>
    </div>
</div></td>
  </tr>
  <tr>
    <td height="12" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td width="22%" align="left"><input type="submit" name="button" id="button" value="Grabar Permisos"></td>
  </tr>
</table>
</form>
</body>
</html>