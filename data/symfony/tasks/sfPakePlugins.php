<?php

pake_desc('install a new plugin');
pake_task('plugin-install', 'project_exists');

pake_desc('upgrade a plugin');
pake_task('plugin-upgrade', 'project_exists');

pake_desc('uninstall a plugin');
pake_task('plugin-uninstall', 'project_exists');

pake_desc('list installed plugins');
pake_task('plugin-list', 'project_exists');

// symfony plugin-install pluginName
function run_plugin_install($task, $args)
{
  if (!isset($args[0]))
  {
    throw new Exception('You must provide the plugin name.');
  }

  $config = _pear_init();

  // install plugin
  $packages = array($args[0]);
  pake_echo_action('plugin', 'installing plugin "'.$args[0].'"');
  list($ret, $error) = _pear_run_command($config, 'install', array(), $packages);

  if ($error)
  {
    throw new Exception($error);
  }

  _install_web_content(_get_plugin_name($args[0]));
}

function run_plugin_upgrade($task, $args)
{
  if (!isset($args[0]))
  {
    throw new Exception('You must provide the plugin name.');
  }

  $config = _pear_init();

  // upgrade plugin
  $packages = array($args[0]);
  pake_echo_action('plugin', 'upgrading plugin "'.$args[0].'"');
  list($ret, $error) = _pear_run_command($config, 'upgrade', array('loose' => true, 'nodeps' => true), $packages);

  if ($error)
  {
    throw new Exception($error);
  }

  $plugin_name = _get_plugin_name($args[0]);
  _uninstall_web_content($plugin_name);
  _install_web_content($plugin_name);
}

function run_plugin_uninstall($task, $args)
{
  if (!isset($args[0]))
  {
    throw new Exception('You must provide the plugin name.');
  }

  _uninstall_web_content(_get_plugin_name($args[0]));

  $config = _pear_init();

  // uninstall plugin
  $packages = array($args[0]);
  pake_echo_action('plugin', 'uninstalling plugin "'.$args[0].'"');
  list($ret, $error) = _pear_run_command($config, 'uninstall', array(), $packages);

  if ($error)
  {
    throw new Exception($error);
  }
}

function run_plugin_list($task, $args)
{
  pake_echo('Installed plugins:');

  $config = _pear_init();
  $registry = $config->getRegistry();
  $installed = $registry->packageInfo(null, null, null);
  foreach ($installed as $channel => $packages)
  {
    foreach ($packages as $package)
    {
      $pobj = $registry->getPackage(isset($package['package']) ? $package['package'] : $package['name'], $channel);
      pake_echo(sprintf(" %-40s %10s-%-6s %s", pakeColor::colorize($pobj->getPackage(), 'INFO'), $pobj->getVersion(), $pobj->getState() ? $pobj->getState() : null, pakeColor::colorize('# '.$channel, 'COMMENT')));
    }
  }
}

function _pear_run_command($config, $command, $opts, $params)
{
  ob_start('_pear_echo_message', 2);
  $cmd = PEAR_Command::factory($command, $config);
  $ret = ob_get_clean();
  if (PEAR::isError($cmd))
  {
    throw new Exception($cmd->getMessage());
  }

  ob_start('_pear_echo_message', 2);
  $ok   = $cmd->run($command, $opts, $params);
  $ret .= ob_get_clean();

  $ret = trim($ret);

  return PEAR::isError($ok) ? array($ret, $ok->getMessage()) : array($ret, null);
}

function _pear_echo_message($message)
{
  $t = '';
  foreach (explode("\n", $message) as $line)
  {
    if ($line = trim($line))
    {
      $t .= pake_format_action('pear', $line);
    }
  }

  return $t;
}

