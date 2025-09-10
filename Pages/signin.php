<?php
    session_start();
    $server = "sql104.infinityfree.com";
    $username = "if0_39893908";
    $password = "7lCNnqR9dJBR";
    $dbname = "if0_39893908_trafficdata";

    $message = "";

    // Connexion à la base de données
    $conn = mysqli_connect($server, $username, $password, $dbname);
    if (!$conn) {
        die("Erreur de connexion à la base de données : " . mysqli_connect_error());
    }

    // Traitement du formulaire
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $input_username = trim($_POST["Username"]);
        $input_password = trim($_POST["Password"]);

        // Vérifier si le nom d'utilisateur existe
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $input_username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // L'utilisateur existe, vérifier le mot de passe
            // Si tu utilises des mots de passe hashés, remplace la ligne suivante par :
            // if (password_verify($input_password, $row['password'])) {
            if ($input_password === $row['password']) {
                // Connexion réussie
                $_SESSION["username"] = $row['username'];
                $_SESSION["user_id"] = $row['id'];
                header("Location: home.php"); // Redirige vers la page d'accueil ou profil
                exit;
            } else {
                // Mot de passe incorrect
                $message = "Nom d'utilisateur ou mot de passe est incorrect";
            }
        } else {
            // L'utilisateur n'existe pas
            $message = "Vous n'avez pas un compte";
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/3.0.0/uicons-bold-straight/css/uicons-bold-straight.css'>
    <title>Connexion</title>
</head>
<body>
    <div class="main">
        <form action="" method="post">
            <h1><i class="fi fi-bs-sign-in-alt"> Sign In </i></h1>
            <?php if (!empty($message)): ?>
                <div style="color: red; margin-bottom: 10px;"><?php echo $message; ?></div>
            <?php endif; ?>
            <input type="text" name="Username" id="username" placeholder="Nom d'utilisateur" required>
            <br>
            <input type="password" name="Password" id="password" placeholder="Mot de passe" required>
            <br><a href="#Mot de passe oublié?">Mot de passe oublié?</a>
            <br><button type="submit">Se connecter</button>
        </form>
    </div>    
</body>
</html>
