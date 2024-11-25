<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bébé Blog :)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        header {
            background: #333;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        h1, h2 {
            color: #333;
        }
        .message {
            background: #e0ffd4;
            color: #2e7d32;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #c5e1a5;
            border-radius: 5px;
        }
        form {
            margin-bottom: 30px;
        }
        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background: #333;
            color: #fff;
            cursor: pointer;
        }
        article {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .delete-form {
            display: inline;
        }
        .delete-button {
            background: #ff4d4d;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<header>
    <h1>Bébé Blog</h1>
</header>

<div class="container">
    <!-- Message de succès -->
    <?php if (!empty($message)): ?>
        <div class="message"><?= $message; ?></div>
    <?php endif; ?>

    <!-- Formulaire pour ajouter un article -->
    <h2>Ajouter un article</h2>
    <form method="POST" action="">
        <input type="text" name="titre" placeholder="Titre de l'article" required>
        <textarea name="contenu" rows="5" placeholder="Contenu de l'article" required></textarea>
        <button type="submit">Publier</button>
    </form>

    <!-- Liste des articles -->
    <h2>Articles</h2>
    <?php if (!empty($articles)): ?>
        <?php foreach ($articles as $article): ?>
            <article>
                <h3><?= filter_var($article['titre'],FILTER_SANITIZE_STRING); ?></h3> <!-- //Protection contre injection - Never Trust the User -->
                <p><?=  filter_var($article['contenu'],FILTER_SANITIZE_STRING); ?></p> <!-- //Protection contre injection - Never Trust the User -->
                <!-- Bouton supprimer -->
                <form method="POST" action="../Controller/deleteBlogController.php" class="delete-form">
                    <input type="hidden" name="delete_id" value="<?= $article['id']; ?>">
                    <button type="submit" class="delete-button">Supprimer</button>
                </form>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun article trouvé. Soyez le premier à en publier un !</p>
    <?php endif; ?>
</div>

</body>
</html>