function _pear_init()
{
  require_once 'PEAR.php';
  require_once 'PEAR/Frontend.php';
  require_once 'PEAR/Config.php';
  require_once 'PEAR/Registry.php';
  require_once 'PEAR/Command.php';
  require_once 'PEAR/Remote.php';

  // current symfony release
  if (is_readable('lib/symfony'))
  {
    $sf_version = file_get_contents('lib/symfony/BRANCH');
  }
  else
  {
    // PEAR config
    if ((include('symfony/pear.php')) != 'OK')
    {
      throw new Exception('Unable to find symfony librairies.');
    }
  }

  // PEAR
  PEAR_Command::setFrontendType('CLI');
  $ui = &PEAR_Command::getFrontendObject();

  // read user/system configuration (don't use the singleton)
  $config = new PEAR_Config();
  $config_file = sfConfig::get('sf_plugins_dir').DIRECTORY_SEPARATOR.'.pearrc';

  // change the configuration for symfony use
  $config->set('php_dir',  sfConfig::get('sf_root_dir').'/plugins');
  $config->set('data_dir', sfConfig::get('sf_root_dir').'/plugins');
  $config->set('test_dir', sfConfig::get('sf_root_dir').'/plugins');
  $config->set('doc_dir',  sfConfig::get('sf_root_dir').'/plugins');
  $config->set('bin_dir',  sfConfig::get('sf_root_dir').'/plugins');

  // save out configuration file
  $config->writeConfigFile($config_file, 'user');

  // use our configuration file
  $config = &PEAR_Config::singleton($config_file);

  $config->set('verbose', 1);
  $ui->setConfig($config);

  date_default_timezone_set('UTC');

  // register our channel
  $symfony_channel = array(
    'attribs' => array(
      'version' => '1.0',
      'xmlns' => 'http://pear.php.net/channel-1.0',
      'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
      'xsi:schemaLocation' => 'http://pear.php.net/dtd/channel-1.0 http://pear.php.net/dtd/channel-1.0.xsd',
    ),

    'name' => 'pear.symfony-project.com',
    'summary' => 'symfony project PEAR channel',
    'suggestedalias' => 'symfony',
    'servers' => array(
      'primary' => array(
        'rest' => array(
          'baseurl' => array(
            array(
              'attribs' => array('type' => 'REST1.0'),
              '_content' => 'http://pear.symfony-project.com/Chiara_PEAR_Server_REST/',
            ),
            array(
              'attribs' => array('type' => 'REST1.1'),
              '_content' => 'http://pear.symfony-project.com/Chiara_PEAR_Server_REST/',
            ),
          ),
        ),
      ),
    ),
    '_lastmodified' => array(
      'ETag' => "113845-297-dc93f000", 
      'Last-Modified' => date('r'),
    ),
  );
  pake_mkdirs(sfConfig::get('sf_plugins_dir').'/.channels/.alias');
  file_put_contents(sfConfig::get('sf_plugins_dir').'/.channels/pear.symfony-project.com.reg', serialize($symfony_channel));
  file_put_contents(sfConfig::get('sf_plugins_dir').'/.channels/.alias/symfony.txt', 'pear.symfony-project.com');

  // register symfony for dependencies
  $symfony = array(
    'name'          => 'symfony',
    'channel'       => 'pear.symfony-project.com',
    'date'          => date('Y-m-d'),
    'time'          => date('H:i:s'),
    'version'       => array('release' => $sf_version, 'api' => '1.0.0'),
    'stability'     => array('release' => 'stable', 'api' => 'stable'),
    'xsdversion'    => '2.0',
    '_lastmodified' => time(),
    'old'           => array('version' => $sf_version),
  );
  $dir = sfConfig::get('sf_plugins_dir').DIRECTORY_SEPARATOR.'.registry'.DIRECTORY_SEPARATOR.'.channel.pear.symfony-project.com';
  pake_mkdirs($dir);
  file_put_contents($dir.DIRECTORY_SEPARATOR.'symfony.reg', serialize($symfony));

  return $config;
}

function _get_plugin_name($arg)
{
  $plugin_name = (false !== $pos = strrpos($arg, '/')) ? substr($arg, $pos + 1) : $arg;
  $plugin_name = (false !== $pos = strrpos($plugin_name, '-')) ? substr($plugin_name, 0, $pos) : $plugin_name;

  return $plugin_name;
}

function _install_web_content($plugin_name)
{
  $web_dir = sfConfig::get('sf_plugins_dir').DIRECTORY_SEPARATOR.$plugin_name.DIRECTORY_SEPARATOR.'web';
  if (is_dir($web_dir))
  {
    pake_echo_action('plugin', 'installing web data for plugin');
    pake_symlink($web_dir, sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.$plugin_name, true);
  }
}

function _uninstall_web_content($plugin_name)
{
  $web_dir = sfConfig::get('sf_plugins_dir').DIRECTORY_SEPARATOR.$plugin_name.DIRECTORY_SEPARATOR.'web';
  $target_dir = sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.$plugin_name;
  if (is_dir($web_dir) && is_dir($target_dir))
  {
    pake_echo_action('plugin', 'uninstalling web data for plugin');
    if (is_link($target_dir))
    {
      pake_remove($target_dir, '');
    }
    else
    {
      pake_remove(pakeFinder::type('any'), $target_dir);
      pake_remove($target_dir, '');
    }
  }
}
