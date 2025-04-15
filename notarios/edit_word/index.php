<?php
require_once("clsWord.php");

   $input = "D:\Doc1.doc";
   $output = "D:\Doc1.doc";

   $Word = new clsMSWord;
   $Word->Open($input);
  $Word->WriteText("This is a test ");
   $Word->WriteBookmarkText("test","this is bookmark text");
   $Word->SaveAs($output);
   $Word->Quit();
echo 'The data is inserted successfully !';
?>