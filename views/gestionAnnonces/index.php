
<form id="annonceform" action="<?= PRE ?>/GestionAnnonces" method="POST">
<div id="toolbar">
 <?php 
 $g->submit('valider', 'valider','mediumbutton');
 $g->submit('annuler', 'annuler','mediumbutton');
 $g->submit('archiver', 'archiver','mediumbutton');

 
 ?>
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
        <th></th>
      <th data-sortable="true">titre</th> 
      <th data-sortable="true">date </th>          
      <th data-sortable="true">client</th>
      <th data-sortable="true">transiteur</th>
      <th data-sortable="true">etat</th>
      <th data-sortable="true">wilaya depart</th>
      <th data-sortable="true">wilaya arrive</th>
      <th data-sortable="true">transport</th>
      <th data-sortable="true">poids(kg)</th>
      <th data-sortable="true">volume(m3)</th>
      <th data-sortable="true">type</th>
      <th data-sortable="true">prix</th>
      <th data-sortable="true">vues</th>
      <th data-sortable="true">archivé </th>
     
    </tr>
  </thead>
  <tbody>
      <?php
        foreach($annonces as $a){
           
           $g->annoncerow($a);
        }

    ?>
  </tbody>
</table>

</form>