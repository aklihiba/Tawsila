<?php
class Router
{
    private $ctrl ;
    private $view ;
    public function routeReq()
    {
        try
        {
            //chargement automatique des classes models
            spl_autoload_register(function($class)
            {
                require_once('models/'.$class.'.php');
            });

            $url = [];
            // decomposer l'url et le filtrer
            if(isset($_GET['url']))
            {
                $url = explode('/', filter_var($_GET['url'],FILTER_SANITIZE_URL));

                //recuperer le premier param de l'url
                $controller = ucfirst(strtolower($url[0]));
                $controllerClass = "controller".$controller;
                $controllerFile = "controllers/".$controllerClass.".php";

                if(file_exists($controllerFile))
                {
                    //on lance la class en qst 
                    require_once($controllerFile);
                    $this->ctrl = new $controllerClass($url);

                }
                else
                {
                    throw new \Exception("Page introuvable", 1);
                }
            }
            else
            {
                require_once('controllers/ControllerAccueil.php');
                $this->ctrl = new ControllerAccueil($url);   
            }

        }
        catch(Exception $e)
        {
            $errorMsg = $e->getMessage();
            require_once('view/viewError.php');
        }
    }
}
?>