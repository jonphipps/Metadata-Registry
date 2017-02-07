<?php
if ($file_import_history->getSchemaId()) {
    echo sf_link_to("Import history...", '@import_schemahistory_list?import_id=' . $file_import_history->getId());
} else {
    echo sf_link_to("Import history...", '@import_history_list?import_id=' . $file_import_history->getId());
}
