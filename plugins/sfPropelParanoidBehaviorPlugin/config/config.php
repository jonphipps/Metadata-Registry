<?php

sfPropelBehavior::registerMethods('paranoid', array(
  array('sfPropelParanoidBehavior', 'forceDelete'),
));

sfPropelBehavior::registerHooks('paranoid', array(
  ':delete:pre' => array('sfPropelParanoidBehavior', 'preDelete'),
  'Peer:doSelectRS' => array('sfPropelParanoidBehavior', 'doSelectRS'),
));
