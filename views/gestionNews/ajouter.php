<form action="<?= PRE ?>/GestionNews/ajouter" method="POST">
<div id="toolbar">
 <?php $g->submit('valider', 'valider','mediumbutton');
      
 ?>
 <input type="button" id="ajouter" name="ajouter" value="ajouter" class='mediumbutton'>
</div>
<script>
     $(document).ready(function(){
        $("#ajouter").click(function(){
        $('#newstable>tbody').append(
            ` <tr >
            <td>
                <select  class="custom-select" id="type" name="type[]" style=" background-color:<?= $couleur->bgcolor() ?> ;" >
                  <option value="img" selected>image</option>
                  <option value="h1">titre 1</option>
                  <option value="h2">titre 2</option>
                  <option value="p">paragraphe</option>
                  
                </select>
                </td>
                <td>
                <input type="text" class="form-control"  name=content[]  style="background-color:<?= $couleur->bgcolor() ?> ;" >
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

  id='newstable'
  >
  <thead>
    <tr>
      <th>type</th>  
      <th data-sortable="true">contenu</th>
 
    </tr>
  </thead>
  <tbody>
     <tr>
         <td>titre</td>
         <td><input type="text" id='titre' name='titre'></td>
     </tr>
     <tr>
         <td>photo</td>
         <td><?php   $g->fileselectvalue('photo','photo', '','input fileinput'); ?></td>
     </tr>
     <tr>
         <td>description</td>
         <td><?php    $g->biginput('description','description', 'description', 'input'); ?></td>
     </tr>
    
  </tbody>
</table>

</form>