<?php
/**
 * This class allow to create an ajax datagrid with sorting columns, 
 * line highlight, action on the line with a checkbox, data paging, 
 * column search, etc...
 * 
 * For the good work on the datagrid, you must enable the following 
 * modules :
 * - Tag
 * - Url
 * - Javascript
 * - Form
 * - I18N => if you use it. 
 * 
 * You must enable this module in the 
 * applicationConfiguration class with the following line : 
 * sfLoader::loadHelpers(array('Url', 'Javascript', 'I18N', 'Tag', 'Form'));
 * 
 * @author		David Zeller	<zellerda01@gmail.com>
 */
abstract class sfDatagrid
{
	const P_PAGE = 'dg_page';
	const P_ORDER = 'dg_order';
	const P_SORT = 'dg_sort';
    
	// Datagrid global values
	protected
		$pager = null,					// The datagrid Propel Pager (instance of sfPager)
		$datagridName = null,			// The name of the datagrid
		$sortBy = null,					// The sorting column
		$sortOrder = null,				// The sorting order (asc, desc)
		$page = 1,						// The page number
		$rowLimit = 25,					// The row limit (number of records per page)
		$columns = array(),				// The columns names and labels
		$columnsOptions = array(),		// The columns attributes (style, width, etc.)
		$defaultSort = array(),			// The default sorting options
		$request = null,				// The request (autoset)
		$datagridActions = array(),		// The datagrid actions (select box on the top)
		$moduleAction = null,			// The module name and the action name (autoset)
		$rowAction = null,				// The link for the row (e.g. to edit)
		$columnsSort = array(),			// The columns custom sorting options
		$filtersTypes = array(),		// The type of filter
		$search = array(),				// The search parameters
		$rowIndexDefaultValues= array(); // Default value for a row if the column doesn't exist
	
	// Render Options
	protected
		$renderPager = true,			// Is the pager must be display
		$refreshKeeping = true,			// If the value of the sort and the page are set in the session
		$datagridFormatter = 'default',	// The datagrid formatter
		$renderSearch = true;			// If the search must be display
	
	/**
	 * Class constructor
	 *
	 * @param string $datagridName The name of the datagrid
	 */
	public function __construct($datagridName)
	{
		$this->datagridName = $datagridName;
		// Get the request
		$this->request = sfContext::getInstance()->getRequest();
		// Get the module and the action for url linking
		$this->moduleAction = sfContext::getInstance()->getModuleName() . '/' . sfContext::getInstance()->getActionName();
		// Get the sorting options
		$this->sortBy = $this->request->getParameter(self::P_SORT, null);
		$this->sortOrder = $this->request->getParameter(self::P_ORDER, null);
		
		$this->search = $this->request->getParameter('search');
		
		// Get the page number
		$this->page = $this->request->getParameter(self::P_PAGE, 1);
		
		self::addScriptAndCss();
	}
	
	/**
	 * Add the javascript and the css to the response
	 */
	public static function addScriptAndCss()
	{
		// Set the javascript and the css to the request
		$r = sfContext::getInstance()->getResponse();

		$r->addStylesheet('/sfDatagridPlugin/css/datagrid.css');
		$r->addStylesheet('/sfDatagridPlugin/css/calendar.css');
		
		//$r->addJavascript('/sfDatagridPlugin/js/prototype.js');
		$r->addJavascript('/sfDatagridPlugin/js/datagrid.js');
		$r->addJavascript('/sfDatagridPlugin/js/calendar.js');	
	}
	
	/**
	 * Fix the refresh problem with ajax
	 */
	protected function fixGridRefresh()
	{
		$attributeName = $this->datagridName . '-history';
		
		if($this->request->getParameter('d_clear'))
		{
			// Clear the session datagrid
			sfContext::getInstance()->getUser()->setAttribute($attributeName, '1||');
		}
		else
		{
			$cookie = sfContext::getInstance()->getUser()->getAttribute($attributeName);
			$cookie = explode('|', $cookie);
			
			if(count($cookie) > 3 && is_null($this->search))
			{
				$this->search = unserialize($cookie[3]);
			}
			
			if(count($cookie) >= 4 && is_null($this->sortBy) && is_null($this->sortOrder))
			{
				$this->page = $cookie[0];
				$this->sortBy = $cookie[1];
				$this->sortOrder = $cookie[2];
			}
			else
			{
				$cookieValue = $this->page . '|' . $this->sortBy . '|' . $this->sortOrder . '|' . serialize($this->search);
				
				sfContext::getInstance()->getUser()->setAttribute($attributeName, $cookieValue);
			}
		}
	}
	
	/**
	 * Set the row limitation (the number of lines)
	 *
	 * @param integer $value The number of line
	 */
	public function setRowLimit($value)
	{
		$this->rowLimit = $value;
	}
	
