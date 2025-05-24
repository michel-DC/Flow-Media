<footer class="main-footer">
        <div class="footer-container">
        <?php require_once 'animations/snake/index.php'; ?>
            <div class="footer-logo">Flow Media</div>
            <div class="footer-links">
                <a href="#">Accueil</a>
                <a href="#">Découvrir</a>
                <a href="#">Défis</a>
                <a href="#">Maps</a>
                <a href="#">Contact</a>
            </div>
            <div class="footer-socials">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
            </div>
            <div class="footer-copyright">
                &copy; 2024 Flow Media. Tous droits réservés.
            </div>
        </div>
    </footer>

<style>
    .main-footer {
  background: linear-gradient(90deg, #b7b7b7 60%, #e6e6e6 100%);
  box-shadow: 0 4px 18px rgba(0, 0, 0, 0.1);
  color: #222;
  padding: 36px 0 18px 0;
  text-align: center;
  margin-top: 0;
}
.footer-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 24px;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 24px;
}
.footer-logo {
  font-size: 2rem;
  font-weight: 800;
  letter-spacing: 2px;
  color: #a259e6;
}
.footer-links {
  display: flex;
  gap: 32px;
  flex-wrap: wrap;
  justify-content: center;
}
.footer-links a {
  color: #222;
  text-decoration: none;
  font-size: 1.1rem;
  font-weight: 500;
  transition: color 0.2s;
}
.footer-links a:hover {
  color: #a259e6;
}
.footer-socials {
  display: flex;
  gap: 20px;
  justify-content: center;
}
.footer-socials a {
  color: #222;
  font-size: 1.4rem;
  transition: color 0.2s;
}
.footer-socials a:hover {
  color: #a259e6;
}
.footer-copyright {
  color: #222;
  font-size: 0.95rem;
  margin-top: 12px;
}
@media (max-width: 600px) {
  .footer-links {
    gap: 14px;
    font-size: 0.95rem;
  }
  .footer-logo {
    font-size: 1.3rem;
  }
  .footer-container {
    gap: 14px;
  }
}
</style>