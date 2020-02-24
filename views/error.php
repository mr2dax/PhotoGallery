<?php

# Prolog
#
if(!defined('CONTEXT')) {
  //require '../index.php';
  die (__FILE__ . ' ausserhalb des Kontextes');
}
$title = 'Online-Bildergalerie - Fehler';
require VIEW.'navi.php';
?>

<h1>Es ist Fehler aufgetreten.</h1>
<p>
<?php echo $errormessage; ?>
</p>

</body>
</html>
