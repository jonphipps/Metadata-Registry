<?php decorate_with(false) ?>
<?php echo (isset($feed)) ? $feed->asXml(ESC_RAW) : "Error: No Feed" ?>