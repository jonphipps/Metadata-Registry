[?php include_partial('global/topnav');
  $title = <?php echo $this->getI18NString('list.title', $this->getModuleName().' list', false) ?>;
  $sf_context->getResponse()->setTitle("<?php echo sfConfig::get('app_title_prefix') ?>" . $title); ?]
<h1>[?php echo $title ?]</h1>
