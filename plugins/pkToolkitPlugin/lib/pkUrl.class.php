<?php

class pkUrl
{
  static public function addParams($path /*, $paramhash1, $paramhash2, */)
  {
    # http_build_query is nice but limited: it's not much use for
    # modifying an existing URL that may or may not already contain
    # a query string with one or more parameters. That's the gap this
    # method fills:

    # Add a hash of GET-method parameters to any URL. If there
    # is no ? it is added. If there are existing parameters
    # the leading & is supplied correctly. urlencode is called
    # correctly, etc. 

    # You can pass as many hashes of parameters
    # as you wish, they get merged together. This is nice
    # in templates because you can avoid playing with variables.

    # Settings in later hashes override those found in earlier hashes
    # or already packed in the $path. Passing a parameter with a false 
    # value will remove that parameter from the URL if already present.

    # ADG: added limited support for arrays as values (only one level deep).
    # We should work on generalizing this to handle nested arrays
    # just as http_build_query can.

    $params = array();
    $pos = strpos($path, '?');
    if ($pos !== false) {
      $ppairs = explode("&", substr($path, $pos + 1));  
      $path = substr($path, 0, $pos);
      foreach ($ppairs as $pair) {
        // TBB 02/10/2009: careful, you will get one empty item if the
        // string is empty after the ?
        if (!strlen($pair))
        {
          continue;
        }
        list($key, $val) = explode("=", $pair);
        $key = urldecode($key);
        $val = urldecode($val);
        $params[$key] = $val;
      }
    }
    for ($i = 1; ($i < func_num_args()); $i++) {
      $arg = func_get_arg($i);
      if (is_array($arg)) {
        $params = array_merge($params, $arg);
      }
    }
    # Filter out the blank parameters. That way
    # Symfony doesn't generate things like /foo// that
    # it will subsequently misinterpret. TBB

		/**
		 * Also, look for any potential params that are arrays, and break them out to be generated
		 * in the foreach below.
		 */
    $nparams = array();
    foreach ($params as $key => $val)
		{
			if (!is_array($val))
			{
	      if (!strlen($val))
				{
	        continue;
	      }

	      $nparams[$key] = $val;
			}
			else
			{
				foreach ($val as $key2 => $val2)
				{
		      if (!strlen($val2))
					{
		        continue;
		      }

		      $nparams[$key.'['.$key2.']'] = $val2;
				}
			}
    }
    $params = $nparams;
    if (!count($params)) {
      return $path;
    }
    $path .= "?";
    $first = true;
    foreach ($params as $key => $val) {
      if (!$first) {
        $path .= "&";
      }
      $first = false;
			
      $path .= urlencode($key) . "=" . urlencode($val);
    } 
    return $path;
  }
}

