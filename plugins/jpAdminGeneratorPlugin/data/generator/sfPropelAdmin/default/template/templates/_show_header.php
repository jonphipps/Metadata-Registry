<?php if (isset($this->params['show']['title'])): ?>
<div class="form-header">
[?php $title = <?php echo $this->getI18NString('show.title', '', false) ?>; ?]
[?php $sf_context->getResponse()->setTitle("<?php echo sfConfig::get('app_title_prefix') ?>" . $title); ?]
<h1 class="form">[?php echo $title ?]</h1>
</div>
  <?php endif; ?>
