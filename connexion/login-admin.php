<?php session_start();

if (isset($_SESSION['connecté']) && $_SESSION['connecté'] === true && $_SESSION['role'] === 'admin') {
    header('Location: ../admin/dashboard.php');
    exit();
}

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
                header('Location: ../admin/dashboard.php');
                exit();
            } else {
                $error = "Mot de passe incorrect";
            }
        } else {
            $error = "Nom d'utilisateur inconnu";
        }
    } else {
        $error = "Erreur de base de données";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter en admin</title>
    <link rel="shortcut icon" href="../../assets/icons/logo.png" type="image/x-icon">
    </link>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        :root {
            --primary-color: #3a791f;
            --secondary-color: #8ac571;
            --text-color: #333;
            --light-bg: #f8f9fa;
            --white: #ffffff;
            --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            font-family: "Poppins", sans-serif;
            background-color: #f0f0f0;
            color: var(--text-color);
        }

        video {
            display: none;
        }

        .login-container {
            display: flex;
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
            max-width: 900px;
            width: 90%;
            min-height: 500px;
        }

        .login-form-section {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: var(--white);
            color: var(--text-color);
        }

        .login-image-section {
            flex: 1;
            background: url('../assets/images/vert.png') center center no-repeat;
            background-size: cover;
            position: relative;
            min-width: 300px;
        }

        h1 {
            font-family: "Poppins", sans-serif;
            font-size: 32px;
            color: var(--text-color);
            text-align: left;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .login-subtitle {
            font-size: 16px;
            color: #555555;
            margin-bottom: 30px;
            font-weight: 400;
        }


        label {
            color: var(--text-color);
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .flex-column {
            display: flex;
            flex-direction: column;
        }

        .inputForm {
            border: 1px solid #cccccc;
            border-radius: 4px;
            height: 45px;
            display: flex;
            align-items: center;
            padding: 0 12px;
            background: var(--white);
            transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            margin-bottom: 15px;
        }

        .inputForm:hover {
            border-color: #aaaaaa;
        }

        .inputForm:focus-within {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 1px rgba(58, 121, 31, 0.3);
        }

        .input {
            margin-left: 8px;
            border: none;
            width: 100%;
            height: 100%;
            background: transparent;
            font-size: 16px;
            color: var(--text-color);
            outline: none;
        }

        .input::placeholder {
            color: #888888;
        }

        .inputForm svg {
            stroke: #555555;
            width: 18px;
            height: 18px;
        }

        .button-submit {
            margin-top: 10px;
            background: var(--primary-color);
            border: 1px solid var(--primary-color);
            color: var(--white);
            font-size: 16px;
            font-weight: 600;
            border-radius: 4px;
            height: 45px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
        }

        .button-submit:hover {
            background: var(--secondary-color);
            border-color: var(--secondary-color);
            color: var(--text-color);
        }

        .p {
            text-align: center;
            color: #555555;
            font-size: 14px;
            margin: 12px 0;
        }

        .span a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease-in-out;
        }

        .span a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        .message {
            padding: 12px;
            border-radius: 4px;
            margin: 10px auto;
            text-align: center;
            width: 90%;
            max-width: 400px;
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            animation: fadeOut 5s forwards;
            font-size: 14px;
            z-index: 10;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                display: none;
            }
        }

        .home-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            color: var(--text-color);
            transition: color 0.2s ease-in-out;
            z-index: 10;
        }

        .home-btn:hover {
            color: #555555;
        }

        .home-btn svg {
            stroke: var(--text-color);
            transition: stroke 0.2s ease-in-out;
        }

        .home-btn:hover svg {
            stroke: #555555;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                width: 95%;
                max-width: 450px;
                min-height: auto;
            }

            .login-image-section {
                display: none;
            }

            .login-form-section {
                padding: 30px;
            }

            h1 {
                font-size: 28px;
                text-align: center;
            }

            .login-subtitle {
                font-size: 14px;
                text-align: center;
                margin-bottom: 20px;
            }

            .message {
                width: 80%;
            }
        }
    </style>
</head>

<body>
    <a href="../index.php" class="home-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
            <polyline points="9 22 9 12 15 12 15 22"></polyline>
        </svg>
    </a>

    <div class="login-container">
        <div class="login-form-section">
            <h1>Connexion administrateur</h1>
            <p class="login-subtitle">Accédez à votre panneau d'administration</p>
            <form method="POST" action="login-admin.php">
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
        </div>
        <div class="login-image-section">
            <!-- This div serves as the right column with the background image -->
        </div>
    </div>

    <?php

    if (isset($error)):
        echo "<div class='message error'>$error</div>";
    endif;

    if (isset($success)):
        echo "<div class='message success'>$success</div>";
    endif;


    if (isset($_GET['erreur']) && $_GET['erreur'] === 'non_connecte') {
        $chemin = $_SERVER['REQUEST_URI'];

        if (strpos($chemin, 'login-admin.php') !== false || strpos($chemin, '/admin') !== false) {
            echo "<div class='message error'>Vous devez obligatoirement être connecté en tant qu'admin pour accéder à cette page</div>";
        }
    }
    if (isset($_GET['message']) && $_GET['message'] === 'deconnexion_admin') {
        echo "<div class='message success'>Déconnexion réussie. À bientôt !</div>";
    }

    ?>
</body>

</html>