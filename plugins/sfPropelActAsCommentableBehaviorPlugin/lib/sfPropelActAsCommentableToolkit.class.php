<?php
/*
 * This file is part of the sfPropelActAsCommentableBehavior package.
 *
 * (c) 2007-2009 Xavier Lacot <xavier@lacot.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfPropelActAsCommentableToolkit class
 *
 * @author     Xavier Lacot
 * @author     Nicolas Perriault
 * @see        http://www.symfony-project.org/plugins/sfPropelActAsCommentableBehaviorPlugin
 */
class sfPropelActAsCommentableToolkit
{
  /**
   * Add a token to available ones in the user session
   * and return generated token
   *
   * @author Nicolas Perriault
   * @param  string  $object_model
   * @param  int     $object_id
   * @return string
   */
  public static function addTokenToSession($object_model, $object_id)
  {
    $session = sfContext::getInstance()->getUser();
    $token = self::generateToken($object_model, $object_id);
    $tokens = $session->getAttribute('tokens', array(), 'sf_commentables');
    $tokens = array($token => array($object_model, $object_id)) + $tokens;
    $tokens = array_slice($tokens, 0, sfConfig::get('app_sfPropelActAsCommentableBehaviorPlugin_max_tokens', 10));
    $session->setAttribute('tokens', $tokens, 'sf_commentables');
    return $token;
  }

  /**
   * Generates token representing a commentable object from its model and its id
   *
   * @author Nicolas Perriault
   * @param  string  $object_model
   * @param  int     $object_id
   * @return string
   */
  public static function generateToken($object_model, $object_id)
  {
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
      // the client uses a proxy
      $ip_adress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip_adress = $_SERVER['REMOTE_ADDR'];
    }

    return md5(sprintf(
      '%s-%s-%s-%s',
      $ip_adress,
      $object_model,
      $object_id,
      sfConfig::get(
        'app_sfPropelActAsCommentableBehaviorPlugin_salt',
        'c0mm3nt4bl3'
      )
    ));
  }

  /**
   * retrieves the plugin's configuration
   */
  public static function getConfig()
  {
    $config = array(
      'anonymous'    => sfConfig::get('app_sfPropelActAsCommentableBehaviorPlugin_anonymous'),
      'count'        => sfConfig::get('app_sfPropelActAsCommentableBehaviorPlugin_count'),
      'date_format'  => sfConfig::get('app_sfPropelActAsCommentableBehaviorPlugin_date_format'),
      'max_tokens'   => sfConfig::get('app_sfPropelActAsCommentableBehaviorPlugin_max_tokens'),
      'namespaces'   => sfConfig::get('app_sfPropelActAsCommentableBehaviorPlugin_namespaces'),
      'salt'         => sfConfig::get('app_sfPropelActAsCommentableBehaviorPlugin_salt'),
      'use_css'      => sfConfig::get('app_sfPropelActAsCommentableBehaviorPlugin_use_css'),
      'use_gravatar' => sfConfig::get('app_sfPropelActAsCommentableBehaviorPlugin_use_gravatar'),
      'use_routes'   => sfConfig::get('app_sfPropelActAsCommentableBehaviorPlugin_use_routes'),
      'user'         => sfConfig::get('app_sfPropelActAsCommentableBehaviorPlugin_user'),
    );
    return $config;
  }

  /**
   * Returns true if the passed model name is commentable
   *
   * @author     Xavier Lacot
   * @param      string  $object_name
   * @return     boolean
   */
  public static function isCommentable($model)
  {
    if (is_object($model))
    {
      $model = get_class($model);
    }

    if (!is_string($model))
    {
      throw new Exception('The param passed to the method isCommentable must be a string.');
    }

    if (!class_exists($model))
    {
      throw new Exception(sprintf('Unknown class %s', $model));
    }

    $base_class = sprintf('Base%s', $model);
    return !is_null(sfMixer::getCallable($base_class.':addComment'));
  }

  /**
   * Retrieve a commentable object
   *
   * @param  string  $object_model
   * @param  int     $object_id
   */
  public static function retrieveCommentableObject($object_model, $object_id)
  {
    try
    {
      $peer = sprintf('%sPeer', $object_model);

      if (!class_exists($peer))
      {
        throw new Exception(sprintf('Unable to load class %s', $peer));
      }

      $object = call_user_func(array($peer, 'retrieveByPk'), $object_id);

      if (is_null($object))
      {
        throw new Exception(sprintf('Unable to retrieve %s with primary key %s', $object_model, $object_id));
      }

      if (!sfPropelActAsCommentableToolkit::isCommentable($object))
      {
        throw new Exception(sprintf('Class %s does not have the commentable behavior', $object_model));
      }

      return $object;
    }
    catch (Exception $e)
    {
      return sfContext::getInstance()->getLogger()->log($e->getMessage());
    }
  }

  /**
   * Retrieve commentable object instance from token
   *
   * @author Nicolas Perriault
   * @param  string  $token
   * @return BaseObject
   */
  public static function retrieveFromToken($token)
  {
    $session = sfContext::getInstance()->getUser();
    $tokens = $session->getAttribute('tokens', array(), 'sf_commentables');

    if (array_key_exists($token, $tokens)
        && is_array($tokens[$token])
        && class_exists($tokens[$token][0]))
    {
      $object_model = $tokens[$token][0];
      $object_id = $tokens[$token][1];
      $new_token = self::generateToken($object_model, $object_id);

      // check is token has changed or not (ie., if the user's IP has changed)
      if ($token == $new_token)
      {
        return self::retrieveCommentableObject($object_model, $object_id);
      }
    }

    return null;
  }
}