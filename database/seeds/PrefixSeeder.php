<?php

use Illuminate\Database\Seeder;

class PrefixSeeder extends Seeder
{
    use \database\DisablesForeignKeys;

  /**
   * Run the database seeds.
   *
   * @return void
   */
    public function run()
    {
        $xhtml           = self::getPrefixcc();
        $updateStatement = "INSERT INTO `reg_prefix` (`prefix`, `uri`, `rank`) VALUES\n";

        foreach ($xhtml->body->ol->li as $value) {
            $uri    = (string) $value['content'];
            $prefix = (string) $value->a;
            $rank   = (int) $value->span['content'];
            $updateStatement .= "('" . $prefix . "','" . $uri . "','" . $rank . "'),\n";
        }

        $updateStatement = preg_replace("/,$/", ';', $updateStatement);
        DB::statement($updateStatement);
    }


  /**
   * @return SimpleXMLElement
   */
    public static function getPrefixcc()
    {
        return simplexml_load_file('http://prefix.cc/popular/all');
    }
}
