<?php

// generate matrix with random numbers
function generarMatrizAleatoria($filas, $columnas)
{
  $matriz = array();
  for ($i = 0; $i < $filas; $i++) {
    for ($j = 0; $j < $columnas; $j++) {
      $matriz[$i][$j] = rand(1, 6) * 10;
    }
  }
  return $matriz;
}


function saveInCokiees($matriz)
{
  $matrizString = json_encode($matriz);
  setcookie('matriz', $matrizString, time() + (86400 * 30), "/");
}

function getFromCokiees()
{
  $matrizString = $_COOKIE['matriz'];
  $matriz = json_decode($matrizString, true);
  return $matriz;
}
