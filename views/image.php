<?php
  $x = $_GET['x'];
  $y = $_GET['y'];
  $h = $_GET['h'];
  $w = $_GET['w'];
  $src = $_GET['src'];
  
  # Quelle und Vorschau in RAM anlegen
  $ram_src = imagecreatefromjpeg('../'.$src);
  $ram_preview = imagecreatetruecolor($x, $y);
  imagecopyresampled($ram_preview, $ram_src, 0, 0, 0, 0, $x, $y, $w, $h);
  #Bild ausgeben, Speicher freigeben 
  imagejpeg($ram_preview);
  imagedestroy($ram_preview); 
  imagedestroy($ram_src); 
?>
