<?php

use Controller\BlogController;

$model = new BlogController;

$titre = filter_var($_POST['titre'],FILTER_SANITIZE_STRING); //Protection contre injection - Never Trust the User
$contenu = filter_var($_POST['contenu'],FILTER_SANITIZE_STRING); // Protection contre injection - Never Trust the User

// Insertion de l'article dans la base de données
$model->addArticle($titre, $contenu);