<?php 
 foreach($annonces as $annonce):
?>
<h2>
    <?= $annonce->titre() ?>
</h2>
<?php endforeach ?>