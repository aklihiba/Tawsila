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
    <div class="container" >
        <div class="row">
        <div class = "col">
        <div class="card" style="width: 18rem;">
           
            <a  href="<?= PRE ?>/GestionClients"> 
                <img class="card-img-top" src="<?= PRE ?>/ressource/images/gestionclients.png">
            </a>
            <div class="card-body">
            <h5 class="card-title">Gestion des Clients</h5>
            </div>
        </div>
        </div>

        <div class = "col">
        <div class="card" style="width: 18rem;">
           
            <a  href="<?= PRE ?>/GestionTransporteurs"> 
                <img class="card-img-top" src="<?= PRE ?>/ressource/images/gestiontransporteurs.jpg">
            </a>
            <div class="card-body">
            <h5 class="card-title">Gestion des Transporteurs</h5>
            </div>
        </div>
        </div>

        <div class = "col">
        <div class="card" style="width: 18rem;">
           
            <a href="<?= PRE ?>/GestionAnnonces"> 
                <img class="card-img-top" src="<?= PRE ?>/ressource/images/gestionannonces.jpg">
            </a>
            <div class="card-body">
            <h5 class="card-title">Gestion des Annonces</h5>
            </div>
        </div>
        </div>

    
    </div>
</div>

<div class="container" >
        <div class="row">
        <div class = "col">
        <div class="card" style="width: 18rem;">
           
            <a  href="<?= PRE ?>/GestionSignalements"> 
                <img class="card-img-top" src="<?= PRE ?>/ressource/images/gestionsignalements.png">
            </a>
            <div class="card-body">
            <h5 class="card-title">Gestion des signalements</h5>
            </div>
        </div>
        </div>

        <div class = "col">
        <div class="card" style="width: 18rem;">
           
            <a  href="<?= PRE ?>/GestionContenu"> 
                <img class="card-img-top" src="<?= PRE ?>/ressource/images/gestioncontenu.jpg">
            </a>
            <div class="card-body">
            <h5 class="card-title">Gestion du Contenu</h5>
            </div>
        </div>
        </div>

        <div class = "col">
        <div class="card" style="width: 18rem;">
           
            <a href="<?= PRE ?>/GestionNews"> 
                <img class="card-img-top" src="<?= PRE ?>/ressource/images/gestionnews.jpg">
            </a>
            <div class="card-body">
            <h5 class="card-title">Gestion des News</h5>
            </div>
        </div>
        </div>

    
    </div>
</div>
  
</center>
