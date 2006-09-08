<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// restrict to localhost only
if ('127.0.0.1' != $_SERVER['REMOTE_ADDR'])
{
  return;
}

define('SF_ROOT_DIR', realpath(dirname(__FILE__).'/..'));

// symfony directories
if (is_readable(SF_ROOT_DIR.'/lib/symfony/symfony.php'))
{
  // symlink exists
  $sf_symfony_lib_dir  = SF_ROOT_DIR.'/lib/symfony';
  $sf_symfony_data_dir = SF_ROOT_DIR.'/data/symfony';
}
else
{
  // PEAR config
  if ((include('symfony/pear.php')) != 'OK')
  {
    throw new Exception('Unable to find symfony librairies');
  }
}

// as we are in the web/ dir, we need to go up one level to get to the project root
chdir(dirname(__FILE__).DIRECTORY_SEPARATOR.'..');

// init pake
require_once($sf_symfony_lib_dir.'/vendor/pake/pakeFunction.php');

$pake = pakeApp::get_instance();
$pakefile = $sf_symfony_data_dir.'/bin/pakefile.php';

// get parameters from request
$task = isset($_GET['task']) ? $_GET['task'] : '';
$args = isset($_GET['arg']) ? $_GET['arg'] : array();

// task
$tasks = array(
  'clear-cache',
  'propel-build-model',
  'propel-build-sql',
  'propel-insert-sql',
  'propel-build-all',
  'propel-load-data',
  'init-module',
  'propel-init-crud',
  'propel-generate-crud',
  'propel-init-admin',
  'test',
);

if (in_array($task, $tasks))
{
  try
  {
    echo "<div id='feedback'><pre>";
    echo $pake->run($pakefile, array_merge(array($task), $args));
    echo "</pre></div>";
    echo "<strong>symfony ".$task." ".implode(' ', $args)." : task executed</strong>";
    echo " <a href='javascript:;' onclick='switchElement(\"feedback\");return false'>[close]</a>";
  }
  catch (pakeException $e)
  {
    print "<strong>ERROR</strong>: ".$e->getMessage();
  }
}

// source code
if ($task == 'show')
{
  $file = realpath(SF_ROOT_DIR.'/'.rawurldecode($_GET['filename']));
  if (0 === strpos($file, SF_ROOT_DIR) && file_exists($file))
  {
    echo '<a href="'.$_SERVER["SCRIPT_NAME"].'">back</a><p><strong>'.$file.'</strong></p>';
    if ('.php' == substr($file, -4))
    {
      highlight_file($file);
    }
    else
    {
      echo '<pre>'.htmlentities(file_get_contents($file), ENT_QUOTES, 'UTF-8').'</pre>';
    }

    return;
  }
  else
  {
    die(javascript_alert('File does not exist!'));
  }
}

// batch process
if ($task == 'batch')
{
  $file = realpath(SF_ROOT_DIR.'/batch/'.rawurldecode($_GET['filename']));
  if (0 === strpos($file, SF_ROOT_DIR) && file_exists($file))
  {
    echo "<div id='feedback'><pre>";
    exec('php '.escapeshellcmd($file), $output, $retval);
    echo implode('<br />', $output);
    echo "</pre></div>";
    echo "<strong>batch process ".htmlentities(rawurldecode($_GET['filename']))." executed</strong>";
    echo " <a href='javascript:;' onclick='switchElement(\"feedback\");return false'>[close]</a>";
  }
  else
  {
    die(javascript_alert('File does not exist!'));
  }
}

// helper functions
function javascript_alert($text)
{
  return "<html><body onload=\"javascript: alert('$text');history.back();\" bgcolor=\"#F0F0F0\"></body></html>";
}

function lcfirst($name)
{
  $first_letter = strtolower(substr($name, 0, 1));

  return $first_letter.substr($name, 1, strlen($name)-1);
}

