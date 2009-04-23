<?php
/**
 * This is class sfDatagridPropel
 * 
 * @author		David Zeller	<zellerda01@gmail.com>
 */
class sfDatagridPropel extends sfDatagrid
{
	protected
		$peerTable = null,				// The name of the table without "Peer" at the end
		$criteria = null,				// The criteria (instance of Criteria)
		$tableSuffix = null,			// The table suffix (e.g. If you code and SVN select you must specify the table suffix for sorting)
		$columnsCompare = array();			// The type of the comparator Database (LIKE, EQUAL, LESS_THAN, etc.)
	
	/**
	 * Class constructor
	 *
	 * @param string $datagridName The name of the datagrid
	 * @param string $peerTable The name of the class table without "Peer"
	 * @param mixed $tableSuffix	The table suffix (e.g. If you code and SVN select you must specify the table suffix for sorting)
	 */
	public function __construct($datagridName, $peerTable, $criteria = null, $tableSuffix = null)
	{
		parent::__construct($datagridName);
		
		if(is_null($criteria))
		{
			$this->criteria = new Criteria();
		}
		else
		{
			$this->criteria = $criteria;
		}
		
		$this->peerTable = $peerTable;
		$this->tableSuffix = $tableSuffix;
	}
	
	/**
	 * Set the column comparaison functions
	 *
	 * @param array $options The array of the criteria comparators
	 */
	public function setColumnsCompare($options)
	{
		$this->columnsCompare = $options;
	}
		
	/**
	 * Prepare the datagrid
	 *
	 * @param string The pager peer method
     * @param string The cound peer method
	 * @return object The propel resultset
	 * @see	parent::prepare()
	 */
	public function prepare($peerMethod = 'doSelect', $countMethod = 'doCount')
	{	
		parent::prepare();
		
		// Sort the criteria
		$this->setCriteriaSorting();
		
		$this->addSearch();
		
		// Define the default search fields
		foreach(array_keys($this->columns) as $column)
		{
			if(!array_key_exists($column, $this->filtersTypes))
			{
				$this->filtersTypes[$column] = $this->getColumnType($column);
			}
		}
        
		// Set the pager
		$p = new sfPropelPager($this->peerTable, $this->rowLimit);
		$p->setPeerMethod($peerMethod);
		$p->setCriteria($this->criteria);
		$p->setPage($this->page);
		$p->setPeerCountMethod($countMethod);
		$p->init();
		
		$this->pager = $p;
		return $p;
	}
	
	/**
	 * Get the type of the database field
	 *
	 * @param string $column The column name
	 * @return string The type of the field
	 */
	protected function getColumnType($column)
	{
		if($column=='_object_actions'){
			return 'NOTYPE';
		}
		if(array_key_exists($column, $this->columnsSort))
		{
			if($this->columnsSort[$column] != 'nosort')
			{
				$tmp = explode('::', $this->columnsSort[$column]);
				
				$tableName = $tmp[0];
				$field = $tmp[1];
			}
			else
			{
				if(defined($this->peerTable . $this->tableSuffix . 'Peer::' . strtoupper($column)))
				{
					$tableName = $this->peerTable . $this->tableSuffix . 'Peer';
					$field = $column;
				}
				else
				{
					return 'NOTYPE';
				}
			}
		}
		else
		{
			$tableName = $this->peerTable . $this->tableSuffix . 'Peer';
			$field = $column;
		}
		
		$map = call_user_func(array($tableName, 'getTableMap'));
		
		if($map->getColumn($field)->isForeignKey()){
			return 'FOREIGN';
		}
		return $map->getColumn($field)->getType();
		
	}
	
