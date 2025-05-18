<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Flow Media - Loading</title>
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600&display=swap" rel="stylesheet">
  <style>
     @import url('https://fonts.googleapis.com/css2?family=Cookie&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    body {
      margin: 0;
      background-color: #000;
      color: #fff;
      font-family: "Cookie", cursive;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      overflow: hidden;
    }

    .loader-text {
      font-size: 10rem;
      font-weight: 600;
      letter-spacing: 2px;
      animation: fadeInOut 3s ease-in-out forwards;
    }

    @keyframes fadeInOut {
      0% { opacity: 0; transform: scale(0.8); }
      25% { opacity: 1; transform: scale(1); }
      75% { opacity: 1; transform: scale(1); }
      100% { opacity: 0; transform: scale(1.1); }
    }
  </style>
</head>
<body>
  <div class="loader-text">Flow Media</div>

  <script>
    setTimeout(() => {
      window.location.href = "home.php";
    }, 2000);
  </script>
</body>
</html>
