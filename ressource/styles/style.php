<style>
    /*
#login{
    background-color: <?= $couleur->bgcolor()?>;
    display: none;
    position:static;
    height: 200;
    width: 300;
    z-index: 4;
} 
.close-icon{
    display:block;
    box-sizing:border-box;
    width:20px;
    height:20px;
    border-width:2px;
    border-style: solid;
    border-color:<?= $couleur->bordercolor()?>;
    border-radius:100%;
    background: -webkit-linear-gradient(-45deg, transparent 0%, transparent 46%, white 46%,  white 56%,transparent 56%, transparent 100%), -webkit-linear-gradient(45deg, transparent 0%, transparent 46%, white 46%,  white 56%,transparent 56%, transparent 100%);
    background-color:<?= $couleur->secondarycolor()?>;
    transition: all 0.3s ease;
}*/

header>.navbar> *{
    font-family: <?= $fonts->font1()?>;
    font-weight: 900;
    color: <?= $couleur->bgcolor() ?>;
}
footer a {
    margin: 1%;
    font-family: <?= $fonts->font2()?>;  
    color: <?= $couleur->secondarycolor() ?>;
}
.footer  {
    
    padding: 1.5%;
    width:100%; 
    background-color: <?= $couleur->primarycolor() ?>;
}
   
div.diaporama {
    border: <?= $couleur->bordercolor() ?>;
    width: 100%;
    overflow: hidden;
    display: inline-flex;
    background-color:  <?= $couleur->bgcolor() ?>;

}
@keyframes diaporama {
    
    0% { -webkit-transform: translate(0, 0);}
    33%{ -webkit-transform: translate(-20%, 0);}
    66%{ -webkit-transform: translate(-40%, 0);}
    100%{ -webkit-transform: translate(-60%, 0);}
}
div.images {
    
    display: -webkit-inline-flex;
    
}
div.images >*{
margin: 0.3%;
position: relative;
padding-left: 0.5%;
padding-right:0.5%;

}
.images {
    -webkit-animation-name: diaporama ;
    -webkit-animation-duration: 10s;
    -webkit-animation-timing-function:ease-in-out ;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-direction: alternate-reverse;
    -webkit-transition-delay: 0s;
}
.images:hover {
-webkit-animation-play-state: paused;
}

.header>.bigbutton{
    
    float: right;
    margin-inline-end: 0.5%;
  
}
.modal-content, .card {
    background-color: <?= $couleur->bgcolor()?>;
}
.modal-content * {
    margin: 1%;
}
.bigbutton {
    font-family: <?= $fonts->font1()?>;
    font-weight: 900;
    margin: 5px;
    padding: 5px;
    border: 1px solid <?= $couleur->bordercolor()?>;;
    color: <?= $couleur->bgcolor()?>;
    background-color: <?= $couleur->secondarycolor()?>;
}
.input, .paragraphe, .smalllink, .contenulink {
    font-family: <?= $fonts->font2()?>;
    
}
.paragraphe{
    color: <?= $couleur->primarycolor()?>;
}
.titre1 , .titre , .titre2 {
    font-family: <?= $fonts->font1()?>;
    font-weight: 700;
    color: <?= $couleur->primarycolor()?>;
}
.smalllink, .mediumlink, .biglink, .link {
    color: <?= $couleur->secondarycolor()?>;
}
.biglink {
    font-size: 24;
}
.smalllink:hover, .mediumlink:hover, .biglink:hover, .link:hover {
    color: <?= $couleur->bordercolor()?>;
}
.commentfct{
    margin: 2%;
}
</style>