<?php
require_once '../includes/auth.php';

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

if (isset($_POST['login_user'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($link, $query);


    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                $_SESSION['connecté'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['role'] = 'user';
                $_SESSION['fullname'] = $user['fullname'];
                $_SESSION['user_id'] = $user['id'];
                $success = "Vous êtes connecté en tant que $email, redirection en cours...";
                header('Location: ../pages/user/profile.php');
                exit();
            } else {
                $error = "Mot de passe incorrect";
            }
        } else {
            $error = "Ton compte n'existe pas, sorry :(";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | Flow Media</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        :root {
            --primary-color: #3a791f;
            /* Green from index.css */
            --secondary-color: #8ac571;
            /* Lighter green from index.css */
            --text-color: #333;
            /* Dark text from index.css */
            --light-bg: #f8f9fa;
            /* Light background from index.css */
            --white: #ffffff;
            /* White from index.css */
            --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.1);
            /* Subtle shadow */
            --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.15);
            /* Medium shadow */
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
            /* Light grey background */
            color: var(--text-color);
            /* Default text color */
        }

        video {
            display: none;
            /* Ensure video is hidden */
        }

        .login-container {
            display: flex;
            background: var(--white);
            /* White background for the container */
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            /* Use medium shadow */
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
            /* White background for the form section */
            color: var(--text-color);
        }

        .login-image-section {
            flex: 1;
            background: url('../assets/images/vert.png') center center no-repeat;
            /* Keep the placeholder image for the right side */
            background-size: cover;
            position: relative;
            min-width: 300px;
        }

        h1 {
            font-family: "Poppins", sans-serif;
            font-size: 32px;
            color: var(--text-color);
            /* Dark text color */
            text-align: left;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .login-subtitle {
            font-size: 16px;
            color: #555555;
            /* Slightly lighter dark grey for subtitle */
            margin-bottom: 30px;
            font-weight: 400;
        }


        label {
            color: var(--text-color);
            /* Dark text color for labels */
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
            /* Light grey border */
            border-radius: 4px;
            height: 45px;
            display: flex;
            align-items: center;
            padding: 0 12px;
            background: var(--white);
            /* White background for input container */
            transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            margin-bottom: 15px;
        }

        .inputForm:hover {
            border-color: #aaaaaa;
            /* Darker grey border on hover */
        }

        .inputForm:focus-within {
            border-color: var(--primary-color);
            /* Primary color border on focus */
            box-shadow: 0 0 0 1px rgba(58, 121, 31, 0.3);
            /* Primary color shadow on focus */
        }

        .input {
            margin-left: 8px;
            border: none;
            width: 100%;
            height: 100%;
            background: transparent;
            font-size: 16px;
            color: var(--text-color);
            /* Dark text color */
            outline: none;
        }

        .input::placeholder {
            color: #888888;
            /* Medium grey placeholder */
        }

        .inputForm svg {
            stroke: #555555;
            /* Dark grey icon color */
            width: 18px;
            height: 18px;
        }

        .forgot-password {
            text-align: right;
            margin-top: -10px;
            margin-bottom: 20px;
        }

        .forgot-password a {
            color: #555555;
            /* Dark grey link color */
            font-size: 14px;
            text-decoration: none;
            transition: color 0.2s ease-in-out;
        }

        .forgot-password a:hover {
            color: var(--primary-color);
            /* Primary color on hover */
            text-decoration: underline;
        }


        .button-submit {
            margin-top: 10px;
            background: var(--primary-color);
            /* Primary color background */
            border: 1px solid var(--primary-color);
            /* Primary color border */
            color: var(--white);
            /* White text */
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
            /* Secondary color on hover */
            border-color: var(--secondary-color);
            color: var(--text-color);
            /* Dark text on hover */
        }

        .separator {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 30px 0;
            color: #aaaaaa;
            /* Light grey color for the separator text */
        }

        .separator::before,
        .separator::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #cccccc;
            /* Light grey border line */
        }

        .separator:not(:empty)::before {
            margin-right: .25em;
        }

        .separator:not(:empty)::after {
            margin-left: .25em;
        }

        .p {
            text-align: center;
            color: #555555;
            /* Dark grey text */
            font-size: 14px;
            margin: 12px 0;
        }

        .span a {
            color: var(--primary-color);
            /* Primary color link */
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease-in-out;
        }

        .span a:hover {
            color: var(--secondary-color);
            /* Secondary color on hover */
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
            /* Light red */
            color: #721c24;
            /* Dark red */
            border: 1px solid #f5c6cb;
        }

        .success {
            background-color: #d4edda;
            /* Light green */
            color: #155724;
            /* Dark green */
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
            /* Dark text color */
            transition: color 0.2s ease-in-out;
            z-index: 10;
        }

        .home-btn:hover {
            color: #555555;
            /* Darker grey on hover */
        }

        .home-btn svg {
            stroke: var(--text-color);
            /* Dark icon color */
            transition: stroke 0.2s ease-in-out;
        }

        .home-btn:hover svg {
            stroke: #555555;
            /* Darker grey icon on hover */
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
    <!-- Home button remains -->
    <a href="../index.php" class="home-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
            <polyline points="9 22 9 12 15 12 15 22"></polyline>
        </svg>
    </a>

    <div class="login-container">
        <div class="login-form-section">
            <h1>Vous revoilà !</h1>
            <p class="login-subtitle">Connectez-vous à votre compte Flow Media</p>
            <form method="POST" action="login.php">
                <div class="flex-column">
                    <label>Email</label>
                </div>
                <div class="inputForm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    <input placeholder="m@example.com" class="input" type="text" name="email">
                </div>
                <div class="flex-column">
                    <label>Mot de passe</label>
                </div>
                <div class="inputForm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 32 32" height="20">
                        <g data-name="Layer 3" id="Layer_3">
                            <path d="m30.853 13.87a15 15 0 0 0 -29.729 4.082 15.1 15.1 0 0 0 12.876 12.918 15.6 15.6 0 0 0 2.016.13 14.85 14.85 0 0 0 7.715-2.145 1 1 0 1 0 -1.031-1.711 13.007 13.007 0 1 1 5.458-6.529 2.149 2.149 0 0 1 -4.158-.759v-10.856a1 1 0 0 0 -2 0v1.726a8 8 0 1 0 .2 10.325 4.135 4.135 0 0 0 7.83.274 15.2 15.2 0 0 0 .823-7.455zm-14.853 8.13a6 6 0 1 1 6-6 6.006 6.006 0 0 1 -6 6z"></path>
                        </g>
                    </svg>
                    <input placeholder="*************" class="input" type="password" name="password">
                </div>
                <div class="forgot-password">
                    <a href="#">Mot de passe oublié ?</a>
                </div>


                <button class="button-submit" name="login_user">Se connecter</button>

                <div class="separator"></div>

                <p class="p">Vous n'avez pas de compte ? <span class="span"><a href="register.php">Créer en un</a></span></p>
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
        echo "<div class='message error'>Vous devez être connecté pour accéder à cette page, si vous ne possedez pas de compte, vous pouvez en créer un.</div>";
    }

    if (isset($_GET['erreur']) && $_GET['erreur'] === 'acces_refuse_user') {
        echo "<div class='message error'>Vous n'avez pas les droits pour accéder à cette page, si vous êtes administrateur, vous pouvez vous connecter <a href='login-admin.php'>ici</a></div>";
    }

    if (isset($_GET['message']) && $_GET['message'] === 'deconnexion_user') {
        echo "<div class='message success'>Déconnexion réussie. À bientôt !</div>";
    }

    ?>
</body>

</html>