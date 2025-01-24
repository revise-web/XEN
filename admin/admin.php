<?php
// Démarrer la session pour gérer la connexion
session_start();

// Vérification de la connexion
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Utilisation des informations de connexion (exemple avec admin et mot de passe)
    $admin_username = "admin.xen";
    $admin_password = "Xennextyt_976"; // Change le mot de passe pour plus de sécurité

    // Vérification des identifiants
    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_dashboard.php"); // Rediriger vers le tableau de bord
        exit;
    } else {
        $error_message = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}

// Si l'utilisateur est déjà connecté, redirigez-le vers le tableau de bord
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin_dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <title>Connexion à l'Admin | XEN</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #121212;
            color: #ffffff;
            text-align: center;
        }

        .login-form {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #1e1e1e;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .login-form h2 {
            color: #f3b03f;
            margin-bottom: 20px;
        }

        .login-form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-form input[type="submit"] {
            background-color: #f3b03f;
            color: #121212;
            border: none;
            font-weight: bold;
        }

        .login-form input[type="submit"]:hover {
            background-color: #e09e34;
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

        .error-message {
            color: red;
            font-size: 1.1rem;
            margin-top: 15px;
        }

        .button-container {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .button-container a {
            padding: 15px 30px;
            background-color: #f3b03f;
            color: #121212;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
        }

        .button-container a:hover {
            background-color: #e09e34;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <h2>Connexion à l'Admin</h2>

        <?php
        // Afficher un message d'erreur si les identifiants sont incorrects
        if (isset($error_message)) {
            echo "<p class='error-message'>$error_message</p>";
        }
        ?>

        <form method="POST" action="">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Se connecter">
        </form>

        <!-- Boutons Accueil et Tableau de Bord -->
        <div class="button-container">
            <a href="\index.php">Accueil</a>
            <a href="admin_dashboard.php">Tableau de Bord</a>
        </div>
    </div>

    <footer>
        <p>© 2025 XEN. All rights reserved.</p>
    </footer>
</body>
</html>
