<?php
require_once '../../includes/auth.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlowMedia | Quiz</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="shortcut icon" href="../../assets/icons/logo.png" type="image/x-icon">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f8f8;
            padding: 0;
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            margin-bottom: 80px;
        }

        .quiz-section {
            width: 100%;
            padding: 0 20px;
            margin-top: 80px;
            margin-bottom: 200px;
            flex-grow: 1;
        }

        .quiz-container {
            background-color: #ffffff;
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .quiz-title {
            text-align: center;
            font-size: 20px;
            font-weight: 700;
            color: #000000;
            margin-bottom: 20px;
            font-family: 'Poppins', sans-serif;
        }

        .quiz-question {
            font-size: 18px;
            font-weight: 6;
            color: #000000;
            margin-bottom: 20px;
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        .quiz-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
            margin-bottom: 30px;
            width: 100%;
        }

        .character-container img {
            width: 100px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .answers-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
            width: 100%;
            max-width: 300px;
            margin: 0 auto;
        }

        .answer-button {
            padding: 15px 18px;
            border: none;
            border-radius: 25px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            text-align: center;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
            color: white;
        }

        .answer-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .answer-1 {
            background-color: #C4BAA1;
        }

        .answer-2 {
            background-color: #3A791F;
        }

        .answer-3 {
            background-color: #FF3131;
        }

        .answer-4 {
            background-color: #8E44AD;
        }

        .progress-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
            width: 100%;
        }

        .progress-step {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background-color: #E0E0E0;
            transform: rotate(45deg);
        }

        .progress-step img {
            width: 25px;
            height: 25px;
            transform: rotate(-45deg);
        }

        .progress-step.active {
            background-color: #FF3131;
            box-shadow: 0 0 10px rgba(255, 49, 49, 0.5);
        }

        .progress-line {
            width: 30px;
            height: 4px;
            background-color: #E0E0E0;
            border-radius: 2px;
        }

        .progress-line.completed {
            background-color: #FF3131;
        }

        @media (min-width: 481px) {
            .quiz-section {
                padding: 0 30px;
            }

            .quiz-container {
                border-radius: 25px;
                padding: 50px 40px;
            }

            .quiz-title {
                font-size: 24px;
                margin-bottom: 30px;
            }

            .quiz-question {
                font-size: 20px;
                margin-bottom: 30px;
            }

            .quiz-content {
                gap: 40px;
                margin-bottom: 40px;
                flex-direction: row;
                width: auto;
                justify-content: center;
            }

            .character-container img {
                width: 120px;
                margin: 0;
            }

            .answers-grid {
                grid-template-columns: 1fr 1fr;
                gap: 20px;
                width: auto;
                max-width: none;
                margin: 0;
            }

            .answer-button {
                padding: 18px 20px;
                font-size: 14px;
            }

            .progress-container {
                gap: 15px;
                margin-top: 30px;
                width: auto;
            }

            .progress-step {
                width: 50px;
                height: 50px;
            }

            .progress-step img {
                width: 30px;
                height: 30px;
            }

            .progress-line {
                width: 50px;
            }
        }

        @media (min-width: 769px) {
            .quiz-section {
                max-width: 1300px;
                margin-left: auto;
                margin-right: auto;
                padding: 0 40px;
                margin-top: 80px;
            }

            .quiz-container {
                border-radius: 30px;
                padding: 70px 60px;
            }

            .quiz-title {
                font-size: 28px;
                margin-bottom: 30px;
            }

            .quiz-question {
                font-size: 22px;
                margin-bottom: 40px;
            }

            .quiz-content {
                flex-direction: row;
                gap: 60px;
                margin-bottom: 50px;
                justify-content: center;
            }

            .character-container img {
                width: 150px;
            }

            .answer-button {
                padding: 20px 25px;
                font-size: 16px;
            }

            .answers-grid {
                gap: 20px;
            }

            .progress-container {
                gap: 20px;
                margin-top: 40px;
            }

            .progress-step {
                width: 60px;
                height: 60px;
            }

            .progress-step img {
                width: 35px;
                height: 35px;
            }

            .progress-line {
                width: 80px;
            }
        }

        footer {
            margin-top: auto;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <?php include '../../includes/layout/navbar.php' ?>
    </div>
    <!-- Section quiz -->
    <section class="quiz-section">
        <div class="quiz-container">
            <h1 class="quiz-title">LE MINI JEU : Le Palais Idéal du Facteur Cheval</h1>

            <h2 class="quiz-question">Avec quoi ramassait-il les pierres pour son palais ?</h2>

            <div class="quiz-content">
                <div class="character-container">
                    <img src="../../assets/images/quizz/vert.svg" alt="Character">
                </div>

                <div class="answers-grid">
                    <button class="answer-button answer-1" onclick="selectAnswer(1)">
                        Un camion benne turbo
                    </button>
                    <button class="answer-button answer-2" onclick="selectAnswer(2)">
                        Une brouette, tout simplement
                    </button>
                    <button class="answer-button answer-3" onclick="selectAnswer(3)">
                        Son chapeau
                    </button>
                    <button class="answer-button answer-4" onclick="selectAnswer(4)">
                        Une licorne magique
                    </button>
                </div>
            </div>

            <!-- Barre de progression -->
            <div class="progress-container">
                <div class="progress-step active">
                    <img src="../../assets/images/quizz/loupe.svg" alt="Step 1">
                </div>
                <div class="progress-line completed"></div>
                <div class="progress-step inactive">
                    <img src="../../assets/images/quizz/boussole.svg" alt="Step 2">
                </div>
                <div class="progress-line"></div>
                <div class="progress-step inactive">
                    <img src="../../assets/images/quizz/bouclier.svg" alt="Step 3">
                </div>
            </div>
        </div>
    </section>

    <?php include '../../components/newsletter.php' ?>

    <?php include '../../includes/layout/footer.php' ?>

    <script>
        function selectAnswer(answerNumber) {
            // Retirer la sélection précédente
            document.querySelectorAll('.answer-button').forEach(btn => {
                btn.style.transform = '';
                btn.style.boxShadow = '';
            });

            // Ajouter l'effet de sélection
            const selectedButton = document.querySelector(`.answer-${answerNumber}`);
            selectedButton.style.transform = 'translateY(-3px) scale(1.05)';
            selectedButton.style.boxShadow = '0 8px 25px rgba(0, 0, 0, 0.3)';

            // Simulation de passage à la question suivante après 1.5s
            setTimeout(() => {
                alert(`Réponse ${answerNumber} sélectionnée ! Passage à la question suivante...`);
                // Ici tu peux ajouter la logique pour passer à la question suivante

                // Example: Update progress bar (basic simulation)
                const currentActive = document.querySelector('.progress-step.active');
                if (currentActive) {
                    currentActive.classList.remove('active');
                    currentActive.classList.add('completed');
                    const nextStep = currentActive.nextElementSibling.nextElementSibling;
                    if (nextStep && nextStep.classList.contains('inactive')) {
                        nextStep.classList.remove('inactive');
                        nextStep.classList.add('active');
                        const prevLine = currentActive.nextElementSibling;
                        if (prevLine && prevLine.classList.contains('progress-line')) {
                            prevLine.classList.add('completed');
                        }
                    }
                }

            }, 1500);
        }
    </script>
</body>

</html>