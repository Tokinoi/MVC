<?php
//php -S localhost:8000

// SUPPRESSION D'UN ARTICLE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    require_once "deleteBlogController.php";
}
// AJOUT D'UN ARTICLE
elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['titre'], $_POST['contenu'])) {
    require_once "newBlogController.php";
}

else{
    require_once "retrieveBlogController.php";
}
