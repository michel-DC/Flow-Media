<?php
require_once '../includes/auth.php';

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");


if (isset($_POST['register_user'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if ($_POST['password'] != $_POST['password_confirm']) {
        $error_password = "Les mots de passe ne correspondent pas, veuillez réessayer";
    } else {

        $check_email_query = "SELECT id FROM users WHERE email='$email'";
        $check_email_result = mysqli_query($link, $check_email_query);

        if (mysqli_num_rows($check_email_result) > 0) {
            $error = "Cet email est déjà utilisé, veuillez en choisir un autre.";
        } else {
            $query = "INSERT INTO users (fullname, email, password, abonnement_id) VALUES ('$fullname', '$email', '$password', 1)";

            if (mysqli_query($link, $query)) {
                $success = "Félicitations $fullname, votre compte a bien été créé :), vous pouvez maintenant vous connecter";
            } else {
                $error = "Malheureusement, il y a une erreur lors de l'inscription, veuillez réessayer";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte | Flow Media</title>
    <link rel="shortcut icon" href="../../assets/icons/logo.png" type="image/x-icon">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        :root {
            --primary-color-red: #e53e3e;
            /* Red color */
            --secondary-color-red: #fc8181;
            /* Lighter red */
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

        .register-container {
            display: flex;
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
            max-width: 900px;
            width: 90%;
            min-height: 500px;
        }

        .register-image-section {
            flex: 1;
            background: url('../assets/images/rouge.png') center center no-repeat;
            /* Placeholder image for the left side (red related) */
            background-size: cover;
            position: relative;
            min-width: 300px;
        }


        .register-form-section {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: var(--white);
            color: var(--text-color);
        }


        h1 {
            font-family: "Poppins", sans-serif;
            font-size: 32px;
            color: var(--text-color);
            text-align: left;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .register-subtitle {
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
            border-color: var(--primary-color-red);
            /* Red border on focus */
            box-shadow: 0 0 0 1px rgba(229, 62, 62, 0.3);
            /* Red shadow on focus */
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
            fill: none;
            /* Ensure fill is none if using stroke */
        }

        .button-submit {
            margin-top: 10px;
            background: var(--primary-color-red);
            /* Red background */
            border: 1px solid var(--primary-color-red);
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
            background: var(--secondary-color-red);
            /* Lighter red on hover */
            border-color: var(--secondary-color-red);
            color: var(--text-color);
        }

        .p {
            text-align: center;
            color: #555555;
            font-size: 14px;
            margin: 12px 0;
        }

        .span a {
            color: var(--primary-color-red);
            /* Red link */
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease-in-out;
        }

        .span a:hover {
            color: var(--secondary-color-red);
            /* Lighter red on hover */
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
            /* Light green (keep success green) */
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
            .register-container {
                flex-direction: column;
                width: 95%;
                max-width: 450px;
                min-height: auto;
            }

            .register-image-section {
                display: none;
            }

            .register-form-section {
                padding: 30px;
            }

            h1 {
                font-size: 28px;
                text-align: center;
            }

            .register-subtitle {
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

    <div class="register-container">
        <div class="register-image-section">
            <!-- This div serves as the left column with the background image -->
        </div>
        <div class="register-form-section">
            <h1>Bienvenue parmis nous</h1>
            <p class="register-subtitle">Créez votre compte Flow Media</p>
            <form method="POST" action="register.php">
                <div class="flex-column">
                    <label>Nom et Prénom </label>
                </div>
                <div class="inputForm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 24" height="20">
                        <path d="M12 4a4 4 0 0 1 4 4 4 4 0 0 1-4 4 4 4 0 0 1-4-4 4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4z"></path>
                    </svg>
                    <input placeholder="Entrez votre nom et prénom" class="input" type="text" name="fullname" required>
                </div>

                <div class="flex-column">
                    <label>Email </label>
                </div>
                <div class="inputForm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 32 32" height="20">
                        <g data-name="Layer 3" id="Layer_3">
                            <path d="m30.853 13.87a15 15 0 0 0 -29.729 4.082 15.1 15.1 0 0 0 12.876 12.918 15.6 15.6 0 0 0 2.016.13 14.85 14.85 0 0 0 7.715-2.145 1 1 0 1 0 -1.031-1.711 13.007 13.007 0 1 1 5.458-6.529 2.149 2.149 0 0 1 -4.158-.759v-10.856a1 1 0 0 0 -2 0v1.726a8 8 0 1 0 .2 10.325 4.135 4.135 0 0 0 7.83.274 15.2 15.2 0 0 0 .823-7.455zm-14.853 8.13a6 6 0 1 1 6-6 6.006 6.006 0 0 1 -6 6z"></path>
                        </g>
                    </svg>
                    <input placeholder="Entrez votre Email" class="input" type="email" name="email" required>
                </div>

                <div class="flex-column">
                    <label>Mot de passe </label>
                </div>
                <div class="inputForm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="-64 0 512 512" height="20">
                        <path d="m336 512h-288c-26.453125 0-48-21.523438-48-48v-224c0-26.476562 21.546875-48 48-48h288c26.453125 0 48 21.523438 48 48v224c0 26.476562-21.546875 48-48 48zm-288-288c-8.8125 0-16 7.167969-16 16v224c0 8.832031 7.1875 16 16 16h288c8.8125 0 16-7.167969 16-16v-224c0-8.832031-7.1875-16-16-16zm0 0"></path>
                        <path d="m304 224c-8.832031 0-16-7.167969-16-16v-80c0-52.929688-43.070312-96-96-96s-96 43.070312-96 96v80c0 8.832031-7.167969 16-16 16s-16-7.167969-16-16v-80c0-70.59375 57.40625-128 128-128s128 57.40625 128 128v80c0 8.832031-7.167969 16-16 16zm0 0"></path>
                    </svg>
                    <input placeholder="Mot de passe" class="input" type="password" name="password" required>
                </div>
                <div class="flex-column">
                    <label>Confirmez votre Mot de passe </label>
                </div>
                <div class="inputForm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="-64 0 512 512" height="20">
                        <path d="m336 512h-288c-26.453125 0-48-21.523438-48-48v-224c0-26.476562 21.546875-48 48-48h288c26.453125 0 48 21.523438 48 48v224c0 26.476562-21.546875 48-48 48zm-288-288c-8.8125 0-16 7.167969-16 16v224c0 8.832031 7.1875 16 16 16h288c8.8125 0 16-7.167969 16-16v-224c0-8.832031-7.1875-16-16-16zm0 0"></path>
                        <path d="m304 224c-8.832031 0-16-7.167969-16-16v-80c0-52.929688-43.070312-96-96-96s-96 43.070312-96 96v80c0 8.832031-7.167969 16-16 16s-16-7.167969-16-16v-80c0-70.59375 57.40625-128 128-128s128 57.40625 128 128v80c0 8.832031-7.167969 16-16 16zm0 0"></path>
                    </svg>
                    <input placeholder="Mot de passe" class="input" type="password" name="password_confirm" required>
                </div>

                <button class="button-submit" name="register_user">S'inscrire</button>
                <p class="p">Vous avez déjà un compte ?<span class="span"><a href="login.php">Se connecter</a></span></p>
            </form>
        </div>
    </div>

    <?php
    if (isset($error_password)):
        echo "<div class='message error'>$error_password</div>";
    endif;

    if (isset($error)):
        echo "<div class='message error'>$error</div>";
    endif;

    if (isset($success)):
        echo "<div class='message success'>$success</div>";
    endif;

    if (isset($_GET['erreur']) && $_GET['erreur'] === 'deja_connecte_user') {
        echo "<div class='message error'>Vous êtes déjà connecté, si vous voulez changer de compte, déconnectez-vous d'abord</div>";
    }
    ?>
</body>

</html>