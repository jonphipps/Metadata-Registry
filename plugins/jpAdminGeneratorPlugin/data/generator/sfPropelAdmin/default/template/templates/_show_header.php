<?php if (isset($this->params['show']['title'])): ?>
[?php $title = <?php echo $this->getI18NString('show.title', '', false) ?>; ?]
[?php $sf_context->getResponse()->setTitle("<?php echo sfConfig::get('app_title_prefix') ?>" . $title); ?]
<h1>[?php echo $title ?]</h1>
<?php endif; ?>
