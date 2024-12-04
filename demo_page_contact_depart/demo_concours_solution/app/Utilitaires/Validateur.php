<?php

declare(strict_types=1);

namespace App\Utilitaires;

// Quand faire une méthode utilitaire ?

// Est-ce que la méthode est autonome par elle même?
// Est-ce que la méthode reçoit en argument tout ce qu'elle a besoin pour faire son travail?
// Est-ce que la méthode est utilisée par plusieurs classes de l'applicaiton?
// Si oui à toutes ces questions => faire une méthode utilitaire statique !

class Validateur
{

    public static function validerChamp(string $nomChamp, string $motif, array $unTableauMessagesJson, array $unTableauValidation, bool $estRequis)
    {
        $valeur = '';
        $valide = 'faux';
        $message = '';


        if (isset($_POST[$nomChamp])) {
            // Si le champ existe dans $_POST

            $valeur = $_POST[$nomChamp];

            if ($valeur == '') {
                // Si vide



                if ($estRequis) {
                    // vide et requis => message d'erreur
                    $message = $unTableauMessagesJson[$nomChamp]['vide'];
                } else {
                    // vide et non requis => valide
                    $valide = 'vrai';
                }
            } else {
                // Si pas vide, vérifier regEx
                $trouve = preg_match($motif, $valeur);
                if (!$trouve) {
                    // RegEx echoué => message d'erreur 
                    $message = $unTableauMessagesJson[$nomChamp]['pattern'];
                } else {
                    // RegEx réussi => valide
                    $valide = 'vrai';
                }
            }
        } else {
            // Si le champ n'existe pas dans $_POST (Exemple: boîte à cocher pas coché.)
            if (!$estRequis) {
                // non requis (la boite à cocher peut rester non cochée)
                $valide = 'vrai';
            } else {
                // message d'erreur  (la boite à cocher doit être cochée)
                $message = $unTableauMessagesJson[$nomChamp]['vide'];
            }
        }

        $unTableauValidation[$nomChamp] = ['valeur' => $valeur, 'valide' => $valide, 'message' => $message];

        return $unTableauValidation;
    }
}
