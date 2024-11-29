@extends('gabarit')

@section('contenu')

<form action="index.php?controleur=contact&action=inserer" method="POST">

    <h2>Contact</h2>

    
    <!-- Nom ---------------------->
    <div class="ctnForm">
        <p>
            <label for="nom">Nom
                @if($tValidation !== null)
                    @if($tValidation['nom']['valide'] == 'vrai')
                        <span class="spriteRETRO spriteRETRO--ok"></span>
                    @endif
                @endif
            </label>

            <input type="text"
                    name="nom" id="nom"
                    placeholder="Nom"
                    value = ""
                    required
                    pattern="^[a-zA-ZÀ-ÿ' -]+$"
                    title="Caractères alphabétiques français seulement."
            >
        </p>
    
        <p class="erreur__message">
            @if($tValidation != null)
                @if($tValidation['nom']['valide']=='faux')
                    <span class="spriteRETRO spriteRETRO--warning"></span>
                    {{$tValidation['nom']['message']}}
                @endif
            @endif
        </p>
    </div>
 

    <!-- Courriel ---------------------->


    <div class="ctnForm">
        <p>   
            <label for="courriel">Courriel
                @if($tValidation !== null)
                    @if($tValidation['courriel']['valide']=='vrai' )
                        <span class="spriteRETRO spriteRETRO--ok"></span>
                    @endif
                @endif
            </label>

            <input type="email"
                   name="courriel"
                   pattern="^[a-zA-Z0-9][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,}$"
                   value=""
                   id="courriel" required>
        </p>
        <p class="erreur__message">
            @if($tValidation != null)
                @if($tValidation['courriel']['valide']=='faux')
                    <span class="spriteRETRO spriteRETRO--warning"></span>{{$tValidation['courriel']['message']}}
                @endif
            @endif
        </p>
    </div>
 

    <!-- Téléphone ---------------------->
    <div class="ctnForm ctnForm--regulier" >
        <p>
            <label for="telephone">Numéro de téléphone (10 chiffres)
                @if($tValidation != null)
                    @if($tValidation['telephone']['valide']=='vrai')
                        <span class="spriteRETRO spriteRETRO--ok"></span>
                    @endif
                @endif
            </label>

            <input type="tel" name="telephone" id="telephone"
                    title="Numéro, 10 chiffres"
                    value=""
                    class="notelephone" required
                    minlength="10"
                    maxlength="10" 
                    pattern="^[0-9]{10}$"
            >
        </p>

        <p class="erreur__message">
            @if($tValidation != null)
                @if($tValidation['telephone']['valide'] == 'faux')
                    <span class="spriteRETRO spriteRETRO--warning"></span>
                    {{$tValidation['telephone']['message']}}
                @endif
            @endif
        </p>
    </div>

    <!-- Acceptation partage ---------------------->
    <div class="ctnForm">
        <p>
            <input name="acceptation_partage"
                id="acceptation_partage"
                type="checkbox"
            >
            <label for="acceptation_partage"> J’AUTORISE LE PARTAGE DE MON NUMÉRO AVEC UN ÉTUDIANT-GUIDE.</label>
        </p>
    </div>


    <!-- Destinataire ---------------------->
    
    <div class="ctnForm ctnForm--regulier">
        <p>
            <label for="responsable_id">Destinataire
                @if($tValidation != null)
                    @if($tValidation['responsable_id']['valide']=='vrai')
                        <span class="spriteRETRO spriteRETRO--ok"></span>
                    @endif 
                @endif
            </label>
            <select name="responsable_id" id="responsable_id" required >
                <option value="">Choisir un responsable</option>
                <option value="1">Sylvain Lamoureux (Coordonateur départemental)</option>
                <option value="2">Ève Février (Webmestre)</option>
                <option value="3">Benoît Frigon (Responsable Étudiant.e d'un jour)</option>
                <option value="4">Pascal Larose (Coordonateur des stages)</option>
            </select>
        </p>

        <p class="erreur__message">
            @if($tValidation != null)
                @if($tValidation['responsable_id']['valide']=='faux')
                    <span class="spriteRETRO spriteRETRO--warning"></span>{{$tValidation['responsable_id']['message']}}
                @endif
            @endif
        </p>
    </div>



    <!-- Sujet ---------------------->
    <div class="ctnForm">
        <p>
            <label for="sujet">Sujet
                @if($tValidation != null)
                    @if($tValidation['sujet']['valide']=='vrai' )
                        <span class="spriteRETRO spriteRETRO--ok"></span>
                    @endif
                @endif
            </label>
            <input type="text"
                    name="sujet" id="sujet"
                    placeholder="Sujet"
                    value = ""
                    required
                    pattern="^[ -.0-9a-zA-ZÀ-ÿ';!?éèàùâêîôûäëïöüœçÇ'«»=@:]*$"
                    title="Caractères alphabétiques français seulement."
            >
        </p>
  
        <p class="erreur__message">
            @if($tValidation !=null)
                @if($tValidation['sujet']['valide']=='faux')
                    <span class="spriteRETRO spriteRETRO--warning"></span>
                    {{$tValidation['sujet']['message']}}
                @endif
            @endif
        </p>
    </div>


    <!-- Message ---------------------->
    <div class="ctnForm">
        <p>
            <label for="message" >Message
                @if($tValidation != null)
                    @if($tValidation['message']['valide']=='vrai' )
                        <span class="spriteRETRO spriteRETRO--ok"></span>
                    @endif
                @endif
            </label>
            <input type="text"
                    name="message" id="message"
                    placeholder="Message"
                    value= ""
                    required
                    pattern="^[ -.0-9a-zA-ZÀ-ÿ';!?éèàùâêîôûäëïöüœçÇ'«»=@:]*$"
                    title="Caractères alphabétiques français seulement."
            >
        </p>
    
        <p class="erreur__message">
            @if($tValidation !=null)
                @if($tValidation['message']['valide']=='faux')
                    <span class="spriteRETRO spriteRETRO--warning"></span>{{$tValidation['message']['message']}}
                @endif
            @endif
        </p>
    </div>




    <!-- Soumission ---------------------->
    <p class="ctnSoumission ctnForm--horsFieldset">
        <button name="soumission" class="soumission">Soumettre</button>
    </p>

</form>

@endsection

