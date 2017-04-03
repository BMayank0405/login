<?php
  session_start();
  header('Content-Type:image/png');

  $chars = "012345678901234567abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $text = '';

  for ($i = 0; $i < 6; $i++)
  {
      $text .= $chars[rand(0, strlen($chars)-1)];
  }



  $_SESSION['captcha'] = $text;
$im = imagecreatetruecolor(130,32);

// Create some colors
$white = imagecolorallocate($im, 220,220,220);
$grey = imagecolorallocate($im, 128, 128, 128);

$dim_grey = imagecolorallocate($im, 105,105,105);
$black = imagecolorallocate($im, 0, 0, 0);
imagefilledrectangle($im, 0, 0, 399, 32, $white);
$font = '/usr/share/fonts/LobsterTwo-Italic.ttf';

// Replace path by your own font path

// Add some shadow to the text
imagettftext($im, 20, 0, 13, 25, $grey, $font, $text);
imagettftext($im, 20, 0, 14, 26, $dim_grey, $font, $text);
// Add the text
imagettftext($im, 20, 0, 12, 24, $black, $font, $text);

// Using imagepng() results in clearer text compared with imagejpeg()
imagepng($im);
imagedestroy($im);


?>
