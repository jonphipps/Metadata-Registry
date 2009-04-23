<?php
 
require_once dirname(__FILE__) . '/../lib/sfWebDebugPanelBugs.class.php';
 
$this->dispatcher->connect('debug.web.load_panels', array('sfWebDebugPanelBugs', 'listenToAddPanelEvent'));

?>