<?php
# Calculating a given value (Bytes) into human readable values
# e.g. kBytes, MBytes and GBytes
#
function human_readable_size($bytes) {
  if ($bytes < 1024) {
    return($bytes . ' Bytes');
  } elseif ($bytes < 1048576) {
      #1024 * 1024
      return(sprintf('%1.1f', $bytes/1024) . ' kB');
  } elseif ($bytes < 1073741824) {
      #1024 * 1024 * 1024
      return(sprintf('%1.1f', $bytes/1048576) . ' MB');
  } else {
      return(sprintf('%1.1f', $bytes/1073741824) . ' GB');
  }
}
# process an array of input-strings and remove/convert unwanted content
# e.g. html-tags, newlines and special values, returns the array

function clearing_input($input_array) {
  foreach ($input_array as $key=>$value) {
    $value = strip_tags($value, '<b><i><u>');
    $value = preg_replace('/\r\n|\r|\n/', '<br>', $value);
    $value = str_replace('|', '&#124;', $value);
    $input_array[$key] = $value;
  }
  return $input_array;
}
?>
