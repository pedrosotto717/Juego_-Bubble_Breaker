
<?php

require_once 'matrizAleatoria.php';


try {
  if (isset($_COOKIE['matriz'])) {
    $matrizGame = generarMatrizAleatoria(10, 10);
    saveInCokiees($matrizGame);
    unset($_COOKIE['matriz']);
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
