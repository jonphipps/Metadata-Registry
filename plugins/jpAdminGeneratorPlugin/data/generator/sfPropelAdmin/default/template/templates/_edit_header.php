[?php if ('edit' == $mode): ?]
<?php if (isset($this->params['edit']['title']['mode']['edit'])): ?>
<h1><?php echo $this->getI18NString('edit.title.mode.edit') ?></h1>
<?php else: ?>
<h1><?php echo $this->getI18NString('edit.title', 'edit '.$this->getModuleName()) ?></h1>
<?php endif; ?>
[?php else: ?]
<?php if (isset($this->params['edit']['title']['mode']['create'])): ?>
<h1><?php echo $this->getI18NString('edit.title.mode.create') ?></h1>
<?php else: ?>
<h1>[?php echo __('Creating new') ?] <?php echo $this->getSingularName() ?></h1>
<?php endif; ?>
[?php endif; ?]

