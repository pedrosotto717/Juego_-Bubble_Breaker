<?php

function isArrayContains($array, $x, $y)
{

  try {
    for ($i = 0; $i < count($array); $i++) {
      if (isset($array[$i]['x']) && isset($array[$i]['y'])) {
        if ($array[$i]['x'] == $x && $array[$i]['y'] == $y) {
          return true;
        }
      }
    }

    return false;
  } catch (\Throwable $th) {
    echo "<pre>";
    var_dump($th);
    echo "</pre>";
    // return false;
  }
}

// function 


function isBubble($matriz, $x, $y)
{
  try {
    if ($matriz[$x][$y] == 0) {
      return false;
    }

    if (isset($matriz[$x - 1][$y]))
      if ($matriz[$x][$y] == $matriz[$x - 1][$y])
        return true;

    if (isset($matriz[$x + 1][$y]))
      if ($matriz[$x][$y] == $matriz[$x + 1][$y])
        return true;

    if (isset($matriz[$x][$y - 1]))
      if ($matriz[$x][$y] == $matriz[$x][$y - 1])
        return true;

    if (isset($matriz[$x][$y + 1]))
      if ($matriz[$x][$y] == $matriz[$x][$y + 1])
        return true;

    return false;
  } catch (\Throwable $th) {
    echo "<pre>";
    var_dump($th);
    echo "</pre>";
  }
}

function isEquals($matriz, $x, $y, $dx, $dy)
{
  if (isset($matriz[$dx][$dy]))
    if ($matriz[$x][$y] == $matriz[$dx][$dy])
      return true;

  return false;
}

function getBubble(&$matriz, &$visited, $x, $y)
{
  try {
    $positions = [];

    if (
      isEquals($matriz, $x, $y, $x, $y + 1)
      && !isArrayContains($visited, $x, $y + 1)
    ) {
      // echo "derecha";
      $positions[] = [
        'x' => $x,
        'y' => $y + 1
      ];
      $visited[] = [
        'x' => $x,
        'y' => $y + 1
      ];
    }

    if (
      isEquals($matriz, $x, $y, $x, $y - 1)
      && !isArrayContains($visited, $x, $y - 1)
    ) {
      // echo "izquierda";
      $positions[] = [
        'x' => $x,
        'y' => $y - 1
      ];
      $visited[] = [
        'x' => $x,
        'y' => $y - 1
      ];
    }

    if (
      isEquals($matriz, $x, $y, $x + 1, $y)
      && !isArrayContains($visited, $x + 1, $y)
    ) {
      // echo "abajo";
      $positions[] = [
        'x' => $x + 1,
        'y' => $y
      ];
      $visited[] = [
        'x' => $x + 1,
        'y' => $y
      ];
    }

    if (
      isEquals($matriz, $x, $y, $x - 1, $y)
      && !isArrayContains($visited, $x - 1, $y)
    ) {
      // echo "arriba";
      $positions[] = [
        'x' => $x - 1,
        'y' => $y
      ];
      $visited[] = [
        'x' => $x - 1,
        'y' => $y
      ];
    }

    return $positions;
  } catch (\Throwable $th) {
    echo "<pre>";
    var_dump($th);
    echo "</pre>";
  }
}


function correrFicha(&$matriz, $y)
{
  for ($i = count($matriz[$y]); $i >= 0; $i--) {
    if (isset($matriz[$i][$y])) {
      if ($matriz[$i][$y] == 0 && isset($matriz[$i - 1][$y])) {
        if ($matriz[$i - 1][$y] != 0) {
          $matriz[$i][$y] = $matriz[$i - 1][$y];
          $matriz[$i - 1][$y] = 0;
        }
      }
    }
    // var_dump($matriz[$i][$y]);
  }
}


function faltaCorrer($matriz)
{
  try {
    $acumulador = 0;
    $posX = -1;
    $falta = false;

    for ($j = count($matriz[0]); $j >= 0; $j--) {
      for ($i = count($matriz[0]); $i >= 0; $i--) {
        if (isset($matriz[$i][$j])) {
          if ($matriz[$i][$j] == 0) {
            if ($posX == -1) {
              $posX = $i;
            }
            $acumulador += 1;
          }
        }
      }

      if (($acumulador - $posX != 1)
        && ($acumulador > 0)
        && ($posX != -1)
        && ($posX != 0)
      ) {
        $falta = true;
      }
      $posX = -1;
      $acumulador = 0;
    }

    return $falta;
  } catch (\Throwable $th) {
    // var_dump($th);
    return false;
  }
}