	/*
	 * Default values for a row if the column doesn't exist
	 * 
	 * @param array $values LIst of the values for each lines
	 */
	public function setRowIndexDefaultValues($values){
		$this->rowIndexDefaultValues=$values;
	}
	/**
	 * Define the value of the sort and the page are set in the session
	 *
	 * @param boolean $value
	 */
	public function keepOnRefresh($value)
	{
		if (!is_bool($value))
		{
			throw new InvalidArgumentException('You must specify an boolean value "true" or "false"');
		}
		
		$this->refreshKeeping = $value;
	}
	
	/**
	 * Set the row action
	 *
	 * @param string $link The link for edit
	 * @param string $byColumn The column name who is the parameter value
	 */
	public function setRowAction($link, $byColumn)
	{
		$this->rowAction = $link . '%' . $byColumn . '%';
	}
	
	/**
	 * Set the default sorting column
	 *
	 * @param string $column The name of the column
	 * @param string $order The sorting order "asc", "desc"
	 */
	public function setDefaultSortingColumn($column, $order)
	{
		if ($order != 'asc' && $order != 'desc')
		{
			throw new InvalidArgumentException('You cannot define the sorting order differently as "asc" and "desc"');
		}
		
		$this->defaultSort = array('sort' => $column, 'order' => $order);
	}
	
	/**
	 * Set the columns key and labels
	 *
	 * @param array $columns The array with the key and the names
	 *						 (e.g. array('name' => 'Name of the value');)
	 */
	public function setColumns($columns)
	{
		$columnsProcess = array();
		
		foreach($columns as $key => $label)
		{
			$columnsProcess[$key] = $this->traduct($label);
		}
		
		$this->columns = $columnsProcess;
	}
	
	/**
	 * Set the columns type for search
	 *
	 * @param array $columns The array with the key and the type
	 *						 (e.g. array('name' => 'type');)
	 */
	public function setColumnsFilters($columns)
	{
		$columnsProcess = array();
		
		foreach($columns as $key => $type)
		{
			if(!is_array($type))
			{
				$columnsProcess[$key] = strtoupper($type);
			}
			else
			{
				$columnsProcess[$key] = $type;
			}
		}
		
		$this->filtersTypes = $columnsProcess;
	}
	
	/**
	 * Set the columns options
	 *
	 * @param array $columnsOptions The array with the column options
	 */
	public function setColumnsOptions($columnsOptions)
	{
		$this->columnsOptions = $columnsOptions;
	}
	
	/**
	 * Set  options for a column
	 *
	 * @param string $column The name of the col
	 * @param array $options The array with the options
	 */
	public function setColumnOption($column, $options=array()){
		$this->columnsOptions[$column] = $options;
	}
	/**
	 * Define if the search zone have to be render
	 *
	 * @param boolean $value
	 */
	public function renderSearch($value)
	{
		if (!is_bool($value))
		{
			throw new InvalidArgumentException('You must specify an boolean value "true" or "false"');
		}
		
		$this->renderSearch = $value;
	}
	
	/**
	 * Define if the pager have to be render
	 *
	 * @param boolean $value
	 */
	public function renderPager($value)
	{
		if (!is_bool($value))
		{
			throw new InvalidArgumentException('You must specify an boolean value "true" or "false"');
		}
		
		$this->renderPager = $value;
		
		if(!$value)
		{
			$this->setRowLimit(999999999);
		}
	}
	
	/**
	 * Set the sorting options for the columns
	 *
	 * @param array	$columnsSort The array with the sorting options
	 */
	public function setColumnsSorting($columnsSort)
	{
		$this->columnsSort = $columnsSort;
	}
	
	/**
	 * Set the datagrid actions
	 *
	 * @param array	$actions The array with the actions
	 */
	public function setDatagridActions($actions)
	{
		$actionsProcess = array();
		
		foreach($actions as $title => $link)
		{
            if($link == '#')
            {
                $actionsProcess[$title] = $link;
            }
            else
            {
                $actionsProcess[$title] = url_for($link);
            }
			
		}
		
		$this->datagridActions = $actionsProcess;
	}

	/**
	 * Prepare the datagrid
	 */
	public function prepare()
	{
		if($this->refreshKeeping)
		{
			// Fix the refresh problem
			$this->fixGridRefresh();
		}
		
		// Set the default order
		if(!$this->sortBy)
		{
			if(count($this->defaultSort) != 0)
			{
				$this->sortBy = $this->defaultSort['sort'];
			}
			else
			{
				$columnsKeys = array_keys($this->columns);
				$this->sortBy = $columnsKeys[0];
			}
		}
		
		if(!$this->sortOrder)
		{
			if(count($this->defaultSort) != 0)
			{
				$this->sortOrder = $this->defaultSort['order'];
			}
			else
			{
				$this->sortOrder = 'asc';
			}
		}
	}
	
