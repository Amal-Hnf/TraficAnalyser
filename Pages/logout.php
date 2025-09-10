<?php
session_start();

// Si l'utilisateur a confirmé la déconnexion
if (isset($_POST['confirm'])) {
    if ($_POST['confirm'] === 'oui') {
        // Détruire la session
        session_unset();
        session_destroy();
        // Redirige vers la page de connexion (à adapter si besoin)
        header("Location: signin.php");
        exit();
    } else {
        // Redirige vers la page d'accueil ou profil si refus
        header("Location: home.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Déconnexion</title>
    <style>
        .logout-confirm {
            margin: 80px auto;
            width: 340px;
            padding: 36px;
            border-radius: 12px;
            background: #eee;
            box-shadow: 2px 2px 15px #999;
            text-align: center;
        }
        .logout-confirm button {
            margin: 10px 20px;
            padding: 8px 25px;
            border-radius: 6px;
            border: none;
            background: #1976d2;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        .logout-confirm button.no {
            background: #aaa;
        }
    </style>
</head>
<body>
    <div class="logout-confirm">
        <h2>Voulez-vous vraiment vous déconnecter&nbsp;?</h2>
        <form method="post" action="">
            <button type="submit" name="confirm" value="oui">Oui</button>
            <button type="submit" name="confirm" value="non" class="no">Non</button>
        </form>
    </div>
</body>
</html>
