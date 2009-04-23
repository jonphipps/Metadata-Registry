<?php

class pkRules
{
  // Simple path-matching rules. They work like this:
  // * matches anything
  // % matches anything except / (great for directory components)
  
  // Call select with an array of rules and a string to be matched. Each 
  // rule is an associative array with a key named 'rule' that contains
  // the actual pattern. select returns the entire associative array
  // for the first matching rule, or false if no rules match.

  // This is very handy in CMS configuration files. Example
  // (for a CMS with rooted paths):
//      ## Home page gets homePage
//      #
//      # - rule: "/"
//      #   template: homePage
//      #
//      ## All second level pages get secondPage
//      # - rule: "/%/%"
//      #   template: secondPage
//      #
//      ## All descendants (not just direct children) of /faq/ get faqPage.
//      ## For direct children only, use % instead of *
//      # - rule: "/home/faq/*"
//      #   template: faqPage
//      #
//      # Everything else gets simplePage
//      # - rule: "*"
//      #   template: simplePage
//      #

  static public function select($rules, $s)
  {
    foreach ($rules as $rule) 
    {
      $ruleGlob = $rule['rule'];
      $ruleReg = "/^" . str_replace(
        array('%', '\*'),
        array('[^\/]*', '.*'),
        preg_quote($ruleGlob, '/')) . "$/";
      if (preg_match($ruleReg, $s))
      {
#        sfContext::getInstance()->getLogger()->info("Matched $ruleReg to $s");
        return $rule;
      }
    }
    return false;
  }

  static public function test()
  {
    $tests = 
      array("/this/is/a/path",
        "/second/level",
        "/somethingelse",
        "/foo");

    $rules = array(
      array(
        "rule" => "/foo",
        "template" => "fooonly"),
      array(
        "rule" => "/%/%",
        "template" => "secondlevel"),
      array(
        "rule" => "*",
        "template" => "simple")
      );

    foreach ($tests as $test)
    {
      $rule = pkRules::select($rules, $test);
      if ($rule)
      {
        echo($test . ": " . $rule['template'] . " " . $rule['rule'] . "\n");
      }
      else
      {
        echo("No match\n");
      }
    }
  }
}


