<?php

sfPropelBehavior::registerMethods('paranoid', array(
  array('sfPropelParanoidBehavior', 'forceDelete'),
));

sfPropelBehavior::registerHooks('paranoid', array(
  ':delete:pre'                => array('sfPropelParanoidBehavior', 'preDelete'),
  'Peer:doSelectStmt'          => array('sfPropelParanoidBehavior', 'doSelectStmt'),
  'Peer:doSelectJoin'          => array('sfPropelParanoidBehavior', 'doSelectStmt'),
  'Peer:doSelectJoinAll'       => array('sfPropelParanoidBehavior', 'doSelectStmt'),
  'Peer:doSelectJoinAllExcept' => array('sfPropelParanoidBehavior', 'doSelectStmt'),
));
