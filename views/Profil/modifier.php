
<script>
     $(document).ready(function(){
        $(".motdepasse").hide(); 
    });

    function motdepasse(){
         document.getElementById("motdepasse").style.display = "block";
        
    }
</script>

<form action="<?= PRE ?>/Profil/modifier/<?= $user->id() ?>/" method='post'>

<?php
$g->center();
$g->divclass('modifierprofil');
    $g->titre(1, 'modifier votre profil','titre1');
$g->divend();
$g->divclass('modifierprofil');    
    $g->inputvalue('nom','nom',$user->nom(),'input');
    $g->divend();
    $g->divclass('modifierprofil');     
    $g->inputvalue('prenom','prenom',$user->prenom(),'input');
    $g->divend();
$g->divclass('modifierprofil'); 
    $g->fileselectvalue('photo','photo', $user->photo(),'input fileinput');
    $g->divend();
$g->divclass('modifierprofil'); 
    $g->inputvalue('telephone','telephone',$user->telephone(),'input');
    $g->divend();
$g->divclass('modifierprofil'); 
    $g->inputvalue('adresse','adresse',$user->adresse(),'input');
    $g->divend();
$g->divclass('modifierprofil'); 
    $g->button('modifier mot de passe','mediumbutton','motdepasse()');
    $g->divend();

   echo '<div id="motdepasse" class="motdepasse">';
    
        $g->password('mdp', 'mdp', 'nouveau mot de passe', 'mdpinput');
        $g->password('mdp2', 'mdp2', 'confirmer mot de passe', 'mdpinput');    
    $g->divend();

    if($user->type()=='transporteur'){
        $g->divclass('modifierprofil');
        $g->paragraphe('vos wilayas de depart','paragraphe');
        $g->dropdowncheckbox($wilayas,'depart',$user->depart(),'dropdown');   
        $g->divend();
    
        $g->divclass('modifierprofil');
        $g->paragraphe('vos wilaya d`arrivé','paragraphe');
        $g->dropdowncheckbox($wilayas,'arrive',$user->arrive(),'dropdown');   
        $g->divend();
    }

    $g->submit('modifier','modifier','bigbutton');
$g->centerend();
?>

</form>