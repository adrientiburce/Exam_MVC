<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title><?= $title ?></title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sticky-footer-navbar/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

</head>
<body class="d-flex flex-column h-100">
<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="index.php?view=accueil">Tiny MVC</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobileNavbar"
                aria-controls="mobileNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mobileNavbar">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php if ($view == "accueil") echo 'active'; ?>">
                    <a class="nav-link" href="index.php?view=accueil">Accueil</a>
                </li>
                <li class="nav-item <?php if ($view == "users") echo 'active'; ?>">
                    <a class="nav-link" href="index.php?view=users">Utilisateurs</a>
                </li>
                <li class="nav-item <?php if ($view == "conversations") echo 'active'; ?>">
                    <a class="nav-link" href="index.php?view=conversations">Conversations</a>
                </li>
                <li class="nav-item <?php if ($view == "parrainage") echo 'active'; ?>">
                    <a class="nav-link" href="index.php?view=parrainage">Parrainage</a>
                </li>
                <?php
                // Si l'utilisateur n'est pas connecte, on affiche un lien de connexion
                if (!valider("connecte", "SESSION")) { ?>
                    <li class="nav-item <?php if ($view == "login") echo 'active'; ?>">
                        <a class="nav-link" href="index.php?view=login">Connexion</a>
                    </li>
                <?php } ?>
                <?php
                if (valider("connecte", "SESSION")) { ?>
                    <li class="nav-item <?php if ($view == "logout") echo 'active'; ?>">
                        <a class="nav-link" href="controleur.php?action=logout">Déconexion</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</header>

<!-- Begin page content -->
<main role="main" class="flex-shrink-0 mb-4">
    <div class="container">
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3">
    <div class="container">
        <p>Infos de Connexion</p>
        <?php
        // Si l'utilisateur est connecte, on affiche un lien de deconnexion
        if (valider("connecte", "SESSION")) {
            echo "Utilisateur <b>$_SESSION[pseudo]</b> connecté depuis <b>$_SESSION[heureConnexion]</b> &nbsp; ";
        } else {
            echo "Utilisateur déconnecté ";
        }
        ?>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</html>
