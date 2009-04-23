<?php

/*
 * Associative array access to CSV data. 
 *
 * Usage:
 *
 *
 * try {
 *   $reader = new pkCsvReader("filename.csv");
 * } catch (Exception $e) {
 *   die("Not a happy CSV file!\n");
 * }
 *
 * # Get array of heading names found
 * $headings = $reader->getHeadings();
 *
 * # Loop through rows, doing something with a field by heading name
 * while ($row = $reader->getRow()) {
 *   echo("Name of User: " . $row['name'] . "\n");
 * }
 *
 */


class pkCsvFileOpenException extends Exception
{
  public function __construct()
  {
    parent::__construct("Unable to open csv file");
  }
}

class pkCsvNoHeadingsException extends Exception
{
  public function __construct()
  {
    parent::__construct("No headings in CSV file (empty file?)");
  }
}

class pkCsvReader 
{
  private $in;
  public function __construct($file) 
  {
    $this->in = fopen($file, "r");
    if (!$this->in) {
      throw new pkCsvFileOpenException();
    }
    $headings = fgetcsv($this->in);
    if ($headings === FALSE) {
      throw new pkCsvNoHeadingsException();
    }
    $this->headings = $headings;
  }
  public function getHeadings()
  {
    return $this->headings;
  }
  public function getRow() { 
    $data = fgetcsv($this->in);
    if ($data === false) {
      fclose($this->in);
      return false;
    }
    $row = array();
    $count = 0;
    foreach ($this->headings as $heading) {
      # Tolerate trailing null columns not returned
      if (isset($data[$count])) {
        $row[$heading] = $data[$count++];
      } else {
        $row[$heading] = false;
      }
    }
    return $row;
  }
}


