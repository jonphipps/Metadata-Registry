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
 * @subpackage view
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     Sean Kerr <skerr@mojavi.org>
 * @version    SVN: $Id$
 */
class sfPHPView extends sfView
{
  protected static
    $coreHelpersLoaded = 0;

  public function execute()
  {
  }

  /**
   * Assigns some common variables to the template.
   */
  protected function getGlobalVars()
  {
    $context = $this->getContext();

    $lastActionEntry  = $context->getActionStack()->getLastEntry();
    $firstActionEntry = $context->getActionStack()->getFirstEntry();

    $shortcuts = array(
      'sf_context'       => $context,
      'sf_params'        => $context->getRequest()->getParameterHolder(),
      'sf_request'       => $context->getRequest(),
      'sf_user'          => $context->getUser(),
      'sf_view'          => $this,
      'sf_last_module'   => $lastActionEntry->getModuleName(),
      'sf_last_action'   => $lastActionEntry->getActionName(),
      'sf_first_module'  => $firstActionEntry->getModuleName(),
      'sf_first_action'  => $firstActionEntry->getActionName(),
    );

    if (sfConfig::get('sf_use_flash'))
    {
      $sf_flash = new sfParameterHolder();
      $sf_flash->add($context->getUser()->getAttributeHolder()->getAll('symfony/flash'));
      $shortcuts['sf_flash'] = $sf_flash;
    }

    return $shortcuts;
  }

  protected function loadCoreAndStandardHelpers()
  {
    if (self::$coreHelpersLoaded)
    {
      return;
    }

    self::$coreHelpersLoaded = 1;

    $core_helpers = array('Helper', 'Url', 'Asset', 'Tag', 'Escaping');
    $standard_helpers = sfConfig::get('sf_standard_helpers');

    $helpers = array_unique(array_merge($core_helpers, $standard_helpers));
    $this->loadHelpers($helpers);
  }

  /**
   * Loads all template helpers.
   *
   * helpers defined in templates (set with use_helper())
   */
  protected function loadHelpers($helpers)
  {
    $helper_base_dir = sfConfig::get('sf_symfony_lib_dir').'/helper/';
    foreach ($helpers as $helperName)
    {
      if (is_readable($helper_base_dir.$helperName.'Helper.php'))
      {
        include_once($helper_base_dir.$helperName.'Helper.php');
      }
      else
      {
        include_once('helper/'.$helperName.'Helper.php');
      }
    }
  }

  protected function renderFile($_sfFile)
  {
    if ($sf_logging_active = sfConfig::get('sf_logging_active'))
    {
      $this->getContext()->getLogger()->info('{sfPHPView} render "'.$_sfFile.'"');
    }

    $this->loadCoreAndStandardHelpers();

    $_escaping       = $this->getEscaping();
    $_escapingMethod = $this->getEscapingMethod();

    if (($_escaping === false) || ($_escaping === 'bc'))
    {
      extract($this->attribute_holder->getAll());
    }

    if ($_escaping !== false)
    {
      $sf_data = sfOutputEscaper::escape($_escapingMethod, $this->attribute_holder->getAll());

      if ($_escaping === 'both')
      {
        foreach ($sf_data as $_key => $_value)
        {
          ${$_key} = $_value;
        }
      }
    }

    // render to variable
    ob_start();
    ob_implicit_flush(0);
    require($_sfFile);
    $retval = ob_get_clean();

    return $retval;
  }

  /**
   * Retrieve the template engine associated with this view.
   *
   * Note: This will return null because PHP itself has no engine reference.
   *
   * @return null
   */
  public function &getEngine()
  {
    return null;
  }

