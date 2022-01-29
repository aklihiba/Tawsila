<div style="margin: 2%;">



<h4 class="titre">Emetteur</h4>
 <a class="smalllink" href='<?=PRE?>/Profil/index/<?=$s->emetteur()->id()?>'><?=$s->emetteur()->id()." ".$s->emetteur()->nom()." ".$s->emetteur()->prenom()?></a></td>
 <h4 class="titre">Annonce</h4>
 <a class="smalllink" href='<?=PRE?>/Accueil/Annonce/<?=$s->annonce()->id()?>'><?=$s->annonce()->id()." ".$s->annonce()->titre()?></a></td>
 <h4 class="titre">mis en cause</h4>
 <a class="smalllink" href='<?=PRE?>/Profil/index/<?=$s->mis_en_cause()->id()?>'><?=$s->mis_en_cause()->id()." ".$s->mis_en_cause()->nom()." ".$s->mis_en_cause()->prenom()?></a></td>
<h4 class="titre">Descrption</h4>
<p class="paragraphe"><?= $s->description()?></p>
</div>