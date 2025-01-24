<?php
// Démarrer la session
session_start();

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Rediriger vers la page de connexion si non connecté
    header("Location: admin.php");
    exit;
}

// Connexion à la base de données SQLite
try {
    $db = new PDO('sqlite:../database.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour obtenir les visites de toutes les pages
    $query = "SELECT page, count FROM visits";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $visits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Calculer le nombre total de visites
    $total_visits = 0;
    foreach ($visits as $visit) {
        $total_visits += $visit['count'];
    }
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <title>Tableau de Bord Admin | XEN</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #121212;
            color: #ffffff;
            text-align: center;
        }

        .dashboard {
            max-width: 800px;
            margin: 100px auto;
            padding: 20px;
            background-color: #1e1e1e;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .dashboard h2 {
            color: #f3b03f;
            margin-bottom: 20px;
        }

        .stats-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .stats-table th, .stats-table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #555;
        }

        .stats-table th {
            background-color: #333;
        }

        footer {
            margin-top: 20px;
            padding: 20px;
            background-color: #1e1e1e;
        }

        footer p {
            margin: 0;
            font-size: 0.9rem;
            color: #aaaaaa;
        }

        .logout-btn {
            padding: 10px 20px;
            background-color: #f3b03f;
            color: #121212;
            border: none;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            border-radius: 5px;
        }

        .logout-btn:hover {
            background-color: #e09e34;
        }

        .total-visits {
            margin-top: 20px;
            font-size: 1.2rem;
            color: #f3b03f;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <h2>Bienvenue dans le Tableau de Bord Admin</h2>
        <p>Voici vos statistiques et outils d'administration.</p>

        <!-- Total des visites -->
        <div class="total-visits">
            <p><strong>Nombre total de visites :</strong> <?php echo $total_visits; ?></p>
        </div>

        <!-- Table des statistiques -->
        <h3>Statistiques des visites</h3>
        <table class="stats-table">
            <thead>
                <tr>
                    <th>Page</th>
                    <th>Nombre de Visites</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($visits as $visit): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($visit['page']); ?></td>
                        <td><?php echo htmlspecialchars($visit['count']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="logout.php" class="logout-btn">Se déconnecter</a>
    </div>

    <footer>
        <p>© 2025 XEN. All rights reserved.</p>
    </footer>
</body>
</html>
