<?php use_helper('Array');
/** @var \FileImportHistory $file_import_history */
$data = $file_import_history->getResults();
print_r_tree($data);


