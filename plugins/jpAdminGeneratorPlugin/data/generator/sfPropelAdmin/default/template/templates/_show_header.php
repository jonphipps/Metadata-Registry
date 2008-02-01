[?php $title = <?php echo $this->getI18NString('show.title', 'show '.$this->getModuleName(), false) ?>;
  $sf_context->getResponse()->setTitle("<?php echo sfConfig::get('app_title_prefix') ?>" . $title) ?]
<h1>[?php echo $title ?]</h1>
