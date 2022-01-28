<form action="<?= PRE ?>/GestionNews/modifier/<?= $id ?>" method="POST">
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
         <td><input type="text" id='titre' name='titre' value="<?= $all[0]->content()?>"></td>
    </tr>
     <tr>
         <td>description</td>
         <td><?php    $g->biginputvalue('description','description', $all[1]->content(), 'input'); ?></td>
     </tr>
     <tr>
         <td>photo</td>
         <td><?php   $g->fileselectvalue('photo','photo',$all[2]->content() ,'input fileinput'); ?></td>
     </tr>
     <?php
        for ($i=3; $i < count($all); $i++) { 
            echo '
            <tr>
            <td>
                <select  class="custom-select" id="type" name="type'.$all[$i]->id().'" style=" background-color:'.$couleur->bgcolor().' ;" >
                  <option value="img"';
                  if( $all[$i]->type()=='img') echo ' selected';
                  echo '>image</option>
                  <option value="h1"';
                  if( $all[$i]->type()=='h1') echo ' selected';
                  echo '>titre 1</option>
                  <option value="h2"';
                  if( $all[$i]->type()=='h2') echo ' selected';
                  echo '>titre 2</option>
                  <option value="p"';
                  if( $all[$i]->type()=='p') echo ' selected';
                  echo '>paragraphe</option>
                  
                </select>
                </td>
                <td>
                <input type="text" class="form-control"  name=content'.$all[$i]->id().' style="background-color:'.$couleur->bgcolor().' ;" value="'.$all[$i]->content().'">
                </td>
                 
                </tr>
            ';
        }
     ?>
  </tbody>
</table>

</form>