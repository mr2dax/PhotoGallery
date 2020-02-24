<?php
# MVC
define('CONTROLLER', 'index.php');
define('CONTEXT', true);
define('DEBUG', false);

define('CLASSES', 'classes/');
define('VIEW', 'views/');
define('DATA', 'data/');
define('FUNCTIONS', 'functions/');

define('STYLES', 'css/');

define('DEFAULTPAGE', 'welcome.php');
define('ERRORPAGE', 'error.php');
# Nutzerverwaltung
define('USERS', 'etc/passwd.txt');
# Datenbank-Objekteigenschaften, Modell
# Thumbnail-Prefix
define('PREFIX', 'thumb_');
# Thumbnail-Erweiterung
define('EXTENSION', '.tbn');
# max Bildabmessung für Thumbnail (x,y)
define('MAXX', 150);
define('MAXY', 150);
define('ITEMS_PER_ROW', 5);
# Diverses
define('UPLOAD_PLACEHOLDER', 'upload.png');
# Bildvorschau
define('PREVIEWX', 400);
define('PREVIEWY', 300);
define('PREVIEW', 'image.php');
?>
