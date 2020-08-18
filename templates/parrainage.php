<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
    header("Location:../index.php?view=login");
    die("");
}
include_once("libs/maLibForms.php");// mkTable, mkLiens, mkSelect ...

$title = "Parrainage"
?>
<?php ob_start(); ?>

    <h1 class="text-center display-3 text-secondary"><?= $title ?></h1>

<?php if (valider('pseudo', 'SESSION')) {

    ?>
    <p>Veuillez rentre l'email de votre ami afin de le parrainer !</p>
    <?php
    mkForm("controleur.php");
    echo '<div class="form-group">';
    mkLabel("Email de mon ami :", "email_ami");
    mkInput("email", "email_ami");
    echo '</div>'; ?>
    <button type="submit" class="btn btn-success" name="action" value="parrainage">Parrainer mon ami</button>
    <?php endForm(); ?>

    <?php
    // l'utilisateur n'est pas connecte => form verifier le parrainage
} else {

    $submittedParrainage = valider('verif');

    if ($submittedParrainage === "false") { ?>
        <div class="alert alert-warning text-center">
            <h3>Votre parrain n'a pas été trouvé</h3>
        </div>
        <?php
    }

    ?>
    <h3>Veuillez rentrez le pseudo de l'ami qui vous a parrainé :</h3>
    <?php
    mkForm("controleur.php");
    echo '<div class="form-group">';
    mkLabel("Pseudo de mon Parrain :", "pseudo_parrain");
    mkInput("text", "pseudo_parrain");
    echo '</div>';
    echo '<div class="form-group">';
    mkLabel("Mon email :", "email");
    mkInput("email", "email");
    echo '</div>'; ?>

    <hr/>
    <h3>Veuillez vous inscire pour utiliser notre Blog : </h3>
    <?php
    echo '<div class="form-group">';
    mkLabel("Votre pseudo :", "pseudo");
    mkInput("text", "pseudo");
    echo '</div>';
    echo '<div class="form-group">';
    mkLabel("Votre couleur :", "color");
    mkInput("text", "color");
    echo '</div>';
    echo '<div class="form-group">';
    mkLabel("Votre mot de passe :", "passe");
    mkInput("password", "passe");
    echo '</div>'; ?>
    <button type="submit" class="btn btn-success" name="action" value="verif_parrainage">M'inscrire
    </button>
    <?php endForm();
} ?>

    </div>

<?php $content = ob_get_clean();

require 'template.php';

