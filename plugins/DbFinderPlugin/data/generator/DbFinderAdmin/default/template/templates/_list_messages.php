[?php if ($sf_request->getError('delete')): ?]
<div class="form-errors">
  <h2>[?php echo __('Could not delete the selected %name%', array('%name%' => '<?php echo sfInflector::humanize($this->getSingularName()) ?>')) ?]</h2>
  <ul>
    <li>[?php echo $sf_request->getError('delete') ?]</li>
  </ul>
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
