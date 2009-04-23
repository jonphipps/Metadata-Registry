<?php
/*
 * This file is part of the sfPropelActAsCommentableBehavior package.
 *
 * (c) 2007-2009 Xavier Lacot <xavier@lacot.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
 * This behavior permits to attach comments to Propel objects. Some more bits
 * about the philosophy of the stuff:
 *
 * - commentable objects must have a primary key
 * - comments can only be attached on objects that have already been saved
 * - comments are saved when applied
 *
 * @author   Xavier Lacot <xavier@lacot.org>
 * @see      http://www.symfony-project.org/plugins/sfPropelActAsCommentableBehaviorPlugin
 */

class sfPropelActAsCommentableBehavior
{
  /**
   * Adds a comment to the object. The "comment" param can be an associative
   * array (in which each element represents one of the comment properties), or
   * an array of associative arrays. In this case, it adds all the comments to
   * the object.
   *
   * @param      BaseObject  $object
   * @param      array       $comment
   */
  public function addComment(BaseObject $object, $comment)
  {
    if ($object->isNew() === true)
    {
      throw new Exception('Comments can only be attached to already saved objects');
    }

    if (is_array($comment))
    {
      if (!isset($comment['text']))
      {
        foreach ($comment as $onecomment)
        {
          $this->addComment($object, $onecomment);
        }
      }
      else
      {
        if (strlen($comment['text']) > 0)
        {
          if (isset($comment['title']))
          {
            $comment['title'] = strip_tags($comment['title']);
          }

          if (isset($comment['title']))
          {
            $comment['author_name']  = strip_tags($comment['author_name']);
          }

          $comment['text'] = sfPropelActAsCommentableStripper::clean($comment['text']);
          $comment['created_at'] = time();

          if (!isset($comment['namespace']))
          {
            $comment['namespace'] = null;
          }

          $comment['comment_namespace'] = $comment['namespace'];
          $comment_object = new sfComment();
          $comment_object->fromArray($comment, BasePeer::TYPE_FIELDNAME);
          $comment_object->setCommentableId($object->getPrimaryKey());
          $comment_object->setCommentableModel(get_class($object));
          $comment_object->save();

          $count_options = sfConfig::get('app_sfPropelActAsCommentableBehaviorPlugin_count', array());
          $count_options = array_merge(array('method'    => 'setSfCommentCount',
                                             'enabled'   => true,
                                             'namespace' => false),
                                       $count_options);

          if ($count_options['enabled']
              && is_callable(array(get_class($object), $count_options['method'])))
          {
            if (($count_options['namespace'] !== false)
                && $comment['namespace'] === $count_options['namespace'])
            {
              $options = array('namespace' => $count_options['namespace']);
              call_user_func(array($object, $count_options['method']),
                             $this->getNbComments($object, $options));
            }
            elseif (false === $count_options['namespace'])
            {
              call_user_func(array($object, $count_options['method']),
                             $this->getNbComments($object));
            }

            $object->save();
          }

          return $comment_object;
        }
      }
    }
    elseif (is_string($comment))
    {
      $this->addComment($object, array('text' => $comment));
    }
    else
    {
      new Exception('A comment must be represented as string or an associative array with a "text" key');
    }
  }

  /**
   * Deletes all the comments attached to the object
   *
   * @param      BaseObject  $object
   * @return     boolean
   */
  public function clearComments(BaseObject $object, $namespace = null)
  {
    $c = new Criteria();
    $c->add(sfCommentPeer::COMMENTABLE_ID, $object->getPrimaryKey());
    $c->add(sfCommentPeer::COMMENTABLE_MODEL, get_class($object));

    if ($namespace != null)
    {
      $c->add(sfCommentPeer::COMMENT_NAMESPACE, $namespace);
    }

    return sfCommentPeer::doDelete($c);
  }

  /**
   * Returns the list of the comments attached to the object. The options array
   * can contain several options :
   * - order : order of the comments
   *
   * @param      BaseObject  $object
   * @param      Array       $options
   * @param      Criteria    $criteria
   *
   * @return     Array
   */
  public function getComments(BaseObject $object, $options = array(), Criteria $criteria = null)
  {
    $c = $this->getCommentsCriteria($object, $options, $criteria);
    $comment_objects = sfCommentPeer::doSelect($c);
    $comments = array();

    foreach ($comment_objects as $comment_object)
    {
      $comment = $comment_object->toArray();
      $comments[] = $comment;
    }

    return $comments;
  }

  /**
   * Returns a criteria for comments selection. The options array
   * can contain several options :
   * - order : order of the comments
   *
   * @param      BaseObject  $object
   * @param      Array       $options
   * @param      Criteria    $criteria
   *
   * @return     Array
   */
  protected function getCommentsCriteria(BaseObject $object, $options = array(), Criteria $criteria = null)
  {
    if ($criteria != null)
    {
      $c = clone $criteria;
    }
    else
    {
      $c = new Criteria();
    }

    $c->add(sfCommentPeer::COMMENTABLE_ID, $object->getPrimaryKey());
    $c->add(sfCommentPeer::COMMENTABLE_MODEL, get_class($object));

    if (isset($options['namespace']))
    {
      $c->add(sfCommentPeer::COMMENT_NAMESPACE, $options['namespace']);
    }

    if (isset($options['order']) && ($options['order'] == 'desc'))
    {
      $c->addDescendingOrderByColumn(sfCommentPeer::CREATED_AT);
      $c->addDescendingOrderByColumn(sfCommentPeer::ID);
    }
    else
    {
      $c->addAscendingOrderByColumn(sfCommentPeer::CREATED_AT);
      $c->addAscendingOrderByColumn(sfCommentPeer::ID);
    }

    return $c;
  }

  /**
   * Returns the number of the comments attached to the object.
   *
   * @param      BaseObject  $object
   * @param      Array       $options
   * @param      Criteria    $criteria
   *
   * @return     integer
   */
  public function getNbComments(BaseObject $object, $options = array(), Criteria $criteria = null)
  {
    $c = $this->getCommentsCriteria($object, $options, $criteria);
    return sfCommentPeer::doCount($c);
  }

  /**
   * Removes one comment from the object.
   *
   * @param      BaseObject  $object
   */
  public function removeComment(BaseObject $object, $comment_id)
  {
    $c = new Criteria();
    $c->add(sfCommentPeer::COMMENTABLE_ID, $object->getPrimaryKey());
    $c->add(sfCommentPeer::COMMENTABLE_MODEL, get_class($object));
    $c->add(sfCommentPeer::ID, $comment_id);
    return sfCommentPeer::doDelete($c);
  }
}