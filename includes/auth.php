<?php
session_start();

$chemin = $_SERVER['REQUEST_URI'];

if (!isset($_SESSION['connecté']) || $_SESSION['connecté'] !== true) {
    if (strpos($chemin, 'index.php') !== false) {
    } else if (strpos($chemin, '/admin') !== false) {
        header('Location: ../connexion/login-admin.php?erreur=non_connecte');
        exit();
    } else if (strpos($chemin, '/pages/user/') !== false) {
        header('Location: ../../connexion/login.php?erreur=non_connecte');
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
    } else if (strpos($chemin, '/pages/activite') !== false) {
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
    header('Location: ../pages/user/me.php?erreur=acces_refuse_user');
    exit();
}

if (strpos($chemin, 'login-admin.php') !== false && isset($_SESSION['connecté']) && $_SESSION['connecté'] === true && $_SESSION['role'] === 'user') {
    header('Location: ../pages/user/me.php?erreur=acces_refuse_user');
    exit();
}

if (strpos($chemin, '/pages') !== false && isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    header('Location: ../../admin/dashboard.php?erreur=acces_interdit_admin');
    exit();
}
