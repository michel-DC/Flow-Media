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
                <a href="#" id="add-podcast-link" class="nav-link">
                    <span class="nav-icon">➕</span>
                    <span class="nav-text">Ajouter un podcast/temoignage</span>
                </a>
            </li>
            <li> 
                <a href="#" id="supp-podcast-link" class="nav-link">
                    <span class="nav-icon">⛔</span>
                    <span class="nav-text">Supprimer un podcast/temoignage</span>
                </a>
            </li>
            <li> 
                <a href="#" id="edit-podcast-link" class="nav-link">
                    <span class="nav-icon">✏️</span>
                    <span class="nav-text">Modifier un podcast/temoignage</span>
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
    .sidebar {
        font-family: "Poppins", sans-serif;
        width: 250px;
        background: #FFFFFF; /* White background */
        color: #000000; /* Black text */
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        padding: 20px;
        box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        z-index: 1000;
        backdrop-filter: blur(0); /* Remove blur */
        border-right: 1px solid #000000; /* Black border */
    }
    
    @media (max-width: 768px) {
        .sidebar {
            width: 80px;
            padding: 10px;
        }
        .sidebar .nav-text,
        .sidebar .nav-icon {
            margin-right: 0;
        }
        .sidebar-footer {
            left: 10px;
            right: 10px;
        }
    }
    
    .sidebar.collapsed {
        width: 120px; /* Reverted to original collapsed width */
    }
    .sidebar.collapsed .nav-text {
        display: none;
    }
    .sidebar.collapsed .sidebar-header h3 {
        display: none;
    }
    .sidebar-header {
        margin-bottom: 30px;
        padding-bottom: 20px;
        position: relative;
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
        color: #000000; /* Black color */
        transition: color 0.2s ease;
    }
    .toggle-btn:hover {
        color: #555555; /* Darker grey on hover */
    }
    .sidebar-nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .nav-link {
        display: flex;
        align-items: center;
        padding: 12px 25px;
        color: #000000; /* Black text */
        text-decoration: none;
        border-radius: 8px; /* Reverted to original border radius */
        margin-bottom: 8px;
        transition: all 0.2s ease-in-out;
        border: 1.5px solid rgba(0,0,0,0.5); /* Adjusted border */
        background-color: #FFFFFF; /* White background */
        width: 100%; /* Increased width to fill container */
    }
    .nav-link:hover {
        border-color: #000000; /* Black border on hover */
        background-color: #f0f0f0; /* Subtle grey background on hover */
        transform: translateX(5px); /* Reverted to original transform */
    }
    .nav-icon {
        margin-right: 15px;
        font-size: 1.2rem;
        color: #000000; /* Black icon color */
        transition: margin 0.3s ease;
    }
    .nav-text {
        font-size: 0.95rem;
        font-weight: 500;
        transition: opacity 0.2s ease;
    }
    .sidebar-footer {
        position: absolute;
        bottom: 70px; /* Reverted to original bottom position */
        left: 20px;
        right: 20px;
        padding-top: 20px;
        border-top: 1px solid #000000; /* Black border */
    }
    .logout-link {
        background-color: #FFFFFF; /* White background */
        border-color: rgba(0,0,0,0.5); /* Adjusted border */
        color: #000000; /* Black text */
    }
    .logout-link:hover {
        background-color: #f0f0f0; /* Subtle grey background on hover */
        border-color: #000000; /* Black border on hover */
        color: #000000; /* Black text */
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