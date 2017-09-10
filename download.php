<?php
$file = $_GET["file"];
$filename = '/home/greenlie/giphy.greenlie.org/images/'.$file.'.gif';

$mime = ($mime = getimagesize($filename)) ? $mime['mime'] : $mime;
$size = filesize($filename);
$fp   = fopen($filename, "rb");
if (!($mime && $size && $fp)) {
  // Error.
  return;
}

header("Content-type: " . $mime);
header("Content-Length: " . $size);
// NOTE: Possible header injection via $basename
header("Content-Disposition: attachment; filename=" . $basename);
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
fpassthru($fp);
?>