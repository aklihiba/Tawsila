
<form action="<?= PRE ?>/GestionContenu/prixWilaya" method="POST">
<div id="toolbar">
 <?php 
 $g->submit('changer', 'changer','mediumbutton');
    
 ?>

</div>

<table  
 data-toggle="table"
  class="table table-bordered table-hover"
 
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
  data-show-pagination-switch="true"
  data-pagination="true"
 
  data-page-list="[50, 100, 150, 200, 250, 300, 350, 400, 450, 500, 550, 600, 650, 700, 750, 800, 850, 900, 950, 1000, 1050, 1100, 1150, 1200, 1250, 1300, 1350, 1400, 1450, 1500, 1550, 1600, 1650, 1700, 1750, 1800, 1850, 1900, 1950, 2000, all]"
  data-show-footer="true"
  
  id='prixtable'
  >
  
  <thead>
    <tr>
        <th></th>
      <th data-sortable="true">wilaya depart</th>
      <th data-sortable="true">wilaya arrive</th>
      <th data-sortable="true">prix</th>
     
    </tr>
  </thead>
  <tbody>
      <?php
        foreach($all as $e){
           $g->prixrow($e, $couleur->bgcolor());
        }

    ?>
     
  </tbody>
 
</table>

</form>

