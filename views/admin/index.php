<style>
    span.principale {
     
        display: flex;
        justify-content: space-evenly;
    
    }
    .principalimg {
        position: relative;
    }
    .principalimg img{
       
        border: 1px solid <?= $couleur->bordercolor() ?>;
    }
    .principalimg h4{
       
    }

</style>

<center>
    <span class="principale" >
        <div class='principalimg'>
            <h4>Gestion des Clients</h4>
            <a href="<?= PRE ?>/GestionClients"> 
                <img src="<?= PRE ?>/ressource/images/gestionclients.png" height="150" >
            </a>
           
        </div>

        <div class='principalimg'>
        <h4>Gestion des Transporteurs</h4>
            <a href="<?= PRE ?>/GestionTransporteurs">
                <img src="<?= PRE ?>/ressource/images/gestiontransporteurs.jpg" height="150" >
            </a>
        </div>

        <div class='principalimg'>
        <h4>Gestion des Annonces</h4>
            <a href="<?= PRE ?>/GestionAnnonces">
                <img src="<?= PRE ?>/ressource/images/gestionannonces.jpg" height="150" >
            </a>
        </div>
    </span>
    <span class="principale">
        <div class='principalimg'>
            <h4>Gestion des signalements</h4>
            <a href="<?= PRE ?>/GestionSignalements"> 
                <img src="<?= PRE ?>/ressource/images/gestionsignalements.png" height="150">
            </a>
           
        </div>

        <div class='principalimg'>
        <h4>Gestion du Contenu</h4>
            <a href="<?= PRE ?>/GestionContenu">
                <img src="<?= PRE ?>/ressource/images/gestioncontenu.jpg" height="150">
            </a>
        </div>

        <div class='principalimg'>
        <h4>Gestion des News</h4>
            <a href="<?= PRE ?>/GestionNews">
                <img src="<?= PRE ?>/ressource/images/gestionnews.jpg" height="150" >
            </a>
        </div>
    </span>
</center>
