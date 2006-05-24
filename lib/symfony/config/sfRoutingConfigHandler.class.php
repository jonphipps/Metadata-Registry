<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @package    symfony
 * @subpackage config
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id$
 */
class sfRoutingConfigHandler extends sfYamlConfigHandler
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
    // parse the yaml
    $config = $this->parseYamls($configFiles);

    // connect routes
    $routes = sfRouting::getInstance();
    foreach ($config as $name => $params)
    {
      $routes->connect(
        $name,
        ($params['url'] ? $params['url'] : '/'),
        (isset($params['param']) ? $params['param'] : array()),
        (isset($params['requirements']) ? $params['requirements'] : array())
      );
    }

    // compile data
    $retval = sprintf("<?php\n".
                      "// auto-generated by sfRoutingConfigHandler\n".
                      "// date: %s\n\$routes = sfRouting::getInstance();\n\$routes->setRoutes(\n%s\n);\n?>",
                      date('Y/m/d H:i:s'), var_export($routes->getRoutes(), 1));

    return $retval;
  }
}

?>