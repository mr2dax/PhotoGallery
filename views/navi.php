<?php

# Prolog
#
if(!defined('CONTEXT')) {
  //require '../index.php';
  die (__FILE__ . ' ausserhalb des Kontextes');
}
?>
<html>
<head>
<title><?php echo $title; ?></title>
<link rel=stylesheet href="<?php echo STYLES.'main.css'; ?>" type=text/css media=screen>
</head>
<body>
<table width=100%>
<tr><td><hr class=spacer></td></tr>
<tr><td class=banner></td></tr>
<tr><td><hr class=spacer></td></tr>
<tr><td class=navi>
  <table class=navi>
    <tr>
    <td class=separator></td>
    <td class=navi><?php echo $_SESSION['user']; ?> ist eingeloggt...</td>
    <td class=separator></td>
    <td><input type=button value='Galerie' class=button
      onClick="document.navi.command.value='list'; document.navi.submit();">
    </td>
    <?php 
    if ($_SESSION['status'] == 'ok') {
    ?>
      <td class=separator></td>
      <td><input type=button value='Upload' class=button
        onClick="document.navi.command.value='upload'; document.navi.submit();">
      </td>
    <?php
    }
    ?>
    <td class=separator></td>
    <td><input type=button value='Login' class=button
      onClick="document.navi.command.value='login'; document.navi.submit();">
    </td>
    <td class=separator></td>
    <td><input type=button value='Logout' class=button
      onClick="document.navi.command.value='logout'; document.navi.submit();">
    </td>
    <td class=separator></td>
    <td><input type=text name=search class=textfield_nav value='' /></td>
    <td><input type=button value='Suche' class=button
      onClick="document.navi.command.value='search'; document.navi.submit();">
    </td>
    <td class=separator></td>
    </tr>
  </table>
</td></tr>
<tr><td><hr class=spacer></td></tr>
</table>
<form name='navi' action="<?php echo CONTROLLER; ?>" method=POST>
<input type='hidden' name='command' value=''>
<input type='hidden' name='item' value=''>
</form>

</body>
</html>
