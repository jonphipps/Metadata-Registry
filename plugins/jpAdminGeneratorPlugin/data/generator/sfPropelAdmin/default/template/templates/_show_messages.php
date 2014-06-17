[?php if ($sf_flash->has('notice')): ?]
<div class="save-ok">
<h2>[?php echo __($sf_flash->get('notice')) ?]</h2>
</div>
[?php endif; ?]
[?php if ($sf_flash->has('error')): ?]
<div class="save-error">
  <h2>[?php echo __($sf_flash->get('error')) ?]</h2>
</div>
[?php endif; ?]
