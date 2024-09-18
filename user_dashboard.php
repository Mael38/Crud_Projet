<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

// Exemple de films pour afficher sur le tableau de bord (remplace par des données dynamiques si besoin)
$films = [
    ["titre" => "Inception", "année" => 2010, "genre" => "Science-fiction"],
    ["titre" => "Interstellar", "année" => 2014, "genre" => "Science-fiction"],
    ["titre" => "The Dark Knight", "année" => 2008, "genre" => "Action"],
    ["titre" => "Parasite", "année" => 2019, "genre" => "Thriller"],
    ["titre" => "Avatar", "année" => 2009, "genre" => "Aventure"]
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord utilisateur</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #2c3e50;
            color: white;
            padding: 15px 20px;
            text-align: center;
            font-size: 1.5em;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2.2em;
            color: #2980b9;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            font-size: 1.2em;
            text-align: center;
            margin-bottom: 30px;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #2980b9;
            color: white;
        }

        td {
            background-color: #f9f9f9;
        }

        button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            font-size: 1em;
            color: white;
            background-color: #e74c3c;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #c0392b;
        }

        footer {
            text-align: center;
            margin-top: 40px;
            padding: 20px;
            background-color: #2c3e50;
            color: white;
            position: relative;
        }

    </style>
</head>
<body>

<header>
    <h1>Bienvenue, <?php echo $_SESSION['user_name']; ?> !</h1>
</header>

<div class="container">
    <p>Ceci est votre tableau de bord utilisateur où vous pouvez voir vos films préférés.</p>

    <h2>Liste des films recommandés</h2>

    <!-- Table des films -->
    <table>
        <thead>
            <tr>
                <th>Titre du film</th>
                <th>Année</th>
                <th>Genre</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($films as $film): ?>
                <tr>
                    <td><?php echo $film["titre"]; ?></td>
                    <td><?php echo $film["année"]; ?></td>
                    <td><?php echo $film["genre"]; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Bouton de déconnexion -->
    <a href="logout.php">
        <button>Se déconnecter</button>
    </a>
</div>

<footer>
    <p>Tableau de bord utilisateur &copy; 2024 - Mael Projet Cesi </p>
</footer>

</body>
</html>
