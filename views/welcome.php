<?php
include error_reporting(0);
# Prolog
#
if(!defined('CONTEXT')) {
  //require '../index.php';
  die (__FILE__ . ' ausserhalb des Kontextes');
}
$title = 'Online-Bildergalerie - Login';
# require VIEW.'navi.php';
?>

<h1>Login</h1>
<br>
<form name=login method=POST action="<?php echo CONTROLLER; ?>">
<input type=hidden name=command value='login' />
<input type=text name=login /> Nutzername <br>
<input type=password name=passwd /> Passwort <br>
<input type=reset value=Reset><input type=submit value=Login>
</form>
<br><br>
<i>Design und Programmierung von <b>Robert Szeiman</b></i>
<br>
<i>Build v2.1 2010-2012</i>
</body>
</html>
