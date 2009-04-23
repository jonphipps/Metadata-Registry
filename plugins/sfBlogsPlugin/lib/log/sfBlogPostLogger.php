<?php 

class sfBlogPostLogger
{
  public static function create($post, $author)
  {
    foreach ($post->getsfBlog()->getUsers() as $user)
    {
      $blog = $post->getsfBlog();
      $log = new sfBlogLog();
      $log->setElements($user, $author, 'create_post', $post, 'Post "%object%" created in "%complement%"', '%subject% created a new post: "%object%" in "%complement%"', $blog);
      $log->setObjectLink('sfBlogAdmin/postEdit?id='.$post->getId());
      $log->setComplementLink('sfBlogAdmin/blogEdit?id='.$blog->getId());
      $log->save();
    }
  }

  public static function update($post, $author)
  {
    foreach ($post->getsfBlog()->getUsers() as $user)
    {
      $log = DbFinder::from('sfBlogLog')->
        relatedTo($user)->
        where('SubjectId', $user->getId())->
        where('ObjectClass', 'sfBlogPost')->
        where('ObjectId', $post->getId())->
        where('CreatedAt', '>', strtotime('today'))->
        findLast();
      if($log && ($log->getVerb() == 'update_post'))
      {
        // The latest log on that blog today is an update: change the date to avoid multiple update logs
        $log->setObjectName((string) $post);
        $log->setCreatedAt(time());
      }
      else
      {
        // No update since last action on this blog: create a new log
        $log = new sfBlogLog();
        $log->setElements($user, $author, 'update_post', $post, 'Post "%object%" updated', '%subject% updated post "%object%"');
        $log->setObjectLink('sfBlogAdmin/postEdit?id='.$post->getId());
      }
      $log->save();
    }
  }
  
  public static function publish($post, $author)
  {
    foreach ($post->getsfBlog()->getUsers() as $user)
    {
      $blog = $post->getsfBlog();
      $log = new sfBlogLog();
      $log->setElements($user, $author, 'publish_post', $post, 'Post "%object%" published in %complement%', '%subject% published post "%object%" in %complement%', $blog);
      $log->setObjectLink(sfBlogTools::generatePostUri($post));
      $log->setComplementLink('sfBlogAdmin/blogEdit?id='.$blog->getId());
      $log->save();
    }
  }

  public static function unpublish($post, $author)
  {
    foreach ($post->getsfBlog()->getUsers() as $user)
    {
      $log = new sfBlogLog();
      $log->setElements($user, $author, 'unpublish_post', $post, 'Post "%object%" unpublished', '%subject% unpublished post "%object%"');
      $log->setObjectLink('sfBlogAdmin/postEdit?id='.$post->getId());
      $log->save();
    }
  }

  public static function delete($post, $author)
  {
    foreach ($post->getsfBlog()->getUsers() as $user)
    {
      $log = new sfBlogLog();
      $log->setElements($user, $author, 'delete_post', $post, 'Post "%object%" deleted', '%subject% deleted post "%object%"');
      $log->save();
    }
    // remove link from logs on the same post
    DbFinder::from('sfBlogLog')->
      where('ObjectClass', 'sfBlogPost')->
      where('ObjectId', $post->getId())->
      set(array('ObjectLink' => ''));
  }

}