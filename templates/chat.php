<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=chat&" . $_SERVER["QUERY_STRING"]);
	// Il faut renvoyer le reste de la chaine de requete... 
	// A SUIVRE : ne marche que pour requetes GET
	// Un appel à http://localhost/chatISIG/templates/chat.php?idConv=2
	// renvoie vers http://localhost/chatISIG/index.php?view=chat&idConv=2
	
	die("");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php");
include_once("libs/maLibForms.php");


// On récupère l'id de la conversation à afficher, dans idConv
$idConv = getValue("idConv");
if (!$idConv)
{
	// pas d'identifiant ! On redirige vers la page de choix de la conversation

	// NB : pose quelques soucis car on a déjà envoyé la bannière... 
	// Il y a opportunité d'écrire cette bannière plus tard si on la place en absolu
	header("Location:index.php?view=conversations"); 
	die("idConv manquant");
}

// On récupère les paramètres de la conversation
$dataConv = getConversation($idConv); 
if (!$dataConv)
{
	// La conversation n'existe pas ! 
	header("Location:index.php?view=conversations");
	die("La conversation n'existe pas ");
}

$title = "Chat";

ob_start();
?>

<h2 class="text-center text-primary mb-4"><?= $dataConv["theme"] ?></h2>

<?php
// Les messages 
$messages = listerMessages($idConv);
?>
<table class="table table-hover">
	<thead>
	<tr>
		<th scope="col">Auteur</th>
		<th scope="col">Message</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($messages as $message) { ?>
		<tr style="color:<?= $message['couleur']?>">
			<td><?= $message['auteur'] ?></td>
			<td><?= $message['contenu'] ?></td>
		</tr>
		<?php
	} ?>
	</tbody>
</table>

<?php
// Ajout d'un message ?
// Seulement si la conversation est active et si l'utilisateur est identifié ... 
// Si la conversation est active, on écrit un peu de code javascript pour recharger la page régulièrement

if ($dataConv["active"])
	if (valider("connecte","SESSION"))
	{
		echo '<h2 class="text-center text-primary mb-4">Ajout d\'un message</h2>'?>
<?php
		mkForm("controleur.php");
		mkInput("text","contenu");
		mkInput("submit","action","Poster");
		mkInput("hidden","idConv", $idConv);
		endForm();
	}
?>
<?php $content = ob_get_clean();

require 'template.php';

?>