function link_to_file($filename, $path, $name = null, $br = true)
{
  return "<a href='".$_SERVER["SCRIPT_NAME"]."?task=show&amp;filename=".rawurlencode(str_replace('\\', '/', str_replace(SF_ROOT_DIR.DIRECTORY_SEPARATOR, '', realpath(SF_ROOT_DIR.'/'.$path.'/'.$filename))))."'>".($name === null ? $filename : $name)."</a>".($br ? "<br />":"");
}

// initialize variables needed at several places
$tmp1 = str_replace('\\', '/', SF_ROOT_DIR);
$tmp2 = explode('/', $tmp1);
$project_name = end($tmp2);
$model_files = pakeFinder::type('file')->maxdepth(0)->relative()->name("*Peer.php")->ignore_version_control()->in('lib/model');
$apps = pakeFinder::type('dir')->maxdepth(0)->relative()->ignore_version_control()->in('apps');

$batches = pakeFinder::type('file')->relative()->ignore_version_control()->maxdepth(3)->name("*.php")->in('batch');
$controllers = pakeFinder::type('file')->relative()->ignore_version_control()->maxdepth(1)->name('*.php')->in('web');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title>"<?php echo $project_name ?>" project - symfony control panel</title>
    <style type="text/css">
      body, td
      {
       font-family: verdana, sans-serif;
      }
      body
      {
       font-size: 0.8em;
      }      
      h1
      {
        font-size: 1.5em;
        text-align: center;
        margin-bottom: 0;
        background-color: #c6cdde;
        padding: 10px;
      }
      h2
      {
        font-size: 1.4em;
        background-color: #97CCE8;
        padding: 2px;
        padding-left: 10px;
        border: solid 1px #087CB9;
      }
      h3
      {
        font-size: 1.2em;
        background-color: #EDD7F6;
        padding: 2px;
        padding-left: 10px;
        border: solid 1px #A30045;
      }
      h4
      {
        margin: 0;
      }
      blockquote
      {
        margin: 5px 10px;
      }
      a.task
      {
        font-weight: bold;
      }
      #propel-task label
      {
        display: block;
        width: 29%;
        float: left;
      }
      #propel-task input, #propel-task select
      {
        vertical-align: middle;
        width: 60%;
      }
      #propel-task br
      {
        clear: left;
      }
      .column
      {
        float: left;
        width: <?php echo intval(100 / (count($apps) + 2)) - 2 ?>%;
        padding: 1%;
        padding-bottom: 32767px !important;
        margin-bottom: -32767px !important;
      }
      #wrapper
      {
        overflow: hidden;
      }
      #wrapper
      {
        float: left;
        float/**/: none;
      }
      #wrapper:after
      {
        content: '[DO NOT LEAVE IT IS NOT REAL]';
        display: block;
        height: 0;
        clear: both;
        visibility: hidden;
      }
      #wrapper
      {
        display: inline-block;
      }
      /*\*/
      #wrapper
      {
        display: block;
      }
      /* end easy clearing */
      #footer
      {
        clear: both;
      }
      * > #footer, * > form, * > #notes, * > .output
      {
        position: relative;
        z-index: 1000;
      }
    </style>
    <script type="text/javascript">
      function $()
      {
        var results = [], element;
        for (var i = 0; i < arguments.length; i++) {
          element = arguments[i];
          element = document.getElementById(element);
          results.push(element);
        }
        return results.length < 2 ? results[0] : results;
      }

      function switchElement(element)
      {
        element = $(element);
        element.style.display = (element.style.display == "none") ? "block" : "none";
      }
    </script>
  </head>

  <body>
    <h1>"<?php echo $project_name ?>" project - symfony control panel</h1>
    <div id="wrapper">

    <?php foreach ($apps as $app) : ?>
    <div class="column">

      <h2>Application "<?php echo $app ?>"</h2>

      <blockquote>
        <a class="task" href="<?php echo $_SERVER["SCRIPT_NAME"] ?>?task=clear-cache&amp;arg[0]=<?php echo $app ?>">Clear app cache</a><br />
        <a class="task" href="<?php echo $_SERVER["SCRIPT_NAME"] ?>?task=clear-cache&amp;arg[0]=<?php echo $app ?>&amp;arg[1]=config">Clear config app cache</a><br />
        <a class="task" href="<?php echo $_SERVER["SCRIPT_NAME"] ?>?task=clear-cache&amp;arg[0]=<?php echo $app ?>&amp;arg[1]=templates">Clear templates app cache</a><br />
        <a class="task" href="<?php echo $_SERVER["SCRIPT_NAME"] ?>?task=test&amp;arg[0]=<?php echo $app ?>">Launch test suite</a><br />
      </blockquote>

      <h3>Environments</h3>
      <blockquote>
      <?php foreach ($controllers as $controller): ?>
        <?php $contents = file_get_contents(getcwd().'/web/'.$controller);
              preg_match('/\'SF_APP\',[\s]*\''.$app.'\'\)/', $contents, $found_app);
              preg_match_all('/\'SF_ENVIRONMENT\',[\s]*\'(.*)\'\)/', $contents, $envs) ?>
        <?php if (isset($found_app[0]) && isset($envs[1][0])): ?>
          <a href="<?php echo $controller ?>">Browse in <?php echo $envs[1][0] ?></a><br />
        <?php endif; ?>
      <?php endforeach; ?>
      </blockquote>

      <h3>Modules</h3>
      <?php $modules = pakeFinder::type('dir')->maxdepth(0)->relative()->ignore_version_control()->in('apps/'.$app.'/modules') ?>
      <blockquote>
      <?php foreach ($modules as $module): ?>
          <a href="javascript:;" onclick="switchElement('<?php echo $app ?>_module_<?php echo $module ?>');return false"><?php echo $module ?></a><br />
          <blockquote id="<?php echo $app ?>_module_<?php echo $module ?>" style="display:none;">

          <?php try { ?>
          <?php $action_files = pakeFinder::type('file')->name('*action*.class.php')->maxdepth(0)->ignore_version_control()->relative()->in('apps/'.$app.'/modules/'.$module.'/actions') ?>
          <?php if ($action_files): ?>
            <h4>Actions</h4>
            <blockquote>
            <?php foreach ($action_files as $action_file): ?>
              <?php preg_match_all('/function\s+execute(.*)\(\)/', file_get_contents(SF_ROOT_DIR.'/apps/'.$app.'/modules/'.$module.'/actions/'.$action_file), $actions)  ?>
              <?php foreach ($actions[1] as $action): ?>
              <?php echo link_to_file($action_file, '/apps/'.$app.'/modules/'.$module.'/actions/', lcfirst($action)) ?>
              <?php endforeach; ?>
            <?php endforeach; ?>
            </blockquote>
          <?php endif; ?>
          <?php } catch (Exception $e) { } ?>

          <?php try { ?>
          <?php $templates = pakeFinder::type('file')->name('*.php')->maxdepth(0)->relative()->ignore_version_control()->in('apps/'.$app.'/modules/'.$module.'/templates') ?>
          <?php if ($templates): ?>
            <h4>Templates</h4>
            <blockquote>
            <?php foreach ($templates as $template): ?>
              <?php echo link_to_file($template, '/apps/'.$app.'/modules/'.$module.'/templates') ?>
            <?php endforeach; ?>
            </blockquote>
          <?php endif; ?>
          <?php } catch (Exception $e) { } ?>

          <?php try { ?>
          <?php $configurations = pakeFinder::type('file')->name('*.yml')->maxdepth(0)->relative()->ignore_version_control()->in('apps/'.$app.'/modules/'.$module.'/config') ?>
          <?php if ($configurations): ?>
            <h4>Configuration</h4>
            <blockquote>
            <?php foreach ($configurations as $configuration): ?>
              <?php echo link_to_file($configuration, '/apps/'.$app.'/modules/'.$module.'/config') ?>
            <?php endforeach; ?>
            </blockquote>
          <?php endif; ?>
          <?php } catch (Exception $e) { } ?>

          <?php try { ?>
          <?php $libraries = pakeFinder::type('file')->name('*.php')->relative()->ignore_version_control()->in('apps/'.$app.'/modules/'.$module.'/lib') ?>
          <?php if ($libraries): ?>
            <h4>Libraries</h4>
            <blockquote>
            <?php foreach ($libraries as $library): ?>
              <?php echo link_to_file($library, '/apps/'.$app.'/modules/'.$module.'/lib') ?>
            <?php endforeach; ?>
            </blockquote>
          <?php endif; ?>
          <?php } catch (Exception $e) { } ?>

          </blockquote>

        <?php endforeach; ?>
        
        </blockquote>
      
        <blockquote>
          <a class="task" href="#" onclick="switchElement('propel-task');return false">Create new module...</a><br />
        
        <form method="get" action="<?php echo $_SERVER["SCRIPT_NAME"] ?>" name="propel-task" id="propel-task" style="display: none;margin-top:10px">
          <input type="hidden" name="arg[0]" value="<?php echo $app ?>" />

          <label for="task">type</label>
          <select name="task" onChange=";if (String(this.value).indexOf('propel') == 0) divdisplay ='block'; else divdisplay ='none'; $('propel_module_models').style.display = divdisplay;">
              <option value="init-module">empty skeleton</option>
              <?php if ($model_files): ?>
                <option value="propel-init-crud">scaffolding (init)</option>
                <option value="propel-generate-crud">scaffolding (generate)</option>
                <option value="propel-init-admin">administration</option>
              <?php endif; ?>
          </select><br />

          <label for="arg[1]">name</label>
          <input type="text" name="arg[1]" /><br />

          <?php if ($model_files): ?>
            <div id="propel_module_models" style="display:none">
              <label for="arg[2]">based on</label>
              <select name="arg[2]" id="propel_module_models_select">
                <option value="" selected="selected">select a class</option>
                <?php foreach ($model_files as $model_file): ?>
                  <?php $model = substr($model_file, 0, strlen($model_file)-8) ?>
                  <option value="<?php echo $model ?>"><?php echo $model ?></option>
                <?php endforeach; ?>
              </select><br />
            </div>
          <?php endif; ?>

          <label>&nbsp;</label>
          <input type="submit" value="Create a module" /><br />
        </form>

        </blockquote>

      <?php try { ?>
      <h3>Configuration</h3>
      <?php $config_files = pakeFinder::type('file')->relative()->ignore_version_control()->in('apps/'.$app.'/config') ?>
      <blockquote>
      <?php foreach ($config_files as $config_file): ?>
          <?php echo link_to_file($config_file, '/apps/'.$app.'/config') ?>
      <?php endforeach; ?>
      </blockquote>
      <?php } catch (Exception $e) { } ?>

      <?php try { ?>
      <?php $libraries = pakeFinder::type('file')->name('*.php')->relative()->ignore_version_control()->in('apps/'.$app.'/lib') ?>
      <?php if ($libraries): ?>
        <h3>Libraries</h3>
        <blockquote>
        <?php foreach ($libraries as $library): ?>
          <?php echo link_to_file($library, '/apps/'.$app.'/lib') ?>
        <?php endforeach; ?>
        </blockquote>
      <?php endif; ?>
      <?php } catch (Exception $e) { } ?>

  </div>
  <?php endforeach; ?>

  <div class="column">
    <h2>Model</h2>

    <?php try { ?>
    <?php $schema_files = pakeFinder::type('file')->maxdepth(3)->relative()->name("*schema.*ml")->prune('web')->prune('lib')->prune('data')->ignore_version_control()->in('./') ?>
    <?php if ($schema_files): ?>
      <h3>Schema</h3>
      <blockquote>
      <?php foreach ($schema_files as $schema_file): ?>
        <?php echo link_to_file($schema_file, '') ?>
      <?php endforeach; ?>
    </blockquote>
    <blockquote style="float:left">
      <a class="task" href="<?php echo $_SERVER["SCRIPT_NAME"] ?>?task=propel-build-model">Rebuild Model</a><br />
      <a class="task" href="<?php echo $_SERVER["SCRIPT_NAME"] ?>?task=propel-build-sql">Build SQL</a><br />
      <a class="task" href="<?php echo $_SERVER["SCRIPT_NAME"] ?>?task=propel-insert-sql">Insert SQL</a>
    </blockquote>
    <blockquote style="float:left">
      <br />
      <a class="task" href="<?php echo $_SERVER["SCRIPT_NAME"] ?>?task=propel-build-all">Rebuild Model and db</a>
    </blockquote>
    <br style="clear:left" />
    <?php endif; ?>
    <?php } catch (Exception $e) { } ?>

    <?php try { ?>
    <?php $connection_files = pakeFinder::type('file')->maxdepth(3)->relative()->name('databases.yml')->prune('lib')->prune('lib')->prune('data')->ignore_version_control()->in('./') ?>
    <?php if ($connection_files): ?>
      <h3>Connection settings</h3>
      <blockquote>
      <?php foreach ($connection_files as $connection_file): ?>
        <?php echo link_to_file($connection_file, '') ?>
      <?php endforeach; ?>
    </blockquote>
    <?php endif; ?>
    <?php } catch (Exception $e) { } ?>
    
    <?php try { ?>
    <?php $fixtures_files = pakeFinder::type('file')->maxdepth(3)->relative()->name("*.yml")->ignore_version_control()->in('./data/fixtures') ?>
    <?php if ($fixtures_files ): ?>
      <h3>Test data</h3>
      <blockquote>
      <?php foreach ($fixtures_files as $fixtures_file): ?>
        <?php echo link_to_file($fixtures_file, '/data/fixtures') ?>
      <?php endforeach; ?>
    </blockquote>
    <blockquote>
      <a class="task" href="<?php echo $_SERVER["SCRIPT_NAME"] ?>?task=propel-load-data">Insert into db</a>
    </blockquote>

    <?php if ($model_files): ?>
      <h3>Classes</h3>
      <blockquote>
      <?php foreach ($model_files as $model): ?>
        <?php $model = substr($model, 0, strlen($model)-8) ?>
        <?php echo link_to_file($model.'.php', '/lib/model', null, false) ?> (<?php echo link_to_file('Base'.$model.'.php', '/lib/model/om', 'base', false) ?>)<br />
        <?php echo link_to_file($model.'Peer.php', '/lib/model', null, false) ?> (<?php echo link_to_file('Base'.$model.'Peer.php', '/lib/model/om', 'base', false) ?>)<br />
      <?php endforeach; ?>
      </blockquote>
    <?php endif; ?>

    <?php endif; ?>
    <?php } catch (Exception $e) { } ?>

  </div>
  <div class="column">
    <h2>Cache</h2>
    <blockquote><b><a href="<?php echo $_SERVER["SCRIPT_NAME"] ?>?task=clear-cache">Clear All</a></b></blockquote>


    <?php try { ?>
    <?php if ($batches): ?>
      <h2>Batch</h2>
      <blockquote>
      <?php foreach ($batches as $batch): ?>
        <b><a href="<?php echo $_SERVER["SCRIPT_NAME"] ?>?task=batch&filename=<?php echo rawurlencode($batch) ?>"><?php echo $batch ?></a></b><br/>
      <?php endforeach; ?>
    </blockquote>
    <?php endif; ?>
    <?php } catch (Exception $e) { } ?>

    <?php $libraries = pakeFinder::type('file')->name('*.php')->prune('symfony')->prune('phing')->prune('pake')->prune('model')->relative()->ignore_version_control()->in('lib') ?>
    <?php if ($libraries): ?>
      <h2>Libraries</h2>
      <blockquote>
      <?php foreach ($libraries as $library): ?>
        <?php echo link_to_file($library, '/lib') ?>
      <?php endforeach; ?>
      </blockquote>
    <?php endif; ?>

    <h2>symfony directories</h2>
    <blockquote>
      <?php echo $sf_symfony_lib_dir ?>
      <?php echo $sf_symfony_data_dir ?>
    </blockquote>

    <!-- <h2>Install Plug-ins</h2> -->

  </div>

  </div>
  </body>
</html>
