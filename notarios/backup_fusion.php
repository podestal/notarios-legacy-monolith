
<?php

    $cmd = "mysqldump --user=root --password=12345 notarios > C:/Backups/archivo$Fecha.sql";
   // echo `$cmd`;
   // echo shell_exec($cmd);
    system($cmd);

?>
