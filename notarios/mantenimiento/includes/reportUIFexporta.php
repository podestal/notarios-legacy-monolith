<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=".$_GET["nom"]);
?>
<html>
<head>
<title>Reporte de Registro de Operaciones</title>
</head>
<style>
.cur{cursor:pointer;}

.Estilo26 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
.Estilo28 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #FFFFFF; }
.Estilo31 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #376091; }
.Estilo33 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 20px;
	color: #1F497D;
	font-weight: bold;
}
.Estilo41 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}

</style>
<link href="../../includes/Css/bootstrap.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="../../includes/js/bootstrap.js"></script>
<body>
<form name="thisform" id="thisform">
			<?php
			
			$idkardex = $_GET["idkardex"];
			$fDesde   = $_GET["fDesde"];
			$fHasta   = $_GET["fHasta"];
            //require_once("../../includes/exporta.class.php");    
			require_once("../../includes/gridRo.class.php");                        
            $Grid1 = new GridView();
            $Grid1->DataSource= "CALL ExportaRO('".$fDesde."','".$fHasta."','".$idkardex."')" ;
            $Grid1->name      = "TbPRO"              ;
            $Grid1->cssPar    = "GridPar"             ;
            $Grid1->cssImp    = "GridImp"             ;
            $Grid1->cssCab    = "GridCab"             ;
            $Grid1->width     = "100%"                ;
            $Grid1->NumFields = 60                    ;
            $Grid1->Show()                            ;
            $Grid1->fDesCon();
                
            ?>
</form>
</body>
</html>