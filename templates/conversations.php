<?php
// Ce fichier permet de tester les fonctions développées dans le fichier malibforms.php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) == "conversations.php") {
    header("Location:../index.php?view=conversations");
    die("");
}

include_once("libs/modele.php"); // listes
include_once("libs/maLibUtils.php");// tprint
include_once("libs/maLibForms.php");// mkTable, mkLiens, mkSelect ...


$title = "Conversations";

ob_start(); ?>

<h1 class="text-center display-3 text-secondary"><?= $title ?></h1>

<h2 class="text-secondary">Liste des conversations actives</h2>

<?php

$conversations = listerConversations("actives");
mkLiens($conversations, "theme", "id", "index.php?view=chat", "idConv");

// A remplacer par mkLiens
?>
<hr/>
<h2 class="text-secondary">Liste des conversations inactives</h2>

<?php
$conversations = listerConversations("inactives");
mkLiens($conversations, "theme", "id", "index.php?view=chat", "idConv");

//mkTable($arrayLiens , array('id', 'theme'));
// A remplacer par mkLiens
?>

<hr/>

<h2 class="text-secondary mb-2">Créer une conversation</h2>

<?php

mkForm("controleur.php");
echo '<div class="form-group">';
mkLabel("Thème de la conversation : ","theme" );
mkInput("text", "theme"); ?>
</div>
<button class="btn btn-sm btn-success" type="submit" name="action" value="create_conv">
    Créer
</button>
<?php endForm();  ?>

<hr/>

<?php
// ============ A D M I N ===============
if(valider("connecte", "SESSION") && $_SESSION["isAdmin"]) { ?>

    <h2 class="text-secondary mb-2">Gestion des conversations</h2>

    <?php

    $conversations = listerConversations(); // toutes
    $lastConvId = valider('lastConvId');


    mkForm("controleur.php");
    mkSelect("idConv", $conversations, "id", "theme", $lastConvId); ?>
    <button class="btn btn-sm btn-success" type="submit" name="action" value="activer_conv">
        Activer
    </button>
    <button class="btn btn-sm btn-secondary" type="submit" name="action" value="archiver_conv">
        Archiver
    </button>
    <button class="btn btn-sm btn-danger" type="submit" name="action" value="supprimer_conv"
            onclick=" return confirm('Etes-vous sûr de supprimer cette conversation ?')">
        Supprimer
    </button>
    <?php
    endForm();

}
?>


<?php $content = ob_get_clean();

require 'template.php';

?>













