<?php

class pkFiles
{
  static public function getTemporaryFilename()
  {
    // Symfony has a getTempDir method in sfToolkit but it is only
    // used by unit tests. It relies on the system temporary folder
    // which might not always be accessible in a non-command-line
    // PHP environment. Let's use something more local to our project.

    // The default is a subdirectory of your project's data directory
    // called pk-tmp. This often works just fine, but you can specify
    // something else via pk_temp_dir. 

    // Depending on your hosting environment you may need to
    // precreate this folder and set its permissions so that the
    // web server can write to it, much like web/uploads.

    $tempDir = sfConfig::get('pk_temp_dir', 
      sfConfig::get('sf_data_dir') . DIRECTORY_SEPARATOR . 'pk-tmp');
    if (!is_dir($tempDir))
    {
      if (!mkdir($tempDir))
      {
        throw new Exception("Unable to create $tempDir the admin will probably need to do this manually the first time and set permissions so that the web server can write to the folder");
      }
    }
    $filename = pkGuid::generate();
    return "$tempDir" . DIRECTORY_SEPARATOR . $filename;
  }
}
