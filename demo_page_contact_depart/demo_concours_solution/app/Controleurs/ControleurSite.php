<?php
declare(strict_types=1);

namespace App\Controleurs;

use App\App;


class ControleurSite
{

    public function __construct(){

    }

    public function accueil(): void
    {
        $message = "";
        if(isset($_SESSION['message'])){
            $message = $_SESSION['message'];
            unset($_SESSION['message']);
        }

        $tDonnees = array("nomPage"=>"Acceuil", "message" => $message);
        echo App::getBlade()->run("accueil",$tDonnees);
    }

    public function apropos():void
    {
        $tDonnees = array("nomPage"=>"À propos");
        echo App::getBlade()->run("apropos",$tDonnees);
    }

}

