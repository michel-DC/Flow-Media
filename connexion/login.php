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

        .social-login {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .social-icon {
            background: var(--light-bg);
            /* Light background */
            border: 1px solid #cccccc;
            /* Light grey border */
            border-radius: 4px;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out;
        }

        .social-icon:hover {
            background: #e0e0e0;
            /* Slightly darker light grey on hover */
            border-color: #aaaaaa;
            /* Darker grey border on hover */
        }

        .social-icon svg {
            width: 20px;
            height: 20px;
            fill: #555555;
            /* Dark grey icons */
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

                <div class="separator">Ou continuer avec</div>

                <div class="social-login">
                    <div class="social-icon">
                        <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="#555">
                            <path d="M152.9 512c-29.42 0-57.51-12.12-77.23-33.57-22.77-24.29-35.62-56.33-35.62-92.58 0-40.08 13.49-74.47 40.75-98.33 26-22.71 59.12-35 94.82-35.49V0h128a8 8 0 018 8v40h-85.79c-23.23 0-37.45 11.51-37.45 34.91v10.57h85.8a8 8 0 018 8v40a8 8 0 01-8 8h-85.8v13.4c0 24.12 14.65 36.4 40.57 36.4 10.65 0 18.6-.34 24.77-1V288a8 8 0 018 8v40a8 8 0 01-8 8h-27.54c-12.27 20.63-22.59 37.24-22.59 58.88 0 25.8 11.25 40.43 35.34 40.43 10.68 0 21.6-2.08 32.45-6.2l-9.38 40.23c-15.15 5.85-31.74 9.08-48.77 9.08zM478.44 0h-71.65a8 8 0 00-8 8v40a8 8 0 008 8h32.89a8 8 0 018 8v22.11a8 8 0 008 8h40a8 8 0 008-8V64a8 8 0 018-8h32.89a8 8 0 008-8V8a8 8 0 00-8-8z"></path>
                        </svg>
                    </div>
                    <div class="social-icon">
                        <svg fill="#555" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <g id="Google" stroke-width="0">
                                <path d="M12.0003 4.16666C14.0206 4.16666 15.6943 4.85913 16.9648 6.07166L20.0302 3.0062C18.0762 1.14494 15.3143 0 12.0003 0C7.31249 0 3.23615 2.66842 1.31693 6.54517L5.38258 9.72488C6.22003 7.14762 8.80307 5.33332 12.0003 5.33332C13.5362 5.33332 14.8533 5.77627 15.9306 6.61796L12.0003 10.5483L15.9306 14.4786C14.8533 15.3203 13.5362 15.7632 12.0003 15.7632C8.80307 15.7632 6.22003 13.949 5.38258 11.3717L1.31693 14.5514C3.23615 18.4281 7.31249 21.0966 12.0003 21.0966C15.3143 21.0966 18.0762 19.9517 20.0302 18.0899L16.9648 15.0245C15.6943 13.812 14.0206 13.1195 12.0003 13.1195C8.80307 13.1195 6.22003 14.9338 5.38258 17.511L1.31693 14.5514Z" fill="#555"></path>
                            </g>
                        </svg>
                    </div>
                    <div class="social-icon">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#555">
                            <path d="M12 2.039c-5.45 0-9.91 4.28-9.91 9.553 0 4.354 2.79 8.073 6.72 9.469 0.499 0.092 0.682-0.215 0.682-0.477 0-0.237-0.008-0.869-0.013-1.705-2.705 0.584-3.273-1.307-3.273-1.307-0.442-1.116-1.08-1.413-1.08-1.413-0.886-0.604 0.066-0.593 0.066-0.593 0.981 0.07 1.495 1.007 1.495 1.007 0.871 1.487 2.284 1.058 2.837 0.807 0.087-0.627 0.342-1.058 0.622-1.303-2.176-0.248-4.462-1.088-4.462-4.831 0-1.066 0.377-1.936 1.006-2.614-0.1-0.248-0.436-1.238 0.095-2.575 0 0 0.82-0.262 2.705 1.001 0.783-0.217 1.626-0.325 2.462-0.329 0.836 0.004 1.68 0.112 2.462 0.329 1.884-1.263 2.702-1.001 2.702-1.001 0.533 1.337 0.2 2.327 0.096 2.575 0.63 0.678 1.004 1.548 1.004 2.614 0 3.752-2.289 4.58-4.468 4.823 0.355 0.308 0.677 0.916 0.677 1.849 0 1.334-0.013 2.415-0.013 2.74-2.13e-05 0.266 0.183 0.574 0.688 0.476c3.921-1.399 6.711-5.12 6.711-9.466 0-5.273-4.46-9.554-9.91-9.554z"></path>
                        </svg>
                    </div>
                </div>


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