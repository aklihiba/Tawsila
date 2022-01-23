<div style="margin: 2%;">



<h4>Emetteur</h4>
 <a href='<?=PRE?>/Profil/index/<?=$s->emetteur()->id()?>'><?=$s->emetteur()->id()." ".$s->emetteur()->nom()." ".$s->emetteur()->prenom()?></a></td>
 <h4>Annonce</h4>
 <a href='<?=PRE?>/Accueil/Annonce/<?=$s->annonce()->id()?>'><?=$s->annonce()->id()." ".$s->annonce()->titre()?></a></td>
 <h4>mis en cause</h4>
 <a href='<?=PRE?>/Profil/index/<?=$s->mis_en_cause()->id()?>'><?=$s->mis_en_cause()->id()." ".$s->mis_en_cause()->nom()." ".$s->mis_en_cause()->prenom()?></a></td>
<h4>Descrption</h4>
<p><?= $s->description()?></p>
</div>