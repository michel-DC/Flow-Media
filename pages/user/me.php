<?php
require_once '../../includes/auth.php';

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($link, $query);
$user = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flow Media | Mon profil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="icon" href="../../assets/icons/logo.png" type="image/svg+xml">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        :root {
            --soft-black: #1a1a1a;
            --white: #f9f9f9;
            --border: #e2e8f0;
            --background: #ffffff;
            --card-background: #ffffff;
            --hover: #f1f5f9;
            --muted: #64748b;
            --selected-background: #e0e0e0;
            --primary: #3a791f;
            --primary-hover: #4e8c2b;
            --secondary: #e53e3e;
            --secondary-hover: #c53030;
        }

        body {
            font-family: "Poppins", sans-serif;
            background-color: var(--background);
            color: var(--soft-black);
            margin: 0;
            padding: 0;
            line-height: 1.6;
            min-height: 100vh;
        }

        .dashboard {
            display: flex;
            margin-top: 80px;

        }

        .sidebar {
            background: var(--card-background);
            border-right: 1px solid var(--border);
            padding: 2rem;
            width: 280px;
            flex-shrink: 0;
            position: fixed;
            top: 0;
            bottom: 0;
            overflow-y: auto;
            box-sizing: border-box;
            margin-top: 80px;
        }

        .main-content {
            flex-grow: 1;
            padding: 2rem;
            margin-left: 280px;
        }

        .profile-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
            text-align: center;
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--border);
        }

        .profile-header h2 {
            font-size: 1.25rem;
            margin: 0;
        }

        .profile-header p {
            font-size: 0.875rem;
            color: var(--muted);
            margin: 0;
        }

        .sidebar nav a {
            display: block;
            text-decoration: none;
            color: var(--soft-black);
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 6px;
            transition: background-color 0.2s, color 0.2s;
            font-weight: 500;
        }

        .sidebar nav a:hover {
            background-color: var(--hover);
            color: var(--soft-black);
        }

        .dashboard-container {
            padding: 35px;
            margin-bottom: 1.5rem;
        }

        .dashboard-header {
            text-align: center;
            margin-bottom: 30px;
            padding: 25px;
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .dashboard-header h1 {
            margin: 0;
            font-size: 36px;
            color: var(--soft-black);
            font-weight: 700;
        }

        .dashboard-header h1 span {
            color: var(--primary);
            position: relative;
        }

        .dashboard-header h1 span::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: var(--primary);
            border-radius: 3px;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--white);
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            text-align: center;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 200px;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .stat-number {
            font-size: 2.5rem;
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 15px;
            line-height: 1.2;
        }

        .stat-label {
            font-size: 1.1rem;
            color: var(--soft-black);
            font-weight: 500;
        }

        .chart-card {
            position: relative;
            padding-top: 30px;
            min-height: 350px;
        }

        .message {
            padding: 12px;
            border-radius: 4px;
            margin: 10px auto;
            text-align: center;
            width: 90%;
            max-width: 500px;
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            animation: fadeOut 5s forwards;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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

        canvas {
            width: 100% !important;
            height: 250px !important;
            max-height: 300px;
        }

        @media (max-width: 768px) {
            .dashboard {
                flex-direction: column;
            }

            .sidebar {
                position: static;
                width: 100%;
                height: auto;
                border-right: none;
                border-bottom: 1px solid var(--border);
                padding: 1rem;
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .profile-header {
                flex-direction: row;
                text-align: left;
                align-items: center;
            }

            .profile-avatar {
                width: 60px;
                height: 60px;
            }

            .sidebar nav {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .sidebar nav a {
                flex-grow: 1;
                text-align: center;
                padding: 0.5rem;
            }

            .dashboard-container {
                padding: 1.5rem;
            }

            .stats-container {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .stat-card {
                padding: 15px;
                min-height: 140px;
            }

            .stat-number {
                font-size: 2rem;
            }

            .stat-label {
                font-size: 1rem;
            }

            .chart-card {
                min-height: 250px;
            }
        }

        .map-container {
            margin-top: 2rem;
            padding: 1.5rem;
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow-md);
        }

        .map-container h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--soft-black);
        }

        .map-container h2 span {
            color: var(--primary);
            position: relative;
        }

        .map-container h2 span::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: var(--primary);
            border-radius: 2px;
        }

        #map {
            width: 100%;
            height: 500px;
            border-radius: 8px;
            overflow: hidden;
        }

        .leaflet-popup-content {
            font-size: 0.9rem;
        }

        .leaflet-popup-content a.btn {
            display: inline-block;
            margin-top: 8px;
            padding: 6px 12px;
            background-color: var(--primary);
            color: var(--white);
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.9rem;
            transition: background-color 0.2s;
        }

        .leaflet-popup-content a.btn:hover {
            background-color: var(--primary-hover);
        }
    </style>
</head>

<body>

    <?php include '../../includes/layout/navbar.php' ?>

    <div class="dashboard">
        <aside class="sidebar">
            <div class="profile-header">
                <?php if (!empty($user['photo_profil'])): ?>
                    <img src="../../assets/uploads/profiles/<?php echo $user['photo_profil']; ?>" alt="Photo de profil" class="profile-avatar">
                <?php else: ?>
                    <div class="profile-avatar" style="background-color: var(--border); display: flex; align-items: center; justify-content: center;">
                        <span style="font-size: 2rem;">👤</span>
                    </div>
                <?php endif; ?>
                <div>
                    <h2><?php echo htmlspecialchars($user['fullname']); ?></h2>
                    <p><?php echo htmlspecialchars($user['email']); ?></p>
                </div>
            </div>

            <nav>
                <a href="#dashboard">Mon profil</a>
                <a href="#info-section">Mes informations</a>
                <a href="#interest-section">Mes centres d'intérêts</a>
                <a href="#position-section">Ma position</a>
                <a href="#abonnement-section">Mon abonnement</a>
            </nav>
        </aside>

        <main class="main-content">
            <div id="info-section" style="display: none;"><?php include 'pages/info.php'; ?></div>
            <div id="interest-section" style="display: none;"><?php include 'pages/centre_interet.php'; ?></div>
            <div id="position-section" style="display: none;"><?php include 'pages/maps.php'; ?></div>
            <div id="abonnement-section" style="display: none;"><?php include 'pages/abonnement.php'; ?></div>


            <div class="dashboard-container" id="dashboard">

                <?php include '../../components/profile.php' ?>

                <!-- section niveau de l'utilisateur  -->
                <?php include '../../components/niveau.php' ?>

                <script>
                    function showSection(sectionId) {
                        document.querySelectorAll('.dashboard-container, #info-section, #interest-section, #position-section, #abonnement-section')
                            .forEach(section => section.style.display = 'none');
                        document.getElementById(sectionId).style.display = 'block';
                    }

                    document.querySelectorAll('.sidebar nav a').forEach(anchor => {
                        anchor.addEventListener('click', function(e) {
                            e.preventDefault();
                            const targetId = this.getAttribute('href').substring(1);
                            showSection(targetId);
                        });
                    });
                </script>
        </main>
    </div>

</body>

</html>