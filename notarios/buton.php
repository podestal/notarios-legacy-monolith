<html>
<head>
<title>Muestra en caja de texto el elemento seleccionado en radiobutton</title>
<!--
This file retrieved from the JS-Examples archives
http://www.js-examples.com
100s of free ready to use scripts, tutorials, forums.
Author: JS-Examples - http://www.js-examples.com/ 
-->



</head>
<body>
<p align="center"><b>Muestra en caja de texto el elemento seleccionado en radiobutton
</b></p>
<form name=exf1>
<input type=text name="t1" value="5" size="20">
<BR>
<input name="r1" type="radio" value="0" checked onclick="doIt(0)">Derecho Propio
<input name="r1" type="radio" value="1" onclick="doIt2(1)">Representante
<input name="r1" type="radio" value="2" onclick="doIt2(2)">Por Derecho Propio y Representación
</form>
<script>
function doIt(_v) {
document.exf1.t1.value=_v;
}
function doIt2(_v) {
document.exf1.t1.value=_v;
}
</script>


</body>
</html>
