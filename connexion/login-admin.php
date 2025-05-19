<?php session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter en admin</title>
    <link rel="shortcut icon" href="../assets/images/icon/codepair_icon.PNG" type="image/x-icon"></link>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            font-family: "Poppins", sans-serif;
            background-color: #FFFFFF; 
            color: #000000; 
        }

        video {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform: translate(-50%, -50%);
            z-index: -1;
        }

        .form {
            display: flex;
            flex-direction: column;
            gap: 20px;
            background: #FFFFFF;
            padding: 40px;
            width: 450px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #000000;
            z-index: 1;
        }

        h1 {
            font-family: "Poppins", sans-serif;
            font-size: 32px;
            color: #000000;
            text-align: center;
            margin-bottom: 20px;
            font-weight: 500;
        }

        label {
            color: #000000;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .inputForm {
            border: 1px solid #000000;
            border-radius: 4px;
            height: 45px;
            display: flex;
            align-items: center;
            padding-left: 10px;
        }

        .input {
            margin-left: 10px;
            border-radius: 4px;
            border: none;
            width: 100%;
            height: 100%;
        }

        .input:focus {
            outline: none;
        }

        .button-submit {
            background-color: #000000;
            border: none;
            color: #FFFFFF;
            font-size: 16px;
            font-weight: 500;
            border-radius: 4px;
            height: 45px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
        }

        .button-submit:hover {
            background: #FFFFFF;
            color: #000000;
        }

        .p {
            text-align: center;
            color: #000000;
            font-size: 14px;
            margin: 8px 0;
        }

        .span a {
            color: #000000;
            text-decoration: underline;
            font-weight: 500;
            transition: color 0.2s ease-in-out;
        }

        .span a:hover {
            color: #555555;
        }

        .message {
            padding: 12px;
            border-radius: 4px;
            margin: 10px auto;
            text-align: center;
            width: 90%;
            max-width: 450px;
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            animation: fadeOut 5s forwards;
            font-size: 14px;
            z-index: 10;
        }

        .error {
            background-color: #FFFFFF;
            color: #000000;
            border: 1px solid #000000;
        }

        .success {
            background-color: #FFFFFF;
            color: #000000;
            border: 1px solid #000000;
        }

        @keyframes fadeOut {
            0% { opacity: 1; }
            90% { opacity: 1; }
            100% { opacity: 0; display: none; }
        }

        .home-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            color: #000000;
            transition: color 0.2s ease-in-out;
            z-index: 10;
        }

        .home-btn:hover {
            color: #555555;
        }

        .home-btn svg {
            stroke: #000000;
            transition: stroke 0.2s ease-in-out;
        }

        .home-btn:hover svg {
            stroke: #555555;
        }
    </style>
</head>

<body>
    <video autoplay muted loop>
        <source src="../assets/video/canard-vert.mp4" type="video/mp4">
    </video>
    <section>
        <form class="form" method="POST" action="login-admin.php">
        <a href="../index.php" class="home-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
        </a>
            <h1>Se connecter en admin</h1>
            <div class="flex-column">
                <label>Nom d'utilisateur</label>
            </div>
            <div class="inputForm">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <input placeholder="Nom d'utilisateur admin" class="input" type="text" name="admin_username">
            </div>

            <div class="flex-column">
                <label>Mot de passe</label>
            </div>
            <div class="inputForm">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
                <input placeholder="Mot de passe admin" class="input" type="password" name="admin_password">
            </div>

            <button class="button-submit" name="login_admin">Se Connecter</button>
            <p class="p">Vous n'êtes pas administrateur ? <span class="span"><a href="login.php">Connectez vous en tant qu'utilisateur</a></span></p>
        </form>
    </section>

        <?php
    $link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

    if (isset($_POST['login_admin'])) {
        $username = $_POST['admin_username'];
        $password = $_POST['admin_password'];
    
        $query = "SELECT * FROM admin WHERE username='$username'";
        $result = mysqli_query($link, $query);
        
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                if ($password === $user['password']) {  
                    $_SESSION['connecté'] = true;
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = 'admin';
                    $success = "Vous êtes connecté en tant que $username, redirection en cours...";
                    echo "<meta http-equiv='refresh' content='3;url=../admin/dashboard.php'>"; // redirection après 3s vers la page /admin/dashboard
                } else {
                    $error = "Mot de passe incorrect";
                }
            } else {
                $error = "Ton compte n'existe pas, sorry :(";
            }
        }
    }

    if (isset($error)): // si l'erreur existe alors on affiche le message d'erreur
        echo "<div class='message error'>$error</div>";
    endif;

    if (isset($success)): // si le succès existe alors on affiche le message de succès
        echo "<div class='message success'>$success</div>";
    endif;


    if (isset($_GET['erreur']) && $_GET['erreur'] === 'non_connecte') { // ici on vérifie si l'url contient login-admin.php OU /admin
    $chemin = $_SERVER['REQUEST_URI'];

    if (strpos($chemin, 'login-admin.php') !== false || strpos($chemin, '/admin') !== false) { // si la page actuelle est login-admin.php OU si on vient de /admin
        echo "<div class='message error'>Vous devez obligatoirement être connecté en tant qu'admin pour accéder à cette page</div>";
    } 
}
    // gestion de la deconnexion 
    if (isset($_GET['message']) && $_GET['message'] === 'deconnexion_admin') {
        echo "<div class='message success'>Déconnexion réussie. À bientôt !</div>";
    }

    ?>
</body>
</html>