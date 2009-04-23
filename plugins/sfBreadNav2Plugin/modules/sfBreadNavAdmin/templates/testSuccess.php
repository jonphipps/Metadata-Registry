<?php 

 


?>

<?php
class myMenuOutput extends RecursiveIteratorIterator {
  function __construct(sfBreadNav $m) {
    parent::__construct($m, self::SELF_FIRST);
  }

  function beginChildren() {
    echo str_repeat("\t", $this->getDepth());
  }

  function endChildren() {
    echo str_repeat("\t", $this->getDepth() - 1);
  }
}

$menu = sfBreadNavPeer::retrieveTree(1);
$it = new myMenuOutput($menu);
foreach($it as $m) {
  echo $m->getPage(), '[', $m->getLeftValue(), '-', $m->getRightValue(), "]\n", $m->getLevel(), "<br>";
}
