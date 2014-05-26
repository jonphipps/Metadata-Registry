<?php
  /**
  * UriHelper
  *
  * Requires PHP version 5
  *
  * @category     NSDL Services
  * @package      symfony
  * @subpackage   helper
  * @author       {@link mailto:jphipps@cs.cornell.edu?subject=Re:RegistryHelper Jon Phipps}.
  * @version      SVN: $Id:$
  */

/**
* Returns a truncated URI
*
* If the URI is a registry URI then it removes from the display the domain of the URI
* otherwise it removes everything but the last x number of characters
*
* The full URI is included as a label
*
* @return string
* @param string  $text The URI to truncate
* @param integer $length The maximum length of the URI
* @param string  $truncate_string The string to insert to replace the truncated text
*/
function truncate_uri($text, $length = 30, $truncate_string = '...')
{
  if ($text == '')
  {
    return '';
  }

  //replace the # with %23
  $fullText = preg_replace('/#(.+)/', '%23$1', $text);

  //check for a registry URI and strip it before checking the length
  $baseDomain = rtrim(sfConfig::get('app_base_domain') ," /");
  if (false !== strpos($text, $baseDomain))
  {
    $text = str_replace($baseDomain, '', $text);
  }

  if (strlen($text) > $length)
  {
    //this will start from the
    if (preg_match('/([-A-Z0-9.]+)(\/[-A-Z0-9+&@#\/%=~_|!:,.;?]*)/i', $text, $regs))
    {
      $truncate_text = $regs[2];

      //this will keep lopping off pieces of the URI at the '/' until we can't do it any more or it's shorter
      while (strlen($truncate_text) > $length)
      {
        if (preg_match('/([-A-Z0-9.]+)(\/[-A-Z0-9+&@#\/%=~_|!:,.;?]*)/i', $truncate_text, $regs))
        {
          $truncate_text = $regs[2];
        }
        else
        {
          $truncate_text = substr($truncate_text, -$length, $length);
        }
      }
    }
    else
    {
      $truncate_text = substr($text, -$length, $length);
    }
  }
  else
  {
    $truncate_text = $text;
  }

  $newURI = '<a href="' . $fullText . '" title="' . $fullText . '">' . $truncate_string . $truncate_text . '</a>';

  return $newURI;
}

?>
