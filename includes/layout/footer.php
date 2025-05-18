
<footer class="container">
        <div>
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
        footer > div:last-child {
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
            footer > div:last-child {
                text-align: center;
                margin-top: 20px;
            }
            .footer-links {
                justify-content: center;
            }
            .social-icons {
                 justify-content: center;
            }
        }
</style>