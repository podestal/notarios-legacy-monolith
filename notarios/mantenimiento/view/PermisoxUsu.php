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
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Permisos de Usuario</title>
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
<script type="text/javascript" src="../../tcal.js"></script> 

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
</head>

<body style="font-size:62.5%;">
<table  width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="99" colspan="3"><div id="tabs" class="tabs">
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
    <td><input type="checkbox" name="checkbox" id="checkbox">
      <label for="checkbox"></label></td>
    <td>Kardex</td>
    <td><input type="checkbox" name="checkbox4" id="checkbox4"></td>
    <td>Protestos</td>
    </tr>
  <tr>
    <td><input type="checkbox" name="checkbox2" id="checkbox2"></td>
    <td>Crear Kardex</td>
    <td><input type="checkbox" name="checkbox5" id="checkbox5"></td>
    <td>Crear Protestos</td>
    </tr>
  <tr>
    <td><input type="checkbox" name="checkbox3" id="checkbox3"></td>
    <td>Editar Kardex</td>
    <td><input type="checkbox" name="checkbox6" id="checkbox6"></td>
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
                  <td><input type="checkbox" name="checkbox7" id="checkbox7">
                    <label for="checkbox7"></label></td>
                  <td>Permisos de Viajes</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox8"></td>
                  <td>Poderes</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox8"></td>
                  <td>Cartas</td>
                </tr>
                <tr>
                  <td><input type="checkbox" name="checkbox7" id="checkbox9"></td>
                  <td>Crear Permisos de viajes</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox10"></td>
                  <td>Crear Poderes</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox10"></td>
                  <td>Crear Cartas</td>
                </tr>
                <tr>
                  <td><input type="checkbox" name="checkbox7" id="checkbox11"></td>
                  <td>Editar Permisos de viajes</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox12"></td>
                  <td>Editar Poderes</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox12"></td>
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
                  <td><input type="checkbox" name="checkbox7" id="checkbox17">
                    <label for="checkbox17"></label></td>
                  <td>Libros</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox18"></td>
                  <td>Capaz</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox8"></td>
                  <td>Incapaz</td>
                </tr>
                <tr>
                  <td><input type="checkbox" name="checkbox7" id="checkbox15"></td>
                  <td>Crear Kardex</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox16"></td>
                  <td>Crear Cert. Persona Capaz</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox10"></td>
                  <td>Crear Cert. Persona Incapaz</td>
                </tr>
                <tr>
                  <td><input type="checkbox" name="checkbox7" id="checkbox13"></td>
                  <td>Editar Kardex</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox14"></td>
                  <td>Editar Cert. Persona Capaz</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox12"></td>
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
                  <td><input type="checkbox" name="checkbox7" id="checkbox8"></td>
                  <td>Cert. Domiciliario</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox8"></td>
                  <td>Cambio de Caracteristica</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><input type="checkbox" name="checkbox7" id="checkbox10"></td>
                  <td>Crear Cert. Domiciliario</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox10"></td>
                  <td>Crear Cambio de Caracteristica</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><input type="checkbox" name="checkbox7" id="checkbox12"></td>
                  <td>Editar Cert. Domiciliario</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox12"></td>
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
                  <td><input type="checkbox" name="checkbox7" id="checkbox7">
                    <label for="checkbox7"></label></td>
                  <td>Escrituras Públicas</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox10"></td>
                  <td>Protestos</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox12"></td>
                  <td>Poderes</td>
                  </tr>
                <tr>
                  <td><input type="checkbox" name="checkbox7" id="checkbox9"></td>
                  <td>No Contenciosos</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox12"></td>
                  <td>Informe Camara de Comercio</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox12"></td>
                  <td>Persona Capaz</td>
                  </tr>
                <tr>
                  <td><input type="checkbox" name="checkbox7" id="checkbox11"></td>
                  <td>Transferencias Vehiculares</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox10"></td>
                  <td>Cartas</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox12"></td>
                  <td>Persona Incapaz</td>
                  </tr>
                <tr>
                  <td><input type="checkbox" name="checkbox7" id="checkbox8"></td>
                  <td>Garantias Mobiliarias</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox8"></td>
                  <td>Libros</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><input type="checkbox" name="checkbox7" id="checkbox10"></td>
                  <td>Testamentos</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox10"></td>
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
                  <td><input type="checkbox" name="checkbox7" id="checkbox7">
                    <label for="checkbox7"></label></td>
                  <td>Escrituras Públicas</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox11"></td>
                  <td>TRansferencias Vehiculares</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox8"></td>
                  <td>Testamentos</td>
                </tr>
                <tr>
                  <td><input type="checkbox" name="checkbox7" id="checkbox9"></td>
                  <td>No Contenciosos</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox8"></td>
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
                  <td><input type="checkbox" name="checkbox7" id="checkbox8"></td>
                  <td>Escrituras Públicas</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox8"></td>
                  <td>Registro de Operaciones</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><input type="checkbox" name="checkbox7" id="checkbox10"></td>
                  <td>Transferencias Vehiculares</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox10"></td>
                  <td>Reportes UIF / IAOC</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><input type="checkbox" name="checkbox7" id="checkbox12"></td>
                  <td>Garantias Mobiliarias</td>
                  <td><input type="checkbox" name="checkbox7" id="checkbox12"></td>
                  <td colspan="3">Reporte Pendiente de Conclusion</td>
                  </tr>
                <tr>
                  <td><input type="checkbox" name="checkbox7" id="checkbox12"></td>
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
                    <td><input type="checkbox" name="checkbox8" id="checkbox19">
                      <label for="checkbox19"></label></td>
                    <td>Emisison de Comprobante</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="checkbox8" id="checkbox22"></td>
                    <td>Anulación de Comprobante</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="checkbox8" id="checkbox23"></td>
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
                    <td><input type="checkbox" name="checkbox8" id="checkbox19">
                      <label for="checkbox19"></label></td>
                    <td>Pendientes de Pago</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="checkbox8" id="checkbox22"></td>
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
                    <td><input type="checkbox" name="checkbox9" id="checkbox20">
                      <label for="checkbox20"></label></td>
                    <td colspan="3">Crear Usuarios y Mantenimientos</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="checkbox9" id="checkbox21"></td>
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
                    <td><input type="checkbox" name="checkbox10" id="checkbox24">
                      <label for="checkbox24"></label></td>
                    <td>Tipos de Acto</td>
                    <td><input type="checkbox" name="checkbox10" id="checkbox25"></td>
                    <td>Ayuda de Protestos</td>
                    <td><input type="checkbox" name="checkbox10" id="checkbox26"></td>
                    <td>Series Iniciales Caja</td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="checkbox10" id="checkbox27"></td>
                    <td>Condiciones de Actos</td>
                    <td><input type="checkbox" name="checkbox10" id="checkbox26"></td>
                    <td>Contenido de Poderes</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="checkbox10" id="checkbox28"></td>
                    <td>Clientes</td>
                    <td><input type="checkbox" name="checkbox10" id="checkbox25"></td>
                    <td>Servicios </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="checkbox10" id="checkbox29"></td>
                    <td>Impedidos</td>
                    <td><input type="checkbox" name="checkbox10" id="checkbox29"></td>
                    <td colspan="3">Asignaciones de Numeros de Protocolares y extraprotocolares</td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="checkbox10" id="checkbox25"></td>
                    <td>Sello de Cartas</td>
                    <td><input type="checkbox" name="checkbox10" id="checkbox25"></td>
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
                    <td><input type="checkbox" name="checkbox11" id="checkbox30">
                      <label for="checkbox30"></label></td>
                    <td>Datos del Notario</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="checkbox11" id="checkbox33"></td>
                    <td>Edicion de Datos del Notario</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="checkbox11" id="checkbox34"></td>
                    <td>Registrar Servidor</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="checkbox11" id="checkbox35"></td>
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
    <td width="22%" align="center"><button title="Contratantes" type="button" name="btncontratantes"    id="btncontratantes" value="contratantes" onclick="fGraba();" ><img src="../../images/newuser.png" alt="" width="20" height="20" align="absmiddle" />Grabar Permisos</button></td>
  </tr>
</table>
</body>
</html>