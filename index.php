<?php

include error_reporting(0);

require 'config.php';
require CLASSES.'thumbNail.class.php';
require FUNCTIONS.'stuff.php';

# Session starten bzw. Session-Daten zurücklesen
session_start();

if (!$_SESSION['status'] || $_SESSION['status'] == 'failed') {
  $parameter['command']='login';
}

$parameter = array_merge($_GET, $_POST);
$parameter = clearing_input($parameter);

if (DEBUG) {
  echo '<pre>';
  var_dump($parameter);
  echo'</pre>';
}
switch($parameter['command']) {
  # Login
  case 'login':
    $_SESSION['status'] = 'failed';
    $users = file(USERS);
    foreach($users as $line) {
      list ($user, $pass) = explode(':', chop($line));
      if ($user==$parameter['login'] && $pass==md5($parameter['passwd'])) {
        $_SESSION['status'] = 'ok';
        $_SESSION['user'] = $user;
        $_SESSION['attempts'] = 1;
        break;
      }
    }
    if ($_SESSION['status']=='ok') {
      require VIEW.'list.php';
    } else {
      $_SESSION['attempts']++;
      if ($_SESSION['attempts'] > 3) {
        sleep(10);
      }
      require VIEW.DEFAULTPAGE;
    }
    break;
  case 'logout':
    session_destroy();
    # Cookies löschen
    $cookie = session_get_cookie_params();
    setcookie(session_name(), "", 0, $cookie['path'], $cookie['domain']);
    require VIEW.DEFAULTPAGE;
    break;
  # Listen-/Thumbnailansicht
  case 'list':
    require VIEW.'list.php';
    //echo 'Listenansicht';
    break;
  case 'upload':
    require VIEW.'upload.php';
    //echo 'Upload-Seite';
    break;
  case 'back':
    require VIEW.'list.php';
    //echo 'Listenansicht';
    break;
  case 'search':
    echo "PVL";
    break;
  case 'process_upload':
  if (!$_FILES['upload_file']['error']) {
      $filestamp = date("ymdHis").'.jpg';
      move_uploaded_file($_FILES['upload_file']['tmp_name'], DATA.$filestamp);
      chmod(DATA.$filestamp, 0644);
      $imageprops=getimagesize(DATA.$filestamp);
      
      /*
      echo '<pre>';
      var_dump($imageprops);
      echo '</pre>';
      */
      if($imageprops[2] != 2) {
        unlink(DATA.$filestamp);
        $errormessage = "Die hochgeladene Datei ist kein JPG-Bild.";
        require VIEW.ERRORPAGE;
      }
      #Objektinstanz erzeugen
      $thumbnail = new thumbNail(DATA.$filestamp, $_FILES['upload_file']['name']);
      if(DEBUG) {
        echo '<pre>';
        var_dump($thumbnail);
        echo'</pre>';
      }
      $thumbnail->owner = $parameter['owner'];
      $thumbnail->cdate = $parameter['cdate'];
      $thumbnail->skeys = $parameter['skeys'];
      $thumbnail->desc = $parameter['desc'];
      $thumbnail->create();
      require VIEW.'list.php';
    } else {
      $errormessage = "Beim Upload der Datei ist ein Fehler aufgetreten.";
      require VIEW.ERRORPAGE;
    }
    break;
  case 'info':
    require VIEW.'info.php';
    break;
  case 'delete':
    $thumbnail = new thumbNail($parameter['item']);
    $thumbnail->delete();
    require VIEW.'list.php';
    // echo "löschen: " . $parameter['item'];
    break;
  case 'edit':
    //echo "bearbeiten: " . $parameter['item'];
    require VIEW.'edit.php';
    break;
    # Bilder, Matedaten ändern, Abschluss der Änderungen
  case 'process_edit':
      $thumbnail = new thumbNail($parameter['item']);
      $thumbnail->picname = $parameter['picname'];
      $thumbnail->owner = $parameter['owner'];
      $thumbnail->cdate = $parameter['cdate'];
      $thumbnail->skeys = $parameter['skeys'];
      $thumbnail->desc = $parameter['desc'];
      $thumbnail->update();
      require VIEW.'list.php';
    break;
  # alles andere
  default:
    require VIEW.DEFAULTPAGE;
}

?>
