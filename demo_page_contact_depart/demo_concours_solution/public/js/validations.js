
const objJSONErreurs = {
    "nom": {
        "vide": "Client: Vous devez entrer votre nom complet",
        "pattern": "Client: Pour le nom de famille, les accents français, les espaces, les tirets et les apostrophes sont permis."
    },
    "courriel": {
        "vide": "Client: Vous devez entrer votre adresse courriel",
        "pattern": "Client: Assurez-vous d'entrer une adresse courriel valide."
    },
    "telephone": {
        "vide": "Client: Vous devez entrer votre numéro de téléphone",
        "pattern": "Client: Assurez-vous d'entrer seulement dix chiffres sans espace."
    },
    "responsable_id": {
        "vide": "Client: Vous devez choisir un.e destinataire.",
        "pattern": "Client: Assurez-vous de sélectionner un destinataire."
    },
    "sujet": {
        "vide": "Client: Vous devez entrer un sujet.",
        "pattern": "Client: Pour le sujet, les accents français, les espaces, les tirets et les apostrophes sont permis."
    },
    "message": {
        "vide": "Client: Vous devez entrer un message.",
        "pattern": "Client: Pour le message, les accents français, les espaces, les tirets et les apostrophes sont permis."
    }

};


const page = {

    initialiser: function () {
        document.querySelector(".soumission").formNoValidate = true;
    },

    // Méthodes de validation génériques
    validerChamp: function (evenement) {
        const objCible = evenement.currentTarget;
        const conteneur = objCible.closest('.ctnForm')
        const strChaine = objCible.value.trim();
        const pattern = new RegExp(objCible.pattern);
        const champID = objCible.id;

        // Si la valeur est vide
        if (strChaine === "") {
            this.afficherErreur(objCible, conteneur, champID, objJSONErreurs[champID].vide);
        }
        // Si la valeur ne correspond au pattern
        else if (!pattern.test(strChaine)) {
            this.afficherErreur(objCible, conteneur, champID, objJSONErreurs[champID].pattern);
        }
        // Si la valeur est correcte
        else {
            this.afficherSucces(objCible, conteneur, champID);
        }
    },

    afficherErreur: function (objCible, conteneur, champID, message) {
        element = conteneur.querySelector('span.spriteRETRO.spriteRETRO--ok');
        if (element) {
            element.remove(); // Supprime l'élément ok si nécessaire
        }
        objCible.classList.add('erreur');
        conteneur.querySelector('.erreur__message').innerHTML = `<span class="spriteRETRO spriteRETRO--warning"></span> ${message}`;
    },

    afficherSucces: function (objCible, conteneur, champID) {
        objCible.classList.remove('erreur');
        conteneur.querySelector('.erreur__message').innerHTML = '';
        let spriteOk = conteneur.querySelector('.spriteRETRO--ok');

        if (!spriteOk) {
            spriteOk = document.createElement('span');
            spriteOk.className = 'spriteRETRO spriteRETRO--ok';
            conteneur.querySelector('label').appendChild(spriteOk);
        }
    }
};


// Écouteurs d'événements
window.addEventListener("load", page.initialiser.bind(page));

document.getElementById("nom").addEventListener("blur", page.validerChamp.bind(page));
document.getElementById("courriel").addEventListener("blur", page.validerChamp.bind(page));
document.getElementById("telephone").addEventListener("blur", page.validerChamp.bind(page));
document.getElementById("sujet").addEventListener("blur", page.validerChamp.bind(page));
document.getElementById("message").addEventListener("blur", page.validerChamp.bind(page));
document.getElementById("responsable_id").addEventListener("change", page.validerChamp.bind(page));

