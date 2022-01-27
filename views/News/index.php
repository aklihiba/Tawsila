<?php
 $g->divclass('container');
 $g->divclass('row');
    foreach($all as $e){
      $g->divclass('col-sm');
      $g->newsbox($e);
      $g->divend();
    }
    $g->divend();
    $g->divend();
?>