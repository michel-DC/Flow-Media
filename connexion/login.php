<?php
session_start();

if (isset($_SESSION['connecté']) && $_SESSION['connecté'] === true && $_SESSION['role'] === 'user') {
    header('Location: ../pages/user/profile.php?erreur=deja_connecte_user');
    exit();
}

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
                header('Location: ../pages/activites');
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
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap');

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            font-family: "Space Grotesk", sans-serif;
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
            background: #FFFFFF; /* White background */
            padding: 40px;
            width: 450px;
            border-radius: 8px; /* Minimal border radius */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle black shadow */
            border: 1px solid #000000; /* Black border */
            z-index: 1; /* Ensure form is above video */
        }

        h1 {
            font-family: "Space Grotesk", sans-serif; /* Use Space Grotesk */
            font-size: 32px; /* Adjusted size */
            color: #000000; /* Black color */
            text-align: center;
            margin-bottom: 20px;
            font-weight: 500; /* Adjusted weight */
        }

        label {
            color: #000000; /* Black color for labels */
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .flex-column {
            display: flex;
            flex-direction: column;
        }

        .inputForm {
            border: 1px solid #000000; /* Black border */
            border-radius: 4px; /* Minimal border radius */
            height: 45px; /* Adjusted height */
            display: flex;
            align-items: center;
            padding: 0 12px; /* Adjusted padding */
            background: #FFFFFF; /* White background */
            transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .inputForm:hover {
            border-color: #000000; /* Keep black border on hover */
        }

        .inputForm:focus-within {
            border-color: #000000; /* Keep black border on focus */
            box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.5); /* Subtle black shadow on focus */
        }

        .input {
            margin-left: 8px; /* Adjusted margin */
            border: none;
            width: 100%;
            height: 100%;
            background: transparent;
            font-size: 16px;
            color: #000000; /* Black text color */
            outline: none; /* Remove default outline */
        }

        .input::placeholder {
            color: #888888; /* Dark grey placeholder */
        }

        .inputForm svg {
             stroke: #000000; /* Black icon color */
        }


        .button-submit {
            margin-top: 20px; /* Adjusted margin */
            background: #000000; /* Black background */
            border: 1px solid #000000; /* Black border */
            color: #FFFFFF; /* White text */
            font-size: 16px;
            font-weight: 500;
            border-radius: 4px; /* Minimal border radius */
            height: 45px; /* Adjusted height */
            width: 100%;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
        }

        .button-submit:hover {
            background: #FFFFFF; /* White background on hover */
            color: #000000; /* Black text on hover */
        }

        .p {
            text-align: center;
            color: #000000; /* Black text */
            font-size: 14px;
            margin: 8px 0; /* Adjusted margin */
        }

        .span a {
            color: #000000; /* Black link color */
            text-decoration: underline; /* Underline links */
            font-weight: 500;
            transition: color 0.2s ease-in-out;
        }

        .span a:hover {
            color: #555555; /* Darker grey on hover */
        }

        .message {
            padding: 12px; /* Adjusted padding */
            border-radius: 4px; /* Minimal border radius */
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
            z-index: 10; /* Ensure messages are on top */
        }

        .error {
            background-color: #FFFFFF; /* White background */
            color: #000000; /* Black text */
            border: 1px solid #000000; /* Black border */
        }

        .success {
            background-color: #FFFFFF; /* White background */
            color: #000000; /* Black text */
            border: 1px solid #000000; /* Black border */
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
            color: #000000; /* Black color */
            transition: color 0.2s ease-in-out;
            z-index: 10; /* Ensure button is on top */
        }

        .home-btn:hover {
            color: #555555; /* Darker grey on hover */
        }

         .home-btn svg {
            stroke: #000000; /* Black icon color */
            transition: stroke 0.2s ease-in-out;
         }

         .home-btn:hover svg {
            stroke: #555555; /* Darker grey icon on hover */
         }

    </style>
</head>
<body>
    <video autoplay muted loop>
        <source src="../assets/video/canard-vert.mp4" type="video/mp4">
    </video>
    <section>
        <form class="form" method="POST" action="login.php">
        <a href="../index.php" class="home-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
        </a>
            <h1>Vous reoilà !</h1>
            <div class="flex-column">
                <label>Votre email </label>
            </div>
            <div class="inputForm">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
                <input placeholder="email@email.com" class="input" type="text" name="email">
            </div>
            <div class="flex-column">
                <label>Mot de passe </label>
            </div>
            <div class="inputForm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 32 32" height="20">
                    <g data-name="Layer 3" id="Layer_3">
                        <path d="m30.853 13.87a15 15 0 0 0 -29.729 4.082 15.1 15.1 0 0 0 12.876 12.918 15.6 15.6 0 0 0 2.016.13 14.85 14.85 0 0 0 7.715-2.145 1 1 0 1 0 -1.031-1.711 13.007 13.007 0 1 1 5.458-6.529 2.149 2.149 0 0 1 -4.158-.759v-10.856a1 1 0 0 0 -2 0v1.726a8 8 0 1 0 .2 10.325 4.135 4.135 0 0 0 7.83.274 15.2 15.2 0 0 0 .823-7.455zm-14.853 8.13a6 6 0 1 1 6-6 6.006 6.006 0 0 1 -6 6z"></path>
                    </g>
                </svg>
                <input placeholder="*************" class="input" type="password" name="password">
            </div>

            <!-- Removed "Confirmez votre mot de passe" as it's a login form -->
            <!--
            <div class="flex-column">
                <label>Confirmez votre mot de passe </label>
            </div>
            <div class="inputForm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="-64 0 512 512" height="20">
                    <path d="m336 512h-288c-26.453125 0-48-21.523438-48-48v-224c0-26.476562 21.546875-48 48-48h288c26.453125 0 48 21.523438 48 48v224c0 26.476562-21.546875 48-48 48zm-288-288c-8.8125 0-16 7.167969-16 16v224c0 8.832031 7.1875 16 16 16h288c8.8125 0 16-7.167969 16-16v-224c0-8.832031-7.1875-16-16-16zm0 0"></path>
                    <path d="m304 224c-8.832031 0-16-7.167969-16-16v-80c0-52.929688-43.070312-96-96-96s-96 43.070312-96 96v80c0 8.832031-7.167969 16-16 16s-16-7.167969-16-16v-80c0-70.59375 57.40625-128 128-128s128 57.40625 128 128v80c0 8.832031-7.167969 16-16 16zm0 0"></path>
                </svg>
                <input placeholder="*************" class="input" type="password" name="password_confirm">
            </div>
            -->

            <button class="button-submit" name="login_user">Se Connecter</button>
            <p class="p">Vous n'avez pas de compte <span class="span"><a href="register.php">Créer en un</a></span></p>
            <p class="p">Vous êtes administrateur ? <span class="span"><a href="login-admin.php">Connectez vous en tant que administrateur</a></span></p>
        </form>
    </section>

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