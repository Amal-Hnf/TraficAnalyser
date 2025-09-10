<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION["user_id"])) {
    header("Location: signin.php");
    exit();
}

$server = "sql104.infinityfree.com";
$username_db = "if0_39893908";
$password_db = "7lCNnqR9dJBR";
$dbname = "if0_39893908_trafficdata";

// Connexion à la base de données
$conn = mysqli_connect($server, $username_db, $password_db, $dbname);
if (!$conn) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

// Récupération des informations de l'utilisateur avec jointure sur le rôle
$user_id = $_SESSION["user_id"];
$sql = "SELECT Users.name_user, Users.email, Roles.role_name 
        FROM Users 
        LEFT JOIN Roles ON Users.role_id = Roles.id_role 
        WHERE Users.id_user = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $username = htmlspecialchars($row['name_user']);
    $role = htmlspecialchars($row['role_name']);
    $mail = htmlspecialchars($row['email']);
} else {
    // Déconnexion si l'utilisateur n'existe pas
    session_destroy();
    header("Location: signin.php");
    exit();
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>
<body>
    <?php include 'nav-bar.php'; ?>
    <div class="main">
        <div class="profile">
            <h1>Mon compte d'utilisateur</h1>
            <p>Nom d'utilisateur : <?php echo $username; ?></p>
            <p>Le rôle : <?php echo $role; ?></p>
            <p>E-mail : <?php echo $mail; ?> <button>Changer E-mail</button></p>
            <br>
            <button>
                <a href="change-password.html" style="text-decoration:none;color:inherit;">Modifier Mot de passe</a>
            </button>
        </div>
    </div>
    <?php include 'contact.php'; ?>
</body>
</html>
