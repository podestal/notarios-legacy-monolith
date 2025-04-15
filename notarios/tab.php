<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<script src="js/jquery-1.6.3.min.js" type="text/javascript"></script>
<script type="text/javascript">
/*Code By CarlosPC.net*/
$(document).ready(function() {
$(".Contenido").hide(); //Para ocultar los DIV's con contenido
$("ul.tabs li:first").addClass("active").show(); //Activamos el primer TAB
$(".Contenido:first").show(); //Muestra el contenido respectivo al primer TAB
 
//Al clickar sobre los Tabs
$("ul.tabs li").click(function() {
$("ul.tabs li").removeClass("active"); //Anula todas las selecciones
$(this).addClass("active"); //Asigna la clase Active al TAB Seleccionado
$(".Contenido").hide(); //Esconde todo el contenido de la tab
var activeTab = $(this).find("a").attr("href"); //Ubica los valores HREF y A para enlazarlos y activarlos
$(activeTab).fadeIn(); //Habilita efecto Fade en la transición de contenidos
return false;
});
});


</script>
<style type="text/css">
<!--
ul.tabs {margin: 0;  padding: 0;  float: left;  list-style: none;  height: auto;  width: 100%; border-left:2px solid #264965; border-bottom:2px solid #777; }
ul.tabs li { background:#264965; float: left;  margin-left: 0px;  padding: 0; border: 2px solid #777; overflow: hidden; position: relative; background: #264965; border-left:0px; margin-bottom:-2px;}
ul.tabs li a {text-decoration: none; background:#CCCCCC; display: block; font-size: 14px; font-weight:bold; padding: 4px 20px; }
ul.tabs li a:hover {background: #264965;}
ul.tabs li.active, html ul.tabs li.active a:hover  {background: #264965; border-bottom: 2px solid #eee; margin-bottom:-2px;}
 
.Contenedor{border: 2px solid #777; border-top: none; overflow: hidden; clear: both; float: left; width: 100%; background: #ffff;
-webkit-border-bottom-right-radius: 8px;
-webkit-border-bottom-left-radius: 8px;
-moz-border-radius-bottomright: 8px;
-moz-border-radius-bottomleft: 8px;
border-bottom-right-radius: 8px;
border-bottom-left-radius: 8px;
}
.Contenido {padding: 15px; font-size: 12px;}
-->
</style>
</head>

<body>
<ul class="tabs">
    <li><a href="#tab1">Contratantes</a></li>
    <li><a href="#tab2">Escrituración</a></li>
    <li><a href="#tab3">Notarial</a></li>
    <li><a href="#tab4">Informacion Registral</a></li>
    
</ul>
<div class="Contenedor">
    <div id="tab1" class="Contenido">Contenido llamado al dar click en el Item 01</div>
    <div id="tab2" class="Contenido">Contenido llamado al dar click en el Item 02</div>
    <div id="tab3" Class="Contenido">Contenido llamado al dar click en el Item 03</div>
    <div id="tab4" Class="Contenido">Contenido llamado al dar click en el Item 04</div>
   
</div>
</body>
</html>
