<?php
  # Recipe 2-19
  # More involved Reflection API example

  $class = 'myUser';

  //require_once("./$class.class.php");
  require_once("C:\\web\\registry\\apps\\frontend\\lib\\myUser.class.php");

  $rc = new ReflectionClass($class);

  printf("<p>Name: *%s*<br />\n", $rc->getName());

  printf("Defined in file '%s', lines %d - %d<br />\n",
          $rc->getFileName(),
          $rc->getStartLine(),
          $rc->getEndLine());

  printf("<p>Contains the comments:<pre>%s</pre></p>",
          $rc->getDocComment());

  printf("%s is %san interface.<br />\n",
          $rc->getName(),
          $rc->isInterface() ? '' : 'not ');

  printf("%s is %sinstantiable.<br />\n",
          $rc->getName(),
          $rc->isInstantiable() ? '' : 'not ');

  printf("%s is %sabstract.<br />\n",
          $rc->getName(),
          $rc->isAbstract() ? '' : 'not ');

  printf("%s is %sfinal.</p>\n",
          $rc->getName(),
          $rc->isFinal() ? '' : 'not ');

  $constants = $rc->getConstants();
  $num_constants = count($constants);

  printf("%s defines %d constant%s",
          $rc->getName(),
          $num_constants == 0 ? 'no' : $num_constants,
          $num_constants != 1 ? 's' : '');

  if($num_constants > 0)
    printf(":<pre>%s</pre>", print_r($constants, TRUE));

  $props = $rc->getProperties();
  $num_props = count($props);

  printf("%s defines %d propert%s",
          $rc->getName(),
          $num_props == 0 ? 'no' : $num_props,
          $num_props == 1 ? 'y' : 'ies');

  if($num_props > 0)
  {
    print ':';
    foreach($props as $prop)
    {
      print "<pre>";
      Reflection::export($prop);
      print "</pre>";
    }
  }

  $methods = $rc->getMethods();
  $num_methods = count($methods);

  printf("%s defines %d method%s<br />\n",
          $rc->getName(),
          $num_methods == 0 ? 'no' : $num_methods,
          $num_methods != 1 ? 's' : '');

  if($num_methods > 0)
  {
    print '<p>';

    foreach($methods as $method)
    {
      printf("%s%s%s%s%s%s() ",
              $method->isFinal() ? 'final ' : '',
              $method->isAbstract() ? 'abstract ' : '',
              $method->isPublic() ? 'public ' : '',
              $method->isPrivate() ? 'private ' : '',
              $method->isProtected() ? 'protected ' : '',
              $method->getName());

      $params = $method->getParameters();
      $num_params = count($params);

      printf("has %s parameter%s%s",
              $num_params == 0 ? 'no' : $num_params,
              $num_params != 1 ? 's' : '',
              $num_params > 0 ? ': ' : '');

      if($num_params > 0)
      {
        $names = array();

        foreach($params as $param)
          $names[] = '$' . $param->getName();

        print implode(', ', $names);
      }

      print '<br />';
    }
  }

