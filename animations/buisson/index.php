<style>
    .container-flower {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        pointer-events: none;
        z-index: 1000;
    }

    .branch {
        position: absolute;
        top: 0;
        width: 8px;
        height: 0;
        background: linear-gradient(to bottom, #27ae60, #2ecc71);
        border-radius: 4px;
        animation: growBranch 3s ease-out forwards;
    }

    .branch.left {
        left: 15%;
        transform-origin: top center;
        animation: growBranchLeft 4s ease-out forwards;
    }

    .branch.right {
        right: 15%;
        transform-origin: top center;
        animation: growBranchRight 4s ease-out forwards;
    }

    .leaf {
        position: absolute;
        width: 30px;
        height: 15px;
        background: linear-gradient(45deg, #2ecc71, #27ae60);
        border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
        opacity: 0;
        transform-origin: left center;
    }

    .branch.left .leaf {
        transform-origin: right center;
    }

    @keyframes growBranchLeft {
        0% {
            height: 0;
            transform: rotate(0deg);
        }

        20% {
            height: 20vh;
            transform: rotate(-5deg);
        }

        40% {
            height: 40vh;
            transform: rotate(5deg);
        }

        60% {
            height: 60vh;
            transform: rotate(-3deg);
        }

        80% {
            height: 80vh;
            transform: rotate(2deg);
        }

        100% {
            height: 100vh;
            transform: rotate(0deg);
        }
    }

    @keyframes growBranchRight {
        0% {
            height: 0;
            transform: rotate(0deg);
        }

        20% {
            height: 20vh;
            transform: rotate(5deg);
        }

        40% {
            height: 40vh;
            transform: rotate(-5deg);
        }

        60% {
            height: 60vh;
            transform: rotate(3deg);
        }

        80% {
            height: 80vh;
            transform: rotate(-2deg);
        }

        100% {
            height: 100vh;
            transform: rotate(0deg);
        }
    }

    @keyframes growLeaf {
        0% {
            opacity: 0;
            transform: scale(0) rotate(var(--rotation));
        }

        50% {
            opacity: 1;
            transform: scale(1.2) rotate(var(--rotation));
        }

        100% {
            opacity: 1;
            transform: scale(1) rotate(var(--rotation));
        }
    }
</style>

<div class="container-flower">
    <div class="branch left"></div>
    <div class="branch right"></div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const branches = document.querySelectorAll(".branch");
        const leafCount = 12;
        const spacing = 100;

        branches.forEach(branch => {
            for (let i = 0; i < leafCount; i++) {
                const leaf = document.createElement("div");
                leaf.className = "leaf";
                const rotation = Math.random() * 60 - 30;
                leaf.style.setProperty('--rotation', `${rotation}deg`);
                leaf.style.top = `${i * spacing}px`;

                if (branch.classList.contains('left')) {
                    leaf.style.right = `${Math.random() * 20 - 10}px`;
                } else {
                    leaf.style.left = `${Math.random() * 20 - 10}px`;
                }

                leaf.style.animation = `growLeaf 1s ease-out forwards ${i * 0.3}s`;
                branch.appendChild(leaf);
            }
        });
    });
</script>