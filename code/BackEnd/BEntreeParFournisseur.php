<?php
include '../DB/config.php'; 

try {
    $query = "
        SELECT 
            es.date_entree,
            a.designation AS produit,
            les.quantite,
            a.prix_achat
        FROM EntreeStock es
        JOIN LigneEntreeStock les ON es.id_entree = les.id_entree
        JOIN Article a ON les.id_article = a.id_article
        ORDER BY es.date_entree DESC
    ";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Organiser les données par date d'entrée
    $donnees = [];
    foreach ($resultats as $row) {
        $donnees[$row['date_entree']][] = $row;
    }

} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>
