<?php
class thumbNail {
  # programgenerierte Eigenschaften
  var $picname;     # Originalname der Bilddatei
  var $fullpath;    # Pfad + Name der hochgeladene Bilddatei
  var $fullthumb;   # Pfad + Name des Thumbnails
  var $fsize;       # Dateigrösse des Originals
  var $pwidth;      # Bildbreite Original
  var $pheight;     # Bildhöhe Original
  var $exifdata;    # Exif-Daten (Kamera)
  
  # benutzergenerierte Daten
  var $owner;       # Eigentümer (Uploader)  
  var $cdate;       # Upload-Datum
  var $skeys;       # Suchbegriffe, Schlüsselwörter
  var $desc;        # Bildbescreibung
  
  #intern verwendete Eigenschaften (private)
  # Datensatzlänge
  var $rlength;
  
  function thumbNail($picture, $name='') {
    # Bildeigenschaften (Breite, Höhe) auslesen
    $image_props = getimagesize($picture);
    $this->pwidth = $image_props[0];
    $this->pheight = $image_props[1];
    # Dateigrösse
    $this->fsize = filesize($picture);
    $this->picname = $name;
    $this->fullpath = $picture;
    $this->fullthumb = $picture.EXTENSION;
    
    
  }
  function create() {    
    # Bildabmessungen aus Config holen
    $x = MAXX;
    $y = MAXY;
    # Bildseitenverhältnis
    $aspect = $this->pwidth / $this->pheight;
    # Thumbnailgrösse in Abhängigkeit von Aspectratio berechnen
    if ($aspect > 1) {
        $y = $x * $this->pheight / $this->pwidth;
      } else {
        $x = $y * $this->pwidth / $this->pheight;
      }
      # Originalbild und Thumbnail in RAM ablegen
      $ram_orig = imagecreatefromjpeg($this->fullpath);
      $ram_thumb = imagecreatetruecolor($x, $y);
      # Originalbild ins Thumbnail kopieren
      imagecopyresampled($ram_thumb, $ram_orig, 0, 0, 0, 0, $x, $y, $this->pwidth, $this->pheight);
      # Speichern und Speicherbereiche (RAM) freigeben
      imagejpeg($ram_thumb, $this->fullthumb);
      chmod($this->fullthumb, 0644);
      imagedestroy($ram_orig);
      imagedestroy($ram_thumb);
      # Metadaten schreiben
      $meta = $this->picname . '|' . $this->owner . '|' . $this->cdate . '|' .
              $this->skeys . '|' . $this->desc;
      $meta .= sprintf("%03d", strlen($meta));
      $filehandle = fopen($this->fullthumb, "a+b");
      fwrite($filehandle, $meta);
      fclose($filehandle);
      
  }
  function read() {
    if (file_exists($this->fullpath) && is_file($this->fullpath)) {
      $filehandle = fopen($this->fullthumb, "rb");
      fseek($filehandle, filesize($this->fullthumb) - 3);
      $this->rlength = fread($filehandle, 3);
      rewind($filehandle);
      fseek($filehandle, filesize($this->fullthumb) - 3 - $this->rlength);
      $meta = fread($filehandle, $this->rlength);
      list($this->picname,
           $this->owner,
           $this->cdate,
           $this->skeys,
           $this->desc) = explode('|', $meta);
    } else {
      $this->fullthumb = NULL;
    }
  }
  function update() {
    if (is_file($this->fullthumb)) {
      $filehandle = fopen($this->fullthumb, "rb");
      fseek($filehandle, filesize($this->fullthumb) - 3);
      $this->rlength = fread($filehandle, 3);
      rewind($filehandle);
      $ram_thumbnail = fread($filehandle, filesize($this->fullthumb) - 3 - $this->rlength);
      fclose($filehandle);
      # Thumbnail neu schreiben
      $filehandle = fopen($this->fullthumb, "wb");
      fwrite($filehandle, $ram_thumbnail);
      # Metadaten neu schreiben
      $meta = $this->picname . '|' . $this->owner . '|' .
              $this->cdate . '|' . $this->skeys . '|' .
              $this->desc;
      $meta = substr($meta, 0, 999);
      $meta .= sprintf("%03d", strlen($meta));
      fwrite($filehandle, $meta);
      fclose($filehandle);
  } else {
      $this->fullthumb = NULL;  
    }
  }
  function delete() {
    unlink($this->fullpath);
    unlink($this->fullthumb);
  }
}
?>
