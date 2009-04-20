<?php


require_once('apps/frontend/modules/administrator/actions/actions.class.php');

require_once('PHPUnit/Framework/TestCase.php');


/**
 * administratorActions test case.
 */
class administratorActionsTest extends PHPUnit_Framework_TestCase
{

	/**
	 * Constructs the test case.
	 */
	public function __construct() {

		// TODO Auto-generated constructor

	}
	
	/**
	 * @var administratorActions
	 */
	private $administratorActions;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp()
	{
		parent::setUp();

		// TODO Auto-generated administratorActionsTest::setUp()
		
		$this->administratorActions = new administratorActions(/* parameters */);
		
	}

	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown()
	{
		// TODO Auto-generated administratorActionsTest::tearDown()
		
		$this->administratorActions = null;
		
		parent::tearDown();
	}

	
	/**
	 * Tests administratorActions->ExecuteAdministrators()
	 */
	public function testExecuteAdministrators()
	{
		// TODO Auto-generated administratorActionsTest->testExecuteAdministrators()
		$this->markTestIncomplete("ExecuteAdministrators test not implemented");
		
		$this->administratorActions->ExecuteAdministrators(/* parameters */);
		
	}
	
	/**
	 * Tests administratorActions->ExecuteModeratorCandidates()
	 */
	public function testExecuteModeratorCandidates()
	{
		// TODO Auto-generated administratorActionsTest->testExecuteModeratorCandidates()
		$this->markTestIncomplete("ExecuteModeratorCandidates test not implemented");
		
		$this->administratorActions->ExecuteModeratorCandidates(/* parameters */);
		
	}
	
	/**
	 * Tests administratorActions->ExecuteModerators()
	 */
	public function testExecuteModerators()
	{
		// TODO Auto-generated administratorActionsTest->testExecuteModerators()
		$this->markTestIncomplete("ExecuteModerators test not implemented");
		
		$this->administratorActions->ExecuteModerators(/* parameters */);
		
	}
	
	/**
	 * Tests administratorActions->ExecuteProblematicUsers()
	 */
	public function testExecuteProblematicUsers()
	{
		// TODO Auto-generated administratorActionsTest->testExecuteProblematicUsers()
		$this->markTestIncomplete("ExecuteProblematicUsers test not implemented");
		
		$this->administratorActions->ExecuteProblematicUsers(/* parameters */);
		
	}
	
	/**
	 * Tests administratorActions->ExecutePromoteAdministrator()
	 */
	public function testExecutePromoteAdministrator()
	{
		// TODO Auto-generated administratorActionsTest->testExecutePromoteAdministrator()
		$this->markTestIncomplete("ExecutePromoteAdministrator test not implemented");
		
		$this->administratorActions->ExecutePromoteAdministrator(/* parameters */);
		
	}
	
	/**
	 * Tests administratorActions->ExecutePromoteModerator()
	 */
	public function testExecutePromoteModerator()
	{
		// TODO Auto-generated administratorActionsTest->testExecutePromoteModerator()
		$this->markTestIncomplete("ExecutePromoteModerator test not implemented");
		
		$this->administratorActions->ExecutePromoteModerator(/* parameters */);
		
	}
	
	/**
	 * Tests administratorActions->ExecuteRemoveAdministrator()
	 */
	public function testExecuteRemoveAdministrator()
	{
		// TODO Auto-generated administratorActionsTest->testExecuteRemoveAdministrator()
		$this->markTestIncomplete("ExecuteRemoveAdministrator test not implemented");
		
		$this->administratorActions->ExecuteRemoveAdministrator(/* parameters */);
		
	}
	
	/**
	 * Tests administratorActions->ExecuteRemoveModerator()
	 */
	public function testExecuteRemoveModerator()
	{
		// TODO Auto-generated administratorActionsTest->testExecuteRemoveModerator()
		$this->markTestIncomplete("ExecuteRemoveModerator test not implemented");
		
		$this->administratorActions->ExecuteRemoveModerator(/* parameters */);
		
	}
	
}

