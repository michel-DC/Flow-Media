<style>
    :root {
        --primary-color: #3a791f;
        --secondary-color: #8ac571;
        --text-color: #333;
        --light-bg: #f8f9fa;
        --white: #ffffff;
        --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.1);
        --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.15);
        --shadow-lg: 0 12px 40px rgba(0, 0, 0, 0.2);
        --container-padding: clamp(1.25rem, 5vw, 5rem);
        --section-spacing: clamp(3rem, 8vh, 6rem);
    }

    .newsletter-section {
        background-color: #d4c8b8;
        padding: clamp(1.5rem, 3vh, 2.5rem) 0;
        text-align: center;
    }

    .newsletter-container {
        max-width: clamp(300px, 50vw, 800px);
        margin: 0 auto;
        padding: 0 clamp(1rem, 2vw, 1.25rem);
    }

    .newsletter-content {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: clamp(1rem, 2vw, 1.875rem);
        flex-wrap: wrap;
    }

    .newsletter-title {
        font-size: clamp(1.25rem, 2vw, 1.8rem);
        font-weight: 600;
        color: #444;
    }

    .newsletter-form {
        display: flex;
        align-items: center;
        background-color: var(--white);
        border-radius: 1.875rem;
        padding: 0.5rem;
        box-shadow: var(--shadow-sm);
        width: 100%;
        max-width: clamp(250px, 40vw, 400px);
    }

    .newsletter-input {
        flex-grow: 1;
        border: none;
        outline: none;
        padding: clamp(0.5rem, 1vw, 0.625rem) clamp(1rem, 2vw, 1.25rem);
        font-size: clamp(0.875rem, 1.2vw, 1rem);
        border-radius: 1.875rem 0 0 1.875rem;
    }

    .newsletter-input::placeholder {
        color: #aaa;
    }

    .newsletter-button {
        background-color: #ff5757;
        border: none;
        border-radius: 50%;
        width: clamp(2rem, 3vw, 2.5rem);
        height: clamp(2rem, 3vw, 2.5rem);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .newsletter-button i {
        color: var(--white);
        font-size: clamp(0.875rem, 1.2vw, 1.2rem);
        transform: translateX(1px);
    }

    .newsletter-button:hover {
        background-color: #e04a4a;
    }

    @media (max-width: 600px) {
        .newsletter-content {
            flex-direction: column;
            gap: 20px;
        }

        .newsletter-form {
            max-width: 300px;
        }

        .newsletter-title {
            font-size: 1.5rem;
        }
    }
</style>

<section class="newsletter-section">
    <div class="newsletter-container">
        <div class="newsletter-content">
            <div class="newsletter-title">Newsletter</div>
            <form method="POST" action="" class="newsletter-form">
                <input type="email" name="newsletter_email" class="newsletter-input" placeholder="Ton e-mail" required>
                <button type="submit" name="newsletter_submit" class="newsletter-button">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
</section>