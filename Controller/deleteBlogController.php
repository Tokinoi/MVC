<?php

use Controller\BlogController;

$model = new BlogController;

$deleteId = filter_var($_POST['delete_id'],FILTER_VALIDATE_INT); // Vérifie que c'est bien un INT - Never Trust the User

// Suppression de l'article
$model->deleteArticle($deleteId);
$message = "Article supprimé avec succès !";