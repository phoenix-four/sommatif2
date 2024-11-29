<?php
declare(strict_types=1);
namespace App;

use App\Controleurs\ControleurSite;
use App\Controleurs\ControleurContact;


use \PDO;
use eftec\bladeone\BladeOne;


class App
{
    private static ?PDO $refPdo = null;
    private static ?BladeOne $refBlade = null;

    public function __construct()
    {
        error_reporting(E_ALL | E_STRICT);
        date_default_timezone_set('America/Montreal');
        session_start();
        $this->routerRequete();
    }

    public static function getPDO():PDO
    {
        $pdo = null;
        if (!isset(App::$refPdo)){
            // Exemple de paramètre de connexion
            $serveur = 'localhost';
            $utilisateur = 'root';
            $motDePasse = 'root';
            $nomBd = 'bd_contacts_v1';
            $chaineDSN = "mysql:dbname=$nomBd;host=$serveur";    // Data source name

            // Tentative de connexion
            $pdo = new PDO($chaineDSN, $utilisateur, $motDePasse);
            // Changement d'encodage des caractères UTF-8
            $pdo->exec("SET NAMES utf8");
            // Affectation des attributs de la connexion : Obtenir des rapports d'erreurs et d'exception avec errorInfo()
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }else{
            $pdo = App::$refPdo;
        }
        return $pdo;
    }

    public static function getBlade():BladeOne
    {
        if(App::$refBlade === null){
            $cheminDossierVues = '../ressources/vues';
            $cheminDossierCache = '../ressources/cache';
            App::$refBlade = new BladeOne($cheminDossierVues,$cheminDossierCache,BladeOne::MODE_AUTO);
        }
        return App::$refBlade;
    }

    public function routerRequete():void
    {
        $controleur = 'site';
        $action = 'accueil';
        $monControleur = null;

        if (isset($_GET['controleur'])){
            $controleur = $_GET['controleur'];
        }

        if (isset($_GET['action'])){
            $action = $_GET['action'];
        }

        if ($controleur === 'site'){
            $monControleur = new ControleurSite();
            switch ($action) {
                case 'accueil':
                    $monControleur->accueil();
                    break;
                case 'apropos':
                    $monControleur->apropos();
                    break;
                default:
                    echo 'Erreur 404';
            }
        }elseif ($controleur === 'contact'){
            $monControleur = new ControleurContact();
            switch ($action) {
                case 'creer':
                    $monControleur->creer();
                    break;
                case 'inserer':
                    $monControleur->inserer();
                    break;
                default:
                    echo 'Erreur 404';
            }
        }else{
                echo 'Erreur 404';
        }
    }
}