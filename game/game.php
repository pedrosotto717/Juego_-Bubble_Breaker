<?php

define('AMARILLO', 10);
define('VERDE', 20);
define('ROJO', 30);
define('AZUL', 40);
define('MORADO', 50);
define('NARANJA', 60);

require_once './matrizAleatoria.php';
require_once './logic.php';

// setCokiee game if not exists
if (!isset($_COOKIE['matriz'])) {
  $matrizGame = generarMatrizAleatoria(10, 10);
  saveInCokiees($matrizGame);
} else {
  $matrizGame = getFromCokiees();
}



if (isset($_GET['x']) && isset($_GET['y'])) {
  $x = (int) $_GET['x'];
  $y = (int) $_GET['y'];
  if (isBubble($matrizGame, $x, $y)) {
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

      if (isBubble($matrizGame, $position['x'], $position['y'])) {
        $positions = array_merge($positions, getBubble($matrizGame, $visited, $position['x'], $position['y']));
      }
      $pos++;
    }

    echo "<pre>";
    var_dump($positions);
    echo "</pre>";
    exit;

    // $positions = array_merge($positions, getBubble($matrizGame, $x, $y));

    // $positions = getBubble($matrizGame, $x, $y);
    // saveInCokiees($matrizGame);
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
    <h1>Bubble Breaker </h1>
    <a href="/game/reset.php">Reiniciar</a>

    <div class="board-container">
      <section class="board">
        <?php
        $matriz = getFromCokiees();
        ?>
        <?php for ($i = 0; $i < count($matriz); $i++) : ?>
          <?php for ($j = 0; $j < count($matriz[$i]); $j++) : ?>
            <div class="cell" data-color="<?php echo $matriz[$i][$j]; ?>" data-pos-x="<?= $i ?>" data-pos-y="<?= $j ?>">
              <?php echo $matriz[$i][$j]; ?>
            </div>
          <?php endfor; ?>
        <?php endfor; ?>
      </section>
    </div>
  </div>
  <script src="./../scripts/game.js"></script>
</body>

</html>