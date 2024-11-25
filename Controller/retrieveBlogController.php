<?php
//php -S localhost:8000 retrieveBlogController.php

// Paramètres de connexion à la base de données
require_once '../Model/blogModel.php';
$model = new BlogModel();


// SUPPRESSION D'UN ARTICLE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $deleteId = filter_var($_POST['delete_id'],FILTER_VALIDATE_INT); // Vérifie que c'est bien un INT - Never Trust the User

    // Suppression de l'article
    $model->deleteArticle($deleteId);
    $message = "Article supprimé avec succès !";
}


// AJOUT D'UN ARTICLE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['titre'], $_POST['contenu'])) {
    $titre = filter_var($_POST['titre'],FILTER_SANITIZE_STRING); //Protection contre injection - Never Trust the User
    $contenu = filter_var($_POST['contenu'],FILTER_SANITIZE_STRING); // Protection contre injection - Never Trust the User

    // Insertion de l'article dans la base de données
    $model->addArticle($titre, $contenu);
}


// RÉCUPÉRATION DU FORMAT DEMANDE
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['format'])) {
    $format = $_GET['format'];
}



$articles = $model->getArticles();


// AFFICHE LES DONNEES DANS LE BON FORMAT (OU LE FORMAT PAR DÉFAUTS)
if (isset($format)) {
    switch ($format) {
        case 'json':
            require "../View/jsonVue.php";
            break;
        default:
            require "../View/htmlView.php";
    }

}
else{
    require '../View/htmlView.php';
}




