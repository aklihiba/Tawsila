
<form action="<?= PRE ?>/GestionContenu/fourchettevolume" method="POST">
<div id="toolbar">
 <?php $g->submit('appliquer changement', 'appliquer','mediumbutton');
      
 ?>
 <input type="button" id="ajouter" name="ajouter" value="ajouter" class='mediumbutton'>
</div>
<script>
     $(document).ready(function(){
        $("#ajouter").click(function(){
        $('#volumetable>tbody').append(
            ` <tr >
              
                <td>
                <input type="text" class="form-control"  name=volume[]  style="background-color:<?= $couleur->bgcolor() ?> ;" >
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

  id='volumetable'
  >
  <thead>
    <tr>
    
      <th data-sortable="true">volume (m3)</th>
 
    </tr>
  </thead>
  <tbody>
      <?php
        foreach($all as $e){
           $g->volumerow($e, $couleur->bgcolor());
        }

    ?>
  </tbody>
</table>

</form>