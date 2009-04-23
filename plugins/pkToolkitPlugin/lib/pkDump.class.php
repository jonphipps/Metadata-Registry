<?php

class pkDump
{
  // Attempts to output the variable as valid PHP code. 
  // Handy for metaprogramming. var_dump doesn't quite do this, 
  // and serialize has its own format, etc.

  // Does not work with objects. Does work with
  // arrays (associative and flat), strings, numbers,
  // null and false.

  static public function dump($var, $depth = 0, $preIndented = false)
  {
    $result = "";
    if (!$preIndented)
    {
      $result .= str_repeat("  ", $depth);
    }
    if (is_array($var))
    {
      $result .= "array(\n";
      $keys = array_keys($var);
      $associative = false;
      foreach ($keys as $key)
      {
        if (!preg_match("/\d+/", $key))
        {
          $associative = true;
        }
      }
      $first = true;
      if ($associative)
      {
        foreach ($var as $key => $value)
        {
          if ($first)
          {
            $first = false;
          }
          else
          {
            $result .= ",\n";
          }
          $result .= str_repeat("  ", $depth + 1) . self::dump($key, $depth + 1, true) . " => " . self::dump($value, $depth + 1, true);
        }  
      }
      else
      {
        foreach ($var as $value)
        {
          if ($first)
          {
            $first = false;
          }
          else
          {
            $result .= ",\n";
          }
          $result .= self::dump($value, $depth + 1, false);
        }  
      }
      $result .= "\n" . str_repeat("  ", $depth) . ")";
    }
    elseif (is_null($var))
    {
      $result .= "null";
    }
    elseif ($var === false)
    {
      $result .= "false";
    }
    elseif (is_numeric($var))
    {
      $result .= $var;
    }
    else
    {
      $result .= "'" . str_replace("'", "\\'", $var) . "'";
    }
    return $result;
  }
}

// $dump = pkDump::dump(
//   array("one" => 1,
//     "two" => 2,
//     "three" => 3,
//     "four'teen" => null,
//     75 => false,
//     "five" => "five",
//     "six" => array(
//       1, 2, 3.78, 4, 5),
//     "seven" => 7));
// 
// echo("The dump is:\n\n");
// echo($dump);
// 
// echo("\n\nvar_dump of an eval call on that dump is:\n\n");
// var_dump(eval("return " . $dump . ";"));
