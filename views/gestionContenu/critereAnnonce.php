
<form action="<?= PRE ?>/GestionContenu/critereAnnonce" method="POST">
<div id="toolbar">
 <?php 
 $g->submit('ajouter', 'ajouter','mediumbutton');
 $g->submit('supprimer', 'supprimer','mediumbutton');
 $g->submit('annuler', 'annuler','mediumbutton');
 $g->submit('utiliser', 'utiliser','mediumbutton');     
 ?>

</div>
<script>
     $(document).ready(function(){
        $("#add").click(function(){
         id = parseInt($('#criteretable tr:last').attr('id')) + 1;
        $('#criteretable>tbody').append(
            ` <tr id="`+ id + `">
                <td> <input  type="checkbox"  name="selected[]" value=`+ id +`> </td>
                <td>
                <select class="custom-select" id="colonneselect" name="colonne`+ id +`" style=" background-color:<?= $couleur->bgcolor() ?> ;" >
                  <option value="id" selected>id</option>
                  <option value="date">date(yyyy-mm-dd)</option>
                  <option value="wilaya_depart">Wilaya depart</option>
                  <option value="wilaya_arrive">Wilaya d'arrivé</option>
                  <option value="transport">transport</option>
                  <option value="type">type de l'annonce</option>
                  <option value="poidsMin">poids min (float)</option>
                  <option value="poidsMax">poids max (float)</option>
                  <option value="volumeMin">volume min (float)</option>
                  <option value="volumeMAx">volume max (float)</option>
                  <option value="etat">état(transitée/en attente de transiteur)</option>
                  <option value="note">note(float)</option>
                  <option value="prix">prix(float)</option>
                  <option value="vues">nombre de vues(int)</option>
                  <option value="postulations">postulation(true/false)</option>
                  <option value="demandes">demande(true/false)</option>
                
                </select>
                </td>
                <td>
                <input id='valeur' type="text" class="form-control"  name="valeur`+ id +`"  style=" background-color: <?= $couleur->bgcolor() ?>;" >
                </td>  
                <td>
                <select  class="custom-select" id="operationselect" name="operation`+ id +`" style=" background-color:<?= $couleur->bgcolor() ?> ;" >
                  <option value="=" selected>=</option>
                  <option value=">">></option>
                  <option value="<"><</option>
                  <option value=">=">>=</option>
                  <option value="<="><=</option>
                  <option value="<>"><></option>
                  <option value="ORDER BY">ORDER BY (ASC/DESC)</option>
                  
                </select>
                </td>
                <td> </td>    
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

  id='criteretable'
  >
  
  <thead>
    <tr>
        <th></th>
      <th data-sortable="true">colonne</th>
      <th data-sortable="true">valeur</th>
      <th data-sortable="true">operation</th>
      <th data-sortable="true">utilisé</th>
     
    </tr>
  </thead>
  <tbody>
      <?php
        foreach($all as $e){
           $g->critererow($e);
        }

    ?>
     
  </tbody>
 
</table>

</form>

