<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage i18n
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id$
 */
class sfI18N
{
  private
    $context             = null,
    $globalMessageSource = null,
    $messageSource       = null,
    $messageFormat       = null;

  public function initialize($context)
  {
    $this->context = $context;

    include(sfConfigCache::getInstance()->checkConfig(sfConfig::get('sf_app_config_dir_name').'/i18n.yml'));

    $this->globalMessageSource = $this->createMessageSource(sfConfig::get('sf_app_i18n_dir'));

    $this->globalMessageFormat = $this->createMessageFormat($this->globalMessageSource);
  }

  public function setMessageSourceDir($dir, $culture)
  {
    $this->messageSource = $this->createMessageSource($dir);
    $this->messageSource->setCulture($culture);

    $this->messageFormat = $this->createMessageFormat($this->messageSource);
  }

  public function createMessageSource($dir)
  {
    if (in_array(sfConfig::get('sf_i18n_source'), array('Creole', 'MySQL', 'SQLite')))
    {
      $messageSource = sfMessageSource::factory(sfConfig::get('sf_i18n_source'), sfConfig::get('sf_i18n_database', 'default'));
    }
    else
    {
      $messageSource = sfMessageSource::factory(sfConfig::get('sf_i18n_source'), $dir);
    }

    if (sfConfig::get('sf_i18n_cache'))
    {
      $subdir = str_replace(sfConfig::get('sf_root_dir'), '', $dir);

      $cache_dir = sfConfig::get('sf_i18n_cache_dir').$subdir;

      // create cache dir if needed
      if (!is_dir($cache_dir))
      {
        $cache_dir = str_replace('/', DIRECTORY_SEPARATOR, $cache_dir);
        $current_umask = umask(0000);
        @mkdir($cache_dir, 0777, true);
        umask($current_umask);
      }

      $messageSource->setCache(new sfMessageCache($cache_dir));
    }

    return $messageSource;
  }

  public function createMessageFormat($source)
  {
    $messageFormat = new sfMessageFormat($source);

    if (sfConfig::get('sf_debug') && sfConfig::get('sf_i18n_debug'))
    {
      $messageFormat->setUntranslatedPS(array(sfConfig::get('sf_i18n_untranslated_prefix'), sfConfig::get('sf_i18n_untranslated_suffix')));
    }

    return $messageFormat;
  }

  public function setCulture($culture)
  {
    if ($this->messageSource)
    {
      $this->messageSource->setCulture($culture);
    }

    $this->globalMessageSource->setCulture($culture);
  }

  public function getMessageSource()
  {
    return $this->messageSource;
  }

  public function getGlobalMessageSource()
  {
    return $this->globalMessageSource;
  }

  public function getMessageFormat()
  {
    return $this->messageFormat;
  }

  public function getGlobalMessageFormat()
  {
    return $this->globalMessageFormat;
  }

  public function __($string, $args = array(), $catalogue = 'messages')
  {
    $retval = $this->messageFormat->formatExists($string, $args, $catalogue);

    if (!$retval)
    {
      $retval = $this->globalMessageFormat->format($string, $args, $catalogue);
    }

    return $retval;
  }

  public static function getCountry($iso, $culture)
  {
    $c = new sfCultureInfo($culture);
    $countries = $c->getCountries();

    return (array_key_exists($iso, $countries)) ? $countries[$iso] : '';
  }

  public static function getNativeName($culture)
  {
    $cult = new sfCultureInfo($culture);
    return $cult->getNativeName();
  }

  // Return timestamp from a date formatted with a given culture
  public static function getTimestampForCulture($date, $culture)
  {
    list($d, $m, $y) = self::getDateForCulture($date, $culture);
    return mktime(0, 0, 0, $m, $d, $y);
  }

  // Return a d, m and y from a date formatted with a given culture
  public static function getDateForCulture($date, $culture)
  {
    if (!$date) return 0;

    $dateFormatInfo = @sfDateTimeFormatInfo::getInstance($culture);
    $dateFormat = $dateFormatInfo->getShortDatePattern();

    // We construct the regexp based on date format
    $dateRegexp = preg_replace('/[dmy]+/i', '(\d+)', $dateFormat);

    // We parse date format to see where things are (m, d, y)
    $a = array(
      'd' => strpos($dateFormat, 'd'),
      'm' => strpos($dateFormat, 'M'),
      'y' => strpos($dateFormat, 'y'),
    );
    $tmp = array_flip($a);
    ksort($tmp);
    $i = 0;
    $c = array();
    foreach ($tmp as $value) $c[++$i] = $value;
    $datePositions = array_flip($c);

    // We find all elements
    if (preg_match("~$dateRegexp~", $date, $matches))
    {
      // We get matching timestamp
      return array($matches[$datePositions['d']], $matches[$datePositions['m']], $matches[$datePositions['y']]);
    }
    else
    {
      return null;
    }
  }
}
