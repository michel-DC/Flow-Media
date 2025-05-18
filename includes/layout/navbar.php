<nav class="navbar">
        <div class="logo">
            <svg width="20px" height="20px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M16 8C16 12.4183 12.4183 16 8 16C3.58172 16 0 12.4183 0 8C0 3.58172 3.58172 0 8 0C12.4183 0 16 3.58172 16 8ZM9.25 3.75C9.25 4.44036 8.69036 5 8 5C7.30964 5 6.75 4.44036 6.75 3.75C6.75 3.05964 7.30964 2.5 8 2.5C8.69036 2.5 9.25 3.05964 9.25 3.75ZM12 8H9.41901L11.2047 13H9.081L8 9.97321L6.91901 13H4.79528L6.581 8H4V6H12V8Z" fill="#000000"/>
            </svg>
        </div>
        <div class="nav-links">
            <a href="../../index.php" style="display: flex; align-items: center;"><i class="fas fa-home"></i></a>
            
            <div class="nav-dropdown">
                <button class="nav-dropbtn">Découvrir <i class="fa fa-caret-down"></i></button>
                <div class="nav-dropdown-content">
                    <a href="/pages/about"><i class="fas fa-question-circle"></i> Qui sommes-nous</a>
                    <a href="/pages/domaines-culturels"><i class="fas fa-landmark"></i> Domaines culturels</a>
                    <a href="/pages/partenaires"><i class="fas fa-handshake"></i> Partenaires</a>
                    <a href="/pages/contact"><i class="fas fa-envelope"></i> Nous contacter</a>
                </div>
            </div>
            
            <div class="nav-dropdown">
                <button class="nav-dropbtn">Expériences <i class="fa fa-caret-down"></i></button>
                <div class="nav-dropdown-content">
                    <a href="/pages/agenda"><i class="fas fa-calendar-alt"></i> Agenda</a>
                    <a href="/pages/activites"><i class="fas fa-landmark"></i> Activités</a>
                    <a href="/pages/podcast"><i class="fas fa-podcast"></i> Podcasts & interview</a>
                    <a href="/pages/temoignages"><i class="fas fa-comment-alt"></i> Témoignages & Avis</a>
                </div>
            </div>
            
            <?php if (isset($_SESSION['connecté']) && $_SESSION['connecté'] === true && $_SESSION['role'] == 'user'): ?>
            <div class="nav-dropdown">
                <button class="nav-dropbtn"><i class="fas fa-user-alt"></i> <i class="fa fa-caret-down"></i></button>
                <div class="nav-dropdown-content">
                    <a href="../../pages/user/profile.php">Mon profil</a>
                    <a href="../../pages/reservations">Mes réservations</a>
                    <a href="/connexion/logout-user.php"><i class="fas fa-sign-out-alt"></i> Me deconnecter</a>
                </div>
            </div>
            <?php endif; ?>

            <?php if (!isset($_SESSION['connecté']) || $_SESSION['connecté'] !== true): ?>
                <div class="nav-dropdown">
                <button class="nav-dropbtn"><i class="fas fa-user-alt"></i> <i class="fa fa-caret-down"></i></button>
                <div class="nav-dropdown-content">
                    <a href="/connexion/login.php">Me connecter</a>
                    <a href="/connexion/register.php">M'inscrire</a>
                </div>
            </div>
            <?php endif; ?>
        </div>
        
        <style>
            .nav-dropdown {
                position: relative;
                display: inline-block;
            }
            
            .nav-dropbtn {
                background-color: transparent;
                color: var(--soft-black);
                padding: 12px 16px;
                font-size: inherit;
                font-family: inherit;
                border: none;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 5px;
            }
            
            .nav-dropdown-content {
                display: none;
                position: absolute;
                background-color: var(--white);
                min-width: 200px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
                border-radius: 4px;
                right: 0;
            }
            
            .nav-dropdown-content a {
                color: var(--soft-black);
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
            
            .nav-dropdown:hover .nav-dropbtn {
                opacity: 0.8;
            }
        </style>
    </nav>

<style>
    .navbar {
            position: sticky;
            top: 0;
            background: var(--white);
            padding: 0.50rem 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .nav-links {
            display: flex;
            gap: 1.5rem;
        }
        
        .nav-links a {
            color: var(--soft-black);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .nav-links a:hover {
            opacity: 0.8;
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 1rem;
            }
            
            .nav-links {
                margin-top: 1rem;
                flex-wrap: wrap;
                justify-content: center;
            }
        }
</style>