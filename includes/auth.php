<?php
session_start();

$chemin = $_SERVER['REQUEST_URI'];
// strpos() cherche si un morceau de texte se trouve dans un autre texte et dit où




if (!isset($_SESSION['connecté']) || $_SESSION['connecté'] !== true) {
    if (strpos($chemin, 'index.php') !== false) {
    } else if (strpos($chemin, '/admin') !== false) {
        header('Location: ../connexion/login-admin.php?erreur=non_connecte');
        exit();
    } else if (strpos($chemin, '/pages/maps') !== false) {
        header('Location: ../../connexion/login.php?erreur=non_connecte');
        exit();
    } else if (strpos($chemin, '/pages/activites') !== false) {
        header('Location: ../../connexion/login.php?erreur=non_connecte');
        exit();
    } else if (strpos($chemin, '/pages/podcast') !== false) {
        header('Location: ../../connexion/login.php?erreur=non_connecte');
        exit();
    }
}

if (strpos($chemin, 'login.php') !== false && isset($_SESSION['connecté']) && $_SESSION['connecté'] === true && $_SESSION['role'] === 'user') {
    header('Location: ../index.php?erreur=deja_connecte_user');
    exit();
}

if (strpos($chemin, 'register.php') !== false && isset($_SESSION['connecté']) && $_SESSION['connecté'] === true && $_SESSION['role'] === 'user') {
    header('Location: ../index.php?erreur=deja_connecte_user');
    exit();
}

if (strpos($chemin, '/admin') !== false && isset($_SESSION['role']) && $_SESSION['role'] !== 'admin') {
    header('Location: ../connexion/login.php?erreur=acces_refuse_user');
    exit();
}

if (strpos($chemin, '/connexion/login-admin.php') !== false && isset($_SESSION['role']) && $_SESSION['role'] !== 'admin') {
    header('Location: ../pages/user/profile.php?erreur=acces_refuse_user');
    exit();
}

if (strpos($chemin, '/pages') !== false && isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    header('Location: ../../admin/dashboard.php?erreur=acces_interdit_admin');
    exit();
}
