<?php
if ($file_import_history->getSchemaId()) {
    echo link_to("Import history...", '/schemahistory/list?import_id=' . $file_import_history->getId());
} else {
    echo link_to("Import history...", '/history/list?import_id=' . $file_import_history->getId());
}
