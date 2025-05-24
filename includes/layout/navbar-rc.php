<?php
$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT photo_profil FROM users WHERE id='$user_id'";
    $result = mysqli_query($link, $query);
    $photo_profil = mysqli_fetch_assoc($result);
    $user = $photo_profil;
}
?>

            <header class="header">
                <nav class="navigation">
                    <div class="nav-item home-nav">
                        <a href="../../home.php">
                        <svg class="home-icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                        </svg>
                        </a>
                    </div> 

            <div class="nav-dropdown">
                    <div class="nav-item">
                        <a class="nav-dropbtn">A propos <i class="fa fa-caret-down"></i></a>
                    </div>
                <div class="nav-dropdown-content">
                    <a href="/pages/about"><i class="fas fa-info-circle"></i> FlowMedia</a>
                    <a href="/pages/partenaires"><i class="fas fa-handshake"></i> Nos partenaires</a>
                    <a href="/pages/contact"><i class="fas fa-envelope"></i> Nous contacter</a>
                </div>
            </div>
            
            <div class="nav-dropdown">
                    <div class="nav-item">
                        <a class="nav-dropbtn">Découvrir <i class="fa fa-caret-down"></i></a>
                    </div>
                <div class="nav-dropdown-content">
                    <a href="/pages/activites"><i class="fas fa-running"></i> Activités</a>
                    <a href="/pages/defis"><i class="fas fa-trophy"></i> Défis</a>
                </div>
            </div>

                    <div class="nav-item"><a href="pages/maps" style="text-decoration: none; color: white;">Maps</a></div>
                    <?php if (!isset($_SESSION['connecté']) || $_SESSION['connecté'] !== true): ?>
                        <div class="nav-item"><a href="connexion/login.php" style="text-decoration: none; color: white;">Connexion</a></div>
                    <?php endif; ?>
                    
                    <?php if (isset($_SESSION['connecté']) && $_SESSION['connecté'] === true && $_SESSION['role'] == 'user'): ?>
                        <div class="nav-dropdown">
                            <button class="nav-dropbtn"><img src="./assets/uploads/profiles/<?php echo $photo_profil['photo_profil']; ?>" alt="Photo de profil" style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover;"> <i class="fa fa-caret-down"></i></button>
                            <div class="nav-dropdown-content">
                                <a href="../../pages/user/profile.php">Mon profil</a>
                                <a href="../../pages/reservations">Mes réservations</a>
                                <a href="/connexion/logout-user.php"><i class="fas fa-sign-out-alt"></i> Me deconnecter</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </nav>
            </header>
        
        <style>
.header {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  z-index: 100;
  padding: 40px 80px;
}

.nav-dropdown {
    position: relative;
    display: inline-block;
}
            
.nav-dropdown-content {
    display: none;
    position: absolute;
    background-color: #ffffff;
    min-width: 200px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    border-radius: 4px;
    right: 0;
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
            
.nav-dropdown:hover .nav-dropbtn {
   opacity: 0.8;
}

.nav-links a:hover {
    opacity: 0.8;
}

.nav-dropdown:hover .nav-dropbtn {
    opacity: 0.8;
}

.navigation {
  display: flex;
  align-items: center;
  justify-content: space-between;
  max-width: 1400px;
  margin: 0 auto;
  width: 100%;
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

.nav-item:hover {
  background-color: rgba(255, 255, 255, 0.1);
  transform: translateY(-2px);
}

.home-nav {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 10px;
}

.home-icon {
  width: 32px;
  height: 32px;
  color: white;
  cursor: pointer;
  transition: all 0.3s ease;
}

.home-icon:hover {
  transform: scale(1.1);
}
        </style>
        