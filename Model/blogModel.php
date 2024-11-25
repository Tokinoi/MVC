<?php

class BlogModel
{
    private $pdo;

    public function __construct($host="localhost", $port='5432', $dbname='postgres', $user='postgres', $password='root', $schema = 'mvc')
    {
        try {
            $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
            $this->pdo = new PDO($dsn, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Définir le schéma par défaut
            $this->pdo->exec("SET search_path TO $schema");
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    /**
     * Ajoute un article dans la base de données
     * @param string $titre
     * @param string $contenu
     * @return bool
     */
    public function addArticle(string $titre, string $contenu) : bool
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO articles (titre, contenu) VALUES (:titre, :contenu)");
            $stmt->execute([
                ':titre' => filter_var($titre,FILTER_SANITIZE_STRING), //Protection contre injection - Never Trust the User
                ':contenu' => filter_var($contenu,FILTER_SANITIZE_STRING), //Protection contre injection - Never Trust the User
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Supprime un article par son ID
     * @param int $id
     * @return bool
     */
    public function deleteArticle(int $id): bool
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM articles WHERE id = :id");
            $stmt->execute([':id' => $id]);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Récupère tous les articles de la base de données
     * @return array
     */
    public function getArticles() : array
    {
        try {
            $stmt = $this->pdo->query("SELECT * FROM articles ORDER BY id DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des articles : " . $e->getMessage());
        }
    }
}

