<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * (c) 2004-2006 Sean Kerr.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage config
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     Sean Kerr <skerr@mojavi.org>
 * @version    SVN: $Id$
 */
class sfAutoloadConfigHandler extends sfYamlConfigHandler
{
  /**
   * Execute this configuration handler.
   *
   * @param array An array of absolute filesystem path to a configuration file.
   *
   * @return string Data to be written to a cache file.
   *
   * @throws sfConfigurationException If a requested configuration file does not exist or is not readable.
   * @throws sfParseException If a requested configuration file is improperly formatted.
   */
  public function execute($configFiles)
  {
    // set our required categories list and initialize our handler
    $categories = array('required_categories' => array('autoload'));

    $this->initialize($categories);

    // parse the yaml
    $myConfig = $this->parseYamls($configFiles);

    // init our data array
    $data = array();

    // let's do our fancy work
    foreach ($myConfig['autoload'] as $name => $entry)
    {
      if (isset($entry['name']))
      {
        $data[] = sprintf("\n// %s", $entry['name']);
      }

      // file mapping or directory mapping?
      if (!isset($entry['ext']))
      {
        // file mapping
        foreach ($entry['files'] as $class => $path)
        {
          $path   = $this->replaceConstants($path);

          $data[] = sprintf("'%s' => '%s',", $class, $path);
        }
      }
      else
      {
        // directory mapping
        $ext  = $entry['ext'];
        $path = $entry['path'];

        $path = $this->replaceConstants($path);
        $path = $this->replacePath($path);

        if (!is_dir($path))
        {
          continue;
        }

        // we automatically add our php classes
        require_once(sfConfig::get('sf_symfony_lib_dir').'/util/sfFinder.class.php');
        $finder = sfFinder::type('file')->name('*'.$ext);

        // recursive mapping?
        $recursive = ((isset($entry['recursive'])) ? $entry['recursive'] : false);
        if (!$recursive)
        {
          $finder->maxdepth(1);
        }

        // exclude files or directories?
        $exclude = array('.svn', 'CVS');
        if (isset($entry['exclude']) && is_array($entry['exclude']))
        {
          $exclude = array_merge($exclude, $entry['exclude']);
        }
        $finder->prune($exclude)->discard($exclude);

        $files = $finder->in($path);
        foreach ($files as $file)
        {
          $data[] = sprintf("'%s' => '%s',", basename($file, $ext), $file);
        }
      }
    }

    // compile data
    $retval = sprintf("<?php\n".
                      "// auto-generated by sfAutoloadConfigHandler\n".
                      "// date: %s\nsfConfig::set('sf_class_autoload', array(\n%s\n));\n?>",
                      date('Y/m/d H:i:s'), implode("\n", $data));

    return $retval;
  }
}
