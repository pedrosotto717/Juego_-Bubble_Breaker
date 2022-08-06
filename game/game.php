<?php

define('AMARILLO', 10);
define('VERDE', 20);
define('ROJO', 30);
define('AZUL', 40);
define('MORADO', 50);
define('NARANJA', 60);

require_once './matrizAleatoria.php';
require_once './logic.php';
$gameOver = false;
$cantidadPelotas = 0;
// setCokiee game if not exists
if (!isset($_COOKIE['matriz'])) {
  $matrizGameInit = generarMatrizAleatoria(10, 10);
  saveInCokiees($matrizGameInit);
} else {
  $matrizGameInit = getFromCokiees();
}

if (isset($_COOKIE['score'])) {
  $score = $_COOKIE['score'];
} else {
  $score = 0;
}

if (isset($_GET['x']) && isset($_GET['y'])) {
  $matrizGame = getFromCokiees();
  $x = (int) $_GET['x'];
  $y = (int) $_GET['y'];
  $positions = [];
  $visited = [];


  if (isBubble($matrizGame, $x, $y)) {

    if (isset($_COOKIE['movements'])) {
      $movements = $_COOKIE['movements'];
      $movements++;
      setcookie('movements', $movements, time() + (86400 * 30), "/");
    } else {
      $movements = 1;
      setcookie('movements', $movements, time() + (86400 * 30), "/");
    }

    $pos = 0;
    $positions[] = [
      'x' => $x, // 3
      'y' => $y // 0
    ];

    $visited[] = [
      'x' => $x, // 3
      'y' => $y // 0
    ];

    while ($pos < count($positions)) {
      $position = $positions[$pos];

      if (isBubble($matrizGame, $position['x'], $position['y']))
        $positions = array_merge($positions, getBubble($matrizGame, $visited, $position['x'], $position['y']));

      $pos++;
    }

    $cantidadPelotasSet = count($positions);
    $scoreSet = $cantidadPelotasSet * ($cantidadPelotasSet - 1);

    if (isset($_COOKIE['score'])) {
      $score = $_COOKIE['score'];
      $score += $scoreSet;
    } else {
      $score = $scoreSet;
    }

    for ($i = 0; $i < count($positions); $i++) {
      $matrizGame[$positions[$i]['x']][$positions[$i]['y']] = 0;
    }

    //correr fichas
    while (faltaCorrer($matrizGame)) {
      for ($j = 0; $j < count($matrizGame); $j++) {
        correrFicha($matrizGame, $j);
      }
    }

    saveInCokiees($matrizGame);
    setcookie('score', $score, time() + (86400 * 30), "/");
    setcookie('pelotas', $cantidadPelotas, time() + (86400 * 30), "/");
  }


  if ($score > 100) {
    $c = 0;
    for ($j = 0; $j < count($matrizGame[0] ?? []); $j++) {
      for ($i = 0; $i < count($matrizGame ?? []); $i++) {
        if (isBubble($matrizGame, $i, $j))
          $c++;
      }
    }


    if ($c == 0) {
      $gameOver = true;
    }
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.11.0/build/cssnormalize/cssnormalize-min.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./../styles/main.css">
  <link rel="stylesheet" href="./../styles/game.css">
  <title>Bubble Breaker</title>
</head>

<body>
  <div class="container">
    <nav class="menu">
      <h1>Bubble Breaker </h1>
      <ul class="menu-list">
        <a href="/game/reset.php">Reiniciar</a>
        <a href="/">Salir</a>
      </ul>
    </nav>

    <div class="score-container">
      <section class="scores">
        <p>Puntaje: <?= $score ?? $_COOKIE['score'] ?></p>
        <p>Intentos: <?= $movements ?? $_COOKIE['movements'] ?></p>
        <?= $gameOver ? "<p class='game-over'> GAME OVER </p>" : ""   ?>
      </section>
    </div>

    <div class="board-container">
      <section class="board">
        <?php
        $matriz = $matrizGame ?? getFromCokiees();
        ?>

        <?php for ($i = 0; $i < count($matriz); $i++) : ?>
          <?php for ($j = 0; $j < count($matriz[$i]); $j++) : ?>
            <div class="cell" data-color="<?php echo $matriz[$i][$j]; ?>" data-pos-x="<?= $i ?>" data-pos-y="<?= $j ?>">
            </div>
          <?php endfor; ?>
        <?php endfor; ?>
      </section>
    </div>
  </div>
  <script src="./../scripts/game.js"></script>
</body>

</html>