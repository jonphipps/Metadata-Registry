<?php

// GUIDs (Globally Unique IDentifiers) are randomly generated hexadecimal IDs 
// with enough uniqueness for any situation. 16 hexadecimal digits are good 
// enough for Microsoft and safe to be stored as text etc. They come in
// handy all over the place: temporary filenames, verification codes, etc.

class pkGuid
{
  static public function generate()
  {
    $guid = "";
    for ($i = 0; ($i < 8); $i++) {
      $guid .= sprintf("%02x", mt_rand(0, 255));
    }
    return $guid;
  }
}

