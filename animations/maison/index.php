<script>
    function createHouse() {
        const house = document.createElement('div');
        house.className = 'falling-house';
        house.innerHTML = `
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="4" y="18" width="24" height="8" fill="#b0a17e" stroke="#7c6a4d" stroke-width="2"/>
                <rect x="8" y="12" width="4" height="6" fill="#e6d7b0" stroke="#7c6a4d" stroke-width="1.5"/>
                <rect x="20" y="12" width="4" height="6" fill="#e6d7b0" stroke="#7c6a4d" stroke-width="1.5"/>
                <rect x="14" y="10" width="4" height="8" fill="#d4b58a" stroke="#7c6a4d" stroke-width="1.5"/>
                <polygon points="6,12 10,6 14,12" fill="#b97ff6" stroke="#7c6a4d" stroke-width="1.5"/>
                <polygon points="18,12 22,6 26,12" fill="#b97ff6" stroke="#7c6a4d" stroke-width="1.5"/>
                <rect x="15" y="20" width="2" height="6" fill="#fff" stroke="#7c6a4d" stroke-width="1"/>
                <rect x="12" y="22" width="2" height="4" fill="#fff" stroke="#7c6a4d" stroke-width="1"/>
                <rect x="18" y="22" width="2" height="4" fill="#fff" stroke="#7c6a4d" stroke-width="1"/>
            </svg>
        `;
        const size = Math.random() * 16 + 16;
        const startPosition = Math.random() * window.innerWidth;
        const fallDistance = Math.random() * 100 - 50;
        const duration = Math.random() * 4 + 4;
        house.style.cssText = `
            left: ${startPosition}px;
            width: ${size}px;
            height: ${size}px;
            position: fixed;
            top: -40px;
            pointer-events: none;
            z-index: 9999;
            animation: falling-house-anim ${duration}s linear forwards;
            --fall-distance: ${fallDistance}px;
        `;
        document.body.appendChild(house);
        setTimeout(() => {
            house.remove();
        }, duration * 1000);
    }
    setTimeout(() => {
        const houseInterval = setInterval(createHouse, 120);
        setTimeout(() => {
            clearInterval(houseInterval);
        }, 7000);
    }, 1000);
</script>
<style>
    @keyframes falling-house-anim {
        0% {
            transform: translateY(0) translateX(0) rotate(0deg);
            opacity: 1;
        }

        100% {
            transform: translateY(100vh) translateX(var(--fall-distance)) rotate(360deg);
            opacity: 0;
        }
    }

    .falling-house {
        position: fixed;
        top: -40px;
        will-change: transform;
        pointer-events: none;
        z-index: 9999;
        opacity: 1;
    }
</style>