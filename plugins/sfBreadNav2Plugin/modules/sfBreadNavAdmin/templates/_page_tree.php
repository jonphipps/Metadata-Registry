
<?php
class myMenuOutput extends RecursiveIteratorIterator {
  function __construct($m) {
    parent::__construct($m, self::SELF_FIRST);
  }

  function beginChildren() {
    echo str_repeat("\t", $this->getDepth());
  }

  function endChildren() {
    echo str_repeat("\t", $this->getDepth() - 1);
  }
}

$root = sfBreadNavPeer::getRoot($scope);
$menu = sfBreadNavPeer::retrieveTree($scope);
$menu = new myMenuOutput($menu);



function bool2string ($bool) {
  if(!is_null($bool)) {return 'On';}
  return ' ';
}

?>

<br/>
    <table style='border-spacing: 0px 0px; border-style: none; border-collapse: collapse;' id="breadnavtreetable">
      <tr class='odd'><strong><td>PAGE NAME</td><td>MODULE</td><td>ACTION</td><td>CREDENTIAL</td><td>CATCH ALL</td></strong></tr>
      <tr class='even'>
       <td><a href="<?php echo url_for('sfBreadNavAdmin/edithome?scope=' . $scope) ?>"><?php echo $root->getPage() ?></a></td>
       <td><?php echo $root->getModule() ?></php></td>
       <td><?php echo $root->getAction() ?></php></td>
       <td><?php echo $root->getCredential() ?></php></td>
       <td><?php echo bool2string($root->getCatchall()) ?></php></td>
      </tr>
    
    <?php $rowclass = 'odd'; ?>
    
    <?php $rootflag = true; ?>
    <?php foreach ($menu as $page): ?>
    <?php if (!$rootflag) { 
    ?>
    
    <tr class='<?php echo $rowclass ?>'>
      <td style='padding-left: <?php echo $page->getLevel() + 1?>EM; padding-right: 1EM;'>
      <?php echo link_to ($page->getPage(), 'sfBreadNavAdmin/index?scope=' .$scope. '&pageid=' . $page->getId()) ?>
      </td>
      <td><?php echo $page->getModule()?></td>
      <td><?php echo $page->getAction()?></td>
      <td><?php echo $page->getCredential()?></td>
      <td><?php echo bool2string($page->getCatchall())?></td>            
    </tr>
    <?php if ($rowclass == 'odd') {$rowclass = 'even';} else {$rowclass = 'odd';} ?>
    
    <?php } else { $rootflag = false;}
    ?>        
    
    <?php endforeach; ?>
    </table>