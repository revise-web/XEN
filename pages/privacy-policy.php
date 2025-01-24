<?php
// Connexion à la base de données SQLite
try {
    $db = new PDO('sqlite:../database.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Nom de la page
    $page = 'privacy-policy'; 

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
    <link rel="shortcut icon" href="/logo.png" type="image/x-icon">
    <title>Privacy Policy | XEN</title>
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
        <h1>Privacy Policy</h1>
    </header>

    <div class="content">
        <h2>Privacy Policy</h2>
        <p>
            This Privacy Policy explains how we collect, use, and protect your information when you use our Discord bot.
        </p>
        <p>
            <strong>Information Collection:</strong> We do not collect personal information unless explicitly stated. Data such as user IDs and messages may be temporarily processed to provide bot functionality.
        </p>
        <p>
            <strong>Data Usage:</strong> Any data processed by the bot is used solely to enhance user experience and provide requested features. We do not share or sell your data.
        </p>
        <p>
            <strong>Data Protection:</strong> We implement reasonable security measures to protect your information. However, no method of transmission over the internet is 100% secure.
        </p>
        <p>
            By using the bot, you agree to this Privacy Policy. For any questions, contact us at xennextyt@gmail.com.
        </p>
    </div>

    <footer>
        <p>© 2025 XEN . All rights reserved.</p>
    </footer>

    <script>
        // Optional JavaScript to enhance the page
        document.addEventListener('DOMContentLoaded', () => {
            console.log('Privacy Policy loaded successfully.');
        });
    </script>
</body>
</html>
