<?php
session_start();

include_once "libs/maLibUtils.php";
include_once "libs/maLibSQL.pdo.php";
include_once "libs/maLibSecurisation.php";
include_once "libs/modele.php";

$addArgs = "";

if ($action = valider("action")) {
    ob_start();

    echo "Action = '$action' <br />";

// ATTENTION : le codage des caractères peut poser PB
// si on utilise des actions comportant des accents...
// A EVITER si on ne maitrise pas ce type de problématiques

    /* TODO: exercice 4
    // Dans tous les cas, il faut etre logue...
    // Sauf si on veut se connecter (action == Connexion)

    if ($action != "Connexion")
        securiser("login");
    */

// Un paramètre action a été soumis, on fait le boulot...
    switch ($action) {

        // Connexion    //////////////////////////////////////////////////
        case 'connexion' :
            // On verifie la presence des champs login et passe
            $qs = "?view=login";
            if ($login = valider("login")) {
                if ($passe = valider("passe")) {
                    // On verifie l'utilisateur, et on crée des variables de session si tout est OK
                    // Cf. maLibSecurisation
                    if (verifUser($login, $passe)) {
                        $qs = "?view=accueil";
                    }
                }
            }
            // On redirigera vers la page index automatiquement
            break;
        case 'logout' :
            session_destroy();
            $qs = "?view=login";
            break;

        // U S E R S     //////////////////////////////////////////////////
        case 'interdire' :
            if ($idUser = valider("idUser"))
                interdireUtilisateur($idUser);
            $qs = "?view=users&lastUserId=" . $idUser;
            break;
        case 'autoriser' :
            if ($idUser = valider("idUser"))
                autoriserUtilisateur($idUser);
            $qs = "?view=users&lastUserId=" . $idUser;
            break;

        // C O N V     //////////////////////////////////////////////////
        case 'activer_conv' :
            if ($idConv = valider("idConv"))
                reactiverConversation($idConv);
            $qs = "?view=conversations&lastConvId=" . $idConv;
            break;
        case 'archiver_conv' :
            if ($idConv = valider("idConv"))
                archiverConversation($idConv);
            $qs = "?view=conversations&lastConvId=" . $idConv;
            break;
        case 'supprimer_conv' :
            if ($idConv = valider("idConv"))
                supprimerConversation($idConv);
            $qs = "?view=conversations&lastConvId=''";
            break;
        case 'create_conv' :
            if ($theme = valider("theme")) {
                $idConv = false;
                creerConversation($theme);
            }
            $qs = "?view=conversations&lastConvId=" . $idConv;
            break;

        // C H A T     //////////////////////////////////////////////////
        case 'Poster' :
            if ($idConv = valider("idConv"))
                if ($contenu = valider("contenu"))
                    if ($idAuteur = valider("idUser", "SESSION")) {
                        enregistrerMessage($idConv, $idAuteur, $contenu);
                    }
            // On revient à la vue chat POUR CETTE CONVERSATION
            $qs = "?view=chat&idConv=$idConv";
            break;


        // P A R R A I N A G E     ////////////////////////////////////
        case 'parrainage' :
            if ($email_ami = valider("email_ami")) {
                if ($pseudo = valider("pseudo", "SESSION")) {
                    parrainerAmi($pseudo, $email_ami);
                }
            }
            $qs = "?view=parrainage";
            break;

        case 'verif_parrainage' :
            $qs = "?view=parrainage";
            // on verifie les infos de parrainage
            if ($pseudo_parrain = valider("pseudo_parrain"))
                if ($email = valider("email"))
                    if ($pseudo_parrain == verifParrainBdd($pseudo_parrain, $email))
                            // on inscrit le nouvel utilisateur
                            if ($pseudo = valider("pseudo")) {
                                if ($passe = valider("passe")) {
                                    if ($color = valider("color")) {
                                        ajouteUser($pseudo, $passe, $color);
                                        $qs = "?view=accueil";
                                    }
                                }
                            }
                            break;
                        }

}

// On redirige toujours vers la page index, mais on ne connait pas le répertoire de base
// On l'extrait donc du chemin du script courant : $_SERVER["PHP_SELF"]
// Par exemple, si $_SERVER["PHP_SELF"] vaut /chat/data.php, dirname($_SERVER["PHP_SELF"]) contient /chat

$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
// On redirige vers la page index avec les bons arguments

header("Location:" . $urlBase . $qs);
//qs doit contenir le symbole '?'

// On écrit seulement après cette entête
ob_end_flush();

?>








