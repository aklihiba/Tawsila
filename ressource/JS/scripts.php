<script>
        
        function fireClickEvent(element) {
    var evt = new window.MouseEvent('click', {
        view: window,
        bubbles: true,
        cancelable: true
    });

    element.dispatchEvent(evt);
    }
        function Connexion(){
            document.getElementById("login").style.display = "block";
        }
        function Déconnexion(){
            var a = document.createElement('a');
            a.href = "/projet/accueil/deconnexion";
          
            fireClickEvent(a);
        }
        function closelogin(){
            document.getElementById("login").style.display = "none";
        }
        function Inscription(){
            var a = document.createElement('a');
            a.href = "/projet/Inscription";
          
            fireClickEvent(a);
        }
        $(document).ready(function(){ 
        $('.footer').css('background','<?= $couleur->primarycolor() ?>');
        $('.footer>*').css('margin','1%')
        $('.footer').css('padding','1%')
        });
/*********Profil page **********/
        function modifier(id){
            var a = document.createElement('a');
            a.href = "/projet/profil/modifier/"+id;
          
            fireClickEvent(a);
        }

        $(document).ready(function(){
            $(".profil_info").css('display','flex');
            $(".profil_info").css('justify-content','space-around');
            $(".profil_info>div").css('margin','5%');

        });    
       
    /*********Annonce page ****************/    
        $(document).ready(function(){
        $("#note, #signalementdesc").hide();
    });
    
    function noter(){
        let note = document.getElementById('note');
        if(note.style.display== "none"){
            note.style.display = 'block';
        }else{
            if(note.value == ""){
                note.style.display = "none";
            }else{
                document.getElementById('annonce').submit();
                note.style.display = "none";
            }
        } 
    }
    function signaler(){
        let description = document.getElementById('signalementdesc');
        if(description.style.display== "none"){
            description.style.display = 'block';
        }else{
            if(description.value == ""){
                description.style.display = "none";
            }else{
                document.getElementById('annonce').submit();
                description.style.display = "none";
            }
        } 
    }


    /**************inscription page */
    $(document).ready(function(){
        $(".dropdown, [name='certification'], [for='certification']").hide();
        
        $("[name='transporteur']").change(
            function(){
                $(".dropdown, [name='certification'], [for='certification']").toggle();
            }
        );
    });

    /***********contact page */
    $(document).ready(function(){
            $(".admins_list").css('display','flex');
            $(".admins_list").css('justify-content','space-around');
            $(".adminbox>*").css('display','inline-block');
            $(".adminbox>*").css('margin', '5px');
           $(".adminbox").css('padding','1%');
           $(".adminbox").css('border','1px solid <?= $couleur->bordercolor()?>');
        });    
    </script>