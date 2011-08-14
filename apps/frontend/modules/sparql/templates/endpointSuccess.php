<?php
require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'arc_config.php');

/* instantiation */
$ep = ARC2::getStoreEndpoint($arc_config);

/* request handling */
$ep->go();

echo $ep->getResult();
?>

