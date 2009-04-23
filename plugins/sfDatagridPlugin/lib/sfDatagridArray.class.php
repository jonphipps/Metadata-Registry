<?php
/**
 * This is class sfDatagridArray
 * 
 * @author		David Zeller	<zellerda01@gmail.com>
 */
class sfDatagridArray extends sfDatagrid
{
	/**
	 * Class constructor
	 *
	 * @param string $datagridName The name of the datagrid
	 */
	public function __construct($datagridName)
	{
		parent::__construct($datagridName);
		
		$this->renderPager(false);
		$this->renderSearch(false);
	}
	
	/**
	 * Sort the rows array
	 *
	 * @param array $values The array of values
	 * @return array The sorted array
	 */
	protected function sortValues($values)
	{
		$cSort = new sfDatagridArrayMultiSort();
		$cSort->setArray($values);
		
		if($this->sortOrder == 'asc')
		{
			$cSort->addColumn($this->sortBy, sfDatagridArrayMultiSort::ASC);
		}
		else
		{
			$cSort->addColumn($this->sortBy, sfDatagridArrayMultiSort::DESC);
		}
		
		return $cSort->sort();
	}
	
	/**
	 * Filter the values of the array
	 * => Not used
	 */
	protected function addSearch(){}
	
	/**
	 * Get the datagrid content html
	 *
	 * @param array $values The array of row values
	 * @param array $alternate The line alternate classes
	 * @param string $formatter The formatter name
	 * @return string The html output
	 */
	public function getContent($values, $alternate, $formatter = '')
	{
		$array_values = array();
		
		$i = 0;
		foreach($values as $line)
		{
			$array_values[$i] = array();
			
			$j = 0;
			foreach(array_keys($this->columns) as $column)
			{
				$array_values[$i][$column] = $line[$j];
				$j++;
			}
			
			$i++;
		}
		
		$sort_values = $this->sortValues($array_values);
		
		return parent::getContent(array_values($sort_values), $alternate, $formatter);
	}
}
?>