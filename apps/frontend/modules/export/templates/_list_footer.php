<?php slot('download');
/** @var sfParameterHolder $sf_flash */
if($sf_flash->has('download')) {
echo  '<meta http-equiv = "refresh" content = "0; url=' . $sf_flash->get('download') . '" >';
}
end_slot();
