<?php

function get_tag_links($tags, $blog)
{
  $links = array();
  foreach($tags as $tag)
  {
    $links[] = link_to($tag, 'sfBlog/blogTag?blog_title='.$blog->getStrippedTitle().'&tag='.$tag);
  } 
  
  return implode($links, ', ');
}

function link_to_post($post, $text = '', $options = array())
{
  if(!$text)
  {
    $text = $post->getTitle();
  }
  return link_to2($text, 'post', array('sf_subject' => $post), $options);
}

function link_to_blog($blog, $text = '', $page = 1, $options = array())
{
  if(!$text)
  {
    $text = $blog->getTitle();
  }
  $params = array('sf_subject' => $blog);
  if($page > 1)
  {
    $params['page'] = $page;
  }
  return link_to2($text, 'blog', $params, $options);
}

function get_post_list_title($params, $page = null, $blog = null)
{
  sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N', 'Date'));
  $ret = '';
  if (isset($params['tag']))
  {
    $ret .= ' ' . __('tagged "%tags%"', array(
      '%tags%' => $params['tag']
    ));
  }
  if (isset($params['month']))
  {
    $ret .= ' ' . __('published in %month%', array(
      '%month%' => format_date(sfBlogTools::convertMonthToDate($params['month']), 'MMMM yyyy')
    ));
  }
  if (!is_null($blog))
  {
    $ret .= ' ' . __('in "%blog_title%"', array(
      '%blog_title%' => $blog instanceof sfBlog ? $blog->getTitle() : sfConfig::get('app_sfBlogs_title', 'How is life on earth?')
    ));
  }
  if($ret)
  {
    $ret = __('Posts') . $ret;
    if ($page > 1)
    {
      $ret .= ' ' . __('(page %page%)', array('%page%' => $page));
    }
  }
  return $ret;
}

