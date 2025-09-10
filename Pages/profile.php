<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <?php //importer 'nav-bar.html' ?>
    <div class="main">
        <div class="profile">
            <h1>Mon compte d'utilisateur</h1>
            <p>Nom d'utilisateur :"$username" </p>
            <p>Le role : "$role" </p>
            <p>E-mail : "$mail" </p><button>Changer E-mail</button>
            <br><button><a href="change-password.html">Modifier Mot de passe</a></button>
        </div>
    </div>
    <?php //importer 'contact.html' ?>
</body>
</html>