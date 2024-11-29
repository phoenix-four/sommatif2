<?php

declare(strict_types=1);

namespace App\Controleurs;

use App\Modeles\Contact;
use App\Utilitaires\Validateur;

use App\App;

class ControleurContact
{

    public function __construct() {}

    public function creer(): void
    {

        $tValidation = null;

        if (isset($_SESSION['tValidation'])) {
            $tValidation = $_SESSION['tValidation'];
        }
        // Récupérer tValidation de la session, ou null si non défini

        // À compléter...



        // Assembler la vue
        $tDonnees = array("tValidation" => $tValidation);
        echo App::getBlade()->run("contacts.creer", $tDonnees);
    }


    public function inserer(): void
    {


        // Valider chaque champ et garder le résultat dans tValidation

        $tValidation = [];
        $tValidation = $this->validation();


        // var_dump($tValidation);

        $contact = new Contact();


        $contact->setNom($tValidation["nom"]["valeur"]);
        $contact->setCourriel($tValidation["courriel"]["valeur"]);
        $contact->setTelephone($tValidation["telephone"]["valeur"]);
        $contact->setAcceptationPartage($tValidation["acceptation_partage"]["valeur"]);
        $contact->setSujet($tValidation["sujet"]["valeur"]);
        $contact->setMessage($tValidation["message"]["valeur"]);
        $contact->setResponsableId((int)$tValidation["responsable_id"]["valeur"]);

        $contact->inserer();

        header("Location: index.php?controleur=contact&action=creer");
        die();
    }


    private function validation(): array
    {
        $fichierJson = file_get_contents("../ressources/lang/fr_CA.UTF-8/messagesValidation.json"); // Récupérer le contenu des messages en format JSON
        $tMessagesJson = json_decode($fichierJson, true); // Convertir en tableau associatif
        $tValidation = [];
        $tValidation = Validateur::validerChamp('nom', "#^[a-zA-ZÀ-ÿ' -]+$#", $tMessagesJson, $tValidation, true);
        $tValidation = Validateur::validerChamp('courriel', "#^[a-zA-Z0-9][a-zA-Z0-9-]+([.][a-zA-Z0-9-]+)[@][a-zA-Z0-9-]+([.][a-zA-Z0-9-]+)[.][a-zA-Z]{2,}$#", $tMessagesJson, $tValidation, true);
        $tValidation = Validateur::validerChamp('telephone', "#^\d{10}$#", $tMessagesJson, $tValidation, true);
        $tValidation = Validateur::validerChamp('acceptation_partage', "#^(on|off)$#", $tMessagesJson, $tValidation, true);
        $tValidation = Validateur::validerChamp('sujet', "#^[ -.0-9a-zA-ZÀ-ÿ';!?éèàùâêîôûäëïöüoeçÇ'«»=@:]*$#", $tMessagesJson, $tValidation, true);
        $tValidation = Validateur::validerChamp('message', "#^[ -.0-9a-zA-ZÀ-ÿ';!?éèàùâêîôûäëïöüoeçÇ'«»=@:]*$#", $tMessagesJson, $tValidation, true);
        $tValidation = Validateur::validerChamp('responsable_id', "#^\d{1}$#", $tMessagesJson, $tValidation, true);

        return $tValidation;
    }
}
