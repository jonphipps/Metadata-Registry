<?php

class pkDate
{
  // The preferred P'unk format: Sep 3   (year follows if not current year)
  // Accepts both Unix timestamps and MySQL datetime values
  static public function pretty($date)
  {
    if (preg_match("/^(\d\d\d\d)-(\d\d)-(\d\d)( (\d\d):(\d\d):(\d\d))?$/", $date, $matches))
    {
      list($dummy1, $year, $month, $day, $dummy2, $hour, $min, $sec) = $matches;
      $date = mktime($hour, $min, $sec, $month, $day, $year);
    }
    $month = date('F', $date);
    $day = date('j', $date);
    $month = substr($month, 0, 3);
    $year = date('Y', $date);
    $yearNow = date('Y');
    $result = "$month $day";
    if ($year != $yearNow)
    {
      // Switch to 2 digit year for compactness. TBB
      $result .= " '" . substr($year, 2);
    }
    return $result;
  }
}