  public function configure()
  {
    $context          = $this->getContext();
    $actionStackEntry = $context->getController()->getActionStack()->getLastEntry();
    $action           = $actionStackEntry->getActionInstance();

    // store our current view
    $actionStackEntry->setViewInstance($this);

    // require our configuration
    $viewConfigFile = $this->moduleName.'/'.sfConfig::get('sf_app_module_config_dir_name').'/view.yml';
    require(sfConfigCache::getInstance()->checkConfig(sfConfig::get('sf_app_module_dir_name').'/'.$viewConfigFile));

    $viewType = sfView::SUCCESS;
    if (preg_match('/^'.$action->getActionName().'(.+)$/i', $this->viewName, $match))
    {
      $viewType = $match[1];
      $templateFile = $templateName.$viewType.$this->extension;
    }
    else
    {
      $templateFile = $this->viewName.$this->extension;
    }

    // set template name
    $this->setTemplate($templateFile);

    // set template directory

    // all directories to look for templates
    $moduleName = $context->getModuleName();
    $dirs = array(
      // application
      $this->getDirectory(),

      // local plugin
      sfConfig::get('sf_plugin_data_dir').'/modules/'.$moduleName.'/templates',

      // core modules or global plugins
      sfConfig::get('sf_symfony_data_dir').'/modules/'.$moduleName.'/templates',

      // generated templates in cache
      sfConfig::get('sf_module_cache_dir').'/auto'.ucfirst($moduleName).'/templates',
    );

    foreach ($dirs as $dir)
    {
      if (is_readable($dir.'/'.$templateFile))
      {
        $this->setDirectory($dir);

        break;
      }
    }

    if (sfConfig::get('sf_logging_active'))
    {
      $context->getLogger()->info('{sfPHPView} execute view for template "'.$templateName.$viewType.$this->extension.'"');
    }
  }

  /**
   * Loop through all template slots and fill them in with the results of
   * presentation data.
   *
   * @param string A chunk of decorator content.
   *
   * @return string A decorated template.
   */
  protected function &decorate(&$content)
  {
    $template = $this->getDecoratorDirectory().'/'.$this->getDecoratorTemplate();

    if (sfConfig::get('sf_logging_active'))
    {
      $this->getContext()->getLogger()->info('{sfPHPView} decorate content with "'.$template.'"');
    }

    // call our parent decorate() method
    parent::decorate($content);

    // render the decorator template and return the result
    $retval = $this->renderFile($template);

    return $retval;
  }

  /**
   * Render the presentation.
   *
   * When the controller render mode is sfView::RENDER_CLIENT, this method will
   * render the presentation directly to the client and null will be returned.
   *
   * @return string A string representing the rendered presentation, if
   *                the controller render mode is sfView::RENDER_VAR, otherwise null.
   */
  public function &render()
  {
    $template         = $this->getDirectory().'/'.$this->getTemplate();
    $actionStackEntry = $this->getContext()->getActionStack()->getLastEntry();
    $actionInstance   = $actionStackEntry->getActionInstance();

    $moduleName = $actionInstance->getModuleName();
    $actionName = $actionInstance->getActionName();

    $retval = null;

    // get the render mode
    $mode = $this->getContext()->getController()->getRenderMode();

    if ($mode != sfView::RENDER_NONE)
    {
      $retval = null;
      if (sfConfig::get('sf_cache'))
      {
        list($uri, $suffix) = $this->getContext()->getViewCacheManager()->getInternalUri('slot');
        $cache = $this->getContext()->getResponse()->getParameter($uri.'_'.$suffix, null, 'symfony/cache');
        if ($cache !== null)
        {
          $cache  = unserialize($cache);
          $retval = $cache['content'];
          $vars   = $cache['vars'];
        }
      }

      // assigns some variables to the template
      $this->attribute_holder->add($this->getGlobalVars());
      $this->attribute_holder->add($retval !== null ? $vars : $actionInstance->getVarHolder()->getAll());

      // render template if no cache
      if ($retval === null)
      {
        // execute pre-render check
        $this->preRenderCheck();

        // render template file
        $retval = $this->renderFile($template);

        // tidy our cache content
        if (sfConfig::get('sf_tidy'))
        {
          $retval = sfTidy::tidy($retval, $template);
        }

        if (sfConfig::get('sf_cache'))
        {
          $cache = array(
            'content'   => $retval,
            'vars'      => $actionInstance->getVarHolder()->getAll(),
            'view_name' => $this->viewName,
          );
          $this->getContext()->getResponse()->setParameter($uri.'_'.$suffix, serialize($cache), 'symfony/cache');
        }
      }

      // now render decorator template, if one exists
      if ($this->isDecorator())
      {
        $retval =& $this->decorate($retval);
      }

      // render to client
      if ($mode == sfView::RENDER_CLIENT)
      {
        $this->getContext()->getResponse()->setContent($retval);
      }
    }

    return $retval;
  }
}

?>