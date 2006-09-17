<?php

/**
 * Log rotation batch script
 *
 * This script is used to manage log rotation, and should be called automatically by a cron task daily
 *
 * @package    ##PROJECT_NAME##
 * @subpackage batch
 * @version    $Id: rotate_log.php 1689 2006-08-21 09:35:44Z fabien $
 */

define('SF_ROOT_DIR',    realpath(dirname(__file__).'/..'));
define('SF_APP',         '##APP_NAME##');
define('SF_ENVIRONMENT', '##ENV_NAME##');
define('SF_DEBUG',       ##DEBUG##);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

if(sfConfig::get('sf_logging_active') && sfConfig::get('sf_logging_rotate'))
{
  sfLogManager::rotate(SF_APP, SF_ENVIRONMENT, sfConfig::get('sf_logging_period'), sfConfig::get('sf_logging_history'));
}
