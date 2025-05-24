<style>
    .container-snake {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 40px;
        pointer-events: none;
        z-index: 1;
    }

    .snake {
        position: absolute;
        width: 150px;
        height: 20px;
        background: linear-gradient(to right, #a259e6, #8e44ad);
        border-radius: 10px;
        animation: moveSnake 6s linear infinite;
    }

    .snake::before {
        content: '';
        position: absolute;
        top: -5px;
        left: 15px;
        width: 12px;
        height: 12px;
        background: #a259e6;
        border-radius: 50%;
    }

    .snake::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        height: 1px;
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-50%);
    }

    .snake-body {
        position: absolute;
        width: 100%;
        height: 100%;
        animation: crawl 0.5s infinite;
    }

    @keyframes moveSnake {
        0% {
            transform: translateX(-150px);
        }
        100% {
            transform: translateX(calc(100vw + 150px));
        }
    }

    @keyframes crawl {
        0% {
            transform: translateY(0);
        }
        25% {
            transform: translateY(-2px);
        }
        50% {
            transform: translateY(0);
        }
        75% {
            transform: translateY(2px);
        }
        100% {
            transform: translateY(0);
        }
    }
</style>

<div class="container-snake">
    <div class="snake">
        <div class="snake-body"></div>
    </div>
</div>
