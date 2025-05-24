<aside class="sidebar collapsed">
    <div class="sidebar-header">
        <button id="toggle-sidebar" class="toggle-btn">☰</button>
    </div>
    <nav class="sidebar-nav">
        <ul>
            <li>
                <a href="dashboard.php" class="nav-link">
                    <span class="nav-icon">📊</span>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" id="add-activity-link" class="nav-link">
                    <span class="nav-icon">➕</span>
                    <span class="nav-text">Ajouter un activité</span>
                </a>
            </li>
            <li>
                <a href="#" id="supp-activity-link" class="nav-link">
                    <span class="nav-icon">⛔</span>
                    <span class="nav-text">Supprimer une activité</span>
                </a>
            </li>
            <li>
                <a href="#" id="edit-activity-link" class="nav-link">
                    <span class="nav-icon">✏️</span>
                    <span class="nav-text">Modifier une activité</span>
                </a>
            </li>
            <li>
                <a href="#" id="add-fun-fact-link" class="nav-link">
                    <span class="nav-icon">➕</span>
                    <span class="nav-text">Ajouter un fun fact</span>
                </a>
            </li>
            <li>
                <a href="#" id="add-podcast-link" class="nav-link">
                    <span class="nav-icon">➕</span>
                    <span class="nav-text">Ajouter un podcast</span>
                </a>
            </li>
            <li>
                <a href="#" id="supp-podcast-link" class="nav-link">
                    <span class="nav-icon">⛔</span>
                    <span class="nav-text">Supprimer un podcast</span>
                </a>
            </li>
            <li>
                <a href="#" id="edit-podcast-link" class="nav-link">
                    <span class="nav-icon">✏️</span>
                    <span class="nav-text">Modifier un podcast</span>
                </a>
            </li>
            <li>
                <a href="#" id="see-activity-link" class="nav-link">
                    <span class="nav-icon">👨‍💻</span>
                    <span class="nav-text">Voir toute les activités</span>
                </a>
            </li>
            <li>
                <a href="#" id="see-podcast-link" class="nav-link">
                    <span class="nav-icon">👨‍💻</span>
                    <span class="nav-text">Voir tous les podcasts</span>
                </a>
            </li>
            <li>
                <a href="#" id="see-reserv-link" class="nav-link">
                    <span class="nav-icon">🗓️</span>
                    <span class="nav-text">Voir toutes les réservations</span>
                </a>
            </li>
            <li>
                <a href="#" id="manage-user-link" class="nav-link">
                    <span class="nav-icon">👤</span>
                    <span class="nav-text">Gérer Utilisateurs</span>
                </a>
            </li>
        </ul>
    </nav>
    <div class="sidebar-footer">
        <a href="../../connexion/logout-admin.php" class="nav-link logout-link">
            <span class="nav-icon">🚪</span>
            <span class="nav-text">Déconnexion</span>
        </a>
    </div>
</aside>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    :root {
        --primary-color: #2ECC71;
        --secondary-color: #25a25a;
        --text-color: #333;
        --light-bg: #f8f9fa;
        --white: #ffffff;
        --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.1);
        --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.15);
    }

    .sidebar {
        font-family: "Poppins", sans-serif;
        width: 250px;
        background: var(--white);
        color: var(--text-color);
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        padding: 20px;
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
        z-index: 1000;
        border-right: 1px solid rgba(0, 0, 0, 0.1);
    }

    .sidebar.collapsed {
        width: 120px;
    }

    .sidebar.collapsed .nav-text {
        display: none;
    }

    .sidebar-header {
        margin-bottom: 30px;
        padding-bottom: 20px;
        position: relative;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .toggle-btn {
        position: absolute;
        left: 50%;
        top: 0;
        transform: translateX(-50%);
        background: none;
        border: none;
        cursor: pointer;
        font-size: 1.5rem;
        padding: 5px;
        color: var(--text-color);
        transition: color 0.2s ease;
    }

    .toggle-btn:hover {
        color: var(--primary-color);
    }

    .sidebar-nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .nav-link {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        color: var(--text-color);
        text-decoration: none;
        border-radius: 8px;
        margin-bottom: 8px;
        transition: all 0.2s ease-in-out;
        background-color: var(--white);
        border: 1px solid rgba(0, 0, 0, 0.1);
    }

    .nav-link:hover {
        background-color: var(--primary-color);
        color: var(--white);
        transform: translateX(5px);
        border-color: var(--primary-color);
    }

    .nav-icon {
        margin-right: 15px;
        font-size: 1.2rem;
        transition: margin 0.3s ease;
    }

    .nav-text {
        font-size: 0.95rem;
        font-weight: 500;
        transition: opacity 0.2s ease;
    }

    .sidebar-footer {
        position: absolute;
        bottom: 20px;
        left: 20px;
        right: 20px;
        padding-top: 20px;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }

    .logout-link {
        background-color: #f8d7da;
        color: #721c24;
        border-color: #f5c6cb;
    }

    .logout-link:hover {
        background-color: #721c24;
        color: var(--white);
        border-color: #721c24;
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 80px;
            padding: 10px;
        }

        .sidebar .nav-text {
            display: none;
        }

        .sidebar .nav-icon {
            margin-right: 0;
        }

        .sidebar-footer {
            left: 10px;
            right: 10px;
        }

        .nav-link {
            padding: 12px;
            justify-content: center;
        }
    }
</style>

<script>
    document.getElementById('toggle-sidebar').addEventListener('click', function() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('collapsed');
    });

    window.addEventListener('resize', function() {
        const sidebar = document.querySelector('.sidebar');
        if (window.innerWidth <= 768) {
            sidebar.classList.add('collapsed');
        } else {
            sidebar.classList.remove('collapsed');
        }
    });

    window.addEventListener('DOMContentLoaded', function() {
        if (window.innerWidth <= 768) {
            document.querySelector('.sidebar').classList.add('collapsed');
        }
    });
</script>