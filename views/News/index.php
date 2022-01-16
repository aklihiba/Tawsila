<?php
  $g->divclass('news_list');
    foreach($all as $e){
      $g->newsbox($e);
    }
    $g->divend();
?>