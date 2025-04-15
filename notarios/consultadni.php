<html>
<head><title></title>
<script language="javascript" type="text/javascript">
function textodeiframe()
{

var frame = document.getElementById('fram1');
var txt = frame.contentWindow.document.getElementById('accion').value;
document.getElementById('txt2').value = txt;
}
</script>
</head>
<body>
<div id="capa1">
<iframe id="fram1" width="100%" height="100%" onload="textodeiframe()" frameborder="0" src="https://cel.reniec.gob.pe/valreg/valreg.do">
</iframe>
Este es el contenido del control del iframe:<input type="text" name="txt2" id="txt2" />
</div>
</body>
</html>