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
        <form method="post" action="../../back/controleur/verificationCapchat.php" class="mt-5 col-md-6 mx-md-auto">
            <div class="form-group">
                <label for="userN">Login</label>
                <input name="userName" type="text" class="form-control" id="nameFirst">
            </div>
            <div class="form-group">
                <label for="mdp">Mot de passe</label>
                <input name="mdp" type="password" class="form-control" id="nameLast">
            </div>
            <div class="form-inline mb-sm-3">
                <div class="form-group">
                    <img src="../../back/controleur/captcha.php" id="captchaImage" alt="Captcha Image">
                </div>
                <div class="form-group">
                    <label for="captchaAnswer" class="sr-only">Captcha Answer</label>
                    <input type="text" class="form-control text-center" id="captchaAnswer" name="check">
                </div>
            </div>
            <button type="submit" name="submit" value="submit" class="btn btn-primary">Valider</button>

        </form>

        <div class="container mt-5 col-md-6 mx-md-auto">
            <button class="btn btn-danger" onclick="mdpOublie()"> Mot de passe oublié</button>
            <button onclick="quitter()">Annuler</button>

        </div>
        <div class="erreur"><span><?php if (isset($_GET['erreur'])) {
                                        echo $_GET['erreur'];
                                    } ?></span></div>
        <script type='text/javascript' src='https://code.jquery.com/jquery-3.2.1.slim.min.js'></script>
        <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script>
        <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'></script>
        <script type='text/javascript'>
            function mdpOublie() {
                const login = document.getElementById("nameFirst");
                const url = "mdpOublie.php" + "?login=" + login.value;
                document.location.href = url;
            }

            function quitter() {
                document.location.href = ('../../front/index.html');
            }
        </script>
</body>

</html>