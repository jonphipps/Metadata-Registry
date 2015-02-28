<?php
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local as Adapter;

class myWebRequest extends sfWebRequest
{
  /**
  * Retrieves a single param from PathInfo
  *
  * @return string
  * @param  string $param The parameter to return
  */
  public function getPathInfoParam($param)
  {
    $patharray = $this->getPathInfoArray();
    return $patharray[$param];
  }

  /**
   * @param $sourceFile
   * @param $repoFile
   *
   * @return bool
   *
   */
  public function moveToRepo( $sourceFile, $repoFile )
  {
    $filesystem = new Filesystem( new Adapter( '/' ) );

    if ($filesystem->has($repoFile))
    {
      $filesystem->delete($repoFile);
    }
    $result =  $filesystem->rename( $sourceFile, $repoFile );
    unset($filesystem);
    return $result;
  }
}

