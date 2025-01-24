<?php
// Connexion à la base de données SQLite
try {
    $db = new PDO('sqlite:../database.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Nom de la page
    $page = 'terms-of-service'; 

    // Enregistrer ou incrémenter le nombre de visites pour cette page
    $query = "SELECT count FROM visits WHERE page = :page";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':page', $page);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Si la page existe déjà, incrémente le compteur
        $newCount = $row['count'] + 1;
        $updateQuery = "UPDATE visits SET count = :count WHERE page = :page";
        $updateStmt = $db->prepare($updateQuery);
        $updateStmt->bindParam(':count', $newCount);
        $updateStmt->bindParam(':page', $page);
        $updateStmt->execute();
    } else {
        // Si la page n'existe pas, crée une nouvelle entrée
        $insertQuery = "INSERT INTO visits (page, count) VALUES (:page, 1)";
        $insertStmt = $db->prepare($insertQuery);
        $insertStmt->bindParam(':page', $page);
        $insertStmt->execute();
    }
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <title>Terms of Service | XEN</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #121212;
            color: #ffffff;
            text-align: center;
        }

        header {
            background-color: #1e1e1e;
            padding: 20px;
        }

        header img {
            width: 80px;
        }

        header h1 {
            font-size: 2rem;
            margin: 10px 0;
        }

        .content {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #1e1e1e;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .content h2 {
            color: #f3b03f;
            margin-bottom: 15px;
        }

        .content p {
            line-height: 1.6;
            margin-bottom: 15px;
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
    <?php include('navbar.php'); ?>
    <header>
        <img src="logo.png" alt="Logo">
        <h1>Terms of Service</h1>
    </header>

    <div class="content">
        <h2>Terms of Service</h2>
        <p>
            By using our Discord bot, you agree to comply with and be bound by the following terms of service. If you do not agree to these terms, you are prohibited from using the bot.
        </p>
        <p>
            The bot is provided "as is" and "as available". We are not responsible for any damage caused by the bot, including but not limited to data loss or account suspension.
        </p>
        <p>
            Users are expected to use the bot responsibly and adhere to Discord's community guidelines.
        </p>
    </div>

    <footer>
        <p>© 2025 XEN. All rights reserved.</p>
    </footer>

    <script>
        // Optional JavaScript to enhance the page
        document.addEventListener('DOMContentLoaded', () => {
            console.log('Terms of Service loaded successfully.');
        });
    </script>
</body>
</html>
