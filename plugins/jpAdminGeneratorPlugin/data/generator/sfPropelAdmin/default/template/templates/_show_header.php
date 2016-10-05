<?php if (isset($this->params['show']['title'])): ?>
[?php
  /** @var sfContext $sf_context */
  /** @var sfParameterHolder $sf_flash */
  /** @var sfParameterHolder $sf_params */
  /** @var myWebRequest $sf_request */
  /** @var myUser $sf_user */
  /** @var sfPartialView $sf_view */
  /** @var <?php /** @var sfPropelAdminGenerator $this */
echo $this->getClassName() ?>  $<?php echo $this->getSingularName() ?> */
  ?]
<div class="form-header">
[?php $title = <?php echo $this->getI18NString('show.title', '', false) ?>; ?]
[?php $sf_context->getResponse()->setTitle("<?php echo sfConfig::get('app_title_prefix') ?>" . $title); ?]
<h1 class="form">[?php echo $title ?]</h1>
</div>
  <?php endif; ?>
