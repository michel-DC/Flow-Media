<?php
$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT photo_profil FROM users WHERE id='$user_id'";
    $result = mysqli_query($link, $query);
    $photo_profil = mysqli_fetch_assoc($result);
    $avatar = str_replace('.svg', '', $photo_profil['photo_profil']);
}
?>

<header class="header">
    <nav class="navigation">
        <div class="nav-brand">
            <div class="nav-item home-nav">
                <a href="../../index.php">
                    <svg class="home-icon" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                    </svg>
                </a>
            </div>
            <button class="nav-toggle" aria-label="Toggle navigation">
                <span class="hamburger"></span>
            </button>
        </div>

        <div class="nav-menu">
            <div class="nav-dropdown">
                <div class="nav-item">
                    <a class="nav-dropbtn">A propos <i class="fa fa-caret-down"></i></a>
                </div>
                <div class="nav-dropdown-content">
                    <a href="/pages/about"><i class="fas fa-info-circle"></i> L'AMF</a>
                    <a href="/pages/partenaires"><i class="fas fa-handshake"></i> Nos partenaires</a>
                    <a href="/pages/contact"><i class="fas fa-envelope"></i> Nous contacter</a>
                </div>
            </div>

            <div class="nav-dropdown">
                <div class="nav-item">
                    <a class="nav-dropbtn">Découvrir <i class="fa fa-caret-down"></i></a>
                </div>
                <div class="nav-dropdown-content">
                    <a href="/pages/agenda"><i class="fas fa-calendar-alt"></i> Agenda culturel</a>
                    <a href="/pages/fun-fact"><i class="fas fa-lightbulb"></i> Fun Facts</a>
                    <a href="/pages/activites"><i class="fas fa-running"></i> Activités</a>
                    <a href="/pages/podcast"><i class="fas fa-podcast"></i> Podcasts</a>
                </div>
            </div>

            <div class="nav-item"><a href="/pages/maps">Maps</a></div>

            <?php if (!isset($_SESSION['connecté']) || $_SESSION['connecté'] !== true): ?>
                <div class="nav-item"><a href="connexion/login.php">Connexion</a></div>
            <?php endif; ?>

            <?php if (isset($_SESSION['connecté']) && $_SESSION['connecté'] === true && $_SESSION['role'] == 'user'): ?>
                <div class="nav-dropdown">
                    <button class="nav-dropbtn">
                        <?php if (!empty($avatar) && ($avatar == 'jardi' || $avatar == 'archi')): ?>
                            <img src="../../assets/images/mascottes/<?php echo $avatar; ?>.svg" alt="<?php echo ucfirst($avatar); ?>">
                        <?php else: ?>
                            <img src="../../assets/images/mascottes/jardi.svg" alt="Jardi">
                        <?php endif; ?>
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="nav-dropdown-content">
                        <a href="../../pages/user/me.php">Mon profil</a>
                        <a href="../../pages/reservations">Mes réservations</a>
                        <a href="/connexion/logout-user.php"><i class="fas fa-sign-out-alt"></i> Me deconnecter</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </nav>
</header>

<style>
    .header {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        z-index: 100;
        padding: 20px;
    }

    .navigation {
        display: flex;
        align-items: center;
        justify-content: space-between;
        max-width: 1400px;
        margin: 0 auto;
        width: 100%;
    }

    .nav-brand {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .nav-toggle {
        display: none;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0.5rem;
    }

    .hamburger {
        display: block;
        position: relative;
        width: 24px;
        height: 2px;
        background: white;
        transition: all 0.3s ease-in-out;
    }

    .hamburger::before,
    .hamburger::after {
        content: '';
        position: absolute;
        width: 24px;
        height: 2px;
        background: white;
        transition: all 0.3s ease-in-out;
    }

    .hamburger::before {
        transform: translateY(-8px);
    }

    .hamburger::after {
        transform: translateY(8px);
    }

    .nav-menu {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .nav-item {
        color: white;
        font-size: 20px;
        font-weight: 500;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 8px 16px;
        border-radius: 8px;
    }

    .nav-item a {
        color: white;
        text-decoration: none;
    }

    .nav-item:hover {
        background-color: rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
    }

    .nav-dropdown {
        position: relative;
    }

    .nav-dropdown-content {
        display: none;
        position: absolute;
        background-color: #ffffff;
        min-width: 200px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
        border-radius: 4px;
        right: 0;
    }

    .nav-dropbtn {
        background-color: transparent;
        color: white;
        padding: 12px 16px;
        font-size: inherit;
        font-family: inherit;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .nav-dropbtn img {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        object-fit: cover;
    }

    .nav-dropdown-content a {
        color: #000000;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
        transition: background-color 0.3s ease;
    }

    .nav-dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    .nav-dropdown:hover .nav-dropdown-content {
        display: block;
    }

    @media (max-width: 768px) {
        .header {
            padding: 15px;
        }

        .nav-toggle {
            display: block;
        }

        .nav-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.9);
            padding: 1rem;
            flex-direction: column;
            align-items: flex-start;
        }

        .nav-menu.active {
            display: flex;
        }

        .nav-dropdown-content {
            position: static;
            background-color: transparent;
            box-shadow: none;
            width: 100%;
        }

        .nav-dropdown-content a {
            color: white;
            padding: 8px 16px;
        }

        .nav-dropdown-content a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-item {
            width: 100%;
        }

        .nav-dropbtn {
            width: 100%;
            justify-content: space-between;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navToggle = document.querySelector('.nav-toggle');
        const navMenu = document.querySelector('.nav-menu');
        const hamburger = document.querySelector('.hamburger');

        navToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            hamburger.classList.toggle('active');
        });

        // Fermer le menu quand on clique en dehors
        document.addEventListener('click', function(event) {
            if (!navToggle.contains(event.target) && !navMenu.contains(event.target)) {
                navMenu.classList.remove('active');
                hamburger.classList.remove('active');
            }
        });

        // Gérer le redimensionnement de la fenêtre
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                navMenu.classList.remove('active');
                hamburger.classList.remove('active');
            }
        });
    });
</script>