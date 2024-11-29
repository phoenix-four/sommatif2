<?php

declare(strict_types=1);

namespace App\Modeles;

use App\APP;  // Importer la classe APP pour la connexion à la BD
use \PDO;      // Importer la classe PDO de l'espace global

class Contact
{
    // Propriétés privées avec types
    private int $id;
    private string $nom;
    private string $courriel;
    private string $telephone;
    private string $acceptation_partage;
    private string $sujet;
    private string $message;
    private int $responsable_id;

    // Constructeur sans argument
    public function __construct()
    {
        // Initialisation des propriétés, si nécessaire
    }

    // Getter et Setter pour $id
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    // Getter et Setter pour $nom
    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    // Getter et Setter pour $courriel
    public function getCourriel(): string
    {
        return $this->courriel;
    }

    public function setCourriel(string $courriel): void
    {
        $this->courriel = $courriel;
    }

    // Getter et Setter pour $telephone
    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): void
    {
        $this->telephone = $telephone;
    }

    // Getter et Setter pour $acceptation_partage
    public function getAcceptationPartage(): string
    {
        return $this->acceptation_partage;
    }

    public function setAcceptationPartage(string $acceptation_partage): void
    {
        $this->acceptation_partage = $acceptation_partage;
    }

    // Getter et Setter pour $sujet
    public function getSujet(): string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): void
    {
        $this->sujet = $sujet;
    }

    // Getter et Setter pour $message
    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    // Getter et Setter pour $responsable_id
    public function getResponsableId(): int
    {
        return $this->responsable_id;
    }

    public function setResponsableId(int $responsable_id): void
    {
        $this->responsable_id = $responsable_id;
    }

    // Méthode pour insérer le contact dans la base de données
    public function inserer(): bool
    {
        $sql = "INSERT INTO contacts (nom, courriel, telephone, acceptation_partage, sujet, message, responsable_id)
                VALUES (:nom, :courriel, :telephone, :acceptation_partage, :sujet, :message, :responsable_id)";

        $requetePreparee = APP::getPDO()->prepare($sql);
        $requetePreparee->bindParam(':nom', $this->nom, PDO::PARAM_STR); // Lier le nom comme une chaîne
        $requetePreparee->bindParam(':courriel', $this->courriel, PDO::PARAM_STR); // Lier l'email comme une chaîne
        $requetePreparee->bindParam(':telephone', $this->telephone, PDO::PARAM_STR); // Lier le téléphone comme une chaîne
        $requetePreparee->bindParam(':acceptation_partage', $this->acceptation_partage, PDO::PARAM_STR); // Lier l'acceptation comme un booléen
        $requetePreparee->bindParam(':sujet', $this->sujet, PDO::PARAM_STR); // Lier le sujet comme une chaîne
        $requetePreparee->bindParam(':message', $this->message, PDO::PARAM_STR); // Lier le message comme une chaîne
        $requetePreparee->bindParam(':responsable_id', $this->responsable_id, PDO::PARAM_INT); // Lier l'ID responsable comme un entier

        // Exécuter la requête et vérifier si l'insertion est réussie
        if ($requetePreparee->execute()) {
            // Récupérer le dernier ID inséré et l'affecter à la propriété $id
            $this->id = (int) APP::getPDO()->lastInsertId();
            return true; // Insertion réussie
        } else {
            return false; // Erreur lors de l'insertion
        }
    }
}
