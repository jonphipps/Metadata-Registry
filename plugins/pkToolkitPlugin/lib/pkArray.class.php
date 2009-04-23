<?php

// TBB: these may seem trivial but they eliminate a lot of dumb
// tests and gratuitous loop variables and accidental bugs in templates.

class pkArray 
{
  // Return first element of array. If there isn't one, or it's
  // not an array, or it's not set, return false.
  public static function first(&$array)
  {
    if (isset($array) && (is_array($array)) && (count($array) > 0)) {
      return $array[0];
    } else {
      return false;
    }
  }
  // Return last element of array. If there isn't one, or it's
  // not an array, or it's not set, return false.
  public static function last(&$array)
  {
    if (isset($array) && (is_array($array)) && (count($array) > 0)) {
      return $array[count($array) - 1];
    } else {
      return false;
    }
  }

  // "One of these fields is bound to contain something interesting..."
  // Returns the first value in the array that isn't made up entirely
  // of trimmable whitespace.
  public static function firstNontrivial(&$array)
  {
    foreach ($array as $value) {
      if (strlen(trim($value))) {
        return $value;
      }
    }
    return false;
  }

  // Sort an array by the stringification of each element.
  // Works for objects; would work fine for strings too.
  // Why this is not standard is a mystery to me.
  public static function sort(&$array)
  {
    return usort($array, array('pkArray', 'compare'));
  }

  // Same idea, case insensitive.
  public static function sortInsensitive(&$array)
  {
    return usort($array, array('pkArray', 'compareInsensitive'));
  }

  // Like array_search, this method returns the offset of the
  // value within the array, if it is present, false otherwise.

  // However, 'strict' has three possible values, extending its meaning in
  // the standard PHP array functions:

  // false: items are compared with ==

  // true: items are compared with ===

  // 'id': items are compared with the getId() method of the values,
  // which must be objects

  // If you find yourself calling this often in a loop, though, promise me 
  // you'll create an associative array instead.

  public static function search(&$array, $value, $strict)
  {
    if ($strict === 'id')
    {
      $count = count($array);
      if (!$count)
      {
        return false;
      }
      $vid = $value->getId();
      for ($i = 0; ($i < $count); $i++)
      {
        if ($vid == $array[$i]->getId())
        {
          return $i;
        }
      }
      return false;
    }
    return array_search($array, $value, $strict);
  }

  // Search the array, find the item, return the index of the *previous*
  // item. If wrap is specified, a request for the first item
  // returns the last item, otherwise it returns false. If the
  // array is empty this function always returns false. If the item is
  // not in the array this function always returns false. If the
  // array is one element long the index of that element is returned.
  // Uses pkArray::search(), so 'id' is an allowed value for $strict.

  // This is great for creating "Previous" links.

  public static function before(&$array, $value, $strict = false, $wrap = false)
  {
    $index = self::search($array, $value, $strict);
    if ($index === false)
    {
      return false;
    }
    if ($index == 0)
    {
      if ($wrap)
      {
        return count($array) - 1;
      }
      else
      {
        return false;
      }
    }
    return $index - 1;
  }

  // Search the array, find the item, return the index of the *next*
  // item. If wrap is specified, a request for the last item
  // returns the first item, otherwise it returns false. If the
  // array is empty this function always returns false. If the item is
  // not in the array this function always returns false. If the
  // array is one element long the index of that sole element is returned.
  // Uses pkArray::search(), so 'id' is an allowed value for $strict.

  // This is great for creating "Next" links.

  public static function after(&$array, $value, $strict = false, $wrap = false)
  {
    $index = self::search($array, $value, $strict);
    if ($index === false)
    {
      return false;
    }
    if ($index == (count($array) - 1))
    {
      if ($wrap)
      {
        return 0;
      }
      else
      {
        return false;
      }
    }
    return $index + 1;
  }

  // Given an array of objects, return an array of ids
  // obtained by calling getId() on each (but see listToHashById)

  public static function getIds(&$array)
  {
    return self::getResultsForMethod($array, 'getId');
  }

  // Given an array of objects and a method, return an array consisting
  // of the results obtained by calling the method on each object

  public static function getResultsForMethod(&$array, $method)
  {
    $results = array();
    foreach ($array as $item)
    {
      $results[] = call_user_func(array($item, $method));
    }
    return $results;
  }

  // Given a flat array of objects, returns an associative
  // array indexed by ids as returned by getId()

  public static function listToHashById(&$array)
  {
    $hash = array();
    foreach ($array as $item)
    {
      $hash[$item->getId()] = $item;
    }
    return $hash;
  }

  // Helpers for the above. 

  // Compare two objects as strings via their string conversion methods.

  public static function compare($a, $b)
  {
    // PHP 5.1.x doesn't apply __toString outside of
    // echo and print statements. Grr
    $s1 = self::toString($a);
    $s2 = self::toString($b);
    # If we knew we were on 5.2.x, we could just do this
    # $s1 = "$a";
    # $s2 = "$b";
    if ($s1 == $s2)
    {
      return 0;
    }
    return ($s1 < $s2) ? -1 : 1;
  }

  // Should be PHP 5.1.x-safe
  private static function toString($a)
  {
    if (is_object($a) && method_exists($a, '__toString'))
    {
      return $a->__toString();
    } 
    else
    {
      return "$a";
    }
  }

  // Case insensitive version of the same thing

  public static function compareInsensitive($a, $b)
  {
    // PHP 5.1.x doesn't apply __toString outside of
    // echo and print statements. Grr
    $s1 = strtolower(self::toString($a));
    $s2 = strtolower(self::toString($b));
    # If we knew we were on 5.2.x, we could just do this
    # $s1 = strtolower("$a");
    # $s2 = strtolower("$b");
    if ($s1 == $s2)
    {
      return 0;
    }
    return ($s1 < $s2) ? -1 : 1;
  }
}


