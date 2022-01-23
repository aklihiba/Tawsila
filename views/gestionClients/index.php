
<form action="<?= PRE ?>/GestionClients" method="POST">
<div id="toolbar">
 <?php $g->submit('banir', 'banir','mediumbutton');
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
      <th data-sortable="true">Client</th>
      <th data-sortable="true">Adresse</th>
      <th data-sortable="true">Email</th>
      <th data-sortable="true">Telephone</th>
      <th data-sortable="true">Etat</th>
     
    </tr>
  </thead>
  <tbody>
      <?php
        foreach($clients as $c){
           $g->clientrow($c);
        }

    ?>
  </tbody>
</table>

</form>