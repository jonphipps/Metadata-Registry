[?php if ($sf_request->hasErrors()): ?]
<div class="form-errors">
<h2>[?php echo __('There are some errors that prevent the form to validate') ?]</h2>
<dl>
[?php foreach ($sf_request->getErrorNames() as $name): ?]
  <dt>[?php echo __($labels[$name]) ?]</dt>
  <dd>[?php echo $sf_request->getError($name) ?]</dd>
[?php endforeach; ?]
</dl>
</div>
<?php if (method_exists('sfUser', 'getFlash')): // For symfony 1.1 compatibility ?>
[?php elseif ($sf_user->hasFlash('notice')): ?]
<div class="save-ok">
<h2>[?php echo __($sf_user->getFlash('notice')) ?]</h2>
</div>
<?php else: ?>
[?php elseif ($sf_flash->has('notice')): ?]
<div class="save-ok">
<h2>[?php echo __($sf_flash->get('notice')) ?]</h2>
</div>
<?php endif ?>
[?php endif; ?]
