<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chargement | Flow Media</title>
    <link rel="shortcut icon" href="/assets/icons/logo.png" type="image/x-icon">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
        }

        .loading-container {
            position: relative;
            width: 100vw;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .video-container {
            width: 100%;
            height: 100%;
            position: relative;
        }

        video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .loading-text {
            position: absolute;
            bottom: 20%;
            left: 50%;
            transform: translateX(-50%);
            color: #000000;
            font-size: 24px;
            font-weight: 500;
            text-align: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            opacity: 0;
            animation: fadeIn 1s ease-in forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .loading-text {
                font-size: 18px;
                bottom: 15%;
            }
        }
    </style>
</head>

<body>
    <div class="loading-container">
        <div class="video-container">
            <video autoplay muted playsinline id="loadingVideo">
                <source src="/animations/loader/animation.mp4" type="video/mp4">
                Votre navigateur ne supporte pas la lecture de vidéos.
            </video>
        </div>
        <div class="loading-text">Chargement en cours...</div>
    </div>

    <script>
        const video = document.getElementById('loadingVideo');
        let playCount = 0;

        video.addEventListener('ended', () => {
            playCount++;
            if (playCount < 2) {
                video.play();
            } else {
                window.location.href = '../../index.php';
            }
        });

        // Redirection après 3 secondes
        setTimeout(() => {
            window.location.href = 'home.php';
        }, 3000);
    </script>
</body>

</html>