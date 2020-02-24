<?php

include error_reporting(0);


# Prolog
#
if(!defined('CONTEXT')) {
  //require '../index.php';
  die (__FILE__ . ' ausserhalb des Kontextes');
}
$title = 'Online-Bildergalerie - Listenansicht';
require VIEW.'navi.php';

$files = glob(DATA.'*'.EXTENSION);
$count = 0;
echo "<table cellspacing=10><tr>\n";
foreach($files as $file) {
  $picture = substr($file, 0, -strlen(EXTENSION));
  $thumbnail = new thumbNail($picture);
  $thumbnail->read();

  if (($count % ITEMS_PER_ROW == 0) && ($count > 0)) {
    echo '</tr><tr>';
  }
  echo "<td class=thumb><a href='" . CONTROLLER . '?command=info' . 
       "&item=" . $thumbnail->fullpath . "'>" . 
       "<img src=" . $thumbnail->fullthumb . ' border=0></a>';
  echo '<br>' . $thumbnail->picname . '<br>' . human_readable_size($thumbnail->fsize);
  echo "</td>\n";
  $count++;
}
echo "</tr></table>";
echo "</body></html>";

?>
