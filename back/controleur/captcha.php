<?php

/*
 * @link http://phpform.net/math_captcha.php
 */





session_start();

// value 1


$img = imagecreate(100, 20);

$black = imagecolorallocate($img, 0, 0, 255);
$numberOne = rand(10, 30);
$numberTwo = rand(12, 18);

$numero = $numberOne + $numberTwo;

$maths = $numberOne . ' + ' . $numberTwo;




$_SESSION['check'] = ($numero);
$white = imagecolorallocate($img, 255, 255, 255);
imagestring($img, 10, 8, 3, $maths, $white);
header("Content-type: image/png");
imagepng($img);
