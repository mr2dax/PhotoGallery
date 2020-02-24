<?php

  if(!defined("CONTEXT")) {
    die("Datei ausserhalb des Kontextes");
  }
$title = 'Online-Bildergalerie - Detailinformationen';
require VIEW.'navi.php';

$thumbnail = new thumbNail($parameter['item']);
$thumbnail->read();
$x = PREVIEWX;
$y = PREVIEWY;
$aspect = $thumbnail->pwidth/$thumbnail->pheight;
# In Abhängigkeit des Bildseitenverhältnisses Vorschaugröße neu berechnen
if ($aspect > 1) {
  $y = $thumbnail->pheight/$thumbnail->pwidth * $x;
} else {
  $x = $thumbnail->pwidth/$thumbnail->pheight * $y;
}
?>

<h2>Detailinformationen</h2>
  <table class="desc_form">
  
    <tr><td rowspan=8 class=preview>
    <img src='<?php echo VIEW.PREVIEW."?src=$thumbnail->fullpath&x=$x&y=$y&w=$thumbnail->pwidth&h=$thumbnail->pheight"; ?>'></td>
    
    <td class="desc_form">Bilddatei: </td><td class="desc_form"><?php echo $thumbnail->picname; ?></td></tr>
    
    <td class="desc_form">Gespeichert unter: </td><td class="desc_form"><?php echo $thumbnail->fullpath; ?></td></tr>
    <td class="desc_form">Dateigrösse: </td><td class="desc_form"><?php echo human_readable_size($thumbnail->fsize); ?></td></tr>
    <td class="desc_form">Bildbreite: </td><td class="desc_form"><?php echo $thumbnail->pwidth; ?></td></tr>
    <td class="desc_form">Bildhöhe: </td><td class="desc_form"><?php echo $thumbnail->pheight; ?></td></tr>
    
    <td class="desc_form">Upload durch: </td><td class="desc_form"><?php echo $thumbnail->owner; ?></td></tr>
    <td class="desc_form">Upload am: </td><td class="desc_form"><?php echo $thumbnail->cdate; ?></td></tr>
    <td class="desc_form">Schlüsselwörter,<br>mit Komma getrennt: </td><td class="desc_form"><?php echo $thumbnail->skeys; ?></td></tr>
    <td class="desc_form">Beschreibung: </td><td class="desc_form"><?php echo $thumbnail->desc; ?></td></tr>
    <tr><td colspan=3><hr class=spacer></td></tr
    <tr><td>&nbsp;</td><td>
    <input class="button" type="button" value="Zurück"
      onClick="document.navi.command.value='back'; document.navi.submit();">
    <input class="button" type="button" value="Ändern"
      onClick="document.navi.command.value='edit'; document.navi.submit();">
    <input class="button" type="button" value="Löschen"
      onClick="document.navi.command.value='delete'; document.navi.submit();"></td></tr>
    <tr><td colspan=3><hr class=spacer></td></tr>
    </table>
    <script type="text/Javascript">
      document.navi.item.value='<?php echo $thumbnail->fullpath; ?>';
    </script>
</body>
</html>
