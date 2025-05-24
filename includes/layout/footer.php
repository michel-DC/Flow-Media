<footer class="new-footer">
  <div class="footer-container">
    <div class="footer-main">
      <div class="footer-title">Flow Media</div>
      <div class="footer-nav">
        <a href="../../home.php">Accueil</a>
        <a href="../../pages/about">À propos</a>
        <a href="../../pages/activites">Découvrir</a>
        <a href="../../pages/maps">Maps</a>
        <a href="../../pages/contact">Contact</a>
      </div>
    </div>

    <div class="footer-secondary">
      <div class="footer-legal">
        <a href="#">Politique de confidentialité</a>
        <a href="#">Cookies</a>
      </div>
      <div class="footer-socials-new">
        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="#" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
        <a href="#" aria-label="Snapchat"><i class="fab fa-snapchat"></i></a>
      </div>
    </div>
  </div>
  <div class="footer-copyright">
    &copy; 2025 Flow Media. Tous droits réservés.
  </div>
</footer>

<style>
  .new-footer {
    background-color: #e6e2d4;
    padding: 40px 20px 20px;
    color: #333;
  }

  .footer-container {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 30px;
  }

  .footer-main {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
  }

  .footer-title {
    font-size: 3em;
    font-weight: bold;
    color: #C4BAA1;
    text-align: center;
  }

  .footer-nav {
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
    padding: 5px 10px;
  }

  .footer-nav a:hover {
    color: #a19f96;
  }

  .footer-secondary {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
  }

  .footer-legal {
    display: flex;
    justify-content: center;
    gap: 25px;
    flex-wrap: wrap;
  }

  .footer-legal a {
    color: #333;
    text-decoration: none;
    font-size: 1em;
    transition: color 0.2s;
    padding: 5px 10px;
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
    font-size: 1.8em;
    transition: all 0.3s ease;
    padding: 10px;
  }

  .footer-socials-new a:hover {
    transform: scale(1.1);
    opacity: 0.8;
  }

  .footer-copyright {
    color: #222;
    font-size: 0.95rem;
    text-align: center;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
  }

  @media (min-width: 768px) {
    .footer-container {
      flex-direction: row;
      justify-content: space-between;
      align-items: flex-start;
    }

    .footer-main {
      align-items: flex-start;
    }

    .footer-title {
      text-align: left;
    }

    .footer-nav {
      justify-content: flex-start;
    }

    .footer-secondary {
      align-items: flex-end;
    }
  }

  @media (max-width: 767px) {
    .new-footer {
      padding: 30px 15px 15px;
    }

    .footer-title {
      font-size: 2em;
    }

    .footer-nav {
      gap: 15px;
    }

    .footer-nav a {
      font-size: 1em;
    }

    .footer-legal {
      gap: 15px;
    }

    .footer-legal a {
      font-size: 0.9em;
    }

    .footer-socials-new {
      gap: 15px;
    }

    .footer-socials-new a {
      font-size: 1.5em;
    }

    .footer-copyright {
      font-size: 0.85rem;
      margin-top: 20px;
      padding-top: 15px;
    }
  }

  @media (max-width: 480px) {
    .footer-title {
      font-size: 1.8em;
    }

    .footer-nav {
      flex-direction: column;
      align-items: center;
      gap: 10px;
    }

    .footer-legal {
      flex-direction: column;
      align-items: center;
      gap: 10px;
    }

    .footer-socials-new a {
      font-size: 1.3em;
    }
  }
</style>