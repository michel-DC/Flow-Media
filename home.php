<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Culture & Patrimoine - Animation d'Entrée</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            overflow: hidden;
            font-family: 'Georgia', serif;
            background: #000;
        }

        .entrance-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 9999;
            background: radial-gradient(ellipse at center, #2c1810, #1a0f0a, #000);
        }

        .stage-frame {
            position: absolute;
            top: 5%;
            left: 5%;
            width: 90%;
            height: 90%;
            border: 20px solid #8B4513;
            border-radius: 10px;
            box-shadow:
                inset 0 0 50px rgba(139, 69, 19, 0.8),
                0 0 100px rgba(0, 0, 0, 0.8),
                0 0 200px rgba(139, 69, 19, 0.3);
            background: linear-gradient(135deg, #654321, #8B4513, #654321);
        }

        .stage-frame::before {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            background: linear-gradient(45deg,
                    #DAA520 0%,
                    #FFD700 25%,
                    #DAA520 50%,
                    #B8860B 75%,
                    #DAA520 100%);
            border-radius: 15px;
            z-index: -1;
        }

        .stage-content {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background: linear-gradient(180deg, #87CEEB 0%, #E0F6FF 100%);
        }

        .curtain-left,
        .curtain-right {
            position: absolute;
            top: 0;
            width: 50%;
            height: 100%;
            background-size: cover;
            background-position: center;
            transition: transform 3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            z-index: 10;
        }

        .curtain-left {
            left: 0;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 600"><defs><linearGradient id="sky" x1="0%" y1="0%" x2="0%" y2="100%"><stop offset="0%" style="stop-color:%2387CEEB"/><stop offset="100%" style="stop-color:%23E0F6FF"/></linearGradient><radialGradient id="sun" cx="80%" cy="20%"><stop offset="0%" style="stop-color:%23FFD700"/><stop offset="100%" style="stop-color:%23FFA500"/></radialGradient></defs><rect width="400" height="600" fill="url(%23sky)"/><circle cx="320" cy="80" r="30" fill="url(%23sun)"/><rect x="0" y="450" width="400" height="150" fill="%23228B22"/><ellipse cx="60" cy="400" rx="25" ry="40" fill="%2334C759"/><ellipse cx="120" cy="380" rx="30" ry="50" fill="%2334C759"/><ellipse cx="180" cy="390" rx="28" ry="45" fill="%2334C759"/><ellipse cx="240" cy="385" rx="32" ry="48" fill="%2334C759"/><ellipse cx="300" cy="395" rx="26" ry="42" fill="%2334C759"/><ellipse cx="360" cy="400" rx="24" ry="38" fill="%2334C759"/><rect x="55" y="420" width="10" height="30" fill="%23654321"/><rect x="115" y="410" width="12" height="40" fill="%23654321"/><rect x="175" y="415" width="11" height="35" fill="%23654321"/><rect x="235" y="413" width="13" height="37" fill="%23654321"/><rect x="295" y="417" width="10" height="33" fill="%23654321"/><rect x="355" y="420" width="12" height="30" fill="%23654321"/><path d="M50 500 Q150 480 250 500 T400 500" stroke="%2300CED1" stroke-width="8" fill="none"/><path d="M30 520 Q130 500 230 520 T380 520" stroke="%2300CED1" stroke-width="6" fill="none" opacity="0.7"/><rect x="150" y="350" width="100" height="60" fill="%23DEB887" stroke="%23CD853F" stroke-width="2"/><polygon points="150,350 200,320 250,350" fill="%23B22222"/><rect x="175" y="370" width="20" height="30" fill="%23654321"/><rect x="205" y="370" width="15" height="15" fill="%234682B4"/><rect x="225" y="370" width="15" height="15" fill="%234682B4"/><circle cx="60" cy="520" r="8" fill="%23FF69B4"/><circle cx="90" cy="515" r="6" fill="%23FF1493"/><circle cx="120" cy="525" r="7" fill="%23FF69B4"/><circle cx="280" cy="518" r="9" fill="%23FFB6C1"/><circle cx="310" cy="522" r="5" fill="%23FF69B4"/><circle cx="340" cy="516" r="8" fill="%23FF1493"/></svg>');
            transform-origin: left center;
        }

        .curtain-right {
            right: 0;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 600"><defs><linearGradient id="sky2" x1="0%" y1="0%" x2="0%" y2="100%"><stop offset="0%" style="stop-color:%2387CEEB"/><stop offset="100%" style="stop-color:%23E0F6FF"/></linearGradient></defs><rect width="400" height="600" fill="url(%23sky2)"/><rect x="50" y="200" width="300" height="250" fill="%23F5DEB3" stroke="%23D2B48C" stroke-width="4"/><rect x="80" y="240" width="50" height="80" fill="%23654321"/><rect x="140" y="240" width="50" height="80" fill="%23654321"/><rect x="200" y="240" width="50" height="80" fill="%23654321"/><rect x="260" y="240" width="50" height="80" fill="%23654321"/><rect x="90" y="255" width="12" height="40" fill="%234682B4"/><rect x="108" y="255" width="12" height="40" fill="%234682B4"/><rect x="150" y="255" width="12" height="40" fill="%234682B4"/><rect x="168" y="255" width="12" height="40" fill="%234682B4"/><rect x="210" y="255" width="12" height="40" fill="%234682B4"/><rect x="228" y="255" width="12" height="40" fill="%234682B4"/><rect x="270" y="255" width="12" height="40" fill="%234682B4"/><rect x="288" y="255" width="12" height="40" fill="%234682B4"/><polygon points="50,200 200,130 350,200" fill="%23708090"/><rect x="80" y="320" width="240" height="12" fill="%23696969"/><rect x="90" y="332" width="220" height="8" fill="%23696969"/><rect x="100" y="340" width="200" height="6" fill="%23696969"/><rect x="170" y="380" width="60" height="70" fill="%23654321"/><rect x="185" y="400" width="30" height="50" fill="%23333"/><circle cx="195" cy="415" r="2" fill="%23FFD700"/><rect x="195" y="435" width="10" height="4" fill="%23C0C0C0"/><rect x="20" y="480" width="40" height="20" fill="%23228B22"/><rect x="340" y="490" width="50" height="15" fill="%23228B22"/><rect x="150" y="500" width="100" height="8" fill="%23696969"/><circle cx="80" cy="150" r="15" fill="%23FFD700" opacity="0.8"/><circle cx="320" cy="120" r="12" fill="%23FFD700" opacity="0.6"/></svg>');
            transform-origin: right center;
        }

        .curtain-texture {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                repeating-linear-gradient(90deg,
                    transparent,
                    transparent 2px,
                    rgba(255, 255, 255, 0.1) 2px,
                    rgba(255, 255, 255, 0.1) 4px),
                repeating-linear-gradient(0deg,
                    transparent,
                    transparent 8px,
                    rgba(0, 0, 0, 0.1) 8px,
                    rgba(0, 0, 0, 0.1) 10px);
            mix-blend-mode: overlay;
        }

        .curtain-shadow {
            position: absolute;
            right: 0;
            top: 0;
            width: 30px;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 0, 0, 0.4));
            pointer-events: none;
        }

        .curtain-left .curtain-shadow {
            left: auto;
            right: 0;
        }

        .curtain-right .curtain-shadow {
            left: 0;
            right: auto;
            background: linear-gradient(-90deg, transparent, rgba(0, 0, 0, 0.4));
        }

        .stage-lights {
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 300px;
            height: 120%;
            background: linear-gradient(180deg,
                    rgba(255, 255, 240, 0.6) 0%,
                    rgba(255, 255, 240, 0.3) 30%,
                    rgba(255, 255, 240, 0.1) 60%,
                    transparent 100%);
            clip-path: polygon(40% 0%, 60% 0%, 80% 100%, 20% 100%);
            opacity: 0;
            animation: spotlightOn 2s ease-in-out 1.5s forwards;
            z-index: 5;
        }

        .title-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            z-index: 15;
            opacity: 0;
        }

        .main-title {
            font-size: clamp(2.5rem, 8vw, 5rem);
            font-weight: bold;
            color: #fff;
            text-shadow:
                0 0 20px rgba(255, 215, 0, 0.8),
                0 0 40px rgba(255, 215, 0, 0.6),
                0 4px 8px rgba(0, 0, 0, 0.8);
            margin-bottom: 1rem;
            transform: translateY(50px);
            animation: titleSlideIn 1.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) 3s forwards;
            letter-spacing: 2px;
        }

        .subtitle {
            font-size: clamp(1.2rem, 4vw, 2rem);
            color: #f0f0f0;
            font-style: italic;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.8);
            transform: translateY(30px);
            opacity: 0;
            animation: subtitleFadeIn 1.2s ease-out 4s forwards;
            margin-bottom: 2rem;
        }

        .enter-button {
            padding: 1rem 3rem;
            background: linear-gradient(135deg, #DAA520, #FFD700, #DAA520);
            border: 3px solid #B8860B;
            border-radius: 50px;
            color: #1a0f0a;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transform: translateY(30px) scale(0.8);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            box-shadow:
                0 8px 25px rgba(218, 165, 32, 0.4),
                inset 0 2px 4px rgba(255, 255, 255, 0.3);
            animation: buttonAppear 1s cubic-bezier(0.25, 0.46, 0.45, 0.94) 5s forwards;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .enter-button:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow:
                0 12px 35px rgba(218, 165, 32, 0.6),
                inset 0 2px 4px rgba(255, 255, 255, 0.4);
            background: linear-gradient(135deg, #FFD700, #FFA500, #FFD700);
            border-color: #DAA520;
        }

        .decorative-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            opacity: 0;
            animation: decorationsAppear 1.5s ease-in-out 4.5s forwards;
            z-index: 12;
        }

        .sparkle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: radial-gradient(circle, #FFD700, transparent);
            border-radius: 50%;
            animation: sparkleAnimation 3s ease-in-out infinite;
        }

        .sparkle:nth-child(1) {
            top: 20%;
            left: 20%;
            animation-delay: 0s;
        }

        .sparkle:nth-child(2) {
            top: 30%;
            right: 25%;
            animation-delay: 0.5s;
        }

        .sparkle:nth-child(3) {
            top: 70%;
            left: 15%;
            animation-delay: 1s;
        }

        .sparkle:nth-child(4) {
            top: 60%;
            right: 20%;
            animation-delay: 1.5s;
        }

        .sparkle:nth-child(5) {
            top: 40%;
            left: 10%;
            animation-delay: 2s;
        }

        .sparkle:nth-child(6) {
            top: 80%;
            right: 30%;
            animation-delay: 2.5s;
        }

        .golden-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            opacity: 0;
            animation: particlesReveal 2s ease-in-out 3.5s forwards;
            z-index: 8;
        }

        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: #FFD700;
            border-radius: 50%;
            animation: particleDrift 6s linear infinite;
        }

        /* Animations */
        .curtain-left.open {
            transform: translateX(-100%);
        }

        .curtain-right.open {
            transform: translateX(100%);
        }

        @keyframes spotlightOn {
            0% {
                opacity: 0;
                transform: translateX(-50%) scaleY(0.3);
            }

            100% {
                opacity: 1;
                transform: translateX(-50%) scaleY(1);
            }
        }

        @keyframes titleSlideIn {
            0% {
                opacity: 0;
                transform: translateY(50px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes subtitleFadeIn {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes buttonAppear {
            0% {
                opacity: 0;
                transform: translateY(30px) scale(0.8);
            }

            60% {
                transform: translateY(-5px) scale(1.05);
            }

            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes decorationsAppear {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 0.8;
            }
        }

        @keyframes sparkleAnimation {

            0%,
            100% {
                opacity: 0;
                transform: scale(0);
            }

            50% {
                opacity: 1;
                transform: scale(1.5);
            }
        }

        @keyframes particlesReveal {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 0.6;
            }
        }

        @keyframes particleDrift {
            0% {
                transform: translateY(100vh) translateX(0) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-50px) translateX(50px) rotate(360deg);
                opacity: 0;
            }
        }

        .fade-out-animation {
            animation: fadeOutComplete 1.5s ease-in-out forwards;
        }

        @keyframes fadeOutComplete {
            0% {
                opacity: 1;
                transform: scale(1);
            }

            100% {
                opacity: 0;
                transform: scale(0.95);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .stage-frame {
                top: 2%;
                left: 2%;
                width: 96%;
                height: 96%;
                border-width: 15px;
            }

            .main-title {
                font-size: 2.5rem;
            }

            .subtitle {
                font-size: 1.2rem;
            }

            .enter-button {
                padding: 0.8rem 2rem;
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="entrance-container" id="entranceContainer">
        <div class="stage-frame">
            <div class="stage-content">
                <!-- Éclairage de scène -->
                <div class="stage-lights"></div>

                <!-- Rideau gauche (Jardins) -->
                <div class="curtain-left" id="curtainLeft">
                    <div class="curtain-texture"></div>
                    <div class="curtain-shadow"></div>
                </div>

                <!-- Rideau droit (Architecture) -->
                <div class="curtain-right" id="curtainRight">
                    <div class="curtain-texture"></div>
                    <div class="curtain-shadow"></div>
                </div>

                <!-- Contenu principal -->
                <div class="title-container">
                    <h1 class="main-title">Culture & Patrimoine</h1>
                    <p class="subtitle">Architecture & Jardins de France</p>
                    <button class="enter-button" id="enterButton">Découvrir</button>
                </div>

                <!-- Éléments décoratifs -->
                <div class="decorative-elements">
                    <div class="sparkle"></div>
                    <div class="sparkle"></div>
                    <div class="sparkle"></div>
                    <div class="sparkle"></div>
                    <div class="sparkle"></div>
                    <div class="sparkle"></div>
                </div>

                <!-- Particules dorées -->
                <div class="golden-particles" id="particles"></div>
            </div>
        </div>
    </div>

    <script>
        let animationStarted = false;

        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 25;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 6 + 's';
                particle.style.animationDuration = (4 + Math.random() * 4) + 's';
                particlesContainer.appendChild(particle);
            }
        }

        function startCurtainAnimation() {
            if (animationStarted) return;
            animationStarted = true;

            const curtainLeft = document.getElementById('curtainLeft');
            const curtainRight = document.getElementById('curtainRight');

            // Ouvrir les rideaux après 2 secondes
            setTimeout(() => {
                curtainLeft.classList.add('open');
                curtainRight.classList.add('open');
            }, 2000);
        }

        function finishAnimation() {
            const container = document.getElementById('entranceContainer');
            container.classList.add('fade-out-animation');

            setTimeout(() => {
                container.style.display = 'none';
                document.body.style.overflow = 'auto';
                // Ici vous pouvez afficher le contenu principal de votre site
                console.log('Animation terminée - Site principal visible');
            }, 1500);
        }

        // Initialisation
        document.addEventListener('DOMContentLoaded', () => {
            createParticles();

            // Démarrer l'animation automatiquement
            setTimeout(startCurtainAnimation, 800);

            // Bouton pour continuer
            document.getElementById('enterButton').addEventListener('click', finishAnimation);

            // Auto-progression après 10 secondes
            setTimeout(() => {
                if (document.getElementById('entranceContainer').style.display !== 'none') {
                    finishAnimation();
                }
            }, 10000);
        });

        // Effet de scintillement sur le titre au survol
        document.addEventListener('mousemove', (e) => {
            const title = document.querySelector('.main-title');
            if (title) {
                const rect = title.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                if (x >= 0 && x <= rect.width && y >= 0 && y <= rect.height) {
                    title.style.textShadow = `
                        0 0 20px rgba(255, 215, 0, 1),
                        0 0 40px rgba(255, 215, 0, 0.8),
                        0 0 60px rgba(255, 215, 0, 0.6),
                        0 4px 8px rgba(0, 0, 0, 0.8)
                    `;
                } else {
                    title.style.textShadow = `
                        0 0 20px rgba(255, 215, 0, 0.8),
                        0 0 40px rgba(255, 215, 0, 0.6),
                        0 4px 8px rgba(0, 0, 0, 0.8)
                    `;
                }
            }
        });
    </script>
</body>

</html>