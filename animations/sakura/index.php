<style>
    .sakura-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        pointer-events: none;
        z-index: 1000;
        overflow: hidden;
    }

    .sakura {
        position: absolute;
        width: 25px;
        height: 25px;
        background: #ffb7c5;
        border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
        box-shadow: 0 0 10px rgba(255, 183, 197, 0.3);
        animation: falling linear infinite;
    }

    .sakura::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 5px;
        height: 5px;
        background: #ffb7c5;
        border-radius: 50%;
        transform: translate(-50%, -50%);
        box-shadow: 0 0 5px rgba(255, 183, 197, 0.3);
    }

    .sakura::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #ffb7c5;
        border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
        transform: rotate(45deg);
        box-shadow: 0 0 10px rgba(255, 183, 197, 0.3);
    }

    @keyframes falling {
        0% {
            transform: translate(0, -10%) rotate(0deg) scale(1);
            opacity: 1;
        }

        25% {
            transform: translate(25px, 25vh) rotate(90deg) scale(0.9);
        }

        50% {
            transform: translate(-25px, 50vh) rotate(180deg) scale(0.8);
        }

        75% {
            transform: translate(25px, 75vh) rotate(270deg) scale(0.7);
        }

        100% {
            transform: translate(0, 100vh) rotate(360deg) scale(0.6);
            opacity: 0.8;
        }
    }

    @keyframes swaying {

        0%,
        100% {
            transform: translateX(0) rotate(0deg);
        }

        25% {
            transform: translateX(50px) rotate(5deg);
        }

        75% {
            transform: translateX(-50px) rotate(-5deg);
        }
    }
</style>

<div class="sakura-container"></div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const container = document.querySelector(".sakura-container");
        const sakuraCount = 30;

        function createSakura() {
            const sakura = document.createElement("div");
            sakura.className = "sakura";

            const size = Math.random() * 10 + 20;
            sakura.style.width = `${size}px`;
            sakura.style.height = `${size}px`;

            const startPositionX = Math.random() * window.innerWidth;
            sakura.style.left = `${startPositionX}px`;

            const duration = Math.random() * 10 + 10;
            sakura.style.animation = `falling ${duration}s linear infinite, swaying ${duration/2}s ease-in-out infinite`;

            const delay = Math.random() * 5;
            sakura.style.animationDelay = `-${delay}s`;

            container.appendChild(sakura);
        }

        for (let i = 0; i < sakuraCount; i++) {
            createSakura();
        }

        setInterval(() => {
            const sakuras = document.querySelectorAll(".sakura");
            if (sakuras.length > sakuraCount) {
                container.removeChild(sakuras[0]);
            }
            createSakura();
        }, 500);
    });
</script>