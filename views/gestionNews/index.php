
<form id="formnews" action="<?= PRE ?>/GestionNews" method="POST">

<div id="toolbar">
 <?php 
 $g->submit('ajouter', 'ajouter','mediumbutton');
 
 $g->submit('modifier', 'modifier','mediumbutton');
 $g->submit('supprimer', 'supprimer','mediumbutton');
 
 ?>
</div>


<table  
data-toggle="table"
  class="table table-bordered table-hover"
  id="tablenews"
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
      <th></th>
      <th data-sortable="true">Titre</th> 
      <th data-sortable="true">date</th> 
      <th data-sortable="true">nombre de vues</th>     
      
     
    </tr>
  </thead>
  <tbody>
      <?php
        foreach($all as $c){
           
           $g->newsrow($c);
        }

    ?>
  </tbody>
</table>

</form>