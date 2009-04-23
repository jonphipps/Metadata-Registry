<?php
/**
 * This class makes multicolumn sorting of associative arrays in format provided for example by mysql_fetch_assoc.
 * 
 * Column names to be used when sorting can be specified as well the sorting direction for each column.
 * Optional external to the class compare functions can be specified for each column.
 * Look below for requirements concerning external compare functions.
 * If external compare functions are not supplied, the internal _compare method is used.
 * Dates are sorted correctly using the internal compare if they comply with GNU date syntax
 * (http://www.gnu.org/software/tar/manual/html_chapter/tar_7.html) 
 * 
 * @author Alexander Minkovsky <a_minkovsky@hotmail.com>
 * @version 1.1
 */
class sfDatagridArrayMultiSort {

	const ASC = 1;
	const DESC = -1;

	protected 
		$arr = null,
		$sortDef = null;
	
	/**
	 * Class constructor
	 */
	public function __construct()
	{
		$this->arr = array();
		$this->sortDef = array();
	}

	
	/**
	 * Set the array to the class
	 *
	 * @param array $arr The array
	 */
	function setArray(&$arr)
	{
		$this->arr = $arr;
	}
	
	/**
	 * AddColumn method - ads entry to sorting definition 
	 * If column exists, values are overwriten.
	 *
	 * @param string $colName The name of the column to sort
	 * @param integer $colDir The sort order
	 */
	public function addColumn($colName="",$colDir=self::ASC)
	{
		$idx = $this->_getColIdx($colName);
		
		if($idx < 0)
		{
			$this->sortDef[] = array();
			$idx = count($this->sortDef)-1;
		}
		
		$this->sortDef[$idx]["colName"] = $colName;
		$this->sortDef[$idx]["colDir"] = $colDir;
		$this->sortDef[$idx]["compareFunc"] = null;
	}

	
	/**
	 * Execute the sorting on the array
	 *
	 * @return array The sorted array
	 */
	public function &sort()
	{
		usort($this->arr,array($this,"_compare"));
		return $this->arr;
	}

	
	/**
	 * Get the numeric index of a column
	 *
	 * @param string $colName The name of the column
	 * @return integer The column index
	 */
	private function _getColIdx($colName)
	{
		$idx = -1;
		
		for($i=0;$i<count($this->sortDef);$i++)
		{
			$colDef = $this->sortDef[$i];
			if($colDef["colName"] == $colName) $idx = $i;
		}
		
		return $idx;
	}
	
	
	/**
	 * This is the comparaison method
	 *
	 * @param string $a Value left
	 * @param string $b Value right
	 * @param integer $idx The column index
	 * @return integer The comparaison result
	 */
	private function _compare($a,$b,$idx = 0)
	{
		if(count($this->sortDef) == 0) return 0;
		
		$colDef = $this->sortDef[$idx];
		$a_cmp = $a[$colDef["colName"]];
		$b_cmp = $b[$colDef["colName"]];
		
		if(is_null($colDef["compareFunc"]))
		{
			$a_dt = strtotime($a_cmp);
			$b_dt = strtotime($b_cmp);
			
			if(($a_dt == -1) || ($b_dt == -1) || ($a_dt == false) || ($b_dt == false))
			{
				$ret = $colDef["colDir"]*strnatcasecmp($a_cmp,$b_cmp);
			}
			else
			{
				$ret = $colDef["colDir"]*(($a_dt > $b_dt)?1:(($a_dt < $b_dt)?-1:0));
			}
		}
		else
		{
			$code = '$ret = ' . $colDef["compareFunc"] . '("' . $a_cmp . '","' . $b_cmp . '");';
			eval($code);
			$ret = $colDef["colDir"]*$ret;
		}
		
		if($ret == 0)
		{
			if($idx < (count($this->sortDef)-1))
			{
				return $this->_compare($a,$b,$idx+1);
			}
			else
			{
				return $ret;
			}
		}
		else
		{
			return $ret;
		}
	}
}
?> 