<footer class="container">
    <div>
        <div class="footer-logos">
            <img src="https://cdn.sanity.io/images/q388rn0o/production/55cc60c9e3d2f28567173b8c7a871a4040eb164b-500x500.png?w=3840&q=75&fit=clip&auto=format" alt="Flow Media Logo" class="footer-logo">
            <img src="https://upload.wikimedia.org/wikipedia/commons/f/f5/Logo-amf-bas.png" alt="AMF Logo" class="footer-logo">
        </div>
        <p>© 2025 Flow Media. Tous droits réservés.</p>
        <div class="social-icons">
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-tiktok"></i></a>
        </div>
    </div>
    <div>
        <div class="footer-links">
            <a href="../../legal/politique-confidentialite.php">Politique de confidentialité</a>
            <a href="../../legal/cookies.php">Cookies</a>
            <a href="../../pages/contact">Contact</a>
        </div>
    </div>
</footer>

<style>
    footer {
        padding: 40px 0;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        align-items: center;
    }

    .footer-logos {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .footer-logo {
        height: 40px;
        width: auto;
    }

    footer>div:last-child {
        text-align: right;
    }

    .footer-links {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
    }

    .footer-links a {
        color: #000;
        text-decoration: none;
    }

    .footer-links a:hover {
        text-decoration: underline;
    }

    .social-icons {
        display: flex;
        gap: 15px;
        margin-top: 15px;
    }

    .social-icons a {
        color: #000;
        font-size: 1.5rem;
    }

    @media (max-width: 768px) {
        footer {
            grid-template-columns: 1fr;
            text-align: center;
        }

        footer>div:last-child {
            text-align: center;
            margin-top: 20px;
        }

        .footer-links {
            justify-content: center;
        }

        .social-icons {
            justify-content: center;
        }

        .footer-logos {
            justify-content: center;
        }
    }
</style>