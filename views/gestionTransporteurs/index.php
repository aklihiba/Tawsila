
<form action="<?= PRE ?>/GestionTransporteurs" method="POST">
<div id="toolbar">
 <?php 
 $g->submit('banir', 'banir','mediumbutton');
 $g->button('valider','mediumbutton', 'valider()');
 $g->submit('certifier', 'certifier','mediumbutton');
 $g->button('refuser','mediumbutton','refuser()');
 $g->input('message_valid','message_valid','les documents a apporter','input');
 $g->input('message_rejet','message_rejet','justificatif','input');
 
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
      <th data-sortable="true">Transporteur</th> 
      <th data-sortable="true">Adresse</th>     
      <th data-sortable="true">Email</th>
      <th data-sortable="true">Telephone</th>
      <th data-sortable="true">Etat</th>
      <th data-sortable="true">Wilaya depart</th>
      <th data-sortable="true">Wilaya d'arrive</th>
     
    </tr>
  </thead>
  <tbody>
      <?php
        foreach($trans as $c){
           
           $g->transporteurrow($c);
        }

    ?>
  </tbody>
</table>

</form>