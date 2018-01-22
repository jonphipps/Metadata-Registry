<?php
/**
 * Created by PhpStorm.
 * User: jonphipps
 * Date: 2016-10-27
 * Time: 5:16 PM.
 */

namespace app;

use Illuminate\Foundation\Application;

class MyApp extends Application
{
    public function publicPath()
    {
        return $this->basePath . DIRECTORY_SEPARATOR . 'web';
    }
}
