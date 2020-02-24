<?php

    if (!defined("CONTEXT")) {
        die("Datei ausserhalb des Kontextes");
    }
$title = 'Online-Bildergalerie - Upload';
require VIEW.'navi.php';

?>

<html>
<head>
<title>Bilder-Upload</title>
</head>

<body>
<h2>Bilder-Upload</h2>
        <form name=file_upload method=POST enctype="multipart/form-data" action="<?php echo CONTROLLER;?>">
        <input type=hidden name="command" value="process_upload" />
        <table>
        <tr><td class="desc_form">Bilddatei: </td><td><input class="textfield_form" type="file" name="upload_file" accept="image/jpg" /></td></tr>
        <tr><td class="desc_form">Upload durch: </td><td><input class="textfield_form" type="text" name="owner" /></td></tr>
        <tr><td class="desc_form">am: </td><td><input class="textfield_form" style="width:100px;" type="text" name="cdate" value="<?php echo date('d.m.Y');?>" /></td></tr>
        <tr><td class="desc_form">Schlüsselwörter: </td><td><input class="textfield_form" type="text" name="skeys" /></td></tr>
        <tr><td class="desc_form">Beschreibung: </td><td><textarea name="desc" class="textarea_form"></textarea></td></tr>
        <tr><td colspan=2><hr class=spacer></td></tr>
        <tr><td>&nbsp;</td><td><input class="button" type="button" value="Reset" onClick=document.file_upload.reset();>
        <input class="button" type="button" value="Upload" onClick="document.file_upload.submit();"></td></tr>
        <tr><td colspan=2><hr class=spacer></td></tr>
        </table>
        </form>
</body>
</html>