	/**
	 * Add the search options to the criteria
	 */
	protected function addSearch()
	{		
		$c = $this->criteria;
		$c->setIgnoreCase(true);
		
		$columnsIds = array_keys($this->columns);
		
		$config = Propel::getConfiguration();
		
		foreach($columnsIds as $col)
		{
			if(is_array($this->search) && array_key_exists($col, $this->search) && !is_null($this->search[$col]) && $this->search[$col] != '')
			{
				if(array_key_exists($col, $this->columnsCompare))
				{
					$comp = $this->columnsCompare[$col];
				}
				else
				{
					$comp = Criteria::LIKE;
				}
				
				switch($this->getColumnType($col))
				{						
					case 'NOTYPE':
						// Do nothing
						break;
						
					case 'BOOLEAN':
						$c->add($this->getColumnSortingOption($col), $this->search[$col]);
						break;
				  
					
					case (strtoupper($this->getColumnType($col)) == 'DATE' || strtoupper($this->getColumnType($col)) == 'TIMESTAMP'):
						
						try {
							
							if(array_key_exists('start_' . $this->datagridName, $this->search[$col]) && $this->search[$col]['start_' . $this->datagridName] != '')
							{
								$c1 = $c->getNewCriterion($this->getColumnSortingOption($col), format_date(strtotime($this->search[$col]['start_' . $this->datagridName]), 'yyyy-MM-dd'), Criteria::GREATER_EQUAL);
								$c->addAnd($c1);
							}
						
						
							if(array_key_exists('stop_' . $this->datagridName, $this->search[$col]) && $this->search[$col]['stop_' . $this->datagridName] != '')
							{
								$c2 = $c->getNewCriterion($this->getColumnSortingOption($col), format_date(strtotime($this->search[$col]['stop_' . $this->datagridName]), 'yyyy-MM-dd'), Criteria::LESS_EQUAL);
								$c->addAnd($c2);
							}
							
							if(array_key_exists('null_' . $this->datagridName, $this->search[$col]) && $this->search[$col]['null_' . $this->datagridName] != '')
							{
								$c3 = $c->getNewCriterion($this->getColumnSortingOption($col), null, Criteria::ISNULL);
								$c->addOr($c3);
							}
							
						} catch(Exception $ex) {
							
							$this->search[$col]['start_' . $this->datagridName] = '';
							$this->search[$col]['stop_' . $this->datagridName] = '';
							$this->search[$col]['null_' . $this->datagridName] = '';
						}
						
						break;
					
					case 'FOREIGN':
						$c->add($this->getColumnSortingOption($col), $this->search[$col], $comp);
					break;
					
					default:
						
						if($comp == Criteria::LIKE)
						{
							$c->add($this->getColumnSortingOption($col), '%' . $this->search[$col] . '%', $comp);
						}
						else
						{
							$c->add($this->getColumnSortingOption($col), $this->search[$col], $comp);
						}
						
						break;
				}
			}
		}
		
		$this->criteria = $c;
		//echo $this->criteria->toString();
	}
	
	/**
	 * Add the sorting paramater to the criteria
	 */
	protected function setCriteriaSorting()
	{		
		if($this->sortOrder == 'asc')
		{
			$this->criteria->addAscendingOrderByColumn($this->getColumnSortingOption($this->sortBy));
		}
		else
		{
			$this->criteria->addDescendingOrderByColumn($this->getColumnSortingOption($this->sortBy));
		}
	}
	
	/**
	 * Get the column constant for sorting
	 *
	 * @param string $columnName The name of the column
	 * @return object The column sorting constant
	 */
	protected function getColumnSortingOption($columnName)
	{
		if(array_key_exists($columnName, $this->columnsSort) && $this->columnsSort[$columnName] != 'nosort')
		{
			if(defined($this->columnsSort[$columnName]))
				return constant($this->columnsSort[$columnName]);
			return constant($this->peerTable . $this->tableSuffix . 'Peer::' . strtoupper($this->columnsSort[$columnName]));
		} 
		else 
		{
			
			return constant($this->peerTable . $this->tableSuffix . 'Peer::' . strtoupper($columnName));
		}
	}
}
?>