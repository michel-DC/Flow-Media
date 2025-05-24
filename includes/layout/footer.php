<footer class="new-footer">
  <div class="footer-title">Flow Media</div>
  <div class="footer-nav">
    <a href="../../home.php">Accueil</a>
    <a href="../../pages/about">À propos</a>
    <a href="../../pages/activites">Découvrir</a>
    <a href="../../pages/maps">Maps</a>
    <a href="../../pages/contact">Contact</a>
  </div>
  <div class="footer-legal">
    <a href="#">Politique de confidentialité</a>
    <a href="#">Cookies</a>
  </div>
  <div class="footer-socials-new">
    <a href="#"><i class="fab fa-instagram"></i></a>
    <a href="#"><i class="fab fa-tiktok"></i></a>
    <a href="#"><i class="fab fa-snapchat"></i></a>
  </div>
  <div class="footer-copyright">
    &copy; 2025 Flow Media. Tous droits réservés.
  </div>
</footer>

<style>
  .new-footer {
    background-color: #e6e2d4;
    padding: 30px 20px;
    text-align: center;
    color: #333;
  }

  .footer-title {
    font-size: 3em;
    font-weight: bold;
    margin-bottom: 20px;
    color: #C4BAA1;
  }

  .footer-nav {
    margin-bottom: 20px;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 25px;
  }

  .footer-nav a {
    color: #333;
    text-decoration: none;
    font-size: 1.1em;
    transition: color 0.2s;
  }

  .footer-nav a:hover {
    color: #a19f96;
  }

  .legal {
    display: flex;
    margin-top: 15px;
    align-items: center;
    justify-content: center;
  }

  .footer-legal {
    display: flex;
    justify-content: center;
    gap: 25px;
    margin-top: 15px;
    margin-bottom: 15px;
    flex-wrap: wrap;
  }

  .footer-legal a {
    color: #333;
    text-decoration: none;
    font-size: 1em;
    transition: color 0.2s;
  }

  .footer-legal a:hover {
    color: #a19f96;
  }

  .footer-socials-new {
    display: flex;
    justify-content: center;
    gap: 20px;
  }

  .footer-socials-new a {
    color: #ff003c;
    /* Red color based on image */
    font-size: 1.8em;
    transition: opacity 0.2s;
  }

  .footer-socials-new a:hover {
    opacity: 0.8;
  }

  .footer-copyright {
    color: #222;
    font-size: 0.95rem;
    margin-top: 12px;
  }

  @media (max-width: 600px) {
    .footer-nav {
      gap: 15px;
      font-size: 0.9em;
    }

    .footer-title {
      font-size: 1.5em;
      margin-bottom: 15px;
    }

    .footer-socials-new {
      gap: 15px;
    }

    .footer-socials-new a {
      font-size: 1.5em;
    }
  }
</style>