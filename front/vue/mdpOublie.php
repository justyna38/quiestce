<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion Admin</title>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' type='text/css' media='' />
    <link rel='stylesheet' href='style.css' type='text/css' media='' />
    <style>
        #captchaAnswer {
            width: 5.75rem
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-group">
            <label for="userN">Nouveau mot de passe</label>
            <input name="mdp" type="password" class="form-control" id="mdpSaisi">
        </div>
        <div class="form-group">
            <label for="mdp">Confirmez le mot de passe</label>
            <input name="newMdp" type="password" class="form-control" id="mdpValide">
            <input type="hidden" name="cache" id="login" value=<?php if (isset($_GET['login'])) {
                                                                    echo $_GET['login'];
                                                                } ?>>
        </div>
        <button id="boutonMdp">Changer le mot de passe</button>
    </div>

    <script type='text/javascript' src='https://code.jquery.com/jquery-3.2.1.slim.min.js'></script>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script>
    <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'></script>
    <script src="../controleur/modifieMdp.js"></script>
</body>

</html>