<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * (c) 2004-2006 Sean Kerr <sean@code-box.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfDatabaseConfigHandler allows you to setup database connections in a
 * configuration file that will be created for you automatically upon first
 * request.
 *
 * @package    symfony
 * @subpackage config
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     Sean Kerr <sean@code-box.org>
 * @version    SVN: $Id$
 */
class sfDatabaseConfigHandler extends sfYamlConfigHandler
{
  /**
   * Executes this configuration handler.
   *
   * @param array An array of absolute filesystem path to a configuration file
   *
   * @return string Data to be written to a cache file
   *
   * @throws sfConfigurationException If a requested configuration file does not exist or is not readable
   * @throws sfParseException If a requested configuration file is improperly formatted
   */
  public function execute($configFiles)
  {
    // parse the yaml
    $myConfig = $this->parseYamls($configFiles);

    $myConfig = sfToolkit::arrayDeepMerge(
      isset($myConfig['default']) && is_array($myConfig['default']) ? $myConfig['default'] : array(),
      isset($myConfig['all']) && is_array($myConfig['all']) ? $myConfig['all'] : array(),
      isset($myConfig[sfConfig::get('sf_environment')]) && is_array($myConfig[sfConfig::get('sf_environment')]) ? $myConfig[sfConfig::get('sf_environment')] : array()
    );

    // init our data and includes arrays
    $data      = array();
    $databases = array();
    $includes  = array();

    // get a list of database connections
    foreach ($myConfig as $key => $dbConfig)
    {
      // is this category already registered?
      if (in_array($key, $databases))
      {
        // this category is already registered
        $error = sprintf('Configuration file "%s" specifies previously registered category "%s"', $configFiles[0], $key);
        throw new sfParseException($error);
      }

      // add this database
      $databases[] = $key;

      // let's do our fancy work
      if (!isset($dbConfig['class']))
      {
        // missing class key
        $error = sprintf('Configuration file "%s" specifies category "%s" with missing class key', $configFiles[0], $key);
        throw new sfParseException($error);
      }

      if (isset($dbConfig['file']))
      {
        // we have a file to include
        $file = $this->replaceConstants($dbConfig['file']);
        $file = $this->replacePath($file);

        if (!is_readable($file))
        {
          // database file doesn't exist
          $error = sprintf('Configuration file "%s" specifies class "%s" with nonexistent or unreadable file "%s"', $configFiles[0], $dbConfig['class'], $file);
          throw new sfParseException($error);
        }

        // append our data
        $includes[] = sprintf("require_once('%s');", $file);
      }

      // parse parameters
      if (isset($dbConfig['param']))
      {
        foreach ($dbConfig['param'] as &$value)
        {
          $value = $this->replaceConstants($value);
        }

        $parameters = var_export($dbConfig['param'], true);
      }
      else
      {
        $parameters = 'null';
      }

      // append new data
      $data[] = sprintf("\n\$database = new %s();\n".
                        "\$database->initialize(%s, '%s');\n".
                        "\$this->databases['%s'] = \$database;",
                        $dbConfig['class'], $parameters, $key, $key);
    }

    // compile data
    $retval = sprintf("<?php\n".
                      "// auto-generated by sfDatabaseConfigHandler\n".
                      "// date: %s%s\n%s\n",
                      date('Y/m/d H:i:s'), implode("\n", $includes), implode("\n", $data));

    return $retval;
  }
}
