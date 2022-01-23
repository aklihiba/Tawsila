
<form  action="<?= PRE ?>/GestionSignalements" method="POST">
<div id="toolbar">
 
</div>


<table  
data-toggle="table"
  class="table table-bordered table-hover"
  id="tableClient"
  data-toolbar="#toolbar"
  data-search="true"
  data-show-refresh="true"
  data-show-toggle="true"

  data-show-columns="true"
  data-show-columns-toggle-all="true"

  data-show-export="true"
  data-click-to-select="true"
  data-detail-formatter="detailFormatter"
  data-minimum-count-columns="2"

  
  >
  <thead>
    <tr>
        
      <th data-sortable="true">emetteur</th> 
      <th data-sortable="true">annonce</th>          
      <th data-sortable="true">mis en cause</th>
      <th data-sortable="true">description</th>
    
    </tr>
  </thead>
  <tbody>
      <?php
        foreach($signs as $a){
           
           $g->signalementrow($a);
        }

    ?>
  </tbody>
</table>

</form>