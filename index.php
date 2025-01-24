<?php
try {
    // Connexion à la base de données SQLite
    $db = new PDO('sqlite:database.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier et créer la table 'visits' si nécessaire
    $query = "CREATE TABLE IF NOT EXISTS visits (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        page TEXT NOT NULL,
        count INTEGER DEFAULT 0
    )";
    $db->exec($query);

    // Insérer les pages initiales si elles n'existent pas
    $pages = ['index', 'privacy-policy', 'terms-of-service'];
    foreach ($pages as $page) {
        $stmt = $db->prepare("SELECT COUNT(*) FROM visits WHERE page = :page");
        if (!$stmt) {
            print_r($db->errorInfo());
            exit;
        }
        $stmt->bindParam(':page', $page);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count == 0) {
            $stmt = $db->prepare("INSERT INTO visits (page, count) VALUES (:page, 0)");
            $stmt->bindParam(':page', $page);
            $stmt->execute();
        }
    }

    // Mise à jour du compteur de visites de la page actuelle (index)
    if ($_SERVER['REQUEST_URI'] == '/') {
        $page = 'index';
        $stmt = $db->prepare("UPDATE visits SET count = count + 1 WHERE page = :page");
        $stmt->bindParam(':page', $page);
        $stmt->execute();
    }

    // Affichage des visites pour chaque page
    $stmt = $db->prepare("SELECT * FROM visits");
    $stmt->execute();
    $visits = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Récupérer les visites pour chaque page
    $index_visits = 0;
    $privacy_policy_visits = 0;
    $terms_of_service_visits = 0;
    foreach ($visits as $visit) {
        if ($visit['page'] == 'index') {
            $index_visits = $visit['count'];
        } elseif ($visit['page'] == 'privacy-policy') {
            $privacy_policy_visits = $visit['count'];
        } elseif ($visit['page'] == 'terms-of-service') {
            $terms_of_service_visits = $visit['count'];
        }
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="admin/logo.png" type="image/x-icon">
    <title>Home - Bot Documentation | XEN</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #121212;
            color: #ffffff;
            text-align: center;
        }

        .hero {
            position: relative;
            height: 100vh;
            background-image: url('banner.png');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000000;
            text-shadow: 0 4px 0px rgba(243, 176, 63, 10);
        }

        .hero-content {
            text-align: center;
        }

        .hero-content h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .hero-content p {
            font-size: 1.5rem;
            margin-bottom: 30px;
        }

        .hero-content a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #f3b03f;
            color: #121212;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .hero-content a:hover {
            background-color: #e09e34;
        }

        .links {
            margin: 40px auto;
            max-width: 600px;
            display: flex;
            justify-content: space-around;
        }

        .links a {
            text-decoration: none;
            color: #f3b03f;
            font-size: 1.2rem;
            transition: color 0.3s;
            padding: 6px;
            border-radius: 1px;
        }

        .links a:hover {
            color: #e09e34;
        }
        .links .Invite:hover {
            background-color: #f3b03f;
            color: #121212;
            padding: 6px;
            border-radius: 10px;
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
    </style>
</head>
<body>
    <div class="hero">
        <div class="hero-content">
            <h1>Welcome to Our Discord Bot</h1>
            <p>Enhance your server with advanced features and seamless integration.</p>
            <a href="https://ko-fi.com/xenext" target="_blank">Donation🎁</a>
            <a href="https://ko-fi.com/xenext" target="_blank">Invite🏹</a>
        </div>
    </div>

    <div class="links">
        <a href="pages/terms-of-service.php">Terms of Service</a>
        <a href="pages/privacy-policy.php">Privacy Policy</a>
        <a href="admin/admin.php">Admin</a>
    </div>

    <footer>
        <p>© 2025 XEN. All rights reserved.</p>
    </footer>

    <script>
        // Affichage du nombre de visites
        console.log('Number of visits on index: ' + <?php echo $index_visits; ?>);
        console.log('Number of visits on Privacy Policy: ' + <?php echo $privacy_policy_visits; ?>);
        console.log('Number of visits on Terms of Service: ' + <?php echo $terms_of_service_visits; ?>);
    </script>
</body>
</html>
