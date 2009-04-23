<?php

/**
 * Tools, utilities and snippets collected and composed...
 */

class pkString
{
	/**
	* Limits the number of words in a string.
	*
	* @param string $string
	*
	* @param uint $word_limit
	*   number of words to return
	* 
	* @param optional array
	* 	if $options['append_ellipsis'] is set, append an ellipsis to the end 
  *   of strings that have been truncated
	*
	* @return string
	*   new string containing only words up to the word limit.
	*/
	public static function limitWords($string, $word_limit, $options = array())
	{
	  $words = explode(' ', $string, $word_limit + 1);
    $num_words = count($words);

		# TBB: if there are $word_limit words or less, this check is necessary
    # to prevent the last word from being lost.
		if ($num_words > $word_limit)
		{
      array_pop($words);
    }
	  
		$string = implode(' ', $words);
		
		$append_ellipsis = false;
		if (isset($options['append_ellipsis']))
		{
			$append_ellipsis = $options['append_ellipsis'];
		}
		if ($append_ellipsis == true && $num_words > $word_limit)
		{
			$string .= '...';
		}
		
		return $string;
	}

	/**
	* Limits the number of characters in a string.
	*
	* @param string $string
	*
	* @param uint $character_limit
	*   maximum number of characters to return, inclusive of any added ellipsis
	* 
	* @param optional array
	* 	if $options['append_ellipsis'] is set, append an ellipsis to the end 
  *   of strings that have been truncated
	*
	* @return string
	*   new string containing only characters up to the limit
  * 
  * Suitable when a word count limit is not enough (because words are
  * sometimes unreasonably long).
  *
  * Tries to preserve word boundaries, but not too hard, as very long words can
  * create problems of their own.
	*/
  public static function limitCharacters($s, $length, $options)
  {
    $ellipsis = "";
    if (isset($options['append_ellipsis']) && $options['append_ellipsis'])
    {
      $ellipsis = "...";
    }
    if ($length < 12)
    {
      // Not designed to be elegant below this length
      return substr($s, 0, $length);
    }
    if (strlen($s) > $length)
    {
      $s = substr($s, 0, $length - strlen($ellipsis));
      $slength = strlen($s);
      for ($i = 1; ($i <= 10); $i++)
      {
        $c = substr($s, $slength - $i, 1);
        if (($c === ' ') || ($c === '\t') || ($c === '\r') || ($c === '\n'))
        {
          return substr($s, 0, $slength) . $ellipsis;
        }
      }
      return $s . $ellipsis;
    }
    return $s;
  }
	
 	/**
  *
	* Accepts an array of keywords and a text; returns the portion of the
  * text beginning a few words prior to the first keyword encountered,
  * and continuing to the end of the text. If none of the keywords are
  * seen, returns the entire text.
  *
	* @param array $terms keywords
  * @param string $text
	*
	* @return string
  *
	*/
  public static function beginNear($keywords, $text)
  {
    foreach ($keywords as $keyword) {
      # TODO: can we do this without so many calls? I don't want
      # to capture an arbitrary number of words preceding - no more
      # than three - and I don't want to reject cases with fewer
      # than three preceding either. 
      $keyword = addslashes($keyword);
      for ($wordsPreceding = 3; ($wordsPreceding >= 0); $wordsPreceding--) {
        $regexp = "(" . 
          str_repeat("\w+\W+", $wordsPreceding) . ")(" . $keyword . ")" . "(.*)/is";
        if (preg_match("/^" . $regexp, $text, $matches)) {
          return $matches[1] . "<b>" . $matches[2] . "</b>" . $matches[3]; 
        } 
        if (preg_match("/" . $regexp, $text, $matches)) {
          return "... " . $matches[1] . "<b>" . $matches[2] . "</b>" . $matches[3]; 
        } 
      }
    }
    return false;
  }
}

?>
