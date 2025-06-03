<?php
require_once '../../includes/auth.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

$query = "SELECT * FROM activites WHERE id = " . $_GET['id'];
$result = mysqli_query($link, $query);
$activity = mysqli_fetch_assoc($result);

if (!$activity) {
    header('Location: index.php');
    exit;
}

// Vérifier si l'utilisateur a déjà fait ce quiz
$user_id = $_SESSION['user_id'];
$check_query = "SELECT * FROM point_user WHERE user_id = $user_id AND activite_id = " . $_GET['id'];
$check_result = mysqli_query($link, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    // L'utilisateur a déjà fait ce quiz
    $points = mysqli_fetch_assoc($check_result)['nombre_point'];
    $quiz_completed = true;
} else {
    $quiz_completed = false;
    $points = 0;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flow Media | Quiz</title>
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

        .message {
            padding: 12px;
            border-radius: 4px;
            margin: 10px auto;
            text-align: center;
            width: 90%;
            max-width: 400px;
            position: fixed;
            top: 100px;
            left: 50%;
            transform: translateX(-50%);
            animation: fadeOut 5s forwards;
            font-size: 14px;
            z-index: 10;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                display: none;
            }
        }

        .quit-button {
            background-color: #FF3131;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 15px 30px;
            margin-top: 20px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
            margin: 20px auto 0 auto;
            text-decoration: none;
            width: fit-content;
        }

        .quit-button:hover {
            background-color: #e02828;
            transform: translateY(-2px);
        }

        .quit-button i {
            font-size: 18px;
        }

        @media (max-width: 768px) {
            .quit-button {
                padding: 12px 25px;
                font-size: 15px;
                margin: 0 auto 10px auto;
            }
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
                <div class="progress-step inactive" id="step-1">
                    <img src="../../assets/images/quizz/loupe.svg" alt="Step 1">
                </div>
                <div class="progress-line" id="line-1"></div>
                <div class="progress-step inactive" id="step-2">
                    <img src="../../assets/images/quizz/boussole.svg" alt="Step 2">
                </div>
                <div class="progress-line" id="line-2"></div>
                <div class="progress-step inactive" id="step-3">
                    <img src="../../assets/images/quizz/bouclier.svg" alt="Step 3">
                </div>
            </div>
        </div>
        <a href="details.php?id=<?php echo $_GET['id']; ?>" class="quit-button">
            <i class="fas fa-times"></i>
            Quitter le jeu
        </a>
    </section>

    <?php include '../../components/newsletter.php' ?>

    <?php include '../../includes/layout/footer.php' ?>

    <div id="quiz-error" class="message error" style="display:none;"></div>

    <script>
        // Questions du quiz
        const questions = [{
                title: "LE MINI JEU : Le Palais Idéal du Facteur Cheval",
                question: "Avec quoi ramassait-il les pierres pour son palais ?",
                answers: [
                    "Un camion benne turbo",
                    "Une brouette, tout simplement",
                    "Son chapeau",
                    "Une licorne magique"
                ],
                correct: 2
            },
            {
                title: "Question 2",
                question: "Combien d'années a-t-il fallu pour construire le Palais Idéal ?",
                answers: [
                    "5 ans",
                    "10 ans",
                    "33 ans",
                    "50 ans"
                ],
                correct: 3
            },
            {
                title: "Question 3",
                question: "Quel est le style architectural du Palais Idéal ?",
                answers: [
                    "Baroque",
                    "Architecture naïve",
                    "Gothique",
                    "Renaissance"
                ],
                correct: 2
            }
        ];

        let currentQuestion = 0;
        let points = 0;
        let steps = [
            document.getElementById('step-1'),
            document.getElementById('step-2'),
            document.getElementById('step-3')
        ];
        let lines = [
            document.getElementById('line-1'),
            document.getElementById('line-2')
        ];

        <?php if ($quiz_completed): ?>
            // Si le quiz est déjà complété, afficher les points
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelector('.quiz-title').textContent = 'Quiz déjà complété';
                document.querySelector('.quiz-question').textContent = `Vous avez obtenu ${<?php echo $points; ?>} points sur ${questions.length}`;
                document.querySelector('.quiz-content').style.display = 'none';
                document.querySelector('.progress-container').style.display = 'none';
            });
        <?php else: ?>

            function showQuestion(index) {
                // Met à jour le titre et la question
                document.querySelector('.quiz-title').textContent = questions[index].title;
                document.querySelector('.quiz-question').textContent = questions[index].question;
                // Met à jour les réponses
                const answers = document.querySelectorAll('.answer-button');
                answers.forEach((btn, i) => {
                    btn.textContent = questions[index].answers[i];
                    btn.disabled = false;
                    btn.style.transform = '';
                    btn.style.boxShadow = '';
                });
                // Efface l'erreur
                document.getElementById('quiz-error').style.display = 'none';
                // Met à jour les steps
                steps.forEach((step, i) => {
                    if (step.classList.contains('completed')) return;
                    step.classList.remove('active', 'inactive');
                    if (i === index) {
                        step.classList.add('active');
                    } else {
                        step.classList.add('inactive');
                    }
                });
            }

            function selectAnswer(answerNumber) {
                const q = questions[currentQuestion];
                if (answerNumber === q.correct) {
                    // Bonne réponse
                    points++;
                    steps[currentQuestion].classList.remove('inactive', 'active');
                    steps[currentQuestion].classList.add('completed');
                    if (currentQuestion > 0) {
                        lines[currentQuestion - 1].classList.add('completed');
                    }
                    // Désactive les boutons
                    document.querySelectorAll('.answer-button').forEach(btn => btn.disabled = true);
                    setTimeout(() => {
                        currentQuestion++;
                        if (currentQuestion < questions.length) {
                            showQuestion(currentQuestion);
                        } else {
                            // Quiz terminé
                            steps.forEach((step) => step.classList.remove('active'));
                            document.querySelector('.quiz-title').textContent = 'Quiz terminé !';
                            document.querySelector('.quiz-question').textContent = `Vous avez obtenu ${points} points sur ${questions.length}`;
                            document.querySelector('.quiz-content').style.display = 'none';
                            document.getElementById('quiz-error').style.display = 'none';

                            // Envoyer les points au serveur
                            fetch('save_points.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded',
                                },
                                body: `points=${points}&activite_id=<?php echo $_GET['id']; ?>`
                            });
                        }
                    }, 900);
                } else {
                    // Mauvaise réponse
                    const error = document.getElementById('quiz-error');
                    error.textContent = '❌ Mauvaise réponse, vous ne pouvez pas réessayer cette question.';
                    error.style.display = 'block';
                    error.style.animation = 'none';
                    error.offsetHeight; // Force reflow
                    error.style.animation = 'fadeOut 5s forwards';

                    // Désactive les boutons
                    document.querySelectorAll('.answer-button').forEach(btn => btn.disabled = true);

                    // Passe à la question suivante après un délai
                    setTimeout(() => {
                        currentQuestion++;
                        if (currentQuestion < questions.length) {
                            showQuestion(currentQuestion);
                        } else {
                            // Quiz terminé
                            steps.forEach((step) => step.classList.remove('active'));
                            document.querySelector('.quiz-title').textContent = 'Quiz terminé !';
                            document.querySelector('.quiz-question').textContent = `Vous avez obtenu ${points} points sur ${questions.length}`;
                            document.querySelector('.quiz-content').style.display = 'none';
                            document.getElementById('quiz-error').style.display = 'none';

                            // Envoyer les points au serveur
                            fetch('save_points.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded',
                                },
                                body: `points=${points}&activite_id=<?php echo $_GET['id']; ?>`
                            });
                        }
                    }, 2000);
                }
            }

            // Initialisation
            document.addEventListener('DOMContentLoaded', function() {
                // Ajoute les events sur les boutons
                document.querySelectorAll('.answer-button').forEach((btn, i) => {
                    btn.onclick = function() {
                        selectAnswer(i + 1);
                    };
                });
                // Affiche la première question
                showQuestion(0);
            });
        <?php endif; ?>
    </script>
</body>

</html>