	/**
	 * Get the url $_GET parameters
	 *
	 * @return string The url parameter string
	 */
	protected function getUriSuffix()
	{
		$request = $this->request->getParameterHolder()->getAll();
		
		// Unset the request values requested by the datagrid
		unset($request[self::P_ORDER]);
		unset($request[self::P_SORT]);
		unset($request[self::P_PAGE]);
		unset($request['search']);
		unset($request['module']);
		unset($request['action']);
		
		$p = '';
		
		foreach($request as $key => $value)
		{
			if ($p != '')
			{
				$p.= '&';
			}
			
			$p .= $key . '=' . $value;
		}
		
		return $p;
	}
	   
    /**
	 * Use i18n function (if is active) to traduct a value
	 *
	 * @param string $value The text to traduct
	 * @return string The traducted value
	 */
	protected static function traduct($value)
	{
		if (sfConfig::get('sf_i18n'))
		{
			$value = __($value);
		}
		
		return $value;
	}
	
	/**
	 * Get the formatter class
	 *
	 * @param string $name The name of the formater
	 * @return sfDatagridFormatter The formatter class
	 */
	protected function getFormatter($name)
	{
		$class = 'sfDatagridFormatter'.ucfirst($name);

		if (!class_exists($class))
		{
			throw new InvalidArgumentException(sprintf('The datagrid formatter "%s" does not exist.', $name));
		}

		return new $class($this);
	}
	
	/**
	 * Get the html output for the datagrid
	 *
	 * @param array $values The array of values
	 * @param array $alternate The two class to alternate
	 */
	public function getContent($values, $alternate, $formatter = '')
	{
		$headers = '';
		$pager = '';
		$actions = '';
		$filters = '';
		
		if($formatter != '')
		{
			$formatter = $this->getFormatter($formatter);
		}
		else
		{
            $formatter = $this->getFormatter('default');
		}
		
		// Make the header
		$suffix = $this->getUriSuffix() ? '&' . $this->getUriSuffix() : '';
		
		$url = $this->moduleAction . '?' . self::P_PAGE . '=' . $this->page . $suffix;
		$urlDefault = $this->moduleAction . '?' . self::P_PAGE . '=1' . $suffix;
		
		$headers = $formatter->renderHeaders($this, $url);

		$pager = $formatter->renderPagerBar($this, $this->getUriSuffix());
		
		if(!(count($this->datagridActions) == 0 && $this->refreshKeeping == false))
		{
			$actions = $formatter->renderActionsBar($this, $urlDefault);
		}
		
		// Make the rows
		$rows = '';
		
		if(count($values) != 0)
		{
			$i = 0;
			foreach($values as $k=>$rowValues)
			{	
				$rowIndexDefaultValue=null;
				if(array_key_exists($k,$this->rowIndexDefaultValues)){
					$rowIndexDefaultValue=$this->rowIndexDefaultValues[$k];
				}
				$rows.= $formatter->renderRow($this, $rowValues, $i % 2 ? $alternate[1] : $alternate[0],$rowIndexDefaultValue);
				$i++;
			}
		}
		else
		{
			$rows.= $formatter->renderRow($this, null, $alternate[0]);
		}
		
		if($this->renderSearch)
		{
			$filters = $formatter->renderFilters($this, $this->getUriSuffix());
		}
		
		// Get all
		return $formatter->renderDatagrid($this, $headers, $rows, $filters, $pager, $actions);
	}
	
	/**
	 * Render the grid in view
	 *
	 * @param string $div The datagrid name
	 * @param string $url The action url of the datagrid
	 * @return string The html content
	 */
	public static function render($div, $url)
	{
		self::addScriptAndCss();
		
		$html = '<div id="' . $div . '">' . '<div class="datagrid-loader" id="loader-' . $div . '">' . sfDatagrid::traduct(sfDatagrid::getConfig('text_loading')) . '</div>' . '</div>';
		$html.= javascript_tag(remote_function(array('update' => $div, 'url' => $url, 'script' => true, 'loading' => 'dg_hide_show(\'' . $div . '\')')));
		return $html;
	}
	
	/**
	 * Create and return the check box value in html
	 *
	 * @param mixed	$value The checkbox value
	 * @return string The html content
	 */
	public static function getCheck($value)
	{
		$html = '<input type="checkbox" name="gridline[]" value="' . $value . '" />';
		return $html;	
	}
    
    /**
    * Get a value from the app.yml
    * 
    * @param string $param The parameter name
    * @return mixed The value
    */
    public static function getConfig($param)
    {        
        return sfConfig::get('app_datagrid_' . $param);
    }
	
	/**
	 * Get any class variables
	 *
	 * @param string $name Variable name
	 * @return mixed The variable value
	 */
	public function _get($name)
	{
		return $this->$name;
	}
	
	/**
	 * Search the values in the datagrid
	 */
	protected abstract function addSearch();
}
?>