
<form action="<?= PRE ?>/GestionContenu/PresentationPage" method="POST">
<div id="toolbar">
 <?php $g->submit('appliquer changement', 'appliquer','mediumbutton');
      
 ?>
 <input type="button" id="ajouter" name="ajouter" value="ajouter" class='mediumbutton'>
</div>
<script>
     $(document).ready(function(){
        $("#ajouter").click(function(){
         id = parseInt($('#presentationtable tr:last').attr('id')) + 1;
        $('#presentationtable>tbody').append(
            ` <tr id="`+ id + `">
                <td> <input  type="checkbox"  name="selected[]" value=`+ id +`> </td>
                <td>
                <input type="text" class="form-control"  name="type`+ id +`"  style="width:2cm; background-color:<?= $couleur->bgcolor() ?> ;" >
                </td>
                <td>
                <input type="text" class="form-control"  name="content`+ id +`"  style="width:max-width; background-color: <?= $couleur->bgcolor() ?>;" >
                </td>      
                </tr>`
        );
        });
    });
</script>

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

  id='presentationtable'
  >
  <thead>
    <tr>
        <th></th>
      <th data-sortable="true">type</th>
      <th data-sortable="true">contenu</th>
     
    </tr>
  </thead>
  <tbody>
      <?php
        foreach($all as $e){
           $g->presentationrow($e, $couleur->bgcolor());
        }

    ?>
  </tbody>
</table>

</form>