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
[?php if ('edit' == $mode): ?]
<?php if (isset($this->params['edit']['title']['mode']['edit'])): ?>
[?php $title = <?php echo $this->getI18NString('edit.title.mode.edit', '', false) ?>; ?]
<?php else: ?>
[?php $title = <?php echo $this->getI18NString('edit.title', 'edit '.$this->getModuleName(), false) ?>; ?]
<?php endif; ?>
[?php else: ?]
<?php if (isset($this->params['edit']['title']['mode']['create'])): ?>
[?php $title = <?php echo $this->getI18NString('edit.title.mode.create', '', false) ?>; ?]
<?php else: ?>
[?php $title = __s('Creating new ') . "<?php echo $this->getSingularName() ?>"; ?]
<?php endif; ?>
[?php endif; 
  $sf_context->getResponse()->setTitle("<?php echo sfConfig::get('app_title_prefix') ?>" . $title); ?]
<h1 class="form">[?php echo $title ?]</h1><div class="required">*Required</div>
</div>
