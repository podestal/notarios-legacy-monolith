<?php

$valor=$_POST['numdoc2'];
$fecha= date ("d_m_Y");
$nombre=$fecha.'_sisnot.sql';
$ruta="C:/Doc_Generados/backup/".$nombre;
$arch_zip="C:/Doc_Generados/backup/".$fecha."_sisnot.zip";

if($valor=='crear_backup'){
    $cmd = "mysqldump --routines=true -B --user=root --password=12345 notarios > ".$ruta;
   // echo `$cmd`;
   // echo shell_exec($cmd);
    system($cmd);
	$tamaño_sql=filesize($ruta);
	if($tamaño_sql>=300000){
		// añadimos al zip el sql
		 $zip = new ZipArchive;
         $zip->open($arch_zip,ZipArchive::CREATE);
         $zip->addFile($ruta);
         $zip->close();
		 //eliminamos el sql
          unlink($ruta);
		echo 'Se genero correctamnete el Backup con nombre: '.$nombre;
	}else{
		//eliminamos el sql errado
		  unlink($ruta);
		  echo 'Se produjo un error al generar el Backup, comuniquese con el administrador';
	}
}

?>