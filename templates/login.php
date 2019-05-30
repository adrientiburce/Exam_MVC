<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
    header("Location:../index.php?view=login");
    die("");
}


$title = "Connexion"
?>
<?php ob_start(); ?>

    <div id="corps">

        <h1 class="text-center text-secondary">Connexion</h1>

        <form action="controleur.php" method="GET">
            <div class="form-group">
                <label for="login">Pseudo : </label>
                <input type="text" class="form-control" name="login" id="login">
            </div>
            <div class="form-group">
                <label for="passe">Mot de Passe :</label>
                <input type="password" class="form-control" name="passe" id="pass">
            </div>
            <button type="submit" class="btn btn-primary" name="action" value="connexion">Envoyer</button>
        </form>

    </div>

<?php $content = ob_get_clean();

require 'template.php';

