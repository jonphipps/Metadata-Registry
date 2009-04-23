<?php 

class sfBlogLogger
{
  public static function create($blog, $author)
  {
    $log = new sfBlogLog();
    $log->setElements($author, $author, 'create_blog', $blog, 'New blog: "%object%"');
    $log->setObjectLink('sfBlogAdmin/blogEdit?id='.$blog->getId());
    $log->save();
  }

  public static function update($blog, $author)
  {
    foreach ($blog->getUsers() as $user)
    {
      $log = DbFinder::from('sfBlogLog')->
        relatedTo($user)->
        where('SubjectId', $user->getId())->
        where('ObjectClass', 'sfBlog')->
        where('ObjectId', $blog->getId())->
        where('CreatedAt', '>', strtotime('today'))->
        findLast();
      if($log && ($log->getVerb() == 'update_blog'))
      {
        // The latest log on that blog today is an update: change the date to avoid multiple update logs
        $log->setObjectName((string) $blog);
        $log->setCreatedAt(time());
      }
      else
      {
        // No update since last action on this blog: create a new log
        $log = new sfBlogLog();
        $log->setElements($user, $author, 'update_blog', $blog, 'Blog "%object%" updated', '%subject% updated blog "%object%"');
        $log->setObjectLink('sfBlogAdmin/blogEdit?id='.$blog->getId());
      }
      $log->save();
      
    }
  }
  
  public static function delete($blog, $author)
  {
    foreach ($blog->getUsers() as $user)
    {
      $log = new sfBlogLog();
      $log->setElements($user, $author, 'delete_blog', $blog, 'Blog "%object%" deleted', '%subject% deleted blog "%object%"');
      $log->save();
    }
    // remove link from logs on the same blog
    DbFinder::from('sfBlogLog')->
      where('ObjectClass', 'sfBlog')->
      where('ObjectId', $blog->getId())->
      set(array('ObjectLink' => ''));
    // remove links from logs on posts on the same blog
    $ids = DbFinder::from('sfBlogPost')->
      relatedTo($blog)->
      select('Id')->
      find();
    DbFinder::from('sfBlogLog')->
      where('ObjectClass', 'sfBlogPost')->
      where('ObjectId', 'in', $ids)->
      set(array('ObjectLink' => '', 'ComplementLink' => ''));
    
  }

}