<footer class="new-footer">
  <div class="footer-container">
    <div class="footer-main">
      <div class="footer-nav">
        <a href="../../index.php">Accueil</a>
        <a href="../../pages/about">À propos</a>
        <a href="../../pages/activites">Découvrir</a>
        <a href="../../pages/maps">Maps</a>
        <a href="../../pages/contact">Contact</a>
      </div>
    </div>

    <div class="footer-secondary">
      <div class="footer-legal">
        <a href="/legal/politique-confidentialite.php">Politique de confidentialité</a>
        <a href="/legal/cookies.php">Cookies</a>
      </div>
      <div class="footer-socials-new">
        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="#" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
        <a href="#" aria-label="Snapchat"><i class="fab fa-snapchat"></i></a>
      </div>
    </div>

    <div class="footer-brand">
      <img src="../../assets/images/flowmedia-icon.svg" alt="Flow Media Logo" class="footer-logo">
      <span class="brand-separator">X</span>
      <span class="campaign-name">À deux pas</span>
    </div>
  </div>
  <div class="footer-copyright">
    &copy; 2025 Flow Media. Tous droits réservés.
  </div>
</footer>

<style>
  .new-footer {
    background-color: #e6e2d4;
    padding: 15px 20px;
    color: #333;
  }

  .footer-container {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 15px;
    align-items: center;
  }

  .footer-main {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
  }

  .footer-brand {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    width: 100%;
    padding: 10px 0;
    margin-top: 10px;
    margin-bottom: 10px;
  }

  .footer-logo {
    width: 120px;
    height: 120px;
  }

  .brand-separator {
    font-size: 2.5em;
    font-weight: 500;
    color: #333;
  }

  .campaign-name {
    font-size: 2.5em;
    font-weight: bolder;
    color: #a259e6;
  }

  .footer-nav {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 25px;
    align-items: center;
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
    align-items: center;
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
    margin-top: 10px;
    padding-top: 10px;
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
      padding: 5px 15px;
    }

    .footer-container {
      gap: 0;
    }

    .footer-logo {
      width: 100px;
      height: 100px;
    }

    .brand-separator {
      font-size: 2.2em;
    }

    .campaign-name {
      font-size: 2.2em;
    }

    .footer-nav {
      gap: 10px;
      flex-direction: column;
      align-items: center;
    }

    .footer-nav a {
      font-size: 1em;
      width: 100%;
      text-align: center;
    }

    .footer-legal {
      gap: 10px;
      flex-direction: column;
      align-items: center;
    }

    .footer-legal a {
      font-size: 0.9em;
      width: 100%;
      text-align: center;
    }

    .footer-socials-new {
      gap: 15px;
    }

    .footer-socials-new a {
      font-size: 1.5em;
    }

    .footer-brand {
      margin-top: 5px;
      margin-bottom: 5px;
    }

    .footer-copyright {
      font-size: 0.85rem;
      margin-top: 5px;
      padding-top: 5px;
    }
  }

  @media (max-width: 480px) {
    .new-footer {
      padding: 5px 15px;
    }

    .footer-container {
      gap: 0;
    }

    .footer-brand {
      margin-top: 4px;
      margin-bottom: 4px;
    }

    .footer-logo {
      width: 80px;
      height: 80px;
    }

    .brand-separator {
      font-size: 2em;
    }

    .campaign-name {
      font-size: 2em;
    }

    .footer-nav {
      gap: 8px;
      flex-direction: column;
      align-items: center;
    }

    .footer-nav a {
      width: 100%;
      text-align: center;
    }

    .footer-legal {
      gap: 8px;
      flex-direction: column;
      align-items: center;
    }

    .footer-legal a {
      width: 100%;
      text-align: center;
    }

    .footer-socials-new a {
      font-size: 1.3em;
    }

    .footer-copyright {
      font-size: 0.85rem;
      margin-top: 4px;
      padding-top: 4px;
    }
  }
</style>