<?php

/**
 * HTML related utilities. HTML markup to RSS markup conversion,
 * simplification of HTML to a short list of legal tags and no 
 * dangerous attributes, mailto: obfuscation, word count limit
 * that preserves valid HTML markup, and basic text-to-HTML
 * conversion that preserves line breaks and creates links.
 *
 * doc-to-HTML conversion has been removed as it's out of scope for
 * pkToolkitPlugin which should contain lightweight stuff only.
 * We should consider putting that out as a separate plugin.
 *
 * @author Tom Boutell <tom@punkave.com>
 */

class pkHtml
{
  static private $badPunctuation = 
    array('“', '”', '®', '‘', '’');
  static private $badPunctuationReplacements = 
    array('&lquot;', '&rquot;', '&reg;', '&lsquo;', '&rsquo;');

  static private $rssEntityMap = 
    array('&lquot;' => '\"',
      '&rquot;' => '\"',
      '&reg;' => '(Reg TM)', 
      '&lsquo;' => '\'',
      '&rsquo;' => '\'',
      '&bull' => '*',
      '&amp;' => '&amp;',
      '&lt;' => '&lt;',
      '&gt;' => '&gt;'
    );

  // Right now this just converts obscure HTML entities to 
  // simpler stuff that all feed readers will digest.
  public static function htmlToRss($doc)
  {
    // Eval stuff like this is not the quickest. There 
    // must be a better way. We should be saving a
    // pre-RSSified version of posts, for one thing.
    return preg_replace(
      '/(&\w+;)/e', 
      "pkHtml::entityToRss('$1')",
      $doc);
  }
  public static function entityToRss($entity)
  {
    if (isset(self::$rssEntityMap[$entity]))
    {
      return self::$rssEntityMap[$entity];
    } 
    else
    {
      return '';
    }
  }

  // allowedTags can be an array of tag names, without < and > delimiters, 
  // or a continuous string of tag names bracketed by < and > (as strip_tags 
  // expects). 
  
  // If the 'a' tag is in allowedTags, then we allow the href attribute on 
  // that (but not JavaScript links). If the 'img' tag is in allowedTags, 
  // then we allow the src attribute on that (but no JavaScript there either).

  // If $complete is true, the returned string will be a complete
  // HTML 4.x document with a doctype and html and body elements.
  // otherwise, it will be a fragment without those things
  // (which is what you almost certainly want).

  static public function simplify($value, $allowedTags, $complete = false)
  {
    $value = trim($value);
    if (!strlen($value))
    {
      // An empty string is NOT something to panic
      // and generate warnings about
      return '';
    }
    if (is_array($allowedTags))
    {
      $tags = "";
      foreach ($allowedTags as $tag)
      {
        $tags .= "<$tag>";
      }
      $allowedTags = $tags;
    }
    $value = strip_tags($value, $allowedTags);

    // Now we use DOMDocument to strip attributes. In principle of course
    // we could do the whole job with DOMDocument. But in practice it is quite
    // awkward to hoist subtags correctly when a parent tag is not on the
    // allowed list with DOMDocument, and strip_tags takes care of that
    // task just fine.

    // At first I used matt@lvi.org's function from the strip_tags 
    // documentation wiki. Unfortunately preg_replace tends to return null
    // on some of his regexps for nontrivial documents which is pretty
    // disastrous. He seems to have some greedy regexps where he should
    // have ungreedy regexps. Let's do it right rather than trying to
    // make regular expressions do what they shouldn't.

    // We also get rid of javascript: links here, a good idea from 
    // Matt's script.
    $doc = new DOMDocument();
    $doc->loadHTML($value);
    self::stripAttributesNode($doc);
    // Per user contributed notes at 
    // http://us2.php.net/manual/en/domdocument.savehtml.php
    // saveHTML forces a doctype and container tags on us; get
    // rid of those as we only want a fragment here
    $result = $doc->saveHTML();
    if ($complete)
    {
      return $result;
    }
    return preg_replace('/^<!DOCTYPE.+?>/', '', 
      str_replace( array('<html>', '</html>', '<body>', '</body>'), array('', '', '', ''), $result));
  }

  static private $goodAttributes = array(
    "a" => "href",
    "img" => "src"
  );

  static private function stripAttributesNode($node)
  {
    if ($node->hasChildNodes())
    {
      foreach ($node->childNodes as $child)
      {
        self::stripAttributesNode($child);
      }
    }
    if ($node->hasAttributes())
    {
      $removeList = array();
      foreach ($node->attributes as $index => $attr)
      {
        $bad = "javascript:";
        $good = false;
        if (isset(self::$goodAttributes[$node->nodeName]))
        {
          $attrName = self::$goodAttributes[$node->nodeName];
          if (($attr->name === $attrName) &&
            (substr($attr->value, 0, strlen($bad)) !== $bad))
          {
            // We keep this one
            $good = true;
          }
        }
        if (!$good)
        {
          // Off with its head
          $removeList[] = $attr->name; 
        }
      }
      foreach ($removeList as $name)
      {
        $node->removeAttribute($name);
      }
    }
  }

  // TODO: limitWords currently might not do a great job on typical
  // "gross" HTML without closing </p> tags and the like.

  static private $nonContainerTags = array(
    "br" => true,
    "img" => true,
    "input" => true
  );

