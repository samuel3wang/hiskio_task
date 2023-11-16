<?php
// Problem 1 - Climbing Stairs

// 第三層開始，每一層的走法都是前兩層的走法總和

function climbingStairs($n) {

  if ($n <= 0) {
      return 'The number of stairs must be greater than 0';
  }

  $step = [];
  $step[1] = 1;
  $step[2] = 2;

  for ($i = 3; $i <= $n; $i++) {
      $step[$i] = $step[$i - 1] + $step[$i - 2];
  }
  return $step[$n];
}
