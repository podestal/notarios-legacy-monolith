<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>OpenTBS Demo</title>
<script type="text/javascript">
	function download_template() {
		window.location.href=document.getElementById('tpl').value;
	}
</script>
<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 11px;
}
.title1 {
	font-size: 16px;
	font-weight: bold;
}
-->
</style></head>

<body>
<p align="center">&nbsp;</p>
<form id="form1" name="form1" method="post" action="demo_merge.php">
  Nombre del archivo:
    <input name="yourname" type="text" id="yourname" size="10" />
    , plantilla:
    <select name="tpl" id="tpl">
    <option value="demo_oo_text.odt">OpenOffice Writer Document (.odt)</option>
    <option value="demo_oo_spreadsheet.ods">OpenOffice Calc Spreadsheet (.ods)</option>
    <option value="demo_oo_graph.odg">OpenOffice Draw Graphic (.odg)</option>
    <option value="demo_oo_formula.odf">OpenOffice Math Formula (.odf)</option>
    <option value="demo_oo_master.odm">OpenOffice Master (.odm)</option>
    <option value="demo_oo_presentation.odp">OpenOffice Impress Presentation (.odp)</option>
    <option value="demo_ms_word.docx">Ms Word Document (.docx)</option>
    <option value="demo_ms_excel.xlsx">Ms Excel SpreadSheet (.xlsx)</option>
    <option value="demo_ms_powerpoint.pptx">Ms PowerPoint Presentation (.pptx)</option>
  </select>
  ,  Reporteador:
  <select name="debug" id="debug">
    <option value="0" selected="selected">No</option>
    <option value="1">General Information</option>
    <option value="2">During merge</option>
    <option value="3">After merge</option>
  </select>
  <div id="save_as_file" style="display:none;">, Guardar el archivo con el nombre: 
    <input name="suffix" type="text" id="suffix" size="10" />
  (Vacio para descargar),</div>
  <input type="submit" name="btn_go" id="btn_go" value="Exportar" />
</form>
</body>
<script type="text/javascript">
	// enable the option for savegin as a file, the PHP script will test if it is running on localhost anyway.
	if (window.location.hostname=='localhost') document.getElementById('save_as_file').style.display='inline';
</script>
</html>
