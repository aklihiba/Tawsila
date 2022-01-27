
<form action="<?= PRE ?>/GestionContenu/diaporama" method="POST">
<div id="toolbar">
 <?php 
 $g->submit('ajouter', 'ajouter','mediumbutton');
 $g->submit('supprimer', 'supprimer','mediumbutton');
      
 ?>

</div>
<script>
     $(document).ready(function(){
        $("#add").click(function(){
         id =  $('#diapotable tr:last').attr('id') + 1;
        $('#diapotable>tbody').append(
            ` <tr id="`+ id + `">
                <td> <input  type="checkbox"  name="selected[]" value=`+ id +`> </td>
                <td>
                <input type="text" class="form-control"  name="image`+ id +`"  style=" background-color:<?= $couleur->bgcolor() ?> ;" >
                </td>
                <td>
                <input type="text" class="form-control"  name="link`+ id +`"  style=" background-color: <?= $couleur->bgcolor() ?>;" >
                </td>      
                </tr>`
        );
        });
    });
</script>
<div>
    <tr>
      <i id='add' class="fa fa-plus"></i>
    </tr>
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

  id='diapotable'
  >
  
  <thead>
    <tr>
        <th></th>
      <th data-sortable="true">image</th>
      <th data-sortable="true">lien</th>
     
    </tr>
  </thead>
  <tbody>
      <?php
        foreach($all as $e){
           $g->diaporow($e, $couleur->bgcolor());
        }

    ?>
     
  </tbody>
 
</table>

</form>