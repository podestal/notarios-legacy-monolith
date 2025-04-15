<?php
include('../conexion.php');
include_once('../includes/tbs_class.php');
include_once('../includes/tbs_plugin_opentbs.php');

$TBS = new clsTinyButStrong;
$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
$TBS->LoadTemplate('<!DOCTYPE HTML><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title>OpenTBS plug-in for TinyButStrong - demo source</title></head><body>:3</body></html>'); // Load the archive 'document.odt'.
$file_name ="doc_prueba";

//$TBS->PlugIn(OPENTBS_DEBUG_XML);
$TBS->Show(OPENTBS_DOWNLOAD, $file_name);

?>