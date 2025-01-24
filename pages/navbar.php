<!-- navbar.php -->
<div class="navbar">
    <ul>
        <li><a href="\index.php">Accueil</a></li>
        <li><a href="\admin/admin_dashboard.php">Tableau de bord</a></li>
        <li><a href="\pages/privacy-policy.php">Politique de confidentialité</a></li>
        <li><a href="\pages/terms-of-service.php">Conditions d'utilisation</a></li>
    </ul>
</div>

<style>
    /* Style de la barre de navigation */
    .navbar {
        position: fixed;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 200px;
        background-color: #1e1e1e;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 4px 0 10px rgba(0, 0, 0, 0.3);
    }

    .navbar ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
        text-align: center;
    }

    .navbar ul li {
        margin: 10px 0;
    }

    .navbar ul li a {
        color: #f3b03f;
        text-decoration: none;
        font-weight: bold;
        font-size: 1.1rem;
    }

    .navbar ul li a:hover {
        color: #e09e34;
    }
</style>
