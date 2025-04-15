<?php
    include_once('../includes/tbs_class.php');
    include_once('../includes/tinyDoc.class.php');
	
  $TBS = new clsTinyButStrong;
  $TBS->LoadTemplate('template.html');

  $list = array('X','Y','Z');
  $TBS->MergeBlock('blk', $list);
  $TBS->Show();
?>
