<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
// Pas de soucis de bufferisation, puisque c'est dans le cas où on appelle directement la page sans son contexte
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
    header("Location:../index.php?view=accueil");
    die("");
}

$title = "Accueil";
?>

<?php ob_start(); ?>


<div id="" xmlns="http://www.w3.org/1999/html">
    <h1 class="text-center display-3 text-secondary"><?= $title ?></h1>

    <div class="alert alert-primary text-center">
       <p>Un site réalisé dans le cadre de l'électif Tech Web 2.0 </p>
<!--        <p>Sujet du TP : <a href="https://moodle1819.centralelille.fr/pluginfile.php/8148/mod_resource/content/0/Cas%20d%C3%A9tude%20TinyMVC.pdf">ici</a></p>-->
    </div>
    <div class="container jumbotron">
        Bienvenue dans notre site de messagerie instantanée !
    </div>
</div>

<?php $content = ob_get_clean();

require 'template.php';

?>


