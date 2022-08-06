
<?php

require_once 'matrizAleatoria.php';


try {
  if (isset($_COOKIE['matriz'])) {
    $matrizGame = generarMatrizAleatoria(10, 10);
    saveInCokiees($matrizGame);
    unset($_COOKIE['matriz']);
    unset($_COOKIE['movements']);
    unset($_COOKIE['score']);

    setcookie('score', 0, time() + (86400 * 30), "/");
    setcookie('movements', 0, time() + (86400 * 30), "/");

    $host = $_SERVER['HTTP_HOST'];
    $ruta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $html = 'game.php';
    $url = "http://$host$ruta/$html";
    var_dump($url);
    header("Location: $url");
  }
} catch (\Throwable $th) {
  var_dump($th);
}
