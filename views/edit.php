<?php

    if (!defined("CONTEXT")) {
        die("Datei ausserhalb des Kontextes");
    }
$title = 'Online-Bildergalerie - Edit';
require VIEW.'navi.php';

$thumbnail = new thumbNail($parameter['item']);
$thumbnail->read();
# Vorschau erzeugen
$x = PREVIEWX;
$y = PREVIEWY;
$aspect = $thumbnail->pwidth/$thumbnail->pheight;
# In Abhängigkeit des Bildseitenverhältnisses Vorschaugröße neu berechnen
# Grösse neu berechnen
if ($aspect > 1) {
  $y = $thumbnail->pheight/$thumbnail->pwidth * $x;
} else {
  $x = $thumbnail->pwidth/$thumbnail->pheight * $y;
}

?>

<h2>Bilder ändern</h2>
        <form name=edit method=POST action="<?php echo CONTROLLER;?>">
        <input type=hidden name="command" value="process_edit" />
        <input type=hidden name="item" value="<?php echo $thumbnail->fullpath; ?>">
        <table>
        <tr><td rowspan=5 class=preview>
        <img src='<?php echo VIEW.PREVIEW."?src=$thumbnail->fullpath&x=$x&y=$y&w=$thumbnail->pwidth&h=$thumbnail->pheight"; ?>'></td>
        
        <tr><td class="desc_form">Bilddatei: </td><td><input class="textfield_form" type="text" name="picname" value="<?php echo $thumbnail->picname; ?>" /></td></tr>
        <tr><td class="desc_form">Upload durch: </td><td><input class="textfield_form" type="text" name="owner" value="<?php echo $thumbnail->owner; ?>" /></td></tr>
        <tr><td class="desc_form">am: </td><td><input class="textfield_form" style="width:100px;" type="text" name="cdate" value="<?php echo $thumbnail->cdate; ?>" /></td></tr>
        <tr><td class="desc_form">Schlüsselwörter: </td><td><input class="textfield_form" type="text" name="skeys" value="<?php echo $thumbnail->skeys; ?>" /></td></tr>
        <tr><td class="desc_form">Beschreibung: </td><td><textarea name="desc" class="textarea_form"><?php echo str_replace('<br>', "\n", $thumbnail->desc); ?></textarea></td></tr>
        <tr><td colspan=2><hr class=spacer></td></tr>
        <tr><td>&nbsp;</td><td><input class="button" type="button" value="Reset" onClick=document.edit.reset();>
        <input class="button" type="button" value="Speichern" onClick="document.edit.submit();"></td></tr>
        <tr><td colspan=2><hr class=spacer></td></tr>
        </table>
        </form>
</body>
</html>
