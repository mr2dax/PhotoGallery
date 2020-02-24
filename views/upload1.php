<?php
/*
# Prolog
#

if(!defined('CONTEXT')) {
  //require '../index.php';
  die (__FILE__ . ' ausserhalb des Kontextes');
}
*/
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <title>Bilder-Upload</title>
  </head>
  <body>
  <h1>Upload Foto</h1>
  <hr>
    <form name=file_upload method=POST accept=image/jpg action=<?php echo CONTROLLER;?> enctype="multipart/form-data">
     <table border="0" cellpadding="0" cellspacing="4">
       <tr>
        <td class="desc_form" align="right">Upload durch: </td>
        <td class="textfield_form"><input name="owner" type="text" size="30" maxlength="30"></td>
       </tr>
       <tr>
        <td class="desc_form" align="right">Erstellungsdatum: </td>
        <td class="textfield_form"><input name="cdate" type="text" size="30" maxlength="30" value="<?php echo date(Y.m.d)?>"</td>
       </tr>
       <tr>
        <td class="desc_form" align="right">Schlüsselwörter: </td>
        <td class="textfield_form"><input name="skeys" type="text" size="30" maxlength="30"></td>
      </tr>
      <tr>
        <td class="desc_form" align="right">Datei: </td>
        <td class="textfield_form"><input name="upload_file" type="file" size="50" maxlength="100000" accept="text/*"></td>
      </tr>
      <tr>
        <td class="desc_form" align="right">Beschreibung: </td>
        <td class="textfield_form"><textarea name="desc" cols="50" rows="5"></textarea></td>
      </tr>
      <tr>
      <td></td>
      <td>
        <input type="submit" value="Absenden">
        <input type="reset" value="Reset">
        <input class="button" type="button" value="Upload" onClick="document.file_upload.submit();">
      </td>
    </tr>
      <td>
        <input type="hidden" name="command" value="process_upload" />
      </td>
    </tr>
  </table>
</form>

  </body>
</html>
