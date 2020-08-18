<?php
// Ce fichier permet de tester les fonctions développées dans le fichier bdd.php (première partie)

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) == "users.php") {
    header("Location:../index.php?view=users");
    die("");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php"); // tprint


$title = "Administration";

ob_start();
?>

<h1 class="text-center display-3 text-secondary"><?= $title ?></h1>

<h2 class="text-center text-muted mt-2">Liste des utilisateurs de la base </h2>

<?php
$users = listerUtilisateurs("nbl");
?>

<h3 class="text-primary mt-2">Utilisateurs autorisés</h3>
<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">Pseudo</th>
        <th scope="col">Admin</th>
        <th scope="col">Couleur</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user) { ?>
        <tr>
            <td><?= $user['pseudo'] ?></td>
            <td><?= $user['admin'] == 1 ? 'Oui' : 'Non' ?></td>
            <td class="bg_<?= $user['couleur'] ?>"><?= $user['couleur'] ?></td>
        </tr>
        <?php
    } ?>
    </tbody>
</table>


<?php
$users = listerUtilisateurs("bl");
?>

<h3 class="text-primary mt-2">Utilisateurs non autorisés</h3>
<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">Pseudo</th>
        <th scope="col">Admin</th>
        <th scope="col">Couleur</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user) { ?>
        <tr>
            <td><?= $user['pseudo'] ?></td>
            <td><?= $user['admin'] == 1 ? 'Oui' : 'Non' ?></td>
            <td class="bg_<?= $user['couleur'] ?>"><?= $user['couleur'] ?></td>
        </tr>
        <?php
    } ?>
    </tbody>
</table>


<!-- VUE ADMIN ONLY -->

<?php if(valider("connecte", "SESSION") && $_SESSION["isAdmin"]) { ?>

<h3 class="text-primary mt-2">Changement de statut des utilisateurs</h3>

<form action="controleur.php">
    <select name="idUser">
        <?php
        $users = listerUtilisateurs();

        $idLastUser = valider('lastUserId');
        // préférer un appel à mkSelect("idUser",$users, ...)
        foreach ($users as $dataUser) {
            $dataUser["id"] == $idLastUser ? $isSelected = "selected" : $isSelected = "";

            echo "<option $isSelected value=\"$dataUser[id]\">\n";
            echo $dataUser["pseudo"]; ?>
            <?= $dataUser["blacklist"] == 1 ? '(backlisté)' : '(non-blacklisté)'; ?>
            <?php echo "\n</option>\n";
        }
        ?>
    </select>
    <button class="btn btn-sm btn-danger" type="submit" name="action" value="interdire">
        Interdire
    </button>
    <button class="btn btn-sm btn-success" type="submit" name="action" value="autoriser">
        Autoriser
    </button>
</form>

<?php
}
?>

<?php $content = ob_get_clean();

require 'template.php';

?>





