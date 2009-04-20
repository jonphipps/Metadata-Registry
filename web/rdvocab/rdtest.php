<?php
//debugbreak();
  //setup
  $apiUrl = "http://registry/api/get";
  //$apiUrl = "http://metadataregistry.org/api/get";

  $useFopen = false;

  //here we have a uri map
  $uriMap = array(
    "roles/.*"    => "schema_property",
    "roles"       => "schema",
    "Elements/.*"    => "schema_property",
    "Elements"       => "schema",
    "termLIst/.*/.*" => "concept",
    "termLIst/.*"    => "concept_scheme"
   );

  $type = $_GET['type'];
  $uri = $_GET['uri'];

  //set the class by parsing the uri
  //note that order is important
  foreach ($uriMap as $key => $value)
  {
    $regex = "%" . $key . "%im";
    if (preg_match($regex, $uri))
    {
      $class = $value;
      break;
    }
  }

  $apiUrl .= "?class=" . $class;
  $apiUrl .= "&type=" . $type;
  $apiUrl .= "&uri=" . rawurlencode("http://rdvocab.info/" . $uri);

  //for testing
  $apiUrl .= "&uri=" . rawurlencode("http://registry/uri/schema/testSchema");
  //echo '<h3 style="background-color:cyan">' . $uri . '</h3>';
  //echo '<h3 style="background-color:cyan">' . $apiUrl . '</h3>';

  //html requests get redirected to registry
  if ('html' == $type)
  {
    if ($useFopen)
    {
      $handle = fopen($apiUrl, "rb");
      $url = stream_get_contents($handle);
      fclose($handle);
    }
    else
    {
      //try curl
      //ob_start();
      $ch = curl_init($apiUrl);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
      curl_setopt($ch, CURLOPT_FAILONERROR, 1);
      $url = curl_exec($ch);

      //for testing
      //echo '<span style="background-color:cyan">' . $url . '</span>';

      curl_close($ch);

      //ob_end_clean();
    }

    //this should return just redirect the URL
    header("Location: " . $url, true, 303);
    exit;

  }

  if ($useFopen)
  {
    $fp = fopen($apiUrl, 'rb', false);
    if ($fp)
    {
      //set the correct header
      $rdf = ('rdf' == $type) ? "rdf+" : '';
      header("Content-Type: application/" . $rdf . "xml; charset=utf-8");
      fpassthru($fp);
      fclose($fp);
    }
    else
    {
      //debug_print_backtrace();
      header(' ', true, 404);
    }
  }
  else
  {
    //set the correct header
    $rdf = ('rdf' == $type) ? "rdf+" : '';
    header("Content-Type: application/" . $rdf . "xml; charset=utf-8");

    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    $url = curl_exec($ch);

    //for testing
    //echo '<span style="background-color:cyan">' . curl_getinfo($ch) . '</span>';

    curl_close($ch);
  }
exit;