	public static function limitWords($string, $word_limit)
	{
    # TBB: tag-aware, doesn't split in the middle of tags 
    # (we will probably use fancier tags with attributes later,
    # so this is important). Tags must be valid XHTML unless
    # all allowed tags 
	  $words = preg_split("/(\<.*?\>|\s+)/", $string, -1, 
      PREG_SPLIT_DELIM_CAPTURE);
    $wordCount = 0;
    # Balance tags that need balancing. We don't have strict XHTML
    # coming from OpenOffice (oh, if only) so we'll have to keep a
    # list of the tags that are containers.
    $open = array();
    $result = "";
    $count = 0;
    foreach ($words as $word) {
      if ($count >= $word_limit) {
        break;
      } elseif (preg_match("/\<.*?\/\>/", $word)) {
        # XHTML non-container tag, we don't have to guess
        $result .= $word;
        continue;
      } elseif (preg_match("/\<(\w+)/s", $word, $matches)) {
        $tag = $matches[1];
        $result .= $word;
        if (isset(pkHtml::$nonContainerTags[$tag])) {
          continue;
        }
        $open[] = $tag;
      } elseif (preg_match("/\<\/(\w+)/s", $word, $matches)) {
        $tag = $matches[1];
        if (!count($open)) {
          # Groan, extra close tag, ignore
          continue;
        }
        $last = array_pop($open);    
        if ($last !== $tag) {
          # They closed the wrong tag. Again, ignore for now, but 
          # we might want to work on a better solution
          continue;
        }
        $result .= $word;
      } elseif (preg_match("/^\s+$/s", $word)) {
        $result .= $word;
      } else {
        if (strlen($word)) {
          $count++;
          $result .= $word;
        }
      }
    }
    for ($i = count($open) - 1; ($i >= 0); $i--) {
      $result .= "</" . $open[$i] . ">";
    }
    return $result;
  }

  public static function toText($html)
  {
    # Nothing fancy, we use the text for indexing only anyway.
    # It would be nice to do a prettier job here for future applications
    # that need pretty plaintext representations. That would be useful 
    # as an alt-body in emails
    $txt = strip_tags($html);
    return $txt;
  }

  public static function obfuscateMailto($html)
  {
    # Obfuscates any mailto: links found in $html. Good if you already
    # have nice HTML from FCK or what have you. 
    
    # ACHTUNG: mailto links will become simply
    # <a href="mailto:foo@bar.com">foo@bar.com</a> (in the final
    # presentation to the user, after obfuscation via javascript). If 
    # there is other markup, ids, CSS classes, blah blah blah, it will
    # get chucked. This is usually not a problem for code that
    # comes from FCK etc. If it is a problem for you, make
    # this method smarter. Also consider just wrapping the link in
    # a span or div, which will not lose its class, id, etc. TBB

    return preg_replace("/\<a[^\>]*?href=\"mailto\:(.*?)\@(.*?)\".*?\>.*?\<\/a\>/ise", 
      "pkHtml::obfuscateMailtoInstance(\"$1\", \"$2\")",
      $html);
  }
  public static function obfuscateMailtoInstance($user, $domain)
  {
      $code = "document.write('<a href=\"mailto:$user@$domain\">$user@$domain</a>')";
      return "<script>eval('" . pkHtml::jsEscape($code) . "');</script>";
  }
  static public function jsEscape($str)
  {

    $new_str = '';

    for($i = 0; ($i < strlen($str)); $i++) {
      $new_str .= '\\x' . dechex(ord(substr($str, $i, 1)));
    }

    return $new_str;
  }
  static public function textToHtml($text)
  {
    # Just the basics: escape entities, turn URLs into links, and turn
    # newlines into line breaks.
    $text = htmlentities($text);
    $text = preg_replace(
      "/(http\:.*?)([\s\]\)\}]|$)/", "<a href=\"$1\">$1</a>$2", $text);
    $text = preg_replace("/\n/", "<br />\n", $text);
    return $text;
  }

  // For any given HTML, returns only the img tags. If 
  // format is set to array, the result is returned as an array
  // in which each element is an associative array with, at a
  // minimum, a src attribute and also width, height, alt and title
  // attributes if they were present in the tag. If format
  // is set to html, an array of the original <img> tags
  // is returned without further processing.

  static public function getImages($html, $format = 'array')
  {
    $allowed = array_flip(array("src", "width", "height", "title", "alt"));
    if (!preg_match_all("/\<img\s.*?\/?\>/i", $html, $matches, PREG_PATTERN_ORDER))
    {
      return array();
    }
    $images = $matches[0];
    if (empty($images))
    {
      return array();
    }
    
    if ($format == 'array')
    {
      $images_info = array();
      foreach ($images as $image)
      {
        // Use a backreference to make sure we match the same
        // type of quote beginning and ending
        preg_match_all('/(\w+)\s*=\s*(["\'])(.*?)\2/', 
          $image, 
          $matches, 
          PREG_SET_ORDER);
        $attributes = array();
        foreach ($matches as $attributeRaw)
        {
          $name = strtolower($attributeRaw[1]);
          $value = $attributeRaw[3];
          if (!isset($allowed[$name]))
          {
            continue;
          }
          $attributes[$name] = $value;
        }
        if (!isset($attributes['src']))
        {
          continue;
        }
        $images_info[] = $attributes;
      }
      
      return $images_info;
    }

    return $images;
  }
}

?>
